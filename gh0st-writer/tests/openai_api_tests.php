<?php

use PHPUnit\Framework\TestCase;

require_once 'openai_api_example.php';

class OpenAIAPITests extends TestCase
{
    private $openai_api_key;

    protected function setUp(): void
    {
        $this->openai_api_key = file_get_contents('openai_api_key.txt');
    }

    public function testConnectionToAPI()
    {
        $headers = openai_authenticate($this->openai_api_key);
        $this->assertNotEmpty($headers);
    }

    public function testContentGeneration()
    {
        $prompt = 'Write a blog post about artificial intelligence.';
        $content = openai_generate_blog_content($prompt, $this->openai_api_key);
        $this->assertNotEmpty($content);
    }

    public function testContentAdjustment()
    {
        $prompt = 'Write a blog post about artificial intelligence.';
        $content = openai_generate_blog_content($prompt, $this->openai_api_key);
        $adjusted_content = adjust_content_to_bypass_detection($content);
        $this->assertNotEquals($content, $adjusted_content);
    }
}
?>
