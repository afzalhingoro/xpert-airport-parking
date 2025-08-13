<?php 
namespace App\Library;

class aph_functions{
function  AphBookingPrice($ArrivalDate,$DepartDate,$ArrivalTime,$DepartTime,$aph_company_id,$passenger,$product_code){
	$xml = '<API_Request 
				System="APH"
				Version="1.0"
				Product="CarPark"
				Customer="X"
				Session="000000004"
				RequestCode="3">
				<Agent>
				<ABTANumber>'.config('app.ABTANumber').'</ABTANumber>
				<Password>'.config('app.Password').'</Password>
				<Initials>'.config('app.Initials').'</Initials>
				</Agent>
				<Itinerary>
				<ArrivalDate>'.$ArrivalDate.'</ArrivalDate>
				<DepartDate>'.$DepartDate.'</DepartDate>
				<ArrivalTime>'.$ArrivalTime.'</ArrivalTime>
				<DepartTime>'.$DepartTime.'</DepartTime>
				<CarParkCode>'.$aph_company_id.'</CarParkCode>
				<ProductCode>'.$product_code.'</ProductCode>
				<NumberOfPax>'.$passenger.'</NumberOfPax>
				</Itinerary>
				</API_Request>';
	$response = $this->aph_call($xml);
	$xml_aph = simplexml_load_string($response);
	$xml_aph = json_decode(json_encode((array)$xml_aph));

	//return 50;

	$booking_price = $xml_aph->Pricing->TotalPrice;
	return $booking_price;
}

function AphBookingOrder($data){


		$response = $this->aph_call($data);
          // 	dd($response );

		$xml_aph = simplexml_load_string($response);
		$array  = array();
		foreach($xml_aph as $item){
			$array['BookingRef'] = $xml_aph->Booking->BookingRef;
			$array['ArrivalDate'] = $xml_aph->Itinerary->ArrivalDate;
			$array['DepartDate'] = $xml_aph->Itinerary->DepartDate;
			$array['ArrivalTime'] = $xml_aph->Itinerary->ArrivalTime;
			$array['DepartTime'] = $xml_aph->Itinerary->DepartTime;
			$array['no_of_days'] = $xml_aph->Itinerary->Duration;
			$array['CarParkCode'] = $xml_aph->Itinerary->CarParkCode;
			$array['NumberOfPax'] = $xml_aph->Itinerary->NumberOfPax;
			$array['ReturnFlight'] = $xml_aph->Itinerary->ReturnFlight;
			$array['DepTerminal'] = $xml_aph->Itinerary->DepTerminal;
			$array['OutFlight'] = $xml_aph->Itinerary->OutFlight;
			$array['RetTerminal'] = $xml_aph->Itinerary->RetTerminal;
			$array['CarReg'] = $xml_aph->CarDetails->CarReg;
			$array['CarMake'] = $xml_aph->CarDetails->CarMake;
			$array['CarModel'] = $xml_aph->CarDetails->CarModel;
			$array['CarColour'] = $xml_aph->CarDetails->CarColour;
			$array['Title'] = $xml_aph->ClientDetails->Title;
			$array['Initial'] = $xml_aph->ClientDetails->Initial;
			$array['Surname'] = $xml_aph->ClientDetails->Surname;
			$array['Telephone1'] = $xml_aph->ClientDetails->Telephone1;
			$array['Telephone2'] = $xml_aph->ClientDetails->Telephone2;
		}
		$array = json_decode(json_encode((array)$array), TRUE);
		$array = $this->array_flatten($array);
		return $array;
}

function AphBooking($data){


	$response = $this->aph_call($data);

	$xml_aph = simplexml_load_string($response);
	$array  = array();
	
	foreach($xml_aph->CarPark as $key=>$item){

		/*
		if(!preg_match('/aph/',strtolower($item->CarParkName)) && !preg_match('/silver zone/',strtolower($item->CarParkName)) && !preg_match('/bristol long/',strtolower($item->CarParkName))){
			unset($item);
		}
		*/

		//if(!empty($item)){
		if(isset($item)){
			$nested = array();
			//$urls = "http://test.parking-quote.co.uk/APH_XML/carparkInfoXML.asp?product_code=".$item->ProductCode;
			//$urls = "http://agents.aph.com/APH_XML/carparkInfoXML.asp?product_code=".$item->CarParkCode."_".$item->ProductCode;
			//$urls = "http://agents.aph.com/APH_XML/carparkInfoXML.asp?product_code=".$item->ProductCode;
			//$urls = "https://test-agents.aph.com/APH_XML/carparkInfoXML.asp?product_code=".$item->CarParkCode."_".$item->ProductCode;
			$urls = config('app.aphurldetails')."?product_code=".$item->CarParkCode."_".$item->ProductCode;
			//agents.aph.com/APH_XML/carparkInfoXML.asp
			$urls = "agents.aph.com/APH_XML/carparkInfoXML.asp?product_code=".$item->CarParkCode."_".$item->ProductCode;
			$datas = $this->get_aph_data($urls);
			$prod_info = simplexml_load_string($datas, null, LIBXML_NOCDATA);
			file_put_contents("array_aph_products.txt","Req: ".date('Y-m-d H:i:s')."\r\n".print_r($prod_info,true),FILE_APPEND);
			if(count($prod_info)){
				$nested['companyID'] = $item->CarParkCode;
				$nested['aph_id'] = $item->CarParkCode;
				$nested['name'] = $item->CarParkName;
				$nested['ProductCode'] = $item->ProductCode;
				$nested['parking_type'] = $item->ProductName;
				$nested['no_of_days'] = $item->Duration;
				$nested['price'] = $item->TotalPrice;
				$nested['Terminals'] = $item->Terminals;
					foreach($prod_info->Product_Code as $info){
						$nested['desc1'] = $info->Car_Park_Type;
						$nested['desc2'] = $info->Car_Park_Summary;
						$nested['direction'] = $info->Directions;
						$nested['desc3'] = $info->Reason_To_Buy;
						$nested['miles_from_airport'] = $info->Distance_From_Airport;
						$nested['travel_time'] = $info->Transfer_To_Airport;
						//$nested['Reason_To_Buy'] = $info->Reason_To_Buy;
						$nested['arival'] = $info->Arrival_Process;
						$nested['return_proc'] = $info->Departure_Process;
						$nested['Directions'] = $info->Directions;
						$nested['awards'] = $info->Parkmark_Award;	
					}
					$nested = json_decode(json_encode((array)$nested), TRUE);					

					//$nested = array_flatten($nested);
					//$array[] = array_flatten($nested);

					$nested = $this->array_flatten($nested);
					$array[] = $this->array_flatten($nested);
			}
		}//
	}
	//file_put_contents("array_aph_companies.txt","Req: ".date('Y-m-d H:i:s')."\r\n".print_r($array,true),FILE_APPEND);
	return $array;
}

function aph_call($data) {
	//$url = "http://test.parking-quote.co.uk/xmlapi/aphxml.ASP";
	//$url = "http://agents.aph.com/xmlapi/aphxml.ASP";
	//$url = "https://test-agents.aph.com/xmlapi/aphxml.ASP";
	$url = config('app.aphurl');
	set_time_limit(120);
	$output = array();
	$curlSession = curl_init();
	curl_setopt($curlSession, CURLOPT_URL, $url);
	curl_setopt($curlSession, CURLOPT_HEADER, 0);
	curl_setopt($curlSession, CURLOPT_POST, 1);
	curl_setopt($curlSession, CURLOPT_POSTFIELDS, "Request=".$data);
	curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curlSession, CURLOPT_TIMEOUT, 60);
	#$response = split(chr(10),curl_exec ($curlSession));
	$response = curl_exec($curlSession);
	if(curl_errno($curlSession)) {
		print curl_error($curlSession);  
	}
	curl_close($curlSession);

	file_put_contents("amir_aph_response.txt","Req: ".date('Y-m-d H:i:s')."\r\n".$data." RES: \r\n".date('Y-m-d H:i:s')."\r\n".$response."\r\n\r\n",FILE_APPEND);

// 	$response = '<API_Reply 	
// 					System="APH"
// 					Version="1.0"
// 					Product="CarPark"
// 					Customer="A"
// 					Session="000000003"
// 					RequestCode="11"
// 					Result="OK">

// 						<CarPark c="1">
// 							<CarParkCode>LGW8</CarParkCode>
// 							<CarParkName>Meet + Greet LGW8</CarParkName>
// 							<ProductCode>LGWP</ProductCode>
// 							<ProductName>Meet and Greet Return</ProductName>
// 							<Duration>8</Duration>
// 							<TotalPrice>81.00</TotalPrice>
// 							<GatePrice>85.00</GatePrice>
// 							<Commission>8.5</Commission>
// 							<Terminals>N,S,</Terminals>
// 						</CarPark>

// 						<CarPark c="2">
// 							<CarParkCode>LGW8</CarParkCode>
// 							<CarParkName>Meet + Greet LGW8</CarParkName>
// 							<ProductCode>LGWQ</ProductCode>
// 							<ProductName>Meet and Greet Early Bird</ProductName>
// 							<Duration>8</Duration>
// 							<TotalPrice>52.80</TotalPrice>
// 							<GatePrice>56.80</GatePrice>
// 							<Commission>5.68</Commission>
// 							<Terminals>N,S,</Terminals>

// 						</CarPark>


// 				</API_Reply>
// ';

	return $response;
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

function get_aph_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);

	file_put_contents("detail_aph_response.txt","Req2: ".date('Y-m-d H:i:s')."\r\n".$url." RES2: \r\n".date('Y-m-d H:i:s')."\r\n".$data."\r\n\r\n",FILE_APPEND);


	return $data;
}}
?>