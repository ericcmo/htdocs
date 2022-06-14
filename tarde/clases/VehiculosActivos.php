<?php

class VehiculosActivos
{
    private array $listaVehiculos;

    public function alta(string $matricula, int $via, int $puerta, int $fecha):void
    {
        if (isset($this->listaVehiculos[$matricula])){
            $dia= date( 'Y/m/d H:i:s', strtotime($this->listaVehiculos[$matricula][2]));
            throw new Exception("El coche con matrícula $matricula entró el $dia y no consta su salida");
        }
        $this->listaVehiculos[$matricula]=[$via,$puerta,$fecha];
    }

    public function baja(string $matricula):void
    {
        if (!isset($this->listaVehiculos[$matricula])){
            throw new Exception("El coche con matrícula $matricula sale pero no consta su entrada");
        }

        unset($this->listaVehiculos[$matricula]);
    }

    public function reset()
    {
        $this->listaVehiculos= [];
    }

    public function datos(string $matricula):?array
    {
        if (!isset($this->listaVehiculos[$matricula])){
            return null;
        }

        $entrada= $this->listaVehiculos[$matricula];
        $respuesta= [
            'matricula'=>$matricula,
            'via'=>$entrada[0],
            'puerta'=>$entrada[1],
            'fecha_in'=>$entrada[2],
        ];

        return $respuesta;
    }
}