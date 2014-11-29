<?php
	include('config.php');
	if($_POST){
		$msgParts = explode(',', $_POST['message']);
		if($msgParts[0] == 'reject'){
			$sql = 'UPDATE transaction SET statusid = 7 WHERE transaction_id = "' . $msgParts[1] . '"';
			mysqli_query($con, $sql) or die(mysqli_error($con));
			echo 'Transaction ID=' . $msgParts[1] . ' has been rejected. Thank you for notifying.';
		}else if($msgParts[0] == 'mytransaction'){
			$sql = 'SELECT status_name FROM status s JOIN transaction t ON t.statusid = s.status_id WHERE t.transaction_id = "' . $msgParts[1] . '"';
			$res = mysqli_query($con, $sql) or die(mysqli_error($con));
			if($res){			
				if(mysqli_num_rows($res)){
					$row = mysqli_fetch_assoc($res);
					echo 'This is an automated response to Your message. The current state of transaction ID=' . $msgParts[1] . ' is: ' . $row['status_name'];
				}
			}
		}else{
			if(count($msgParts) > 2){
				$acc = $msgParts[0];
				$name = $msgParts[1];
				$trid = $msgParts[2];
				$sql = 'SELECT * FROM transaction t JOIN person p ON t.receiverid = p.personID WHERE t.transaction_id = "' . $trid . '" LIMIT 1';
				$res = mysqli_query($con, $sql) or die(mysqli_error($con));
				if($res){
					if(mysqli_num_rows($res)){
						$row = mysqli_fetch_assoc($res);
						if($name == $row['firstname']){
							$sql = 'UPDATE person SET iban = "' . $acc . '" WHERE personID = "' . $row['receiverid'] . '"';
							mysqli_query($con, $sql) or die(mysqli_error($con));
							$sql = 'UPDATE transaction SET statusid = 4 WHERE transaction_id = "' . $trid . '"';
							mysqli_query($con, $sql) or die(mysqli_error($con));
							
							$sql2 = 'SELECT * FROM person WHERE personID = "' . $row['senderid'] .'"';
							$res2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
							if($res2){
								if(mysqli_num_rows($res2)){
									$row2 = mysqli_fetch_assoc($res);
									$data['name'] = $row2['firstname'];
									$data['account'] = $row2['iban'];
									$json['sender']  = $data;					
								}
							}
							$data['name'] = $name;
							$data['iban'] = $acc;
							$json['receiver'] = $data;
							$json['amount'] = $row['amount_sent'];
							$json['currency'] = $row['currency_sent'];
							$encode = json_encode($json);
							echo $encode;
							$curl = curl_init();
							curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1,
							CURLOPT_URL => 'http://challenge.transferwise.com/?teamname=discostix&data='.$encode,
							CURLOPT_USERAGENT => 'DiscoStix SMS Sender'));
							$resp = curl_exec($curl);
							curl_close($curl);
							echo 'Thank you for confirming your bank account number and details. To track your transaction, reply with the key-word and your transaction ID: mytransaction,'.$trid;
						}else{
							echo 'Transaction format error. Please use the form given in the transaction message. Use comma(,) as info separator or check your spelling.';
						}
					}
				}
			}else{
				echo 'Transaction format error. Please use the form given in the transaction message. Use comma(,) as info separator or check your spelling.';
			}
		}
	}

?>