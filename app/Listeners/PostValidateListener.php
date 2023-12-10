<?php

namespace App\Listeners;

use App\Events\PostValidate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class PostValidateListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostValidate $event): void
    {
        Log::info('New Post Created!' . $event->post);
    }
}
