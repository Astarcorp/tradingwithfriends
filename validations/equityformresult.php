<?php

$userArriveBySubmittingAForm = !empty($_POST);

$userArriveByClickingOrDirectlyTypeURL = !$userArriveBySubmittingAForm;

if ($userArriveBySubmittingAForm) {

	$nameNotSelected = empty($_POST['name']);
	if ($nameNotSelected) {
		$errors['name'] = "Please select an equity";
	}
	
	$noquantity = empty($_POST['quantity']);
	$quantityNotNumeric = !is_numeric($_POST['quantity']);
	$quantityNotInRange = ($_POST['quantity'] < 0 || $_POST['quantity'] > 100); 

	if ($noquantity) {
		$errors['quantity'] = "Please enter the quantity you wish to purchase";
	} else if ($quantityNotNumeric) {
			$errors['quantity'] = "Quantity entered is not a number";
	} else if ($quantityNotInRange) {
			$errors['quantity'] = "Quantity entered is not logical";
	}
	
	$noErrors = (count($errors) == 0);
	$haveErrors = !$noErrors;

	if ($noErrors) {
		if (!empty($_POST['name'])) {
			$name = $_POST['name'];
		}
		if (!empty($_POST['quantity'])) {
			$quantity = $_POST['quantity'];
		}

	    require 'scripts/equity_price.php';
	  	if ($_POST['name']=="A33.SI"){
	  	$price = $blumont;
	  	}
	  	elseif ($_POST['name']=="P05.SI"){
	  	$price = $pfood;
	  	}
	  	elseif ($_POST['name']=="E5H.SI"){
	  	$price = $goldenagr;
	  	}
	  	elseif ($_POST['name']=="557.SI"){
	  	$price = $viking;
	  	}
	  	elseif ($_POST['name']=="N21.SI"){
	  	$price = $noble;
	  	}
	  	elseif ($_POST['name']=="5WH.SI"){
	  	$price = $rex;
	  	}
		elseif ($_POST['name']=="MT1.SI"){
	  	$price = $dragon;
	  	}
		elseif ($_POST['name']=="A78.SI"){
	  	$price = $liongold;
	  	}
		elseif ($_POST['name']=="Z74.SI"){
	  	$price = $singtel;
	  	}
		elseif ($_POST['name']=="5MM.SI"){
	  	$price = $skyone;
	  	}
	  	else{
	  	$price = "";
	  	}
	}
}

?>