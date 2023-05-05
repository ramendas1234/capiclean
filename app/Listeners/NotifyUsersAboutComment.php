<?php

namespace App\Listeners;

use App\Events\CommentPosted;
use App\Mail\CommentPostedMarkdown;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Jobs\NotifyUsersPostWasCommented;
use App\Jobs\ThrottledMail;

class NotifyUsersAboutComment
{
    

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CommentPosted $event)
    {
        ThrottledMail::dispatch(new CommentPostedMarkdown($event->comment), $event->comment->commentable->user);

        NotifyUsersPostWasCommented::dispatch($event->comment);
    }
}
