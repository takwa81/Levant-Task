<?php

namespace App\Jobs;

use App\Mail\PostCreatedAdminNotification;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendPostCreatedNotification implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $post;
    public $creator;

    public function __construct($post, $creator)
    {
        $this->post = $post;
        $this->creator = $creator;
    }

    /**
     * Execute the job.
     */

    public function handle()
    {
        try {
            if ($this->creator->hasRole('Admin')) {
                Log::info('Creator is Admin. Sending notification to all users.', [
                    'creator_id' => $this->creator->id,
                    'creator_email' => $this->creator->email,
                ]);
                // $users = User::all();
                $users = User::where('id', '!=', $this->creator->id)->get();

            } else {
                Log::info('Creator is not Admin. Sending notification only to Admins.', [
                    'creator_id' => $this->creator->id,
                    'creator_email' => $this->creator->email,
                ]);
                $users = User::role('Admin')->get();
            }

            foreach ($users as $user) {
                Log::info('Sending post notification to user.', [
                    'user_id' => $user->id,
                    'user_email' => $user->email,
                ]);

                Mail::to($user->email)->send(new PostCreatedAdminNotification($this->post, $user));
            }

            Log::info('PostCreatedNotification job completed successfully.', [
                'post_id' => $this->post->id,
            ]);
        } catch (\Throwable $e) {
            Log::error('PostCreatedNotification job failed.', [
                'error_message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw $e;
        }
    }
}
