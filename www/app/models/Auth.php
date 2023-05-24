<?php

/**
 * authentication class
 */
class Auth
{
	
	public static function get($column) //get cloumn whats you want from user array
	{
		if(!empty($_SESSION['USER'][$column]))
		{
			return $_SESSION['USER'][$column];
		}

		return "Unknown";
	}

	public static function logged_in()//check logged in or not
	{
		

		if(!empty($_SESSION['USER']))
		{
			$db = new Database();

			if ($db->query("SELECT * FROM users WHERE email = :email LIMIT 1",['email'=>$_SESSION['USER']['email']]))
			{
				return true;
			}
		}

		return false;

	}

	public static function access($role)
	{
		//defining who can access where they can access
		$access['admin'] 		= ['admin'];
		$access['supervisor'] 	= ['admin','supervisor'];
		$access['cashier'] 		= ['admin','supervisor','cashier'];
		$access['accountant'] 	= ['admin','accountant'];
		$access['user'] 		= ['admin','supervisor','cashier','user'];

		$myrole = self::get('role');//get currently logged in role

		if(in_array($myrole, $access[$role]))
		{
			return true;
		}

		return false;
	}

	public static function setMessage($message)
	{
		$_SESSION['MESSAGE'] = $message;
	}

	public static function getMessage()
	{
		if (!empty($_SESSION['MESSAGE'])) 
		{
			$message = $_SESSION['MESSAGE'];
			unset($_SESSION['MESSAGE']);
			return $message;
		}
	}





}