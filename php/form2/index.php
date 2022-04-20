<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="Profe">
	<link rel="stylesheet" href="/menu/menu.css" />
	<link rel="stylesheet" href="./index.css" />
	<title></title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
		$(function() {
			$("#includedContent").load("/menu/menu.html");
		});
	</script>
</head>

<body>
	<div id="includedContent"></div>
	<?php
	$name = '';
	$email = '';
	$password = '';
	$save1 = false;
	$save2 = false;
	$save3 = false;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (!empty($_POST['fname'])) {
			$name = $_POST['fname'];
			$save1 = true;
			//echo $name.'<br />';
		}
		if (!empty($_POST['email'])) {
			$email = $_POST['email'];
			$save2 = true;
			//echo $name.'<br />';
		}
		if (!empty($_POST['password'])) {
			$password = $_POST['password'];
			$save3 = true;
			//echo $name.'<br />';
		}
	}
	?>

	<div class="main">
		<form method="post" action="save.php">
			<div class="center">
				<label for="fname">Name:</label>
				<input type="text" name="fname" placeholder="Your name.." class="input_text" value="<?php echo $name; ?>">
			</div>
			<div class="center">
				<label for="email">Email:</label>
				<input type="text" name="email" class="input_text" value="<?php echo $email; ?>">
			</div>
			<div class="center">
				<label for="password">Password:</label>
				<input type="password" name="password" class="input_text" value="<?php echo $password; ?>">
			</div>
			<div class="center">
				<label for="gender">Gender:</label>
				<select name="gender" required>
					<option value="0">Woman</option>
					<option value="1">Men</option>
					<option value="2">It</option>
					<option disabled selected value=""></option>
				</select>
			</div>
			<div class="center">
				<label for="language">¿Qué tipo de lenguaje te gustó más?</label>
				<div>
					<input type="radio" name="language" id="html" value="0">
					<label for="html">HTML</label>
				</div>
				<div>
					<input type="radio" name="language" id="css" value="1">
					<label for="css">CSS</label>
				</div>
				<div>
					<input type="radio" name="language" id="php" value="2">
					<label for="php">PHP</label>
				</div>
				<div>
					<input type="radio" name="language" id="js" value="3">
					<label for="js">JS</label>
				</div>
			</div>
			<div class="center">
				<label for="tems"><input type="checkbox" id="tems" name="tems" value="1">Términos</label>
				<label for="cond"><input type="checkbox" id="cond" name="cond" value="1">Condiciones</label>
			</div>
			<div class="center">
				<label for="date">Date:</label>
				<input type="date" name="date" min="2022-01-01" max="2022-12-31">
			</div>
			<div class="center">
				<input type="reset">
				<input type="submit">
			</div>
		</form>

		<br />
		<br />
		<?php
		$timestamp='1648199411';
		//echo $timestamp;
		echo '<br />';
		//echo strtotime($timestamp);
		//echo gmdate() 
		echo '<br />';
		//echo date('d-m-Y',strtotime($timestamp));
		echo gmdate('Y-m-d',$timestamp);
		//echo '<br />este: ';
		//echo(strtotime("+1 week 3 days 7 hours 5 seconds") . "<br>");
		?>
	</div>



</body>

</html>