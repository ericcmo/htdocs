<?php
require_once ".\clases\VehiculosActivos.php";
require_once ".\clases\Ticket.php";
require_once ".\clases\Logs.php";

class RegistroPaso
{
    protected VehiculosActivos $vehiculosActivos;

    public function __construct()
    {
        $this->vehiculosActivos= new VehiculosActivos();
    }

    function entrada(string $matricula, int $via, int $puerta, int $fecha = null): void
    {
        $fecha= $fecha??$this->fechaActual();

        $this->vehiculosActivos->alta($matricula,$via,$puerta,$fecha);
    }

    function salida(string $matricula, int $via, int $puerta, int $fecha = null)
    {
        $fecha= $fecha??$this->fechaActual();

        $entrada = $this->vehiculosActivos->datos($matricula);
        $this->vehiculosActivos->baja($matricula);
        $datosVehiculo= array_merge(array_values($entrada),[$via,$puerta,$fecha]);

        $ticket= new Ticket(...$datosVehiculo);

        if (isset($GLOBALS['testeo']) && $GLOBALS['testeo']){
            $this->vehiculosActivos->reset();
            return $ticket->calcular();
        }

        $datosTrayecto= $ticket->exportar();

        Logs::nuevoDato($datosTrayecto);


    }

    private function fechaActual()
    {
        return time();
    }


}