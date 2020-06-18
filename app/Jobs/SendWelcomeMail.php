<?php

namespace App\Jobs;

use App\Events\SendQueueFinishMessage;
use App\Mail\WelcomeMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendWelcomeMail implements ShouldQueue
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
        $job = false;
        if ($job) {
            event(new SendQueueFinishMessage('finish queue job'));
        } else {
            event(new SendQueueFinishMessage('not finish queue job'));
        }

        // Mail::to('abcwe3@gmail.com')->send(new WelcomeMail('some title'));
        // if (Mail::failures()) {
        //     Log::info('This is fail message');
        // } else {
        //     Log::info('This is success message');
        // }

    }
}
