<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Genre;
class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ( Genre::count()==0 ) {
            $response = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key='.env("MOVIE_DB_KEY"));
            // dd($response['genres']);
            foreach ($response['genres'] as $genre) {
                Genre::create(["id"=>$genre['id'],"genre"=>$genre['name']]);
            }
        }

    }
}
