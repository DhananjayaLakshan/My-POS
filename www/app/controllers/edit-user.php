<?php

$errors=[];

$user = new User();

$id = $_GET['id'] ?? null;
$row = $user->first(['id'=>$id]);

if(!empty($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "edit-user"))
{ 
	$_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{

	//make sure only admins can make other admins
	if(isset($_POST['role']) && $_POST['role'] != $row['role'])
	{
		if (Auth::get('role') != "admin") 
		{
			$_POST['role'] = $row['role'];
		}
	}

	if(!empty($_FILES['image']['name']))//user profile picture upload
	{
		$_POST['image'] = $_FILES['image'];
	}	


	$errors = $user->validate($_POST,$id);

	if(empty($errors))
	{

		$folder = "uploads/";// create folder
		if(!file_exists($folder))
		{
			mkdir($folder,0777,true);
		}

		if(!empty($_POST['image']))
		{

			$ext = strtolower(pathinfo($_POST['image']['name'],PATHINFO_EXTENSION));

			$product = new Product();

			$filename = $_POST['image']['tmp_name'];
			$destination = $folder . $product->generate_filename($ext);
			move_uploaded_file($filename, $destination);

			$_POST['image'] = $destination;//upload image path to database

			//delete old image
			if (file_exists($row['image'])) {
				unlink($row['image']);
			}
		}


		if(empty($_POST['password']))//password is set unset the old password not save old password
		{
			unset($_POST['password']);
		}else
		{
			$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);//hashed password
		}


		
		$user->update($id,$_POST);
		
		redirect("edit-user&id=$id");
	}
}



if(Auth::access('admin') || ($row && $row['id'] == Auth::get('id')))//check it is supervisor
{
	require views_path('auth/edit-user');

}else{

	Auth::setMessage("Only admin can create users");//if not supervisor send this message to denied page
	require views_path('auth/denied');
}


