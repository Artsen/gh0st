<?php

use PHPUnit\Framework\TestCase;

require_once 'gpt_blog_generator.php';

class AIContentDetectionTests extends TestCase
{
    private $api_key = 'test_api_key';
    private $industry = 'technology';
    private $topic = 'artificial intelligence';
    private $benefit = 'understanding AI';
    private $tone = 'informative';
    private $length = 500;

    public function testAIDetection()
    {
        $content = generate_blog_content($this->api_key, $this->industry, $this->topic, $this->benefit, $this->tone, $this->length);
        $this->assertTrue(detect_ai_content($content));
    }

    public function testContentAdjustment()
    {
        $content = generate_blog_content($this->api_key, $this->industry, $this->topic, $this->benefit, $this->tone, $this->length);
        $adjusted_content = adjust_content_to_bypass_detection($content);
        $this->assertNotEquals($content, $adjusted_content);
    }

    public function testUndetectableContent()
    {
        $content = generate_blog_content($this->api_key, $this->industry, $this->topic, $this->benefit, $this->tone, $this->length);
        $adjusted_content = adjust_content_to_bypass_detection($content);
        $this->assertFalse(detect_ai_content($adjusted_content));
    }
}
