<?php

$errors=[];

$user = new User();

$id = $_GET['id'] ?? Auth::get('id');
$row = $user->first(['id'=>$id]);//get logged current user 

if($_SERVER['REQUEST_METHOD'] == "POST")
{

	//make sure only admins can make other admins
	if($_POST['role'] == "admin")
	{
		if (!Auth::get('role') == "admin") 
		{
			$_POST['role'] = "user";
		}
	}


	$errors = $user->validate($_POST,$id);

	if(empty($errors))
	{
		if(empty($_POST['password']))//password is set unset the old password not save old password
		{
			unset($_POST['password']);
		}else
		{
			$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);//hashed password
		}

		
		$user->update($id,$_POST);
		
		redirect('admin&tab=users');
	}
}



if(Auth::access('admin') || ($row && $row['id'] == Auth::get('id')))//check it is supervisor
{
	require views_path('auth/profile');

}else{

	Auth::setMessage("Only admin can create users");//if not supervisor send this message to denied page
	require views_path('auth/denied');
}


