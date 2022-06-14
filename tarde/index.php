<?php
require_once ".\clases\Logs.php";
require_once '.\clases\RegistroPaso.php';
require_once '.\clases\Testeo.php';

$registro= new RegistroPaso();

//////////////////////////tests
Testeo::run();


VehiculosEspeciales::alta("67890FGH");
//VehiculosEspeciales::baja("67890FGH");

//entradas
$registro->entrada("12345ABC", 1, 2, 1652713314);
$registro->entrada("23456BCD", 1, 3, 1652713314);
$registro->entrada("34567CDE", 1, 4, 1652713314);
$registro->entrada("45678DEF", 1, 1, 1652713314);
$registro->entrada("56789EFG", 1, 5, 1652713314);
$registro->entrada("67890FGH", 1, 2, 1652713314);


////salidas
$registro->salida("12345ABC", 2, 3, 1652714791);
$registro->salida("23456BCD", 2, 2, 1652803334);
$registro->salida("34567CDE", 1, 4, 1652714689);
$registro->salida("45678DEF", 3, 1, 1652720311);
$registro->salida("56789EFG", 3, 4, 1652779427);
$registro->salida("67890FGH", 1, 2, 1652779427);


Logs::exportar();