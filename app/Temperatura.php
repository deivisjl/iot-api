<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temperatura
{
	private $temperatura;
	private $humedad;
	private $fecha;

    public function __construct()
    {

    }

    public function setTemperatura($data)
    {
    	$this->temperatura = $data;
    }

    public function setHumedad($data)
    {
    	$this->humedad = $data;
    }

    public function setFecha($data)
    {
    	$this->fecha = $data;
    }
}
