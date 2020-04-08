<?php


namespace Sohel\MarkdownParser\Test\Feature;


use Carbon\Carbon;
use Orchestra\Testbench\TestCase;
use Sohel\MarkdownParser\MarkdonwFIleParser;

class MarkDownFileParserTest extends TestCase
{
    public function test_the_head_body_split()
    {
        $fileParser = (new MarkdonwFIleParser(__DIR__.'/../blogs/makdown.md'));
       $data = $fileParser->getrawData();
       $this->assertStringContainsString('title:My Blog post ',$data[1]);
       $this->assertStringContainsString('description:my description',$data[1]);
    }

    public function test_parse_also_string()
    {
        $fileParser = (new MarkdonwFIleParser("---title:My Blog post---"));
        $data = $fileParser->getrawData();
        $this->assertStringContainsString('title:My Blog post',$data[1]);
    }
    public function test_parse_date_fileds()
    {
        $fileParser = (new MarkdonwFIleParser("---\ndate:May 14,1999\n---"));
        $data = $fileParser->getData();
        $this->assertInstanceOf(Carbon::class,$data['date']);
        $this->assertEquals('05/14/1999',$data['date']->format('m/d/Y'));
    }

    public function test_the_head_field_gets_spared()
    {
        $fileParser = (new MarkdonwFIleParser(__DIR__.'/../blogs/makdown.md'));
        $data = $fileParser->getData();
        $this->assertEquals('My Blog post',$data['title']);
        $this->assertEquals('my description',$data['description']);
    }

    public function test_body_filed_get_trim_saved(){
        $fileParser = (new MarkdonwFIleParser(__DIR__.'/../blogs/makdown.md'));
        $data = $fileParser->getData();

        $this->assertEquals("<h1>Hello</h1>\n<p>blog body here</p>",$data['body']);
    }


    /**
     * @test
     */
    public function an_extra_filed_gets_save()
    {
        $fileParser = (new MarkdonwFIleParser("---\nauthor: Jon Doe\n---\n"));
        $data = $fileParser->getData();
        $this->assertEquals(json_encode(['author'=>'Jon Doe']),$data['extra']);
    }

    /**
     * @test
     */
    public function two_additional_fileds_are_put_into_extra_collumn()
    {
        $fileParser = (new MarkdonwFIleParser("---\nauthor: Jon Doe\nimage:some/file.jpg\n---\n"));
        $data = $fileParser->getData();
        $this->assertEquals(json_encode(['author'=>'Jon Doe','image'=>'some/file.jpg']),$data['extra']);

    }

}
