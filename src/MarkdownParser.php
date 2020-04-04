<?php


namespace Sohel\MarkdownParser;


use Parsedown;

class MarkdownParser
{

    public static  function parse($text)
    {
        return Parsedown::instance()->parse($text);
    }

}
