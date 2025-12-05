<?php
// FILE: lib/cybersource/class-sdv-cybersource-settings.php:3
// FINAL CORRECTED VERSION

if (!defined('ABSPATH')) exit;

class Sdv_CyberSource_Settings_V2 {
    private $option_key = 'ww_cybs_settings';

    public function __construct() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_init', [$this, 'register_settings']);
    }

    /**
     * Creates a new top-level menu for the CyberSource settings.
     * This makes it independent of any other plugin.
     */
    public function add_admin_menu() {
        add_menu_page(
            'CyberSource Secure Payment Settings', // The title that appears on the page itself
            'CyberSource',                         // The title that appears in the admin menu
            'manage_options',                      // The capability required to see this menu
            'ww-cybersource-settings',             // The unique menu slug for this page
            [$this, 'render_page'],                 // The function that renders the page's HTML
            'dashicons-shield-alt',                // A nice security icon for the menu
            58                                     // The position in the menu order
        );
    }

    public function register_settings() {
        register_setting($this->option_key, $this->option_key);
        add_settings_section('cybs_main_section', 'CyberSource API Credentials', null, $this->option_key);

        $fields = [
            'merchant_id' => 'Merchant ID',
            'api_key_id'  => 'API Key ID (kId)',
            'secret_key'  => 'Shared Secret (Base64)',
            'environment' => 'Environment',
            'target_origin' => 'Target Origin (Your Website URL)',
        ];

        foreach ($fields as $key => $label) {
            add_settings_field($key, $label, [$this, 'render_field'], $this->option_key, 'cybs_main_section', ['key' => $key]);
        }
    }

    public function render_field($args) {
        $opts = get_option($this->option_key, []);
        $key  = $args['key'];
        $val  = isset($opts[$key]) ? esc_attr($opts[$key]) : '';

        if ($key === 'environment') {
            $val = $val ?: 'test';
            echo "<select name='{$this->option_key}[{$key}]'>";
            foreach (['test'=>'Sandbox (apitest.cybersource.com)','live'=>'Production (api.cybersource.com)'] as $k=>$lbl) {
                echo "<option value='{$k}' ".selected($val, $k, false).">".esc_html($lbl)."</option>";
            }
            echo '</select>';
            return;
        }

        if ($key === 'target_origin' && empty($val)) {
            $val = home_url();
        }

        echo "<input type='text' style='width: 420px; max-width: 100%;' name='{$this->option_key}[{$key}]' value='{$val}'/>";
        if ($key === 'target_origin') {
            echo '<p class="description">Must match your site URL. E.g., https://yourdomain.com. No trailing slash.</p>';
        }
        if ($key === 'secret_key') {
            echo '<p class="description">This is the base64 encoded secret string from your CyberSource security key.</p>';
        }
    }

    public function render_page() {
        ?>
        <div class="wrap">
            <h1>CyberSource Secure Payment Settings</h1>
            <p>Configure your REST API credentials for secure payments.</p>
            <form method="post" action="options.php">
                <?php
                settings_fields($this->option_key);
                do_settings_sections($this->option_key);
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}