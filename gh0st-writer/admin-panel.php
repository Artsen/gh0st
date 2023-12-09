<?php

// Create the admin panel
function my_plugin_options_page() {
    // Check that the user is allowed to access the options page
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    // Check if the user has submitted the form
    if (isset($_POST['my_plugin_api_key']) || isset($_POST['my_plugin_settings']) || isset($_POST['my_plugin_prompt'])) {
            $api_key = sanitize_text_field($_POST['my_plugin_api_key']);
            update_option('my_plugin_api_key', $api_key);
            $settings = $_POST['my_plugin_settings'];
            update_option('my_plugin_settings', $settings);
            $prompt = $_POST['my_plugin_prompt'];
            // Display a success message
            echo '<div class="notice notice-success is-dismissible"><p>API key and settings saved.</p></div>';
            $content = openai_generate_blog_content($prompt, $api_key);
            update_option('my_plugin_content', $content);
            // Display a success message
            echo '<div class="notice notice-success is-dismissible"><p>Content generated and saved.</p></div>';
        }
        $api_key = get_option('my_plugin_api_key');
        $settings = get_option('my_plugin_settings');
        $content = get_option('my_plugin_content');
        // Display the options page
        include('admin-panel-template.php');
    }
    // Add the options page to the admin menu and register it
    add_action('admin_menu', function() {
        add_options_page(
            'My Plugin Options',
            'My Plugin',
            'manage_options',
            'my-plugin',
            'my_plugin_options_page'
        );
    });
?>