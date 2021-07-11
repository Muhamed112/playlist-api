<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\userFavourites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavouritesController extends Controller
{
    public function storeFavourites(Request $request) {
        $musicData = $request->validate([
            'id' => 'required|string',
            'name' => 'required|string'
        ]);

        $data = array('user_id'=>Auth::id(),'music_id' => $musicData['id']);
        userFavourites::create($data);

        $response = [ 'user_fav' => $data];
        return response($response, 201);
    }

    public function getFavourites()
    {
        $favourites = DB::table('music')->select('name','performer','author','duration','text')->where('id',1);
        return userFavourites::all();
    }
}
