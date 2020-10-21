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

    public $counters;
    public $email;

    public function __construct($fields, string $email)
    {
        $this->email = $email;
        $this->counters = $fields ? $this->formCounters($fields) : [];
    }

    public function handle()
    {
        Mail::to($this->email)
            ->send(new Report($this->counters));

        event(new ReportSended($this->counters));
    }

    public function failed(\Exception $exception)
    {
        \Log::error($exception->getMessage());
    }

    private function formCounters($fields)
    {
        $counters = [];

        if (in_array('posts', $fields)) {
            $counters['posts'] = Post::count();
        }
        if (in_array('news', $fields)) {
            $counters['news'] = News::count();
        }
        if (in_array('tags', $fields)) {
            $counters['tags'] = Tag::count();
        }
        if (in_array('comments', $fields)) {
            $counters['comments'] = Comment::count();
        }
        if (in_array('users', $fields)) {
            $counters['users'] = User::count();
        }

        return $counters;
    }
}
