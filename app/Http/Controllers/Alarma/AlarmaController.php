<?php

namespace App\Http\Controllers\Alarma;

use Carbon\Carbon;
use App\Temperatura;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class AlarmaController extends ApiController
{

    const ALERT_PATH = 'ALERT';
    const TEMPERATURE_PATH = 'TEMPERATURE';
    const INTRUDER_PATH = 'INTRUDER';
    const PANIC_PATH = 'PANIC';
    const SMOCK_PATH = 'SMOCK';

    public function __construct()
    {
        //$this->middleware('client.credentials');
    }

    public function temperatura(Request $request)
    {        
        $datos = (object) array(
                        'Temperatura' => $request->temperatura,
                        'Humedad' => $request->humedad,
                        'Fecha' => Carbon::now()->format('d-m-Y'),
                        'Hora' => Carbon::now()->format('H:i:s a'),
                        'Estado' => 0
                        );

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/../simpleblog-e736b-57834e980fb9.json');

            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->withDatabaseUri('https://simpleblog-e736b.firebaseio.com/')
                ->create();
            $database = $firebase->getDatabase();

            $newTemperatura = $database
                        ->getReference(self::ALERT_PATH.'/'.self::TEMPERATURE_PATH)
                        ->push($datos);
        return $this->showMessage($newTemperatura->getvalue());
    }



    public function gas()
    {
         $datos = (object) array(
                        'Mensaje' => 'Presencia de gas detectada',
                        'Fecha' => Carbon::now()->format('d-m-Y'),
                        'Hora' => Carbon::now()->format('H:i:s a'),
                        'Estado' => 0
                        );

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/../simpleblog-e736b-57834e980fb9.json');

            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->withDatabaseUri('https://simpleblog-e736b.firebaseio.com/')
                ->create();
            $database = $firebase->getDatabase();

            $newTemperatura = $database
                        ->getReference(self::ALERT_PATH.'/'.self::SMOCK_PATH)
                        ->push($datos);
        return $this->showMessage($newTemperatura->getvalue());
    }

    public function proximidad()
    {
        $datos = (object) array(
                        'Titulo' => 'Intrusión inusual',
                        'Mensaje' => 'Se ha detectado un ingreso inusual dentro de la casa',
                        'Fecha' => Carbon::now()->format('d-m-Y'),
                        'Hora' => Carbon::now()->format('H:i:s a'),
                        'Estado' => 0
                        );

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/../simpleblog-e736b-57834e980fb9.json');

            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->withDatabaseUri('https://simpleblog-e736b.firebaseio.com/')
                ->create();
            $database = $firebase->getDatabase();

            $newTemperatura = $database
                        ->getReference(self::ALERT_PATH.'/'.self::INTRUDER_PATH)
                        ->push($datos);
        return $this->showMessage($newTemperatura->getvalue());
    }

    public function panico()
    {
        $datos = (object) array(
                        'Titulo' => 'Alarma de pánico',
                        'Mensaje' => 'Se ha activado manualmente la alarma audible',
                        'Fecha' => Carbon::now()->format('d-m-Y'),
                        'Hora' => Carbon::now()->format('H:i:s a'),
                        'Estado' => 0
                        );

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/../simpleblog-e736b-57834e980fb9.json');

            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->withDatabaseUri('https://simpleblog-e736b.firebaseio.com/')
                ->create();
            $database = $firebase->getDatabase();

            $newTemperatura = $database
                        ->getReference(self::ALERT_PATH.'/'.self::PANIC_PATH)
                        ->push($datos);
        return $this->showMessage($newTemperatura->getvalue());
    }

}
