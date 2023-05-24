<?php

$errors=[];

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$user = new User();
	$_POST['role'] = "user";
	$_POST['date'] = date("Y-m-d H:i:s");

	$errors = $user->validate($_POST);

	if(empty($errors))
	{

		$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);//hashed password

		$user->insert($_POST,"users");
		
		redirect('admin&tab=users');
	}
}



if(Auth::access('admin'))//check it is supervisor
{
	require views_path('auth/signup');

}else{

	Auth::setMessage("Only admin can create users");//if not supervisor send this message to denied page
	require views_path('auth/denied');
}


