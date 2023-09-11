<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"></meta>
		<link rel= "stylesheet" href="css/style.css">
		<title>test uwu</title>
	</head>
	
	<body>
	
		<div>
			<form method="post" action="">
				<input type="text" name="inputFieldName">
				<input type="submit" value="Submit">
			</form>
		</div>
		<?php
		error_reporting(E_ALL);ini_set('display_errors', 1);
		require 'vendor/autoload.php';
		use chillerlan\QRCode\QRCode;

		if(isset($_POST["inputFieldName"])){
			$inputData = $_POST["inputFieldName"];
			echo "<p>$inputData</p><br/>";
			echo "<p>".strlen($inputData)."</p><br/>";
			
			$allAsciiCodes = [];
			$pattern = '/(\s+)/';
			$allAsciiCodes = preg_split($pattern, $inputData, -1, PREG_SPLIT_DELIM_CAPTURE);
			print_r($allAsciiCodes);
			$binaryString="";
			for ($i = 0; $i < strlen($inputData); $i++) {

				$char = $inputData[$i];
				$asciiCode = ord($char);
				
				        
				$binaryValue = str_pad(decbin($asciiCode), 8, '0', STR_PAD_LEFT);
        
				if($binaryString == ""){$binaryString .= $binaryValue;}
				else{$binaryString.=" ". $binaryValue;}

				echo "<p>ASCII-Code für '$char' ist $asciiCode und $binaryValue</p>";
				
			}
			echo "<p>Binary String für \"$inputData\" ist \"$binaryString\"</p>";
			
		// Generate the QR code
		echo "<div class=\"flex\">";
		echo "<div>";
		echo "<p> Binär Code</p>";
		$qrcode = (new QRCode)->render($binaryString);

		printf('<img class ="qr_img" src="%s" alt="QR Code" />', $qrcode);
		echo "</div>";
		echo "<div>";
		echo "<p> Normaler Text</p>";
		$qrcode = (new QRCode)->render($inputData);

		printf('<img class ="qr_img" src="%s" alt="QR Code" />', $qrcode);
		echo "</div>";
		
		echo "</div>";
		
		}
		
		?>

	
	</body>
</html>