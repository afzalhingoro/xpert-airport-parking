 <?php

    require_once "common/config.php";
    require_once "../PlancakeEmailParser.php";

    ini_set("max_execution_time", "0");

    $emails = glob(
        "../../../../mail/manchesterairportspaces.co.uk/agentbooking/new/*"
    );

    if (empty($emails)) {
        $emails = glob(
            "../../../../mail/manchesterairportspaces.co.uk/agentbooking/cor1/*"
        );
        rsort($emails);
    }

    echo "<br>";

    foreach ($emails as $email)
        $cron_start_time = date("Y-m-d H:i:s");  
    $emailParser = new PlancakeEmailParser(file_get_contents($email));

    $to_arr = $emailParser->getTo();
    $to = $to_arr[0];



    $from_arr = $emailParser->getFrom();
    $from = $from_arr[0];

    $sender_email = '';
    if (preg_match('/<(.+?)>/', $from, $matches)) {
        $sender_email = $matches[1];
    } else {
        $sender_email = $from;
    }

    $subject = $emailParser->getSubject();

    $subject = htmlentities($subject);


    $date_time = $emailParser->getHeader('Date');

    if ($date_time) {
        $date = DateTime::createFromFormat('D, d M Y H:i:s O', $date_time);

        if ($date) {
            $date_time = $date->format('Y-m-d H:i:s');
        } else {
            $date_time = date('Y-m-d H:i:s');
        }

    } else {
        $date_time = date('Y-m-d H:i:s');
    }


    $body = $emailParser->getHTMLBody();



    $body = mb_convert_encoding($body, "UTF-8", "ISO-8859-1");
   
   
      

    $body = str_replace("Â", "", $body);
    $body_data=json_encode($body);
    $get_email_data=$db->selectSRow(array('*'),"parsed_emails_data","email_subject='$subject'");
    if($get_email_data){
        echo "already exist";
        exit;
    }else{
        $array_data=array(
            'email_to'=>$to,
            'email_from'=>$sender_email,
            'email_subject'=>$subject,
            'email_body'=>$body_data,
            'picked'=>0,
            'email_status'=>0,
            'completed'=>0,
            'booking_date'=>$date_time 
           );
    
           $parsed_data=$db->insert($array_data,"parsed_emails_data");
           
           if($parsed_data){
            echo "saved successfuly";
           }else{
            echo "not saved";
           }
    
    
    }
    




