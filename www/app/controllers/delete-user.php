<?php

$errors=[];

$user = new User();

$id = $_GET['id'] ?? null;
$row = $user->first(['id'=>$id]);

if($_SERVER['REQUEST_METHOD'] == "POST")
{


	if(is_array($row) && Auth::access('admin') && $row['deletable'])//check it is admin
	{
		$user->delete($id);		
		redirect('admin&tab=users');
	}

}



if(Auth::access('admin'))//check it is admin
{
	require views_path('auth/delete-user');

}else{

	Auth::setMessage("Only admin can delete users");//if not admin send this message to denied page
	require views_path('auth/denied');
}


