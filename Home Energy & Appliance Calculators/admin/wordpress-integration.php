<?php
require_once __DIR__ . '/../config/site_config.php';
require_once __DIR__ . '/../config/rates.php';

$page_title = "WordPress & CMS Integration Studio - VoltMetrics Admin";

$calc_options = [
    'appliance'       => ['name' => 'Appliance Electricity Cost', 'path' => '/calculators/appliance-electricity-cost.php', 'cat' => 'Everyday Appliances'],
    'watts'           => ['name' => 'Watts to Monthly Cost', 'path' => '/calculators/watts-to-monthly-cost.php', 'cat' => 'Everyday Appliances'],
    'fridge'          => ['name' => 'Refrigerator Energy Cost', 'path' => '/calculators/refrigerator-energy-cost.php', 'cat' => 'Everyday Appliances'],
    'ac'              => ['name' => 'Air-Conditioner Running Cost', 'path' => '/calculators/air-conditioner-running-cost.php', 'cat' => 'HVAC & Climate'],
    'minisplit'       => ['name' => 'Mini-Split Inverter Cost', 'path' => '/calculators/mini-split-electricity-cost.php', 'cat' => 'HVAC & Climate'],
    'spaceheater'     => ['name' => 'Space Heater Cost', 'path' => '/calculators/space-heater-cost.php', 'cat' => 'HVAC & Climate'],
    'heatpump'        => ['name' => 'Heat Pump Savings', 'path' => '/calculators/heat-pump-savings.php', 'cat' => 'HVAC & Climate'],
    'ceilingfan'      => ['name' => 'Ceiling Fan Electricity', 'path' => '/calculators/ceiling-fan-electricity.php', 'cat' => 'HVAC & Climate'],
    'genruntime'      => ['name' => 'Generator Runtime (Hours/Tank)', 'path' => '/calculators/generator-runtime.php', 'cat' => 'Backup Power'],
    'genfuel'         => ['name' => 'Generator Fuel Cost', 'path' => '/calculators/generator-fuel-cost.php', 'cat' => 'Backup Power'],
    'solarbattery'    => ['name' => 'Solar Battery Runtime', 'path' => '/calculators/solar-battery-runtime.php', 'cat' => 'Backup Power'],
    'powerstation'    => ['name' => 'Portable Power Station Sizing', 'path' => '/calculators/portable-power-station-runtime.php', 'cat' => 'Backup Power'],
    'evcharging'      => ['name' => 'EV Home Charging Cost', 'path' => '/calculators/ev-home-charging-cost.php', 'cat' => 'EV & Utility'],
    'poolpump'        => ['name' => 'Pool Pump Electricity', 'path' => '/calculators/pool-pump-electricity.php', 'cat' => 'EV & Utility'],
    'billincrease'    => ['name' => 'Electricity Bill Spike Increase', 'path' => '/calculators/electricity-bill-increase.php', 'cat' => 'EV & Utility'],
];

require_once __DIR__ . '/includes/admin-header.php';
?>

<div class="container" style="max-width: 1400px; margin: 0 auto; padding: 0 16px;">

    <!-- Breadcrumbs & Header -->
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px; flex-wrap: wrap; gap: 16px;">
        <div>
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                <span style="font-size: 0.8125rem; color: #64748b; font-weight: 600;">Admin Console</span>
                <span style="color: #cbd5e1;">/</span>
                <span style="font-size: 0.8125rem; color: #10b981; font-weight: 700;">WordPress & CMS Integration</span>
            </div>
            <h1 style="font-size: 2rem; font-weight: 800; color: #0f172a; margin: 0; font-family: var(--font-heading); letter-spacing: -0.03em;">
                WordPress Integration & Embed Studio
            </h1>
            <p style="color: #64748b; font-size: 0.9375rem; margin: 4px 0 0;">
                Deploy any of the 15 energy intelligence calculators into your WordPress site, Elementor, Gutenberg, or any external CMS.
            </p>
        </div>

        <div style="display: flex; gap: 10px;">
            <a href="/admin/seo-dashboard.php" style="background: white; border: 1px solid #cbd5e1; color: #334155; padding: 10px 18px; border-radius: 8px; font-weight: 700; font-size: 0.875rem; text-decoration: none;">
                &larr; Return to Rank Math SEO
            </a>
        </div>
    </div>

    <!-- 2-Column Main Layout: Left = Interactive Generator, Right = Documentation & Plugin Info -->
    <div style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 28px; margin-bottom: 40px;">

        <!-- Left: Interactive Generator -->
        <div>
            <div style="background: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); margin-bottom: 24px;">
                <h2 style="font-size: 1.25rem; font-weight: 800; color: #0f172a; margin: 0 0 16px; font-family: var(--font-heading);">
                    Interactive Shortcode & Embed Generator
                </h2>

                <!-- Form Controls -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: #334155; margin-bottom: 6px;">
                            Select Calculator:
                        </label>
                        <select id="selCalc" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; font-weight: 600; color: #0f172a; background: white;">
                            <?php foreach ($calc_options as $key => $opt): ?>
                                <option value="<?php echo $key; ?>" data-path="<?php echo $opt['path']; ?>">
                                    [<?php echo $opt['cat']; ?>] <?php echo $opt['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: #334155; margin-bottom: 6px;">
                            Default Currency:
                        </label>
                        <select id="selCurrency" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; font-weight: 600; color: #0f172a; background: white;">
                            <option value="USD">USD ($ - US Average)</option>
                            <option value="GBP">GBP (£ - United Kingdom)</option>
                            <option value="EUR">EUR (€ - European Union)</option>
                            <option value="CAD">CAD (CA$ - Canada)</option>
                            <option value="AUD">AUD (AU$ - Australia)</option>
                        </select>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;">
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: #334155; margin-bottom: 6px;">
                            Theme Mode:
                        </label>
                        <select id="selTheme" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; font-weight: 600; color: #0f172a; background: white;">
                            <option value="light">Light (Recommended)</option>
                            <option value="dark">Dark Slate</option>
                            <option value="auto">Auto / Adaptive</option>
                        </select>
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: #334155; margin-bottom: 6px;">
                            Embed Height:
                        </label>
                        <select id="selHeight" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; font-weight: 600; color: #0f172a; background: white;">
                            <option value="760px">760px (Standard Viewport)</option>
                            <option value="850px">850px (Comfortable with FAQ)</option>
                            <option value="650px">650px (Compact Widget)</option>
                        </select>
                    </div>
                </div>

                <!-- Generated Shortcode Box -->
                <div style="margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                        <span style="font-size: 0.8125rem; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 6px;">
                            <span style="background: #eff6ff; color: #2563eb; padding: 2px 6px; border-radius: 4px; font-size: 0.6875rem; font-weight: 800;">WP SHORTCODE</span>
                            For WordPress Posts, Pages & Gutenberg Blocks
                        </span>
                        <button type="button" id="btnCopyShortcode" onclick="copyText('outShortcode', 'btnCopyShortcode')" style="background: #10b981; color: white; border: none; padding: 6px 14px; border-radius: 6px; font-size: 0.75rem; font-weight: 700; cursor: pointer;">
                            Copy Shortcode
                        </button>
                    </div>
                    <textarea id="outShortcode" readonly rows="2" style="width: 100%; font-family: 'JetBrains Mono', monospace; font-size: 0.875rem; background: #0f172a; color: #34d399; padding: 12px; border-radius: 8px; border: 1px solid #1e293b; resize: none;"></textarea>
                </div>

                <!-- Generated HTML / Iframe Box -->
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                        <span style="font-size: 0.8125rem; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 6px;">
                            <span style="background: #fdf2f8; color: #db2777; padding: 2px 6px; border-radius: 4px; font-size: 0.6875rem; font-weight: 800;">HTML IFRAME</span>
                            For Custom HTML Blocks, Elementor, Webflow & Squarespace
                        </span>
                        <button type="button" id="btnCopyIframe" onclick="copyText('outIframe', 'btnCopyIframe')" style="background: #0f172a; color: white; border: none; padding: 6px 14px; border-radius: 6px; font-size: 0.75rem; font-weight: 700; cursor: pointer;">
                            Copy HTML
                        </button>
                    </div>
                    <textarea id="outIframe" readonly rows="4" style="width: 100%; font-family: 'JetBrains Mono', monospace; font-size: 0.8125rem; background: #0f172a; color: #93c5fd; padding: 12px; border-radius: 8px; border: 1px solid #1e293b; resize: none;"></textarea>
                </div>

            </div>

            <!-- Live Embed Previewer -->
            <div style="background: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
                    <div>
                        <h3 style="font-size: 1.125rem; font-weight: 800; color: #0f172a; margin: 0; font-family: var(--font-heading);">
                            Live Embed Simulation
                        </h3>
                        <p style="color: #64748b; font-size: 0.8125rem; margin: 2px 0 0;">
                            How the calculator renders inside a WordPress blog article container:
                        </p>
                    </div>
                    <span style="background: #ecfdf5; color: #047857; font-size: 0.75rem; font-weight: 800; padding: 4px 10px; border-radius: 9999px;">
                        Interactive Live Preview
                    </span>
                </div>

                <div style="border: 2px dashed #cbd5e1; border-radius: 12px; padding: 12px; background: #f8fafc;">
                    <iframe id="previewFrame" src="/calculators/appliance-electricity-cost.php" style="width: 100%; height: 600px; border: 1px solid #e2e8f0; border-radius: 8px; background: white;" loading="lazy"></iframe>
                </div>
            </div>
        </div>

        <!-- Right: WordPress Plugin Details & Installation Instructions -->
        <div>
            <!-- Plugin Card -->
            <div style="background: #0f172a; color: white; border-radius: 16px; padding: 24px; margin-bottom: 24px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 14px;">
                    <div style="width: 44px; height: 44px; background: #2563eb; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="white"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                    </div>
                    <div>
                        <div style="font-size: 1.125rem; font-weight: 800; font-family: var(--font-heading);">
                            VoltMetrics WordPress Plugin
                        </div>
                        <div style="font-size: 0.75rem; color: #94a3b8;">
                            Version 1.0.0 &bull; Ready for WordPress 6.x
                        </div>
                    </div>
                </div>

                <p style="font-size: 0.875rem; color: #cbd5e1; line-height: 1.5; margin-bottom: 16px;">
                    A production-ready WordPress plugin is pre-built inside this codebase at:
                </p>

                <div style="background: #1e293b; border: 1px solid #334155; border-radius: 8px; padding: 10px 14px; font-family: 'JetBrains Mono', monospace; font-size: 0.75rem; color: #34d399; margin-bottom: 20px; word-break: break-all;">
                    wordpress-plugin/voltmetrics-calculators/voltmetrics-calculators.php
                </div>

                <h4 style="font-size: 0.8125rem; text-transform: uppercase; letter-spacing: 0.05em; color: #94a3b8; margin: 0 0 10px;">
                    How to Install in WordPress:
                </h4>
                <ol style="margin: 0 0 20px; padding-left: 18px; font-size: 0.8125rem; color: #e2e8f0; line-height: 1.7;">
                    <li>Copy the folder <code>wordpress-plugin/voltmetrics-calculators/</code> into your WordPress directory: <code>wp-content/plugins/</code></li>
                    <li>Go to <strong>WP Admin &rarr; Plugins</strong> and click <strong>Activate</strong> on <em>VoltMetrics Energy & Appliance Calculators</em>.</li>
                    <li>Go to <strong>Settings &rarr; VoltMetrics Calculators</strong> to set your domain URL.</li>
                    <li>Insert the shortcode <code>[voltmetrics_calc type="appliance"]</code> anywhere on your site!</li>
                </ol>

                <a href="/calculators/appliance-electricity-cost.php" target="_blank" style="display: block; text-align: center; background: #10b981; color: white; padding: 10px; border-radius: 8px; font-weight: 700; text-decoration: none; font-size: 0.875rem;">
                    Test Public Appliance Calculator &rarr;
                </a>
            </div>

            <!-- Complete Shortcodes Cheatsheet -->
            <div style="background: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
                <h3 style="font-size: 1.125rem; font-weight: 800; color: #0f172a; margin: 0 0 12px; font-family: var(--font-heading);">
                    All 15 Calculator Type Attributes
                </h3>
                <p style="font-size: 0.8125rem; color: #64748b; margin-bottom: 14px;">
                    Use the <code>type="..."</code> attribute to embed any tool:
                </p>

                <div style="display: flex; flex-direction: column; gap: 8px; max-height: 420px; overflow-y: auto; padding-right: 4px;">
                    <?php foreach ($calc_options as $k => $info): ?>
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 8px 12px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 0.8125rem;">
                            <div>
                                <strong style="color: #0f172a;"><?php echo $info['name']; ?></strong>
                                <div style="color: #64748b; font-size: 0.6875rem;"><?php echo $info['cat']; ?></div>
                            </div>
                            <code style="background: #e2e8f0; padding: 2px 6px; border-radius: 4px; font-weight: 700; color: #0f172a;">type="<?php echo $k; ?>"</code>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
const selCalc = document.getElementById('selCalc');
const selCurrency = document.getElementById('selCurrency');
const selTheme = document.getElementById('selTheme');
const selHeight = document.getElementById('selHeight');
const outShortcode = document.getElementById('outShortcode');
const outIframe = document.getElementById('outIframe');
const previewFrame = document.getElementById('previewFrame');

function updateSnippets() {
    const calcKey = selCalc.value;
    const curr = selCurrency.value;
    const theme = selTheme.value;
    const height = selHeight.value;
    const path = selCalc.options[selCalc.selectedIndex].getAttribute('data-path');

    // Generate shortcode
    outShortcode.value = `[voltmetrics_calc type="${calcKey}" currency="${curr}" theme="${theme}" height="${height}"]`;

    // Generate iframe HTML
    const host = window.location.origin;
    const fullUrl = `${host}${path}?embed=1&currency=${curr}&theme=${theme}`;
    outIframe.value = `<iframe src="${fullUrl}" width="100%" height="${height}" frameborder="0" style="border:1px solid #e2e8f0; border-radius:12px; max-width:100%; box-shadow:0 4px 15px rgba(0,0,0,0.05);" loading="lazy"></iframe>`;

    // Update live previewer
    previewFrame.src = path;
}

selCalc.addEventListener('change', updateSnippets);
selCurrency.addEventListener('change', updateSnippets);
selTheme.addEventListener('change', updateSnippets);
selHeight.addEventListener('change', updateSnippets);

function copyText(elemId, btnId) {
    const el = document.getElementById(elemId);
    navigator.clipboard.writeText(el.value).then(() => {
        const btn = document.getElementById(btnId);
        const originalText = btn.textContent;
        btn.textContent = 'Copied!';
        setTimeout(() => btn.textContent = originalText, 2000);
    });
}

// Init on load
updateSnippets();
</script>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
