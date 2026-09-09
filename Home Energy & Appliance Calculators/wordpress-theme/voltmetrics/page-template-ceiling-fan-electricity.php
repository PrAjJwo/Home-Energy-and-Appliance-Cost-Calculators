<?php
/**
 * Template Name: Calculator - ceiling-fan-electricity
 */

get_header();
?>


<div class="container" style="padding-top: 20px;">
    <nav class="breadcrumb-nav" aria-label="Breadcrumb" style="font-size: 0.8125rem; color: var(--slate-500); display: flex; gap: 8px; align-items: center;">
        <a href="/" style="color: var(--slate-600);">Home</a>
        <span>/</span>
        <a href="/categories/hvac-cooling-heating/" style="color: var(--slate-600);">HVAC, Heating & Cooling</a>
        <span>/</span>
        <span style="color: var(--emerald-700); font-weight: 700;">Ceiling Fan Electricity Calculator</span>
    </nav>
</div>

<main class="section-padding" style="padding-top: 24px;">
    <div class="container">
        <div style="margin-bottom: 30px;">
            <span class="section-tag">Category 2: HVAC &bull; Active Tool</span>
            <h1 style="font-size: 2.5rem; letter-spacing: -0.02em; margin-bottom: 12px; color: var(--slate-900);">
                Ceiling Fan Electricity Calculator
            </h1>
            <p style="font-size: 1.125rem; color: var(--slate-600); max-width: 760px; line-height: 1.6;">
                Ceiling fans move air rather than cool it, creating a wind-chill sensation that feels up to 4&deg;F cooler on human skin. Discover how little it costs to run your ceiling fans, and see how pairing fans with a higher AC thermostat generates net savings.
            </p>
        </div>

        <div class="calculator-wrapper">
            <!-- Fan Motor Presets -->
            <div class="calc-presets-section">
                <div class="presets-header">
                    <span class="presets-title">Fan Motor & Speed Presets:</span>
                    <span class="presets-hint">Select fan motor technology</span>
                </div>
                <div class="presets-scroll">
                    <button type="button" class="preset-chip is-selected" data-fan-watts="65" data-fan-hours="10" data-fan-name="Standard AC Fan (Medium Speed &bull; 65W)">
                        Standard AC Motor (Medium Speed &bull; 65W)
                    </button>
                    <button type="button" class="preset-chip" data-fan-watts="85" data-fan-hours="10" data-fan-name="Standard AC Fan (High Speed &bull; 85W)">
                        Standard AC Motor (High Speed &bull; 85W)
                    </button>
                    <button type="button" class="preset-chip" data-fan-watts="25" data-fan-hours="12" data-fan-name="Ultra-Efficient DC Motor (Medium &bull; 25W)">
                        Ultra-Efficient DC Motor (Medium &bull; 25W)
                    </button>
                    <button type="button" class="preset-chip" data-fan-watts="12" data-fan-hours="16" data-fan-name="DC Motor Low Breeze (12W)">
                        DC Motor Low Breeze (12W)
                    </button>
                    <button type="button" class="preset-chip" data-fan-watts="105" data-fan-hours="8" data-fan-name="Fan with Integrated Light Kit (105W)">
                        Fan with Light Kit (105W)
                    </button>
                </div>
            </div>

            <div class="calc-grid">
                <!-- Inputs -->
                <div class="calc-inputs-col">
                    <h2 style="font-size: 1.25rem; color: var(--slate-800);">Fan Specifications:</h2>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="fanWattsInput" class="calc-label">Fan Power Consumption (Watts):</label>
                            <span class="calc-value-badge highlight" id="fanWattsBadge">65 Watts</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="fanWattsInput" class="calc-number-input" value="65" min="5" max="250">
                            <span class="input-suffix">Watts</span>
                        </div>
                        <input type="range" id="fanWattsRange" class="calc-range" min="10" max="150" step="5" value="65">
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="fanCountInput" class="calc-label">Number of Active Ceiling Fans:</label>
                            <span class="calc-value-badge" id="fanCountBadge">2 Fans</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="fanCountInput" class="calc-number-input" value="2" min="1" max="10">
                            <span class="input-suffix">Fans</span>
                        </div>
                        <input type="range" id="fanCountRange" class="calc-range" min="1" max="8" step="1" value="2">
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="fanHoursInput" class="calc-label">Daily Operating Hours per Fan:</label>
                            <span class="calc-value-badge" id="fanHoursBadge">10 hrs/day</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="fanHoursInput" class="calc-number-input" value="10" min="1" max="24">
                            <span class="input-suffix">Hours</span>
                        </div>
                        <input type="range" id="fanHoursRange" class="calc-range" min="1" max="24" step="1" value="10">
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="fanRateInput" class="calc-label">Electricity Rate (<span data-currency-symbol>$</span>/kWh):</label>
                            <span class="calc-value-badge">Benchmark Active</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="fanRateInput" class="calc-number-input" value="0.1830" min="0.01" max="2.00" step="0.0001">
                            <span class="input-suffix">per kWh</span>
                        </div>
                    </div>

                    <!-- AC Thermostat Offset Parameters -->
                    <div style="background: var(--slate-50); border: 1px solid var(--border-subtle); padding: 16px; border-radius: var(--radius-md); margin-top: 10px;">
                        <span style="font-size: 0.8125rem; font-weight: 700; color: var(--slate-800); display: block; margin-bottom: 6px;">AC Thermostat Setback Comparison:</span>
                        
                        <div style="margin-bottom: 10px;">
                            <label for="fanAcBillInput" style="font-size: 0.75rem; color: var(--slate-600); display: block; margin-bottom: 4px;">Estimated Monthly Summer AC Bill (<span data-currency-symbol>$</span>):</label>
                            <div class="calc-input-wrapper">
                                <input type="number" id="fanAcBillInput" class="calc-number-input" value="150" min="20" max="1000" step="10">
                                <span class="input-suffix">per month</span>
                            </div>
                        </div>

                        <div>
                            <label for="fanSetbackPctInput" style="font-size: 0.75rem; color: var(--slate-600); display: block; margin-bottom: 4px;">AC Consumption Reduction from 4&deg;F Setback (%):</label>
                            <div class="calc-input-wrapper">
                                <input type="number" id="fanSetbackPctInput" class="calc-number-input" value="8" min="1" max="25" step="1">
                                <span class="input-suffix">%</span>
                            </div>
                            <span class="calc-help" style="margin-top: 4px; display: block;">DOE benchmarks indicate raising your thermostat 4&deg;F reduces cooling demand by roughly 7% to 10%.</span>
                        </div>
                    </div>
                </div>

                <!-- Results Column -->
                <div class="calc-results-col">
                    <div class="results-header">
                        <h3 class="results-title">Fan Energy Costs</h3>
                        <span class="results-badge">Live</span>
                    </div>

                    <div class="cost-card-primary">
                        <div class="cost-period-label">Estimated Monthly Fan Cost</div>
                        <div class="cost-big-number">
                            <span id="fanResMonthlyCost">$0.00</span>
                        </div>
                        <div class="cost-sub-kwh">
                            Using <strong id="fanResMonthlyKwh" style="color: var(--emerald-400);">0 kWh</strong> / month
                        </div>
                    </div>

                    <div class="results-breakdown-grid">
                        <div class="breakdown-box">
                            <span class="bb-label">Cost per Fan Hour</span>
                            <span class="bb-value" id="fanResHourlyCost">$0.00</span>
                            <span class="bb-sub">Pennies to circulate</span>
                        </div>
                        <div class="breakdown-box">
                            <span class="bb-label">Daily Total</span>
                            <span class="bb-value" id="fanResDailyCost">$0.00</span>
                            <span class="bb-sub" id="fanResDailyKwh">0.0 kWh/day</span>
                        </div>
                    </div>

                    <!-- Wind Chill Thermostat Net Benefit -->
                    <div class="comparison-section">
                        <div class="comparison-header">
                            <span class="star-icon">&#9733;</span>
                            <span class="comparison-title">Thermostat Offset Net Impact</span>
                        </div>
                        <p style="font-size: 0.8125rem; color: var(--slate-300); margin-bottom: 6px;">
                            Net savings (AC bill reduction minus fan electricity cost):
                        </p>
                        <div style="font-size: 1.125rem; font-weight: 800; color: var(--emerald-400);" id="fanResAcSavings">
                            +$0.00 / month Net
                        </div>
                    </div>

                    <button type="button" class="btn btn-share" id="fanCopyBtn">
                        Copy Fan Energy Summary
                    </button>
                </div>
            </div>
        </div>

        <section class="calc-content-section">
            <div class="calc-content-card">
                <h2 class="content-heading-2">The Physics of Ceiling Fans and Energy Savings</h2>
                <p class="content-p">
                    Ceiling fans do not change room air temperature; they cool people through convective and evaporative heat loss. The moving air accelerates the rate at which perspiration evaporates from skin, producing a wind-chill sensation that feels approximately 4&deg;F cooler than the actual thermometer reading.
                </p>
                <p class="content-p">
                    Remember the golden rule of ceiling fan efficiency: <strong>"Fans cool people, not rooms."</strong> A ceiling fan operating in an unoccupied room produces zero cooling benefit. In fact, its electric motor dissipates roughly 50 to 80 watts of electrical energy directly into the room as waste heat. Always turn ceiling fans off when leaving a room to prevent wasted electricity.
                </p>
            </div>
        </section>
    </div>
</main>


<?php get_footer(); ?>
