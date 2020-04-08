<?php


namespace Sohel\MarkdownParser\Fields;

use Sohel\MarkdownParser\MarkdownParser;

class Body extends FieldContract
{

    public static function proccess($type, $value,$data): array
    {
       return [
            $type=>MarkdownParser::parse($value)
        ];
    }
}
