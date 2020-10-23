<?php

namespace App\Events;

use App\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $title;
    public $link;
    public $fields;

    public function __construct(Post $post, $fields)
    {
        $this->title = $post->title;
        $this->link = route('posts.show', ['post' => $post->slug]);
        $this->fields = $fields;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('post.updated');
    }
}
