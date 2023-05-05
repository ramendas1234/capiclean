<?php

namespace App\Listeners;

use App\Models\User;
use App\Jobs\ThrottledMail;
use App\Mail\BlogPostAdded;
use App\Events\BlogPostPosted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdminWhenBlogPostCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(BlogPostPosted $event)
    {
        User::getAdmin()->get()->map(function(User $user){
            ThrottledMail::dispatch(new BlogPostAdded(), $user);
        });
    }
}
