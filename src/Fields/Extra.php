<?php


namespace Sohel\MarkdownParser\Fields;


class Extra extends FieldContract
{

    public static function proccess($type, $value,$data): array
    {
        $extra=isset($data['extra']) ? (array)json_decode($data['extra']) : [];
        return  [
            'extra'=>json_encode(array_merge($extra,[
                $type=>$value
            ]))
        ];
    }
}
