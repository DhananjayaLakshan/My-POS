<?php

function show($data)//loading controller files
{
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

function views_path($view)//loading views files
{
	if (file_exists("../app/views/$view.view.php")) 
	{
		return "../app/views/$view.view.php";
	}
	else
	{
		echo "view '$view' not found";
	}
	
}

function esc($str)
{
	return htmlspecialchars($str);
}

function redirect($page)
{
	header("Location: index.php?pg=" .$page);
	die;
}



function set_value($key,$default="")//return values in input fields (singup form)
{
	if(!empty($_POST[$key]))
	{
		return $_POST[$key];
	}

	return $default;
}


function othenticate($row)// Create USER SESSION
{
	$_SESSION['USER'] = $row;
}

function auth($column) //get cloumn whats you want from user array
{
	if(!empty($_SESSION['USER'][$column]))
	{
		return $_SESSION['USER'][$column];
	}

	return "Unknown";
}

function crop($filename,$size = 600,$type = 'product')// image RESIZE
{

	$ext = strtolower(pathinfo($filename,PATHINFO_EXTENSION));


	//$cropped_file = str_replace(".".$ext, "_cropped.".$ext, $filename);
	$cropped_file = preg_replace("/\.$ext$/", "_cropped.".$ext, $filename); //rename file with preg_replace

	//if cropped file already exists
	if (file_exists($cropped_file)) 
	{
		return $cropped_file;
	}

	//if file to be cropped does not exist
	if (!file_exists($filename)) 
	{
		if ($type == "male")
		{
			return 'assets/images/user_male.jpg';

		}else if($type == "female"){

			return 'assets/images/user_female.jpg';

		}else{
			
			return 'assets/images/no_image.jpg';
		}

	}


	//create image resource
	switch ($ext) {
		case 'jpg':
		case 'jpeg':
			$src_image = imagecreatefromjpeg($filename);
			break;
		
		case 'gif':
			$src_image = imagecreatefromgif($filename);
			break;
			
		case 'png':
			$src_image = imagecreatefrompng($filename);
			break;
			
		default:
			return $filename;
			break;
	}

	//assign values
	$dst_x = 0; 
	$dst_y = 0;
	$dst_w = (int)$size;  
	$dst_h = (int)$size;

	$original_width = imagesx($src_image);
	$original_height = imagesy($src_image);

	if ($original_width < $original_height) 
	{
		$src_x = 0;
		$src_y = ($original_height - $original_width) / 2;
		$src_w = $original_width;
		$src_h = $original_width;

	}else
	{
		$src_y = 0;
		$src_x = ($original_width - $original_height) / 2;
		$src_w = $original_height;
		$src_h = $original_height;
		
	}
	
	
	//set cropping param
	$dst_image = imagecreatetruecolor((int)$size, (int)$size);
	
	imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

	//save final image
	switch ($ext) {
		case 'jpg':
		case 'jpeg':
			imagejpeg($dst_image,$cropped_file,90);
			break;
		
		case 'gif':
			imagegif($dst_image,$cropped_file);
			break;
		
		case 'png':
			imagepng($dst_image,$cropped_file);
			break;
			
		default:
			return $filename;
			break;
	}



	imagedestroy($dst_image);
	imagedestroy($src_image);

	return $cropped_file;
}


function get_recipt_no()//get recipt number and genarate new
{
	$num = 1;

	$db = new Database();
	$rows = $db->query("SELECT receipt_no FROM sales ORDER BY id DESC LIMIT 1");

	if (is_array($rows)) {
		$num = (int)$rows[0]['receipt_no'] + 1;
	}

	return $num;
}

function get_date($date)
{
	return date("jS M, Y", strtotime($date));
}

function get_user_by_id($id)
{
	$user = new User();
	return $user->first(['id'=>$id]);
}

function generate_daily_data($records)
{

	$arr = [];

	for ($i=0; $i < 24; $i++) 
	{		

		if (!isset($arr[$i])) {			
			$arr[$i] = 0;
		}		

		foreach ($records as $row) 
		{
			$hour = date('H',strtotime($row['date']));

			if ($hour == $i) 
			{	
				$arr[$i] += $row['total'];
			}			
		}
	}

	return $arr;
}

function generate_monthly_data($records)
{

	$arr = [];

	$total_day = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));

	for ($i=1; $i <= $total_day; $i++) 
	{		

		if (!isset($arr[$i])) {			
			$arr[$i] = 0;
		}		

		foreach ($records as $row) 
		{
			$day = date('d',strtotime($row['date']));

			if ($day == $i) 
			{	
				$arr[$i] += $row['total'];
			}			
		}
	}

	return $arr;
}

function generate_yearly_data($records)
{
	$arr = [];

	$months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];


	for ($i=0; $i < count($months)-1; $i++) 
	{		

		if (!isset($arr[$months[$i]])) {			
			$arr[$months[$i]] = 0;
		}		

		foreach ($records as $row) 
		{
			$month = date('m',strtotime($row['date']));

			if ($month == $i) 
			{	
				$arr[$months[$i]] += $row['total'];
			}			
		}
	}

	return $arr;
}
