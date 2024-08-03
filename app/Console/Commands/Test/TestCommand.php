<?php

namespace App\Console\Commands\Test;

use App\Mail\SampleMail;
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
        Mail::to('markjasonespelita@gmail.com')
            ->send(new SampleMail);
        $this->info('Mail Sent Successfully.');
    }
}
