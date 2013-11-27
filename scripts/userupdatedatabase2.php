<?php
	
	require_once('config/database.php');

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); 

	$stmt = $mysqli->prepare("UPDATE `portfolio` SET `quantity` = ? WHERE `name` = ? AND `price` = ?"); 

	$stmt->bind_param("sss", $newQuantity, $name, $oldPrice);

	$successfullyUpdated = $stmt->execute(); 

	$stmt->close();
	
	$mysqli->close();

?>