<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Jobs\SendPostCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPostCreatedNotificationListener
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
    public function handle(PostCreated $event)
    {
        SendPostCreatedNotification::dispatch($event->post, $event->creator);
    }
}
