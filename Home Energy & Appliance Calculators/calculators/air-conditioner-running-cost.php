<?php
require_once __DIR__ . '/../config/site_config.php';
require_once __DIR__ . '/../config/rates.php';
require_once __DIR__ . '/../includes/seo_helper.php';

$page_title = "Air-Conditioner Running Cost Calculator - SEER Cooling Estimator";
$meta_description = "Calculate central AC, window unit, and mini-split electricity costs per hour, month, and summer season with SEER ratings and 2026 tariff benchmarks.";
$focus_keyword = "air conditioner running cost calculator";
$canonical_path = "calculators/air-conditioner-running-cost.php";

$custom_schema = [
    '@type' => 'WebApplication',
    'name' => $page_title,
    'description' => $meta_description,
    'featureList' => [
        'SEER and SEER2 Inverter Cooling Efficiency Calculations',
        'Tonnage and BTU Sizing Presets (5,000 to 60,000 BTU)',
        'Compressor Duty Cycle and Daily Run Hour Modeling',
        'Summer Season and 10-Year Upgrade Savings Comparison'
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
        <a href="/categories/hvac-cooling-heating.php" style="color: var(--slate-600);">HVAC, Heating & Cooling</a>
        <span>/</span>
        <span style="color: var(--emerald-700); font-weight: 700;">Air-Conditioner Running Cost Calculator</span>
    </nav>
</div>

<!-- Main Section -->
<main class="section-padding" style="padding-top: 24px;">
    <div class="container">
        <!-- Hero Header -->
        <div style="margin-bottom: 30px; display: grid; grid-template-columns: 1.25fr 0.75fr; gap: 32px; align-items: center;">
            <div>
                <span class="section-tag">Category 2: HVAC &bull; Popular Pick &bull; Active Tool</span>
                <h1 style="font-size: 2.5rem; letter-spacing: -0.02em; margin-bottom: 12px; color: var(--slate-900);">
                    Air-Conditioner Running Cost Calculator
                </h1>
                <p style="font-size: 1.125rem; color: var(--slate-600); line-height: 1.6;">
                    Cooling your home is often the largest single expense on summer utility bills. Select your air conditioning system type, SEER rating, and daily run-time to see exact hourly, monthly, and seasonal operating costs.
                </p>
            </div>
            <div style="border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--border-subtle); box-shadow: var(--shadow-md);">
                <img src="/assets/images/air_conditioner_energy.jpg" 
                     alt="Air conditioner energy efficiency and cooling cost diagram"
                     width="1280" height="720" loading="eager">
            </div>
        </div>

        <!-- Calculator Component -->
        <div class="calculator-wrapper">
            <!-- AC Preset Selector -->
            <div class="calc-presets-section">
                <div class="presets-header">
                    <span class="presets-title">1. Select an Air Conditioner Type & Sizing Preset:</span>
                    <span class="presets-hint">Pre-configures BTUs, SEER & typical duty cycles</span>
                </div>
                <div class="presets-scroll">
                    <button type="button" class="preset-chip" data-ac-preset="window_small">
                        <span class="preset-chip-icon">🪟</span>
                        <span>Small Window AC (5,000 BTU)</span>
                    </button>
                    <button type="button" class="preset-chip" data-ac-preset="window_med">
                        <span class="preset-chip-icon">🪟</span>
                        <span>Medium Window AC (8,000 BTU)</span>
                    </button>
                    <button type="button" class="preset-chip" data-ac-preset="window_large">
                        <span class="preset-chip-icon">🪟</span>
                        <span>Large Window AC (12,000 BTU)</span>
                    </button>
                    <button type="button" class="preset-chip" data-ac-preset="portable">
                        <span class="preset-chip-icon">📦</span>
                        <span>Portable AC Unit (10,000 BTU)</span>
                    </button>
                    <button type="button" class="preset-chip" data-ac-preset="minisplit_1t">
                        <span class="preset-chip-icon">❄️</span>
                        <span>Mini-Split 1-Ton (20 SEER)</span>
                    </button>
                    <button type="button" class="preset-chip" data-ac-preset="central_2ton">
                        <span class="preset-chip-icon">🏠</span>
                        <span>Central AC 2-Ton (24k BTU)</span>
                    </button>
                    <button type="button" class="preset-chip is-selected" data-ac-preset="central_3ton">
                        <span class="preset-chip-icon">🏡</span>
                        <span>Central AC 3-Ton (36k BTU)</span>
                    </button>
                    <button type="button" class="preset-chip" data-ac-preset="central_3t_hi">
                        <span class="preset-chip-icon">⭐</span>
                        <span>High-Efficiency 3-Ton (18 SEER)</span>
                    </button>
                    <button type="button" class="preset-chip" data-ac-preset="central_4ton">
                        <span class="preset-chip-icon">🏢</span>
                        <span>Central AC 4-Ton (48k BTU)</span>
                    </button>
                    <button type="button" class="preset-chip" data-ac-preset="central_5ton">
                        <span class="preset-chip-icon">🏰</span>
                        <span>Central AC 5-Ton (60k BTU)</span>
                    </button>
                </div>
            </div>

            <div class="calc-grid">
                <!-- Left Input Controls -->
                <div class="calc-inputs-col">
                    <div style="display: flex; justify-content: space-between; align-items: baseline;">
                        <h2 style="font-size: 1.25rem; color: var(--slate-800);">2. Fine-Tune System Specifications:</h2>
                        <span id="acActivePresetName" style="font-size: 0.875rem; font-weight: 700; color: var(--emerald-600);">
                            Central AC 3-Ton (36,000 BTU)
                        </span>
                    </div>

                    <!-- Input 1: Cooling Capacity (BTU) -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="acBtuInput" class="calc-label">Cooling Capacity (BTU/hr):</label>
                            <div style="display: flex; gap: 8px;">
                                <span class="calc-value-badge highlight" id="acBtuBadge">36,000 BTU/hr</span>
                                <span class="calc-value-badge" id="acTonsBadge">3.0 Tons</span>
                            </div>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="acBtuInput" class="calc-number-input" value="36000" min="3000" max="100000" step="1000">
                            <span class="input-suffix">BTU/hr</span>
                        </div>
                        <input type="range" id="acBtuRange" class="calc-range" min="5000" max="60000" step="1000" value="36000" aria-label="BTU cooling slider">
                        <span class="calc-help">Rule of thumb: 1 Ton of cooling equals exactly 12,000 BTU/hr.</span>
                    </div>

                    <!-- Input 2: Efficiency Rating (SEER / SEER2) -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="acSeerInput" class="calc-label">Seasonal Efficiency Rating (SEER / SEER2):</label>
                            <span class="calc-value-badge highlight" id="acSeerBadge">14.3 SEER2</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="acSeerInput" class="calc-number-input" value="14.3" min="7" max="32" step="0.1">
                            <span class="input-suffix">SEER2</span>
                        </div>
                        <input type="range" id="acSeerRange" class="calc-range" min="8" max="26" step="0.1" value="14.3" aria-label="SEER slider">
                        <span class="calc-help">Federal baseline is 14.3 SEER2. High-efficiency inverter systems reach 18 to 24+ SEER2. Used for total seasonal kWh consumption.</span>
                    </div>

                    <!-- Input 2b: Steady-State Peak Efficiency (EER2) -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="acEerInput" class="calc-label">Peak Efficiency Rating (EER2 at 95&deg;F):</label>
                            <span class="calc-value-badge" id="acEerBadge">12.2 EER2</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="acEerInput" class="calc-number-input" value="12.2" min="5" max="25" step="0.1">
                            <span class="input-suffix">EER2</span>
                        </div>
                        <span class="calc-help">EER2 measures steady-state cooling power at 95&deg;F outdoor temperature. Running Watts = BTU / EER2. Typically 0.85 &times; SEER2.</span>
                    </div>

                    <!-- Input 3: Daily Running Hours -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="acHoursInput" class="calc-label">Thermostat Demand (Hours per Day):</label>
                            <span class="calc-value-badge" id="acHoursBadge">9 hrs/day</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="acHoursInput" class="calc-number-input" value="9" min="0" max="24" step="0.5">
                            <span class="input-suffix">Hours</span>
                        </div>
                        <input type="range" id="acHoursRange" class="calc-range" min="0" max="24" step="0.5" value="9" aria-label="Hours per day slider">
                        <span class="calc-help">Typical summer day thermostat demand ranges between 7 and 12 hours.</span>
                    </div>

                    <!-- Input 4: Compressor Duty Cycle -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="acDutyInput" class="calc-label">Compressor Active Duty Cycle:</label>
                            <span class="calc-value-badge" id="acDutyBadge">65% cycle</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="acDutyInput" class="calc-number-input" value="65" min="0" max="100" step="5">
                            <span class="input-suffix">%</span>
                        </div>
                        <input type="range" id="acDutyRange" class="calc-range" min="0" max="100" step="5" value="65" aria-label="Duty cycle slider">
                        <span class="calc-help">On mild days the compressor cycles at ~50%. In extreme heatwaves or undersized systems, it runs near 80% to 100%.</span>
                    </div>

                    <!-- Input 5: Cooling Season Length -->
                    <div class="calc-group">
                        <label for="acSeasonDays" class="calc-label">Cooling Season Duration:</label>
                        <select id="acSeasonDays" class="state-select" style="padding: 12px;">
                            <option value="90">3 Months / 90 Days (Mild Summer / Northern Climate)</option>
                            <option value="120" selected>4 Months / 120 Days (Standard Central Summer)</option>
                            <option value="150">5 Months / 150 Days (Warm Southern Climate)</option>
                            <option value="180">6 Months / 180 Days (Deep South / Desert Climate)</option>
                        </select>
                    </div>

                    <!-- Input 6: Tariff Rate -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="acRateInput" class="calc-label">
                                Electricity Tariff Rate (<span data-currency-symbol>$</span>/kWh):
                            </label>
                            <span class="calc-value-badge">Benchmark Active</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="acRateInput" class="calc-number-input" value="0.1830" min="0" max="2.00" step="0.0001">
                            <span class="input-suffix">per kWh</span>
                        </div>

                        <div class="state-selector-box">
                            <label for="acStateSelect" style="font-size: 0.75rem; color: var(--slate-600); font-weight: 700; display: block; margin-bottom: 4px;">
                                Select Regional Benchmark (2026 Rates):
                            </label>
                            <select id="acStateSelect" class="state-select">
                                <option value="0.1830" selected>US National Baseline (18.30¢/kWh)</option>
                                <option value="0.1465">Texas (Competitive Grid: 14.65¢)</option>
                                <option value="0.1580">Florida (15.80¢)</option>
                                <option value="0.1810">Pennsylvania (18.10¢)</option>
                                <option value="0.2390">New York (23.90¢)</option>
                                <option value="0.3250">California (High Tier: 32.50¢)</option>
                                <option value="0.4059">Hawaii (Peak Island Grid: 40.59¢)</option>
                                <option value="custom">Custom Rate</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Right Results Column -->
                <div class="calc-results-col">
                    <div class="results-header">
                        <h3 class="results-title">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                            AC Cost Summary
                        </h3>
                        <span class="results-badge">Live Estimate</span>
                    </div>

                    <!-- Primary Monthly Summer Bill -->
                    <div class="cost-card-primary">
                        <div class="cost-period-label">Estimated Monthly Cooling Cost</div>
                        <div class="cost-big-number">
                            <span id="acResMonthlyCost">$0.00</span>
                        </div>
                        <div class="cost-sub-kwh">
                            Drawing <strong id="acResMonthlyKwh" style="color: var(--emerald-400);">0 kWh</strong> / month
                        </div>
                    </div>

                    <!-- Breakdown Grid: Hourly, Daily, Full Season -->
                    <div class="results-breakdown-grid">
                        <div class="breakdown-box">
                            <span class="bb-label">Active Hourly Cost</span>
                            <span class="bb-value" id="acResHourlyCost">$0.00/hr</span>
                            <span class="bb-sub" id="acResRunningWatts">0 W power</span>
                        </div>
                        <div class="breakdown-box">
                            <span class="bb-label">Daily Average</span>
                            <span class="bb-value" id="acResDailyCost">$0.00</span>
                            <span class="bb-sub" id="acResDailyKwh">0.0 kWh/day</span>
                        </div>
                    </div>

                    <div class="breakdown-box" style="margin-bottom: 20px;">
                        <span class="bb-label">Full Summer Season Total</span>
                        <span class="bb-value" style="font-size: 1.5rem; color: var(--emerald-400);" id="acResSeasonalCost">$0.00</span>
                        <span class="bb-sub" id="acResSeasonalKwh">0 kWh total cooling season</span>
                    </div>

                    <!-- SEER Upgrade Comparison Box -->
                    <div class="comparison-section">
                        <div class="comparison-header">
                            <span class="star-icon">&#9733;</span>
                            <span class="comparison-title">High-Efficiency Upgrade ROI</span>
                        </div>
                        <p style="font-size: 0.8125rem; color: var(--slate-300); margin-bottom: 8px;">
                            Compare your selected unit against an older baseline unit:
                        </p>
                        <select id="acOldSeerSelect" class="state-select" style="background: var(--slate-800); color: var(--white); border-color: var(--slate-700); margin-bottom: 10px;">
                            <option value="8.0">Replace an old 8.0 SEER2 system (1990s era)</option>
                            <option value="10.0" selected>Replace a 10.0 SEER2 system (Pre-2006 equivalent)</option>
                            <option value="12.0">Replace a 12.0 SEER2 system (2006-2014 equivalent)</option>
                            <option value="13.0">Replace a 13.0 SEER2 system (2015-2022 baseline)</option>
                        </select>
                        <div style="font-size: 0.875rem; color: var(--slate-200);">
                            Estimated Summer Savings: <strong id="acUpgradeSavingsSeason" class="savings-highlight">$0.00 / summer</strong>
                        </div>
                        <div style="font-size: 0.75rem; color: var(--emerald-400); margin-top: 4px;">
                            10-Year Cumulative Savings: <strong id="acUpgradeSavings10Yr">$0.00</strong>
                        </div>
                    </div>

                    <div class="calc-actions">
                        <button type="button" class="btn btn-share" id="acCopySummaryBtn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                            Copy AC Calculation Summary
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Educational Content, Formulas & Benchmarks -->
        <section class="calc-content-section">
            <div class="calc-content-card">
                <h2 class="content-heading-2">How Air Conditioner Electricity Costs Are Calculated</h2>
                <p class="content-p">
                    Air conditioning systems consume more electricity during summer months than all other home appliances combined. Determining running expenses requires knowing your system cooling capacity (measured in BTU or Tons), its efficiency rating (SEER or SEER2), daily thermostat running hours, and your electricity price per kilowatt-hour.
                </p>

                <div class="formula-box">
                    <strong>The Exact Air Conditioner Cost Formula:</strong><br>
                    1. Peak Electrical Power Draw (Watts) = Cooling Capacity (BTU/hr) &divide; EER2 Rating<br>
                    2. Active Run Hours = Daily Thermostat Hours &times; (Compressor Duty Cycle &divide; 100)<br>
                    3. Daily Seasonal Consumption (kWh) = (Cooling Capacity BTU/hr &times; Active Hours) &divide; (SEER2 &times; 1,000)<br>
                    4. Monthly Cost = Daily kWh &times; 30.42 days &times; Utility Tariff ($/kWh)<br>
                    5. Full Season Cost = Daily kWh &times; Summer Cooling Days &times; Utility Tariff ($/kWh)
                </div>

                <h3 class="content-heading-3">Central Air Conditioner Tonnage & Average Monthly Costs</h3>
                <p class="content-p">
                    Below is a real-world reference table for common residential central AC system capacities operating on the 2026 US baseline electricity rate ($0.1830/kWh) at a standard 14.3 SEER2 baseline:
                </p>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Tonnage & Capacity</th>
                                <th>Average Home Size</th>
                                <th>Peak Power (at 12.2 EER2)</th>
                                <th>Daily kWh (9 hrs @ 65%)</th>
                                <th>Estimated Monthly Cost (30.42d)</th>
                                <th>4-Month Season Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>1.5 Ton (18,000 BTU)</strong></td>
                                <td>600 to 900 sq ft</td>
                                <td>1,475 Watts</td>
                                <td>7.36 kWh / day</td>
                                <td><strong>$40.99 / month</strong></td>
                                <td><strong>$161.71 / season</strong></td>
                            </tr>
                            <tr>
                                <td><strong>2.0 Ton (24,000 BTU)</strong></td>
                                <td>900 to 1,200 sq ft</td>
                                <td>1,967 Watts</td>
                                <td>9.82 kWh / day</td>
                                <td><strong>$54.66 / month</strong></td>
                                <td><strong>$215.62 / season</strong></td>
                            </tr>
                            <tr>
                                <td><strong>2.5 Ton (30,000 BTU)</strong></td>
                                <td>1,200 to 1,500 sq ft</td>
                                <td>2,459 Watts</td>
                                <td>12.27 kWh / day</td>
                                <td><strong>$68.32 / month</strong></td>
                                <td><strong>$269.52 / season</strong></td>
                            </tr>
                            <tr>
                                <td><strong>3.0 Ton (36,000 BTU)</strong></td>
                                <td>1,500 to 2,000 sq ft</td>
                                <td>2,951 Watts</td>
                                <td>14.73 kWh / day</td>
                                <td><strong>$82.02 / month</strong></td>
                                <td><strong>$323.49 / season</strong></td>
                            </tr>
                            <tr>
                                <td><strong>3.5 Ton (42,000 BTU)</strong></td>
                                <td>2,000 to 2,400 sq ft</td>
                                <td>3,443 Watts</td>
                                <td>17.18 kWh / day</td>
                                <td><strong>$95.66 / month</strong></td>
                                <td><strong>$377.34 / season</strong></td>
                            </tr>
                            <tr>
                                <td><strong>4.0 Ton (48,000 BTU)</strong></td>
                                <td>2,400 to 3,000 sq ft</td>
                                <td>3,934 Watts</td>
                                <td>19.64 kWh / day</td>
                                <td><strong>$109.36 / month</strong></td>
                                <td><strong>$431.31 / season</strong></td>
                            </tr>
                            <tr>
                                <td><strong>5.0 Ton (60,000 BTU)</strong></td>
                                <td>3,000+ sq ft</td>
                                <td>4,918 Watts</td>
                                <td>24.55 kWh / day</td>
                                <td><strong>$136.70 / month</strong></td>
                                <td><strong>$539.14 / season</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h3 class="content-heading-3">Understanding SEER vs SEER2</h3>
                <p class="content-p">
                    SEER stands for Seasonal Energy Efficiency Ratio. In 2023, the US Department of Energy transitioned to <strong>SEER2</strong>, which tests cooling systems under higher external static duct pressure (0.50 inches of water column vs 0.10 in original SEER), more closely reflecting actual home installations. A 14.3 SEER2 rating equals roughly a 15.0 SEER rating under the older standard.
                </p>

                <h3 class="content-heading-3">5 Ways to Slash Summer AC Bills by Up to 30%</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 16px;">
                    <div style="background: var(--slate-50); border: 1px solid var(--border-subtle); padding: 16px; border-radius: var(--radius-md);">
                        <strong style="color: var(--emerald-700); display: block; margin-bottom: 6px;">1. Raise Thermostat by 2 to 3 Degrees</strong>
                        <p style="font-size: 0.875rem; color: var(--slate-600); margin: 0;">Every degree you raise your central thermostat during summer reduces total compressor electricity consumption by roughly 3% to 5%.</p>
                    </div>
                    <div style="background: var(--slate-50); border: 1px solid var(--border-subtle); padding: 16px; border-radius: var(--radius-md);">
                        <strong style="color: var(--emerald-700); display: block; margin-bottom: 6px;">2. Replace Clogged Air Filters Monthly</strong>
                        <p style="font-size: 0.875rem; color: var(--slate-600); margin: 0;">Restricted airflow chokes the evaporator coil, causing the blower motor to draw extra amperage and prolonging compressor cycle times.</p>
                    </div>
                    <div style="background: var(--slate-50); border: 1px solid var(--border-subtle); padding: 16px; border-radius: var(--radius-md);">
                        <strong style="color: var(--emerald-700); display: block; margin-bottom: 6px;">3. Combine AC with Ceiling Fans</strong>
                        <p style="font-size: 0.875rem; color: var(--slate-600); margin: 0;">Ceiling fans create a 4-degree wind chill cooling sensation on your skin while consuming only 50 to 70 watts compared to 2,500W for central AC.</p>
                    </div>
                    <div style="background: var(--slate-50); border: 1px solid var(--border-subtle); padding: 16px; border-radius: var(--radius-md);">
                        <strong style="color: var(--emerald-700); display: block; margin-bottom: 6px;">4. Install Solar Heat Window Films</strong>
                        <p style="font-size: 0.875rem; color: var(--slate-600); margin: 0;">Solar heat radiation through south and west facing windows accounts for up to 40% of residential cooling loads in peak July and August.</p>
                    </div>
                </div>

                <h3 class="content-heading-3" style="margin-top: 36px;">Frequently Asked Questions (FAQ)</h3>
                <div class="faq-list">
                    <div class="faq-item is-active">
                        <button type="button" class="faq-question">
                            How much electricity does a 3-ton central air conditioner use per hour?
                            <span>&darr;</span>
                        </button>
                        <div class="faq-answer">
                            A standard 3-ton central AC (36,000 BTU) with a 14.3 SEER2 rating draws approximately 2,951 watts at peak 95&deg;F outdoor conditions (at ~12.2 EER2) and averages approximately 2,517 watts across the seasonal temperature spectrum. At the US national baseline rate of $0.1830 per kWh, each continuous hour of compressor operation costs approximately $0.46 to $0.54.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button type="button" class="faq-question">
                            Is it cheaper to run a window AC or central air?
                            <span>&darr;</span>
                        </button>
                        <div class="faq-answer">
                            If you only need to cool a single room such as a bedroom or home office, a small 5,000 to 8,000 BTU window AC drawing 450 to 670 watts is significantly cheaper than running a 2,500 to 3,500 watt central air system for the entire house. However, for cooling whole homes with 3 or more rooms, central AC or multi-zone mini-splits provide superior efficiency per square foot.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button type="button" class="faq-question">
                            How much money will I save upgrading from 10 SEER to 16 SEER?
                            <span>&darr;</span>
                        </button>
                        <div class="faq-answer">
                            Upgrading from a 10 SEER AC to a 16 SEER AC reduces cooling electricity consumption by approximately 37.5%. For an average 3-ton system running 4 months during summer, this saves roughly $120 to $220 each year, delivering between $1,200 and $2,200 in utility bill savings over a 10-year period.
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

<!-- Feature 2 Calculation Script -->
<script src="/assets/js/ac-calculator.js"></script>

</body>
</html>
