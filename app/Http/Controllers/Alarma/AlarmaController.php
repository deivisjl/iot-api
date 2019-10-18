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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
