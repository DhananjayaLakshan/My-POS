<?php

defined("ABSPATH") ? "":die();

//capture ajax data
$row_data = file_get_contents("php://input");

if (!empty($row_data)) 
{
	$OBJ = json_decode($row_data,true);
	if (is_array($OBJ)) 
	{
		if ($OBJ['data_type'] == "search") 
		{
			$productClass = new Product();
			
			$limit = 20;


			if(!empty($OBJ['text']))
			{
				//search
				$barcode = $OBJ['text'];
				$text = "%".$OBJ['text']."%";
				$query = "SELECT * FROM products WHERE description LIKE :find || barcode = :barcode ORDER BY views DESC LIMIT $limit";
				$rows = $productClass->query($query,['find'=>$text,'barcode'=>$barcode]);
			}else
			{
				//$limit = 10,$offset = 0,$order= "desc",$order_column = "id"
				$rows = $productClass->getAll($limit,0,'desc','views');//get all data from database by query
			}


			if ($rows) //reading from database
			{

				foreach ($rows as $key => $row) {
					$rows[$key]['image'] = crop($row['image']);//get cropped image
					$rows[$key]['description'] = strtoupper($row['description']);//capitalize
				}

				$info['data_type'] = "search"; 
				$info['data'] = $rows; 

				echo json_encode($info);//json data from database
			}

		}else if ($OBJ['data_type'] == "checkout") 
		{
			$data 		= $OBJ['text'];
			$receipt_no 	= get_recipt_no();
			$user_id 	= auth("id");
			$date 		= date("Y-m-d H:i:s");

			//read from database
			$db = new Database();
			foreach ($data as $row) {

				$arr = [];
				$arr['id'] = $row['id'];
				$query = "SELECT * FROM products WHERE id = :id LIMIT 1";
				$check = $db->query($query,$arr);

				if(is_array($check))
				{
					//save to database
					$check = $check[0];
					$arr = [];
					$arr['barcode'] 	= $check['barcode'];
					$arr['receipt_no'] 	= $receipt_no;
					$arr['description'] = $check['description'];
					$arr['amount'] 		= $check['amount'];
					$arr['qty']	 		= $row['qty'];
					$arr['total'] 		= $row['qty'] * $check['amount'];
					$arr['date'] 		= $date;
					$arr['user_id'] 	= $user_id;

					$query = "INSERT INTO sales (barcode,receipt_no,description,qty,amount,total,date,user_id) VALUES (:barcode,:receipt_no,:description,:qty,:amount,:total,:date,:user_id)";

					$db->query($query,$arr);	

					//add views count for this product
					$query = "UPDATE products SET views = views + 1 WHERE id = :id LIMIT 1";

					$db->query($query,['id'=>$check['id']]);
				}

			}

			//id	barcode	recipt_no	description	qty	amount	total	date	user_id
			
			$info['data_type'] = "checkout"; 
			$info['data'] = "Items saved successfully!"; 

			echo json_encode($info);	
		}
	}
}

