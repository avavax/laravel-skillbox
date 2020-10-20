<?php

use App\Comment;
use App\News;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 2)->create();
        User::first()->update([
            'name' => 'admin',
            'role' => 'admin',
            'email' => 'admin@admin.com',
        ]);

        $tagsId = factory(Tag::class, 5)->create()->pluck('id');

        factory(News::class, 10)->create()->each(function($news) use ($tagsId ) {
            $tagsId->random(2)->each(function($tag) use ($news) {
                $news->tags()->attach($tag);
            });
        });

        factory(Post::class, 20)->create()->each(function($post) use ($tagsId ) {
            $tagsId->random(3)->each(function($tag) use ($post) {
                $post->tags()->attach($tag);
            });
        });

        factory(Comment::class, 20)->create();
    }
}
