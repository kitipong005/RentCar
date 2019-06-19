<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Book;
use Carbon\Carbon;

class DestroyBook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'destroy:book';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'is it a destroy booking no pay on 30 min after booking car rent';

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
     * @return mixed
     */
    public function handle()
    {
        Book::where('status','=',0)->where('exp','<',Carbon::now()->toDateTimeString())->delete();
    }
}
