<html>
<head>
</head>
<body>

	<?php

	echo "Sending Job ... ".$_POST['jobnumber']." ... to Press.";
	echo "\n";
	
	if($_POST['sides'] == "1")
		{
		$duplex = "No";
		} else {
			$duplex = "Yes";
		}
	if($_POST['bleed'] == "Yes")
		{
		$bleed = "bleed";
		} else {
			$bleed = "no bleed";
		}
	$impoXML = $_POST['sheetsizex'].' x '.$_POST['sheetsizey'].'_Best Fit_'.$bleed;
	
	$outPath = "/Users/tech-dept-net/Public/intranet/_XML_to_Switch";
	$xmlfn = $outPath."/".$_POST['barcode'].".xml";
	$f = fopen($xmlfn, "w");
	fwrite($f, "<?xml version='1.0' encoding='UTF-8'?>\n");
	fwrite($f, "<Ticket>\n");
	fwrite($f, "<JobBarcode>".$_POST['barcode']."</JobBarcode>\n");
	fwrite($f, "<JobNumber>".$_POST['jobnumber']."</JobNumber>\n");
//	fwrite($f, "<Customer>".$_POST['jobnumber']."</Customer>\n");
//	fwrite($f, "<TakenBy>".$_POST['jobnumber']."</TakenBy>\n");
//	fwrite($f, "<TakenByEmail>".$_POST['jobnumber']."</TakenByEmail>\n");
//	fwrite($f, "<JobDescr>".$_POST['jobnumber']."</JobDescr>\n");
	fwrite($f, "<Press>".$_POST['press']."</Press>\n");
	fwrite($f, "<Stock>".$_POST['substrate']."</Stock>\n");			
	fwrite($f, "<OrderQuant>".$_POST['orderquant']."</OrderQuant>\n");
	fwrite($f, "<PrintQuant>".$_POST['printquant']."</PrintQuant>\n");
	fwrite($f, "<SheetSize>".$_POST['sheetsizex']." x ".$_POST['sheetsizey']."</SheetSize>\n");
	fwrite($f, "<SheetX>".$_POST['sheetsizex']."</SheetX>\n");
	fwrite($f, "<SheetY>".$_POST['sheetsizey']."</SheetY>\n");
	fwrite($f, "<TrimSize>".$_POST['trimsizex']." x ".$_POST['trimsizey']."</TrimSize>\n");
	fwrite($f, "<TrimX>".$_POST['trimsizex']."</TrimX>\n");
	fwrite($f, "<TrimY>".$_POST['trimsizey']."</TrimY>\n");
	fwrite($f, "<PerSheet>".$_POST['persheet']."</PerSheet>\n");	
	fwrite($f, "<Sides>".$_POST['sides']."</Sides>\n");
	fwrite($f, "<Duplex>".$duplex."</Duplex>\n");
	fwrite($f, "<Device>".$_POST['device']."</Device>\n");
	fwrite($f, "<ImpoXML>".$impoXML."</ImpoXML>\n");				
	fwrite($f, "</Ticket>\n");
	fwrite($f, "\n");	
	fclose($f);
	
	$url='//192.9.200.95:8000/submit_files.php';
	echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
	exit;
	?>
	
</body>
</html>