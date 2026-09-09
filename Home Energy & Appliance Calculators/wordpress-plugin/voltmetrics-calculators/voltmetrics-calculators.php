<?php
/**
 * Plugin Name: VoltMetrics Energy & Appliance Calculators
 * Plugin URI: https://voltmetrics.com
 * Description: Embed 15 high-precision residential energy and appliance electricity cost calculators into any WordPress post, page, or widget with shortcodes.
 * Version: 1.0.0
 * Author: VoltMetrics Energy Solutions
 * Author URI: https://voltmetrics.com
 * License: GPL-2.0+
 * Text Domain: voltmetrics-calculators
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class VoltMetricsCalculatorsPlugin {

    const VERSION = '1.0.0';

    public function __construct() {
        add_shortcode('voltmetrics_calc', [$this, 'render_calculator_shortcode']);
        add_shortcode('energy_calculator', [$this, 'render_calculator_shortcode']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        add_action('admin_menu', [$this, 'register_admin_menu']);
    }

    public function enqueue_assets() {
        wp_register_style('voltmetrics-embed-css', plugins_url('assets/embed.css', __FILE__), [], self::VERSION);
    }

    /**
     * Render Calculator Shortcode
     * Usage: [voltmetrics_calc type="appliance" currency="USD" theme="light" height="750px"]
     */
    public function render_calculator_shortcode($atts) {
        $a = shortcode_atts([
            'type'         => 'appliance',
            'theme'        => 'light',
            'currency'     => 'USD',
            'default_rate' => '0.1830',
            'width'        => '100%',
            'height'       => '760px',
            'src_url'      => ''
        ], $atts, 'voltmetrics_calc');

        // Mapping types to calculator permalinks
        $map = [
            'appliance'       => '/calculators/appliance-electricity-cost.php',
            'ac'              => '/calculators/air-conditioner-running-cost.php',
            'air-conditioner' => '/calculators/air-conditioner-running-cost.php',
            'minisplit'       => '/calculators/mini-split-electricity-cost.php',
            'spaceheater'     => '/calculators/space-heater-cost.php',
            'watts'           => '/calculators/watts-to-monthly-cost.php',
            'fridge'          => '/calculators/refrigerator-energy-cost.php',
            'heatpump'        => '/calculators/heat-pump-savings.php',
            'ceilingfan'      => '/calculators/ceiling-fan-electricity.php',
            'genruntime'      => '/calculators/generator-runtime.php',
            'genfuel'         => '/calculators/generator-fuel-cost.php',
            'solarbattery'    => '/calculators/solar-battery-runtime.php',
            'powerstation'    => '/calculators/portable-power-station-runtime.php',
            'evcharging'      => '/calculators/ev-home-charging-cost.php',
            'poolpump'        => '/calculators/pool-pump-electricity.php',
            'billincrease'    => '/calculators/electricity-bill-increase.php'
        ];

        $type_key = sanitize_key($a['type']);
        $path = isset($map[$type_key]) ? $map[$type_key] : $map['appliance'];
        
        $base_url = !empty($a['src_url']) ? esc_url_raw($a['src_url']) : get_option('voltmetrics_base_url', 'https://voltmetrics.com');
        $calc_url = rtrim($base_url, '/') . $path . '?embed=1&currency=' . esc_attr($a['currency']) . '&theme=' . esc_attr($a['theme']);

        ob_start();
        ?>
        <div class="voltmetrics-wp-wrapper" style="max-width: <?php echo esc_attr($a['width']); ?>; margin: 20px auto; width: 100%;">
            <iframe 
                src="<?php echo esc_url($calc_url); ?>" 
                title="VoltMetrics Calculator - <?php echo esc_attr($type_key); ?>" 
                style="width: 100%; height: <?php echo esc_attr($a['height']); ?>; border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); overflow: hidden;" 
                loading="lazy" 
                frameborder="0"
                allow="clipboard-write">
            </iframe>
            <div style="text-align: right; font-size: 11px; color: #94a3b8; margin-top: 6px; font-family: sans-serif;">
                Powered by <a href="<?php echo esc_url($base_url); ?>" target="_blank" rel="noopener" style="color: #10b981; text-decoration: none; font-weight: 600;">VoltMetrics Energy Intelligence</a>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public function register_admin_menu() {
        add_options_page(
            'VoltMetrics Calculators',
            'VoltMetrics Calculators',
            'manage_options',
            'voltmetrics-settings',
            [$this, 'render_admin_settings']
        );
    }

    public function render_admin_settings() {
        if (isset($_POST['voltmetrics_save']) && check_admin_referer('voltmetrics_save_action')) {
            update_option('voltmetrics_base_url', sanitize_text_field($_POST['voltmetrics_base_url']));
            echo '<div class="notice notice-success is-dismissible"><p>VoltMetrics settings saved.</p></div>';
        }

        $base_url = get_option('voltmetrics_base_url', 'https://voltmetrics.com');
        ?>
        <div class="wrap">
            <h1>VoltMetrics Energy Calculators & WordPress Integration</h1>
            <p>Easily embed any of the 15 energy intelligence calculators using the shortcodes below.</p>
            
            <form method="post" action="">
                <?php wp_nonce_field('voltmetrics_save_action'); ?>
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="voltmetrics_base_url">Calculator App Base URL</label></th>
                        <td>
                            <input name="voltmetrics_base_url" type="url" id="voltmetrics_base_url" value="<?php echo esc_attr($base_url); ?>" class="regular-text">
                            <p class="description">URL where your VoltMetrics PHP application is hosted (e.g. <code>https://voltmetrics.com</code> or local host).</p>
                        </td>
                    </tr>
                </table>
                <p class="submit"><input type="submit" name="voltmetrics_save" class="button button-primary" value="Save Settings"></p>
            </form>

            <h2>Available Calculator Shortcodes</h2>
            <table class="widefat striped">
                <thead>
                    <tr>
                        <th>Calculator Name</th>
                        <th>Shortcode</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Appliance Electricity Cost</td><td><code>[voltmetrics_calc type="appliance"]</code></td><td>Appliances</td></tr>
                    <tr><td>Watts to Monthly Cost</td><td><code>[voltmetrics_calc type="watts"]</code></td><td>Appliances</td></tr>
                    <tr><td>Refrigerator Energy Cost</td><td><code>[voltmetrics_calc type="fridge"]</code></td><td>Appliances</td></tr>
                    <tr><td>Air-Conditioner Running Cost</td><td><code>[voltmetrics_calc type="ac"]</code></td><td>HVAC</td></tr>
                    <tr><td>Mini-Split Inverter Cost</td><td><code>[voltmetrics_calc type="minisplit"]</code></td><td>HVAC</td></tr>
                    <tr><td>Space Heater Bill Impact</td><td><code>[voltmetrics_calc type="spaceheater"]</code></td><td>HVAC</td></tr>
                    <tr><td>Heat Pump Fuel Savings</td><td><code>[voltmetrics_calc type="heatpump"]</code></td><td>HVAC</td></tr>
                    <tr><td>Ceiling Fan Energy</td><td><code>[voltmetrics_calc type="ceilingfan"]</code></td><td>HVAC</td></tr>
                    <tr><td>Generator Runtime (Hours/Tank)</td><td><code>[voltmetrics_calc type="genruntime"]</code></td><td>Backup Power</td></tr>
                    <tr><td>Generator Fuel Cost</td><td><code>[voltmetrics_calc type="genfuel"]</code></td><td>Backup Power</td></tr>
                    <tr><td>Solar Battery Storage Runtime</td><td><code>[voltmetrics_calc type="solarbattery"]</code></td><td>Backup Power</td></tr>
                    <tr><td>Portable Power Station Sizing</td><td><code>[voltmetrics_calc type="powerstation"]</code></td><td>Backup Power</td></tr>
                    <tr><td>EV Home Charging Cost</td><td><code>[voltmetrics_calc type="evcharging"]</code></td><td>EV & Utility</td></tr>
                    <tr><td>Pool Pump Electricity Audit</td><td><code>[voltmetrics_calc type="poolpump"]</code></td><td>EV & Utility</td></tr>
                    <tr><td>Electricity Bill Spike Increase</td><td><code>[voltmetrics_calc type="billincrease"]</code></td><td>EV & Utility</td></tr>
                </tbody>
            </table>
        </div>
        <?php
    }
}

new VoltMetricsCalculatorsPlugin();
