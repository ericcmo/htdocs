<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="Hosni" />
  <meta name="description" content="php example" />
  <title></title>
  <link rel="stylesheet" href="" />
  <style>
    body {
      background-color: #848484;
    }

    #calendar {
      font-family: Arial;
      font-size: 12px;
    }

    #calendar caption {
      text-align: left;
      padding: 5px 10px;
      background-color: #003366;
      color: #fff;
      font-weight: bold;
    }

    #calendar th {
      background-color: #006699;
      color: #fff;
      width: 40px;
      height: 10px;
    }

    #calendar td {
      text-align: right;
      padding: 2px 5px;
      background-color: silver;
    }

    #calendar .hoy {
      background-color: red;
    }

    p {
      text-align: center;
    }
  </style>
</head>

<body>




  <?php
  $meses = [31, 28, 30, 31, 30, 31, 30, 31, 30, 31, 30, 31];
  $sobrass = 0;
  foreach ($meses as $mes) {
    $sobrass = pintar_mes($sobrass, $mes);
  }

  function pintar_mes($sobrass, $mes)
  {
    echo '<table id="calendar">';
    echo '<tr>
<th><p>Lun</p></th><th><p>Mar</p></th><th><p>Mie</p></th><th><p>Jue</p></th>
<th><p>Vie</p></th><th><p>Sab</p></th><th><p>Dom</p></th>
</tr>';
    echo '
  ';
    return pintarmes($sobrass, $mes);


    echo '</table>';
  }

  function pintarmes($relleno, $dias)
  {
    echo '<tr bgcolor="silver">';
    for ($a = 1; $a <= $relleno; $a++) {
      echo '<td><p style="visibility: hidden;">0</p></td>';
    }
    $dia = 1;
    for ($b = 1; $b <= $dias; $b++) {
      echo $b . ' ';
      if (($relleno + $dia) % 7 == 1 && $b != 1) {
        echo '</tr><tr bgcolor="silver">';
      }
      echo '<td><p>' . $dia++ . '</p></td>';
    }
    $dia = $dia - 1;
    echo '<br>relleno:' . $relleno . 'dia:' . $dia . ' =' . ($relleno + $dia);
    echo '<br>' . (($relleno + $dia) % 7);
    //echo '<br>' . (($relleno + ($dia - 1)) % 7);
    return ((($relleno + $dia) % 7));
  }
  ?>



  <br />
  <br />

</body>

</html>