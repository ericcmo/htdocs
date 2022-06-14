<?php

class VehiculosEspeciales
{
    static protected array $listaVehiculos=[];

    static public function alta(string $matricula): void
    {
        if (!in_array($matricula, self::$listaVehiculos)) {
            self::$listaVehiculos[] = strtolower($matricula);
        }
    }

    static public function baja(string $matricula): void
    {
        $matricula = strtolower($matricula);
        $position= array_search($matricula, self::$listaVehiculos);
        if ($position!==false) {
            array_splice(self::$listaVehiculos,$position,1);
        }
    }

    static public function reset()
    {
        self::$listaVehiculos= [];
    }
    static public function especial(string $matricula): bool
    {
        $matricula = strtolower($matricula);
        return in_array($matricula, self::$listaVehiculos);
    }

}