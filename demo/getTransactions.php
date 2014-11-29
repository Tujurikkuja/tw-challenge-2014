<?php
	include('config.php');
	$sql = 'SELECT * FROM transaction t JOIN person p ON t.receiverid = p.personID WHERE p.phonenr = "' . $_POST['phone'] . '" AND t.statusid = 2 LIMIT 1';
	$res = mysqli_query($con, $sql) or die(mysqli_error($con));
	if($res){
		if(mysqli_num_rows($res)){
			$row = mysqli_fetch_assoc($res);
			echo 'You have incoming transaction from Transferwise. To confirm transaction reply with Your (bank account, full name) or (Transferwise username) and transaction ID.';
			echo 'Transaction ID = ' . $row['transaction_id'] . ', amount = ' . $row['amount_received'] . $row['currency_received'] . '. Confirmation-example:EExxx,John Smith,' . $row['transaction_id'] . '. To reject, reply: reject,' . $row['transaction_id'];
			$sql = 'UPDATE transaction SET statusid = 3 WHERE transaction_id = "' . $row['transaction_id'] . '"';
			mysqli_query($con, $sql) or die(mysqli_error($con));
		}
	}
?>