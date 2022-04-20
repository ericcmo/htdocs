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
			
			.main{
                background-color: #f2f2f2;
                margin: 3%;
                padding:10px;
                border-radius: 5px;
            }
            .center{
                margin: auto;
                width:30%;
                padding:10px;
                text-align:center;
            }

		</style>
	</head>
	<body>
	<?php
	
		$name='';
		$email='';
		$password='';
		$save1=false;
		$save2=false;
		$save3=false;
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if(! empty($_POST['fname'])){
					$name = $_POST['fname'];
					$save1=true;
					//echo $name.'<br />';
				}
				if(! empty($_POST['email'])){
					$email = $_POST['email'];
					$save2=true;
					//echo $name.'<br />';
				}
				if(! empty($_POST['password'])){
					$password = $_POST['password'];
					$save3=true;
					//echo $name.'<br />';
				}
			}
		?>		<style>
			.asd{
				margin-left:20px;
			}
		</style>
		
		<div class="main">
			<div class="asd">
				<p style="background-color:<?php if(! $save1){echo 'red';}else{echo 'green';}?>;">Nombre: <b><?php echo $name;?></b></p>
			</div>
			<div class="asd">	
				<p style="background-color:<?php if(! $save2){echo 'red';}else{echo 'green';}?>;">Email: <b><?php echo $email;?></b></p>
			</div>
			<div class="asd">
				<p style="background-color:<?php if(! $save3){echo 'red';}else{echo 'green';}?>;">Password: <b><?php echo $password;?></b></p>
			</div>
			<br />
			<?php print_r($_POST); ?>
			<br />
			<br />
			<?php var_dump($_POST['date']); ?>
			
			<br />
			<br />
			<?php var_dump(strtotime($_POST['date'])); ?>
			
			
		</div>
		<?php
			$save=false;
			if($save1&$save2&$save3){
				echo "Yes";
				$save=true;
			}else{
				$name='';
				$email='';
				$password='';
			}
		?>
		<div class="main">
			<?php
			$action='index.php';
			$button='red';
			if($save){
				$action='tabla.php';
				$button='green';
			}
			?>
			<form method="post" action="<?php echo $action; ?>">
				<div class="center">
					<h4><?php if($save){echo 'Guardado';}else{echo 'Ocurrio un error';}?></h4>
				</div>
				<div class="center">
					<input type="submit" style="background-color:<?php echo $button; ?>;" value="<?php if($save){echo 'Ver en la tabla';}else{echo 'Volver';}?>">
				</div>
			</form>
		</div>
	<?php
		if($save){
			//echo 'OK';
			//write xml
			//$_POST unset()
			//print_r($_POST);
			//header("Location: ".$_SERVER['PHP_SELF']);
			$usuarios = new SimpleXMLElement('db2.xml', 0, true);
			$nuevoUsuario = $usuarios->addChild('user');
			$nuevoUsuario->addChild('name', 'Bernard');
			$nuevoUsuario->addChild('email', 'Madoff');
			$nuevoUsuario->addChild('password', $var5);
			$nuevoUsuario->addChild('time', strtotime($_POST['date']));
			//var_dump($usuarios->user[2]);
			//var_dump($usuarios);
			//$usuarios->saveXML('db2.xml');
			
		}
	?>
	</body>
</html>