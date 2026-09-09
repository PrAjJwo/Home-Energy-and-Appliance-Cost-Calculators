<?php
/**
 * Template Name: Calculator - generator-runtime
 */

get_header();
?>


<div class="container" style="padding-top: 20px;">
    <nav class="breadcrumb-nav" aria-label="Breadcrumb" style="font-size: 0.8125rem; color: var(--slate-500); display: flex; gap: 8px; align-items: center;">
        <a href="/" style="color: var(--slate-600);">Home</a>
        <span>/</span>
        <a href="/categories/backup-power/" style="color: var(--slate-600);">Backup Power & Off-Grid</a>
        <span>/</span>
        <span style="color: var(--emerald-700); font-weight: 700;">Generator Runtime Calculator</span>
    </nav>
</div>

<main class="section-padding" style="padding-top: 24px;">
    <div class="container">
        <div style="margin-bottom: 30px; display: grid; grid-template-columns: 1.25fr 0.75fr; gap: 32px; align-items: center;">
            <div>
                <span class="section-tag">Category 3: Backup Power &bull; Popular Pick &bull; Active Tool</span>
                <h1 style="font-size: 2.5rem; letter-spacing: -0.02em; margin-bottom: 12px; color: var(--slate-900);">
                    Generator Runtime Calculator
                </h1>
                <p style="font-size: 1.125rem; color: var(--slate-600); line-height: 1.6;">
                    During severe weather storms and emergency power outages, knowing exactly how many hours your generator will run before needing a refill is essential for home safety. Model your electrical load and tank volume to project total runtime.
                </p>
            </div>
            <div style="border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--border-subtle); box-shadow: var(--shadow-md);">
                <img src="/assets/images/backup_power_generator.jpg" 
                     alt="Home emergency backup generator and battery storage setup diagram"
                     width="1280" height="720" loading="eager">
            </div>
        </div>

        <div class="calculator-wrapper">
            <!-- Generator Presets -->
            <div class="calc-presets-section">
                <div class="presets-header">
                    <span class="presets-title">Common Generator Sizing Presets:</span>
                    <span class="presets-hint">Pre-loads tank size and fuel burn curves</span>
                </div>
                <div class="presets-scroll">
                    <button type="button" class="preset-chip" data-gen-cap="2200" data-gen-tank="1.1" data-burn-25="0.075" data-burn-50="0.120" data-burn-75="0.174" data-burn-100="0.228" data-gen-name="2,200W Inverter Generator (Tailgate / Camping)">
                        2,200W Inverter (1.1 gal tank)
                    </button>
                    <button type="button" class="preset-chip is-selected" data-gen-cap="4500" data-gen-tank="3.4" data-burn-25="0.228" data-burn-50="0.380" data-burn-75="0.551" data-burn-100="0.722" data-gen-name="4,500W Dual-Fuel Generator (Emergency Essentials)">
                        4,500W Generator (3.4 gal tank)
                    </button>
                    <button type="button" class="preset-chip" data-gen-cap="7500" data-gen-tank="6.5" data-burn-25="0.390" data-burn-50="0.650" data-burn-75="0.943" data-burn-100="1.235" data-gen-name="7,500W Portable Generator (Well Pump & Fridge)">
                        7,500W Generator (6.5 gal tank)
                    </button>
                    <button type="button" class="preset-chip" data-gen-cap="12000" data-gen-tank="8.0" data-burn-25="0.660" data-burn-50="1.100" data-burn-75="1.595" data-burn-100="2.090" data-gen-name="12,000W Whole-Home Standby (Central AC & Subpanel)">
                        12,000W Heavy Generator (8.0 gal tank)
                    </button>
                </div>
            </div>

            <div class="calc-grid">
                <!-- Inputs -->
                <div class="calc-inputs-col">
                    <h2 style="font-size: 1.25rem; color: var(--slate-800);">Generator Specifications:</h2>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="genTankInput" class="calc-label">Fuel Tank Capacity (Gallons):</label>
                            <span class="calc-value-badge highlight" id="genTankBadge">3.4 Gallons</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="genTankInput" class="calc-number-input" value="3.4" min="0.5" max="30" step="0.1">
                            <span class="input-suffix">Gallons</span>
                        </div>
                        <input type="range" id="genTankRange" class="calc-range" min="1" max="15" step="0.1" value="3.4">
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="genLoadPctInput" class="calc-label">Average Electrical Load Percentage:</label>
                            <span class="calc-value-badge" id="genLoadPctBadge">50% load</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="genLoadPctInput" class="calc-number-input" value="50" min="10" max="100" step="5">
                            <span class="input-suffix">% Load</span>
                        </div>
                        <input type="range" id="genLoadPctRange" class="calc-range" min="20" max="100" step="5" value="50">
                        <span class="calc-help">Higher connected loads require more fuel to maintain engine RPM and 120V/240V frequency.</span>
                    </div>

                    <div class="calc-group" style="background: var(--slate-50); padding: 12px; border-radius: var(--radius-md); border: 1px solid var(--border-subtle);">
                        <div class="calc-label-row">
                            <label class="calc-label" style="margin-bottom: 4px;">Calibrated Load Fuel Burn Rates (gal/hr):</label>
                            <span class="calc-value-badge" id="genBurnBadge">50% Load: 0.38 gal/hr</span>
                        </div>
                        <span class="calc-help" style="margin-bottom: 8px; display: block; font-size: 0.75rem;">
                            Piecewise linear interpolation calculates burn rates for any load between calibrated points.
                        </span>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                            <div>
                                <label for="genBurn25Input" style="font-size: 0.75rem; color: var(--slate-600); font-weight: 700; display: block;">25% Load (gal/hr):</label>
                                <input type="number" id="genBurn25Input" class="calc-number-input" value="0.228" min="0.02" max="3.0" step="0.001" style="font-size: 0.8125rem; padding: 6px 8px;">
                            </div>
                            <div>
                                <label for="genBurnInput" style="font-size: 0.75rem; color: var(--slate-600); font-weight: 700; display: block;">50% Load (gal/hr):</label>
                                <input type="number" id="genBurnInput" class="calc-number-input" value="0.380" min="0.05" max="3.5" step="0.001" style="font-size: 0.8125rem; padding: 6px 8px;">
                            </div>
                            <div>
                                <label for="genBurn75Input" style="font-size: 0.75rem; color: var(--slate-600); font-weight: 700; display: block;">75% Load (gal/hr):</label>
                                <input type="number" id="genBurn75Input" class="calc-number-input" value="0.551" min="0.08" max="4.5" step="0.001" style="font-size: 0.8125rem; padding: 6px 8px;">
                            </div>
                            <div>
                                <label for="genBurn100Input" style="font-size: 0.75rem; color: var(--slate-600); font-weight: 700; display: block;">100% Load (gal/hr):</label>
                                <input type="number" id="genBurn100Input" class="calc-number-input" value="0.722" min="0.10" max="6.0" step="0.001" style="font-size: 0.8125rem; padding: 6px 8px;">
                            </div>
                        </div>
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="genPriceInput" class="calc-label">Fuel Price per Gallon (<span data-currency-symbol>$</span>/gal):</label>
                            <span class="calc-value-badge">Benchmark Active</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="genPriceInput" class="calc-number-input" value="4.071" min="1.0" max="10.0" step="0.001">
                            <span class="input-suffix">per gallon</span>
                        </div>
                    </div>
                </div>

                <!-- Results Column -->
                <div class="calc-results-col">
                    <div class="results-header">
                        <h3 class="results-title">Projected Runtime</h3>
                        <span class="results-badge">Full Tank</span>
                    </div>

                    <div class="cost-card-primary">
                        <div class="cost-period-label">Estimated Continuous Runtime</div>
                        <div class="cost-big-number">
                            <span id="genResHours" style="color: var(--emerald-400);">8.9 Hours</span>
                        </div>
                        <div class="cost-sub-kwh">
                            Burning <strong id="genResBurnRate">0.38 gal</strong> of fuel per hour
                        </div>
                    </div>

                    <div class="results-breakdown-grid">
                        <div class="breakdown-box">
                            <span class="bb-label">Cost per Hour</span>
                            <span class="bb-value" id="genResHourlyCost">$1.55/hr</span>
                            <span class="bb-sub">In fuel expense</span>
                        </div>
                    <div class="results-breakdown-grid">
                        <div class="breakdown-box">
                            <span class="bb-label">Full Tank Cost</span>
                            <span class="bb-value" id="genResTankCost">$13.84</span>
                            <span class="bb-sub">To fill tank</span>
                        </div>
                        <div class="breakdown-box">
                            <span class="bb-label">Interpolated Burn Rate</span>
                            <span class="bb-value" id="genResInterpRate" style="color: var(--emerald-400);">0.38 gal/hr</span>
                            <span class="bb-sub" id="genResInterpSub">At 50% load</span>
                        </div>
                    </div>

                    <div class="breakdown-box" style="margin-bottom: 20px;">
                        <span class="bb-label">Load Interpolation Details</span>
                        <span class="bb-value" style="font-size: 0.9375rem; color: var(--emerald-400);" id="genResInterpDetail">
                            50% burn: 0.380 &bull; 75% burn: 0.551 (frac 0%)
                        </span>
                        <span class="bb-sub" id="genResInterpNote">Approximate fuel consumption. Actual fuel consumption varies by generator size, engine design, fuel type, altitude, maintenance, and load profile.</span>
                    </div>

                    <div class="breakdown-box" style="margin-bottom: 20px;">
                        <span class="bb-label">24-Hour Continuous Run Fuel</span>
                        <span class="bb-value" style="font-size: 1.5rem; color: var(--amber-400);" id="genResDayCost">$37.13</span>
                        <span class="bb-sub" id="genResDayGal">9.1 gallons needed per 24 hours</span>
                    </div>

                    <button type="button" class="btn btn-share" id="genCopyBtn">
                        Copy Generator Runtime Summary
                    </button>
                </div>
            </div>
        </div>

        <section class="calc-content-section">
            <div class="calc-content-card">
                <h2 class="content-heading-2">How to Extend Generator Runtime in a Blackout</h2>
                <p class="content-p">
                    To maximize fuel efficiency during an emergency power outage, switch off unnecessary circuits such as water heaters, hot tubs, and decorative lighting. Modern inverter generators feature an "Eco Throttle" mode that automatically slows engine RPM when electrical loads drop, reducing fuel consumption significantly.
                </p>
                <h3 class="content-heading-3">Engine Specific Fuel Consumption Load Curve</h3>
                <p class="content-p">
                    Small four-stroke utility engines do not scale fuel burn linearly with zero-idle overhead. Due to fixed mechanical friction, pumping losses, and rotor excitation, an idling generator typically consumes about 40% of its 50%-load fuel rate. Our piecewise interpolation accurately reflects standard small engine curves: 0.60&times; at 25% load, 1.00&times; at 50% load, 1.45&times; at 75% load, and 1.90&times; at 100% full continuous rated output.
                </p>
            </div>
        </section>
    </div>
</main>


<?php get_footer(); ?>
