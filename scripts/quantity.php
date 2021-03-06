<?php

	require_once('config/database.php'); //Login to database

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("SELECT quantity, id FROM `portfolio` WHERE `username` = ? AND `name` = ? AND `price` = ? AND `order` = ? AND `orderprice` = ?"); //Select quantity and id from portfolio

	$stmt->bind_param("sssss", $username, $name, $price, $order, $orderPrice);

	$stmt->execute(); 

	$stmt->bind_result($oldQuantity, $id);
	
	$checkPortfolio = array(); //Fetch and store in array
	while ($stmt->fetch()) {
		$checkPortfolio[$id] = array(
			'quantity' => $oldQuantity,
		);
	}

	foreach($checkPortfolio as $key => $checkKey){ //Get latest quantity
		$oldQuantity = $checkKey['quantity'];
	}

	$isQuantityValid = !empty($oldQuantity); //Quantity is not empty

	$stmt->close();

	$mysqli->close();

	if ($isQuantityValid){ //Make sure quantity is valid
		$oldQuantity = $oldQuantity;
	} else { //Else original quantity the user posted
		$quantity = $quantity;
		$oldQuantity = 0;
	}

?>