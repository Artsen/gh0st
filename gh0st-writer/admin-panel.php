<?php

// Create the admin panel
function my_plugin_options_page() {
    // Check that the user is allowed to access the options page
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    // Check if the user has submitted the form
    if (isset($_POST['my_plugin_api_key'])) {
        // Sanitize the user input
        $api_key = sanitize_text_field($_POST['my_plugin_api_key']);
        // Save the API key to the database
        update_option('my_plugin_api_key', $api_key);
        // Display a success message
        echo '<div class="notice notice-success is-dismissible"><p>API key saved.</p></div>';
    }
    // Get the current API key from the database
    $api_key = get_option('my_plugin_api_key');
    // Display the options page
    include('admin-panel-template.php');
}

// Add the options page to the admin menu
function my_plugin_add_options_page() {
    add_options_page(
        'My Plugin Options',
        'My Plugin',
        'manage_options',
        'my-plugin',
        'my_plugin_options_page'
    );
}

// Register the options page
add_action('admin_menu', 'my_plugin_add_options_page');
?>