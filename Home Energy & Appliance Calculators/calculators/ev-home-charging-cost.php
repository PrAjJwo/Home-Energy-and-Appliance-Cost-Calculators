<?php
require_once __DIR__ . '/../config/site_config.php';
require_once __DIR__ . '/../config/rates.php';
require_once __DIR__ . '/../includes/seo_helper.php';

$page_title = "EV Home-Charging Cost Calculator - Electric Car Charging Bill";
$meta_description = "Calculate electric vehicle home charging costs per full charge, per mile, and per month. Compare Level 1 vs Level 2 charging and annual gasoline fuel savings.";
$focus_keyword = "ev home charging cost calculator";
$canonical_path = "calculators/ev-home-charging-cost.php";

$custom_schema = [
    '@type' => 'WebApplication',
    'name' => $page_title,
    'description' => $meta_description,
    'featureList' => [
        'Level 1 (120V) and Level 2 (240V) Home Charger Sizing',
        'Cost Per Full Charge and Cost Per Mile Driven Projections',
        'Electric Vehicle vs Gasoline Fuel Savings Analysis'
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
        <a href="/categories/ev-utility.php" style="color: var(--slate-600);">EV & High-Load Utility</a>
        <span>/</span>
        <span style="color: var(--emerald-700); font-weight: 700;">EV Home-Charging Cost Calculator</span>
    </nav>
</div>

<main class="section-padding" style="padding-top: 24px;">
    <div class="container">
        <div style="margin-bottom: 30px; display: grid; grid-template-columns: 1.25fr 0.75fr; gap: 32px; align-items: center;">
            <div>
                <span class="section-tag">Category 4: EV & Utility &bull; Popular Pick &bull; Active Tool</span>
                <h1 style="font-size: 2.5rem; letter-spacing: -0.02em; margin-bottom: 12px; color: var(--slate-900);">
                    EV Home-Charging Cost Calculator
                </h1>
                <p style="font-size: 1.125rem; color: var(--slate-600); line-height: 1.6;">
                    Charging an electric vehicle at home is vastly cheaper than filling up a gas tank or using commercial public fast chargers. Calculate your cost per full battery recharge, cost per mile driven, monthly electricity bill impact, and annual fuel savings.
                </p>
            </div>
            <div style="border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--border-subtle); box-shadow: var(--shadow-md);">
                <img src="/assets/images/ev_charging_utility.jpg" 
                     alt="Electric vehicle connected to home wallbox charger diagram"
                     width="1280" height="720" loading="eager">
            </div>
        </div>

        <div class="calculator-wrapper">
            <!-- Popular EV Models Presets -->
            <div class="calc-presets-section">
                <div class="presets-header">
                    <span class="presets-title">Popular EV Model Presets:</span>
                    <span class="presets-hint">Pre-loads usable battery kWh and efficiency</span>
                </div>
                <div class="presets-scroll">
                    <button type="button" class="preset-chip" data-ev-kwh="60" data-ev-eff="3.8" data-ev-name="Tesla Model 3 Standard (60 kWh &bull; 3.8 mi/kWh)">
                        Tesla Model 3 (60 kWh)
                    </button>
                    <button type="button" class="preset-chip is-selected" data-ev-kwh="75" data-ev-eff="3.5" data-ev-name="Tesla Model Y Long Range (75 kWh &bull; 3.5 mi/kWh)">
                        Tesla Model Y (75 kWh)
                    </button>
                    <button type="button" class="preset-chip" data-ev-kwh="77" data-ev-eff="3.3" data-ev-name="Hyundai Ioniq 5 / Kia EV6 (77 kWh &bull; 3.3 mi/kWh)">
                        Hyundai Ioniq 5 (77 kWh)
                    </button>
                    <button type="button" class="preset-chip" data-ev-kwh="131" data-ev-eff="2.1" data-ev-name="Ford F-150 Lightning / Rivian (131 kWh Extended Pack)">
                        Ford F-150 Lightning (131 kWh)
                    </button>
                    <button type="button" class="preset-chip" data-ev-kwh="18" data-ev-eff="3.1" data-ev-name="Plug-in Hybrid PHEV (18 kWh Battery)">
                        Plug-in Hybrid PHEV (18 kWh)
                    </button>
                </div>
            </div>

            <div class="calc-grid">
                <!-- Inputs -->
                <div class="calc-inputs-col">
                    <h2 style="font-size: 1.25rem; color: var(--slate-800); margin-bottom: 12px;">EV & Driving Specifications:</h2>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="evKwhInput" class="calc-label">Battery Pack Capacity (kWh):</label>
                            <span class="calc-value-badge highlight" id="evKwhBadge">75 kWh</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="evKwhInput" class="calc-number-input" value="75" min="10" max="220" step="1">
                            <span class="input-suffix">kWh</span>
                        </div>
                        <input type="range" id="evKwhRange" class="calc-range" min="15" max="140" step="1" value="75">
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="evMilesInput" class="calc-label">Monthly Distance Driven (Miles):</label>
                            <span class="calc-value-badge" id="evMilesBadge">1,000 Miles/mo</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="evMilesInput" class="calc-number-input" value="1000" min="100" max="5000" step="50">
                            <span class="input-suffix">Miles</span>
                        </div>
                        <input type="range" id="evMilesRange" class="calc-range" min="200" max="3000" step="50" value="1000">
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="evEffInput" class="calc-label">EV Driving Efficiency (Miles per kWh):</label>
                            <span class="calc-value-badge" id="evEffBadge">3.5 mi/kWh</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="evEffInput" class="calc-number-input" value="3.5" min="1.5" max="5.0" step="0.1">
                            <span class="input-suffix">Miles/kWh</span>
                        </div>
                        <input type="range" id="evEffRange" class="calc-range" min="1.8" max="4.5" step="0.1" value="3.5">
                        <span class="calc-help">Electric sedans average 3.5 to 4.2 mi/kWh; large electric SUVs and trucks average 2.0 to 2.5 mi/kWh.</span>
                    </div>

                    <!-- Charger Level & Conversion Efficiency -->
                    <div class="calc-group">
                        <label class="calc-label" style="margin-bottom: 6px;">Home Charging Level & Efficiency:</label>
                        <div style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 8px;">
                            <button type="button" class="preset-chip" id="evLvl1Btn" data-ev-chargereff="81.5">
                                Level 1 120V (81.5% Eff)
                            </button>
                            <button type="button" class="preset-chip is-selected" id="evLvl2Btn" data-ev-chargereff="89.5">
                                Level 2 240V (89.5% Eff)
                            </button>
                            <button type="button" class="preset-chip" id="evDcfcBtn" data-ev-chargereff="93.5">
                                DC Fast (93.5% Eff)
                            </button>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="evChargerEffInput" class="calc-number-input" value="89.5" min="70" max="98" step="0.5">
                            <span class="input-suffix">% Efficiency</span>
                        </div>
                        <span class="calc-help">Grid kWh required = Battery kWh &divide; Charging Efficiency (accounts for AC-DC onboard conversion losses).</span>
                    </div>

                    <!-- Electricity Tariff Mode -->
                    <div class="calc-group">
                        <label class="calc-label" style="margin-bottom: 8px;">Electricity Tariff Structure:</label>
                        <div style="display: flex; gap: 16px; margin-bottom: 12px;">
                            <label style="display: flex; align-items: center; gap: 6px; font-size: 0.875rem; color: var(--slate-700); cursor: pointer;">
                                <input type="radio" name="evTariffMode" value="flat" id="evTariffFlat" checked>
                                Flat Rate
                            </label>
                            <label style="display: flex; align-items: center; gap: 6px; font-size: 0.875rem; color: var(--slate-700); cursor: pointer;">
                                <input type="radio" name="evTariffMode" value="tou" id="evTariffTou">
                                Time-of-Use (Peak / Off-Peak)
                            </label>
                        </div>

                        <div id="evFlatRateGroup">
                            <div class="calc-label-row">
                                <label for="evRateInput" class="calc-label">Electricity Rate (<span data-currency-symbol>$</span>/kWh):</label>
                                <span class="calc-value-badge">Benchmark Active</span>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="evRateInput" class="calc-number-input" value="0.1830" min="0.01" max="2.00" step="0.0001">
                                <span class="input-suffix">per kWh</span>
                            </div>
                        </div>

                        <div id="evTouRateGroup" style="display: none;">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 8px;">
                                <div>
                                    <label for="evOffPeakRateInput" class="calc-label" style="font-size: 0.8125rem;">Off-Peak Rate:</label>
                                    <div class="calc-input-wrapper">
                                        <input type="number" id="evOffPeakRateInput" class="calc-number-input" value="0.1100" min="0.01" max="2.00" step="0.001">
                                        <span class="input-suffix">/kWh</span>
                                    </div>
                                </div>
                                <div>
                                    <label for="evPeakRateInput" class="calc-label" style="font-size: 0.8125rem;">Peak Rate:</label>
                                    <div class="calc-input-wrapper">
                                        <input type="number" id="evPeakRateInput" class="calc-number-input" value="0.2800" min="0.01" max="2.00" step="0.001">
                                        <span class="input-suffix">/kWh</span>
                                    </div>
                                </div>
                            </div>
                            <div class="calc-label-row">
                                <label for="evOffPeakPctInput" class="calc-label" style="font-size: 0.8125rem;">Off-Peak Charging Share (%):</label>
                                <span class="calc-value-badge" id="evOffPeakPctBadge">85% Off-Peak</span>
                            </div>
                            <input type="range" id="evOffPeakPctRange" class="calc-range" min="0" max="100" step="5" value="85">
                            <span class="calc-help">Smart EV chargers schedule charging overnight during lowest utility rates.</span>
                        </div>
                    </div>

                    <!-- Gas Benchmark Settings -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div class="calc-group">
                            <div class="calc-label-row">
                                <label for="evGasPriceInput" class="calc-label">Gas Price ($/gal):</label>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="evGasPriceInput" class="calc-number-input" value="4.071" min="1.50" max="8.00" step="0.01">
                                <span class="input-suffix">/gal</span>
                            </div>
                        </div>

                        <div class="calc-group">
                            <div class="calc-label-row">
                                <label for="evGasMpgInput" class="calc-label">Gas Car Economy:</label>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="evGasMpgInput" class="calc-number-input" value="28" min="12" max="60" step="1">
                                <span class="input-suffix">MPG</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Results Column -->
                <div class="calc-results-col">
                    <div class="results-header">
                        <h3 class="results-title">Home Charging Costs</h3>
                        <span class="results-badge">Live</span>
                    </div>

                    <div class="cost-card-primary">
                        <div class="cost-period-label">Estimated Monthly Charging Bill</div>
                        <div class="cost-big-number">
                            <span id="evResMonthlyCost" style="color: var(--emerald-400);">$58.37</span>
                        </div>
                        <div class="cost-sub-kwh">
                            Drawing <strong id="evResMonthlyKwh">319 kWh</strong> from grid for 1,000 miles
                        </div>
                    </div>

                    <div class="results-breakdown-grid">
                        <div class="breakdown-box">
                            <span class="bb-label">Cost per Full Charge</span>
                            <span class="bb-value" id="evResFullCharge">$15.34</span>
                            <span class="bb-sub" id="evResRangeLabel">~262 miles range</span>
                        </div>
                        <div class="breakdown-box">
                            <span class="bb-label">Cost per Mile</span>
                            <span class="bb-value" id="evResPerMile" style="color: var(--emerald-400);">$0.058</span>
                            <span class="bb-sub" id="evResGasMileCompare">Vs $0.145/mi gasoline</span>
                        </div>
                    </div>

                    <div class="comparison-section">
                        <div class="comparison-header">
                            <span class="star-icon">&#9733;</span>
                            <span class="comparison-title" id="evResSavingsTitle">Annual Fuel Savings vs Gasoline</span>
                        </div>
                        <p style="font-size: 0.8125rem; color: var(--slate-300); margin-bottom: 6px;" id="evResGasParamsLabel">
                            Compared to a 28 MPG gas car at $4.07/gallon ($145.39/mo):
                        </p>
                        <div style="font-size: 1.25rem; font-weight: 800; color: var(--emerald-400);" id="evResAnnualSavings">
                            +$1,044.20 / year Saved
                        </div>
                    </div>

                    <div id="evTouTipBox" class="breakdown-box" style="margin-top: 14px; margin-bottom: 16px; display: none;">
                        <span class="bb-label">Time-of-Use Optimization</span>
                        <span class="bb-value" style="font-size: 1.15rem; color: var(--emerald-400);" id="evTouSavingsValue">
                            Save $48.20/yr
                        </span>
                        <span class="bb-sub" id="evTouSavingsSub">by scheduling 100% of charging during off-peak hours</span>
                    </div>

                    <button type="button" class="btn btn-share" id="evCopyBtn">
                        Copy EV Charging Summary
                    </button>
                </div>
            </div>
        </div>

        <section class="calc-content-section">
            <div class="calc-content-card">
                <h2 class="content-heading-2">Level 1 vs Level 2 Home EV Charging Speed & Efficiency</h2>
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Charging Level</th>
                                <th>Voltage & Amperage</th>
                                <th>Power Output</th>
                                <th>Conversion Efficiency</th>
                                <th>Full Recharge Time (75 kWh)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Level 1 (Standard 120V Outlet)</strong></td>
                                <td>120V &bull; 12A</td>
                                <td>1.4 kW</td>
                                <td>~81.5%</td>
                                <td>~55 to 65 hours</td>
                            </tr>
                            <tr>
                                <td><strong>Level 2 (NEMA 14-50 Plug)</strong></td>
                                <td>240V &bull; 32A</td>
                                <td>7.7 kW</td>
                                <td>~89.5%</td>
                                <td>~10 hours (Overnight)</td>
                            </tr>
                            <tr>
                                <td><strong>Level 2 (Hardwired Wallbox)</strong></td>
                                <td>240V &bull; 48A</td>
                                <td>11.5 kW</td>
                                <td>~90.5%</td>
                                <td>~7 hours (Rapid Home)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

<script>
const EvCalc = {
    state: {
        kwh: 75,
        miles: 1000,
        eff: 3.5,
        chargerEff: 89.5,
        tariffMode: 'flat',
        flatRate: 0.1830,
        offPeakRate: 0.1100,
        peakRate: 0.2800,
        offPeakPct: 85,
        gasPrice: 4.071,
        gasMpg: 28
    },
    init() {
        const dK = document.getElementById('evKwhInput');
        const rK = document.getElementById('evKwhRange');
        const bK = document.getElementById('evKwhBadge');

        const dM = document.getElementById('evMilesInput');
        const rM = document.getElementById('evMilesRange');
        const bM = document.getElementById('evMilesBadge');

        const dE = document.getElementById('evEffInput');
        const rE = document.getElementById('evEffRange');
        const bE = document.getElementById('evEffBadge');

        const dChargerEff = document.getElementById('evChargerEffInput');

        const dFlatRate = document.getElementById('evRateInput');
        const dOffPeakRate = document.getElementById('evOffPeakRateInput');
        const dPeakRate = document.getElementById('evPeakRateInput');
        const rOffPeakPct = document.getElementById('evOffPeakPctRange');
        const bOffPeakPct = document.getElementById('evOffPeakPctBadge');

        const flatGroup = document.getElementById('evFlatRateGroup');
        const touGroup = document.getElementById('evTouRateGroup');

        const dGasPrice = document.getElementById('evGasPriceInput');
        const dGasMpg = document.getElementById('evGasMpgInput');

        const setTariff = (mode) => {
            this.state.tariffMode = mode;
            if (mode === 'tou') {
                flatGroup.style.display = 'none';
                touGroup.style.display = 'block';
                document.getElementById('evTouTipBox').style.display = 'block';
            } else {
                flatGroup.style.display = 'block';
                touGroup.style.display = 'none';
                document.getElementById('evTouTipBox').style.display = 'none';
            }
            this.calc();
        };

        document.getElementById('evTariffFlat').addEventListener('change', () => setTariff('flat'));
        document.getElementById('evTariffTou').addEventListener('change', () => setTariff('tou'));

        const setChargerEff = (eff) => {
            this.state.chargerEff = eff;
            dChargerEff.value = eff;
            this.calc();
        };

        document.getElementById('evLvl1Btn').addEventListener('click', () => {
            document.querySelectorAll('[data-ev-chargereff]').forEach(b => b.classList.remove('is-selected'));
            document.getElementById('evLvl1Btn').classList.add('is-selected');
            setChargerEff(81.5);
        });
        document.getElementById('evLvl2Btn').addEventListener('click', () => {
            document.querySelectorAll('[data-ev-chargereff]').forEach(b => b.classList.remove('is-selected'));
            document.getElementById('evLvl2Btn').classList.add('is-selected');
            setChargerEff(89.5);
        });
        document.getElementById('evDcfcBtn').addEventListener('click', () => {
            document.querySelectorAll('[data-ev-chargereff]').forEach(b => b.classList.remove('is-selected'));
            document.getElementById('evDcfcBtn').classList.add('is-selected');
            setChargerEff(93.5);
        });

        dChargerEff.addEventListener('input', (e) => {
            this.state.chargerEff = Math.min(99, Math.max(60, parseFloat(e.target.value) || 89.5));
            this.calc();
        });

        const syncK = (val) => {
            this.state.kwh = Math.max(10, parseFloat(val) || 75);
            dK.value = this.state.kwh;
            if (rK) rK.value = Math.min(this.state.kwh, 140);
            bK.textContent = this.state.kwh + ' kWh';
            this.calc();
        };

        const syncM = (val) => {
            this.state.miles = Math.max(50, parseFloat(val) || 1000);
            dM.value = this.state.miles;
            if (rM) rM.value = Math.min(this.state.miles, 3000);
            bM.textContent = this.state.miles.toLocaleString() + ' Miles/mo';
            this.calc();
        };

        const syncE = (val) => {
            this.state.eff = Math.min(5.5, Math.max(1.2, parseFloat(val) || 3.5));
            dE.value = this.state.eff;
            if (rE) rE.value = this.state.eff;
            bE.textContent = this.state.eff.toFixed(1) + ' mi/kWh';
            this.calc();
        };

        dK.addEventListener('input', (e) => syncK(e.target.value));
        if (rK) rK.addEventListener('input', (e) => syncK(e.target.value));

        dM.addEventListener('input', (e) => syncM(e.target.value));
        if (rM) rM.addEventListener('input', (e) => syncM(e.target.value));

        dE.addEventListener('input', (e) => syncE(e.target.value));
        if (rE) rE.addEventListener('input', (e) => syncE(e.target.value));

        dFlatRate.addEventListener('input', (e) => {
            const parsed = parseFloat(e.target.value);
            this.state.flatRate = Math.max(0, isNaN(parsed) ? 0.1830 : parsed);
            this.calc();
        });

        dOffPeakRate.addEventListener('input', (e) => {
            const parsed = parseFloat(e.target.value);
            this.state.offPeakRate = Math.max(0, isNaN(parsed) ? 0.1100 : parsed);
            this.calc();
        });

        dPeakRate.addEventListener('input', (e) => {
            const parsed = parseFloat(e.target.value);
            this.state.peakRate = Math.max(0, isNaN(parsed) ? 0.2800 : parsed);
            this.calc();
        });

        rOffPeakPct.addEventListener('input', (e) => {
            this.state.offPeakPct = parseInt(e.target.value) || 85;
            bOffPeakPct.textContent = this.state.offPeakPct + '% Off-Peak';
            this.calc();
        });

        dGasPrice.addEventListener('input', (e) => {
            this.state.gasPrice = Math.max(0.5, parseFloat(e.target.value) || 4.071);
            this.calc();
        });

        dGasMpg.addEventListener('input', (e) => {
            this.state.gasMpg = Math.max(5, parseFloat(e.target.value) || 28);
            this.calc();
        });

        document.querySelectorAll('[data-ev-kwh]').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('[data-ev-kwh]').forEach(b => b.classList.remove('is-selected'));
                btn.classList.add('is-selected');
                syncK(btn.getAttribute('data-ev-kwh'));
                syncE(btn.getAttribute('data-ev-eff'));
            });
        });

        window.addEventListener('currencyChanged', (e) => {
            this.state.flatRate = e.detail.data.defaultKwh;
            dFlatRate.value = this.state.flatRate;
            this.calc();
        });

        document.getElementById('evCopyBtn').addEventListener('click', () => {
            const txt = `VoltMetrics EV Home Charging Result: Driving ${this.state.miles} miles/mo at ${this.state.eff} mi/kWh costs ${document.getElementById('evResMonthlyCost').textContent}/month (${document.getElementById('evResPerMile').textContent}/mile, ${document.getElementById('evResAnnualSavings').textContent} vs gas).`;
            navigator.clipboard.writeText(txt);
            document.getElementById('evCopyBtn').textContent = 'Copied!';
            setTimeout(() => { document.getElementById('evCopyBtn').textContent = 'Copy EV Charging Summary'; }, 2000);
        });

        this.calc();
    },

    getEffectiveRate() {
        if (this.state.tariffMode === 'tou') {
            const offPeakShare = this.state.offPeakPct / 100;
            const peakShare = 1 - offPeakShare;
            return (this.state.offPeakRate * offPeakShare) + (this.state.peakRate * peakShare);
        }
        return this.state.flatRate;
    },

    calc() {
        const effDecimal = this.state.chargerEff / 100;
        const effectiveRate = this.getEffectiveRate();

        // Grid kWh required = Battery kWh / Charging Efficiency
        const gridKwhPerFull = this.state.kwh / effDecimal;
        const fullChargeCost = gridKwhPerFull * effectiveRate;
        const totalEstimatedRange = Math.round(this.state.kwh * this.state.eff);

        // Monthly
        const batteryKwhNeededMonthly = this.state.miles / this.state.eff;
        const gridKwhMonthly = batteryKwhNeededMonthly / effDecimal;
        const monthlyCost = gridKwhMonthly * effectiveRate;
        const costPerMile = this.state.miles > 0 ? (monthlyCost / this.state.miles) : 0;

        // Gasoline comparison
        const gasGallonsMonthly = this.state.miles / this.state.gasMpg;
        const gasCostMonthly = gasGallonsMonthly * this.state.gasPrice;
        const gasCostPerMile = this.state.gasPrice / this.state.gasMpg;
        const monthlySavings = gasCostMonthly - monthlyCost;
        const annualSavings = monthlySavings * 12;

        document.getElementById('evResMonthlyCost').textContent = CurrencyManager.formatCost(monthlyCost);
        document.getElementById('evResMonthlyKwh').textContent = Math.round(gridKwhMonthly) + ' kWh';
        document.getElementById('evResFullCharge').textContent = CurrencyManager.formatCost(fullChargeCost);
        document.getElementById('evResRangeLabel').textContent = `~${totalEstimatedRange} miles range`;
        document.getElementById('evResPerMile').textContent = CurrencyManager.formatCost(costPerMile);
        document.getElementById('evResGasMileCompare').textContent = `Vs ${CurrencyManager.formatCost(gasCostPerMile)}/mi gasoline`;

        const titleEl = document.getElementById('evResSavingsTitle');
        const paramsLabel = document.getElementById('evResGasParamsLabel');
        const savingsEl = document.getElementById('evResAnnualSavings');

        paramsLabel.textContent = `Compared to a ${this.state.gasMpg} MPG gas car at $${this.state.gasPrice.toFixed(2)}/gallon (${CurrencyManager.formatCost(gasCostMonthly)}/mo):`;

        if (annualSavings >= 0) {
            titleEl.textContent = 'Annual Fuel Savings vs Gasoline';
            savingsEl.style.color = 'var(--emerald-400)';
            savingsEl.textContent = '+' + CurrencyManager.formatCost(annualSavings) + ' / year Saved';
        } else {
            titleEl.textContent = 'Annual Additional Cost vs Gasoline';
            savingsEl.style.color = 'var(--amber-400)';
            savingsEl.textContent = 'Additional Cost: ' + CurrencyManager.formatCost(Math.abs(annualSavings)) + ' / year';
        }

        // TOU tip
        if (this.state.tariffMode === 'tou') {
            const allOffPeakCost = gridKwhMonthly * this.state.offPeakRate * 12;
            const currentTouCost = monthlyCost * 12;
            const extraTouSavings = Math.max(0, currentTouCost - allOffPeakCost);
            document.getElementById('evTouSavingsValue').textContent = 'Save ' + CurrencyManager.formatCost(extraTouSavings) + '/yr';
        }
    }
};

document.addEventListener('DOMContentLoaded', () => EvCalc.init());
</script>

</body>
</html>
