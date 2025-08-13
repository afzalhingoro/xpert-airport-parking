<?php
// app/Http/Controllers/SupportController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use App\Http\Controllers\EmailController;

class SupportController extends Controller
{
    public function index()
    {
        // In a real application, we would get the logged-in agent from session
        $agent = [
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'profile_pic' => 'https://ui-avatars.com/api/?name=' . Auth::user()->name . '&background=random'
        ];
        
        return view('admin.support.index', compact('agent'));
    }

    public function search(Request $request)
    {
        $term = $request->input('term');
        
        $results = DB::table('airports_bookings')
            ->where('id', 'LIKE', "%$term%")
            ->orWhere('referenceNo', 'LIKE', "%$term%")
            ->orWhere('first_name', 'LIKE', "%$term%")
            ->orWhere('last_name', 'LIKE', "%$term%")
            ->orWhere('email', 'LIKE', "%$term%")
            ->orWhere('phone_number', 'LIKE', "%$term%")
            ->orWhere('registration', 'LIKE', "%$term%")
            ->orWhere('make', 'LIKE', "%$term%")
            ->orWhere('model', 'LIKE', "%$term%")
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();
            
        return response()->json($results);
    }
    
    public function fetch($id)
    {
        $result = DB::table('airports_bookings')
            ->where('id', $id)
            ->first();
    
        return response()->json($result);
    }


    public function update_old(Request $request, $id)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'phone_number' => 'required|string|max:100',
            'departDate' => 'required|date',
            'returnDate' => 'required|date',
            'make' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'registration' => 'nullable|string|max:255',
        ]);
        
        DB::table('airports_bookings')
            ->where('id', $id)
            ->update($data);
            
        return response()->json(['success' => true]);
    }
    
    public function updateBooking(Request $request)
    {
        // Error reporting for debugging
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        // Validation
        $validated = $request->validate([
            'id' => 'required|integer|exists:airports_bookings,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'make' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'registration' => 'nullable|string|max:50',
            'departDate' => 'nullable|date',
            'deprTerminal' => 'nullable|string|max:50',
            'deptFlight' => 'nullable|string|max:50',
            'returnDate' => 'nullable|date',
            'returnTerminal' => 'nullable|string|max:50',
            'returnFlight' => 'nullable|string|max:50',
            'booking_amount' => 'nullable|numeric',
            'discount_amount' => 'nullable|numeric',
            'total_amount' => 'nullable|numeric',
            'payment_method' => 'nullable|string|max:50',
            'payment_status' => 'nullable|string|max:50',
            'refund_status' => 'nullable|string|max:50',
        ]);
    
        // Update record
        DB::table('airports_bookings')
            ->where('id', $validated['id'])
            ->update(array_merge($validated, [
                'updated_at' => now(),
            ]));
    
        // Email sending part
        $row = DB::table('airports_bookings')->where("id", $validated['id'])->first();
        $airport_detail = DB::table('airports')->where("id", $row->airportID)->first();
        $company_data = DB::table('companies')->where('id', $row->companyId)->first();
    
        $directions = '';
        if (!empty($company_data)) {
            $directions = "<strong>Arrival:</strong><br>" . $company_data->arival . "<br><strong>Return:</strong><br>" . $company_data->return_proc . "<br>";
        }
    
        $template_data = [
            "guidence" => $directions,
            "username" => $row->first_name . " " . $row->last_name,
            "email" => $row->email,
            "telephone" => $row->phone_number,
            "carpark" => "Car Park",
            "c_parent" => $company_data->name ?? '',
            "company" => $company_data->name ?? '',
            "ptype" => $row->booked_type,
            "airport" => $airport_detail->name ?? '',
            "terminal" => $this->getTerminalName($row->deprTerminal),
            "rterminal" => $this->getTerminalName($row->returnTerminal),
            "days" => $row->no_of_days,
            "start_date" => $row->departDate,
            "end_date" => $row->returnDate,
            "booktime" => date("Y-m-d H:i:s"),
            "r_flight_no" => $row->returnFlight,
            "reg" => $row->registration,
            "model" => $row->model,
            "make" => $row->make,
            "color" => $row->color,
            "payment_gatway" => $row->payment_method,
            "payment_status" => "success",
            "price" => $row->total_amount,
            "addtionalprice" => 0,
            "ref" => $row->referenceNo,
            "api_ref" => $row->ext_ref
        ];
    
        // Send email to customer
        $email_send = new EmailController();
        $email_send->sendGmail("Update Booking", $row->email, $template_data);
    
        // Send email to company if aph_id is null
        if (is_null($company_data->aph_id)) {
            $filePath = $this->create_csv_air($validated['id'], 'Amend');
            $email_send->sendGmailWithAttachment("Update Booking Company", $company_data->company_email, $template_data, $filePath);
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Booking updated and email sent successfully.'
        ]);
    }
    
    public function resendBookingEmail($id)
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        // Fetch booking record
        $row = DB::table('airports_bookings')->where("id", $id)->first();
        if (!$row) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found.'
            ], 404);
        }
    
        // Build email template data
        $template_data = [
            "username"       => $row->first_name . " " . $row->last_name,
            "email"          => $row->email,
            "telephone"      => $row->phone_number,
            "carpark"        => "Car Park",
            "c_parent"       => $row->company->name ?? '',
            "ptype"          => $row->booked_type,
            "airport"        => $row->airport->name ?? '',
            "terminal"       => $row->dterminal->name ?? '',
            "rterminal"      => $row->rterminal->name ?? '',
            "days"           => $row->no_of_days,
            "start_date"     => $row->departDate,
            "end_date"       => $row->returnDate,
            "booktime"       => $row->created_at,
            "r_flight_no"    => $row->returnFlight,
            "reg"            => $row->registration,
            "model"          => $row->model,
            "make"           => $row->make,
            "color"          => $row->color,
            "payment_gatway" => $row->payment_method,
            "payment_status" => "success",
            "price"          => $row->total_amount,
            "addtionalprice" => 0,
            "ref"            => $row->referenceNo,
        ];
    
        $email_send = new EmailController();
    
        // Send to client
        $client_emails = [$row->email, 'bookings@manchesterairportspaces.co.uk'];
        foreach ($client_emails as $email) {
            $email_send->sendGmail("Add Booking", $email, $template_data);
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Booking email resent successfully.'
        ]);
    }

    
    public function create_csv_air($token, $status)

    {

        $query = "select



		            ap.name AS Airport,

					c.parking_type AS ProductType,

					c.name AS ProductName,

					c.id AS ProductID,

					b.referenceNo AS ReferenceNumber,

					b.booking_status AS BookingStatus,

					CONCAT(b.first_name, ' ', b.last_name) AS CustomerName,

					DATE_FORMAT(b.departDate, '%Y-%m-%d %H:%i:%s') AS DepartureDate,

					DATE_FORMAT(b.returnDate, '%Y-%m-%d %H:%i:%s') AS ArrivalDate,

					IF(b.deprTerminal > 0, (select airports_terminals.name from airports_terminals where airports_terminals.id= b.deprTerminal), 'TBA') As DepartureTerminal,

					IF(b.returnTerminal > 0, (select airports_terminals.name from airports_terminals where airports_terminals.id= b.returnTerminal), 'TBA') As ArrivalTerminal,

					b.deptFlight AS DepartureFlightNo,

					b.returnFlight AS ReturnFlightNo,

					b.registration AS Regno,

					b.make AS Make,

					b.model AS Model,

					b.color AS CarColor,

					b.passenger AS Passengers,

					b.phone_number AS Mobile,

					b.booking_amount AS ListPrice,

					0 As AmountPrice,

					0 As SupplierCost





        			from airports_bookings as b

        			join companies as c on c.id = b.companyId

        			join airports as ap on ap.id = b.airportID

        			left join airports_terminals as tr on tr.id = b.deprTerminal

                    WHERE b.id =" . $token;



        $results = DB::select($query);



        if ($results > 0) {

            $datenow = date("dmYhms");

            $name = "ADP_$datenow.csv";

            $csvpath = public_path('csv/');

            $filepath = $csvpath . $name;

            $outstream = fopen($filepath, "w");

            // if($status != ""){

            //  	$results[0]->BookingStatus = 'BookingStatus';

            // }



            fputcsv($outstream, array_keys((array) $results[0]));



            foreach ($results as $result) {

                // 	if($status != ""){

                //       	$result->BookingStatus = $status;

                // 	}

                fputcsv($outstream, (array) $result);

            }



            // fclose($outstream);

            rewind($outstream);

            fclose($outstream);

        }

        return $filepath;

    }
    
    // Helper function to get terminal name
    private function getTerminalName($terminalId)
    {
        if ($terminalId != "TBA" && !empty($terminalId)) {
            $terminal = DB::table('airports_terminals')->where("id", $terminalId)->first();
            return $terminal->name ?? "TBA";
        }
        return "TBA";
    }

    
    public function reschedule(Request $request, $id)
    {
        $request->validate([
            'departDate'      => 'required|date',
            'returnDate'      => 'required|date|after_or_equal:departDate',
            'deprTerminal'    => 'nullable|string|max:100',
            'returnTerminal'  => 'nullable|string|max:100',
            'deptFlight'      => 'nullable|string|max:100',
            'returnFlight'    => 'nullable|string|max:100',
            'rescheduleReason'=> 'nullable|string|max:255',
            'rescheduleNotes' => 'nullable|string',
        ]);
    
        // Save extra info in browser_data as JSON
        $extraNotes = [
            'reason' => $request->rescheduleReason,
            'notes'  => $request->rescheduleNotes,
        ];
    
        $updated = DB::table('airports_bookings')
            ->where('id', $id)
            ->update([
                'departDate'     => $request->departDate,
                'returnDate'     => $request->returnDate,
                'deprTerminal'   => $request->deprTerminal,
                'returnTerminal' => $request->returnTerminal,
                'deptFlight'     => $request->deptFlight,
                'returnFlight'   => $request->returnFlight,
                'browser_data'   => json_encode($extraNotes),
                'modifydate'     => now()
            ]);
    
        return response()->json([
            'status'  => $updated ? 'success' : 'error',
            'message' => $updated ? 'Booking rescheduled successfully' : 'No changes made',
        ]);
    }

    public function cancelBooking(Request $request, $id)
    {
        $booking = DB::table('airports_bookings')->find($id);
        
        // Update booking status
        DB::table('airports_bookings')
            ->where('id', $id)
            ->update([
                'booking_status' => 'Cancelled',
                'booking_action' => 'Cancelled',
                'modifydate' => now()
            ]);
            
        return response()->json(['success' => true]);
    }

    public function changeDates(Request $request, $id)
    {
        $request->validate([
            'departDate' => 'required|date',
            'returnDate' => 'required|date',
            'deprTerminal' => 'nullable|string|max:100',
            'returnTerminal' => 'nullable|string|max:100',
            'deptFlight' => 'nullable|string|max:100',
            'returnFlight' => 'nullable|string|max:100',
        ]);
        
        DB::table('airports_bookings')
            ->where('id', $id)
            ->update($request->only([
                'departDate', 'returnDate', 
                'deprTerminal', 'returnTerminal',
                'deptFlight', 'returnFlight'
            ]));
            
        return response()->json(['success' => true]);
    }

    public function processRefund(Request $request, $id)
    {
        $request->validate([
            'refund_amount' => 'required|numeric',
            'refund_reason' => 'required|string|max:255'
        ]);
        
        // In a real application, we would integrate with payment gateway
        DB::table('airports_bookings')
            ->where('id', $id)
            ->update([
                'refund_status' => 'Processed',
                'booking_status' => 'Refund',
                'modifydate' => now()
            ]);
            
        return response()->json(['success' => true]);
    }

    public function resendEmail($id)
    {
        $booking = DB::table('airports_bookings')->find($id);
        
        // In a real application, we would send the email here
        // For now, we'll just update the status
        DB::table('airports_bookings')
            ->where('id', $id)
            ->update(['email_status' => 'Yes']);
            
        return response()->json(['success' => true]);
    }
}