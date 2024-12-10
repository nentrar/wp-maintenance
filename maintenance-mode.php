<?php
/*
Plugin Name: Maintenance Mode
Description: A responsive and customizable "Under Construction" page with modern design.
Version: 1.0
Author: nentrar
License: GPL2
*/

function modern_maintenance_mode() {
    if (current_user_can('manage_options') || !get_option('modern_mm_enabled')) {
        return;
    }

    include plugin_dir_path(__FILE__) . 'templates/maintenance-page.php';
    exit;
}
add_action('template_redirect', 'modern_maintenance_mode');

function modern_mm_register_settings() {
    add_option('modern_mm_enabled', false);
    add_option('modern_mm_title', 'Under Construction');
    add_option('modern_mm_lead', 'We’re making improvements and will be back shortly.');
    add_option('modern_mm_background_image', '');
    add_option('modern_mm_social_icons', []);

    register_setting('modern_mm_settings', 'modern_mm_enabled');
    register_setting('modern_mm_settings', 'modern_mm_title');
    register_setting('modern_mm_settings', 'modern_mm_lead');
    register_setting('modern_mm_settings', 'modern_mm_background_image');
    register_setting('modern_mm_settings', 'modern_mm_social_icons');
}
add_action('admin_init', 'modern_mm_register_settings');

function modern_mm_add_admin_menu() {
    add_options_page(
        'Maintenance Mode',
        'Maintenance Mode',
        'manage_options',
        'modern-mm-settings',
        'modern_mm_settings_page'
    );
}
add_action('admin_menu', 'modern_mm_add_admin_menu');

function modern_mm_settings_page() {
    ?>
    <div class="wrap">
        <h1>Modern Maintenance Mode</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('modern_mm_settings');
            do_settings_sections('modern_mm_settings');
            ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Enable Maintenance Mode</th>
                    <td>
                        <input type="checkbox" name="modern_mm_enabled" value="1" <?php checked(1, get_option('modern_mm_enabled'), true); ?> />
                    </td>
                </tr>
                <tr>
                    <th scope="row">Title</th>
                    <td>
                        <input type="text" name="modern_mm_title" value="<?php echo esc_attr(get_option('modern_mm_title')); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">Lead Text</th>
                    <td>
                        <textarea name="modern_mm_lead"><?php echo esc_textarea(get_option('modern_mm_lead')); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Background Image URL</th>
                    <td>
                        <input type="text" name="modern_mm_background_image" value="<?php echo esc_url(get_option('modern_mm_background_image')); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">Social Icons</th>
                    <td>
                        <p>Add Font Awesome icon names (e.g., facebook, twitter) and their URLs in JSON format.</p>
                        <textarea name="modern_mm_social_icons"><?php echo esc_textarea(json_encode(get_option('modern_mm_social_icons'))); ?></textarea>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
