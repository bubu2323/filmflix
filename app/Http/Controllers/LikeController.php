<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Like;
use App\Models\UserFilm;
// use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class LikeController extends Controller
{
    public function index()
    {
        return Like::all();
    }

    public function like()
    {
        $films = Film::all();

        return $films;
    }
    public function store(Request $request)
    {

        //avoid duplicate rows

        $like = UserFilm::where(
            [
                'user_id' => $request->user_id,
                'film_id' => $request->film_id
            ]
        )->first();


        if ($like) {
            return ['error' => 'Not inserted row already exist'];
        } else {
            $like = UserFilm::create([
                'user_id' => $request->user_id,
                'film_id' => $request->film_id
            ]);
            $like->save();
            return ['success' => 'inserted correctly', 'like_id' => $like->id];
        }
    }
    public function destroy(Like $like)
    {
        $like->delete();
        return ['message' => $like];
    }
}
