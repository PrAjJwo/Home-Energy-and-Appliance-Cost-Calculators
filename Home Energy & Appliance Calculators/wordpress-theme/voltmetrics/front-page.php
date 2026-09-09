<?php
/**
 * Template Name: Front Page
 *
 * The template for the homepage.
 */

get_header();

// We need appliance presets data for the quick calculator
global $APPLIANCE_PRESETS;
if (empty($APPLIANCE_PRESETS)) {
    // If not loaded from config/rates.php or if we need to define it here
    // In WordPress, we'd normally load this via a plugin or functions.php
    $rates_path = get_template_directory() . '/inc/rates.php';
    if (file_exists($rates_path)) {
        require_once $rates_path;
    }
}
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container hero-grid">
        <div class="hero-text-col">
            <div class="hero-badge">
                <span class="live-dot"></span>
                <span>2026 Energy Intelligence Platform</span>
            </div>
            <h1 class="hero-title">
                Home Energy and Appliance <span class="hero-title-highlight">Cost Calculators</span>
            </h1>
            <p class="hero-lead">
                Calculate real operating expenses, eliminate vampire power draws, and evaluate Energy Star efficiency upgrades with verified residential tariffs and instant currency conversion.
            </p>

            <div class="hero-features">
                <div class="feature-pill">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--emerald-600)" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span>15 Specialized Calculators</span>
                </div>
                <div class="feature-pill">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--emerald-600)" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span>2026 Tariff Benchmarks</span>
                </div>
                <div class="feature-pill">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--emerald-600)" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span>Multi-Currency Support</span>
                </div>
            </div>

            <div style="display: flex; gap: 14px; flex-wrap: wrap;">
                <a href="<?php echo esc_url(home_url('/all-calculators/')); ?>" class="btn btn-primary">
                    Explore All 15 Calculators
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
                <a href="<?php echo esc_url(home_url('/appliance-electricity-cost/')); ?>" class="btn btn-outline">
                    Try Featured Appliance Tool
                </a>
            </div>
        </div>

        <div class="hero-image-col">
            <div class="hero-img-wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/smart_energy_home.jpg" 
                     alt="Illustration of an energy efficient smart home with solar power and appliance energy flow" 
                     width="1280" height="720" loading="eager">
                <div class="img-caption-badge">
                    <span><strong>Integrated Energy Modeling:</strong> Grid, Solar, HVAC & Appliances</span>
                    <span style="color: var(--emerald-400); font-weight: 700;">Live Logic</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Homepage Featured Calculator (#1 Most Popular Tool) -->
<section class="section-padding" style="background-color: var(--white); border-bottom: 1px solid var(--border-subtle);">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Featured Homepage Tool &bull; #1 Most Popular</span>
            <h2 class="section-title">Quick Appliance Electricity Cost Calculator</h2>
            <p class="section-sub">
                Try our flagship calculator directly on this page. Choose an everyday household device or slide the wattage to view instantaneous costs.
            </p>
        </div>

        <!-- Embedded Interactive Calculator Component -->
        <div class="calculator-wrapper" style="box-shadow: var(--shadow-lg);">
            <!-- Preset Carousel -->
            <div class="calc-presets-section">
                <div class="presets-header">
                    <span class="presets-title">Select an Appliance Preset:</span>
                    <a href="<?php echo esc_url(home_url('/appliance-electricity-cost/')); ?>" style="font-size: 0.8125rem; font-weight: 700; color: var(--emerald-600);">
                        View Full Calculator Page &rarr;
                    </a>
                </div>
                <div class="presets-scroll">
                    <?php if (!empty($APPLIANCE_PRESETS)): foreach ($APPLIANCE_PRESETS as $preset): ?>
                        <button type="button" 
                                class="preset-chip <?php echo ($preset['id'] === 'refrigerator') ? 'is-selected' : ''; ?>"
                                data-preset-id="<?php echo esc_attr($preset['id']); ?>"
                                data-name="<?php echo esc_attr($preset['name']); ?>"
                                data-watts="<?php echo esc_attr($preset['watts']); ?>"
                                data-hours="<?php echo esc_attr($preset['hours_per_day']); ?>"
                                data-duty="<?php echo esc_attr($preset['duty_cycle']); ?>"
                                data-savings="<?php echo esc_attr($preset['energy_star_savings_pct']); ?>">
                            <span class="preset-chip-icon"><?php echo $preset['icon']; ?></span>
                            <span><?php echo esc_html($preset['name']); ?></span>
                        </button>
                    <?php endforeach; endif; ?>
                </div>
            </div>

            <div class="calc-grid">
                <!-- Inputs -->
                <div class="calc-inputs-col">
                    <div style="display: flex; justify-content: space-between; align-items: baseline;">
                        <h3 style="font-size: 1.125rem; color: var(--slate-800);">Power Parameters:</h3>
                        <span id="activeApplianceTitle" style="font-size: 0.875rem; font-weight: 700; color: var(--emerald-600);">
                            Refrigerator (Standard 18-21 cu ft)
                        </span>
                    </div>

                    <!-- Wattage -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="calcWattsInput" class="calc-label">Appliance Power Draw (Watts):</label>
                            <span class="calc-value-badge highlight" id="calcWattsBadge">150 W</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="calcWattsInput" class="calc-number-input" value="150" min="1" max="25000">
                            <span class="input-suffix">Watts</span>
                        </div>
                        <input type="range" id="calcWattsRange" class="calc-range" min="10" max="3500" step="10" value="150" aria-label="Wattage slider">
                    </div>

                    <!-- Hours -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="calcHoursInput" class="calc-label">Usage Duration (Hours/Day):</label>
                            <span class="calc-value-badge" id="calcHoursBadge">24 hrs/day</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="calcHoursInput" class="calc-number-input" value="24" min="0" max="24" step="0.1">
                            <span class="input-suffix">Hours</span>
                        </div>
                        <input type="range" id="calcHoursRange" class="calc-range" min="0" max="24" step="0.5" value="24" aria-label="Hours slider">
                    </div>

                    <!-- Duty Cycle -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="calcDutyInput" class="calc-label">Compressor Duty Cycle (% Active):</label>
                            <span class="calc-value-badge" id="calcDutyBadge">35% cycle</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="calcDutyInput" class="calc-number-input" value="35" min="0" max="100" step="1">
                            <span class="input-suffix">%</span>
                        </div>
                        <input type="range" id="calcDutyRange" class="calc-range" min="0" max="100" step="5" value="35" aria-label="Duty cycle slider">
                    </div>

                    <!-- Tariff Rate -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="calcRateInput" class="calc-label">Electricity Rate (<span data-currency-symbol>$</span>/kWh):</label>
                            <span class="calc-value-badge">2026 Average</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="calcRateInput" class="calc-number-input" value="0.1830" min="0" max="2.00" step="0.0001">
                            <span class="input-suffix">per kWh</span>
                        </div>
                    </div>
                </div>

                <!-- Results Column -->
                <div class="calc-results-col">
                    <div class="results-header">
                        <h4 class="results-title">Instant Results</h4>
                        <span class="results-badge">Live Metric</span>
                    </div>

                    <div class="cost-card-primary">
                        <div class="cost-period-label">Estimated Monthly Bill</div>
                        <div class="cost-big-number">
                            <span id="resMonthlyCost">$0.00</span>
                        </div>
                        <div class="cost-sub-kwh">
                            Using <strong id="resMonthlyKwh" style="color: var(--emerald-400);">0.0 kWh</strong> monthly
                        </div>
                    </div>

                    <div class="results-breakdown-grid">
                        <div class="breakdown-box">
                            <span class="bb-label">Daily Cost</span>
                            <span class="bb-value" id="resDailyCost">$0.00</span>
                            <span class="bb-sub" id="resDailyKwh">0.00 kWh/day</span>
                        </div>
                        <div class="breakdown-box">
                            <span class="bb-label">Annual Cost</span>
                            <span class="bb-value" id="resAnnualCost">$0.00</span>
                            <span class="bb-sub" id="resAnnualKwh">0 kWh/year</span>
                        </div>
                    </div>

                    <div class="comparison-section">
                        <div class="comparison-header">
                            <span class="star-icon">&#9733;</span>
                            <span class="comparison-title">Energy Star Upgrade Impact</span>
                        </div>
                        <p class="comparison-savings-text" id="resSavingsText">
                            Upgrading to an Energy Star certified model can save up to <span class="savings-highlight">$0.00/year</span>.
                        </p>
                    </div>

                    <div class="calc-actions">
                        <a href="<?php echo esc_url(home_url('/appliance-electricity-cost/')); ?>" class="btn btn-primary" style="width: 100%;">
                            Open Dedicated Calculator Page &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Category Showcase Grid -->
<section class="section-padding" id="categories">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Explore The Platform</span>
            <h2 class="section-title">4 Logical Energy Calculator Categories</h2>
            <p class="section-sub">
                Every category features one designated top active calculator with high precision calculations.
            </p>
        </div>

        <div class="categories-grid">
            <!-- Cat 1: Everyday Appliances -->
            <div class="cat-card active-category">
                <span class="cat-tag">Category 1 &bull; 3 Calculators</span>
                <h3 class="cat-title">Everyday Household Appliances</h3>
                <p class="cat-desc">
                    Determine electricity usage for kitchen appliances, televisions, gaming rigs, laundry machines, and home network routers.
                </p>

                <div class="cat-popular-pick is-active-card">
                    <span class="popular-label">Popular Pick in Category:</span>
                    <span class="popular-tool-name">Appliance Electricity Cost Calculator</span>
                </div>

                <div style="display: flex; gap: 8px; margin-top: auto;">
                    <a href="<?php echo esc_url(home_url('/appliance-electricity-cost/')); ?>" class="btn btn-primary btn-sm" style="flex: 1; text-align: center;">
                        Open Calculator
                    </a>
                    <a href="<?php echo esc_url(home_url('/categories/appliances/')); ?>" class="btn btn-outline btn-sm" title="View all 3 appliance tools">
                        All 3 Tools &rarr;
                    </a>
                </div>
            </div>

            <!-- Cat 2: Heating & Cooling -->
            <div class="cat-card active-category">
                <span class="cat-tag">Category 2 &bull; 5 Calculators</span>
                <h3 class="cat-title">HVAC, Heating & Cooling</h3>
                <p class="cat-desc">
                    Analyze operating costs for central air conditioners, inverter mini-splits, heat pumps, space heaters, and ceiling fans.
                </p>

                <div class="cat-popular-pick is-active-card">
                    <span class="popular-label">Popular Pick in Category:</span>
                    <span class="popular-tool-name">Air-Conditioner Running Cost Calculator</span>
                </div>

                <div style="display: flex; gap: 8px; margin-top: auto;">
                    <a href="<?php echo esc_url(home_url('/air-conditioner-running-cost/')); ?>" class="btn btn-primary btn-sm" style="flex: 1; text-align: center;">
                        Open Calculator
                    </a>
                    <a href="<?php echo esc_url(home_url('/categories/hvac-cooling-heating/')); ?>" class="btn btn-outline btn-sm" title="View all 5 HVAC tools">
                        All 5 Tools &rarr;
                    </a>
                </div>
            </div>

            <!-- Cat 3: Backup & Off-Grid -->
            <div class="cat-card active-category">
                <span class="cat-tag">Category 3 &bull; 4 Calculators</span>
                <h3 class="cat-title">Backup Power & Off-Grid</h3>
                <p class="cat-desc">
                    Calculate generator runtime hours, fuel consumption costs, solar battery capacities, and portable power station sizing.
                </p>

                <div class="cat-popular-pick is-active-card">
                    <span class="popular-label">Popular Pick in Category:</span>
                    <span class="popular-tool-name">Generator Runtime Calculator</span>
                </div>

                <div style="display: flex; gap: 8px; margin-top: auto;">
                    <a href="<?php echo esc_url(home_url('/generator-runtime/')); ?>" class="btn btn-primary btn-sm" style="flex: 1; text-align: center;">
                        Open Calculator
                    </a>
                    <a href="<?php echo esc_url(home_url('/categories/backup-power/')); ?>" class="btn btn-outline btn-sm" title="View all 4 backup tools">
                        All 4 Tools &rarr;
                    </a>
                </div>
            </div>

            <!-- Cat 4: EV & Utility -->
            <div class="cat-card active-category">
                <span class="cat-tag">Category 4 &bull; 3 Calculators</span>
                <h3 class="cat-title">Electric Vehicles & Utility</h3>
                <p class="cat-desc">
                    Estimate home EV level 2 charging expenses, swimming pool pump filtration energy, and total tariff bill increases.
                </p>

                <div class="cat-popular-pick is-active-card">
                    <span class="popular-label">Popular Pick in Category:</span>
                    <span class="popular-tool-name">EV Home-Charging Cost Calculator</span>
                </div>

                <div style="display: flex; gap: 8px; margin-top: auto;">
                    <a href="<?php echo esc_url(home_url('/ev-home-charging-cost/')); ?>" class="btn btn-primary btn-sm" style="flex: 1; text-align: center;">
                        Open Calculator
                    </a>
                    <a href="<?php echo esc_url(home_url('/categories/ev-utility/')); ?>" class="btn btn-outline btn-sm" title="View all 3 EV and utility tools">
                        All 3 Tools &rarr;
                    </a>
                </div>
        </div>

        <div style="text-align: center; margin-top: 36px;">
            <a href="<?php echo esc_url(home_url('/all-calculators/')); ?>" class="btn btn-primary" style="font-size: 1rem; padding: 14px 28px; box-shadow: var(--shadow-md);">
                Browse All 15 Energy Calculators in Directory &rarr;
            </a>
        </div>
    </div>
</section>

<!-- Benchmark Tariffs Reference Section -->
<section class="section-padding" style="background-color: var(--slate-100); border-top: 1px solid var(--border-subtle);">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">2026 Utility Economics</span>
            <h2 class="section-title">Official Electricity Rate Benchmarks</h2>
            <p class="section-sub">
                Our tools pre-load validated residential electricity prices benchmarked against recent US Energy Information Administration (EIA) data and international utility caps.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px;">
            <div style="background: var(--white); padding: 20px; border-radius: var(--radius-md); border: 1px solid var(--border-subtle);">
                <span style="font-size: 0.75rem; color: var(--slate-500); text-transform: uppercase; font-weight: 700; display: block; margin-bottom: 6px;">US National Average</span>
                <div style="font-size: 1.75rem; font-weight: 800; color: var(--emerald-600); font-family: var(--font-heading);">18.34¢ <span style="font-size: 0.875rem; color: var(--slate-500);">/ kWh</span></div>
                <p style="font-size: 0.8125rem; color: var(--slate-600); margin-top: 8px;">Weighted residential average across the continental United States.</p>
            </div>

            <div style="background: var(--white); padding: 20px; border-radius: var(--radius-md); border: 1px solid var(--border-subtle);">
                <span style="font-size: 0.75rem; color: var(--slate-500); text-transform: uppercase; font-weight: 700; display: block; margin-bottom: 6px;">United Kingdom</span>
                <div style="font-size: 1.75rem; font-weight: 800; color: var(--slate-900); font-family: var(--font-heading);">24.50p <span style="font-size: 0.875rem; color: var(--slate-500);">/ kWh</span></div>
                <p style="font-size: 0.8125rem; color: var(--slate-600); margin-top: 8px;">Standard credit and direct debit Ofgem price cap baseline.</p>
            </div>

            <div style="background: var(--white); padding: 20px; border-radius: var(--radius-md); border: 1px solid var(--border-subtle);">
                <span style="font-size: 0.75rem; color: var(--slate-500); text-transform: uppercase; font-weight: 700; display: block; margin-bottom: 6px;">European Union</span>
                <div style="font-size: 1.75rem; font-weight: 800; color: var(--slate-900); font-family: var(--font-heading);">€0.283 <span style="font-size: 0.875rem; color: var(--slate-500);">/ kWh</span></div>
                <p style="font-size: 0.8125rem; color: var(--slate-600); margin-top: 8px;">Weighted household average across Eurozone member states.</p>
            </div>

            <div style="background: var(--white); padding: 20px; border-radius: var(--radius-md); border: 1px solid var(--border-subtle);">
                <span style="font-size: 0.75rem; color: var(--slate-500); text-transform: uppercase; font-weight: 700; display: block; margin-bottom: 6px;">Canada</span>
                <div style="font-size: 1.75rem; font-weight: 800; color: var(--slate-900); font-family: var(--font-heading);">CA$ 0.179 <span style="font-size: 0.875rem; color: var(--slate-500);">/ kWh</span></div>
                <p style="font-size: 0.8125rem; color: var(--slate-600); margin-top: 8px;">Provincial blend balancing hydro provinces and thermal grids.</p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>

<!-- Feature 1 Calculation Script -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/appliance-calculator.js"></script>
