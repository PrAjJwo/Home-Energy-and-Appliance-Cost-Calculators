<?php
if (!defined('SITE_NAME')) {
    require_once __DIR__ . '/../config/site_config.php';
}
?>
<footer class="main-footer">
    <div class="container footer-grid">
        <!-- Col 1: Brand & Purpose -->
        <div class="footer-col brand-col">
            <a href="/" class="brand-logo footer-logo">
                <div class="brand-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                </div>
                <div class="brand-text">
                    <span class="brand-name">Volt<span class="brand-highlight">Metrics</span></span>
                </div>
            </a>
            <p class="footer-desc">
                Independent residential energy intelligence. We help homeowners, renters, and property managers understand real power consumption, cut electricity bills, and optimize appliance runtimes.
            </p>
            <div class="footer-audit-card">
                <span class="fac-title">Standardized Energy Modeling</span>
                <span class="fac-badge">2026 Grid Tariffs & EPA</span>
                <p class="fac-sub">Calculations benchmarked against US EIA, UK Ofgem, and Energy Star duty cycle standards.</p>
            </div>
        </div>

        <!-- Col 2: Everyday Appliances & Climate -->
        <div class="footer-col">
            <h4 class="footer-heading">Household & HVAC</h4>
            <ul class="footer-links">
                <li><a href="/calculators/appliance-electricity-cost.php" class="active-badge-link"><span class="dot-active"></span>Appliance Electricity Cost</a></li>
                <li><a href="/calculators/watts-to-monthly-cost.php">Watts to Monthly Cost</a></li>
                <li><a href="/calculators/refrigerator-energy-cost.php">Refrigerator Energy Cost</a></li>
                <li><a href="/calculators/air-conditioner-running-cost.php">Air-Conditioner Running Cost</a></li>
                <li><a href="/calculators/mini-split-electricity-cost.php">Mini-Split Inverter Savings</a></li>
                <li><a href="/calculators/space-heater-cost.php">Space Heater Bill Impact</a></li>
                <li><a href="/calculators/heat-pump-savings.php">Heat Pump Savings</a></li>
                <li><a href="/calculators/ceiling-fan-electricity.php">Ceiling Fan Savings</a></li>
            </ul>
        </div>

        <!-- Col 3: Backup Power & Utilities -->
        <div class="footer-col">
            <h4 class="footer-heading">Backup & High-Load</h4>
            <ul class="footer-links">
                <li><a href="/calculators/generator-runtime.php" class="active-badge-link"><span class="dot-active"></span>Generator Runtime</a></li>
                <li><a href="/calculators/generator-fuel-cost.php">Generator Fuel Cost</a></li>
                <li><a href="/calculators/solar-battery-runtime.php">Solar Battery Storage</a></li>
                <li><a href="/calculators/portable-power-station-runtime.php">Portable Power Station Sizing</a></li>
                <li><a href="/calculators/ev-home-charging-cost.php">EV Home Charging Cost</a></li>
                <li><a href="/calculators/pool-pump-electricity.php">Pool Pump Electricity Audit</a></li>
                <li><a href="/calculators/electricity-bill-increase.php">Bill Increase Calculator</a></li>
            </ul>
        </div>

        <!-- Col 4: Benchmarks & Resources -->
        <div class="footer-col">
            <h4 class="footer-heading">Global Tariffs (2026)</h4>
            <div class="tariff-box">
                <div class="tariff-row"><span>US National Baseline:</span><strong>18.30¢ / kWh</strong></div>
                <div class="tariff-row"><span>United Kingdom:</span><strong>26.11p / kWh</strong></div>
                <div class="tariff-row"><span>European Union:</span><strong>€0.290 / kWh</strong></div>
                <div class="tariff-row"><span>Canada:</span><strong>CA$ 0.179 / kWh</strong></div>
                <div class="tariff-row"><span>Australia:</span><strong>AU$ 0.345 / kWh</strong></div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container footer-bottom-flex">
            <p class="copy-text">&copy; <?php echo date('Y'); ?> VoltMetrics. All calculation rights reserved. Designed for residential energy efficiency.</p>
            <p class="disclaimer-text">
                Notice: Energy costs are estimations derived from standard appliance duty cycles and regional electricity rate averages. Check your utility provider bill for exact tiered tariffs.
            </p>
        </div>
    </div>
</footer>

<!-- Global Scripts -->
<script src="/assets/js/currency.js"></script>
<script>
    // Simple responsive mobile menu toggle
    const mobileBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    if (mobileBtn && mobileMenu) {
        mobileBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('is-open');
            this.classList.toggle('is-active');
        });
    }
</script>
