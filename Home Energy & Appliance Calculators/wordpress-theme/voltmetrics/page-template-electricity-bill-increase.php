<?php
/**
 * Template Name: Calculator - electricity-bill-increase
 */

get_header();
?>


<div class="container" style="padding-top: 20px;">
    <nav class="breadcrumb-nav" aria-label="Breadcrumb" style="font-size: 0.8125rem; color: var(--slate-500); display: flex; gap: 8px; align-items: center;">
        <a href="/" style="color: var(--slate-600);">Home</a>
        <span>/</span>
        <a href="/categories/ev-utility/" style="color: var(--slate-600);">EV & High-Load Utility</a>
        <span>/</span>
        <span style="color: var(--emerald-700); font-weight: 700;">Electricity Bill Increase Calculator</span>
    </nav>
</div>

<main class="section-padding" style="padding-top: 24px;">
    <div class="container">
        <div style="margin-bottom: 30px;">
            <span class="section-tag">Category 4: EV & Utility &bull; Active Tool</span>
            <h1 style="font-size: 2.5rem; letter-spacing: -0.02em; margin-bottom: 12px; color: var(--slate-900);">
                Electricity Bill Increase Calculator
            </h1>
            <p style="font-size: 1.125rem; color: var(--slate-600); max-width: 760px; line-height: 1.6;">
                Thinking about adding an electric car, installing a backyard hot tub, or bracing for an upcoming electric utility tariff hike? Calculate your exact monthly and annual bill jump, including tiered rate threshold penalties.
            </p>
        </div>

        <div class="calculator-wrapper">
            <!-- Added Load Presets -->
            <div class="calc-presets-section">
                <div class="presets-header">
                    <span class="presets-title">Select an Added High-Load Addition:</span>
                    <span class="presets-hint">Pre-loads typical monthly kilowatt-hour jumps</span>
                </div>
                <div class="presets-scroll">
                    <button type="button" class="preset-chip is-selected" data-bi-kwh="280">
                        New Electric Vehicle (+280 kWh)
                    </button>
                    <button type="button" class="preset-chip" data-bi-kwh="220">
                        Outdoor Hot Tub / Spa (+220 kWh)
                    </button>
                    <button type="button" class="preset-chip" data-bi-kwh="450">
                        Central AC Summer Peak (+450 kWh)
                    </button>
                    <button type="button" class="preset-chip" data-bi-kwh="150">
                        Garage Refrigerator & Freezer (+150 kWh)
                    </button>
                    <button type="button" class="preset-chip" data-bi-kwh="350">
                        AI Home Lab / Server (+350 kWh)
                    </button>
                </div>
            </div>

            <div class="calc-grid">
                <!-- Inputs -->
                <div class="calc-inputs-col">
                    <h2 style="font-size: 1.25rem; color: var(--slate-800); margin-bottom: 12px;">Baseline & Addition Inputs:</h2>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="biBaseKwhInput" class="calc-label">Current Monthly Consumption (Baseline kWh):</label>
                            <span class="calc-value-badge highlight" id="biBaseKwhBadge">750 kWh/mo</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="biBaseKwhInput" class="calc-number-input" value="750" min="50" max="5000" step="25">
                            <span class="input-suffix">kWh</span>
                        </div>
                        <input type="range" id="biBaseKwhRange" class="calc-range" min="100" max="2500" step="25" value="750">
                        <span class="calc-help">Average US household uses approximately 850 to 900 kWh per month.</span>
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="biAddKwhInput" class="calc-label">Additional Monthly Consumption (Added kWh):</label>
                            <span class="calc-value-badge" id="biAddKwhBadge">+280 kWh/mo</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="biAddKwhInput" class="calc-number-input" value="280" min="0" max="4000" step="10">
                            <span class="input-suffix">Added kWh</span>
                        </div>
                        <input type="range" id="biAddKwhRange" class="calc-range" min="0" max="1500" step="10" value="280">
                    </div>

                    <!-- Fixed Monthly Customer Charge -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="biFixedChargeInput" class="calc-label">Fixed Monthly Customer Charge (<span data-currency-symbol>$</span>/mo):</label>
                            <span class="calc-value-badge" id="biFixedBadge">$15.00/mo</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="biFixedChargeInput" class="calc-number-input" value="15.00" min="0" max="100" step="0.50">
                            <span class="input-suffix">Fixed Base Fee</span>
                        </div>
                        <span class="calc-help">Monthly meter fee, grid connection fee, or daily standing charge.</span>
                    </div>

                    <!-- Tiered Tariff Toggle & Rates -->
                    <div class="calc-group">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <label class="calc-label" style="margin-bottom: 0;">Tariff Structure:</label>
                            <label style="display: flex; align-items: center; gap: 6px; font-size: 0.875rem; color: var(--emerald-700); cursor: pointer; font-weight: 600;">
                                <input type="checkbox" id="biTieredToggle">
                                Enable Tiered / Inverted Block Pricing
                            </label>
                        </div>

                        <!-- Flat Rate Group -->
                        <div id="biFlatRateContainer">
                            <div class="calc-label-row">
                                <label for="biRateInput" class="calc-label">Electricity Rate (<span data-currency-symbol>$</span>/kWh):</label>
                                <span class="calc-value-badge">Benchmark Active</span>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="biRateInput" class="calc-number-input" value="0.1830" min="0.01" max="2.00" step="0.0001">
                                <span class="input-suffix">per kWh</span>
                            </div>
                        </div>

                        <!-- Tiered Rate Group -->
                        <div id="biTieredContainer" style="display: none; background: var(--slate-50); border: 1px solid var(--border-subtle); border-radius: 8px; padding: 12px; margin-top: 8px;">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 8px;">
                                <div>
                                    <label for="biTier1LimitInput" class="calc-label" style="font-size: 0.8125rem;">Tier 1 Cap (kWh/mo):</label>
                                    <input type="number" id="biTier1LimitInput" class="calc-number-input" value="500" min="100" max="2000" step="25">
                                </div>
                                <div>
                                    <label for="biTier1RateInput" class="calc-label" style="font-size: 0.8125rem;">Tier 1 Rate ($/kWh):</label>
                                    <input type="number" id="biTier1RateInput" class="calc-number-input" value="0.1830" min="0.01" max="2.00" step="0.0001">
                                </div>
                            </div>
                            <div>
                                <label for="biTier2RateInput" class="calc-label" style="font-size: 0.8125rem;">Tier 2 Excess Rate ($/kWh):</label>
                                <input type="number" id="biTier2RateInput" class="calc-number-input" value="0.2650" min="0.01" max="2.00" step="0.0001">
                                <span class="calc-help">Additional kWh pushed beyond Tier 1 cap are billed at this higher marginal rate.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Results Column -->
                <div class="calc-results-col">
                    <div class="results-header">
                        <h3 class="results-title">Bill Increase Impact</h3>
                        <span class="results-badge">Projection</span>
                    </div>

                    <div class="cost-card-primary">
                        <div class="cost-period-label">Estimated Monthly Bill Jump</div>
                        <div class="cost-big-number">
                            <span id="biResDiffCost" style="color: var(--amber-400);">+$51.24</span>
                        </div>
                        <div class="cost-sub-kwh">
                            A <strong id="biResPercentJump" style="color: var(--emerald-400);">+33.6%</strong> total bill increase
                        </div>
                    </div>

                    <div class="results-breakdown-grid">
                        <div class="breakdown-box">
                            <span class="bb-label">Current Baseline Bill</span>
                            <span class="bb-value" id="biResBaseCost">$152.25</span>
                            <span class="bb-sub" id="biResBaseKwhLabel">750 kWh incl. $15 fee</span>
                        </div>
                        <div class="breakdown-box">
                            <span class="bb-label">New Projected Bill</span>
                            <span class="bb-value" id="biResNewCost">$203.49</span>
                            <span class="bb-sub" id="biResNewKwhLabel">1,030 kWh total</span>
                        </div>
                    </div>

                    <div class="results-breakdown-grid" style="margin-top: 14px;">
                        <div class="breakdown-box">
                            <span class="bb-label">Volumetric Energy Jump</span>
                            <span class="bb-value" id="biResVolumetricJump">+37.3%</span>
                            <span class="bb-sub">Excluding fixed fee</span>
                        </div>
                        <div class="breakdown-box">
                            <span class="bb-label">Marginal Added Rate</span>
                            <span class="bb-value" id="biResMarginalRate">$0.183/kWh</span>
                            <span class="bb-sub" id="biResMarginalSub">Flat pricing</span>
                        </div>
                    </div>

                    <div class="breakdown-box" style="margin-top: 14px; margin-bottom: 20px;">
                        <span class="bb-label">Annual Extra Expenditure</span>
                        <span class="bb-value" style="font-size: 1.4rem; color: var(--amber-400);" id="biResAnnualDiff">+$614.88 / year</span>
                        <span class="bb-sub">Total additional utility cost across 12 months</span>
                    </div>

                    <button type="button" class="btn btn-share" id="biCopyBtn">
                        Copy Bill Increase Summary
                    </button>
                </div>
            </div>
        </div>

        <section class="calc-content-section">
            <div class="calc-content-card">
                <h2 class="content-heading-2">Understanding Tiered Utility Rate Traps and Marginal Cost</h2>
                <div class="formula-box">
                    <strong>Marginal Cost vs Average Cost:</strong><br>
                    Total Bill = Fixed Base Charge + (Tier 1 kWh &times; Tier 1 Rate) + (Tier 2 kWh &times; Tier 2 Rate)<br>
                    Marginal Cost of New Load = New Total Bill &minus; Baseline Total Bill
                </div>
                <p class="content-p">
                    Many municipal electric utilities (such as PG&amp;E, SCE, and Hawaiian Electric) implement tiered rate structures. When your household consumes more electricity than your baseline allowance, additional kilowatt-hours are pushed into Tier 2 or Tier 3 pricing tiers that cost 30% to 70% more per unit. For example, adding an EV that uses 280 kWh per month might be billed entirely at 26.5 cents per kWh rather than your 18.3-cent baseline tariff.
                </p>
            </div>
        </section>
    </div>
</main>


<?php get_footer(); ?>
