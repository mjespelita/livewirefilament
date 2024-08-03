<?php

namespace App\Console\Commands\Test;

use App\Mail\SampleMail;
use App\Smark\Arrayer;
use App\Smark\Web;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $array = Web::extractLinks('https://laravel.com');

        // foreach ($array as $key => $value) {
        //     $this->info($value);
        // }

        $this->info(Web::htmlToPlainText('https://laravel.com/'));
    }
}
