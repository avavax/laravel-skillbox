<?php

namespace App\Console\Commands;

use App\Mail\NewPosts;
use App\Post;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class SendMailing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailing:send {start_date} {finish_date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mailing to all users about new articles';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $start = Carbon::createFromTimestamp($this->argument('start_date'));
        $finish = Carbon::createFromTimestamp($this->argument('finish_date') ?? time());

        $posts = Post::whereBetween ('created_at', [$start , $finish])->get();
        User::all()->pluck('email')->map(function($email) use ($posts, $start, $finish) {
            \Mail::to($email)
                ->send(new NewPosts($posts, $start, $finish));
        });

        return 0;
    }
}
