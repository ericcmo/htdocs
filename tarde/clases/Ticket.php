<?php
require_once ".\clases\CalculosTrayecto.php";

class Ticket
{
    protected array $datosTrayecto;

    public function __construct(
        protected string $matricula,
        protected int    $viaEntrada,
        protected int    $puertaEntrada,
        protected string $fechaEntrada,
        protected int    $viaSalida,
        protected int    $puertaSalida,
        protected string $fechaSalida,
    )
    {
        $this->calcular();
    }

    public function exportar()
    {
        $cabecera= ['Matricula',"D.Entrada", 'V.Entrada', 'P.Entrada',"D.Sortida",'V.Sortida','P.Sortida',
            "Temps",'Preu/km','km','Descompte','Especial','Total(€)'];
        $arrayDatos= $this->formatInfoTicket();

        $this->exportarTxt($cabecera, $arrayDatos, $this->datosPrintf());
        if ( array_key_exists('REMOTE_ADDR', $_SERVER) )
            $this->exportarHTML($cabecera, $arrayDatos);
        else
            $this->exportarConsola($cabecera, $arrayDatos, $this->datosPrintf());

        return $this->datosTrayecto;
    }

    public function calcular()
    {
        $calculos= new CalculosTrayecto(
            $this->matricula,
            $this->viaEntrada,
            $this->puertaEntrada,
            $this->fechaEntrada,
            $this->viaSalida,
            $this->puertaSalida,
            $this->fechaSalida,
        );

        $this->datosTrayecto= array_merge(
            [
                'matricula'=>$this->matricula,
                'fecha_in'=>date( 'Y/m/d H:i:s', $this->fechaEntrada),
                'via_in'=>$this->viaEntrada,
                'puerta_in'=>$this->puertaEntrada,
                'fecha_out'=>date( 'Y/m/d H:i:s', $this->fechaSalida),
                'via_out'=>$this->viaSalida,
                'puerta_out'=>$this->puertaSalida,
            ],
            $calculos->resultado());

        return $this->datosTrayecto;
    }

    protected function formatInfoTicket()
    {
        $arrayDatos= $this->datosTrayecto;

        $tiempoEmpleado = $arrayDatos['tiempo_empleado'];
        $stringTiempo= $tiempoEmpleado['dias'].'D'.$tiempoEmpleado['horas'].'H'
            .$tiempoEmpleado['minutos'].'m'.$tiempoEmpleado['segundos'].'s';
        $arrayDatos['tiempo_empleado']= $stringTiempo;

        $arrayDatos['descuento']= round($arrayDatos['descuento']*100,0).'%';
        $arrayDatos['especial'] = $arrayDatos['especial'] ? 'S' : 'N';

        return array_values($arrayDatos);
    }

    protected function exportarTxt($cabecera,$arrayDatos, $datosPrintf)
    {
        $nombreFichero= '.\tickets\ticket_'.$this->datosTrayecto['matricula'].'_'.$this->fechaEntrada.'.txt';

        $fichero = fopen($nombreFichero, "w") or die("No ha sido posible abrir el fichero $nombreFichero");

        fprintf($fichero,$datosPrintf[0],...$cabecera);
        fprintf($fichero,"%s\n",$datosPrintf[1]);
        fprintf($fichero,$datosPrintf[0],...$arrayDatos);
        fclose($fichero);
    }

    protected function exportarConsola($cabecera,$arrayDatos, $datosPrintf)
    {
        printf($datosPrintf[0],...$cabecera);
        printf("%s\n",$datosPrintf[1]);
        printf($datosPrintf[0],...$arrayDatos);
        printf("\n\n");
    }

    protected function exportarHTML($cabecera,$arrayDatos)
    {
        echo '<table style="border: 1px solid;margin-bottom: 10px"><thead><tr>';
        foreach ($cabecera as $campo) {
            echo "<th style='border: 1px solid'>$campo</th>";
        }
        echo '</tr></thead><tbody><tr>';
        foreach ($arrayDatos as $campo) {
            echo "<td style='border: 1px solid'>$campo</td>";
        }
        echo '</tr></tbody><br>';
    }

    private function datosPrintf()
    {
        $longCampos=[11,21,11,11,21,11,11,11,11,11,11,11,11];
        $separador='';
        $datosPrint= '';
        foreach ($longCampos as $longCampo) {
            $separador.='|'.str_repeat('-',$longCampo);
            $datosPrint.= "|%-{$longCampo}s";
        }
        $datosPrint.="\n";
        return [
            $datosPrint,
            $separador
        ];
    }
}