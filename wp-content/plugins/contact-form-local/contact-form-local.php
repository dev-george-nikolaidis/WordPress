<?php

declare(strict_types=1);

/*
 * Plugin Name:       Contact Form Local
 * Plugin URI:        https://example.com/plugins/contact Form Local
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Dev Geo Nik
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       contact-form-local
 * Domain Path:       /languages
 * Requires Plugins:
 */





if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
};





class ContactFormLocal
{
    public function __construct()
    {
        // create custom post type
        add_action('init', [$this, 'create_custom_post_type_form']);
        add_action('wp_enqueue_scripts', [$this, 'load_assets']);
        add_shortcode('shortcode_name', [$this, 'shortcode_function']);
        add_shortcode('contact-form-local', [$this, 'load_shortcode']);

        add_action('wp_footer', [$this, 'load_scripts']);

        // custom end point api hook
        add_action('rest_api_init', [$this, 'register_rest_api']);
    }

    // trick to write direct input
    public function load_shortcode()
    {
        ?>
<div class="form-wrapper">
    <form id="contact-form-local-id" method="post" data-url="<?php echo esc_url(get_rest_url(null, 'contact-form-local/v1/send-email')); ?>" data-nonce="<?php echo wp_create_nonce('wp_rest'); ?>">
        <h1>Send us an email</h1>
        <div class="form-control">
            <input type="text" placeholder="Enter your name" name="name">
        </div>
        <div class="form-control">
            <input type="email" placeholder="Enter your email" name="email-value">
        </div>
        <div class="form-control">
            <input type="tel" placeholder="Enter your phone number" name="phone">
        </div>
        <textarea name="message-value" placeholder="Enter your message"></textarea>
        <button type="submit" class="btn-form">Submit</button>
    </form>
</div>
<?php
    }




    public function register_rest_api()
    {

        register_rest_route('contact-form-local/v1', 'send-email', [
            'methods' => 'POST',
            'callback' => [$this, 'handle_contact_form'],

        ]);
    }

    public function shortcode_function()
    {
        return date('Y');
    }

    public function handle_contact_form($request)
    {
        $headers = $request->get_headers();
        $params = $request->get_params();

        $nonce = $headers['x_wp_nonce'][0];

        //    check if we have correct csrf token
        if (!wp_verify_nonce($nonce, 'wp_rest')) {
            return new WP_REST_Response('Message not sent ', 422);
        }

        // do logic
        $post_id = wp_insert_post([
            'post_type' => 'contact-form-local',
            'post_title' => 'Contact Form Entry2',
            'post_status' => 'publish',
        ]);


        if($post_id) {
            return new WP_REST_Response('Thank you for your message', 200);
        }
        // // save data
        // update_field('name', $data['name'], $post_id);
        // update_field('email', $data['email'], $post_id);
        // update_field('phone', $data['phone'], $post_id);
        // update_field('message', $data['message'], $post_id);


    }

    public function create_custom_post_type_form()
    {
        $args = [
            'public' => true,
            'has_archive' => true,
            'supports' => ['title'],
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'capability' => 'manage_options',
            'labels' => [
                'name' => 'Contact Form',
                'singular_name' => 'Contact Form Entry'
            ],
            'menu_icon' => 'dashicons-forms'
        ];

        register_post_type('contact-form-local', $args);
    }


    public function load_assets()
    {

        wp_enqueue_style('contact-form-local', plugin_dir_url(__FILE__) . '/assets/css/contact-form-local.css', [], '1', 'all');


    }

    public function load_scripts()
    {
        wp_enqueue_script('jquery');
        wp_enqueue_script('contact-form-local', plugin_dir_url(__FILE__) . '/assets/js/contact-form-local.js', [], null, true);
    }
}
new ContactFormLocal();
?>