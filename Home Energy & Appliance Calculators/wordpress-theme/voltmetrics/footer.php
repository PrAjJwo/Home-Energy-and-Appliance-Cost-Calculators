<footer class="main-footer">
    <div class="container footer-grid">
        <!-- Col 1: Brand & Purpose -->
        <div class="footer-col brand-col">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-logo footer-logo">
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
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-hvac',
                'menu_class'     => 'footer-links',
                'container'      => false,
                'fallback_cb'    => false,
            ));
            ?>
        </div>

        <!-- Col 3: Backup Power & Utilities -->
        <div class="footer-col">
            <h4 class="footer-heading">Backup & High-Load</h4>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-backup',
                'menu_class'     => 'footer-links',
                'container'      => false,
                'fallback_cb'    => false,
            ));
            ?>
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

<script>
    // Simple responsive mobile menu toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        if (mobileBtn && mobileMenu) {
            mobileBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('is-open');
                this.classList.toggle('is-active');
            });
        }
    });
</script>

<?php wp_footer(); ?>
</body>
</html>
