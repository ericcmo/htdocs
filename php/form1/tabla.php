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
			table {
			  border-collapse: collapse;
			  width: 100%;
			}

			th, td {
			  text-align: left;
			  padding: 8px;
			}

			tr:nth-child(even){background-color: #f2f2f2}

			th {
			  background-color: #04AA6D;
			  color: white;
			}

		</style>
	</head>
	<body>
		<div class="main">
			<table>
				<thead>
					<tr>
						<th>Name:</th>
						<th>Email:</th>
						<th>Password:</th>
						<th>Time:</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
						if(!$xml = simplexml_load_file('db.xml')){
							echo "No se ha podido cargar el archivo";
						} else {
							foreach ($xml as $user){
								echo '<tr>';
								echo '<td>'.$user->name.'</td>';
								echo '<td>'.$user->email.'</td>';
								echo '<td>'.$user->password.'</td>';
								echo '<td>'.$user->time.'</td>';
								echo '</tr>';
							}
						}
					?>
					
				</tbody>
			</table>
		</div>
	</body>
</html>