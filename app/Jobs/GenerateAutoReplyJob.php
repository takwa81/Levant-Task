<?php

namespace App\Jobs;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\AiReplyService;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Bus\Dispatchable;

class GenerateAutoReplyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Comment $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function handle(AiReplyService $aiReplyService)
    {
        $replyText = $aiReplyService->generateReply($this->comment->comment);

        if ($replyText) {
            $this->comment->replies()->create([
                'user_id' => User::where('name','AI')->first()->id,
                'comment' => $replyText,
                'post_id'  => $this->comment->post_id
            ]);

            Log::info('Reply stored successfully.', ['comment_id' => $this->comment->id]);
        } else {
            Log::warning('AI did not return a reply.', ['comment_id' => $this->comment->id]);
        }
    }

}
