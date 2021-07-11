<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\userFavourites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
Use Exception;

class FavouritesController extends Controller
{
    public function storeFavourites(Request $request) {
        $request->validate(['id'=>'required']);
        $musicData = $request->id;

        foreach ($musicData as $Music)
        {
            try {
                $data = array('user_id'=>Auth::id(),'music_id'=>$Music);
                userFavourites::create($data);
            } catch (Exception $e) {
                return response(['message' => "Already in favourites"]);
            }
        }

        $dataArr = array('user_id' => Auth::id(),'music_id'=>$musicData);
        $response = [ 'user_fav' => $dataArr];
        return response($response, 201);
    }

    public function getFavourites()
    {
        $favourites = DB::table('user_favourites')
                      ->join('music','music_id','=','music.id')
                      ->select('id','name','performer','author','duration','text')
                      ->where('user_id',Auth::id())->get();

        $responseArr = array('user_id'=>Auth::id(),'user_fav'=>$favourites);
        return response($responseArr,201);
    }
}
