<?php

/*
 * Plugin Name:       Logicrays Easy Coming soon page
 * Plugin URI:        https://wordpress.org/plugins/logicrays-easy-coming-soon-page/
 * Description:       Add a maintenance or coming soon page easily to your website/blog that lets visitors know your website is under maintenance.
 * Tags:              responsive, images, responsive images, disable, srcset
 * Version:           1.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Logicrays
 * Author URI:        http://logicrays.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://wordpress.org/plugins/logicrays-easy-coming-soon-page/
 * Text Domain:       lr-easy-coming-soon-page
 * Domain Path:       /languages
 */

define("lecsp-coming-soon-page", "lecsp_coming_soon_page");
define('lecsp_plugin_url', plugins_url('', __FILE__));
ini_set('allow_url_fopen', 1);



class LR_Easy_Coming_Soon_Page
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'lecsp_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'lecsp_backend_scripts'));
        add_action("admin_init", array($this, "lecsp_fields"));
    }
    public function lecsp_admin_menu()
    {
        add_menu_page(
            'LR Easy Coming Soon Page Settings',
            'LR Coming Soon',
            'manage_options',
            'lecsp-setting-page',
            array($this, 'lecsp_setting_page'),
        );
    }
    public function lecsp_backend_scripts()
    {
        wp_enqueue_media();
        wp_enqueue_style('wp-color-picker');

        wp_enqueue_script('wp-color-picker', false, array('jquery'));
        wp_enqueue_script('color-picker-custom', lecsp_plugin_url . '/js/color-picker.js', true);
        wp_enqueue_script('wp-custom-js', lecsp_plugin_url . '/js/mediaupload.js', true);
    }
    public function lecsp_setting_page()
    { ?>
        <div class="wrap">
            <div class="icon32" id="icon-options-general"><br>
            </div>
            <h2>Logicrays Easy Coming soon page settings</h2>
            <form action="options.php" method="post" enctype="multipart/form-data">
                <?php
                settings_fields("section");
                ?>
                <?php
                do_settings_sections("csoon-options");
                $option_name = get_option('body_background_image');
                if (isset($_REQUEST[$option_name])) {
                    update_option($option_name, $_REQUEST[$option_name]);
                }
                submit_button();
                ?>
            </form>
        </div>
    <?php
    }
    public function lecsp_fields()
    {
        add_settings_section("section", "All Settings", null, "csoon-options");
        add_settings_field("lecsp_status", "Status", array($this, "lecsp_status_element"), "csoon-options", "section");
        add_settings_field("lecsp_robots_meta", "Robots meta tag", array($this, "lecsp_robots_meta_element"), "csoon-options", "section");
        add_settings_field("lecsp_title", "Title (HTML tag)", array($this, "lecsp_title_element"), "csoon-options", "section");
        add_settings_field("lecsp_heading", "Heading", array($this, "lecsp_heading_element"), "csoon-options", "section");
        add_settings_field("lecsp_heading_text_color", "Heading text color", array($this, "lecsp_heading_textcolor_element"), "csoon-options", "section");
        add_settings_field("lecsp_coming_soon_text", "Coming soon text", array($this, "lecsp_coming_soon_text_element"), "csoon-options", "section");
        add_settings_field(" body_background_image", "Upload background image", array($this, "body_background_image_element"), "csoon-options", "section");
        add_settings_field("lecsp_show_social_media", "Social media?", array($this, "lecsp_show_social_media_element"), "csoon-options", "section");
        add_settings_field("lecsp_fb_link", "Facebok Link", array($this, "lecsp_fb_link_element"), "csoon-options", "section");
        add_settings_field("lecsp_twiiter_link", "Twitter Link", array($this, "lecsp_twiiter_link_element"), "csoon-options", "section");
        add_settings_field("lecsp_insta_link", "Instagram Link", array($this, "lecsp_insta_link_element"), "csoon-options", "section");
        add_settings_field("lecsp_pinterest_link", "Pinterest Link", array($this, "lecsp_pinterest_link_element"), "csoon-options", "section");
        add_settings_field("lecsp_google_link", "Google+ Link", array($this, "lecsp_google_link_element"), "csoon-options", "section");
        add_settings_field("lecsp_linkedin_link", "Linkedin Link", array($this, "lecsp_linkedin_link_element"), "csoon-options", "section");

        register_setting("section", "lecsp_status");
        register_setting("section", "lecsp_robots_meta");
        register_setting("section", "lecsp_title");
        register_setting("section", "lecsp_heading");
        register_setting("section", "lecsp_heading_text_color");
        register_setting("section", "lecsp_coming_soon_text");
        register_setting("section", "body_background_image");
        register_setting("section", "lecsp_show_social_media");
        register_setting("section", "lecsp_fb_link");
        register_setting("section", "lecsp_twiiter_link");
        register_setting("section", "lecsp_pinterest_link");
        register_setting("section", "lecsp_google_link");
        register_setting("section", "lecsp_linkedin_link");
        register_setting("section", "lecsp_insta_link");
    }
    public function lecsp_status_element()
    {
        $options = get_option('lecsp_status');
    ?>
        <select id="lecsp_status" name='lecsp_status[lecsp_status]'>
            <option value='no' <?php selected($options['lecsp_status'], 'no'); ?>><?php _e('No', 'lecsp-coming-soon-page'); ?></option>
            <option value='yes' <?php selected($options['lecsp_status'], 'yes'); ?>><?php _e('Yes', 'lecsp-coming-soon-page'); ?></option>
        </select>
        <p class="description"><?php _e('Select status', 'lr-easy-coming-soon-page'); ?></p>
    <?php
    }
    public function lecsp_robots_meta_element()
    {
        $options = get_option('lecsp_robots_meta');
    ?>
        <select id="lecsp_robots_meta" name='lecsp_robots_meta[lecsp_robots_meta]'>
            <option value='0' <?php selected($options['lecsp_robots_meta'], '0'); ?>><?php _e('index, follow', 'lecsp-coming-soon-page'); ?></option>
            <option value='1' <?php selected($options['lecsp_robots_meta'], '1'); ?>><?php _e('noindex, nofollow', 'lecsp-coming-soon-page'); ?></option>
        </select>
        <p class="description"><?php _e('The robots meta tag lets you use a granular, page-specific approach to control how an individual page should be indexed and served to users in search results.', 'lr-easy-coming-soon-page'); ?></p>
    <?php
    }
    public function lecsp_title_element()
    {
        $options = get_option('lecsp_title');
    ?>
        <input size="50" type="text" name="lecsp_title" id="lecsp_title" value="<?php echo get_option('lecsp_title'); ?>" />
    <?php
    }
    public function lecsp_heading_element()
    {
        $options = get_option('lecsp_heading');
    ?>
        <input size="50" type="text" name="lecsp_heading" id="lecsp_heading" value="<?php echo get_option('lecsp_heading'); ?>" />
        <p class="description"><?php _e('Please enter Heading title', 'lr-easy-coming-soon-page'); ?></p>
    <?php }
    public function lecsp_heading_textcolor_element()
    {
        $options = get_option('lecsp_heading_text_color');
    ?>
        <input type="text" name="lecsp_heading_text_color[button_color]" id="lecsp_heading_text_color" class="color-field" value="<?php echo esc_attr($options['button_color']); ?>" />
        <p class="description"><?php _e('Please enter title', 'lr-easy-coming-soon-page'); ?></p>

    <?php }
    public function lecsp_coming_soon_text_element()
    {
        $lecsp_coming_soon_text = get_option('lecsp_coming_soon_text');
        echo wp_editor(
            $lecsp_coming_soon_text,
            'lecspcomingsoontext',
            array('textarea_name' => 'lecsp_coming_soon_text', 'textarea_rows' => 8)
        );
    }
    public function body_custom_background($name, $value = '')
    {
        $image = ' button">Upload image';
        $image_size = 'full'; // it would be better to use thumbnail size here (150x150 or so)
        $display = 'none'; // display state ot the "Remove image" button

        if ($image_attributes = wp_get_attachment_image_src($value, $image_size)) {
            $image = '"><img src="' . $image_attributes[0] . '" style="max-width:10%;display:block;" />';
            $display = 'inline-block';
        }
        return '
    <div>
        <a href="#" class="lecsp_upload_image_button' . $image . '</a>
        <input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '" />
        <a href="#" class="lecsp_remove_image_button" style="display:inline-block;display:' . $display . '">Remove image</a>
    </div>';
    }
    public function body_background_image_element()
    {
        $option_name = 'body_background_image';
        //echo body_custom_background($option_name, get_option($option_name));
        echo $this->body_custom_background($option_name, get_option($option_name));
    }
    public function lecsp_fb_link_element()
    {
        $options = get_option('lecsp_fb_link');
    ?>
        <input size="50" type="text" name="lecsp_fb_link" id="lecsp_fb_link" class=""
            value="<?php echo get_option('lecsp_fb_link'); ?>" />
        <p class="description"><?php esc_html_e('Enter Facebook page link.', 'lr-easy-coming-soon-page'); ?></p>
    <?php
    }
    public function lecsp_twiiter_link_element()
    {
        $options = get_option('lecsp_twiiter_link');
    ?>
        <input size="50" type="text" name="lecsp_twiiter_link" id="lecsp_twiiter_link" class=""
            value="<?php echo get_option('lecsp_twiiter_link'); ?>" />
        <p class="description"><?php _e('Enter Twiiter page link.', 'lr-easy-coming-soon-page'); ?></p>
    <?php
    }
    public function lecsp_pinterest_link_element()
    {
        $options = get_option('lecsp_pinterest_link');
    ?>
        <input size="50" type="text" name="lecsp_pinterest_link" id="lecsp_pinterest_link" class=""
            value="<?php echo get_option('lecsp_pinterest_link'); ?>" />
        <p class="description"><?php _e('Enter Pinterest page link.', 'lr-easy-coming-soon-page'); ?></p>
    <?php
    }
    public function lecsp_google_link_element()
    {
        $options = get_option('lecsp_google_link');
    ?>
        <input size="50" type="text" name="lecsp_google_link" id="lecsp_google_link" class=""
            value="<?php echo get_option('lecsp_google_link'); ?>" />
        <p class="description"><?php _e('Enter Google+ page link.', 'lr-easy-coming-soon-page'); ?></p>
    <?php
    }
    public function lecsp_linkedin_link_element()
    {
        $options = get_option('lecsp_linkedin_link');
    ?>
        <input size="50" type="text" name="lecsp_linkedin_link" id="lecsp_linkedin_link" class=""
            value="<?php echo get_option('lecsp_linkedin_link'); ?>" />
        <p class="description"><?php _e('Enter Linkedin page link.', 'lr-easy-coming-soon-page'); ?></p>
    <?php
    }
    public function lecsp_insta_link_element()
    {
        $options = get_option('lecsp_insta_link');
    ?>
        <input size="50" type="text" name="lecsp_insta_link" id="lecsp_insta_link" class=""
            value="<?php echo get_option('lecsp_insta_link'); ?>" />
        <p class="description"><?php _e('Enter Twiiter page link.', 'lr-easy-coming-soon-page'); ?></p>
    <?php
    }
    public function lecsp_show_social_media_element()
    {
        $options = get_option('lecsp_show_social_media');
    ?>
        <select id="lecsp_show_social_media" name='lecsp_show_social_media[lecsp_show_social_media]'>
            <option value='no' <?php selected($options['lecsp_show_social_media'], 'no'); ?>><?php _e('No', 'lecsp-coming-soon-page'); ?></option>
            <option value='yes' <?php selected($options['lecsp_show_social_media'], 'yes'); ?>><?php _e('Yes', 'lecsp-coming-soon-page'); ?></option>
        </select>
        <p class="description"><?php _e('Select Social media enable/disable', 'lr-easy-coming-soon-page'); ?></p>
<?php
    }
}

new LR_Easy_Coming_Soon_Page();

$lecsp_status = get_option('lecsp_status');
if (isset($lecsp_status['lecsp_status']) && $lecsp_status['lecsp_status'] === 'yes') {
    require_once 'includes/class-lecsp.php';
}
