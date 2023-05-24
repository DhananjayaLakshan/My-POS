<?php

/**
 * database class
 */
class Database
{


	protected function db_connect() //database CONNECTION
	{
		$DBHOST = "localhost";
		$DBNAME = "pos_db";
		$DBUSER = "root";
		$DBPASS = "";
		$DBDRIVER = "mysql";

		try {
			$con = new PDO("$DBDRIVER:host=$DBHOST;dbname=$DBNAME",$DBUSER,$DBPASS);
		} catch (Exception $e) {
			echo $e->getMessage();
		}

		return $con;
	}


	public function query($query,$data=array()) //FETCH DATA FROM DATABASE
	{
		$con = $this->db_connect();
		$smt = $con->prepare($query);
		$check = $smt->execute($data);

		if($check)
		{
			$result = $smt->fetchAll(PDO::FETCH_ASSOC); 
			
			if(is_array($result) && count($result) > 0)
			{
				return $result;
			}
		}

		return false;
	}


}

