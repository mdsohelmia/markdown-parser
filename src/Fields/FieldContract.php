<?php


namespace Sohel\MarkdownParser\Fields;


abstract class FieldContract
{
    public static function proccess($fieldType, $fieldValue, $data) :array
    {
        return [
            $fieldType=>$fieldValue
        ];
    }
}
