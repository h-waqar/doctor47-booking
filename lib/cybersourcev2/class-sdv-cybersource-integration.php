<?php
// FILE: lib/cybersource/class-sdv-cybersource-integration.php

if (!defined('ABSPATH'))
    exit;

class Sdv_CyberSource_Integration
{

    public function __construct()
    {
        // Load the module's dependencies
        require_once __DIR__ . '/class-sdv-cybersource-settings.php';
        new Sdv_CyberSource_Settings_V2();
        require_once __DIR__ . '/class-sdv-cybersource-client.php';

        // Add WordPress hooks for API routes and scripts
        add_action('rest_api_init', [$this, 'register_api_routes']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    /**
     * Registers the private REST API endpoint needed by our JavaScript
     * to create a secure capture context from the server.
     */
    public function register_api_routes()
    {
        register_rest_route('doctor-booking/v1', '/capture-context', [
            'methods' => 'POST',
            'callback' => [$this, 'get_capture_context_callback'],
            'permission_callback' => '__return_true' // Accessible to any front-end user
        ]);
    }

    /**
     * The callback function for our REST API route.
     * It uses our new Client class to talk to CyberSource.
     */
    public function get_capture_context_callback()
    {
        $client = new Sdv_CyberSource_Client_V2();
        $res = $client->create_capture_context();

        if (is_wp_error($res)) {
            $status = $res->get_error_data()['status'] ?? 500;
            return new WP_REST_Response(['error' => $res->get_error_message()], $status);
        }

        // --- DEFINITIVE FIX APPLIED HERE ---
        // The new endpoint returns the key directly, which we wrap in a JSON object
        // for our front-end script to use consistently.
        $capture_context_key = $res['key'];
        return new WP_REST_Response(['captureContext' => $capture_context_key], 200);
    }

    /**
     * Registers and localizes our new front-end JavaScript for the Microform.
     */
    public function enqueue_scripts()
    {
        // We only need this script on the front-end, not in the admin area
        if (is_admin()) {
            return;
        }

        wp_register_script(
            'sdv-cybersource-handler-js-v2',
            plugins_url('lib/cybersourcev2/CyberSourceHandler.js', CC_PLUGIN_BASEFILE),
            ['jquery'], // No dependencies
            CC_PLUGIN_VERSION,
            true // Load in the footer
        );

        wp_enqueue_script('sdv-cybersource-handler-js-v2');

        // This securely passes the URL of our REST API endpoint to the JavaScript file
        wp_localize_script('sdv-cybersource-handler-js-v2', 'cybs_object', [
            'restUrl' => esc_url_raw(rest_url('doctor-booking/v1/capture-context')),
            'ajaxUrl' => admin_url('admin-ajax.php')
        ]);
    }
}