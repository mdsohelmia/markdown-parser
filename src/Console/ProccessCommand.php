<?php


namespace Sohel\MarkdownParser\Console;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Sohel\MarkdownParser\MarkdonwFIleParser;
use Sohel\MarkdownParser\Post;
use Sohel\MarkdownParser\Press;

class ProccessCommand extends Command
{

    protected $signature = 'press:proccess';

    protected $description = 'Update blog post';

    public function handle()
    {
        if (Press::configurationNotPublsih()) {
            $this->warn('Please publsih config files \'php artisan vendor:publish --tag=press-config\'');
        }

        $posts = Press::driver()->fetchPosts();

        foreach ($posts as $post)
        {
            Post::create([
                'identifier' => Str::random(),
                'slug' => Str::slug($post['title']),
                'title' => $post['title'],
                'body' => $post['description'],
                'extra' => 'something'
            ]);
        }
    }

}
