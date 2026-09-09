<?php
/**
 * Template Name: Calculator - watts-to-monthly-cost
 */

get_header();
?>


<div class="container" style="padding-top: 20px;">
    <nav class="breadcrumb-nav" aria-label="Breadcrumb" style="font-size: 0.8125rem; color: var(--slate-500); display: flex; gap: 8px; align-items: center;">
        <a href="/" style="color: var(--slate-600);">Home</a>
        <span>/</span>
        <a href="/categories/appliances/" style="color: var(--slate-600);">Everyday Appliances</a>
        <span>/</span>
        <span style="color: var(--emerald-700); font-weight: 700;">Watts to Monthly Cost Calculator</span>
    </nav>
</div>

<main class="section-padding" style="padding-top: 24px;">
    <div class="container">
        <div style="margin-bottom: 30px;">
            <span class="section-tag">Category 1: Everyday Appliances &bull; Active Tool</span>
            <h1 style="font-size: 2.5rem; letter-spacing: -0.02em; margin-bottom: 12px; color: var(--slate-900);">
                Watts to Monthly Cost Calculator
            </h1>
            <p style="font-size: 1.125rem; color: var(--slate-600); max-width: 760px; line-height: 1.6;">
                Quickly convert any electrical wattage rating into real dollars and cents on your utility bill. Enter any power rating between 1 and 10,000 Watts to instantly view your hourly, daily, monthly, and yearly expenses.
            </p>
        </div>

        <div class="calculator-wrapper">
            <!-- Quick Wattage Presets -->
            <div class="calc-presets-section">
                <div class="presets-header">
                    <span class="presets-title">Popular Wattage Presets:</span>
                    <span class="presets-hint">Click to instantly populate power draw</span>
                </div>
                <div class="presets-scroll">
                    <button type="button" class="preset-chip" data-watt-val="10" data-hours-val="24">10W (LED Bulb / Smart Plug)</button>
                    <button type="button" class="preset-chip" data-watt-val="25" data-hours-val="24">25W (Wi-Fi Router)</button>
                    <button type="button" class="preset-chip is-selected" data-watt-val="100" data-hours-val="8">100W (Office Workstation)</button>
                    <button type="button" class="preset-chip" data-watt-val="350" data-hours-val="6">350W (Gaming Rig)</button>
                    <button type="button" class="preset-chip" data-watt-val="800" data-hours-val="4">800W (Room Air Conditioner)</button>
                    <button type="button" class="preset-chip" data-watt-val="1500" data-hours-val="5">1,500W (Space Heater / Kettle)</button>
                    <button type="button" class="preset-chip" data-watt-val="3000" data-hours-val="1.5">3,000W (Electric Dryer)</button>
                </div>
            </div>

            <div class="calc-grid">
                <!-- Inputs -->
                <div class="calc-inputs-col">
                    <h2 style="font-size: 1.25rem; color: var(--slate-800);">Enter Wattage & Usage:</h2>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="wtWattsInput" class="calc-label">Power Rating (Watts):</label>
                            <span class="calc-value-badge highlight" id="wtWattsBadge">100 Watts</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="wtWattsInput" class="calc-number-input" value="100" min="1" max="25000">
                            <span class="input-suffix">Watts</span>
                        </div>
                        <input type="range" id="wtWattsRange" class="calc-range" min="5" max="3000" step="5" value="100">
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="wtHoursInput" class="calc-label">Usage Duration (Hours per Day):</label>
                            <span class="calc-value-badge" id="wtHoursBadge">8 hrs/day</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="wtHoursInput" class="calc-number-input" value="8" min="0.1" max="24" step="0.5">
                            <span class="input-suffix">Hours</span>
                        </div>
                        <input type="range" id="wtHoursRange" class="calc-range" min="0.5" max="24" step="0.5" value="8">
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="wtDaysInput" class="calc-label">Billing Cycle Days per Month:</label>
                            <span class="calc-value-badge" id="wtDaysBadge">30 days</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="wtDaysInput" class="calc-number-input" value="30" min="1" max="31" step="0.01">
                            <span class="input-suffix">Days/Month</span>
                        </div>
                        <div style="display: flex; gap: 8px; margin-top: 6px;">
                            <button type="button" class="btn btn-outline" style="padding: 4px 10px; font-size: 0.75rem;" onclick="document.getElementById('wtDaysInput').value=30; document.getElementById('wtDaysInput').dispatchEvent(new Event('input'));">Standard (30d)</button>
                            <button type="button" class="btn btn-outline" style="padding: 4px 10px; font-size: 0.75rem;" onclick="document.getElementById('wtDaysInput').value=30.42; document.getElementById('wtDaysInput').dispatchEvent(new Event('input'));">Avg Month (30.42d)</button>
                            <button type="button" class="btn btn-outline" style="padding: 4px 10px; font-size: 0.75rem;" onclick="document.getElementById('wtDaysInput').value=31; document.getElementById('wtDaysInput').dispatchEvent(new Event('input'));">Full Month (31d)</button>
                        </div>
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="wtRateInput" class="calc-label">Tariff Rate (<span data-currency-symbol>$</span>/kWh):</label>
                            <span class="calc-value-badge">Benchmark Active</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="wtRateInput" class="calc-number-input" value="0.1830" min="0.01" max="2.00" step="0.0001">
                            <span class="input-suffix">per kWh</span>
                        </div>
                    </div>
                </div>

                <!-- Results Column -->
                <div class="calc-results-col">
                    <div class="results-header">
                        <h3 class="results-title">Calculated Costs</h3>
                        <span class="results-badge">Live</span>
                    </div>

                    <div class="cost-card-primary">
                        <div class="cost-period-label">Estimated Monthly Bill</div>
                        <div class="cost-big-number">
                            <span id="wtResMonthlyCost">$0.00</span>
                        </div>
                        <div class="cost-sub-kwh">
                            Using <strong id="wtResMonthlyKwh" style="color: var(--emerald-400);">0.0 kWh</strong> / month
                        </div>
                    </div>

                    <div class="results-breakdown-grid">
                        <div class="breakdown-box">
                            <span class="bb-label">Cost per Hour</span>
                            <span class="bb-value" id="wtResHourlyCost">$0.00</span>
                            <span class="bb-sub" id="wtResKw">0.100 kW</span>
                        </div>
                        <div class="breakdown-box">
                            <span class="bb-label">Daily Cost</span>
                            <span class="bb-value" id="wtResDailyCost">$0.00</span>
                            <span class="bb-sub" id="wtResDailyKwh">0.00 kWh/day</span>
                        </div>
                    </div>

                    <div class="breakdown-box" style="margin-bottom: 20px;">
                        <span class="bb-label">Annual Operating Cost</span>
                        <span class="bb-value" style="font-size: 1.5rem; color: var(--emerald-400);" id="wtResAnnualCost">$0.00</span>
                        <span class="bb-sub" id="wtResAnnualKwh">0 kWh per year</span>
                    </div>

                    <button type="button" class="btn btn-share" id="wtCopyBtn">
                        Copy Calculation Summary
                    </button>
                </div>
            </div>
        </div>

        <section class="calc-content-section">
            <div class="calc-content-card">
                <h2 class="content-heading-2">The Watts to Monthly Cost Conversion Formula</h2>
                <div class="formula-box">
                    <strong>Formula:</strong><br>
                    Kilowatt-hours (kWh) = (Watts &times; Daily Hours &times; Days per Month) &divide; 1,000<br>
                    Monthly Cost = Kilowatt-hours &times; Electric Tariff ($/kWh)
                </div>
                <p class="content-p">
                    Continuous items such as network routers or security cameras that draw just 20 Watts run 24 hours a day for 720 hours over a 30-day month. That equals 14.4 kWh, adding approximately $2.64 per month at the US baseline rate of $0.1830/kWh (or $2.67 for a 30.42-day average month).
                </p>
            </div>
        </section>
    </div>
</main>


<?php get_footer(); ?>
