<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Comment;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Database\Seeders\TagsTableSeeder;
use Illuminate\Support\Facades\Cache;
use Database\Seeders\BlogPostTagTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Cache::tags(['blog-post'])->flush();
        //User::factory(10)->create();
        $this->call([
            UsersTableSeeder::class,
            BlogPostsTableSeeder::class,
            CommentsTableSeeder::class,
            TagsTableSeeder::class,
            BlogPostTagTableSeeder::class
        ]);
    
    
    }
}
