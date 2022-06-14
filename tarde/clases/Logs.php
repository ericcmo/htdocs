<?php

class Logs
{
    static protected array $datosCobros;

    static public function nuevoDato($nuevoDato)
    {
        self::$datosCobros[] = $nuevoDato;
    }

    static public function exportar()
    {
        self::borrarFicheros('\\logs\\fechas\\');
        self::borrarFicheros('\\logs\\matriculas\\');
        self::exportarLog1();
        self::exportarLog2();
    }

    static public function exportarLog1()
    {
        //para coches consecutivos
        //$nombreFichero = '.\\logs\\fechas\\'.self::formatFechaNombreFichero(self::$datosCobros[0]['fecha_out']).'.txt';
        $fecha= substr(self::$datosCobros[0]['fecha_out'],0,10);

        //para coches no consecutivos
        $fichero = self::ficheroFecha(self::$datosCobros[0]);
        foreach (self::$datosCobros as $datos) {

            if (substr($datos['fecha_out'],0,10) != $fecha) {
                $fecha= substr($datos['fecha_out'],0,10);

                //para coches consecutivos
                //fclose($fichero);
                //$fichero = self::crearFichero('.\\logs\\fechas\\'.self::formatFechaNombreFichero($datos['fecha_out']).'.txt');

                //para coches no consecutivos
                fclose($fichero);
                $fichero = self::ficheroFecha($datos);
            }

            fprintf($fichero,"Salida{matricula='%s', via='%d', puerta='%d', fecha='%s'}\n",$datos['matricula'],$datos['via_out'],$datos['puerta_out'],$datos['fecha_out']);
            fprintf($fichero,"Cobro{matricula='%s', fecha='%s', cobro='%.2f'}\n",$datos['matricula'],$datos['fecha_out'],$datos['total_pago']);
        }
        fclose($fichero);
    }

    static public function exportarLog2()
    {
        $agrupado = [];
        $datos = self::$datosCobros;
        foreach ($datos as $dato) {
            $agrupado[$dato['matricula']][] = $dato;
        }
        $fichero= null;
        $acumular= ['viajes'=>0, 'total'=>0];
        foreach ($agrupado as $matricula => $datosMatricula) {
            $nombreFichero = '.\\logs\\matriculas\\'.$matricula.'.txt';
            $fichero = self::crearFichero($nombreFichero);
            foreach ($datosMatricula as $datos) {
                $acumular['viajes']++;
                $acumular['total']+=$datos['total_pago'];
                fprintf($fichero,"Entrada{matricula='%s', via='%d', puerta='%d', fecha='%s'}\n",$datos['matricula'],$datos['via_in'],$datos['puerta_in'],$datos['fecha_in']);
                fprintf($fichero,"Salida{matricula='%s', via='%d', puerta='%d', fecha='%s'}\n",$datos['matricula'],$datos['via_out'],$datos['puerta_out'],$datos['fecha_out']);
                fprintf($fichero,"Vehiculo{matricula='%s', viajes='%d', totalCobrado='%.2f'}\n",$datos['matricula'],$acumular['viajes'],$acumular['total']);
            }
            $acumular['viajes']=0;
            $acumular['total']=0;
            fclose($fichero);
        }
    }

    static public function crearFichero($nombreFichero)
    {
        $f= fopen($nombreFichero, "w") or die("No ha sido posible abrir el fichero $nombreFichero");
        return $f;
    }

    static public function appendFichero($nombreFichero)
    {
        $f= fopen($nombreFichero, "a+") or die("No ha sido posible abrir el fichero $nombreFichero");
        return $f;
    }

    static private function formatFechaNombreFichero($fecha)
    {
        return str_replace('/','-',substr($fecha,0,10));
    }

    static private function borrarFicheros($directorio)
    {
        $files = glob(".\\$directorio\\*");
        foreach($files as $file){
            if(is_file($file)) {
                unlink($file);
            }
        }
    }
    static private function ficheroFecha($datos)
    {
        $nombreFichero = '.\\logs\\fechas\\'.self::formatFechaNombreFichero($datos['fecha_out']).'.txt';
        $fecha= substr($datos['fecha_out'],0,10);
        return self::appendFichero($nombreFichero);
    }


}