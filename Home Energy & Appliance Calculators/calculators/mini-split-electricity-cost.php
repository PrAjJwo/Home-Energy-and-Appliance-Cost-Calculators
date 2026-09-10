<?php
require_once __DIR__ . '/../config/site_config.php';
require_once __DIR__ . '/../config/rates.php';
require_once __DIR__ . '/../includes/seo_helper.php';

$page_title = "Mini-Split Electricity Cost Calculator (SEER2 & HSPF2)";
$meta_description = "Free mini-split electricity cost calculator for ductless heat pumps. Model seasonal cooling and winter heating expenses with modern SEER2 and HSPF2 metrics.";
$focus_keyword = "mini-split electricity cost calculator";
$canonical_path = "calculators/mini-split-electricity-cost.php";

$custom_schema = [
    '@type' => 'WebApplication',
    'name' => $page_title,
    'description' => $meta_description,
    'featureList' => [
        'Dual Heating and Cooling Mode Inverter Energy Simulation',
        'Single-Zone and Multi-Zone Configuration Presets',
        'SEER2 Cooling and HSPF2 Heat Pump Sizing',
        'Electric Baseboard Resistance Savings Analysis'
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
        <span style="color: var(--emerald-700); font-weight: 700;">Mini-Split Electricity Cost Calculator</span>
    </nav>
</div>

<!-- Main Section -->
<main class="section-padding" style="padding-top: 24px;">
    <div class="container">
        <!-- Hero Header -->
        <div style="margin-bottom: 30px; display: grid; grid-template-columns: 1.25fr 0.75fr; gap: 32px; align-items: center;">
            <div>
                <span class="section-tag">Category 2: HVAC &bull; Feature 3 Active</span>
                <h1 style="font-size: 2.5rem; letter-spacing: -0.02em; margin-bottom: 12px; color: var(--slate-900);">
                    Mini-Split Electricity Cost Calculator
                </h1>
                <p style="font-size: 1.125rem; color: var(--slate-600); line-height: 1.6;">
                    Ductless mini-split heat pumps utilize variable-speed inverter compressors that modulate power output to match exact room comfort requirements. Estimate your daily, monthly, and seasonal operating expenses in both cooling and heating modes.
                </p>
            </div>
            <div style="border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--border-subtle); box-shadow: var(--shadow-md);">
                <img src="/assets/images/minisplit_energy.jpg" 
                     alt="Ductless mini-split heat pump energy efficiency and inverter power consumption diagram"
                     width="1280" height="720" loading="eager">
            </div>
        </div>

        <!-- Calculator Component -->
        <div class="calculator-wrapper">
            <!-- Mode Toggle: Cooling vs Heating -->
            <div style="display: flex; gap: 12px; margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid var(--border-subtle); align-items: center; flex-wrap: wrap;">
                <span style="font-size: 0.9375rem; font-weight: 700; color: var(--slate-800);">Select Operating Mode:</span>
                <div style="display: inline-flex; background: var(--slate-100); border-radius: var(--radius-pill); padding: 4px; border: 1px solid var(--border-subtle);">
                    <button type="button" id="msModeCooling" class="btn btn-sm active" style="border-radius: var(--radius-pill); font-size: 0.8125rem; padding: 6px 16px;">
                        ❄️ Cooling Mode (SEER2)
                    </button>
                    <button type="button" id="msModeHeating" class="btn btn-sm btn-outline" style="border-radius: var(--radius-pill); font-size: 0.8125rem; padding: 6px 16px; border: none;">
                        🔥 Heating Mode (HSPF2)
                    </button>
                </div>
                <span style="font-size: 0.75rem; color: var(--slate-500); margin-left: auto;">
                    Mini-splits provide high-efficiency reverse-cycle thermal comfort year-round.
                </span>
            </div>

            <!-- Presets Row -->
            <div class="calc-presets-section">
                <div class="presets-header">
                    <span class="presets-title">1. Choose a Mini-Split Configuration:</span>
                    <span class="presets-hint">Pre-loads capacity, multi-zone sizing & inverter curves</span>
                </div>
                <div class="presets-scroll">
                    <button type="button" class="preset-chip" data-ms-preset="single_9k">
                        <span class="preset-chip-icon">🛏️</span>
                        <span>Single-Zone 9,000 BTU (Bedroom)</span>
                    </button>
                    <button type="button" class="preset-chip is-selected" data-ms-preset="single_12k">
                        <span class="preset-chip-icon">🛋️</span>
                        <span>Single-Zone 12,000 BTU (1-Ton Living Area)</span>
                    </button>
                    <button type="button" class="preset-chip" data-ms-preset="single_hyper">
                        <span class="preset-chip-icon">❄️</span>
                        <span>Hyper-Heat 12,000 BTU (Cold Climate 28 SEER)</span>
                    </button>
                    <button type="button" class="preset-chip" data-ms-preset="dual_18k">
                        <span class="preset-chip-icon">🚪</span>
                        <span>Dual-Zone 18,000 BTU (2 Rooms)</span>
                    </button>
                    <button type="button" class="preset-chip" data-ms-preset="tri_27k">
                        <span class="preset-chip-icon">🏠</span>
                        <span>Tri-Zone 27,000 BTU (3 Rooms)</span>
                    </button>
                    <button type="button" class="preset-chip" data-ms-preset="quad_36k">
                        <span class="preset-chip-icon">🏢</span>
                        <span>Quad-Zone 36,000 BTU (Whole Floor)</span>
                    </button>
                </div>
            </div>

            <div class="calc-grid">
                <!-- Left Input Column -->
                <div class="calc-inputs-col">
                    <div style="display: flex; justify-content: space-between; align-items: baseline;">
                        <h2 style="font-size: 1.25rem; color: var(--slate-800);">2. System Performance Inputs:</h2>
                        <span id="msActivePresetName" style="font-size: 0.875rem; font-weight: 700; color: var(--emerald-600);">
                            Single-Zone 12,000 BTU (1-Ton Living Area)
                        </span>
                    </div>

                    <!-- Input 1: Cooling / Heating Capacity (BTU) -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="msBtuInput" class="calc-label">Total Heat Pump Capacity (BTU/hr):</label>
                            <div style="display: flex; gap: 8px;">
                                <span class="calc-value-badge highlight" id="msBtuBadge">12,000 BTU/hr</span>
                                <span class="calc-value-badge" id="msTonsBadge">1.0 Ton</span>
                            </div>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="msBtuInput" class="calc-number-input" value="12000" min="6000" max="60000" step="1000">
                            <span class="input-suffix">BTU/hr</span>
                        </div>
                        <input type="range" id="msBtuRange" class="calc-range" min="6000" max="48000" step="1000" value="12000" aria-label="Mini split capacity slider">
                        <span class="calc-help">9k BTU covers ~350 sq ft; 12k BTU covers ~500 sq ft; 24k BTU covers ~1,000 sq ft.</span>
                    </div>

                    <!-- Input 2: Seasonal Efficiency Rating (SEER2 / HSPF2) -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="msEfficiencyInput" class="calc-label" id="msEfficiencyLabel">Seasonal Efficiency (SEER2):</label>
                            <span class="calc-value-badge highlight" id="msEfficiencyBadge">20.0 SEER2</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="msEfficiencyInput" class="calc-number-input" value="20.0" min="7" max="35" step="0.5">
                            <span class="input-suffix">Rating</span>
                        </div>
                        <input type="range" id="msEfficiencyRange" class="calc-range" min="8" max="33" step="0.5" value="20.0" aria-label="Efficiency slider">
                        <span class="calc-help">SEER2 and HSPF2 measure seasonal efficiency across varying outdoor temperatures, not instantaneous peak electrical draw.</span>
                    </div>

                    <!-- Input 3: Power Calculation Method Toggle -->
                    <div class="calc-group" style="background: var(--slate-50); padding: 12px; border-radius: var(--radius-md); border: 1px solid var(--border-subtle);">
                        <label class="calc-label" style="margin-bottom: 8px;">Power Calculation Method:</label>
                        <div style="display: flex; gap: 8px; margin-bottom: 8px; flex-wrap: wrap;">
                            <button type="button" id="msMethodRated" class="btn btn-sm active" style="font-size: 0.75rem; padding: 4px 12px; border-radius: var(--radius-pill);">
                                Rated Input Watts (Preferred)
                            </button>
                            <button type="button" id="msMethodSteady" class="btn btn-sm btn-outline" style="font-size: 0.75rem; padding: 4px 12px; border-radius: var(--radius-pill);">
                                Steady-State Efficiency (EER2 / COP)
                            </button>
                        </div>
                        <span class="calc-help" id="msMethodHelpText" style="display: block; font-size: 0.75rem;">
                            Uses manufacturer rated electrical wattage clamped to operating modulation bounds.
                        </span>
                    </div>

                    <!-- Group A: Rated Input Watts (shown when method = rated) -->
                    <div id="msRatedGroup">
                        <div class="calc-group">
                            <div class="calc-label-row">
                                <label for="msRatedWattsInput" class="calc-label" id="msRatedWattsLabel">Manufacturer Rated Input Watts:</label>
                                <span class="calc-value-badge highlight" id="msRatedWattsBadge">1,000 W</span>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="msRatedWattsInput" class="calc-number-input" value="1000" min="100" max="10000" step="50">
                                <span class="input-suffix">Watts</span>
                            </div>
                            <span class="calc-help">Nameplate rated power consumption at standard test condition.</span>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                            <div class="calc-group">
                                <div class="calc-label-row">
                                    <label for="msMinWattsInput" class="calc-label" style="font-size: 0.8125rem;">Min Power Draw:</label>
                                    <span class="calc-value-badge" id="msMinWattsBadge">300 W</span>
                                </div>
                                <div class="calc-input-wrapper">
                                    <input type="number" id="msMinWattsInput" class="calc-number-input" value="300" min="50" max="3000" step="25">
                                    <span class="input-suffix">W</span>
                                </div>
                            </div>
                            <div class="calc-group">
                                <div class="calc-label-row">
                                    <label for="msMaxWattsInput" class="calc-label" style="font-size: 0.8125rem;">Max Power Draw:</label>
                                    <span class="calc-value-badge" id="msMaxWattsBadge">1,400 W</span>
                                </div>
                                <div class="calc-input-wrapper">
                                    <input type="number" id="msMaxWattsInput" class="calc-number-input" value="1400" min="100" max="12000" step="50">
                                    <span class="input-suffix">W</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Group B: Steady-State Efficiency (shown when method = steady) -->
                    <div id="msSteadyGroup" style="display: none;">
                        <div class="calc-group" id="msEerGroup">
                            <div class="calc-label-row">
                                <label for="msEerInput" class="calc-label">Cooling Efficiency (EER2 at 95&deg;F):</label>
                                <span class="calc-value-badge highlight" id="msEerBadge">12.0 EER2</span>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="msEerInput" class="calc-number-input" value="12.0" min="6" max="25" step="0.1">
                                <span class="input-suffix">EER2</span>
                            </div>
                            <span class="calc-help">Steady-state ratio of cooling capacity (BTU/hr) to electrical input power (W).</span>
                        </div>

                        <div class="calc-group" id="msCopGroup" style="display: none;">
                            <div class="calc-label-row">
                                <label for="msCopInput" class="calc-label">Operating Coefficient of Performance (COP):</label>
                                <span class="calc-value-badge highlight" id="msCopBadge">3.00 COP</span>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="msCopInput" class="calc-number-input" value="3.0" min="1.0" max="6.0" step="0.1">
                                <span class="input-suffix">COP</span>
                            </div>
                            <span class="calc-help">Estimated Heating Input Watts = Heating Capacity (BTU/hr) / (3.41214 &times; COP).</span>
                        </div>
                    </div>

                    <!-- Input 4: Inverter Modulation Load -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="msModInput" class="calc-label">Average Inverter Modulation Speed:</label>
                            <span class="calc-value-badge" id="msModBadge">50% inverter load</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="msModInput" class="calc-number-input" value="50" min="0" max="100" step="5">
                            <span class="input-suffix">%</span>
                        </div>
                        <input type="range" id="msModRange" class="calc-range" min="0" max="100" step="5" value="50" aria-label="Modulation load slider">
                        <span class="calc-help">Inverters throttle down once rooms reach steady state, preventing costly cycling spikes. 0% represents inactive/standby.</span>
                    </div>

                    <!-- Input 5: Daily Operating Hours -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="msHoursInput" class="calc-label">Daily Operating Duration:</label>
                            <span class="calc-value-badge" id="msHoursBadge">10 hrs/day</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="msHoursInput" class="calc-number-input" value="10" min="0" max="24" step="0.5">
                            <span class="input-suffix">Hours/Day</span>
                        </div>
                        <input type="range" id="msHoursRange" class="calc-range" min="0" max="24" step="0.5" value="10" aria-label="Operating hours slider">
                        <span class="calc-help">Mini-splits are designed to run continuously at low power for optimal comfort and air filtration. 0 hours produces zero consumption.</span>
                    </div>

                    <!-- Input 6: Season Days -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="msSeasonDaysInput" class="calc-label">Heating / Cooling Season Duration:</label>
                            <span class="calc-value-badge" id="msSeasonDaysBadge">120 days</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="msSeasonDaysInput" class="calc-number-input" value="120" min="10" max="365" step="5">
                            <span class="input-suffix">Days/Season</span>
                        </div>
                    </div>

                    <!-- Input 7: Tariff Rate -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="msRateInput" class="calc-label">
                                Electricity Tariff Rate (<span data-currency-symbol>$</span>/kWh):
                            </label>
                            <span class="calc-value-badge">Benchmark Active</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="msRateInput" class="calc-number-input" value="0.2000" min="0" max="2.00" step="0.0001">
                            <span class="input-suffix">per kWh</span>
                        </div>

                        <div class="state-selector-box">
                            <label for="msStateSelect" style="font-size: 0.75rem; color: var(--slate-600); font-weight: 700; display: block; margin-bottom: 4px;">
                                Quick Select Regional Tariff Benchmark (2026 Rates):
                            </label>
                            <select id="msStateSelect" class="state-select">
                                <option value="0.2000" selected>Custom / Regional Benchmark (20.00¢/kWh)</option>
                                <option value="0.1830">US National Baseline (18.30¢/kWh)</option>
                                <option value="0.1465">Texas (14.65¢)</option>
                                <option value="0.1580">Florida (15.80¢)</option>
                                <option value="0.1810">Pennsylvania (18.10¢)</option>
                                <option value="0.2390">New York (23.90¢)</option>
                                <option value="0.2840">Massachusetts (28.40¢)</option>
                                <option value="0.3250">California (32.50¢)</option>
                                <option value="0.4059">Hawaii (40.59¢)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Right Results Sticky Column -->
                <div class="calc-results-col">
                    <div class="results-header">
                        <h3 class="results-title">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                            Mini-Split Cost Breakdown
                        </h3>
                        <span class="results-badge">Live Metric</span>
                    </div>

                    <!-- Primary Monthly Cost -->
                    <div class="cost-card-primary">
                        <div class="cost-period-label">Estimated Monthly Bill</div>
                        <div class="cost-big-number">
                            <span id="msResMonthlyCost">$0.00</span>
                        </div>
                        <div class="cost-sub-kwh">
                            Consuming <strong id="msResMonthlyKwh" style="color: var(--emerald-400);">0 kWh</strong> / month
                        </div>
                    </div>

                    <!-- Breakdown Grid: Hourly, Daily, Running Watts -->
                    <div class="results-breakdown-grid">
                        <div class="breakdown-box">
                            <span class="bb-label">Estimated Running Input</span>
                            <span class="bb-value" id="msResRunningWatts">500 W</span>
                            <span class="bb-sub" id="msResMaxWatts">Rated: 1,000 W (300W - 1,400W)</span>
                        </div>
                        <div class="breakdown-box">
                            <span class="bb-label">Hourly Cost</span>
                            <span class="bb-value" id="msResHourlyCost">$0.00/hr</span>
                            <span class="bb-sub" id="msResMethodNote">At modulated load</span>
                        </div>
                    </div>

                    <div class="results-breakdown-grid">
                        <div class="breakdown-box">
                            <span class="bb-label">Daily Operating Cost</span>
                            <span class="bb-value" id="msResDailyCost">$0.00</span>
                            <span class="bb-sub" id="msResDailyKwh">0.0 kWh/day</span>
                        </div>
                        <div class="breakdown-box">
                            <span class="bb-label">Full Season Total</span>
                            <span class="bb-value" id="msResSeasonCost">$0.00</span>
                            <span class="bb-sub" id="msResSeasonSub">120 active days</span>
                        </div>
                    </div>

                    <!-- Efficiency & Savings Callout -->
                    <div class="comparison-section">
                        <div class="comparison-header">
                            <span class="star-icon">&#9733;</span>
                            <span class="comparison-title" id="msSavingsHeading">Inverter Modulation Efficiency Benefit</span>
                        </div>
                        <p style="font-size: 0.8125rem; color: var(--slate-300); margin-bottom: 8px;" id="msSavingsText">
                            Compared to traditional single-stage equipment, inverter technology delivers substantial monthly savings:
                        </p>
                        <div style="font-size: 1.125rem; font-weight: 800; color: var(--emerald-400);" id="msSavingsAmount">
                            $0.00 / month
                        </div>
                    </div>

                    <div class="calc-actions">
                        <button type="button" class="btn btn-share" id="msCopySummaryBtn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                            Copy Mini-Split Summary
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Educational Content, Formulas & Benchmarks -->
        <section class="calc-content-section">
            <div class="calc-content-card">
                <h2 class="content-heading-2">How Inverter Mini-Splits Maximize Energy Efficiency</h2>
                <p class="content-p">
                    Traditional air conditioning systems and electric furnaces turn on at 100% full blast until the thermostat satisfies, then shut completely off. This creates frequent thermal swings and draws heavy startup current surges. In contrast, ductless mini-split heat pumps utilize variable-speed inverter compressors that smoothly dial down their motor speed to match exact heating or cooling demand.
                </p>

                <div class="formula-box">
                    <strong>The Exact Mini-Split Power Calculation Hierarchy:</strong><br>
                    1. Instantaneous Power (Method 1 - Rated Watts): Modulated Running Watts = clamp(Rated Input Watts &times; [Modulation % &divide; 100], Min Watts, Max Watts)<br>
                    2. Instantaneous Power (Method 2 - EER2 Steady-State): Cooling Watts = (Cooling BTU/hr &divide; EER2) &times; [Modulation % &divide; 100]<br>
                    3. Instantaneous Heating Power (COP Estimation): Heating Watts = [Heating BTU/hr &divide; (3.41214 &times; Operating COP)] &times; [Modulation % &divide; 100]<br>
                    4. Daily Electrical Consumption = (Estimated Running Watts &times; Daily Operating Hours) &divide; 1,000 kWh<br>
                    5. Seasonal Energy = Seasonal BTU Load &divide; (SEER2 or HSPF2 &times; 1,000) (Note: SEER2 and HSPF2 represent seasonal efficiency metrics, not peak instantaneous power ratings)<br>
                    6. Seasonal Heating COP &approx; HSPF2 &divide; 3.41214 (seasonal heating performance ratio vs electric resistance COP 1.0)
                </div>

                <h3 class="content-heading-3">Mini-Split Average Monthly Running Costs (2026 Rates)</h3>
                <p class="content-p">
                    The table below illustrates estimated monthly electrical running costs for popular ductless mini-split sizes operating at 50% inverter modulation for 14 hours daily on the US national baseline tariff ($0.1830/kWh):
                </p>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>System Configuration</th>
                                <th>Cooling Capacity</th>
                                <th>Typical Zone Count</th>
                                <th>Modulated Running Watts</th>
                                <th>Daily kWh</th>
                                <th>Estimated Monthly Bill (30.42d)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Single-Zone 9k BTU (22 SEER2)</strong></td>
                                <td>9,000 BTU / 0.75 Ton</td>
                                <td>1 Room (Bedroom / Nursery)</td>
                                <td><strong>184 Watts</strong></td>
                                <td>2.58 kWh / day</td>
                                <td><strong>$14.36 / month</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Single-Zone 12k BTU (20 SEER2)</strong></td>
                                <td>12,000 BTU / 1.0 Ton</td>
                                <td>1 Large Room / Living Area</td>
                                <td><strong>300 Watts</strong></td>
                                <td>4.20 kWh / day</td>
                                <td><strong>$23.38 / month</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Cold-Climate Hyper-Heat 12k (28 SEER2)</strong></td>
                                <td>12,000 BTU / 1.0 Ton</td>
                                <td>1 Zone (Extreme Climate)</td>
                                <td><strong>193 Watts</strong></td>
                                <td>2.70 kWh / day</td>
                                <td><strong>$15.04 / month</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Dual-Zone 18k BTU (19 SEER2)</strong></td>
                                <td>18,000 BTU / 1.5 Tons</td>
                                <td>2 Rooms (Master + Office)</td>
                                <td><strong>521 Watts</strong></td>
                                <td>7.29 kWh / day</td>
                                <td><strong>$40.60 / month</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Tri-Zone 27k BTU (18 SEER2)</strong></td>
                                <td>27,000 BTU / 2.25 Tons</td>
                                <td>3 Rooms (Upstairs Bedrooms)</td>
                                <td><strong>900 Watts</strong></td>
                                <td>12.60 kWh / day</td>
                                <td><strong>$70.17 / month</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Quad-Zone 36k BTU (17 SEER2)</strong></td>
                                <td>36,000 BTU / 3.0 Tons</td>
                                <td>4 Rooms (Whole Floor)</td>
                                <td><strong>1,271 Watts</strong></td>
                                <td>17.79 kWh / day</td>
                                <td><strong>$99.10 / month</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h3 class="content-heading-3">Heating Mode: Mini-Splits vs Electric Resistance Baseboards</h3>
                <p class="content-p">
                    Traditional electric space heaters and baseboards have a Coefficient of Performance (COP) of 1.0, meaning 1 kilowatt-hour of electricity produces exactly 3,412.14 BTU of thermal energy. A modern mini-split heat pump operating at an HSPF2 rating of 10.5 boasts a COP of roughly 3.08 (10.5 / 3.41214). This means the mini-split delivers over 300% more heat into your home for every kilowatt-hour consumed, slashing winter heating bills by up to 60% to 70%.
                </p>

                <h3 class="content-heading-3">4 Practical Tips for Optimal Mini-Split Performance</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 16px;">
                    <div style="background: var(--slate-50); border: 1px solid var(--border-subtle); padding: 16px; border-radius: var(--radius-md);">
                        <strong style="color: var(--emerald-700); display: block; margin-bottom: 6px;">1. Adopt the "Set It and Forget It" Strategy</strong>
                        <p style="font-size: 0.875rem; color: var(--slate-600); margin: 0;">Unlike central AC where setback temperatures save energy, mini-splits run most efficiently when left at a constant temperature so the inverter operates in low-speed cruising mode.</p>
                    </div>
                    <div style="background: var(--slate-50); border: 1px solid var(--border-subtle); padding: 16px; border-radius: var(--radius-md);">
                        <strong style="color: var(--emerald-700); display: block; margin-bottom: 6px;">2. Wash Mesh Air Filters Every 3 to 4 Weeks</strong>
                        <p style="font-size: 0.875rem; color: var(--slate-600); margin: 0;">Ductless wall units move high air volumes across dense internal coils. Clean the front snap-out mesh filters regularly to avoid restricted airflow and power draw spikes.</p>
                    </div>
                    <div style="background: var(--slate-50); border: 1px solid var(--border-subtle); padding: 16px; border-radius: var(--radius-md);">
                        <strong style="color: var(--emerald-700); display: block; margin-bottom: 6px;">3. Set Air Vane Angle Properly by Season</strong>
                        <p style="font-size: 0.875rem; color: var(--slate-600); margin: 0;">In cooling mode, angle louvers horizontally or upward since cool air naturally sinks. In heating mode, direct louvers toward the floor to force warm air across foot level.</p>
                    </div>
                    <div style="background: var(--slate-50); border: 1px solid var(--border-subtle); padding: 16px; border-radius: var(--radius-md);">
                        <strong style="color: var(--emerald-700); display: block; margin-bottom: 6px;">4. Keep Outdoor Inverter Clear of Snow & Foliage</strong>
                        <p style="font-size: 0.875rem; color: var(--slate-600); margin: 0;">Elevate the outdoor compressor unit above regional snow levels on wall brackets or a snow stand to ensure unrestricted winter defrost cycles.</p>
                    </div>
                </div>

                <h3 class="content-heading-3" style="margin-top: 36px;">Frequently Asked Questions (FAQ)</h3>
                <div class="faq-list">
                    <div class="faq-item is-active">
                        <button type="button" class="faq-question">
                            Does a mini-split use a lot of electricity?
                            <span>&darr;</span>
                        </button>
                        <div class="faq-answer">
                            No. Mini-splits are among the most energy-efficient HVAC systems available. A typical single-zone 12,000 BTU unit draws only 200 to 450 watts under normal running conditions, which costs approximately $15 to $30 per month to operate, compared to $80 to $150+ per month for central ducted air conditioning.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button type="button" class="faq-question">
                            Is it better to leave a mini-split on all day?
                            <span>&darr;</span>
                        </button>
                        <div class="faq-answer">
                            Yes. HVAC engineers recommend leaving ductless mini-splits running continuously during the cooling or heating season. Turning them off causes rooms to heat up or chill, forcing the compressor to ramp up to 100% maximum capacity for hours. Leaving them on allows the variable-speed inverter to idle along at 30% power, consuming less total kilowatt-hours.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button type="button" class="faq-question">
                            Do mini-split heat pumps work in freezing sub-zero winter temperatures?
                            <span>&darr;</span>
                        </button>
                        <div class="faq-answer">
                            Cold-climate rated mini-splits (often labeled Hyper-Heat or Low Ambient) provide 100% rated heating capacity down to 5 degrees Fahrenheit (-15 degrees Celsius) and continue operating down to -13 degrees Fahrenheit (-25 degrees Celsius) without requiring inefficient backup electric heat strips.
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

<!-- Feature 3 Calculation Script -->
<script src="/assets/js/minisplit-calculator.js"></script>

</body>
</html>
