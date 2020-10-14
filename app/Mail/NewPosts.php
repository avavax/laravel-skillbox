<?php

namespace App\Mail;

use App\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class NewPosts extends Mailable
{
    use Queueable, SerializesModels;
    public $posts;
    public $start;
    public $finish;

    public function __construct($posts, $start, $finish)
    {
        $this->posts = $posts;
        $this->start= $start->format('Y-m-d');
        $this->finish = $finish->format('Y-m-d');
    }

    public function build()
    {
        return $this->markdown('mail.new-posts');
    }
}
