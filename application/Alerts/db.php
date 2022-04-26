<?php
//include("/var/www/html/Alerts/database.php");
require_once '/var/www/html/application/Alerts/database.php';

class DB_CONNECT
{
	public $connected = 0;
	public $db_error = "";
	public $con;
	public $result;
	public $row_count = 0;
	public $result_data = array();

	/* destructor */
	public function __destruct() {
		// closing db connection
		if ($this->connected == 1)
		mysqli_close($this->con);
	}

	/*
	* Function to connect with database
	*/
	public function connect() {
		// import database connection variables
		// Connecting to mssql database
		$this->con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
		try {
			if (!$this->con)
			{
				$this->connected = 0;
				$this->message = mysqli_connect_error();
			}
			else
			{
				$this->connected = 1;
				/* Selecting database */
				$db = mysqli_select_db($this->con,DB_DATABASE);
			}
		}
		catch(Exception  $e){
			$response = "Error message: " . $e->getMessage() ;
	    $fp = fopen('logs.txt', 'a');//opens file in append mode
	    fwrite($fp, $response);
	    fclose($fp);
		}
	}

	/*
	* Execute query to read records
	*/
	public function load_records($query)
	{
		//$res = 0;
		$this->con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
		$db = mysqli_select_db($this->con,DB_DATABASE);
		try {
			if ($db)
			{
				$res = mysqli_query($this->con,$query);
				if(!$res)
				{
					//$res = 0;
					$this->result = null;
					$this->message = mysqli_error($this->con);
				}
				else
				{
					//$res = 1;
					$this->result = $res;
					$this->message = null;
				}
				//close the connection//
				mysqli_close($this->con);
			}
			else
			{
				//$res = 0;
				$this->result = null;
				$this->message = "Not connected to database!";
			}
		}
		catch(Exception  $e){
			$response = "Error message: " . $e->getMessage() ;
	    $fp = fopen('logs.txt', 'a');//opens file in append mode
	    fwrite($fp, $response);
	    fclose($fp);
		}
		return $this->result;
	}
	/*
	* Function to close db connection
	*/
	function close() {
		// closing db connection
		if ($this->connected == 1)
		mssql_close();
	}
}
?>
