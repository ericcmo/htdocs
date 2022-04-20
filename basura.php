<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="Hosni" />
  <meta name="description" content="" />
              <title></title>
  <link rel="stylesheet" href="index.css" />
  <link rel="stylesheet" href="./menu/menu.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style>
    body{
      background-color: #848484;
    }
    .main{
      background-color: #f2f2f2;
      margin: 3%;
      padding:10px;
      border-radius: 5px;
  }
  </style>
</head>

<body>
  <div id="includedContent"></div>
  <div class="main">
      <form action="./sender.php" method="get" target="_blank">
        <fieldset>
          <legend>Información personal</legend>
          <p>Nombre completo: <input type="text" name="nombrecompleto"></p>
          <p>Dirección: <input type="password" name="direccion"></p>
          <p>Teléfono: <input type="tel" name="telefono"></p>
          <br />
          <br />
          <br />
          <input type="text" cols="50" name="XXXXX" placeholder="asd" autocomplete="off" autofocus required>
          <input type="email" cols="50" name="email" pattern="^.a."  placeholder="asd" autocomplete="off"  required>
          <input type="tel" id="phone" name="phone" placeholder="+34-666-45-678" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}">
          <input type="color"  value="#858585">
          <input
							type="url"
							name="url_control"
							placeholder="Escribe la URL de tu página web personal"
						/>
          <br />
          <br />
          <label for="">Número (min -10, max 10):</label>
					<br />
          <input
						type="number"
						name="number_control"
						min="-10"
						max="10"
						value="0"
					/>
          <br />
          <br />

          <select multiple>
            <optgroup label="personas">
              <option value="juan">juan</option>
              <option value="pedro">pedro</option>
            </optgroup>
            <optgroup label="objetos">
              <option value="mesa">mesa</option>
              <option value="silla">silla</option>
            </optgroup>
          </select>

          <br />
          <br />
          <br />
          <input type="submit" name="asd">
          <input type="submit" formenctype="multipart/form-data" value="Submit as Multipart/form-data">
          
        </fieldset>
      </form>
  </div>
</body>

</html>