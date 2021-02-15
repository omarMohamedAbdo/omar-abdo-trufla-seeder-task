<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Movie;
use App\Jobs\FetchMovies;


class SeedMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movie:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command seeds movies to the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

            $movieBatch = new FetchMovies();
            dispatch($movieBatch);
    }

}
