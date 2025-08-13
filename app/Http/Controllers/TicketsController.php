<?php

namespace App\Http\Controllers;

use App\Models\airport;
use App\Models\airports_bookings;
use App\Models\Company;
use App\Models\pages;
use App\Models\support_departments;
use App\Models\ticket_chat;
use App\Models\tickets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class TicketsController extends Controller
{
    public function getPagebySlug()
    {
        $url = explode('/', URL::full());

        $page = pages::where('slug', $url[3])->where('type', 'main')->first();
        if ($page) {
            return $page;
        } else {
            $page = (object) $page;

            $page->meta_title = '';
            $page->meta_keyword = '';
            $page->meta_description = '';

            return $page;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $page = $this->getPagebySlug();
        $airports = airport::all()->where('status', 'Yes');
        $departementslist = support_departments::all()->toArray();
        $departements_list = [];
        $departements_list[''] = 'Select Department';
        foreach ($departementslist as $u) {
            $departements_list[$u['id']] = $u['name'];
        }

        return view('frontend.customer_support', ['airports' => $airports, 'departements_list' => $departements_list, 'page' => $page]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $messages = [
            'required' => 'This field is required.',
            'attatchment.max' => 'The document may not be greater than 2 megabytes',
        ];

        $validatedData = Validator::make(request()->all(), [
            'ref_no' => 'required|string|max:255',
            'full_name' => 'required|string',
            'email' => 'required|string|email',
            'contact' => 'required',
            'department' => 'required',
            'priority' => 'required',
            'subject' => 'required',
            'message' => 'required|string',
            'supportdeskpolicy' => 'required',
'attatchment' => 'sometimes|mimes:jpg,jpeg,bmp,png,pdf,doc,docx,txt,zip|max:2000', // Allows additional file types
        ], $messages);
        

        $booking = airports_bookings::where('referenceNo', $request->input('ref_no'))
            ->where('email', $request->input('email'))->first();
        if ($booking) {
            $company = Company::where('id', $booking->companyId)
                ->orWhere('aph_id', $booking->companyId)->first();

            $ticket = new tickets();
            $ticket->title = $request->input('subject');
            $ticket->booking_ref = $request->input('ref_no');
            $ticket->user_id = $booking->customerId;
            $ticket->company_admin_id = $company->admin_id;
            $ticket->name = $request->input('full_name');
            $ticket->email = $request->input('email');
            $ticket->contact = $request->input('contact');
            $ticket->department = $request->input('department');
            $ticket->urgency = $request->input('priority');
            $ticket->date = date('Y-m-d h:i:s');
            $ticket->status = 'open';

            if ($ticket->save()) {

                $tid = DB::getPdo()->lastInsertId();
                $ticketRef = 'T-'.date('dmy').$tid;
                $model = tickets::find($tid);
                $model->ticket_id = $ticketRef;
                $model->save();

                $path = '';
                if ($request->hasFile('attatchment')) {
              
                    // $path = $request->file('attatchment')->store('supports');
                    $imagePath = $request->file('attatchment');
                    
                    $imageName = $imagePath->getClientOriginalName();
                   
                    $request->file('attatchment')->storeAs('public/supports', $imageName);
                    
                    $path = 'supports/'.$imageName;
                    

                    // $ticket->file = $path;
                }
                $data = [
                    'message' => $request->input('message'),
                    'attachment' => $path,
                    'clientunread' => 'No',
                    'adminunread' => 'Yes',
                    'replyingtime' => date('Y-m-d h:i:s'),
                    'replyingadmin' => $booking->customerId,
                ];

                if ($ticket->chat()->create($data)) {
                    $tickref = Crypt::encrypt($ticketRef);

                  
                    if ($request->has('portal')) {
                        return redirect()->back()->with('success', 'New Ticket has been generated successfully');
                    }

                    return redirect(route('view-ticket', ['id' => $tickref]));
                }
            }
        } else {
            $validatedData->getMessageBag()->add('ref_no', 'Invalid Ref Data Entered');
        }

        return redirect()->back()->withErrors($validatedData, 'ticket_store')->withInput();

        //return $validatedData;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tickets  $tickets
     * @return \Illuminate\Http\Response
     */
    public function show(tickets $tickets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tickets  $tickets
     * @return \Illuminate\Http\Response
     */
    public function edit(tickets $tickets)
    {
        //
    }

    public function submit_reply(Request $request)
    {
        $messages = [
            'required' => 'This field is required.',
            'attatchment.max' => 'The document may not be greater than 2 megabytes',
        ];
    
        $validatedData = Validator::make(request()->all(), [
            'ticket_id' => 'required|string|max:255',
            'replyingadmin' => 'required|string',
            'ticket_ref' => 'required|string',
            'message' => 'required|string',
        'attatchment' => 'sometimes|mimes:jpg,jpeg,bmp,png,pdf,doc,docx,txt,zip|max:2000', // Allows additional file types
        ], $messages);
    
        if ($validatedData->fails()) {
            // Debugging the validation errors
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
    
        $path = ''; // Default to an empty string for no file
        if ($request->hasFile('attatchment')) {
            $file = $request->file('attatchment');
        
            if (!file_exists(public_path('supports'))) {
                mkdir(public_path('supports'), 0775, true);
            }
        
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        
            $file->move(public_path('supports'), $fileName);
        
            $fileUrl = asset('supports/' . $fileName);
            $path = $fileUrl;  
        }
    
        $data = [
            'message' => $request->input('message'),
            'ticket_id' => $request->input('ticket_id'),
            'attachment' => $path, // Save the file path in the database
            'clientunread' => 'No',
            'adminunread' => 'Yes',
            'replyingtime' => now(), // Use Laravel's helper function for current time
            'replyingadmin' => $request->input('replyingadmin'),
            'reply_by' => $request->input('reply_by'),
        ];
    
        // Proceed to save data if no validation errors
        $chat_data = ticket_chat::create($data);
    
        if ($chat_data) {
            $ticket = tickets::where('ticket_id', $request->input('ticket_ref'))->first();
    
            $tickref = Crypt::encrypt($request->input('ticket_ref'));
            $link = 'https://www.airsideparking.com/ticket/view/' . $tickref;
            $email = new EmailController();
    
            $template_data = [
                'username' => $request->input('name'),
                'link' => $link,
                'subject' => $ticket->title,
                'ticket_ref' => $request->input('ticket_ref'),
                'msg' => $request->input('message'),
            ];
    
            // Email sending logic here...
    
            return redirect()->back();
        }
    }
    public function view($id)
    {

        // dd($id);
        $id = Crypt::decrypt($id);
        $ticket = tickets::where('ticket_id', $id)->orderBy('id', 'desc')->first();
        $department = support_departments::where('id', $ticket->department)->orderBy('id', 'desc')->first();
        $progress = ticket_chat::where('ticket_id', $ticket->id)->orderBy('id', 'desc')->first();
        $companyMsg = '';

        if ($progress->reply_to == 'All') {
            if ($progress->clientunread == 'Yes') {
                $companyMsg = 'Awaiting for Client Read';
            } elseif ($progress->Companyread == 'No') {
                $companyMsg = 'Awaiting for Company Read';
            } else {
                $companyMsg = 'Awaiting for Client and Company Response';
            }
        } elseif ($progress->reply_to != 'All') {
            if ($progress->reply_by == 'Client' && $progress->hold == 'Yes') {
                $companyMsg = 'Awaiting for admin to show to Company';
            } elseif ($progress->reply_by == 'Company' && $progress->hold == 'Yes') {
                $companyMsg = 'Awaiting for Admin to show to Client';
            } elseif ($progress->reply_by == 'Admin' && $progress->reply_to == 'Company') {
                $companyMsg = 'Awaiting for Company Reply';
            } elseif ($progress->reply_by == 'Admin' && $progress->reply_to == 'Client') {
                $companyMsg = 'Awaiting for Client Reply';
            } else {
                $companyMsg = 'Awaiting for Response';
            }
        }

        $airports = airport::all()->where('status', 'Yes');

        return view('frontend.viewticket', ['companyMsg' => $companyMsg, 'progress' => $progress, 'id' => $id, 'airports' => $airports, 'model' => $ticket, 'ticket' => $ticket, 'department' => $department]);
    }

    public function ticket_list(Request $request)
    {
        $validatedData = Validator::make(request()->all(), [
            'email' => 'required|string|max:255',
            'ref_no' => 'required|string',
        ]);

        $tickets = tickets::where('booking_ref', $request->input('ref_no'))->where('email', $request->input('email'))->get();

        return view('frontend.ticket_list_page', ['tickets' => $tickets]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\tickets  $tickets
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tickets $tickets)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tickets  $tickets
     * @return \Illuminate\Http\Response
     */
    public function destroy(tickets $tickets)
    {
        //
    }

    public function search_ticket(Request $request)
    {
        //

        $validatedData = Validator::make(request()->all(), [
            'email' => 'required|string|max:255',
            'ref_no' => 'required|string',
        ]);

        $booking = tickets::where('booking_ref', $request->input('ref_no'))->where('email', $request->input('email'))->first();

        if ($booking) {
            $ticketRef = $booking->ticket_id;
            $tickref = Crypt::encrypt($ticketRef);

            return redirect(route('view-ticket', ['id' => $tickref]));
        } else {
            $validatedData->getMessageBag()->add('ref_no', 'Invalid Data Entered');
        }

        return redirect()->back()->withErrors($validatedData, 'search_ticket')->withInput();
    }
}
