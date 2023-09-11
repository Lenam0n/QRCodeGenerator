<!DOCTYPE HTML>
<?php 
	require 'vendor/autoload.php';
	use chillerlan\QRCode\QRCode;
	use chillerlan\QRCode\QROptions;
	


?>
<html>
	<head>
		<meta charset="utf-8"></meta>
		<link rel= "stylesheet" href="css/style.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
		<title>test uwu</title>
	</head>
	
	<body>
		<header>
			<nav class="flex">
				<a href="#" class="nav_hover">Home</a>
				<div class="flex gap-30">
					<a href="#" class="nav_hover">Seite2</a>
					<a href="#" class="nav_hover">Seite3</a>
					<a href="#" class="nav_hover">Seite4</a>
				</div>

			</nav>
		</header>
		
		<div id="wrapper">
			<div>
				<div>
					<form method="post" class="flex col a_center" action="">
						<div class="flex inputs">
						<?php 
						if(isset($_POST["inputFieldName"])){
							echo "<input id=\"inputField\" type=\"text\" required placeholder=".$_POST["inputFieldName"]." name=\"inputFieldName\">";
						}else{echo "<input id=\"inputField\" type=\"text\" required placeholder=\"\" name=\"inputFieldName\">";}
						?>
						<input id="subButton" class="button-1" type="submit" value="Submit">
						</div>
						<div id="elements">
							<div class="flex">
								<p style="margin-right:3px;">QuiteZone:</p>
								<input type="radio" id="trueQuiteZone" name="quiteZone" value="true" checked>
								<label for="trueQuiteZone">True</label> 
								<input type="radio" id="falseQuiteZone" name="quiteZone" value="false">
								<label for="falseQuiteZone">False</label>
							</div>
							<div class="flex">
								<p style="margin-right:28px;">Circle:</p>
									<input type="radio" id="circle" name="circle" value="true" checked>
									<label for="circle">True</label> 

									<input type="radio" id="circle" name="circle" value="false">
									<label for="circle">False</label>
							</div>
							<div>
								<div>
									<input style="width:60px;" type="color" id="colorPicker" name="colorPicker" value="#FF0000">
									<label for="colorPicker"> Background Color Picker</label> 
								</div>	
								<div>
									<input style="width: 56px;"type="number" id="scale" name="scale" min="10" max="30" value="20" />
									<label for="scale">Größe</label>
								</div>	
							</div>
							<div>
								<select id="format" name="output_type">
								  <option value="JPEG">JPEG</option>
								  <option value="gif">GIF</option>
								  <option value="pdf">PDF</option>
								  <option value="png" selected >PNG</option>
								</select>
								<label for="output_type">Output Typ</label>
							</div>

						</div>

					</form>
				</div>
		<?php
			if(isset($_POST["inputFieldName"])){
				$options = new QROptions([
				'bgcolor'          => (int)$_POST['colorPicker'],
				'addQuietzone'     => isset($_POST['quietzone']),
				'outputType'       => $_POST['output_type'],
				'scale'            => (int)$_POST['scale'],
				'imageBase64'      => true,
				'imageTransparent' => false,
				'drawCircularModules' => $_POST['circle']
				]);
				$inputData = $_POST["inputFieldName"];
				
				echo "<div class=\"qr_code\">";
				$qrcode = (new QRCode($options))->render($inputData);
				printf('<a href="%s" download><img src="%s" alt="QR Code" /></a>',$qrcode,$qrcode);
				echo "</div>";
			}
		?>
			</div>
			
		</div>
	</body>
</html>