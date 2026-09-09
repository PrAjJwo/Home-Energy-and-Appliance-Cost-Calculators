<?php
/**
 * Template Name: Calculator - heat-pump-savings
 */

get_header();
?>


<div class="container" style="padding-top: 20px;">
    <nav class="breadcrumb-nav" aria-label="Breadcrumb" style="font-size: 0.8125rem; color: var(--slate-500); display: flex; gap: 8px; align-items: center;">
        <a href="/" style="color: var(--slate-600);">Home</a>
        <span>/</span>
        <a href="/categories/hvac-cooling-heating/" style="color: var(--slate-600);">HVAC, Heating & Cooling</a>
        <span>/</span>
        <span style="color: var(--emerald-700); font-weight: 700;">Heat Pump Savings Calculator</span>
    </nav>
</div>

<main class="section-padding" style="padding-top: 24px;">
    <div class="container">
        <div style="margin-bottom: 30px;">
            <span class="section-tag">Category 2: HVAC &bull; Active Tool</span>
            <h1 style="font-size: 2.5rem; letter-spacing: -0.02em; margin-bottom: 12px; color: var(--slate-900);">
                Heat Pump Savings Calculator
            </h1>
            <p style="font-size: 1.125rem; color: var(--slate-600); max-width: 760px; line-height: 1.6;">
                Modern air-source heat pumps don't create heat; they extract free ambient heat from outdoor air and transfer it indoors at up to 300% efficiency. Compare your current heating fuel expenses against a high-efficiency heat pump to determine your annual savings.
            </p>
        </div>

        <div class="calculator-wrapper">
            <!-- Quick Heating Comparison Presets -->
            <div class="calc-presets-section">
                <div class="presets-header">
                    <span class="presets-title">Compare Against Your Current Heating System:</span>
                    <span class="presets-hint">Loads benchmark fuel costs and boiler efficiencies</span>
                </div>
                <div class="presets-scroll">
                    <button type="button" class="preset-chip is-selected" data-fuel="oil" data-fuel-price="4.15" data-fuel-eff="80">
                        Heating Oil ($4.15/gal &bull; 80% boiler)
                    </button>
                    <button type="button" class="preset-chip" data-fuel="propane" data-fuel-price="3.20" data-fuel-eff="85">
                        Propane Gas ($3.20/gal &bull; 85% furnace)
                    </button>
                    <button type="button" class="preset-chip" data-fuel="electric_baseboard" data-fuel-price="0.1830" data-fuel-eff="100">
                        Electric Resistance Baseboards (COP 1.0)
                    </button>
                    <button type="button" class="preset-chip" data-fuel="nat_gas" data-fuel-price="1.45" data-fuel-eff="80">
                        Standard Natural Gas ($1.45/therm &bull; 80%)
                    </button>
                </div>
            </div>

            <div class="calc-grid">
                <!-- Inputs -->
                <div class="calc-inputs-col">
                    <h2 style="font-size: 1.25rem; color: var(--slate-800);">Heating Parameters:</h2>

                    <!-- Custom Old Heating System Inputs -->
                    <div class="calc-group" style="background: var(--slate-50); padding: 12px; border-radius: var(--radius-md); border: 1px solid var(--border-subtle); margin-bottom: 16px;">
                        <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 8px;">
                            <label class="calc-label" style="margin: 0;">Old Heating System Specifications:</label>
                            <span class="calc-value-badge highlight" id="hpOldFuelBadge">Heating Oil: $4.15/gal &bull; 80%</span>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                            <div>
                                <label for="hpFuelPriceInput" id="hpFuelPriceLabel" style="font-size: 0.75rem; color: var(--slate-600); font-weight: 700; display: block; margin-bottom: 4px;">
                                    Current Fuel Price ($/gal):
                                </label>
                                <div class="calc-input-wrapper">
                                    <input type="number" id="hpFuelPriceInput" class="calc-number-input" value="4.15" min="0" max="100.0" step="0.01">
                                </div>
                            </div>
                            <div>
                                <label for="hpFuelEffInput" id="hpFuelEffLabel" style="font-size: 0.75rem; color: var(--slate-600); font-weight: 700; display: block; margin-bottom: 4px;">
                                    System Efficiency (AFUE %):
                                </label>
                                <div class="calc-input-wrapper">
                                    <input type="number" id="hpFuelEffInput" class="calc-number-input" value="80" min="40" max="100" step="1">
                                    <span class="input-suffix">%</span>
                                </div>
                            </div>
                        </div>
                        <span class="calc-help" style="margin-top: 6px; display: block; font-size: 0.75rem;">
                            Prefilled from chosen preset. You can manually adjust fuel price and boiler/furnace efficiency.
                        </span>
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="hpLoadInput" class="calc-label">Annual Home Heating Load (Million BTUs):</label>
                            <span class="calc-value-badge highlight" id="hpLoadBadge">60 MMBtu/yr</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="hpLoadInput" class="calc-number-input" value="60" min="20" max="150" step="5">
                            <span class="input-suffix">MMBtu</span>
                        </div>
                        <input type="range" id="hpLoadRange" class="calc-range" min="30" max="120" step="5" value="60">
                        <span class="calc-help">Approximate: 1,500 sq ft home = ~50 MMBtu; 2,000 sq ft = ~65 MMBtu; 2,500+ sq ft = ~85 MMBtu.</span>
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="hpCopInput" class="calc-label">Heat Pump Average Seasonal Efficiency (COP):</label>
                            <span class="calc-value-badge" id="hpCopBadge">3.0 COP</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="hpCopInput" class="calc-number-input" value="3.0" min="2.0" max="4.5" step="0.1">
                            <span class="input-suffix">COP (300%)</span>
                        </div>
                        <input type="range" id="hpCopRange" class="calc-range" min="2.0" max="4.0" step="0.1" value="3.0">
                        <span class="calc-help">A COP of 3.0 means the heat pump outputs 3 units of heat for every 1 unit of electricity consumed.</span>
                    </div>

                    <!-- Auxiliary Resistance Backup Heat -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="hpAuxInput" class="calc-label">Auxiliary Resistance Backup Heat Share (%):</label>
                            <span class="calc-value-badge" id="hpAuxBadge">5% aux backup</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="hpAuxInput" class="calc-number-input" value="5" min="0" max="40" step="1">
                            <span class="input-suffix">% of season</span>
                        </div>
                        <input type="range" id="hpAuxRange" class="calc-range" min="0" max="30" step="1" value="5">
                        <span class="calc-help">Electric resistance heat strips (COP 1.0) activate during severe cold snaps. Modern cold-climate heat pumps typically require only 0% to 10% auxiliary heat.</span>
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="hpRateInput" class="calc-label">Electricity Rate (<span data-currency-symbol>$</span>/kWh):</label>
                            <span class="calc-value-badge">Benchmark Active</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="hpRateInput" class="calc-number-input" value="0.1830" min="0.01" max="2.00" step="0.0001">
                            <span class="input-suffix">per kWh</span>
                        </div>
                    </div>
                </div>

                <!-- Results Column -->
                <div class="calc-results-col">
                    <div class="results-header">
                        <h3 class="results-title">Annual Savings Projection</h3>
                        <span class="results-badge">Heat Pump ROI</span>
                    </div>

                    <div class="cost-card-primary">
                        <div class="cost-period-label" id="hpResSavingsPeriodLabel">Estimated Annual Heating Savings</div>
                        <div class="cost-big-number">
                            <span id="hpResAnnualSavings" style="color: var(--emerald-400);">$0.00</span>
                        </div>
                        <div class="cost-sub-kwh" id="hpResSavingsSub">
                            Saving <strong id="hpResPercent">0%</strong> on winter heating bills
                        </div>
                    </div>

                    <div class="results-breakdown-grid">
                        <div class="breakdown-box">
                            <span class="bb-label">Current Heating Bill</span>
                            <span class="bb-value" id="hpResOldBill">$0.00</span>
                            <span class="bb-sub" id="hpOldFuelLabel">With heating oil</span>
                        </div>
                        <div class="breakdown-box">
                            <span class="bb-label">New Heat Pump Bill</span>
                            <span class="bb-value" id="hpResNewBill">$0.00</span>
                            <span class="bb-sub" id="hpNewKwhLabel">0 kWh electricity</span>
                        </div>
                    </div>

                    <div class="breakdown-box" style="margin-bottom: 20px;">
                        <span class="bb-label" id="hpResTenYearLabel">10-Year Cumulative Net Savings</span>
                        <span class="bb-value" style="font-size: 1.5rem; color: var(--emerald-400);" id="hpResTenYearSavings">$0.00</span>
                        <span class="bb-sub" id="hpResTenYearSub">Simple 10-year projection (assumes constant fuel and electricity prices)</span>
                    </div>

                    <button type="button" class="btn btn-share" id="hpCopyBtn">
                        Copy Heat Pump Savings Summary
                    </button>
                </div>
            </div>
        </div>

        <section class="calc-content-section">
            <div class="calc-content-card">
                <h2 class="content-heading-2">Why Heat Pumps Save Homeowners Money</h2>
                <p class="content-p">
                    Unlike standard furnaces that burn fuel or heat resistance coils, heat pumps leverage thermodynamic refrigerant cycles to move heat from the outdoor atmosphere into your home. Exactly 1 kilowatt-hour (kWh) of electricity produces 3,412.14 BTU of heat through direct resistance. With a high-efficiency cold-climate heat pump operating at a seasonal COP of 3.0, that same 1 kWh of electricity delivers 10,236.4 BTU of space heat.
                </p>

                <h3 class="content-heading-3">Verified Heating Fuel Heat Densities</h3>
                <ul style="margin-left: 24px; margin-bottom: 18px; color: var(--slate-700); line-height: 1.8;">
                    <li><strong>Heating Oil:</strong> 138,500 BTU per gallon</li>
                    <li><strong>Propane:</strong> 91,452 BTU per gallon</li>
                    <li><strong>Natural Gas:</strong> 100,000 BTU per therm</li>
                    <li><strong>Electricity:</strong> 3,412.14 BTU per kilowatt-hour (kWh)</li>
                </ul>
                <p class="content-p" style="font-size: 0.875rem; color: var(--slate-500);">
                    Disclaimer: 10-year financial projections are simplified estimations assuming static utility tariffs and fuel market prices over the system lifetime. Actual long-term savings will fluctuate with regional fuel commodity inflation and annual winter heating degree days.
                </p>
            </div>
        </section>
    </div>
</main>


<?php get_footer(); ?>
