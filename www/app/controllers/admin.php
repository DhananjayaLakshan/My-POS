<?php

$tab = $_GET['tab'] ?? 'dashboard';


if($tab == "products")
{
	$productClass = new Product();
	$products = $productClass->query("SELECT * FROM products ORDER BY id DESC");
}


else if($tab == "users")
{
	$limit = 10;
	$pager = new Pager($limit);
	$offset = $pager->offset;

	$usersClass = new User();
	$users = $usersClass->query("SELECT * FROM users ORDER BY id DESC LIMIT $limit offset $offset");
}


else if($tab == "sales")
{
	$section 	= $_GET['s'] ?? 'table';
	$startdate 	= $_GET['start'] ?? null;
	$enddate 	= $_GET['end'] ?? null;

	$salesClass = new Sale();

	//set pagination
	$limit = $_GET['limit'] ?? 10;
	$limit = (int)$limit;
	$limit = $limit < 1 ? 10 : $limit;
	
	$pager = new Pager($limit);
	$offset = $pager->offset;

	$query = "SELECT * FROM sales ORDER BY id DESC LIMIT $limit offset $offset";

	//get today's sales total
	$year 	= date("Y");
	$month 	= date("m");
	$day 	= date("d");

	$query_total = "SELECT SUM(total) as total FROM sales WHERE day(date) = $day && month(date) = $month && year(date) = $year";


	if ($startdate && $enddate)//find records by DATE if both start and end dates are set
	{	
		$stYear 	= date("Y",strtotime($startdate));
		$stMonth 	= date("m",strtotime($startdate));
		$stDay 		= date("d",strtotime($startdate));

		$endYear 	= date("Y",strtotime($enddate));
		$endMonth 	= date("m",strtotime($enddate));
		$endDay 	= date("d",strtotime($enddate));

		$query = "SELECT * FROM sales WHERE (year(date) >= '$stYear' && month(date) >= '$stMonth' && day(date) >= '$stDay') && (year(date) <= '$endYear' && month(date) <= '$endMonth' && day(date) <= '$endDay') ORDER BY id DESC LIMIT $limit offset $offset";
		$query_total = "SELECT SUM(total) as total FROM sales WHERE (year(date) >= '$stYear' && month(date) >= '$stMonth' && day(date) >= '$stDay') && (year(date) <= '$endYear' && month(date) <= '$endMonth' && day(date) <= '$endDay')";

	}else if ($startdate && !$enddate)//find records by DATE if only start date set
	{	
		$stYear 	= date("Y",strtotime($startdate));
		$stMonth 	= date("m",strtotime($startdate));
		$stDay 		= date("d",strtotime($startdate));

		$query = "SELECT * FROM sales WHERE (year(date) = '$stYear' && month(date) = '$stMonth' && day(date) = '$stDay') ORDER BY id DESC LIMIT $limit offset $offset";
		$query_total = "SELECT SUM(total) as total FROM sales WHERE (year(date) = '$stYear' && month(date) = '$stMonth' && day(date) = '$stDay')";

	}

	
	$sales = $salesClass->query($query);


	$st = $salesClass->query($query_total);


	$sales_total = 0;

	if($st)
	{
		$sales_total = $st[0]['total'] ?? 0.00;
	}


	if($section == 'graph')
	{
		//read graph data
		$db = new Database();

		//query this today records
		$today = date('Y-m-d');
		$query = "SELECT total,date FROM sales WHERE DATE(date) = '$today' ";
		$today_records = $db->query($query);

		//query this month records
		$thisMonth 	= date('m');
		$thisYear 	= date('Y');

		$query = "SELECT total,date FROM sales WHERE month(date) = '$thisMonth' && year(date) = '$thisYear' ";
		$thisMonth_records = $db->query($query);
		
		//query this years records
		$query = "SELECT total,date FROM sales WHERE year(date) = '$thisYear' ";
		$thisYear_records = $db->query($query);
		
	}
}else
if($tab == "dashboard")
{
	//get row count 

	$db = new Database();

	$query = "SELECT COUNT(id) AS total FROM users";
	$userCount = $db->query($query);
	$total_users = $userCount[0]['total'];	

	$query = "SELECT COUNT(id) AS total FROM products";
	$productCount = $db->query($query);
	$total_products = $productCount[0]['total'];

	$query = "SELECT SUM(total) AS total FROM sales";
	$saleCount = $db->query($query);
	$total_sales = $saleCount[0]['total'];

}


if(Auth::access('supervisor'))//check it is supervisor
{
	require views_path('admin/admin');

}else{

	Auth::setMessage("You don't have access to the admin page");//if not supervisor send this message to denied page
	require views_path('auth/denied');
}
