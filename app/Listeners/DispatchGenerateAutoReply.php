<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use App\Jobs\GenerateAutoReplyJob;

class DispatchGenerateAutoReply
{
    public function handle(CommentCreated $event): void
    {
        GenerateAutoReplyJob::dispatch($event->comment);
    }
}