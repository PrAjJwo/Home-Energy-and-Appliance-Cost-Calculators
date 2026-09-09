<?php
require_once __DIR__ . '/../config/site_config.php';
require_once __DIR__ . '/../config/rates.php';
require_once __DIR__ . '/../includes/seo_helper.php';

$page_title = "Solar Battery Runtime Calculator - Home Energy Storage Hours";
$meta_description = "Calculate how long your home solar battery storage will power essential loads during a blackout. Sizing models for Tesla Powerwall, Enphase, and LiFePO4.";
$focus_keyword = "solar battery runtime calculator";
$canonical_path = "calculators/solar-battery-runtime.php";

$custom_schema = [
    '@type' => 'WebApplication',
    'name' => $page_title,
    'description' => $meta_description,
    'featureList' => [
        'Kilowatt-Hour Usable Storage Capacity Sizing',
        'Depth of Discharge and Inverter Inefficiency Loss Modeling',
        'Continuous Essential Load vs Solar Daytime Recharge Analysis'
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

<div class="container" style="padding-top: 20px;">
    <nav class="breadcrumb-nav" aria-label="Breadcrumb" style="font-size: 0.8125rem; color: var(--slate-500); display: flex; gap: 8px; align-items: center;">
        <a href="/" style="color: var(--slate-600);">Home</a>
        <span>/</span>
        <a href="/categories/backup-power.php" style="color: var(--slate-600);">Backup Power & Off-Grid</a>
        <span>/</span>
        <span style="color: var(--emerald-700); font-weight: 700;">Solar Battery Runtime Calculator</span>
    </nav>
</div>

<main class="section-padding" style="padding-top: 24px;">
    <div class="container">
        <div style="margin-bottom: 30px;">
            <span class="section-tag">Category 3: Backup Power &bull; Active Tool</span>
            <h1 style="font-size: 2.5rem; letter-spacing: -0.02em; margin-bottom: 12px; color: var(--slate-900);">
                Solar Battery Runtime Calculator
            </h1>
            <p style="font-size: 1.125rem; color: var(--slate-600); max-width: 760px; line-height: 1.6;">
                Residential battery storage banks store surplus rooftop solar energy for evening consumption and grid outages. Calculate how many hours or days your battery will power critical circuits based on battery capacity, depth of discharge, and connected electrical loads.
            </p>
        </div>

        <div class="calculator-wrapper">
            <!-- Battery System Presets -->
            <div class="calc-presets-section">
                <div class="presets-header">
                    <span class="presets-title">Popular Home Solar Battery Presets:</span>
                    <span class="presets-hint">Pre-configures usable capacity and inverter specs</span>
                </div>
                <div class="presets-scroll">
                    <button type="button" class="preset-chip" data-sb-kwh="5.0" data-sb-inv="3.84" data-sb-eff="92" data-sb-mode="usable">
                        5 kWh Compact (Enphase 5P)
                    </button>
                    <button type="button" class="preset-chip" data-sb-kwh="9.7" data-sb-inv="5.0" data-sb-eff="92" data-sb-mode="usable">
                        9.7 kWh Modular (SolarEdge)
                    </button>
                    <button type="button" class="preset-chip is-selected" data-sb-kwh="13.5" data-sb-inv="5.0" data-sb-eff="92" data-sb-mode="usable">
                        13.5 kWh (Tesla Powerwall 2/3)
                    </button>
                    <button type="button" class="preset-chip" data-sb-kwh="13.6" data-sb-inv="5.0" data-sb-eff="92" data-sb-mode="usable">
                        13.6 kWh (FranklinWH aPower)
                    </button>
                    <button type="button" class="preset-chip" data-sb-kwh="27.0" data-sb-inv="10.0" data-sb-eff="92" data-sb-mode="usable">
                        27 kWh Dual Powerwall (Whole-Home)
                    </button>
                </div>
            </div>

            <div class="calc-grid">
                <!-- Inputs -->
                <div class="calc-inputs-col">
                    <h2 style="font-size: 1.25rem; color: var(--slate-800); margin-bottom: 12px;">Battery & Load Parameters:</h2>

                    <!-- Capacity Sizing Mode Selector -->
                    <div class="calc-group">
                        <label class="calc-label" style="margin-bottom: 8px;">Capacity Specification Mode:</label>
                        <div style="display: flex; gap: 10px; margin-bottom: 12px;">
                            <label style="display: flex; align-items: center; gap: 6px; font-size: 0.875rem; color: var(--slate-700); cursor: pointer;">
                                <input type="radio" name="sbCapacityMode" value="usable" id="sbModeUsable" checked>
                                <strong>Mode A:</strong> Usable Capacity (Direct kWh)
                            </label>
                            <label style="display: flex; align-items: center; gap: 6px; font-size: 0.875rem; color: var(--slate-700); cursor: pointer;">
                                <input type="radio" name="sbCapacityMode" value="nameplate" id="sbModeNameplate">
                                <strong>Mode B:</strong> Nameplate kWh * DoD %
                            </label>
                        </div>
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="sbKwhInput" class="calc-label" id="sbKwhLabel">Manufacturer Usable Capacity (kWh):</label>
                            <span class="calc-value-badge highlight" id="sbKwhBadge">13.5 kWh</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="sbKwhInput" class="calc-number-input" value="13.5" min="1" max="120" step="0.1">
                            <span class="input-suffix">kWh</span>
                        </div>
                        <input type="range" id="sbKwhRange" class="calc-range" min="2" max="40" step="0.5" value="13.5">
                    </div>

                    <!-- DoD Group (shown in Mode B) -->
                    <div class="calc-group" id="sbDodGroup" style="display: none;">
                        <div class="calc-label-row">
                            <label for="sbDodInput" class="calc-label">Depth of Discharge (DoD %):</label>
                            <span class="calc-value-badge" id="sbDodBadge">90% DoD</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="sbDodInput" class="calc-number-input" value="90" min="50" max="100" step="1">
                            <span class="input-suffix">%</span>
                        </div>
                        <input type="range" id="sbDodRange" class="calc-range" min="50" max="100" step="1" value="90">
                        <span class="calc-help">LFP chemistries allow 90% to 100% DoD. Older NMC or Lead-Acid models require 50% to 80% to prevent degradation.</span>
                    </div>

                    <!-- Starting SOC & Reserve SOC Row -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div class="calc-group">
                            <div class="calc-label-row">
                                <label for="sbStartSocInput" class="calc-label">Starting SOC (%):</label>
                                <span class="calc-value-badge" id="sbStartSocBadge">100%</span>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="sbStartSocInput" class="calc-number-input" value="100" min="20" max="100" step="5">
                                <span class="input-suffix">%</span>
                            </div>
                            <span class="calc-help">Battery charge when outage starts.</span>
                        </div>

                        <div class="calc-group">
                            <div class="calc-label-row">
                                <label for="sbReserveSocInput" class="calc-label">Reserve Limit (%):</label>
                                <span class="calc-value-badge" id="sbReserveSocBadge">20%</span>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="sbReserveSocInput" class="calc-number-input" value="20" min="0" max="50" step="5">
                                <span class="input-suffix">%</span>
                            </div>
                            <span class="calc-help">Emergency floor to protect pack.</span>
                        </div>
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="sbLoadInput" class="calc-label">Continuous Essential Load (Watts):</label>
                            <span class="calc-value-badge" id="sbLoadBadge">650 Watts</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="sbLoadInput" class="calc-number-input" value="650" min="50" max="15000" step="25">
                            <span class="input-suffix">Watts</span>
                        </div>
                        <input type="range" id="sbLoadRange" class="calc-range" min="100" max="4000" step="50" value="650">
                        <span class="calc-help">Typical essentials: Refrigerator (150W avg), Wi-Fi & LED lighting (100W), gas furnace blower (300W to 500W).</span>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div class="calc-group">
                            <div class="calc-label-row">
                                <label for="sbInverterRatingInput" class="calc-label">Inverter Continuous kW:</label>
                                <span class="calc-value-badge" id="sbInverterBadge">5.0 kW</span>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="sbInverterRatingInput" class="calc-number-input" value="5.0" min="1.0" max="25.0" step="0.5">
                                <span class="input-suffix">kW</span>
                            </div>
                        </div>

                        <div class="calc-group">
                            <div class="calc-label-row">
                                <label for="sbEffInput" class="calc-label">Discharge / AC Output Efficiency (%):</label>
                                <span class="calc-value-badge" id="sbEffBadge">92%</span>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="sbEffInput" class="calc-number-input" value="92" min="70" max="98" step="1">
                                <span class="input-suffix">%</span>
                            </div>
                            <span class="calc-help">One-way battery-to-AC output efficiency (typically 90% to 95%).</span>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div class="calc-group">
                            <div class="calc-label-row">
                                <label for="sbSolarInput" class="calc-label">Raw Solar Production (kWh/day):</label>
                                <span class="calc-value-badge" id="sbSolarBadge">15 kWh/day</span>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="sbSolarInput" class="calc-number-input" value="15" min="0" max="100" step="1">
                                <span class="input-suffix">kWh/day</span>
                            </div>
                            <input type="range" id="sbSolarRange" class="calc-range" min="0" max="50" step="1" value="15">
                            <span class="calc-help">Set to 0 kWh/day for nighttime or storm blackout.</span>
                        </div>

                        <div class="calc-group">
                            <div class="calc-label-row">
                                <label for="sbSolarEffInput" class="calc-label">Solar Charging Efficiency (%):</label>
                                <span class="calc-value-badge" id="sbSolarEffBadge">90%</span>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="sbSolarEffInput" class="calc-number-input" value="90" min="70" max="98" step="1">
                                <span class="input-suffix">%</span>
                            </div>
                            <span class="calc-help">Charge controller and chemical storage efficiency.</span>
                        </div>
                    </div>

                    <!-- Inverter Rating Warning Banner -->
                    <div id="sbInverterWarning" style="display: none; background: #fef2f2; border: 1px solid #f87171; border-radius: 8px; padding: 12px 14px; margin-top: 10px;">
                        <strong style="color: #b91c1c; font-size: 0.875rem;">Inverter Capacity Warning:</strong>
                        <p style="color: #991b1b; font-size: 0.8125rem; margin: 4px 0 0 0; line-height: 1.4;" id="sbInverterWarningText">
                            Continuous load exceeds single-unit inverter rating. Multiple battery units or an upgraded inverter are required.
                        </p>
                    </div>
                </div>

                <!-- Results Column -->
                <div class="calc-results-col">
                    <div class="results-header">
                        <h3 class="results-title">Backup Duration</h3>
                        <span class="results-badge">Off-Grid</span>
                    </div>

                    <div class="cost-card-primary">
                        <div class="cost-period-label">Battery Runtime (Zero Solar Harvest)</div>
                        <div class="cost-big-number">
                            <span id="sbResHours" style="color: var(--emerald-400);">14.9 Hours</span>
                        </div>
                        <div class="cost-sub-kwh">
                            Delivering <strong id="sbResUsableKwh">9.7 kWh</strong> of net AC electricity
                        </div>
                    </div>

                    <div class="results-breakdown-grid">
                        <div class="breakdown-box">
                            <span class="bb-label">Daily Load Demand</span>
                            <span class="bb-value" id="sbResDailyKwh">15.6 kWh</span>
                            <span class="bb-sub" id="sbResLoadSub">At continuous 650W</span>
                        </div>
                        <div class="breakdown-box">
                            <span class="bb-label">Available Battery Pool</span>
                            <span class="bb-value" id="sbResAvailableCapacity">10.8 kWh</span>
                            <span class="bb-sub" id="sbResSocSub">100% down to 20% reserve</span>
                        </div>
                    </div>

                    <div class="breakdown-box" style="margin-bottom: 20px;">
                        <span class="bb-label">Solar Replenishment Dynamics</span>
                        <span class="bb-value" style="font-size: 1.25rem; color: var(--emerald-400);" id="sbResNetStatus">
                            Energy-balanced (Indefinite while solar exceeds consumption)
                        </span>
                        <span class="bb-sub" id="sbResNetDesc">Daily solar harvest meets or exceeds household load demand</span>
                    </div>

                    <button type="button" class="btn btn-share" id="sbCopyBtn">
                        Copy Solar Battery Summary
                    </button>
                </div>
            </div>
        </div>

        <section class="calc-content-section">
            <div class="calc-content-card">
                <h2 class="content-heading-2">How to Size a Solar Battery for Blackout Protection</h2>
                <p class="content-p">
                    To keep critical circuits powered without a noisy generator, focus on your 24-hour kilowatt-hour load rather than peak wattage. Lithium batteries deliver exceptional performance, but calculating runtime from an already-charged pack requires using one-way <strong>Discharge / AC Output Efficiency</strong> (typically 90% to 95%) rather than total Round-Trip Efficiency. Adding rooftop solar with calibrated <strong>Solar Charging Efficiency</strong> (typically 90%) allows the storage pack to replenish during daylight hours, extending off-grid resilience.
                </p>
            </div>
        </section>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

<script>
const SolarBatteryCalc = {
    state: {
        mode: 'usable',
        kwh: 13.5,
        dod: 90,
        startSoc: 100,
        reserveSoc: 20,
        loadWatts: 650,
        inverterRatingKw: 5.0,
        efficiency: 92,
        solarInflow: 15,
        solarEff: 90
    },
    init() {
        const dK = document.getElementById('sbKwhInput');
        const rK = document.getElementById('sbKwhRange');
        const bK = document.getElementById('sbKwhBadge');
        const lK = document.getElementById('sbKwhLabel');

        const dDoD = document.getElementById('sbDodInput');
        const rDoD = document.getElementById('sbDodRange');
        const bDoD = document.getElementById('sbDodBadge');
        const dodGroup = document.getElementById('sbDodGroup');

        const dStartSoc = document.getElementById('sbStartSocInput');
        const bStartSoc = document.getElementById('sbStartSocBadge');

        const dReserveSoc = document.getElementById('sbReserveSocInput');
        const bReserveSoc = document.getElementById('sbReserveSocBadge');

        const dL = document.getElementById('sbLoadInput');
        const rL = document.getElementById('sbLoadRange');
        const bL = document.getElementById('sbLoadBadge');

        const dInv = document.getElementById('sbInverterRatingInput');
        const bInv = document.getElementById('sbInverterBadge');

        const dEff = document.getElementById('sbEffInput');
        const bEff = document.getElementById('sbEffBadge');

        const dS = document.getElementById('sbSolarInput');
        const rS = document.getElementById('sbSolarRange');
        const bS = document.getElementById('sbSolarBadge');

        const dSEff = document.getElementById('sbSolarEffInput');
        const bSEff = document.getElementById('sbSolarEffBadge');

        const setMode = (newMode) => {
            this.state.mode = newMode;
            if (newMode === 'usable') {
                dodGroup.style.display = 'none';
                lK.textContent = 'Manufacturer Usable Capacity (kWh):';
            } else {
                dodGroup.style.display = 'block';
                lK.textContent = 'Nameplate Gross Capacity (kWh):';
            }
            this.calc();
        };

        document.getElementById('sbModeUsable').addEventListener('change', () => setMode('usable'));
        document.getElementById('sbModeNameplate').addEventListener('change', () => setMode('nameplate'));

        const syncK = (val) => {
            const parsed = parseFloat(val);
            this.state.kwh = Math.max(0, isNaN(parsed) ? 13.5 : parsed);
            dK.value = this.state.kwh;
            if (rK) rK.value = Math.min(this.state.kwh, 40);
            bK.textContent = this.state.kwh.toFixed(1) + ' kWh';
            this.calc();
        };

        const syncDoD = (val) => {
            const parsed = parseFloat(val);
            this.state.dod = Math.min(100, Math.max(0, isNaN(parsed) ? 90 : parsed));
            dDoD.value = this.state.dod;
            if (rDoD) rDoD.value = this.state.dod;
            bDoD.textContent = this.state.dod + '% DoD';
            this.calc();
        };

        const syncStartSoc = (val) => {
            const parsed = parseFloat(val);
            this.state.startSoc = Math.min(100, Math.max(0, isNaN(parsed) ? 100 : parsed));
            dStartSoc.value = this.state.startSoc;
            if (bStartSoc) bStartSoc.textContent = this.state.startSoc + '%';
            this.calc();
        };

        const syncReserveSoc = (val) => {
            const parsed = parseFloat(val);
            this.state.reserveSoc = Math.min(100, Math.max(0, isNaN(parsed) ? 20 : parsed));
            dReserveSoc.value = this.state.reserveSoc;
            if (bReserveSoc) bReserveSoc.textContent = this.state.reserveSoc + '%';
            this.calc();
        };

        const syncL = (val) => {
            const parsed = parseFloat(val);
            this.state.loadWatts = Math.max(0, isNaN(parsed) ? 650 : parsed);
            dL.value = this.state.loadWatts;
            if (rL) rL.value = Math.min(this.state.loadWatts, 4000);
            bL.textContent = this.state.loadWatts + ' Watts';
            this.calc();
        };

        const syncInv = (val) => {
            const parsed = parseFloat(val);
            this.state.inverterRatingKw = Math.max(0.1, isNaN(parsed) ? 5.0 : parsed);
            dInv.value = this.state.inverterRatingKw;
            if (bInv) bInv.textContent = this.state.inverterRatingKw.toFixed(1) + ' kW';
            this.calc();
        };

        const syncEff = (val) => {
            const parsed = parseFloat(val);
            this.state.efficiency = Math.min(100, Math.max(1, isNaN(parsed) ? 92 : parsed));
            dEff.value = this.state.efficiency;
            if (bEff) bEff.textContent = this.state.efficiency + '%';
            this.calc();
        };

        const syncS = (val) => {
            const parsed = parseFloat(val);
            this.state.solarInflow = Math.max(0, isNaN(parsed) ? 0 : parsed);
            dS.value = this.state.solarInflow;
            if (rS) rS.value = Math.min(this.state.solarInflow, 50);
            bS.textContent = this.state.solarInflow + ' kWh/day';
            this.calc();
        };

        const syncSEff = (val) => {
            const parsed = parseFloat(val);
            this.state.solarEff = Math.min(100, Math.max(1, isNaN(parsed) ? 90 : parsed));
            if (dSEff) dSEff.value = this.state.solarEff;
            if (bSEff) bSEff.textContent = this.state.solarEff + '%';
            this.calc();
        };

        dK.addEventListener('input', (e) => syncK(e.target.value));
        if (rK) rK.addEventListener('input', (e) => syncK(e.target.value));

        dDoD.addEventListener('input', (e) => syncDoD(e.target.value));
        if (rDoD) rDoD.addEventListener('input', (e) => syncDoD(e.target.value));

        dStartSoc.addEventListener('input', (e) => syncStartSoc(e.target.value));
        dReserveSoc.addEventListener('input', (e) => syncReserveSoc(e.target.value));

        dL.addEventListener('input', (e) => syncL(e.target.value));
        if (rL) rL.addEventListener('input', (e) => syncL(e.target.value));

        dInv.addEventListener('input', (e) => syncInv(e.target.value));
        dEff.addEventListener('input', (e) => syncEff(e.target.value));

        dS.addEventListener('input', (e) => syncS(e.target.value));
        if (rS) rS.addEventListener('input', (e) => syncS(e.target.value));

        if (dSEff) dSEff.addEventListener('input', (e) => syncSEff(e.target.value));

        document.querySelectorAll('[data-sb-kwh]').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('[data-sb-kwh]').forEach(b => b.classList.remove('is-selected'));
                btn.classList.add('is-selected');
                const kwh = parseFloat(btn.getAttribute('data-sb-kwh')) || 13.5;
                const inv = parseFloat(btn.getAttribute('data-sb-inv')) || 5.0;
                const eff = parseFloat(btn.getAttribute('data-sb-eff')) || 92;
                syncK(kwh);
                syncInv(inv);
                syncEff(eff);
                document.getElementById('sbModeUsable').checked = true;
                setMode('usable');
            });
        });

        document.getElementById('sbCopyBtn').addEventListener('click', () => {
            const txt = `VoltMetrics Solar Battery Runtime: ${this.state.kwh} kWh battery powering ${this.state.loadWatts}W essential load provides ${document.getElementById('sbResHours').textContent} standalone runtime (${document.getElementById('sbResUsableKwh').textContent} delivered AC energy). Solar sustainability: ${document.getElementById('sbResNetStatus').textContent}.`;
            navigator.clipboard.writeText(txt);
            document.getElementById('sbCopyBtn').textContent = 'Copied!';
            setTimeout(() => { document.getElementById('sbCopyBtn').textContent = 'Copy Solar Battery Summary'; }, 2000);
        });

        this.calc();
    },

    calc() {
        // Base usable capacity before SOC window
        let baseUsableKwh = this.state.kwh;
        if (this.state.mode === 'nameplate') {
            baseUsableKwh = this.state.kwh * (this.state.dod / 100);
        }

        // Available SOC percentage fraction: max(0, startSoc - reserveSoc) / 100
        const socFraction = Math.max(0, (this.state.startSoc - this.state.reserveSoc) / 100);
        const availableStoredKwh = baseUsableKwh * socFraction;

        // Delivered AC electricity factoring one-way discharge efficiency (NOT round-trip)
        const deliveredKwh = availableStoredKwh * (this.state.efficiency / 100);

        const loadKw = this.state.loadWatts / 1000;
        const runtimeHours = loadKw > 0 ? (deliveredKwh / loadKw) : 0;
        const dailyConsumptionKwh = loadKw * 24;

        // Usable solar contribution factoring solar charging efficiency
        const usableSolarKwh = this.state.solarInflow * (this.state.solarEff / 100);
        const netDailyDeficit = dailyConsumptionKwh - usableSolarKwh;

        // Inverter continuous power check
        const warningDiv = document.getElementById('sbInverterWarning');
        const warningText = document.getElementById('sbInverterWarningText');
        if (loadKw > this.state.inverterRatingKw) {
            warningDiv.style.display = 'block';
            warningText.textContent = `Continuous load (${loadKw.toFixed(2)} kW) exceeds the inverter continuous rating (${this.state.inverterRatingKw.toFixed(1)} kW). Multiple battery units or an upgraded power inverter are required.`;
        } else {
            warningDiv.style.display = 'none';
        }

        document.getElementById('sbResUsableKwh').textContent = deliveredKwh.toFixed(2) + ' kWh';
        document.getElementById('sbResHours').textContent = runtimeHours.toFixed(2) + ' Hours';
        document.getElementById('sbResDailyKwh').textContent = dailyConsumptionKwh.toFixed(1) + ' kWh';
        document.getElementById('sbResLoadSub').textContent = `At continuous ${this.state.loadWatts}W`;
        document.getElementById('sbResAvailableCapacity').textContent = availableStoredKwh.toFixed(2) + ' kWh';
        document.getElementById('sbResSocSub').textContent = `${this.state.startSoc}% down to ${this.state.reserveSoc}% reserve`;

        // Solar replenishment balance
        const statusEl = document.getElementById('sbResNetStatus');
        const descEl = document.getElementById('sbResNetDesc');

        if (this.state.solarInflow > 0 && netDailyDeficit <= 0) {
            statusEl.textContent = 'Energy-balanced under entered assumptions';
            descEl.textContent = `Daily usable solar harvest (${usableSolarKwh.toFixed(1)} kWh) meets or exceeds continuous daily load demand (${dailyConsumptionKwh.toFixed(1)} kWh/day). Actual performance still depends on weather, solar timing, battery charging limits, nighttime load, inverter limitations, and reserve limits.`;
        } else if (this.state.solarInflow > 0 && netDailyDeficit > 0) {
            const netDays = netDailyDeficit > 0 ? (deliveredKwh / netDailyDeficit) : 0;
            statusEl.textContent = netDays.toFixed(3) + ' Days with Solar Recharge';
            descEl.textContent = `Daily net solar deficit of ${netDailyDeficit.toFixed(1)} kWh/day covered by delivered battery pool (${deliveredKwh.toFixed(2)} kWh).`;
        } else {
            statusEl.textContent = (runtimeHours / 24).toFixed(2) + ' Days (' + runtimeHours.toFixed(1) + ' Hours Zero Solar)';
            descEl.textContent = 'Relying exclusively on initial battery reserves with zero solar recharge.';
        }
    }
};

document.addEventListener('DOMContentLoaded', () => SolarBatteryCalc.init());
</script>

</body>
</html>
