<?php 

	require_once('config/database.php'); //Login to database

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("SELECT * FROM `portfolio` WHERE `username` = ?"); //Select all from portfolio

	$stmt->bind_param("s", $username);

	$stmt->execute(); 

	$stmt->bind_result($username, $name, $quantity, $price, $total, $cash, $id, $order, $orderPrice);

	$portfolioEquities = array(); //Fetch and store in array
	while ($stmt->fetch()) {
		$portfolioEquities[$id] = array(
			'id' => $id,
			'name' => $name,
			'quantity' => $quantity,
			'price' => $price,
			'order' => $order,
			'orderprice' => $orderPrice
		);
	}

	$stmt->close();

	$mysqli->close();

?>

<table>
	<?php foreach($portfolioEquities as $key => $portfolioEquity) : ?>

    <?php 
  		$id = $portfolioEquity['id'];
		$name = $portfolioEquity['name'];
    	$quantity = $portfolioEquity['quantity'];
    	$price = $portfolioEquity['price'];
    	$order = $portfolioEquity['order'];
    	$orderPrice = $portfolioEquity['orderprice'];
    ?>

	<tr>
		<td>
			<b>ID:</b> <?php echo $id; ?>
			<b>,</b> You owned <?php echo $quantity; ?> <?php echo $name; ?>
			at <?php echo $price; ?>
			<b>,</b> with a <?php echo $order; ?>
			order at <?php echo $orderPrice; ?>.
		</td>
  	</tr>
  	<?php endforeach; ?>
</table>