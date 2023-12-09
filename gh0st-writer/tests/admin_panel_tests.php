<?php

use PHPUnit\Framework\TestCase;

require_once '../admin-panel.php';

class AdminPanelTests extends TestCase
{
    public function testInputAPIKey()
    {
        $_POST['my_plugin_api_key'] = 'test_api_key';
        my_plugin_options_page();
        $this->assertEquals('test_api_key', get_option('my_plugin_api_key'));
    }

    public function testConfigureSettings()
    {
        $_POST['my_plugin_settings'] = array('tone' => 'casual', 'length' => 'medium');
        my_plugin_options_page();
        $this->assertEquals(array('tone' => 'casual', 'length' => 'medium'), get_option('my_plugin_settings'));
    }

    public function testGenerateContent()
    {
        $_POST['my_plugin_prompt'] = 'Write a blog post about artificial intelligence.';
        my_plugin_options_page();
        $this->assertNotEmpty(get_option('my_plugin_content'));
    }
}
?>
