<?php 
 

class Dbase {



	var $db_format;
	var $dbLink;
	var $USER_NAME = "";
	var $USER_PWD = "";
	var $DATABASE;
	var $MYSQL_HOST = ""; 
	var $db_selected;
	var $num;
	var $db_prefix="";




  


	  function  __construct($db_nsme=""){		
		$this->USER_NAME = DBUSER;
		$this->USER_PWD = DBPASS;
		if ($db_nsme=="") {
			$this->DATABASE = DATABASE;
		} else {
			$this->DATABASE = $db_nsme;
		}
		$this->MYSQL_HOST = HOST;


		if ($this->connectHost()) {

			if (!($this->connectDB())) {

				exit("There is some problem with Database Connections, please contact Database administrator! <br>".$this->DATABASE);
			}



		} else {

			exit("There is some problem with Database Connections, please contact Database administrator! <br>".$this->MYSQL_HOST);



		}



	} //  end of Admin







	function connectHost() {

		$this->dbLink = mysqli_connect($this->MYSQL_HOST, $this->USER_NAME, $this->USER_PWD);

		if (!$this->dbLink) {

 

			return false;



		}

 
		return true;



	}







	function get_db_name() {



		return $this->DATABASE;



	}







	function set_db_name($db_name) {



		$this->DATABASE = $db_name;



	}



	



	function connectDB() {



		$this->db_selected = mysqli_select_db($this->dbLink,$this->DATABASE);



		if (!$this->db_selected) {



			return false;



		}



		//echo $this->dbLink."<br>".$this->DATABASE; 



		return true;



	}







	function escape($str="")



	{



		return(mysqli_real_escape_string($this->dbLink, $str)); 



	}



	//function insert(array $data, string table)



	function insert($data, $table) {



		if(!is_array($data))



			return(0);



		



		foreach($data as $key => $name) {



				$attribs[]	=	$key;



				$values[]	=	"'" . $this->escape(stripslashes($name)) . "'";



		}	



		$attribs=implode(",", $attribs);



		$values = implode(",", $values);



		$query = "insert into $table ($attribs) values ($values)";



		 $this->sql = $query;



		//$this->log();



		



		if (mysqli_query($this->dbLink,$query)) {



			return mysqli_insert_id($this->dbLink);



		} else {



			$this->error_log();



			return false;



		}



	}







	function insert_ignoreDuplicates($data, $table) {



		if(!is_array($data))



			return(0);



		



		foreach($data as $key => $name) {



			$attribs[]	=	$key;



			$values[]	=	"'" . $this->escape(stripslashes($name)) . "'";



		}	



		$attribs=implode(",", $attribs);



		$values = implode(",", $values);



		$query = "insert into $table ($attribs) values ($values)";



		$this->sql = $query;



		//$this->log();



		@mysqli_query( $this->dbLink,$query);



	}







	function exec_query($query) {



		$this->sql = $query;



		if (mysqli_query( $this->dbLink,$query)) {



			return true;



		} else {



			return false;



		}



		



	



	}



	



	function execute_query($query) {



		$this->sql = $query;



		if ($r = mysqli_query( $this->dbLink,$query)) {



			return $r;



		} else {



			return false;



		}



		



	



	}



	



	function selectIndex($retField, $table, $index, $value) {



		$q = "select $retField as RET from $table Where $index=$value";



		$r = mysqli_query( $this->dbLink,$q);



		$this->sql = $q;



		if (!($r)) {



			$this->error_log();



		}



		$row=mysqli_fetch_object($r);



		if (mysqli_num_rows($r)>0) {



			return $row->RET;



		} else {



			return false;



		}



	}



	/////////////////////////////////////////////////////////////////////////////



	function activitylog($id,$activity)



	{



	



		$userid=$id;



		



		$newactivity=$activity;



		



		$data_activity=array("activityID","uid","act_one","act_two","act_three");



		



		$table_activity="tb_userActivity";



		



		$row_activity=$this->selectSRow($data_activity,$table_activity,"uid=$userid");



		



		



		$actID=$row_activity["activityID"];



		



		$activity2=$row_activity["act_one"];



		



		$activity3=$row_activity["act_two"];



		



		$update_activity=array('act_one'=>$newactivity,'act_two'=>$activity2,'act_three'=>$activity3);







		$update=$this->updateCondition("tb_useractivity","activityID='$actID'",$update_activity);



		



		



		return $update;



		



		



	



	}



	////////////////////////////////////////////////////////////////////////////



	



	//** function select (array $retField, string $table, string $where)



	function select($retField, $table, $where="", $groupby="", $orderby="", $limit="") {



		//echo "";



		$fields = implode(",", $retField);



		if ($where!="") {



			$q = "select $fields from $table WHERE $where";



		} else {



			$q = "select $fields from $table";



		}



		if ($groupby!="") {



			$q .= " GROUP BY $groupby";



		}



		if ($orderby!="") {



			$q .= " ORDER BY $orderby";



		}



		if ($limit!="") {



			$q .= " LIMIT $limit";



		}

 
		//echo "$q";exit;



		$this->sql = $q;



		//$this->log();



		$r = mysqli_query( $this->dbLink,$q);



		$num=mysqli_num_rows($r);



		if (!($r)) {



			$this->error_log();



		}



		$this->num=mysqli_num_rows($r);



		$i=1;



		while ($row=mysqli_fetch_object($r)) {



			$cont[$i] = $row;



			$i++;



		}



		if (mysqli_num_rows($r)>0) {



			



		//	echo print_r($cont);



		//	exit;



			



			return $cont;



		}



		



	}



	



	function countfields($retField, $table, $where="") {



		if(is_array($retField)){



			$fields = implode(",", $retField);



		}else{



			$fields=$retField;



		}



		if ($where!="") {



			$q = "select $fields from $table WHERE $where";



			$this->sql = $q;



			//$this->log();



			$r = mysqli_query( $this->dbLink,$q);



			return mysqli_num_rows($r);



		}



		if ($where=="") {



			$q = "select $fields from $table ";



			$this->sql = $q;



			//$this->log();



			$r = mysqli_query( $this->dbLink,$q);



			return mysqli_num_rows($r);



		}



	}







	function selectfeilds($retField, $table, $where="") {



		if(is_array($retField)){



			$fields = implode(",", $retField);



		}else{



			$fields=$retField;



		}



		if ($where!="") {



			$q = "select $fields from $table WHERE $where";







		$this->sql = $q;



		//$this->log();



		$r = mysqli_query( $this->dbLink,$q);



		if (!($r)) {



			$this->error_log();



		}



		$row=mysqli_fetch_array($r);



		return $row;



		}



	}



	//** function select (array $retField, string $table, string $where)



	function selectAll($table, $where="") {



		$q="SHOW COLUMNS FROM $table";



		$r = mysqli_query( $this->dbLink,$q);



		while ($res=mysqli_fetch_array($r)) { 



			//echo $res[1]."<br>"; 



			if (($res[1]=="timestamp14") || ($res[1]=="datetime")) {



				$retField[]="DATE_FORMAT($res[0], '%d %b %Y at %H:%i:%s') AS $res[0]";



			} else {



				$retField[]=$res[0];



			}



		}



		



		$fields = implode(",", $retField);



		$q = "select $fields from $table $where";



		$this->sql = $q;



		//$this->log();



		$r = mysqli_query( $this->dbLink,$q);



		$num=mysqli_num_rows($r);



		$i=1;



		while ($row=mysqli_fetch_object($r)) {



			$cont[$i] = $row;



			$i++;



		}



		if (mysqli_num_rows($r)>0) {



			return $cont;



		}



	}







	function selectSRow($retField, $table, $where="", $groupby="", $orderby="", $limit="") {



		$fields = implode(",", $retField);



		if ($where!="") {



			$q = "select $fields from $table WHERE $where";



		} else {



			$q = "select $fields from $table";



		}



		if ($groupby!="") {



			$q .= " GROUP BY $groupby";



		}



		if ($orderby!="") {



			$q .= " ORDER BY $orderby";



		}



		if ($limit!="") {



			$q .= " LIMIT $limit";



		}



	$this->sql = $q;



	



		//$this->log();



		//echo $this->DATABASE; exit;



		$r = mysqli_query($this->dbLink,$q);



		$num=@mysqli_num_rows($r);



		if (!($r)) {



			$this->error_log();



		}



		$num=@mysqli_num_rows($r);



		$i=1;



		$cont=array();



		$row=@mysqli_fetch_array($r); 



		$cont = $row;



		$i++;



		return $cont;



	}

	function selectAsso($retField, $table, $where="", $groupby="", $orderby="", $limit="") {



		$fields = implode(",", $retField);



		if ($where!="") {



			$q = "select $fields from $table WHERE $where";



		} else {



			$q = "select $fields from $table";



		}



		if ($groupby!="") {



			$q .= " GROUP BY $groupby";



		}



		if ($orderby!="") {



			$q .= " ORDER BY $orderby";



		}



		if ($limit!="") {



			$q .= " LIMIT $limit";



		}



	$this->sql = $q;



	



		//$this->log();



		//echo $this->DATABASE; exit;



		$r = mysqli_query( $this->dbLink,$q);



		$num=mysqli_num_rows($r);



		if (!($r)) {



			$this->error_log();



		}



		$num=mysqli_num_rows($r);



		$i=1;



		$cont=array();



		$row=mysqli_fetch_assoc($r); 



		$cont = $row;



		$i++;



		return $cont;



	}







	function lastID() {



		return mysqli_insert_id();



	}







	function selectIfExist($retField, $table, $where, $groupby="", $orderby="", $limit="") {



		$fields = implode(",", $retField);



		if ($where!="") {



			$q = "select $fields from $table WHERE $where";



		} else {



			$q = "select $fields from $table";



		}



		if ($groupby!="") {



			$q .= " GROUP BY $groupby";



		}



		if ($orderby!="") {



			$q .= " ORDER BY $orderby";



		}



		if ($limit!="") {



			$q .= " LIMIT $limit";



		}



		//$q = "select $fields from $table $where";



		$this->sql = $q;



		//$this->log();



		$r = mysqli_query( $this->dbLink,$q);



		if (!($r)) {



			$this->error_log();



		}



		$num=mysqli_num_rows($r);



		//echo "query $q result = ".$num."<br><br><br><br>";



		if ($num!=0) {



			return true;



		}



		return false;



	}







	function is_url( $url )	{



		 if ( !( $parts = @parse_url( $url ) ) )



			  return false;



		 else {



		 if ( $parts[scheme] != "http" && $parts[scheme] != "https" && $parts[scheme] != "ftp" && $parts[scheme] != "gopher" )



			  return false;



		 else if ( !eregi( "^[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,3}$", $parts[host], $regs ) )



			  return false;



		 else if ( !eregi( "^([0-9a-z-]|[\_])*$", $parts[user], $regs ) )



			  return false;



		 else if ( !eregi( "^([0-9a-z-]|[\_])*$", $parts[pass], $regs ) )



			  return false;



		 else if ( !eregi( "^[0-9a-z/_\.@~\-]*$", $parts[path], $regs ) )



			  return false;



		 else if ( !eregi( "^[0-9a-z?&=#\,]*$", $parts[query], $regs ) )



			  return false;



		 }



		 return true;



	}



	



	function lib_getmicrotime() { 



		 list($usec, $sec) = explode(" ",microtime()); 



		 return ((float)$usec + (float)$sec); 



  	}







	function log() {



		$fp = fopen("sql.log", "a");



		if(flock($fp, LOCK_EX))



		{



			$sql = str_replace("\n", " ", $this->sql);



			fputs($fp, date("d-m-Y h:i:s")." --> $sql\n");



			flock($fp, LOCK_UN);



		}



		fclose($fp);



	}



	



	function error_log() {



		$fp = fopen("sql_error.log", "a");



		if(flock($fp, LOCK_EX))



		{



			$sql = str_replace("\n", " ", $this->sql);



			fputs($fp, date("d-m-Y h:i:s")." --> $sql\n");



			flock($fp, LOCK_UN);



		}



		fclose($fp);



		



		$strHTML = "<HTML><HEAD><TITLE>MYSQL DEBUG CONSOLE</TITLE></HEAD><BODY>";



		$strHTML .= "<div id='mysqli_error_div'><table width='70%' align='center' border='0' cellspacing='0' cellpadding='0'>";



		$strHTML .="<tr><td width='1%' align='center' bordercolor='#000000' bgcolor='#FF0000'>&nbsp;</td>";



		$strHTML .="<td width='98%' align='center' bordercolor='#000000' bgcolor='#FF0000'><font color=#FFFFFF face='verdana' size='+1'>MySQL DEBUG CONSOLE</font> </td>";



		$strHTML .="<td width='1%' align='center' bordercolor='#000000' bgcolor='#FF0000'>&nbsp;</td></tr>";



		$strHTML .="<tr><td bgcolor='#FF0000'>&nbsp;</td><td>&nbsp;</td><td bgcolor='#FF0000'>&nbsp;</td></tr>";



		$strHTML .="<tr><td bgcolor='#FF0000'>&nbsp;</td><td style='padding-left:10px'><strong>Query:</strong></td><td bgcolor='#FF0000'>&nbsp;</td></tr>";



		$strHTML .="<tr><td bgcolor='#FF0000'>&nbsp;</td><td style='padding-left:20px'>$sql</td><td bgcolor='#FF0000'>&nbsp;</td></tr>";



		$strHTML .="<tr><td bgcolor='#FF0000'>&nbsp;</td><td>&nbsp;</td><td bgcolor='#FF0000'>&nbsp;</td></tr>";



		$strHTML .="<tr><td bgcolor='#FF0000'>&nbsp;</td><td style='padding-left:10px'><strong>Mysql Response:</strong></td><td bgcolor='#FF0000'>&nbsp;</td></tr>";



		$strHTML .="<tr><td bgcolor='#FF0000'>&nbsp;</td><td style='padding-left:20px'>".mysqli_error()."</td><td bgcolor='#FF0000'>&nbsp;</td></tr>";



		$strHTML .="<tr><td bgcolor='#FF0000'>&nbsp;</td><td>&nbsp;</td><td bgcolor='#FF0000'>&nbsp;</td></tr>";



		$strHTML .="<tr><td colspan='3' bgcolor='#FF0000' height='2'></td></tr></table>";



		$strHTML .= "</div></BODY></HTML>";




$strHTML='';


		//echo $strHTML;



	 }







	 function update($table="", $key="",$val="", $arr=array()) {



		if(!is_array($arr))



			return(0);



		



		$sql = array();



		while(list($k,$v) = each($arr))



		{



			$sql[] = "$k='" . $this->escape(stripslashes($v)) . "'";



		}



		



		$query = "UPDATE $table SET " . implode(", ", $sql) . " WHERE $key='$val'";



		$this->sql = $query;



		//$this->log();



		return mysqli_query( $this->dbLink,$query);



	 }







	 function update2($table="", $key="",$val="") {



		$query = "UPDATE $table SET ".$key." WHERE ".$val."";



		$this->sql = $query;



		//$this->log();



		return mysqli_query( $this->dbLink,$query);



	 }







	 function updateCondition($arr=array(), $table="",$cond="" ) {







		if(!is_array($arr))



			return(0);



		



		$sql = array();



		 


foreach ($arr as $k => $v) {
    $sql[] = "$k='" . $this->escape(stripslashes($v))."'";
}
		



		 $query = "UPDATE $table SET " . implode(", ", $sql) . " WHERE $cond";



		//$this->tz = $this->lib_getmicrotime();



		 $this->sql = $query;



//echo $query



		//$this->log();



		return mysqli_query($this->dbLink,$query);



	 }







	function delete( $condition="" , $table="") {



		$query = "DELETE FROM $table WHERE $condition";



		$this->sql = $query;



		//$this->log();



		if (!(mysqli_query( $this->dbLink,$query))) {



			$this->error_log();



			return false;



		} else {



			return true;



		}



	 }







	function deleteAll($table="") {



		$query = "TRUNCATE $table";



		//$this->tz = $this->lib_getmicrotime();



		$this->sql = $query;



		//$this->log();



		if (!(mysqli_query( $this->dbLink,$query))) {



			$this->error_log();



			return false;



		} else {



			return true;



		}



	 }







	function selectRows($table, $where="") {



		$q="SHOW COLUMNS FROM $table";



		$r = mysqli_query( $this->dbLink,$q);



		while ($res=mysqli_fetch_array($r)) { 



			//echo $res[1]."<br>"; 



			if (($res[1]=="timestamp14") || ($res[1]=="datetime")) {



				$retField[]="DATE_FORMAT($res[0], '%d %b %Y at %H:%i:%s') AS $res[0]";



			} else {



				$retField[]=$res[0];



			}



		}



		



		$fields = implode(",", $retField);



		$q = "select $fields from $table $where";



		$this->sql = $q;



		//$this->log();



		$r = mysqli_query( $this->dbLink,$q);



		$num=mysqli_num_rows($r);



		$i=1;



		while ($row=mysqli_fetch_array($r)) {



			$cont[$i] = $row;



			$i++;



		}



		if (mysqli_num_rows($r)>0) {



			return $cont;



		}



	}



	



	function select_array($retField, $table, $where="", $groupby="", $orderby="", $limit="") {



		$fields = implode(",", $retField);



		if ($where!="") {



			$q = "select $fields from $table WHERE $where";



		} else {



			$q = "select $fields from $table";



		}



		if ($groupby!="") {



			$q .= " GROUP BY $groupby";



		}



		if ($orderby!="") {



			$q .= " ORDER BY $orderby";



		}



		if ($limit!="") {



			$q .= " LIMIT $limit";



		}



		//echo "$q";exit;



		$this->sql = $q;



		//$this->log();



		$r = mysqli_query( $this->dbLink,$q);



		if (!($r)) {



			$this->error_log();



		}



		$num=mysqli_num_rows($r);



		$i=1;



		while ($row=mysqli_fetch_array($r)) {



			$cont[$i] = $row;



			$i++;



		}



		if (mysqli_num_rows($r)>0) {



			



		//	echo print_r($cont);



		//	exit;



			



			return $cont;



		}



	}

 
	function redirect($page)



	{



		header("Location:$page");



		echo '<script type="text/javascript">';



		echo '<!--';



		echo 'window.location = "'.$page.'"';



		echo '//-->';



		echo '</script>';



		exit();



	}



	




	function _can($action="",$moduleAction = "")
	{
		
		 //$admin_login = 1; // $_SESSION["admin_id"];
		 
		 if(!isset($_SESSION["admin_id"]))
		{
				$_SESSION["admin_id"]=$_COOKIE["admin_id"];
			}
		
		 $admin_login = $_SESSION['admin_id']  ;
		
		if($admin_login == 1)
		{
			return true;
		}
		else
		{ return true;
		/*
			$actionPerform ="" ;
			if(is_string($action))
			{
				if($action=='add')
					$actionPerform = '1';
				if($action=='edit')
				   $actionPerform = '2';
				if($action=='delete')
					$actionPerform = '3';
				if($action=='view')
					$actionPerform = '4';
				if($action=='send')
					$actionPerform = '5';
				if($action=='block')
					$actionPerform = '6';
				if($action=='edit_tagged')
					$actionPerform = '6';
					
					
				if($actionPerform)
				{
					if($moduleAction == "")
					{
					$moduleAction = mysqli_real_escape_string($this->dbLink, $_GET["action"]);
					}
				
					if(!isset($_SESSION["user_role"]))
						{
								$_SESSION["user_role"]=$_COOKIE["user_role"];
							}
					$getRole = $_SESSION["user_role"];
					
					
					$getModuleId = $this->selectSRow(array("id,associated_id"),PREFIX."modules","action_page = '$moduleAction'");
					
					$module = $getModuleId["id"];
					$associated_id = $getModuleId["associated_id"];
					//echo "!!!";
					if($associated_id!=0)
					$module = $associated_id;
					
					
			
			
					$rolePerMitions = $this->selectSRow(array("id"),PREFIX."user_control_module","roll_id = '$getRole' AND modul_id ='$module' AND control_id LIKE '%$actionPerform%'");
					//echo $this->sql;
					if($rolePerMitions )//|| $associated_id==-1
					{
					return true;
					}
					else
					{
					return false;
					}
				}
			
			}
		*/}
}










	function sendmail($to,$subject,$body,$fromName,$fromEmail){



		



		global $mail;



		



		$mail->IsMail();



		



		$mail->Subject = $subject;



		



		$mail->IsHTML(true);



		



		$mail->Body = $body;



		



		$mail->From=$fromEmail;



		



		$mail->FromName=$fromName;



			



		$mail->AddAddress($email);



		



		if(!$mail->Send())



		{



		 	echo '<div align="center" style="color:#F00"Error sending: ' . $mail->ErrorInfo .'</div>';



			exit;



			return '<div align="center" style="color:#F00"Error sending: ' . $mail->ErrorInfo .'</div>';



		}



		else



		{



			echo 'sent';



			exit;



			return true;



		}



	}



	



function selectAs($select,$tabele,$where=""){



	 echo  mysqli_query($this->dbLink,"SELECT $select  FROM $tabele  WHERE $where");



	 exit;



	 return $getResult ;



	}



	



}



?>