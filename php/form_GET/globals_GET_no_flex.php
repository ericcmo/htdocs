<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="Profe">
		<title></title>
		<style>
			body{
				background-color:#848484;
			}
			.form{
				background-color: #f2f2f2;
				margin: 5%;
				border-radius: 5px;
			}
			.center{
				margin: auto;
				width:30%;
				padding:10px;
				text-align:center;
			}
			label{
				text-align:left;
				display:block;
			}
			.input_text{
				width:99%;
			}
		</style>
	</head>
	<body>
		
		<div class="form">
			<form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
				<div class="center" style="background-color:red;">
					<label for="fname">Name:</label>
					<input type="text" name="fname" placeholder="Your name.." class="input_text">
				</div>
				<div class="center">
					<label for="email">Email:</label>
					<input type="text" name="email" class="input_text">
				</div>
				<div class="center">
					<label for="password">Password:</label>
					<input type="password" name="passowrd" class="input_text">
				</div>
				<div class="center">
					<input type="submit">
				</div>
			</form>
		</div>
		<?php
			$name = '';
			$email = '';
			$pass = '';
			if ($_SERVER["REQUEST_METHOD"] == "GET") {
				if(! empty($_GET['fname'])){
					$name = $_GET['fname'];
				}
				if(! empty($_GET['email'])){
					$email = $_GET['email'];
				}
				if(! empty($_GET['pass'])){
					$pass = $_GET['pass'];
				}
			}
		?>
		<div class="form">
			<div style="margin-left:20px;">
				<p>Nombre: <?php echo $name; ?></p>
			</div>
			<div style="margin-left:20px;">	
				<p>Email: <?php echo $email; ?></p>
			</div>
			<div style="margin-left:20px;">
				<p>Password: <?php echo $pass; ?></p>
			</div>
		</div>
	</body>
</html>