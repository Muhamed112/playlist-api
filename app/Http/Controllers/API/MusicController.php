<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Music;

class MusicController extends Controller
{
    public function index()
    {
        return Music::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'performer'=> 'required|string',
        ]);

        $music = Music::create($request->all());

        $response = [ 'music' => $music ];
        return response($response,201);

    }


}
