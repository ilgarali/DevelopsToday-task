<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class UpvoteReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:upvote';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset post upvotes daily';

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
        $posts = Post::get();
        foreach ($posts as $post) {
            $post->upvote = 0;
            $post->save();
        }
        $this->info('Post upvotes successfully were rested.');
    }
}
