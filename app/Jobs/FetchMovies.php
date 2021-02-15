<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\Movie;

class FetchMovies implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $moviesCount = Movie::count();
        if ($moviesCount<env('NUM_OF_RECORDS')) {
            $pageNo = 1+ $moviesCount/20;
            $response = Http::get('https://api.themoviedb.org/3/movie/top_rated?api_key='.env("MOVIE_DB_KEY").'&page='.$pageNo);
            foreach ($response['results'] as $movie) {
               $movieRecord =  Movie::firstOrCreate([
                    "id"=>$movie['id'],
                    "title"=>$movie['title'],
                    "popularity"=>$movie['popularity'],
                    "vote_average"=>$movie['vote_average']
                    ]);
                    if ($movieRecord->wasRecentlyCreated) {
                        foreach($movie['genre_ids'] as $genre_id){
                            $movieRecord->genres()->attach($genre_id);
                         }
                    }
            }
        }
    }
}
