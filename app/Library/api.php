<?php
namespace App\Library;
//require_once("../session.php");
use App\Models\Company;
class api
{
    function aph_record($APHcompanies, $airport_id, $search_filter)
    {
       // global $db;
        $array1 = array();
        $array = array();

        //echo "count=".count($APHcompanies);

        foreach ($APHcompanies as $APHcompany) {
            $company_details = $this->get_records($airport_id, $APHcompany['companyID'], $search_filter);

            //$airport = DB::select( DB::raw("SELECT * from airports WHERE id = $airport_id"));
            $airport =  DB::table('airports')->whereRaw("id = $airport_id")->first();
            //$airport = $airport[0];
            $airport_name = $airport->name;
            if (empty($company_details)) {
                continue;
            }

            $array['opening_time'] = $company_details['opening_time'];
            $array['closing_time'] = $company_details['closing_time'];
            $array['id'] = $company_details['companyID'];
            $array['companyID'] = $company_details['companyID'];
            $array['aph_id'] = $APHcompany['companyID'];
			$array['product_code'] = $APHcompany['ProductCode'];
            $array['name'] = $company_details['name'];
            $array['processtime'] = $company_details['processtime'];
            $array['cancelable'] = $company_details['cancelable'];
            $array['awards'] = $company_details['awards'];
            $array['featured'] = $company_details['featured'];
            $array['recommended'] = $company_details['recommended'];
            $array['special_features'] = $company_details['special_features'];
            $array['overview'] = $company_details['overview'];
            $array['return_proc'] = $company_details['return_proc'];
            $array['arival'] = $company_details['arival'];
            $array['terms'] = $company_details['terms'];
            $array['address'] = $company_details['address'];
            $array['town'] = $company_details['town'];
            $array['post_code'] = $company_details['post_code'];
            $array['message'] = $company_details['message'];
            $array['parking_type'] = $APHcompany['parking_type'];
            $array['parking_name'] = $APHcompany['name'] . ' ' . $airport_name;
            $array['logo'] = $company_details['logo'];
            $array['travel_time'] = $company_details['travel_time'];
            $array['miles_from_airport'] = $company_details['miles_from_airport'];
            $array['editable'] = $company_details['editable'];
            $array['bookingspace'] = $company_details['bookingspace'];
            $array['price'] = $APHcompany['price'];
            $array['aphactive'] = 1;
            //$array1[] = $array;
            $array1[] = $this->array_flatten($array);
        }
        //print_r($array1);
        //die('aph');
        $array1 = json_decode(json_encode((array)$array1), TRUE);

        return $array1;
    }

    function ace_record($ACEcompanies, $airport_id, $search_filter)
    {
        global $db;
        $array1 = array();
        $array = array();
        foreach ($ACEcompanies as $ACEcompany) {
            $companyID = explode('FP', $ACEcompany['sku']);
            $company_details = get_records($airport_id, $companyID[1], $search_filter);
            if (empty($company_details)) {
                continue;
            }

            $array['opening_time'] = $company_details['opening_time'];
            $array['closing_time'] = $company_details['closing_time'];
            $array['id'] = $company_details['companyID'];
            $array['companyID'] = $company_details['companyID'];
            $array['sku'] = $ACEcompany['sku'];
            $array['name'] = $company_details['name'];
            $array['processtime'] = $company_details['processtime'];
            $array['cancelable'] = $company_details['cancelable'];
            $array['awards'] = $company_details['awards'];
            $array['featured'] = $company_details['featured'];
            $array['recommended'] = $company_details['recommended'];
            $array['special_features'] = $company_details['special_features'];
            $array['overview'] = $company_details['overview'];
            $array['return_proc'] = $company_details['return_proc'];
            $array['arival'] = $company_details['arival'];
            $array['terms'] = $company_details['terms'];
            $array['address'] = $company_details['address'];
            $array['town'] = $company_details['town'];
            $array['post_code'] = $company_details['post_code'];
            $array['message'] = $company_details['message'];
            $array['parking_type'] = $company_details['parking_type'];
            $array['parking_name'] = $company_details['name'];
            $array['logo'] = $company_details['logo'];
            $array['travel_time'] = $company_details['travel_time'];
            $array['miles_from_airport'] = $company_details['miles_from_airport'];
            $array['editable'] = $company_details['editable'];
            $array['bookingspace'] = $company_details['bookingspace'];
            $array['price'] = $ACEcompany['price'];

            //$array1[] = $array;
            $array1[] = array_flatten($array);
        }
        $array1 = json_decode(json_encode((array)$array1), TRUE);

        return $array1;
    }


    function get_records($a_id, $cid, $search_filter)
    {
        //global $db;
        $details = '';

        if (!empty($cid) && !empty($a_id)) {
            $cid = is_numeric($cid) ? "and fc.id = '" . $cid . "'" : "and fc.aph_id = '" . $cid . "'";

//echo "<br>".$cid."<br>";

            $details = \DB::table('companies as fc')
            ->selectRaw('fc.opening_time,
                fc.closing_time,
                fc.id as companyID,
                fc.aph_id,
                fc.name,
                fc.processtime,
                fc.awards,
                fc.featured,
                fc.recommended,
                fc.special_features,
                fc.overview,
                IF( LENGTH(fc.returnfront) >0,fc.returnfront,fc.return_proc) AS return_proc,
                IF( LENGTH(fc.arivalfront) >0,fc.arivalfront,fc.arival) AS arival,
                fc.terms,
                fc.address,
                fc.town,
                fc.post_code,
                fc.message,
                fc.parking_type,
                fc.logo,
                fc.travel_time,
                fc.miles_from_airport, 
                fc.cancelable, 
                fc.editable, 
                fc.bookingspace')
            ->whereRaw("is_active = 'Yes' and airport_id = '" . $a_id . "' $cid $search_filter")
            //;
            //->get();
            ->first();

            //$sql = str_replace_array('?', $details->getBindings(), $details->toSql()); 
            //dd($sql);

            // $details = DB::select( DB::raw("SELECT 
            //     fc.opening_time,
            //     fc.closing_time,
            //     fc.id as companyID,
            //     fc.aph_id,
            //     fc.name,
            //     fc.processtime,
            //     fc.awards,
            //     fc.featured,
            //     fc.recommended,
            //     fc.special_features,
            //     fc.overview,
            //     IF( LENGTH(fc.returnfront) >0,fc.returnfront,fc.return_proc) AS return_proc,
            //     IF( LENGTH(fc.arivalfront) >0,fc.arivalfront,fc.arival) AS arival,
            //     fc.terms,
            //     fc.address,
            //     fc.town,
            //     fc.post_code,
            //     fc.message,
            //     fc.parking_type,
            //     fc.logo,
            //     fc.travel_time,
            //     fc.miles_from_airport, 
            //     fc.cancelable, 
            //     fc.editable, 
            //     fc.bookingspace
            //     FROM companies as fc WHERE is_active = 'Yes' and airport_id = '" . $a_id . "' $cid $search_filter"
            // ));

        } //end if

        $details = json_decode(json_encode((array)$details), TRUE);
        //$details = $this->array_flatten($details);
        //$details = $details[0];

        return $details;
    }

    function array_flatten($array) {
      if (!is_array($array)) { 
        return FALSE; 
      } 
      $result = array(); 
      foreach ($array as $key => $value) { 
        if (is_array($value)) { 
          $arrayList=array_flatten($value);
          foreach ($arrayList as $listItem) {
            $result[$key] = $listItem; 
          }
        } 
       else { 
        $result[$key] = $value; 
       } 
      } 
      return $result; 
    }
}
?>