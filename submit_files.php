<!DOCTYPE HTML>  
<html>
	<head>
	</head>
	<body>  

	<?php
	$barcode = "";
	$press = "7000";
	$bleed = "Yes";
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
		$barcode = test_input($_POST["barcode"]);
		}

	function test_input($data) 
		{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		}
	?>

	<h2>Blooming Color Submit Files to Indigo</h2>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
	  Barcode: <input type="text" name="barcode">
	  <br><br>
	</form>

	<?php

	$dbServer = "localhost"; //local server
//	$dbServer = "192.9.200.95"; //remote server
	$dbUser = "netuser"; //local user
//	$dbUser = "remuser"; //remote user
	$dbPass = "netuser"; //local password
//	$dbPass = "remuser"; //remote password
	$dbName = "bcproduction";
	
	$query = "SELECT * FROM jobtickets WHERE barcode = '".$barcode."'";
	$conn = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);
	if (!$conn) 
		{
		die("<i>Connection failed: </i>" . mysqli_connect_error());
		echo "\n";
		} 
	echo "<i>Found Job Ticket Database</i>";
	echo "<br><br>";
	
	$result = mysqli_query($conn, $query);
	$result->data_seek(0);
	$row = $result->fetch_assoc();
	
	if ($row['barcode'] == "")
		{
		echo "Job Ticket Not Found!";
		echo "<br><br>";
		}

	mysqli_free_result($result);	
	mysqli_close($conn);
	echo "<h4>Job Ticket Specs:</h4>";
	?>
	
<!-- need to add tumble, jog, jog offset, bleed -->	
	<form method="post" action="send_to_press.php">  
	  Press:
	  <input type="radio" name="press" value="7000">7000 
	  <input type="radio" name="press" value="7600">7600 
	  <input type="radio" name="press" value="10000">10000 
	  <br>
	  Apply changes to: <input type="text" name="jobnumber" value="<?php echo $row['jobnumber'].'-'.$row['subjob']; ?>"> ... <input type="text" name="barcode" value="<?php echo $row['barcode']; ?>">
	  <br>
	  Order Quantity:
	  <input type="text" name="orderquant" value="<?php echo $row['orderquant']; ?>">
	  <br>
	  Print Quantity: <input type="text" name="printquant" value="<?php echo $row['printquant']; ?>">
	  <br>
	  Device: <input type="text" name="device" size='30' value="<?php echo $row['device']; ?>">
	  <br>
	  Stock: <input type="text" name="substrate" size='40' value="<?php echo $row['substrate']; ?>">
	  <br>
	  Press Sheet: <input type="text" name="sheetsizex" value="<?php echo $row['sheetsizex']; ?>"> x <input type="text" name="sheetsizey" value="<?php echo $row['sheetsizey']; ?>">
	  <br>
	  Trim Size: <input type="text" name="trimsizex" value="<?php echo $row['trimsizex']; ?>"> x <input type="text" name="trimsizey" value="<?php echo $row['trimsizey']; ?>">
	  <br>
	  Per Sheet: <input type="text" name="persheet" value="<?php echo $row['persheet']; ?>">
	  <br>
	  Sides: <input type="text" name="sides" value="<?php echo $row['sides']; ?>">
	  <br>
	  Bleed: <input type="radio" name="bleed" value="Yes">Yes <input type="radio" name="bleed" value="No">No
	  <br>
	  <input type="submit" name="submit" value="Submit">
	  <br>  
	</form>
	
	<p><i>Copyright 2017, Blooming Color, </i>Відділ Технології.</p>
	</body>
</html>