<?php

$errors=[];


if($_SERVER['REQUEST_METHOD'] == "POST")
{

	$product = new Product();
	$_POST['date'] = date("Y-m-d H:i:s");
	$_POST['user_id'] = auth("id");
	$_POST['barcode'] = empty($_POST['barcode']) ? $product->generate_barcode():$_POST['barcode'];

	if(!empty($_FILES['image']['name']))
	{
		$_POST['image'] = $_FILES['image'];
	}	

	$errors = $product->validate($_POST);


	if (empty($errors)) {

		$folder = "uploads/";
		if(!file_exists($folder))
		{
			mkdir($folder,0777,true);
		}

		$ext = strtolower(pathinfo($_POST['image']['name'],PATHINFO_EXTENSION));

		$filename = $_POST['image']['tmp_name'];
		$destination = $folder . $product->generate_filename($ext);
		move_uploaded_file($filename, $destination);

		$_POST['image'] = $destination;//upload image path to database

		$product->insert($_POST);
		
		redirect('admin&tab=products');
	}
}

require views_path('products/product-new');