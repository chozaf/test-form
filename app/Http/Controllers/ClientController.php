<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    
    const FILE = 'clients.csv';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Storage::disk('local')->exists(self::FILE)) {
            $lines = explode("\n",Storage::disk('local')->get(self::FILE));
            foreach($lines as $line){
                if(!$line) continue;
                $all[] = str_getcsv($line); 
            }     
        }
        return view('client.index',[
            'clients'=>$all ?? []
        ]);
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
     * @param  \App\Http\Requests\StoreClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        $validated = $request->safe()->only(['name', 'email','password']);
        $validated['password_hash'] = Hash::make($validated['password']);
        $validated = array_map(function($el){ return str_replace(',',' ',$el); },$validated);
        Storage::disk('local')->prepend(self::FILE,implode(',', $validated));
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
        
        if (Storage::disk('local')->exists(self::FILE)) {
            Storage::disk('local')->delete(self::FILE);
            Session::flash('message', 'Дані видалено!'); 
        }
        
        return redirect()->route('index');
    }
}
