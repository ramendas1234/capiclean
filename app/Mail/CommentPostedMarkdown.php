<?php

namespace App\Mail;

//use App\Models\BlogPost;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentPostedMarkdown extends Mailable
{
    use Queueable, SerializesModels;
    public $comment ;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($comment)
    {
        //
        $this->comment = $comment ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        $subject = "New comment {$this->comment->commentable->title}";
        return $this->subject($subject)
        // ->attach(
        //         storage_path('app/public') . '/'. $this->comment->user->image->path,
        //         [
        //             'as' => 'user-profile-pic.png',
        //             'mime' => 'image/png'
        //         ]
        //     )
        ->markdown('mail.posts.commented-markdown');
    }
}
