<?php 

require_once('config/database.php');

$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); 

$stmt = $mysqli->prepare("SELECT * FROM `history` WHERE username = ?"); 

$stmt->bind_param("s", $username);

$stmt->execute(); 

$stmt->bind_result($username, $name, $quantity, $price, $total, $cash, $id);

$historyEquities = array();
while ($stmt->fetch()) {
	$historyEquities[$id] = array(
		'name' => $name,
		'quantity' => $quantity,
		'price' => $price,
		'total' => $total,
		'cash' => $cash
	);
}

$stmt->close();

$mysqli->close();

?>

<table>
  <?php foreach($historyEquities as $key => $historyEquity) : ?>

  <?php 
	$name = $historyEquity['name'];
    $quantity = $historyEquity['quantity'];
    $price = $historyEquity['price'];
    $total = $historyEquity['total'];
    $cash = $historyEquity['cash'];
  ?>
  
  <tr>
	<td>
		<b>Symbol:</b> <?php echo $name; ?> </br>
	</td>
	<td>
		<b>Quantity:</b> <?php echo $quantity; ?> </br>
	</td>
	<td>
		<b>Last Trade:</b> <?php echo $price; ?> </br>
	</td>
	<td>
		<b>Total:</b> <?php echo $total; ?> </br>
	</td>
	<td>
		<b>Cash Left:</b> <?php echo $cash; ?> </br>
	</td>
  </tr>
  <?php endforeach; ?>

</table>