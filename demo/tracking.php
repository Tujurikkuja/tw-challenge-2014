<?php
	session_start();
	include('config.php');
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>TransferWise BETA</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
	<link href="dashboard.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
	<?php if(isset($_GET['id'])){
		$sql = 'SELECT * FROM transaction WHERE transaction_id = "' . $_GET['id'] . '" LIMIT 1';
		$res = mysqli_query($con, $sql);
		if($res){
			$row = mysqli_fetch_assoc($res);
			$sql = 'SELECT * FROM person WHERE personID = "' . $row['receiverid'] . '"';
			$res2 = mysqli_query($con, $sql) or die(mysqli_error($con));
			if($res2){
				$receiver = mysqli_fetch_assoc($res2);
				$sql = 'SELECT * FROM person WHERE personID = "' . $row['senderid'] . '"';
				$res3 = mysqli_query($con, $sql) or die(mysqli_error($con));
				if($res3){
					$sender = mysqli_fetch_assoc($res3);
				}
			}
		}
	} ?>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">TransferWise BETA</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.html">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	<div class="container">
      <div class="row">
        <div class="col-sm-3 col-md-3 sidebar">
		<br/><br/>
			<span>Tracking id: <?php echo $row['transaction_id']; ?></span><br/>
			<table>
				<tr>
					<td>Amount:</td>
					<td><?php echo $row['amount_received'] . ' ' . $row['currency_received']; ?></td>
				</tr>
				<tr>
					<td>From:</td>
					<td><?php echo $sender['firstname']; ?></td>
				</tr>
				<tr>
					<td>To:</td>
					<td><?php echo $receiver['phonenr']; ?></td>
				</tr>
				<tr>
					<td>Reference:</td>
					<td></td>
				</tr>
			</table><br/>
			<div id="status" class="row" style="margin-left:15px">
				<input type="checkbox" value="setup" disabled <?php echo (($row['statusid']>=1&&$row['statusid']<=6)?'checked':''); ?>/> Order set-up.</br>
				<input type="checkbox" value="moneyRec" disabled <?php echo (($row['statusid']>=2&&$row['statusid']<=6)?'checked':''); ?>/> Money received.</br>
				<input type="checkbox" value="recipNot" disabled <?php echo (($row['statusid']>=3&&$row['statusid']<=6)?'checked':''); ?>/> Recipient notified.</br>
				<input type="checkbox" value="recipAcc" disabled <?php echo (($row['statusid']>=4&&$row['statusid']<=6)?'checked':''); ?>/> Recipient accepted.</br>
				<input type="checkbox" value="currConv" disabled <?php echo (($row['statusid']>=5&&$row['statusid']<=6)?'checked':''); ?>/> Currency converted.</br>
				<input type="checkbox" value="paymSent" disabled <?php echo ($row['statusid']==6?'checked':''); ?>/> Payment sent out.</br>
				<input type="checkbox" value="paymRej" disabled <?php echo ($row['statusid']==7?'checked':''); ?>/> Payment rejected.</br>
			</div>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<!-- 1 -->
		<div id="Order set-up" <?php echo ($row['statusid'] == 1?'':'style="display:none"'); ?>>		
		<h1 class="page-header">Waiting to receive money</h1>
		If you haven't already, ask your bank to send money to TransferWise<tr/>
			<table>
				<tr>
					<td>Amount:</td>
					<td><?php echo $row['amount_received'] . ' ' . $row['currency_received']; ?></td>
				</tr>				
				<tr>
					<td>To:</td>
					<td>TransferWise</td>
				</tr>
				<tr>
					<td>Account number:</td>
					<td>53640809</td>
				</tr>
				<tr>
					<td>Bank name:</td>
					<td>Barclays, United Kingdom</td>
				</tr>
				<tr>
					<td>Reference:</td>
					<td></td>
				</tr>
			</table>
        </div>
		<!-- 2 -->
		<div id="Money received" <?php echo ($row['statusid'] == 2?'':'style="display:none"'); ?>>
		<h1 class="page-header">Money received, trying to match transactions</h1>
		This might take some time...Or is it already done? Refresh.<tr/>
        </div>
		<!-- 3 -->
		<div id="Recipient notified" <?php echo ($row['statusid'] == 3?'':'style="display:none"'); ?>>
		<h1 class="page-header">Waiting for user to respond to sent SMS</h1>
		If you haven't already, check your phone or ask the recipient to check theirs!<tr/>
			<table>
				<tr>
					<td>Amount:</td>
					<td><?php echo $row['amount_received'] . ' ' . $row['currency_received']; ?></td>
				</tr>				
				<tr>
					<td>To:</td>
					<td><?php echo $receiver['phonenr']; ?></td>
				</tr>
				<tr>
					<td>Reference:</td>
					<td></td>
				</tr>
			</table>
        </div>
		<!-- 4 -->
		<div id="Recipient accepted" <?php echo ($row['statusid'] == 4?'':'style="display:none"'); ?>>
		<h1 class="page-header">Recipient accepted!</h1>
		Waiting for clearance!<tr/>
			<table>
				<tr>
					<td>Amount:</td>
					<td><?php echo $row['amount_received'] . ' ' . $row['currency_received']; ?></td>
				</tr>				
				<tr>
					<td>To:</td>
					<td><?php echo $receiver['phonenr']; ?></td>
				</tr>
				<tr>
					<td>Reference:</td>
					<td></td>
				</tr>
			</table>
        </div>
		
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="import/jquery.min.js"></script>
	<script src="import/jquery.form.js"></script> 
    <script src="bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
