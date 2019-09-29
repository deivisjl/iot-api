<?php

namespace App\Http\Controllers\Photo;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use League\Flysystem\Filesystem;
use Kreait\Firebase\ServiceAccount;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Google\Cloud\Core\Exception\GoogleException;
use Superbalist\Flysystem\GoogleStorage\GoogleStorageAdapter;

class PhotoController extends ApiController
{

    public function __construct()
    {
        $this->middleware('client.credentials');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/../simpleblog-e736b-57834e980fb9.json');

            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->withDatabaseUri('https://simpleblog-e736b.firebaseio.com/')
                ->create();
            $database = $firebase->getDatabase();
            $newPost = $database
                        ->getReference('blog/posts')
                        ->push([
                            'title' => 'Mi segundo post',
                            'body' => 'Descripción del segundo post'
                        ]);
        return $this->showMessage($newPost->getvalue());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         try {

            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/../simpleblog-e736b-57834e980fb9.json');

            $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->createStorage();

            $bucket = $firebase->getBucket();

            $archivo = $request->file('imagen');
            $nombre =  sha1(Carbon::now()).'.'.$archivo->guessExtension();


            $file = $bucket->upload(file_get_contents($archivo), ['name' => $nombre]);

            //  dd($file->gcsUri());
            // dd($file->info());
            // dd($file->info->getUrl());

            return $this->showMessage($file);

            
        } catch (\Exception $e) {
            
            return response()->json(['error' => $e]);    
        }
        
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
