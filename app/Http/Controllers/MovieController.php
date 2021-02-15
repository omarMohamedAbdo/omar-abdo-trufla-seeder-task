<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;
use App\Http\Resources\Movie as MovieResource;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $movies = Movie::with("genres")->get();
        $movies = Movie::query();
        if (request()->category_id) {
            $genre  = Genre::FindOrFail(request()->category_id);
            $movies = $genre->movies();
        }

        if (request()->popular) {
            switch(request()->popular){
                case 'asc':
                    $movies = $movies->orderBy("popularity","asc");
                    break;
                default:
                    $movies = $movies->orderBy("popularity","desc");
                    break;
            }
        }

        if (request()->rate) {
            switch(request()->rate){
                case 'asc':
                    $movies = $movies->orderBy("vote_average","asc");
                    break;
                default:
                    $movies = $movies->orderBy("vote_average","desc");
                    break;
            }
        }

        $movies = $movies->get();

        return MovieResource::collection($movies);
    }

}
