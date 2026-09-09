<?php
/**
 * Template Name: Calculator - portable-power-station-runtime
 */

get_header();
?>


<div class="container" style="padding-top: 20px;">
    <nav class="breadcrumb-nav" aria-label="Breadcrumb" style="font-size: 0.8125rem; color: var(--slate-500); display: flex; gap: 8px; align-items: center;">
        <a href="/" style="color: var(--slate-600);">Home</a>
        <span>/</span>
        <a href="/categories/backup-power/" style="color: var(--slate-600);">Backup Power & Off-Grid</a>
        <span>/</span>
        <span style="color: var(--emerald-700); font-weight: 700;">Portable Power Station Runtime Calculator</span>
    </nav>
</div>

<main class="section-padding" style="padding-top: 24px;">
    <div class="container">
        <div style="margin-bottom: 30px;">
            <span class="section-tag">Category 3: Backup Power &bull; Active Tool</span>
            <h1 style="font-size: 2.5rem; letter-spacing: -0.02em; margin-bottom: 12px; color: var(--slate-900);">
                Portable Power Station Runtime Calculator
            </h1>
            <p style="font-size: 1.125rem; color: var(--slate-600); max-width: 760px; line-height: 1.6;">
                Planning a camping trip or emergency storm preparedness? Calculate exactly how many hours your EcoFlow, Jackery, Anker, or Bluetti lithium power bank will sustain your gear, factoring in internal inverter conversion losses.
            </p>
        </div>

        <div class="calculator-wrapper">
            <!-- Power Station Model Presets -->
            <div class="calc-presets-section">
                <div class="presets-header">
                    <span class="presets-title">Select a Popular Power Station:</span>
                    <span class="presets-hint">Pre-loads battery Watt-hours and inverter ratings</span>
                </div>
                <div class="presets-scroll">
                    <button type="button" class="preset-chip" data-pps-wh="256" data-pps-cont="300" data-pps-surge="600">
                        256 Wh (River 2 / Jackery 240)
                    </button>
                    <button type="button" class="preset-chip" data-pps-wh="512" data-pps-cont="500" data-pps-surge="1000">
                        512 Wh (River 2 Max / Anker 535)
                    </button>
                    <button type="button" class="preset-chip is-selected" data-pps-wh="1024" data-pps-cont="1800" data-pps-surge="2700">
                        1,024 Wh (Delta 2 / Jackery 1000)
                    </button>
                    <button type="button" class="preset-chip" data-pps-wh="2048" data-pps-cont="2400" data-pps-surge="4800">
                        2,048 Wh (Delta 2 Max / AC200P)
                    </button>
                    <button type="button" class="preset-chip" data-pps-wh="3600" data-pps-cont="3600" data-pps-surge="7200">
                        3,600 Wh (Delta Pro / Anker Solix)
                    </button>
                </div>
            </div>

            <div class="calc-grid">
                <!-- Inputs -->
                <div class="calc-inputs-col">
                    <h2 style="font-size: 1.25rem; color: var(--slate-800); margin-bottom: 12px;">Power Station & Load Specs:</h2>

                    <!-- Output Connection Type -->
                    <div class="calc-group">
                        <label class="calc-label" style="margin-bottom: 8px;">Output Port Type:</label>
                        <div style="display: flex; gap: 16px; margin-bottom: 12px;">
                            <label style="display: flex; align-items: center; gap: 6px; font-size: 0.875rem; color: var(--slate-700); cursor: pointer;">
                                <input type="radio" name="ppsPortMode" value="ac" id="ppsPortAc" checked>
                                <strong>AC Inverter Port</strong> (120V/230V Outlets)
                            </label>
                            <label style="display: flex; align-items: center; gap: 6px; font-size: 0.875rem; color: var(--slate-700); cursor: pointer;">
                                <input type="radio" name="ppsPortMode" value="dc" id="ppsPortDc">
                                <strong>Direct DC Port</strong> (USB-C / 12V Car Socket)
                            </label>
                        </div>
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="ppsWhInput" class="calc-label">Battery Capacity (Watt-hours / Wh):</label>
                            <span class="calc-value-badge highlight" id="ppsWhBadge">1,024 Wh</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="ppsWhInput" class="calc-number-input" value="1024" min="100" max="10000" step="50">
                            <span class="input-suffix">Wh</span>
                        </div>
                        <input type="range" id="ppsWhRange" class="calc-range" min="200" max="4000" step="50" value="1024">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div class="calc-group">
                            <div class="calc-label-row">
                                <label for="ppsContRatingInput" class="calc-label">Station Cont. Rating (W):</label>
                                <span class="calc-value-badge" id="ppsContRatingBadge">1,800W</span>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="ppsContRatingInput" class="calc-number-input" value="1800" min="100" max="8000" step="50">
                                <span class="input-suffix">Watts</span>
                            </div>
                        </div>

                        <div class="calc-group">
                            <div class="calc-label-row">
                                <label for="ppsSurgeRatingInput" class="calc-label">Station Peak Surge (W):</label>
                                <span class="calc-value-badge" id="ppsSurgeRatingBadge">2,700W</span>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="ppsSurgeRatingInput" class="calc-number-input" value="2700" min="200" max="15000" step="50">
                                <span class="input-suffix">Watts</span>
                            </div>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div class="calc-group">
                            <div class="calc-label-row">
                                <label for="ppsLoadInput" class="calc-label">Continuous Load (Watts):</label>
                                <span class="calc-value-badge" id="ppsLoadBadge">60 Watts</span>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="ppsLoadInput" class="calc-number-input" value="60" min="0" max="5000" step="5">
                                <span class="input-suffix">Watts</span>
                            </div>
                        </div>

                        <div class="calc-group">
                            <div class="calc-label-row">
                                <label for="ppsSurgeLoadInput" class="calc-label">Starting Peak Surge (Watts):</label>
                                <span class="calc-value-badge" id="ppsSurgeLoadBadge">60 Watts</span>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="ppsSurgeLoadInput" class="calc-number-input" value="60" min="0" max="10000" step="10">
                                <span class="input-suffix">Watts</span>
                            </div>
                        </div>
                    </div>
                    <span class="calc-help" style="margin-top: -8px; margin-bottom: 12px; display: block;">
                        Compressors (refrigerators, AC units, sump pumps) spike 3x to 6x continuous wattage upon startup.
                    </span>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div class="calc-group" id="ppsIdleGroup">
                            <div class="calc-label-row">
                                <label for="ppsIdleInput" class="calc-label">Inverter Idle Draw (W):</label>
                                <span class="calc-value-badge" id="ppsIdleBadge">10 Watts</span>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="ppsIdleInput" class="calc-number-input" value="10" min="0" max="40" step="1">
                                <span class="input-suffix">Watts</span>
                            </div>
                            <span class="calc-help">Continuous standby drain while AC inverter is turned on.</span>
                        </div>

                        <div class="calc-group">
                            <div class="calc-label-row">
                                <label for="ppsEffInput" class="calc-label">Conversion Efficiency (%):</label>
                                <span class="calc-value-badge" id="ppsEffBadge">85% efficiency</span>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="ppsEffInput" class="calc-number-input" value="85" min="70" max="98" step="1">
                                <span class="input-suffix">%</span>
                            </div>
                            <span class="calc-help">AC pure sine wave: ~85%. Direct DC USB-C: ~92%.</span>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 16px;">
                        <div class="calc-group">
                            <div class="calc-label-row">
                                <label for="ppsDeviceEffInput" class="calc-label">Device Charging Efficiency (%):</label>
                                <span class="calc-value-badge" id="ppsDeviceEffBadge">90%</span>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="ppsDeviceEffInput" class="calc-number-input" value="90" min="50" max="100" step="1">
                                <span class="input-suffix">%</span>
                            </div>
                            <span class="calc-help">Energy lost during phone/laptop recharge process.</span>
                        </div>
                        <div class="calc-group">
                            <div class="calc-label-row">
                                <label for="ppsDeviceWhInput" class="calc-label">Custom Device Battery (Wh):</label>
                                <span class="calc-value-badge" id="ppsDeviceWhBadge">50 Wh</span>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="ppsDeviceWhInput" class="calc-number-input" value="50" min="1" max="5000" step="1">
                                <span class="input-suffix">Wh</span>
                            </div>
                        </div>
                    </div>

                    <!-- Surge & Overload Warnings -->
                    <div id="ppsSurgeWarning" style="display: none; background: #fef2f2; border: 1px solid #f87171; border-radius: 8px; padding: 12px 14px; margin-top: 10px;">
                        <strong style="color: #b91c1c; font-size: 0.875rem;">Inverter Surge Overload Warning:</strong>
                        <p style="color: #991b1b; font-size: 0.8125rem; margin: 4px 0 0 0; line-height: 1.4;" id="ppsSurgeWarningText">
                            Starting surge wattage exceeds the power station peak surge limit. The unit will trip on overload.
                        </p>
                    </div>
                </div>

                <!-- Results Column -->
                <div class="calc-results-col">
                    <div class="results-header">
                        <h3 class="results-title">Projected Runtime</h3>
                        <span class="results-badge">Portable Bank</span>
                    </div>

                    <div class="cost-card-primary">
                        <div class="cost-period-label">Estimated Continuous Runtime</div>
                        <div class="cost-big-number">
                            <span id="ppsResHours" style="color: var(--emerald-400);">12.4 Hours</span>
                        </div>
                        <div class="cost-sub-kwh">
                            Delivering <strong id="ppsResUsableWh">870 Wh</strong> of usable power
                        </div>
                    </div>

                    <div class="results-breakdown-grid">
                        <div class="breakdown-box">
                            <span class="bb-label">Total System Load</span>
                            <span class="bb-value" id="ppsResTotalLoad">70 Watts</span>
                            <span class="bb-sub" id="ppsResLoadSub">60W load + 10W inverter idle</span>
                        </div>
                        <div class="breakdown-box">
                            <span class="bb-label">Smartphone (15Wh)</span>
                            <span class="bb-value" id="ppsResPhones">58 Estimated Full Recharges</span>
                            <span class="bb-sub">Direct USB-C</span>
                        </div>
                    </div>

                    <div class="results-breakdown-grid" style="margin-top: 14px;">
                        <div class="breakdown-box">
                            <span class="bb-label">Laptop (65Wh)</span>
                            <span class="bb-value" id="ppsResLaptops">13 Estimated Full Recharges</span>
                            <span class="bb-sub">PD charging</span>
                        </div>
                        <div class="breakdown-box">
                            <span class="bb-label">Drone Battery (40Wh)</span>
                            <span class="bb-value" id="ppsResDrones">21 Estimated Full Recharges</span>
                            <span class="bb-sub">Flight pack</span>
                        </div>
                    </div>

                    <div class="results-breakdown-grid" style="margin-top: 14px;">
                        <div class="breakdown-box">
                            <span class="bb-label">Custom Device</span>
                            <span class="bb-value" id="ppsResCustom">15 Estimated Full Recharges</span>
                            <span class="bb-sub" id="ppsResCustomSub">50Wh battery</span>
                        </div>
                    </div>

                    <div class="breakdown-box" style="margin-top: 14px; margin-bottom: 20px;">
                        <span class="bb-label">CPAP Machine Sleep Duration</span>
                        <span class="bb-value" style="font-size: 1.3rem; color: var(--emerald-400);" id="ppsResCpap">
                            17.4 Hours (2.2 Nights)
                        </span>
                        <span class="bb-sub">Based on 40W typical CPAP without heated humidity</span>
                    </div>

                    <button type="button" class="btn btn-share" id="ppsCopyBtn">
                        Copy Power Station Summary
                    </button>
                </div>
            </div>
        </div>

        <section class="calc-content-section">
            <div class="calc-content-card">
                <h2 class="content-heading-2">The Power Station Runtime Calculation Formula</h2>
                <div class="formula-box">
                    <strong>Formula:</strong><br>
                    Usable Watt-hours = Total Battery Wh &times; (Efficiency % &divide; 100)<br>
                    Total Load Watts = Device Watts + Inverter Idle Parasitic Watts<br>
                    Runtime (Hours) = Usable Watt-hours &divide; Total Load Watts<br>
                    Device Recharges = Usable Watt-hours &divide; Device Battery Wh
                </div>
                <p class="content-p">
                    Always use the 12V DC cigarette adapter or USB-C power delivery ports whenever possible when charging electronics. Bypassing the AC pure sine wave inverter eliminates DC-to-AC conversion losses and saves roughly 10W of continuous inverter idle consumption, boosting your battery life significantly.
                </p>
            </div>
        </section>
    </div>
</main>


<?php get_footer(); ?>
