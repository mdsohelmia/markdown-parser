<?php


namespace Sohel\MarkdownParser;


use Illuminate\Support\Str;

class Press
{
    public static function configurationNotPublsih()
    {
        return is_null(config('press'));
    }

    public static function driver()
    {
        $class= 'Sohel\MarkdownParser\Driver\\'.Str::title(config('press.driver'));
        return new $class;
    }

}
