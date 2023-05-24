<?php

$errors=[];

if($_SERVER['REQUEST_METHOD'] == "POST")
{

	$user = new User();
	if ($row = $user->where(['email'=>$_POST['email']])) //search by email
	{
		

		if (password_verify($_POST['password'], $row[0]['password'])) //varify hashed password to entered password
		{	
			othenticate($row[0]); //send all user data to function to create SESSION
			redirect('home');
		}else
		{
			$errors['password']="Wrong password";
		}

	}else
	{
		$errors['email']="Wrong email";
	}

}

require views_path('auth/login');