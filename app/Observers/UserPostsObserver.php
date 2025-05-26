<?php

namespace App\Observers;

use App\Models\UserPosts;
use Illuminate\Support\Facades\Mail;

class UserPostsObserver
{
    /**
     * Handle the user posts "created" event.
     *
     * @param  \App\UserPosts  $userPosts
     * @return void
     */
    public function created(UserPosts $post)
    {
        $this->sendNotification($post, 'created');
    }

    /**
     * Handle the user posts "updated" event.
     *
     * @param  \App\UserPosts  $userPosts
     * @return void
     */
    public function updated(UserPosts $post)
    {
        $this->sendNotification($post, 'updated');
    }

    /**
     * Handle the user posts "deleted" event.
     *
     * @param  \App\UserPosts  $userPosts
     * @return void
     */
    public function deleted(UserPosts $post)
    {
        $this->sendNotification($post, 'deleted');
    }

    /**
     * Handle the user posts "restored" event.
     *
     * @param  \App\UserPosts  $userPosts
     * @return void
     */
    public function restored(UserPosts $userPosts)
    {
        //
    }

    /**
     * Handle the user posts "force deleted" event.
     *
     * @param  \App\UserPosts  $userPosts
     * @return void
     */
    public function forceDeleted(UserPosts $userPosts)
    {
        //
    }

    private function sendNotification(UserPosts $post, string $action)
    {
        $subject = "User {$post->user_id} with Post ID {$post->id}";
        $action = ucfirst($action);
        $message = "User ID: {$post->user_id} \nPost ID: {$post->id} \nPost Title: {$post->title} \nPost Description: {$post->description} \nPost Action: {$action}";

        // Mail::raw($message, function ($mail) use ($subject) {
        //     $mail->to('test@example.com')
        //         ->subject($subject);
        // });
    }
}
