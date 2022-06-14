<?php

require_once ".\clases\VehiculosEspeciales.php";

class CalculosTrayecto
{
    const DISTANCIAS_ENTRADAS = [
        [22, 35, 68],
        [36, 11, 17],
        [67, 17, 39]
    ];
    const DISTANCIAS_HOTEL = [18, 19, 59];
    const PRECIOS_KM = ['normal' => 0.55, 'carga' => 0.88];
    const DESCUENTOS = ['hotel' => 0.5];
    const HORAS_DESCUENTO_HOTEL = 5;
    const PUERTA_CARGA = 1;

    protected int $estanciaHotel;
    protected array $tiempo;
    protected float $precioKm;
    protected float $km;
    protected float $descuento;
    protected int $especial;
    protected float $pagar;

    public function __construct(
        protected string $matricula,
        protected int    $viaEntrada,
        protected int    $puertaEntrada,
        protected int $fechaEntrada,
        protected int    $viaSalida,
        protected int    $puertaSalida,
        protected int $fechaSalida,
    )
    {
        $this->calcular();
    }

    public function resultado()
    {
        return [
            'tiempo_empleado'=> $this->tiempo,
            'precio_km'=>$this->precioKm,
            'km'=>$this->km,
            'descuento'=>$this->descuento,
            'especial'=>$this->especial,
            'total_pago'=>$this->pagar
        ];
    }

    protected function calcular()
    {
        if ($this->fechaSalida < $this->fechaEntrada) {
            throw new Exception('Error al calcular ticket de ' . $this->matricula . '. Hora de salida anterior a hora de entrada');
        }

        //////tiempo empleado
        $horaEntrada = new DateTime('@'.$this->fechaEntrada);
        $horaSalida = new DateTime('@'.$this->fechaSalida);
        $duracion = $horaSalida->diff($horaEntrada);
        $this->tiempo = ['dias' => $duracion->d, 'horas' => $duracion->h, 'minutos' => $duracion->i, 'segundos' => $duracion->s];

        //////////descuento hotel
        $this->estanciaHotel = 0;
        $this->descuento = 0;
        if ($this->tiempo['dias'] || $this->tiempo['horas'] >= self::HORAS_DESCUENTO_HOTEL) {
            $this->descuento = self::DESCUENTOS['hotel'];
            $this->estanciaHotel = 1;
        }

        /////especial
        $this->especial = VehiculosEspeciales::especial($this->matricula);

        ////precioKm
        $tipo = 'normal';
        if ($this->puertaEntrada == self::PUERTA_CARGA && $this->puertaSalida == self::PUERTA_CARGA) {
            $tipo = 'carga';
        }
        $this->precioKm = self::PRECIOS_KM[$tipo];

        //////kms
        if ($this->estanciaHotel) {
            $this->km = self::DISTANCIAS_HOTEL[$this->viaEntrada - 1] + self::DISTANCIAS_HOTEL[$this->viaSalida - 1];
        } else {
            $this->km = self::DISTANCIAS_ENTRADAS[$this->viaEntrada - 1][$this->viaSalida - 1];
        }

        //////pagar
        if ($this->especial) {
            $this->pagar = 0;
        } else {
            $this->pagar = round($this->km * $this->precioKm * (1 - $this->descuento),2);
        }
    }


}