<?php
class DB
{
	var $conn;
	var $prefix;
	
	public function __constructor()
	{
		return $this;
	}
	
	public function init($host, $user, $pass, $dbname, $table_prefix = '')
	{
		//$this->conn = mysql_pconnect($host, $user, $pass) or $this->db_die();
		$this->conn = new mysqli($host, $user, $pass, $dbname);
		if($this->conn->connect_errno)
		{
			echo "Failed to connect to MySQL: (" . $this->conn->connect_errno . ") " . $this->conn->connect_error;
		}
		$this->prefix = $table_prefix;
		$this->makeTableVariables($dbname, $table_prefix);
	}
	
	public function insert($insert_query)
	{
		$this->conn->query($insert_query) or $this->db_die($insert_query);
		return $this->conn->insert_id;
	}
	
	public function update($update_query)
	{
		$this->conn->query($update_query) or $this->db_die($update_query);
		return $this->conn->affected_rows;
	}
	
	public function select($select_query)
	{
		if ($run = $this->conn->query($select_query)) {
			$output = array();
			$i = 0;
			while($row = $run->fetch_assoc())
			{
				$output[$i] = DB::arraymap($row, 'stripslash');
				$i++;
			}
				
			return count($output) > 0 ? $output : false;
		} else {
			echo "Table creation failed: (" . $this->conn->errno . ") " . $this->conn->error;
		}
	}
	
	public function count_row($select_query)
	{
		$output = $this->conn->query($select_query) or DB::db_die($select_query);
		$output = $output->num_rows;
			
		return count($output) > 0 ? $output : false;
	}
	
	public function query($query)
	{
		$run = $this->conn->query($query) or DB::db_die($query);
		return $run;
	}
	
	public function get_row($query)
	{
		$run = $this->conn->query($query) or DB::db_die($query);
		$output = array();
		$rows = $run->num_rows;
		$row = $run->fetch_assoc();
		
		return $rows > 0 ? $row = DB::arraymap($row, 'stripslash') : false;
	}
	
	public function mysqlDateFormat($date, $separator = "/", $input_date_format = "M/D/Y")
	{
		if(isset($date) && !empty($date) && !empty($separator) && !empty($input_date_format))
		{
			$date_format = explode($separator,strtoupper(strtolower($input_date_format)));
			if(count($date_format) == 3)
			{
				$date = explode($separator,$date);
				
				${"date" . $date_format[0]} = intval($date[0]);
				${"date" . $date_format[1]} = intval($date[1]);
				${"date" . $date_format[2]} = intval($date[2]);
				
				$date = date('Y-m-d', mktime(0,0,0, $dateM, $dateD, $dateY));
			}
			else
				$date = 'Invalid Date Format';
		}
		else
			$date = '';
			
		return $date;
	}
	
	public function php_now()
	{
		return date('Y-m-d H:i:s');
	}
	
	public function mysql_now()
	{
		$now = $this->get_row("SELECT NOW() AS `now` ");
		return $now['now'];
	}
	
	public function USDateFormat($date, $time = false)
	{
		return (!empty($date) && ($date != "0000-00-00".($time?" 00:00:00":"") && $date != "0000-00-00 00:00:00") ? date('m/d/Y'.($time?" h:i A":""), strtotime($date)) : "");
	}
	
	public function mysqlLike($column, $value)
	{
		$qry = "";
		return $qry .= "($column LIKE '%" . $value . "%' OR $column LIKE '%" . $value . "' OR $column LIKE '" . $value . "%')";
	}
	
	private function get_resource($query)
	{
		$run = $this->conn->query($query) or $this->db_die($query);
		return $run;
	}
	
	private function db_die($query="")
	{
		if(!empty($query))
		{
			echo "<b>Query: </b>" . $query . "<br />";
		}

		die("<b>Error: </b> (" . $this->conn->errno . ") " . $this->conn->error);
	}
	
	private function makeTableVariables($dbname, $table_prefix)
	{
		$this->conn->query("USE $dbname ");
		$mysql_tables = $this->select("SHOW TABLES ");		
		if($mysql_tables != false)
		{
			foreach($mysql_tables as $value)
			{
				foreach($value as $table)
				{
					continue;
				}
			}
		}
	}
	
	private function createTableFunctions($func, $table)
	{
		$result = $this->get_resource("SELECT * FROM $table WHERE 1 LIMIT 1");
		$fields = $result->field_count;
		$primaryField = "";
		for($i = 0; $i < $fields; $i++)
		{
			$flags = $result->fetch_field_direct($i)->flags;
			if((MYSQLI_PRI_KEY_FLAG & $flags) == 2 || ($flags & MYSQLI_AUTO_INCREMENT_FLAG) == 512 || ($flags & MYSQLI_UNIQUE_KEY_FLAG) == 4)
			{
				$primaryField = $result->fetch_field_direct($i)->name;
			}
		}
		if(!empty($primaryField))
		{
			$funName = 'get_'.$func;
			$this->$funName = function($prField) use ($table, $primaryField){
				if ($prField[0] == 0) {
					return $this->select("SELECT * FROM ".$table." WHERE 1 ");
				}
				else{
					return $this->get_row("SELECT * FROM ".$table." WHERE ".$primaryField." = '" . $prField[0] . "'");
				}
			};
		}
	}
	
	public function get_table($table, $where)
	{
		return DB::select("SELECT * FROM ".$this->prefix.$table." ".($where!=""?$where:""));
	}
	
	public function __call($method, $arguments)
	{
		$func = $this->{$method};
		return $func($arguments);
	}
	
	public function real_escape($string)
	{
		return $this->conn->real_escape_string($string);
	}
	
	public function escape($string)
	{
		return $this->conn->escape_string($string);
	}
	
	public function addslash($v)
	{
		return is_array($v) ? $this->arraymap($v, 'addslash') : addslashes($v);
	}
	
	public function stripslash($v)
	{
		return is_array($v) ? $this->arraymap($v, 'stripslash') : stripslashes($v);
	}
	
	public function arraymap($array,$type = 'addslash')
	{
		return array_map(array('DB', $type), $array);
	}
	
	public function dump($output)
	{
		echo '<pre>'; print_r($output); echo '</pre>';
	}
	
}
?>