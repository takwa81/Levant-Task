<?php

namespace App\Mail;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostCreatedAdminNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $post;
    public $admin;

    public function __construct(Post $post, User $admin)
    {
        $this->post = $post;
        $this->admin = $admin;
    }

    public function build()
    {
        return $this->subject('New Post Created')
            ->view('emails.post_created')
            ->with([
                'post' => $this->post,
                'admin' => $this->admin,
            ]);
    }
}
