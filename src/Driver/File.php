<?php


namespace Sohel\MarkdownParser\Driver;


use Sohel\MarkdownParser\MarkdonwFIleParser;

class File
{
    public function fetchPosts():array
    {
        $files = \Illuminate\Support\Facades\File::files(config('press.path'));
        foreach ($files as $key => $file) {
            $posts[] = (new MarkdonwFIleParser($file->getRealPath()))->getData();
        }

        return $posts;
    }
}
