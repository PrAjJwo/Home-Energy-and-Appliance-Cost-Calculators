<?php
require_once __DIR__ . '/../config/site_config.php';
require_once __DIR__ . '/../config/rates.php';
require_once __DIR__ . '/../includes/seo_helper.php';

$page_title = "Appliance Electricity Cost Calculator - Power Usage & Bill Estimator";
$meta_description = "Calculate how much electricity your home appliances consume per day, month, and year. Compare Energy Star savings with accurate 2026 utility rates.";
$focus_keyword = "appliance electricity cost calculator";
$canonical_path = "calculators/appliance-electricity-cost.php";

$custom_schema = [
    '@type' => 'WebApplication',
    'name' => $page_title,
    'description' => $meta_description,
    'featureList' => [
        'Interactive Wattage and Daily Hours Slider',
        'Over 12 Household Appliance Presets',
        'Multi-Currency Conversion with 2026 Rates',
        'Duty Cycle and Energy Star Savings Comparison'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php render_seo_head($page_title, $meta_description, $focus_keyword, $canonical_path, 'WebApplication', $custom_schema); ?>
</head>
<body>

<?php require_once __DIR__ . '/../includes/header.php'; ?>

<!-- Breadcrumbs Bar -->
<div class="container" style="padding-top: 20px;">
    <nav class="breadcrumb-nav" aria-label="Breadcrumb" style="font-size: 0.8125rem; color: var(--slate-500); display: flex; gap: 8px; align-items: center;">
        <a href="/" style="color: var(--slate-600);">Home</a>
        <span>/</span>
        <a href="/categories/appliances.php" style="color: var(--slate-600);">Everyday Appliances</a>
        <span>/</span>
        <span style="color: var(--emerald-700); font-weight: 700;">Appliance Electricity Cost Calculator</span>
    </nav>
</div>

<!-- Main Calculator Section -->
<main class="section-padding" style="padding-top: 24px;">
    <div class="container">
        <!-- Page Title & Header -->
        <div style="margin-bottom: 30px;">
            <span class="section-tag">Category 1: Everyday Appliances &bull; Active Tool</span>
            <h1 style="font-size: 2.5rem; letter-spacing: -0.02em; margin-bottom: 12px; color: var(--slate-900);">
                Appliance Electricity Cost Calculator
            </h1>
            <p style="font-size: 1.125rem; color: var(--slate-600); max-width: 760px; line-height: 1.6;">
                Quickly discover how much any plug-in household device adds to your electric bill. Select a verified appliance preset or enter your custom wattage and run-time hours.
            </p>
        </div>

        <!-- Interactive Calculator Component -->
        <div class="calculator-wrapper">
            <!-- Preset Carousel Section -->
            <div class="calc-presets-section">
                <div class="presets-header">
                    <span class="presets-title">1. Choose a Household Appliance Preset:</span>
                    <span class="presets-hint">Click any device to auto-fill specs</span>
                </div>
                <div class="presets-scroll">
                    <?php foreach ($APPLIANCE_PRESETS as $preset): ?>
                        <button type="button" 
                                class="preset-chip <?php echo ($preset['id'] === 'refrigerator') ? 'is-selected' : ''; ?>"
                                data-preset-id="<?php echo $preset['id']; ?>"
                                data-name="<?php echo htmlspecialchars($preset['name']); ?>"
                                data-watts="<?php echo $preset['watts']; ?>"
                                data-hours="<?php echo $preset['hours_per_day']; ?>"
                                data-duty="<?php echo $preset['duty_cycle']; ?>"
                                data-savings="<?php echo $preset['energy_star_savings_pct']; ?>">
                            <span class="preset-chip-icon"><?php echo $preset['icon']; ?></span>
                            <span><?php echo htmlspecialchars($preset['name']); ?></span>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="calc-grid">
                <!-- Left Input Controls -->
                <div class="calc-inputs-col">
                    <div style="display: flex; justify-content: space-between; align-items: baseline;">
                        <h2 style="font-size: 1.25rem; color: var(--slate-800);">2. Adjust Energy Parameters:</h2>
                        <span id="activeApplianceTitle" style="font-size: 0.875rem; font-weight: 700; color: var(--emerald-600);">
                            Refrigerator (Standard 18-21 cu ft)
                        </span>
                    </div>

                    <!-- Input 1: Wattage -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="calcWattsInput" class="calc-label">Appliance Power Draw (Watts):</label>
                            <span class="calc-value-badge highlight" id="calcWattsBadge">150 W</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="calcWattsInput" class="calc-number-input" value="150" min="1" max="25000" step="1">
                            <span class="input-suffix">Watts</span>
                        </div>
                        <input type="range" id="calcWattsRange" class="calc-range" min="10" max="3500" step="10" value="150" aria-label="Wattage slider">
                        <span class="calc-help">Look for the wattage label on the back or bottom of your appliance plug.</span>
                    </div>

                    <!-- Input 2: Hours Per Day -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="calcHoursInput" class="calc-label">Usage Duration (Hours per Day):</label>
                            <span class="calc-value-badge" id="calcHoursBadge">24 hrs/day</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="calcHoursInput" class="calc-number-input" value="24" min="0.1" max="24" step="0.1">
                            <span class="input-suffix">Hours</span>
                        </div>
                        <input type="range" id="calcHoursRange" class="calc-range" min="0.5" max="24" step="0.5" value="24" aria-label="Hours per day slider">
                        <span class="calc-help">Continuous items like routers and refrigerators run 24 hours daily.</span>
                    </div>

                    <!-- Input 3: Compressor / Active Duty Cycle -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="calcDutyInput" class="calc-label">Compressor Duty Cycle (% Active):</label>
                            <span class="calc-value-badge" id="calcDutyBadge">35% cycle</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="calcDutyInput" class="calc-number-input" value="35" min="1" max="100" step="1">
                            <span class="input-suffix">%</span>
                        </div>
                        <input type="range" id="calcDutyRange" class="calc-range" min="5" max="100" step="5" value="35" aria-label="Duty cycle percentage slider">
                        <span class="calc-help">Refrigerators cycle on and off (approx 35%). Devices like TVs or PCs draw power continuously at 100%.</span>
                    </div>

                    <!-- Input 4: Billing Cycle Days -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="calcBillingDaysInput" class="calc-label">Billing Cycle Duration (Days):</label>
                            <span class="calc-value-badge" id="calcBillingDaysBadge">30 days</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="calcBillingDaysInput" class="calc-number-input" value="30" min="1" max="365" step="1">
                            <span class="input-suffix">Days</span>
                        </div>
                        <div style="display: flex; gap: 8px; margin-top: 6px;">
                            <button type="button" class="btn btn-outline" style="padding: 4px 10px; font-size: 0.75rem;" onclick="document.getElementById('calcBillingDaysInput').value=30; document.getElementById('calcBillingDaysInput').dispatchEvent(new Event('input'));">Standard (30d)</button>
                            <button type="button" class="btn btn-outline" style="padding: 4px 10px; font-size: 0.75rem;" onclick="document.getElementById('calcBillingDaysInput').value=30.42; document.getElementById('calcBillingDaysInput').dispatchEvent(new Event('input'));">Avg Month (30.42d)</button>
                            <button type="button" class="btn btn-outline" style="padding: 4px 10px; font-size: 0.75rem;" onclick="document.getElementById('calcBillingDaysInput').value=31; document.getElementById('calcBillingDaysInput').dispatchEvent(new Event('input'));">Full Month (31d)</button>
                        </div>
                        <span class="calc-help">Standard monthly utility bills cover 30 days. The annualized monthly average is 30.42 days (365 / 12).</span>
                    </div>

                    <!-- Input 5: Estimated Efficiency Improvement -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="calcSavingsPctInput" class="calc-label">Estimated Efficiency Improvement (%):</label>
                            <span class="calc-value-badge" id="calcSavingsPctBadge">20% savings</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="calcSavingsPctInput" class="calc-number-input" value="20" min="0" max="90" step="1">
                            <span class="input-suffix">%</span>
                        </div>
                        <span class="calc-help">Estimated consumption reduction if upgrading to an Energy Star or modern high-efficiency model.</span>
                    </div>

                    <!-- Input 6: Electricity Rate -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="calcRateInput" class="calc-label">
                                Electricity Tariff Rate (<span data-currency-symbol>$</span>/kWh):
                            </label>
                            <span class="calc-value-badge">Benchmark Active</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="calcRateInput" class="calc-number-input" value="0.1830" min="0.01" max="2.00" step="0.0001">
                            <span class="input-suffix">per kWh</span>
                        </div>

                        <!-- US State Quick Benchmarks Dropdown -->
                        <div class="state-selector-box">
                            <label for="calcStateSelect" style="font-size: 0.75rem; color: var(--slate-600); font-weight: 700; display: block; margin-bottom: 4px;">
                                Quick Select Regional Tariff Benchmark (2026 Rates):
                            </label>
                            <select id="calcStateSelect" class="state-select">
                                <option value="0.1830" selected>US National Baseline (18.30¢/kWh)</option>
                                <option value="0.1181">North Dakota (Low Tariff: 11.81¢)</option>
                                <option value="0.1220">Washington (Hydro Tier: 12.20¢)</option>
                                <option value="0.1465">Texas (Competitive Grid: 14.65¢)</option>
                                <option value="0.1580">Florida (15.80¢)</option>
                                <option value="0.2390">New York (23.90¢)</option>
                                <option value="0.2840">Massachusetts (28.40¢)</option>
                                <option value="0.3250">California (High Tier: 32.50¢)</option>
                                <option value="0.4059">Hawaii (Peak Island Grid: 40.59¢)</option>
                                <option value="custom">Custom Input Rate</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Right Results Sticky Card -->
                <div class="calc-results-col">
                    <div class="results-header">
                        <h3 class="results-title">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                            Cost Breakdown
                        </h3>
                        <span class="results-badge">Live Estimate</span>
                    </div>

                    <!-- Primary Cost Metric (Monthly) -->
                    <div class="cost-card-primary">
                        <div class="cost-period-label">Estimated Monthly Bill (<span id="resBillingDaysLabel">30</span> days)</div>
                        <div class="cost-big-number">
                            <span id="resMonthlyCost">$0.00</span>
                        </div>
                        <div class="cost-sub-kwh">
                            Consuming <strong id="resMonthlyKwh" style="color: var(--emerald-400);">0.0 kWh</strong> per period
                        </div>
                    </div>

                    <!-- Secondary Grid: Daily & Annual -->
                    <div class="results-breakdown-grid">
                        <div class="breakdown-box">
                            <span class="bb-label">Daily Cost</span>
                            <span class="bb-value" id="resDailyCost">$0.00</span>
                            <span class="bb-sub" id="resDailyKwh">0.00 kWh/day</span>
                        </div>
                        <div class="breakdown-box">
                            <span class="bb-label">Annual Cost (365d)</span>
                            <span class="bb-value" id="resAnnualCost">$0.00</span>
                            <span class="bb-sub" id="resAnnualKwh">0 kWh/year</span>
                        </div>
                    </div>

                    <!-- Energy Star Comparison Box -->
                    <div class="comparison-section">
                        <div class="comparison-header">
                            <span class="star-icon">&#9733;</span>
                            <span class="comparison-title">Efficiency Upgrade Potential</span>
                        </div>
                        <p class="comparison-savings-text" id="resSavingsText">
                            Upgrading to a more efficient model can save up to <span class="savings-highlight">$0.00/year</span>.
                        </p>
                    </div>

                    <!-- Carbon Footprint Metric -->
                    <div class="carbon-box">
                        <div class="carbon-icon">&#127793;</div>
                        <div class="carbon-details">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                                <span class="carbon-title">Emissions Footprint</span>
                                <select id="calcEmissionsType" style="font-size: 0.7rem; padding: 2px 4px; border-radius: 4px; border: 1px solid var(--border-subtle); background: var(--white); color: var(--slate-700);">
                                    <option value="co2" selected>CO2 (0.767 lbs/kWh)</option>
                                    <option value="co2e">CO2e (0.771 lbs/kWh)</option>
                                </select>
                            </div>
                            <div class="carbon-value" id="resCarbonLbs">0 lbs CO2/yr</div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="calc-actions">
                        <button type="button" class="btn btn-share" id="calcCopyBtn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                            Copy Results Summary
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Educational Content, Formulas & Benchmarks -->
        <section class="calc-content-section">
            <div class="calc-content-card">
                <h2 class="content-heading-2">How to Calculate Appliance Electricity Cost</h2>
                <p class="content-p">
                    Calculating the electrical operating cost of any household appliance requires four simple variables: the power draw in watts, daily operating hours, active duty cycle, and your utility tariff per kilowatt-hour (kWh).
                </p>

                <div class="formula-box">
                    <strong>The Exact Electricity Cost Formula:</strong><br>
                    1. Daily kWh = (Watts &times; Daily Hours &times; Duty Cycle %) &divide; 1,000<br>
                    2. Monthly kWh = Daily kWh &times; Billing Days (typically 30 days, or 30.42 annualized average)<br>
                    3. Electricity Cost = Kilowatt-hours (kWh) &times; Rate per kWh ($/kWh)<br>
                    4. Carbon Emissions = Annual kWh &times; 0.767209 lbs CO2 (or 0.770884 lbs CO2e)
                </div>

                <p class="content-p">
                    For example, if you run a 1,500-watt portable space heater for 6 hours each winter evening at a utility rate of $0.1830 per kWh:
                </p>
                <ul style="margin-left: 24px; margin-bottom: 18px; color: var(--slate-700); line-height: 1.8;">
                    <li>Daily Energy = (1,500W &times; 6 hours &times; 90% duty) &divide; 1,000 = <strong>8.1 kWh per day</strong></li>
                    <li>Daily Cost = 8.1 kWh &times; $0.1830 = <strong>$1.48 per day</strong></li>
                    <li>Monthly Bill (30 days) = 8.1 kWh &times; 30 days &times; $0.1830 = <strong>$44.47 per month</strong> (or $45.09 for a 30.42-day average month)</li>
                </ul>

                <h3 class="content-heading-3">Typical Household Appliance Wattage & Cost Benchmarks</h3>
                <p class="content-p">
                    The table below provides typical manufacturer power ratings and estimated average monthly operating costs based on the 2026 US national baseline electricity rate ($0.1830/kWh) over a standard 30-day billing cycle.
                </p>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Appliance</th>
                                <th>Average Wattage</th>
                                <th>Typical Usage</th>
                                <th>Duty Cycle</th>
                                <th>Estimated Monthly Cost (30d @ $0.1830)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Refrigerator (18-21 cu ft)</strong></td>
                                <td>150 W</td>
                                <td>24 hours/day</td>
                                <td>35% compressor</td>
                                <td><strong>$6.92 / month</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Gaming PC & Dual Monitors</strong></td>
                                <td>450 W</td>
                                <td>5 hours/day</td>
                                <td>100% active</td>
                                <td><strong>$12.35 / month</strong></td>
                            </tr>
                            <tr>
                                <td><strong>65-inch 4K Smart TV</strong></td>
                                <td>120 W</td>
                                <td>4 hours/day</td>
                                <td>100% active</td>
                                <td><strong>$2.64 / month</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Portable Electric Space Heater</strong></td>
                                <td>1,500 W</td>
                                <td>6 hours/day</td>
                                <td>90% thermostat</td>
                                <td><strong>$44.47 / month</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Window Air Conditioner (8,000 BTU)</strong></td>
                                <td>750 W</td>
                                <td>8 hours/day</td>
                                <td>75% compressor</td>
                                <td><strong>$24.71 / month</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Electric Clothes Dryer</strong></td>
                                <td>3,000 W</td>
                                <td>1 hour/day</td>
                                <td>100% active</td>
                                <td><strong>$16.47 / month</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Dishwasher (Heated Dry)</strong></td>
                                <td>1,400 W</td>
                                <td>1.2 hours/day</td>
                                <td>100% cycle</td>
                                <td><strong>$9.22 / month</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Ceiling Fan (Medium)</strong></td>
                                <td>65 W</td>
                                <td>10 hours/day</td>
                                <td>100% continuous</td>
                                <td><strong>$3.57 / month</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Wi-Fi 6 Router & Fiber Modem</strong></td>
                                <td>18 W</td>
                                <td>24 hours/day</td>
                                <td>100% continuous</td>
                                <td><strong>$2.37 / month</strong></td>
                            </tr>
                            <tr>
                                <td><strong>EV Level 2 Charger (32 Amp)</strong></td>
                                <td>7,680 W</td>
                                <td>3.5 hours/day</td>
                                <td>100% charging</td>
                                <td><strong>$147.57 / month</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h3 class="content-heading-3">5 Practical Tips to Lower Appliance Electricity Bills</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 16px;">
                    <div style="background: var(--slate-50); border: 1px solid var(--border-subtle); padding: 16px; border-radius: var(--radius-md);">
                        <strong style="color: var(--emerald-700); display: block; margin-bottom: 6px;">1. Eliminate Phantom Vampire Loads</strong>
                        <p style="font-size: 0.875rem; color: var(--slate-600); margin: 0;">Entertainment centers and computer docks draw standby electricity even when turned off. Use smart surge strips to cut power automatically.</p>
                    </div>
                    <div style="background: var(--slate-50); border: 1px solid var(--border-subtle); padding: 16px; border-radius: var(--radius-md);">
                        <strong style="color: var(--emerald-700); display: block; margin-bottom: 6px;">2. Clean Refrigerator Condenser Coils</strong>
                        <p style="font-size: 0.875rem; color: var(--slate-600); margin: 0;">Dusty refrigerator coils force the compressor to run up to 30% longer to maintain target temperatures, increasing monthly energy waste.</p>
                    </div>
                    <div style="background: var(--slate-50); border: 1px solid var(--border-subtle); padding: 16px; border-radius: var(--radius-md);">
                        <strong style="color: var(--emerald-700); display: block; margin-bottom: 6px;">3. Wash Clothes in Cold Water</strong>
                        <p style="font-size: 0.875rem; color: var(--slate-600); margin: 0;">Roughly 85% of the power consumed by a washing machine goes directly toward heating water. Cold water cycles drastically reduce kWh consumption.</p>
                    </div>
                    <div style="background: var(--slate-50); border: 1px solid var(--border-subtle); padding: 16px; border-radius: var(--radius-md);">
                        <strong style="color: var(--emerald-700); display: block; margin-bottom: 6px;">4. Optimize Ceiling Fan Direction</strong>
                        <p style="font-size: 0.875rem; color: var(--slate-600); margin: 0;">Run ceiling fans counter-clockwise in summer to create a cooling wind-chill effect, allowing you to set air conditioning thermostats 4 degrees higher.</p>
                    </div>
                </div>

                <h3 class="content-heading-3" style="margin-top: 36px;">Frequently Asked Questions (FAQ)</h3>
                <div class="faq-list">
                    <div class="faq-item is-active">
                        <button type="button" class="faq-question">
                            Where can I find the exact wattage of my household appliance?
                            <span>&darr;</span>
                        </button>
                        <div class="faq-answer">
                            Look on the manufacturer specifications label, typically located on the back of electronics, inside the refrigerator door frame, on the bottom of kitchen appliances, or on the power adapter plug. If the label lists volts and amps instead of watts, multiply volts by amps (Watts = Volts &times; Amps) to get total power draw.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button type="button" class="faq-question">
                            What is appliance duty cycle and why does it matter?
                            <span>&darr;</span>
                        </button>
                        <div class="faq-answer">
                            Duty cycle refers to the percentage of time a device is actively drawing full operational power. For example, a refrigerator remains plugged in 24 hours a day, but its cooling compressor cycles on and off for roughly 30% to 40% of that time. Factoring in duty cycle prevents overestimating electric costs.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button type="button" class="faq-question">
                            How does Energy Star certification reduce operating expenses?
                            <span>&darr;</span>
                        </button>
                        <div class="faq-answer">
                            Appliances carrying the EPA Energy Star seal adhere to strict federal efficiency standards. For example, Energy Star certified refrigerators use at least 15% less energy than federal standards, and certified washing machines use about 25% less energy and 33% less water.
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

<!-- Feature 1 Calculation Script -->
<script src="/assets/js/appliance-calculator.js"></script>

</body>
</html>
