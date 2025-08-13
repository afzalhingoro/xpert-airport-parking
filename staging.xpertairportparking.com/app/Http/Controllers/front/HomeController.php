<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use App\Library\aph_functions;
use App\Library\api;
use App\Models\airport;
use App\Models\airports_bookings;
use App\Models\airports_terminals;
use App\Models\companies_special_features;
use App\Models\Company;
use App\Models\ContactUs;
use App\Models\discounts;
use App\Models\ExternalBooking;
use App\Models\ExternalCustomer;
use App\Models\faqs;
use App\Models\OffDays;
use App\Models\modules_settings;
use App\Models\pages;
use App\Models\reviews;
use App\Models\settings;
use App\Models\subscribers;
use App\Models\valet;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public $_setting = [];

    public $_settings = [];

    public $_module_setting = [];

    public function __construct()
    {
        $modules_settings = modules_settings::all();
        foreach ($modules_settings as $setting) {
            $this->_setting[$setting->name] = $setting->value;
        }

        //module settings
        $modules_settings = modules_settings::all();
        foreach ($modules_settings as $setting) {
            $this->_module_setting[$setting->name] = $setting->value;
        }
        // Added By Php Dev 07-08-2020
        $settings = settings::all();
        foreach ($settings as $setting) {
            $this->_settings[$setting->field_name] = $setting->field_value;
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

        $airports = airport::all()->where('status', 'Yes');
        $faqs = faqs::all()->where('status', 'Yes')->where('removed', 'No');
        $reviews = reviews::all()
            ->where('status', 'Yes')
            ->filter(function ($review) {
                return ! is_null($review->review);
            })
            ->sortByDesc('id');
        $posts = pages::all()->where('status', 'Yes')->where('type', 'post')->take(8)->sortByDesc('id');

        return view('home', ['airports' => $airports, 'posts' => $posts, 'reviews' => $reviews, 'faqs' => $faqs]);
    }

    public function subscribe_user(Request $request)
    {

        //dd($request->all());
        $messages = [
            'required' => 'This field is required.',
        ];
        //        $validatedData = $request->validate([
        //            'name' => 'required|string',
        //            'email' => 'required|string|unique:subscribers,email'
        //        ], $messages);

        $validatedData = Validator::make(request()->all(), [
            //'name' => 'required|string|regex:/^[\pL\s\-]+$/u|min:4',
            'email' => 'required|string|unique:subscribers,email',

        ], $messages);

        if ($validatedData->fails()) {

            //pass validator errors as errors object for ajax response
            $d = '';
            foreach ($validatedData->messages()->getMessages() as $field_name => $messages) {
                $d .= $messages[0]; // messages are retrieved (publicly)
            }

            return response()->json(['success' => 0, 'errors' => $d]);
        } else {

            //$name = $request->input("name")==''?'ZMD Subscriber ':$request->input("name");
            $email = $request->input('email');
            $timeout = 53;
            //fiveg mailchimp
            /*
            try {
                $name_detail = explode(" ",$name);
                //print_r($name_detail);exit;
                $email_address = trim($email);
                $api_endpoint = 'https://us17.api.mailchimp.com/3.0/lists/73d9053859/members/';
                $mailchimp_user_info = array(
                'FNAME' => $name_detail[0],
                'LNAME' => $name_detail[1]
                );
                $data = array(
                'status' => 'subscribed',
                'email_address' => $email_address,
                'merge_fields' => $mailchimp_user_info);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $api_endpoint);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                  'Accept: application/vnd.api+json',
                  'Content-Type: application/vnd.api+json',
                  'Authorization: apikey 2266974a532240839066eacaac47dfc3-us17'
                ));
                curl_setopt($ch, CURLOPT_USERAGENT, 'X-Cart4');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
                //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->verify_ssl);
                //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
                curl_setopt($ch, CURLOPT_ENCODING, '');
                curl_setopt($ch, CURLINFO_HEADER_OUT, true);
                $response['body']    = curl_exec($ch);
                $response['headers'] = curl_getinfo($ch);
                $response_array = json_decode($response['body'],true);
                if (isset($response['headers']['request_header'])) {
                  $headers = $response['headers']['request_header'];
                }
                //print_r($response_array);
                if ($response['body'] === false) {
                  $last_error = curl_error($ch);
                  //print_r($last_error);
                }

                curl_close($ch);
                //print_r($mailchimp_user_info);
            }
            catch(Exception $e)
            {

            } */
            //fivegmailchimp

            $sub = new subscribers();
            //$sub->name = $request->input("name");
            $sub->name = '';
            $email1 = $sub->email = $request->input('email');
            $sub->save();
            $template_data = [];
            $template_data['username'] = $request->input('name');
            //$email = new  EmailController();
            //$email->sendEmail("Subscription",$email1,$template_data);

            return response()->json(['success' => 1, 'data' => 'You have successfully Subscribed.']);
        }
    }

    public function subscribe_user_and_discount(Request $request)
    {

        //dd($request->all());
        $messages = [
            'required' => 'This field is required.',
        ];
        $validatedData = Validator::make(request()->all(), [
            //'name' => 'required|string|regex:/^[\pL\s\-]+$/u|min:4',
            'email' => 'required|string',

        ], $messages);
        if ($validatedData->fails()) {
            $d = '';
            foreach ($validatedData->messages()->getMessages() as $field_name => $messages) {
                $d .= $messages[0]; // messages are retrieved (publicly)
            }

            return response()->json(['success' => 0, 'errors' => $d]);
        } else {

            //$name = $request->input("name")==''?'ZMD Subscriber ':$request->input("name");
            $email = $request->input('email');
            $timeout = 53;
            $sub = new subscribers();
            //$sub->name = $request->input("name");
            $sub->name = '';
            $email1 = $sub->email = $request->input('email');
            $sub->save();
            $template_data = [];
            $template_data['username'] = 'Manchester Airport Spaces Subscriber';
            // return redirect(url('https://dev.airsideparking.uk/?promo=ASP-Og-sub-us'));

            $reff = url()->previous();

            if ($reff == 'https://dev.manchesterairportspaces.co.uk/') {
                return redirect(url()->previous().'?promo=ASP-Og-sub-us');
            } else {
                return redirect(url()->previous().'&promo=ASP-Og-sub-us');
            }
        }
    }

    public function getPagebySlug()
    {
        $url = explode('/', URL::full());

        $page = pages::where('slug', $url[3])->where('type', 'main')->where('status', 'Yes')->first();

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

    public function getPagebySlugTerminals()
    {
        $url = explode('/', URL::full());
        // dd($url);
        $page = pages::where('slug', $url[3])->where('type', 'page')->where('status', 'Yes')->first();

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
    public function heathrow_airport_parking()
    {
        $airports = airport::all()->where('status', 'Yes');
        $reviews = reviews::all()->where('status', 'Yes')->filter(function ($review) {return ! is_null($review->review);})->sortByDesc('id');
        return view('frontend.heathrow_airport_parking', ['airports' => $airports, 'reviews' => $reviews]);
    }

    public function sitemap()
    {

        $page = $this->getPagebySlug();

        $airports = airport::all()->where('status', 'Yes');

        return view('frontend.sitemap', ['airports' => $airports, 'page' => $page]);
    }

    public function rewards_and_loyalty()
    {
        $reviews = reviews::all()->where('status', 'Yes')->take(4)->sortByDesc('id');

        return view('frontend.rewards_and_loyalty', ['reviews' => $reviews]);
    }

    public function car_safety()
    {
        $reviews = reviews::all()->where('status', 'Yes')->take(4)->sortByDesc('id');

        return view('frontend.car_safety', ['reviews' => $reviews]);
    }

    public function about_us()
    {
        $reviews = reviews::all()->where('status', 'Yes')->take(4)->sortByDesc('id');

        return view('frontend.about_us', ['reviews' => $reviews]);
    }

    public function latest_news()
    {
        $reviews = reviews::all()->where('status', 'Yes')->take(4)->sortByDesc('id');

        return view('frontend.latest_news', ['reviews' => $reviews]);
    }

    public function airportparkingpage()
    {
        return view('frontend.airport-parking-page');
    }

    public function terminal_01()
    {
        $page = $this->getPagebySlugTerminals();
        $reviews = reviews::all()->where('status', 'Yes')->take(4)->sortByDesc('id');

        return view('frontend.terminal-01', ['reviews' => $reviews, 'page' => $page]);
    }

    public function terminal_02()
    {
        $page = $this->getPagebySlugTerminals();
        $reviews = reviews::all()->where('status', 'Yes')->take(4)->sortByDesc('id');

        return view('frontend.terminal_02', ['reviews' => $reviews, 'page' => $page]);
    }

    public function terminal_03()
    {
        $page = $this->getPagebySlugTerminals();
        $reviews = reviews::all()->where('status', 'Yes')->take(4)->sortByDesc('id');

        return view('frontend.terminal_03', ['reviews' => $reviews, 'page' => $page]);
    }

    public function terminal_04()
    {
        $page = $this->getPagebySlugTerminals();
        $reviews = reviews::all()->where('status', 'Yes')->take(4)->sortByDesc('id');

        return view('frontend.terminal_04', ['reviews' => $reviews, 'page' => $page]);
    }

    public function terminal_05()
    {
        $page = $this->getPagebySlugTerminals();
        $reviews = reviews::all()->where('status', 'Yes')->take(4)->sortByDesc('id');

        return view('frontend.terminal_05', ['reviews' => $reviews, 'page' => $page]);
    }

    public function choose_us()
    {
        $reviews = reviews::all()->where('status', 'Yes')->take(4)->sortByDesc('id');

        return view('frontend.choose_us', ['reviews' => $reviews]);
    }

    public function airportparkingpageredirect()
    {
        return redirect('https://www.airsideparking.com/airportparking');
    }

    public function lounges()
    {
        $page = $this->getPagebySlug();
        $airports = airport::all()->where('status', 'Yes');

        return view('frontend.lounges', ['airports' => $airports, 'page' => $page]);
    }

    public function airportsparking()
    {
        $page = $this->getPagebySlug();
        $airports = airport::all()->where('status', 'Yes');

        return view('frontend.airportsparking', ['airports' => $airports, 'page' => $page]);
    }

    public function airporttransfer()
    {
        $page = $this->getPagebySlug();

        $airports = airport::all()->where('status', 'Yes');

        return view('frontend.airporttransfer', ['airports' => $airports, 'page' => $page]);
    }

    public function feedback()
    {
        $airports = airport::all()->where('status', 'Yes');

        return view('frontend.feedback', ['airports' => $airports]);
    }

    public function allairport()
    {
        $airports = airport::all()->where('status', 'Yes');

        return view('frontend.allairport', ['airports' => $airports]);
    }

    public function blogs()
    {
        $airports = airport::all()->where('status', 'Yes');
        $posts = pages::orderBy('added_on', 'desc')->where('status', 'Yes')->where('type', 'post')->get();

        return view('frontend.blogs', ['posts' => $posts, 'airports' => $airports]);
    }

    public function blog_detail($slug)
    {
        $airports = airport::all()->where('status', 'Yes');
        /*$posts = pages::all()->where("status", "Yes")->where("type", "post")->where("slug",'!=', $slug)->take(3)->sortByDesc("id");*/
        $post = pages::where('slug', $slug)->where('type', 'post')->first();
        $posts = pages::where('slug', '!=', $slug)->where('type', 'post')->get();
        if ($post) {

            // $total_airports = airports_bookings::all()->count();

            return view('frontend.blog_detail', ['post' => $post, 'airports' => $airports, 'posts' => $posts]);
        } else {
            return view('frontend.404', ['airports' => $airports]);
        }
    }

    public function store(Request $request)
    {
        $bookings = new airports_bookings();

        $review = new reviews();

        $review->type = '3';
        $review->type = '3';
        $review->admin_id = '1';
        $review->type_id = '77';
        $review->ref = '3';

        $review->username = $request->input('name');
        $review->email = $bookings->email;
        $review->rating = $request->input('rating');
        $review->review = $request->input('message');
        $review->status = date('Y-m-d h:i:s');
        $review->count = 'open';
        $review->google_count = 'message';
        $review->save();

        $airports = airport::all()->where('status', 'Yes');

        return view('frontend.feedback', ['airports' => $airports]);
    }

    public function author()
    {
        $airports = airport::all()->where('status', 'Yes');
        $posts = pages::all()->where('status', 'Yes')->where('type', 'post');

        return view('frontend.author', ['posts' => $posts, 'airports' => $airports]);
    }

    public function contact()
    {
        $settings = [];
        $settingsAll = settings::all();
        foreach ($settingsAll as $setting) {
            $settings[$setting->field_name] = $setting->field_value;
        }

        return redirect()->route('main');
        // return view("frontend.contact-us", ["settings" => $settings]);
    }

    public function contactus_post(Request $request)
    {
        $subject = $request->input('subject');
        $title = $request->input('title');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $message = $request->input('message');

        $email_c = new EmailController();
    }

    public function airport_guide()
    {
        //
        $page = $this->getPagebySlug();
        $airports = airport::all()->where('status', 'Yes');

        //dd($airports);
        return view('frontend.airport_guide', ['airports' => $airports, 'page' => $page]);
    }

    public function airport_types()
    {
        //
        $page = $this->getPagebySlug();

        $sliders = unserialize($this->_settings['sliders']);
        $airports = airport::all()->where('status', 'Yes');

        return view('frontend.airports_types', ['airports' => $airports, 'page' => $page, 'sliders' => $sliders]);
    }

    public function static_page($page)
    {
        $airports = airport::all()->where('status', 'Yes');
        $reviews = reviews::all()->where('status', 'Yes')->take(4)->sortByDesc('id');
        $page = pages::where('slug', $page)->where('status', 'Yes')->first();

        if ($page) {

            //             $total_airports = airports_bookings::all()->count();
            // dd($total_airports);

            return view('frontend.static_page', ['airports' => $airports, 'reviews' => $reviews, 'page' => $page]);
        } else {
            return view('frontend.404', ['airports' => $airports]);
        }
    }

    public function faqs()
    {
        $page = $this->getPagebySlug();

        $airports = airport::all()->where('status', 'Yes');
        // $total_airports = airports_bookings::all()->count();
        //WHERE removed='No' group by type order by id asc
        $faqs = faqs::all()->where('removed', 'No')->groupBy('type');

        ///if ($page->meta_title == "") {
        //    return view("frontend.404", ["airports" => $airports]);
        //} else {
        return view('frontend.faqs', ['airports' => $airports, 'faqs' => $faqs, 'page' => $page]);
        //}

    }

    public function page($slug)
    {
        $airports = airport::all()->where('status', 'Yes');
        $page = pages::where('slug', $slug)->where('status', 'Yes')->first();
        $total_airports = airports_bookings::all()->count();

        $dropdate = date('m/d/Y');
        $dropdate1 = $this->addDayswithdate($dropdate, '7');
        //echo $dropdate1; die();
        $no_of_days = 8;
        $i = 1;
        $j = 1;
        $selected_date = strtotime($dropdate1);
        $year = date('Y', $selected_date);
        $month = date('n', $selected_date);
        //$month = 9;
        $day = date('j', $selected_date);
        if ($no_of_days > 30) {
            $total_days = '30';
        } else {
            $total_days = $no_of_days;
        }
        $dropoftime = date('h:i');
        $pickuptime = '09:00';

        $pickdate = $this->addDayswithdate($dropdate1, '8');

        if ($page) {

            $airports_Detail = airport::where('id', $page->typeid)->first();
            // $query = "SELECT fc.id as companyID,fc.name,fc.processtime,fc.awards,fc.featured,fc.recommended,fc.special_features,fc.overview,IF( LENGTH(fc.returnfront) >0,fc.returnfront,fc.return_proc) AS return_proc,IF( LENGTH(fc.arivalfront) >0,fc.arivalfront,fc.arival) AS arival,fc.terms,fc.address,fc.town,fc.post_code,fc.message,fc.parking_type,fc.logo,fc.travel_time,fc.miles_from_airport, fc.cancelable, fc.editable, fc.bookingspace,
            // fapp.id, fasb.brand_name, fapb.after_30_days, IF( fapb.day_$total_days >0, fapb.day_$total_days, 0.00) AS price FROM companies as fc
            // left join companies_set_price_plans as fapp on fc.id = fapp.cid
            // left join companies_set_assign_price_plans as fasb on fapp.id = fasb.plan_id and fasb.day_no = 'day_".$day."'
            // left join companies_product_prices as fapb on fapb.cid = fc.id and fapb.brand_name = fasb.brand_name
            // WHERE is_active = 'Yes' and fc.name not LIKE '%Paige %' and airport_id = '".$page->typeid."' and fapp.cmp_month = '".$month."' and fapp.cmp_year = '".$year."' order by price asc";
            $query = "SELECT 
            fapp.id,
            fc.company_code AS product_code, 
            fc.opening_time,
            fc.closing_time,
            fc.id AS companyID,
            fc.aph_id,
            fc.name,
            fc.processtime,
            fc.awards,
            fc.featured,
            fc.recommended,
            fc.special_features,
            fc.overview,
            IF(LENGTH(fc.returnfront) > 0, fc.returnfront, fc.return_proc) AS return_proc,
            IF(LENGTH(fc.arivalfront) > 0, fc.arivalfront, fc.arival) AS arival,
            fc.terms,
            fc.address,
            fc.town,
            fc.post_code,
            fc.message,
            fc.extra_charges,
            fc.parking_type,
            fc.logo,
            fc.travel_time,
            fc.miles_from_airport,
            fc.cancelable,
            fc.editable,
            fc.bookingspace,
            fasb.brand_name,
            fapb.after_30_days,
            fapp.id AS pl_id,
            IF(fapb.day_" . $total_days . " > 0, fapb.day_" . $total_days . " + fapp.extra, 0.00) AS price,
            fapb.brand_id,
            fapb.plan_type,
            fapb.agent_id
          FROM companies AS fc
          LEFT JOIN companies_set_price_plans AS fapp 
            ON fc.id = fapp.cid 
          LEFT JOIN companies_set_assign_price_plans AS fasb 
            ON fapp.id = fasb.plan_id 
            AND fasb.day_no = 'day_" . $total_days . "'
          LEFT JOIN companies_product_prices AS fapb 
            ON fapb.cid = fc.id 
            AND fapb.brand_name = fasb.brand_name
          WHERE fc.is_active = 'Yes'
            AND fc.name NOT LIKE '%Paige %'
            AND fc.airport_id = '" . $page->typeid . "'
            AND fapp.cmp_month = '" . $month . "'
            AND fapp.cmp_year = '" . $year . "'
            AND fapb.plan_type = '1'
            AND fapb.agent_id = '0'
            AND fapp.plan_type = '1'
            AND fapp.agent_id < '1'
          ORDER BY price ASC";
           
            $companies = DB::select(DB::raw($query));
            $companies = collect($companies)->map(function ($x) {
                return (array) $x;
            })->toArray();

            $all_records = [];
            if (! empty($companies)) {
                $all_records = (array) $companies;
            }

            $all_records_md = $this->Search_IN_ARRAY($all_records, 'parking_type', 'Meet and Greet');

            $all_records_pd = $this->Search_IN_ARRAY($all_records, 'parking_type', 'Park and Ride');

            $reviews = reviews::all()->where('type_id', $page->typeid)->where('status', 'Yes');

            return view('frontend.page', ['id' => $page->typeid, 'airports' => $airports, 'page' => $page, 'total_airports' => $total_airports, 'airports_Detail' => $airports_Detail, 'companies' => $companies, 'all_records_md' => $all_records_md, 'all_records_pd' => $all_records_pd, 'reviews' => $reviews]);
        } else {
            return view('frontend.404', ['airports' => $airports]);
        }
    }

    public function airports()
    {
        $page = $this->getPagebySlug();
        $airports = airport::all()->where('status', 'Yes');

        return view('frontend.airports', ['airports' => $airports, 'page' => $page]);
    }

    public function Search_IN_ARRAY($array, $key, $value)
    {
        $results = [];

        if (is_array($array)) {
            if (isset($array[$key]) && $array[$key] == $value) {
                $results[] = $array;
            }

            foreach ($array as $subarray) {
                $results = array_merge($results, $this->Search_IN_ARRAY($subarray, $key, $value));
            }
        }

        return $results;
    }

    public function addDayswithdate($date, $days)
    {
        $date = strtotime('+'.$days.' days', strtotime($date));

        return date('m/d/Y', $date);
    }

    public function reviews()
    {

        // $query = "SELECT b.id, b.username,b.review,b.rating,b.status,b.created_at, c.id as c_id,c.name as c_name,d.id as d_id,d.name as d_airport_name,s.id as s_id
        //     FROM reviews as b
        //     join companies as c ON b.type_id=c.id OR type_id = c.aph_id
        //     join airports as d ON c.airport_id = d.id
        //     join users as s ON c.admin_id = s.id where b.id !='' && b.status='Yes'
        //      ORDER BY b.id desc limit 12";

        //     $reviews = DB::select(DB::raw($query));
        //     $reviews = collect($reviews)->map(function ($x) {
        //         return (array)$x;
        //     })->toArray();
        //     $airports = airport::all()->where("status", "Yes");
        $reviews = reviews::all()->where('status', 'Yes')->sortByDesc('id');

        return view('frontend.review', ['reviews' => $reviews]);
    }

    public function addBookingForm(Request $request)
    {

        $company = DB::table('companies')->where('id', '3')->first();
        $booking_fee = DB::table('settings')->where('field_name', 'booking_fee')->first();
        $booking_fee = ($booking_fee->field_value);
        $aid = "1";
        $airports = airport::all()->where('status', 'Yes');
        $terminals = airports_terminals::all()->where('aid', '=', $aid);
        $washDetails = [];
        $valet_array = valet::all();
        foreach ($valet_array as $row) {
            $washDetails[$row['pkg']][1] = $row['car'];
            $washDetails[$row['pkg']][2] = $row['4x4'];
            $washDetails[$row['pkg']][3] = $row['mpv'];
        }
        //dd($washDetails);
        $dropdate = str_replace('/', '-', $request->dropdate);
        $pickdate = str_replace('/', '-', $request->pickdate);
        $dropofdate = date('Y-m-d', strtotime($dropdate));
        $pickupdate = date('Y-m-d', strtotime($pickdate));
        $dStart = new DateTime($dropofdate);
        $dEnd = new DateTime($pickupdate);
        $dDiff = $dStart->diff($dEnd);
        $dDiff->format('%R');
        $no_of_days = $dDiff->days;
        $total_days = $no_of_days + 1;
        //  dd($no_of_days);

        // if ($no_of_days > 30) {
        //     $total_days = '30';
        // } else {
        //     $total_days = $no_of_days + 1;
        // }
        if ($total_days <= 0) {
            $total_days = 1;
        }

        $request['dropdate'] = date('m/d/Y', strtotime($dropdate));
        $request['pickdate'] = date('m/d/Y', strtotime($pickdate));
        $request['total_days'] = $total_days;

        return view('frontend.booking', ['data' => $request, 'settings' => $this->_setting, 'airports' => $airports, 'terminals' => $terminals, 'washDetails' => $washDetails]);
    }

    public function addBookingFormincomplete($id)
    {

        $airport_booking = airports_bookings::find($id);
        /// dd($airport_booking);
        //dd("i m in booking");
        $DepartDatetemp = explode(' ', $airport_booking->departDate);
        $returnDatatemp = explode(' ', $airport_booking->returnDate);
        $company_id = $airport_booking->companyId;
        $product_code = $airport_booking->product_code;
        //dd($product_code);

        $parking_type = '';
        $_token = '5kZQnmKV9unuKObedug3dDWK3R6ScEFrnXQUG34X';
        $parking_name = null;
        $aphactive = '0';
        $airport = $airport_booking->airportID;
        $dropdate = $DepartDatetemp[0];
        $pickdate = $returnDatatemp[0];
        $droptime = $DepartDatetemp[1];
        $picktime = $returnDatatemp[1];
        $total_days = $airport_booking->no_of_days;
        $discount_code = $airport_booking->discount_code;
        $discount_amount = $airport_booking->discount_amount;
        $booking_amount = $airport_booking->booking_amount;
        //dd(  $company_id);
        $request = [
            '_token' => '5kZQnmKV9unuKObedug3dDWK3R6ScEFrnXQUG34X',
            'title' => $airport_booking->title,
            'firstname' => $airport_booking->first_name,
            'lastname' => $airport_booking->last_name,
            'email' => $airport_booking->email,
            'referenceNo' => $airport_booking->referenceNo,
            'company_id' => $company_id,
            'fulladdress' => $airport_booking->fulladdress,
            'postal_code' => $airport_booking->postal_code,
            'product_code' => $product_code,
            'phone_number' => $airport_booking->phone_number,
            'parking_type' => 'Maple Parking Meet Greet Flex',
            'parking_name' => null,
            'aphactive' => '1',
            'airport' => $airport,
            'dropdate' => $dropdate,
            'pickdate' => $pickdate,
            'droptime' => $droptime,
            'picktime' => $picktime,
            'total_days' => $total_days,
            'discount_code' => null,
            'discount_amount' => $discount_amount,
            'booking_amount' => $booking_amount,
            'bookingfor' => 'airport_parking',
            'pl_id' => null,
            'sku' => null,
            'site_codename' => null,
            'speed_park_active' => null,
            'edin_active' => null,
            'edin_search' => null,
            'submitted' => 'airport_parking',
        ];
        //$request1 = json_encode($request);

        //dd($request[dropdate']);
        $aid = $airport_booking->airportID;
        $airports = airport::all()->where('status', 'Yes');

        $terminals = airports_terminals::all()->where('aid', '=', $aid);

        return view('frontend.booking-incomplete', ['data' => $request, 'settings' => $this->_setting, 'airports' => $airports, 'terminals' => $terminals]);
    }

    //this function is used for post resl
    public function getSearchResult(Request $request)
    {

        if ($request->ajax()) {

            return $this->ajaxSearchResults($request);
        } else {

            $airports = airport::all()->where('status', 'Yes');

            return view('frontend.search_result', ['airports' => $airports]);
        }
    } // end of function

    //config('app.ABTANumber')

    public function getAphInfo()
    {
        //dd($request);exit;
        return ['ABTANumber' => config('app.ABTANumber'), 'Password' => config('app.Password'), 'Initials' => config('app.Initials'), 'aphurl' => config('app.aphurl'), 'aphurldetails' => config('app.aphurldetails')];
        //echo "reached";exit;

    }

    public function getSearchResultForTravelez(Request $request)
    {
        //dd($request);exit;
        return $this->ajaxSearchResults($request);
        //echo "reached";exit;

    }

    public function ajaxSearchResults($request)
    {

        $promo_error_message = '';
 

        $messages = [
            'required' => 'This field is required.',
        ];
        $validatedData = Validator::make(request()->all(), [
            'airport_id' => 'required',
            'dropoffdate' => 'required',
            'departure_date' => 'required',

        ], $messages);

        $airport_id = $request->input('airport_id');

        $dropdate = $request->input('dropoffdate');
        $pickdate = $request->input('departure_date');
        $dropoftime = $request->input('dropoftime');
        $pickuptime = $request->input('pickup_time');
        $no_of_days = $request->input('no_of_days');

        $dropdate = str_replace('/', '-', $dropdate);
        $pickdate = str_replace('/', '-', $pickdate);

        // new way to calculate number of days

        //       $start_date = \Carbon\Carbon::createFromFormat('d-m-Y', '1-5-2015');
        // $end_date = \Carbon\Carbon::createFromFormat('d-m-Y', '10-5-2015');
        // $different_days = $start_date->diffInDays($end_date);

        //$bookingfor = $request->input('bookingfor');
        $bookingfor = 'airport_parking';
        $promo = $request->input('promo');
        $promo2 = $request->input('promo2');
        //$filter2 = $_POST['filter2'];
        $filter2 = ($request->input('filter2') != '') ? $request->input('filter2') : 'low-to-high';
        $filter3 = $request->input('filter3');
        $search_filter = '';
        $search_filter3 = '';
        $search_filter2 = 'order by sort_by asc';
        // $search_filter2 = 'order by parking_type asc';
        // if ($filter1 != '' && $filter1 != 'All') {
        //     $search_filter .= "and parking_type = '" . $filter1 . "'";
        // }
        if ($filter2 == 'low-to-high') {
            $search_filter2 = 'order by featured asc, recommended asc,parking_type asc, price asc';
            //$search_filter2 = 'ORDER BY ';
        } elseif ($filter2 == 'high-to-low') {
            $search_filter2 = 'order by price desc';
        } elseif ($filter2 == 'distance') {
            $search_filter2 = 'order by travel_time asc';
        }
        if ($filter3 != '') {
            $search_filter3 .= "and terminal = '".$filter3."'";
        }

       // Step 1: Get traffic source from session
$bk_src = session()->get('bk_src');

// // Step 2: If source is PPC, ignore promo code
// if ($bk_src === 'PPC') {
//     $promo = '';
//     $promo2 = '';
// }

// Now proceed with promo code validation
if ($promo != '') {
    $discount = new discounts();
    $promo_verify = $discount->varifyPromoCode($promo);

    if ($promo_verify != 'Verify') {
        $validatedData->getMessageBag()->add('promo', $promo_verify);
    }
}

if ($promo2 != '') {
    $discount = new discounts();
    $promo_verify = $discount->varifyPromoCode($promo2);

    if ($promo_verify != 'Verify') {
        $promo_error_message = $promo_verify;
    }
    $promo = $promo2;
}


        //dd($promo);
        $html = '';
        $i = 1;
        $j = 1;
        $inactive = 0;
        $inactiv = 0;

        $selected_date = strtotime($dropdate);
        $year = date('Y', $selected_date);
        $month = date('n', $selected_date);
        $day = date('j', $selected_date);

        $dropofdate = date('Y-m-d', strtotime($dropdate));
        $pickupdate = date('Y-m-d', strtotime($pickdate));

        $dStart = new DateTime($dropofdate);
        $dEnd = new DateTime($pickupdate);
        $dDiff = $dStart->diff($dEnd);

        $dDiff->format('%R');
        $no_of_days = $dDiff->days;
        $no_of_day = $dDiff->days+1;
        $total_days = $no_of_days + 1;

        if ($no_of_days > 30) {
            $total_days = "30";
        } else {
            $total_days = $no_of_days + 1;
        }
        if ($total_days <= 0) {
            $total_days = 1;
        }
        $total_days = strval($total_days);

      
        // Calculate Days Difference From Now
        $dropdate1 = strtotime($dropdate);
        $c_time = date('Y-m-d');
        $dropdate1 = date('Y-m-d', $dropdate1);
        $datetime1 = new DateTime($c_time);
        $datetime2 = new DateTime($dropdate1);
        $interval = $datetime1->diff($datetime2);
        $diff_date = $interval->format('%R%a');
        $diff_date = substr($diff_date, 1);
        
 
         $query = "SELECT DISTINCT 
            fapp.id,
            fc.company_code AS product_code, 
            fc.opening_time,
            fc.closing_time,
            fc.id AS companyID,
            fc.aph_id,
            fc.name,
            fc.is_active,
            fc.processtime,
            fc.awards,
            fc.featured,
            fc.recommended,
            fc.special_features,
            fc.overview,
            IF(LENGTH(fc.returnfront) > 0, fc.returnfront, fc.return_proc) AS return_proc,
            IF(LENGTH(fc.arivalfront) > 0, fc.arivalfront, fc.arival) AS arival,
            fc.terms,
            fc.address,
            fc.town,
            fapp.cmp_year,
            fapp.cmp_month,
            fc.post_code,
            fc.message,
            fc.extra_charges,
            fc.parking_type,
            fc.logo,
            fc.travel_time,
            fc.miles_from_airport,
            fc.cancelable,
            fc.editable,
            fc.bookingspace,
            fasb.brand_name,
            fapb.after_30_days,
            fasb.day_no,
            fapp.id AS pl_id,
            IF(fapb.day_" . $total_days . " > 0, fapb.day_" . $total_days . " + fapp.extra, 0.00) AS price,
            fapb.brand_id,
            fapb.plan_type,
            fapb.agent_id
          FROM companies AS fc
          LEFT JOIN companies_set_price_plans AS fapp 
            ON fc.id = fapp.cid 
          LEFT JOIN companies_set_assign_price_plans AS fasb 
            ON fapp.id = fasb.plan_id 
            AND fasb.day_no = 'day_" . $total_days . "'
          LEFT JOIN companies_product_prices AS fapb 
            ON fapb.cid = fc.id 
            AND fapb.brand_name = fasb.brand_name
          WHERE fapb.plan_type = '1'
            AND fc.is_active = 'Yes'
            AND fapb.agent_id = '0'
            AND fapp.plan_type = '1'
            AND fapp.agent_id < '1'
            AND fapp.cmp_month = '" . $month . "'
            AND fapp.cmp_year = '" . $year . "'
            AND NOT EXISTS (
                SELECT 1
                FROM companies_set_assign_price_plans AS sub_fasb
                WHERE sub_fasb.plan_id = fapp.id
                  AND sub_fasb.day_no = 'day_".$day."'
                  AND sub_fasb.brand_name IN ('fully_booked', 'fully_closed')
            )
          ORDER BY fc.id ASC";
$companies = DB::select($query);

$offDaysComp = [];
$offComp = [];

$offDayEntriesComp = OffDays::where('off_type', 'Company')->get();
foreach ($offDayEntriesComp as $offDayEntryComp) {
    $company_id = $offDayEntryComp->company_id;
    $offDays = explode(',', $offDayEntryComp->off_days);
    if (!isset($offDaysComp[$company_id])) {
        $offDaysComp[$company_id] = [];
    }
    $offDaysComp[$company_id] = array_merge($offDaysComp[$company_id], $offDays);
    $offComp[] = $company_id;
}

$array = [];
$fullyBooked = false;

if ($companies !== false) {
    $availableCompanies = [];

    foreach ($companies as $company) {
        $company = (array) $company;

        $reviews = Company::find($company['companyID'])->reviews;
        $company['reviews'] = $reviews->toArray();

        $isOff = false;
        if (isset($offDaysComp[$company['companyID']])) {
            $offDays = array_map('trim', $offDaysComp[$company['companyID']]);
            $dropOfDateTrimmed = trim($dropofdate);
            $pickupDateTrimmed = trim($pickupdate);

            if (in_array($dropOfDateTrimmed, $offDays) || in_array($pickupDateTrimmed, $offDays)) {
                $isOff = true;
            }
        }

        if ($isOff) {
            continue;
        }

        // Company is available
        $availableCompanies[] = $company;

        // Adjust the price if booking period is longer than 30 days
       if ($no_of_days > 30) {
                        $after30Days = $company['after_30_days'];
                        $booking_price = number_format($company['price'], 2, '.', '');
                        $booking_price = $booking_price + $after30Days * ($no_of_days - 30);
                        $booking_price = number_format($booking_price, 2, '.', '');
                    } else {
                        $booking_price = number_format($company['price'], 2, '.', '');
                    }

        $array[] = $this->array_flatten($company);
    }

    // If no available companies after filtering off days
    if (empty($availableCompanies)) {
        $fullyBooked = true;
        $array[] = ['message' => 'Fully Booked'];
    }
} else {
    $array[] = ['message' => 'There is no package for these dates.'];
}

$company = json_decode(json_encode((array) $array), false);

$airports = airport::all()->where('status', 'Yes');
$companies_special_features = companies_special_features::all();
$airport_detail = airport::where('id', $airport_id)->first();
$apiairports = airport::all()->where('id', $airport_id)->toArray();
foreach ($apiairports as $apiairport) {
    $airport_name = $apiairport['name'];
    $airport_code = $apiairport['iata_code'];
    $airport_post_code = $apiairport['post_code'];
    $airport_address = $apiairport['address'];
    $airport_town = $apiairport['city'];
}
$ArrivalDate = date('dMy', strtotime($dropdate));
$DepartDate = date('dMy', strtotime($pickdate));
$ArrivalTime = date('Hi', strtotime($dropoftime));
$DepartTime = date('Hi', strtotime($pickuptime));

$aph_functions = new aph_functions();
$api = new api();

if (empty($availableCompanies)) {
    $fullyBooked = true;
    $companiesArray = [];
} else {
    $fullyBooked = false;
    $companiesArray = $availableCompanies;
}
$company = json_decode(json_encode($companiesArray), false);
if ($request->input('return_json') != 'Yes') {
    return view('frontend.ajax_search_result', [
        'airports' => $airports,
        'companies' => $company,
        'companies_special_features' => $companies_special_features,
        'request' => $request,
        'no_of_days' => $no_of_day,
        'promo' => $promo,
        'bookingfor' => $bookingfor,
        'airport_detail' => $airport_detail,
        'promo_error_message' => $promo_error_message,
        'fullyBooked' => $fullyBooked,
    ]);
} else {
    return response()->json([
        'airports' => $airports,
        'companies' => $company,
        'companies_special_features' => $companies_special_features,
        'request' => $request,
        'no_of_days' => $no_of_day,
        'promo' => $promo,
        'bookingfor' => $bookingfor,
        'airport_detail' => $airport_detail,
        'promo_error_message' => $promo_error_message,
        'fullyBooked' => $fullyBooked,
    ]);
}

    }

    public function array_flatten($array)
    {
        if (! is_array($array)) {
            return false;
        }
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $arrayList = $this->array_flatten($value);
                foreach ($arrayList as $listItem) {
                    $result[$key] = $listItem;
                }
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }

    public function loadinfo(Request $request)
    {
        $id = $request->input('id');

        $query = 'SELECT comp.overview,comp.arival,comp.return_proc,rev.rating,rev.username,rev.title,rev.review FROM companies as comp left join reviews as rev on comp.id = rev.type_id where comp.id = '.$id.'  ';
        $companies = DB::select(DB::raw($query));
        ///$reviews= reviews::all()->where("type_id", $id)->take(4)->sortByDesc("id");

        return json_encode($companies);
    }

    public function contactussubmit(Request $request)
    {
        $data = $request->all();

        $contact = new ContactUs;
        $contact->name = $data['name'];
        $contact->email = $data['email'];
        $contact->comments = $data['comments'];
        $contact->save();

        return response()->json(['success' => 'Form submit successfully']);
    }

    public function getExternalBookings(Request $request)
    {

        set_time_limit(1000);
        $token_curl = curl_init();
        curl_setopt_array($token_curl, [
            CURLOPT_URL => 'https://airsideparking.com/backend/api/auth/login/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
        "user_name": "report_admin",
        "password": "airside@987"
        }
        ',
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Content-Type: application/json',
            ],
        ]);
        $response_token = curl_exec($token_curl);
        curl_close($token_curl);
        $token = json_decode($response_token, true);
        //dd($token['access']);
        $bearerToken = $token['access'];
        $curl_data = curl_init();
        curl_setopt_array($curl_data, [
            CURLOPT_URL => 'https://airsideparking.com/backend/api/reports/?report_name=bookings_detailed',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'accept: application/json',
                "access_token: $bearerToken",
                "Authorization: Bearer $bearerToken",
            ],
        ]);
        $response_data = curl_exec($curl_data);
        curl_close($curl_data);
        // Process the response data (assuming it's JSON)
        $response_data = json_decode($response_data, true);
        //dump('out side all data',$response_data);
        //dump('Check Data key',$response_data['data']);\
        $count = 0;
        if (isset($response_data['data']) && is_array($response_data['data'])) {
            foreach ($response_data['data'] as $item) {

                $extCus = ExternalCustomer::where('external_id', $item['customer_details']['id'])->first();
                // if (!$extCus) {
                //     $count++;
                //     $externalCustomers = new ExternalCustomer();
                //     $externalCustomers->external_id = $item['customer_details']['id'];
                //     $externalCustomers->user_name =   $item['customer_details']['user_name'];
                //     $externalCustomers->email =       $item['customer_details']['email'];
                //     $externalCustomers->full_name =   $item['customer_details']['full_name'];
                //     $externalCustomers->phone_num =   $item['customer_details']['phone_num'];
                //     $externalCustomers->status = 'active';
                //     $externalCustomers->save();
                //     dump('User Id = ' . $externalCustomers->id . ' Count #' . $count);
                // } else {
                //     dump('Skip ');
                // }
                if ($extCus) {
                    $count++;
                    $external_booking = new ExternalBooking;
                    $external_booking->external_id = $item['booking_dbid'];
                    $external_booking->external_customer_id = $extCus->id;
                    $external_booking->airport_id = $item['airport'];
                    $external_booking->airport_name = $item['airport_name'];
                    $external_booking->customer_name = $item['customer_details']['full_name'];
                    $external_booking->user_name = $item['customer_details']['user_name'];
                    $external_booking->email = $item['customer_details']['email'];
                    $external_booking->phone = $item['customer_details']['phone_num'];
                    $external_booking->passenger = 0;
                    $external_booking->reference_number = $item['booking_num'];
                    $external_booking->supplier_name = $item['supplier_name'];
                    $external_booking->departure_datetime = $item['pickup_datetime'];
                    $external_booking->departure_terminal = $item['pickup_terminal_name'];
                    $external_booking->departure_flight_number = $item['departing_flight'];
                    $external_booking->return_datetime = $item['return_datetime'];
                    $external_booking->return_terminal = $item['return_terminal_name'];
                    $external_booking->return_flight_number = $item['return_flight'];
                    $external_booking->booking_amount = $item['amount'];
                    $external_booking->discount_amount = 0;
                    $external_booking->net = $item['net'];
                    $external_booking->add_on_charges = $item['add_on_charges'];
                    $external_booking->booking_fee = null;
                    $external_booking->anyOther_fee = null;
                    $external_booking->booking_agent_name = null;
                    $external_booking->total_amount = $item['amount'];
                    $external_booking->booking_status = $item['booking_status'];
                    $external_booking->payment_status = $item['payment_status'];
                    $external_booking->payment_mode = $item['payment_mode'];
                    $external_booking->pending_amount = $item['pending_amount'];
                    $external_booking->external_reference = $item['booking_num'];
                    $external_booking->car_make = $item['car_details']['car_make'];
                    $external_booking->car_model = $item['car_details']['car_model'];
                    $external_booking->car_color = $item['car_details']['car_color'];
                    $external_booking->booking_date = $item['created_at'];
                    $external_booking->update_date = $item['modified_at'];
                    $external_booking->save();
                    dump('Booking Id = '.$external_booking->id.' Count #'.$count);
                }
            }
        } else {
            dump($response_data);
        }
        dd('end');
    }

    public function getAgents(Request $request)
    {

        $supplierNames = DB::table('external_bookings')->distinct()->pluck('supplier_name');

        dd($supplierNames);

        $supplierNameMapping = [

            'P4U' => 'Parking 4 You',

        ];
        $supplierNames = DB::table('external_bookings')->distinct()->pluck('supplier_name');
        $updatedSupplierNames = $supplierNames->map(function ($name) use ($supplierNameMapping) {
            // Check if the name exists in the mapping, otherwise, keep the original name
            return $supplierNameMapping[$name] ?? $name;
        });
        dd(1);

        // 0 => "SPS-SS"   // Looking4Parking -> SPS-1-5945032
        // 2 => "P4U"   // Parking 4 You -> P4U-532843
        // 4 => "ASP"       // Airside Parking -> ASP-23100697
        // 5 => "Park&Go"
        // 6 => "L4P" // looking 4 Parking
        // 7 => "ACP"  // Compare Parking Deals -> ACP-11-481639
        // 8 => "ZMD Travels"
        // 9 => "Airside Parking UK"
        // 10 => "ParkingZone"
        // 11 => "M&G Reservations"
        // 13 => "Cheap Deal Center"

        //     Availiable in Panle

        //    1 Compare Parking Deals
        //    2 Parking 4 You
        //    3 ZMD Travels

        //    Need To Add

        //    Looking 4 Parking

        //    Airside Parking

        //    Airside Parking UK
        //    ParkingZone
        //    M&G Reservations

        //    Cheap Deal Center

    }
}
