<?php

namespace App\Jobs;

use App\Comment;
use App\Events\ReportSended;
use App\Mail\Report;
use App\News;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;

class BlogReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $fields;
    private $email;

    public function __construct($fields, string $email)
    {
        $this->email = $email;
        $this->fields = $fields;
    }

    public function handle()
    {
        $counters = [];

        if (in_array('posts', $this->fields)) {
            $counters['posts'] = Post::count();
        }
        if (in_array('news', $this->fields)) {
            $counters['news'] = News::count();
        }
        if (in_array('tags', $this->fields)) {
            $counters['tags'] = Tag::count();
        }
        if (in_array('comments', $this->fields)) {
            $counters['comments'] = Comment::count();
        }
        if (in_array('users', $this->fields)) {
            $counters['users'] = User::count();
        }

        Mail::to($this->email)
            ->send(new Report($counters));

        event(new ReportSended($counters));
    }

    public function failed(\Exception $exception)
    {
        \Log::error($exception->getMessage());
    }
}
