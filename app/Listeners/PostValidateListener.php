<?php

namespace App\Listeners;

use App\Events\PostValidate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        $request = $event->request;
        $request->validate([
            'content' => 'required|min:10'
        ], [
            'content.required' => 'Введите текст',
            'content.min' => 'Ваш текст должен быть минимум :min символов.'
        ]);
    }
}
