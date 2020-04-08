<?php


namespace Sohel\MarkdownParser\Fields;


use Carbon\Carbon;

class Date extends  FieldContract
{
    public static function proccess($type, $value,$data):array
    {
        return [
            $type=>Carbon::parse($value)
        ];
    }
}
