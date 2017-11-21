<?php
	
	$xmlInput = $argv[1];
//	$dbServer = "localhost"; //local server
	$dbServer = "192.9.200.95"; //remote server
//	$dbUser = "netuser"; //local user
	$dbUser = "remuser"; //remote user
//	$dbPass = "netuser"; //local password
	$dbPass = "remuser"; //remote password
	$dbName = "bcproduction";
	
	$xmlData = simplexml_load_file($xmlInput);
	$barcode = $xmlData->JobBarcode->__toString();
	$jobnumber = $xmlData->JobNumber->__toString();
	$subjob = $xmlData->SubJobNumber->__toString();
	$source = $xmlData->SourceNumber->__toString();
	$customer = $xmlData->Customer->__toString();
	$contact = $xmlData->Contact->__toString();
	$contphone = $xmlData->ContPhone->__toString();
	$contemail = $xmlData->ContEmail->__toString();
	$salesrep = $xmlData->SalesRep->__toString();
	$takenby = $xmlData->TakenBy->__toString();
	$takenemail = $xmlData->TakenByEmail->__toString();
	$description = $xmlData->JobDescr->__toString();
	$substrate = $xmlData->Stock->__toString();
	$orderquant = str_replace(",", "", $xmlData->OrderQuant->__toString());
	$printquant = str_replace(",", "", $xmlData->PrintQuant->__toString());
	$sheetsizex = $xmlData->SheetX->__toString();
	$sheetsizey = $xmlData->SheetY->__toString();
	$trimsizex = $xmlData->TrimX->__toString();
	$trimsizey = $xmlData->TrimY->__toString();
	$foldx = $xmlData->FoldX->__toString();
	$foldy = $xmlData->FoldY->__toString();
	$persheet = $xmlData->PerSheet->__toString();
	$sides = $xmlData->Sides->__toString();
	$device = $xmlData->Device->__toString();
	if ($foldx == "" && $foldy == "")
		{
		$foldx = 0;
		$foldy = 0;
		}
		
	$jobExists = "SELECT * FROM jobtickets WHERE barcode = '".$barcode."'";	
	$insertQuery = "INSERT INTO jobtickets (barcode, jobnumber, subjob, source, customer, contact, contphone, contemail, salesrep, takenby, takenemail, description, substrate, orderquant, printquant, sheetsizex, sheetsizey, trimsizex, trimsizey, foldx, foldy, persheet, sides, device) 
									VALUES ('".$barcode."', '".$jobnumber."', '".$subjob."', '".$source."', '".$customer."', '".$contact."', '".$contphone."', '".$contemail."', '".$salesrep."', '".$takenby."', '".$takenemail."', '".$description."', '".$substrate."', '".$orderquant."', '".$printquant."', '".$sheetsizex."', '".$sheetsizey."', '".$trimsizex."', '".$trimsizey."', '".$foldx."', '".$foldy."', '".$persheet."', '".$sides."', '".$device."')";
	
	$conn = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);
	if (!$conn) 
		{
		die("Connection failed: " . mysqli_connect_error());
		echo "\n";
		} 
	echo "Connected successfully";
	echo "\n";
	
	$result = mysqli_query($conn, $jobExists);
	$result->data_seek(0);
	$barcodeCheck = $result->fetch_assoc();
	$jobExists = $barcodeCheck['barcode'];
	if ($jobExists == "")
		{
		echo "Job does not exist.";
		echo "\n";
		if (mysqli_query($conn, $insertQuery)) 
			{
			echo "New record created successfully";
			echo "\n";
			} else {
				echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
			}
		} else {
			echo "Job already exists.";
		}
	echo "\n";
	
	mysqli_close($conn);
	
	exit;
	
	?>
