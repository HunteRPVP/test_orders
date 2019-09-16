<?php

error_reporting(E_ERROR | E_PARSE);

require __DIR__ . '/vendor/autoload.php';
use ShopExpress\ApiClient\ApiClient;
use ShopExpress\ApiClient\Response\ApiResponse;

$ApiClient = new ApiClient(
    'lNwzuV_Gb',
    'admin',
    'http://newshop.kupikupi.org/adm/api'
);

$id = $_POST["id"];
$date = $_POST["date"];
$action = $_POST["action"];

if ($action == "next")
{
	$orders = $ApiClient->get("orders",
	    [
	    	limit => 5000,
	        date_from => $date
	    ]
	);

	$orders = $orders->orders;

	for ($i = 0; $i < count($orders); $i++) 
	{
		if ($orders[$i]["created"] == $date)
		{
			if($orders[$i]["order_id"] <= $id || $orders[$i]["order_id"] == 34310) 
			{
				unset($orders[$i]);
				$orders = array_values($orders);
				$i = -1;
			}
		}
		else
			break;
	}
	array_splice($orders, 10);
}

if ($action == "prev")
{
	$orders = $ApiClient->get("orders",
	    [
	    	limit => 5000,
	        date_to => $date
	    ]
	);

	$orders = $orders->orders;

	for ($i = count($orders) - 1; $i >= 0; $i--) 
	{
		if ($orders[$i]["created"] <= $date)
		{
			if($orders[$i]["order_id"] >= $id && $orders[$i]["order_id"] != 101794) 
			{
				unset($orders[$i]);
				$orders = array_values($orders);
				$i = count($orders);
			}
		}
		else
			break;
	}
	$orders = array_slice($orders, -10);
}

 echo json_encode($orders);