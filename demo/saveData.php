<?php
	session_start();
	include('config.php');
	$sql = 'INSERT INTO person (firstname, iban, phonenr, email) VALUES ("' . $_SESSION['sender']['name'] . '", "' . $_SESSION['senderAccount'] . '", "", "' . $_SESSION['sender']['email'] . '")';
	mysqli_query($con, $sql) or die(mysqli_error($con));
	$senderId = mysqli_insert_id($con);
	$sql = 'INSERT INTO person (firstname, iban, phonenr, email) VALUES ("' . $_SESSION['receiver']['name'] . '", "", "' . $_SESSION['receiver']['phone'] . '", "' . $_SESSION['receiver']['email'] . '")';
	mysqli_query($con, $sql) or die(mysqli_error($con));
	$receiverId = mysqli_insert_id($con);
	$sql = 'INSERT INTO transaction (senderid, receiverid, amount_sent, currency_sent, country_sent, amount_received, currency_received, country_received, statusid) VALUES ("' . $senderId . '", "' . $receiverId . '", "' . $_SESSION['amount1'] . '", "' . $_SESSION['curr1'] . '", "' . $_SESSION['fromCountry'] . '", "' . $_SESSION['amount2'] . '", "' . $_SESSION['curr2'] . '", "' . $_SESSION['toCountry'] . '", "2")';
	mysqli_query($con, $sql) or die(mysqli_error($con));
	$transId = mysqli_insert_id($con);
	echo $transId;
?>