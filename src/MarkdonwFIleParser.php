<?php


namespace Sohel\MarkdownParser;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MarkdonwFIleParser
{
    protected string $filename;

    protected array  $rawData = [];
    protected array  $data = [];

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->spliteFile();
        $this->explodeData();
        $this->processecField();
    }

    protected function spliteFile()
    {

        preg_match(
            '/^-{3}(.*?)\-{3}(.*)/s',
            File::exists($this->filename) ? File::get($this->filename) : $this->filename,
            $this->rawData);

    }

    protected function explodeData()
    {
        foreach (explode("\n", trim($this->rawData[1])) as $filedString) {
            preg_match('/(.*):\s?(.*)/', $filedString, $filedArray);
            $this->data[$filedArray[1]] = trim($filedArray[2]);
        }
        $this->data['body'] = trim($this->rawData[2]);
    }

    protected function processecField()
    {
        foreach ($this->data as $filed => $value) {
            $class = 'Sohel\\MarkdownParser\\Fields\\' . Str::title($filed);
            if (!class_exists($class) && !method_exists($class, 'proccess')) {
                $class = 'Sohel\\MarkdownParser\\Fields\\Extra';
            }
            $this->data = array_merge(
                $this->data,
                $class::proccess($filed, $value, $this->data)
            );
        }
    }

    public function getData()
    {
        return $this->data;
    }

    public function getrawData()
    {
        return $this->rawData;
    }
}
