<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Cookie;

use DB;

class discounts extends Model

{

    //

    public $timestamps = false;

















public static    function getPromoDiscount($promoCode, $booking_price, $type='',$company_id='') {





        if ($promoCode == '') {

            return 0.00;

        }

        $book_type = "";



        if($type=='airport_parking'){

            $book_type = 'airport_parking';

        }

        if($type=='airport_hotel'){

            $book_type = 'airport_hotel';

        }

        if($type=='airport_hotel_parking'){

            $book_type = 'airport_hotel_parking';

        }

        if($type=='airport_lounges'){

            $book_type = 'airport_lounges';

        }



        $Discount_filter='';

        if(Cookie::get('traffic')=='AF'){

            $discount_for = Cookie::get('traffic');

            $Discount_filter = "AND discount_for = '".$discount_for."'";

        }







        $_current_time = date("d-m-Y H:i:s");

        $days_ago = date('d-m-Y H:i:s', strtotime('-2 days', strtotime($_current_time)));



//        $ip = get_client_ip();

//        $booking_src = $db->get_row("SELECT * FROM ".$db->prefix."tracking WHERE ip = '".$ip."' && date > '".$days_ago."' order by id DESC");

//        if($booking_src){

//            if($booking_src['ref_src'] ==''){

//                $booking_src1 = $db->get_row("SELECT * FROM ".$db->prefix."tracking WHERE ip = '".$ip."' && ref_src !='' && date > '".$days_ago."' order by id DESC");

//                if($booking_src1){

//                    $_traffic_src = $booking_src1['ref_src'];

//                }

//                else{

//                    $_traffic_src = $booking_src['ref_src'];

//                }

//            }

//            else{

//                $_traffic_src = $booking_src['ref_src'];

//            }

//        }

//        else{

//            $_traffic_src = $_COOKIE['traffic'];

//        }



        $_traffic_src =Cookie::get('traffic');



//        $promoDetails = $db->get_row("SELECT * FROM " . $db->prefix . "discount

//                            WHERE promo = '".$promoCode."' AND status = 'Yes' AND parking_type = '".$book_type."'

//							$Discount_filter  AND start_date <= '".date("Y-m-d")."' AND end_date >= '".date("Y-m-d")."'");

//



        $promoDetails = discounts::where("promo",$promoCode)

            ->where("status","Yes")

            ->where("start_date","<=",date("Y-m-d"))

            ->where("end_date",">=",date("Y-m-d"))

            ->where("parking_type",$book_type)->first();

        if(Cookie::get('traffic')=='AF'){

            $promoDetails = discounts::where("promo",$promoCode)

                ->where("status","Yes")

                ->where("start_date","<=",date("Y-m-d"))

                ->where("end_date",">=",date("Y-m-d"))

                ->where("discount_for",Cookie::get('traffic'))

                ->where("parking_type",$book_type)->first();

        }
        if(isset($promoDetails->discount_type)){

        if($_traffic_src == "PPC"){

            if ($promoDetails->discount_for == 'PPC') {

                $promoDetails->discount_value = $promoDetails->discount_value;

            }

            else{

                $promoDetails->discount_value = '2.00';

            }

        }


        if ($promoDetails->discount_type == 'percent') {

            if($company_id!=''){

                //$max_disc = $db->get_row("SELECT * FROM " . $db->prefix . "companies WHERE (id = '".$company_id."' OR aph_id = '".$company_id."')");

                $max_disc = Company::where("id",$company_id)->orWhere("aph_id", $company_id)->first();

                if($max_disc->max_discount!=''){

                    if($max_disc->max_discount < $promoDetails->discount_value){

                        $promoDetails->discount_value = $max_disc->max_discount;

                    }

                }

            }

            //$discount_amount = ($booking_price / 100) * $promoDetails->discount_value;
            //echo "booking_price=".$booking_price."-----discount=".$promoDetails->discount_value."<br>";
            $discount_amount = ($booking_price) * ($promoDetails->discount_value/100);
           // dd($discount_amount);
            return round($discount_amount,2);

        }

        if ($promoDetails->discount_type == 'gbp') {

            return $promoDetails->discount_value;

        }
		
    }   

       else {
            $discount_amount = ($booking_price / 100)*1;
            $discount_amount=round($discount_amount,2);

            return $discount_amount;
        }

    }



 public static   function varifyPromoCode($promoCode) {


        // }

        //$discount_for = 'FB';

        if ($promoCode != '') {

//            $promoDetails = $db->get_row("SELECT * FROM " . $db->prefix . "discount

//                            WHERE promo = '".$promoCode."' AND status = 'Yes'

//

//                            AND start_date <= '".date("Y-m-d")."'

//                            AND end_date >= '".date("Y-m-d")."'");



//DB::connection()->enableQueryLog();


            $promoDetails = discounts::where("promo",$promoCode)

                ->where("status","Yes")

                ->where("start_date","<=",date("Y-m-d"))

                ->where("end_date",">=",date("Y-m-d"))->first();

//$queries = DB::getQueryLog();

//print_r($queries);
//die();

//print_r($promoDetails);
//die();

            if ($promoDetails != "") {

                if($promoDetails->discount_campaign == 'General') {

//                    $promofor = $db->get_row("SELECT * FROM " . $db->prefix . "discount

//                            WHERE promo = '".$promoCode."' AND status = 'Yes'

//							$Discount_filter

//                            AND start_date <= '".date("Y-m-d")."'

//                            AND end_date >= '".date("Y-m-d")."'");





                    $promofor = discounts::where("promo",$promoCode)

                        ->where("status","Yes")

                        ->where("start_date","<=",date("Y-m-d"))

                        ->where("end_date",">=",date("Y-m-d"))->first();





                    if(Cookie::get('traffic')=='AF'){





                        $promofor = discounts::where("promo",$promoCode)

                            ->where("status","Yes")

                            ->where("start_date",date("Y-m-d"))

                            ->where("discount_for",Cookie::get('traffic'))

                            ->where("end_date",date("Y-m-d"))->first();

                    }





                    if ($promofor != "") {

                        return "Verify";

                    }

                    else {

                        return "Discount Code is not Available through Refferal Sites";

                    }

                } else {

                    return "Not Verified";

                }

            } else {

                return "Discount Code Expired";

            }

        }

    }

}

