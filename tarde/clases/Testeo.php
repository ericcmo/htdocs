<?php
require_once 'RegistroPaso.php';
require_once 'VehiculosEspeciales.php';


class Testeo
{
    static protected $registro;

    static public function run()
    {
        $GLOBALS['testeo']= true;
        self::$registro= new RegistroPaso();
        $class_methods = get_class_methods('Testeo');
        try {
            for ($i = 1; $i < count($class_methods); $i++) {
                self::{$class_methods[$i]}();
            }
            echo PHP_EOL.'Todos los tests pasaron'.PHP_EOL.PHP_EOL;
        } catch (\Throwable $e) {
            echo PHP_EOL.'Fallo linea '.$e->getLine().': '.$e->getMessage().PHP_EOL;
        }
        $GLOBALS['testeo']= false;
        VehiculosEspeciales::reset();
    }

    //test via1-via2
    static private function test1()
    {
        self::$registro->entrada("12345ABC", 1, 2, 1652713314);
        $test= self::$registro->salida("12345ABC", 2, 3, 1652714791);

        assert($test['matricula'] == "12345ABC");
        assert($test['tiempo_empleado']['dias'] == 0);
        assert($test['tiempo_empleado']['horas'] == 0);
        assert($test['tiempo_empleado']['minutos'] == 24);
        assert($test['tiempo_empleado']['segundos'] == 37);
        assert($test['descuento'] == 0);
        assert($test['especial'] == 0);
        assert($test['precio_km'] == 0.55);
        assert($test['km'] == 35);
        assert($test['total_pago'] == 19.25);
    }

    //test descuento
    static private function test2()
    {
        self::$registro->entrada("23456BCD", 1, 3, 1652713314);
        $test= self::$registro->salida("23456BCD", 2, 2, 1652803334);

        assert($test['matricula'] == "23456BCD");
        assert($test['tiempo_empleado']['dias'] == 1);
        assert($test['tiempo_empleado']['horas'] == 1);
        assert($test['tiempo_empleado']['minutos'] == 0);
        assert($test['tiempo_empleado']['segundos'] == 20);
        assert($test['descuento'] == 0.5);
        assert($test['especial'] == 0);
        assert($test['precio_km'] == 0.55);
        assert($test['km'] == 37);
        assert($test['total_pago'] == 10.18);
    }

    //test vehículo especial alta
    static private function test3()
    {
        VehiculosEspeciales::alta('23456BCD');
        self::$registro->entrada("23456BCD", 1, 3, 1652713314);
        $test= self::$registro->salida("23456BCD", 2, 2, 1652803334);
        VehiculosEspeciales::baja('23456BCD');

        assert($test['matricula'] == "23456BCD");
        assert($test['tiempo_empleado']['dias'] == 1);
        assert($test['tiempo_empleado']['horas'] == 1);
        assert($test['tiempo_empleado']['minutos'] == 0);
        assert($test['tiempo_empleado']['segundos'] == 20);
        assert($test['descuento'] == 0.5);
        assert($test['especial'] == 1);
        assert($test['precio_km'] == 0.55);
        assert($test['km'] == 37);
        assert($test['total_pago'] == 0);
    }

    //test vehículo especial baja
    static private function test4()
    {
        VehiculosEspeciales::alta('23456BCD');
        VehiculosEspeciales::baja('23456BCD');

        self::$registro->entrada("23456BCD", 1, 3, 1652713314);
        $test= self::$registro->salida("23456BCD", 2, 2, 1652803334);

        assert($test['matricula'] == "23456BCD");
        assert($test['tiempo_empleado']['dias'] == 1);
        assert($test['tiempo_empleado']['horas'] == 1);
        assert($test['tiempo_empleado']['minutos'] == 0);
        assert($test['tiempo_empleado']['segundos'] == 20);
        assert($test['descuento'] == 0.5);
        assert($test['especial'] == 0);
        assert($test['precio_km'] == 0.55);
        assert($test['km'] == 37);
        assert($test['total_pago'] == 10.18);
    }

    ////test via1-via1
    static private function test5()
    {
        self::$registro->entrada("12345ABC", 1, 2, 1652713314);
        $test= self::$registro->salida("12345ABC", 1, 3, 1652714791);

        assert($test['matricula'] == "12345ABC");
        assert($test['descuento'] == 0);
        assert($test['especial'] == 0);
        assert($test['precio_km'] == 0.55);
        assert($test['km'] == 22);
        assert($test['total_pago'] == 12.1);
    }

    //test via1-hotel-via1
    static private function test6()
    {
        self::$registro->entrada("12345ABC", 1, 2, 1652713314);
        $test= self::$registro->salida("12345ABC", 1, 3, 1652803334);

        assert($test['matricula'] == "12345ABC");
        assert($test['tiempo_empleado']['dias'] == 1);
        assert($test['tiempo_empleado']['horas'] == 1);
        assert($test['tiempo_empleado']['minutos'] == 0);
        assert($test['tiempo_empleado']['segundos'] == 20);
        assert($test['descuento'] == 0.5);
        assert($test['especial'] == 0);
        assert($test['precio_km'] == 0.55);
        assert($test['km'] == 36);
        assert($test['total_pago'] == 9.9);
    }

}