<?php
require_once __DIR__ . '/../config/site_config.php';
require_once __DIR__ . '/../config/rates.php';
require_once __DIR__ . '/../includes/seo_helper.php';

$page_title = "Pool Pump Electricity Calculator - Variable Speed (2026)";
$meta_description = "Calculate operating costs with our pool pump electricity calculator. Compare single-speed pumps against high-efficiency variable-speed pumps for savings.";
$focus_keyword = "pool pump electricity calculator";
$canonical_path = "calculators/pool-pump-electricity.php";

$custom_schema = [
    '@type' => 'WebApplication',
    'name' => $page_title,
    'description' => $meta_description,
    'featureList' => [
        'Single-Speed (1.0 HP to 3.0 HP) Filtration Motor Sizing',
        'Variable-Speed Inverter Pump Energy Conservation Modeling',
        'Seasonal Operating Cost and Annual Electricity Dollar Savings'
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
        <span style="color: var(--emerald-700); font-weight: 700;">Pool Pump Electricity Calculator</span>
    </nav>
</div>

<main class="section-padding" style="padding-top: 24px;">
    <div class="container">
        <div style="margin-bottom: 30px;">
            <span class="section-tag">Category 4: EV & Utility &bull; Active Tool</span>
            <h1 style="font-size: 2.5rem; letter-spacing: -0.02em; margin-bottom: 12px; color: var(--slate-900);">
                Pool Pump Electricity Calculator
            </h1>
            <p style="font-size: 1.125rem; color: var(--slate-600); max-width: 760px; line-height: 1.6;">
                Swimming pool filtration pumps are frequently the second largest consumer of residential electricity after air conditioning. Calculate your monthly pump operating expenses and discover how much you can save by switching to a modern variable-speed pump.
            </p>
        </div>

        <div class="calculator-wrapper">
            <!-- Motor Presets -->
            <div class="calc-presets-section">
                <div class="presets-header">
                    <span class="presets-title">Single-Speed Pump Horsepower Presets:</span>
                    <span class="presets-hint">Pre-configures standard motor continuous power draw</span>
                </div>
                <div class="presets-scroll">
                    <button type="button" class="preset-chip" data-pp-watts="1000" data-pp-hp="0.75">
                        0.75 HP (~1,000W)
                    </button>
                    <button type="button" class="preset-chip" data-pp-watts="1250" data-pp-hp="1.0">
                        1.0 HP (~1,250W)
                    </button>
                    <button type="button" class="preset-chip is-selected" data-pp-watts="1500" data-pp-hp="1.5">
                        1.5 HP Standard (~1,500W)
                    </button>
                    <button type="button" class="preset-chip" data-pp-watts="2000" data-pp-hp="2.0">
                        2.0 HP Heavy (~2,000W)
                    </button>
                    <button type="button" class="preset-chip" data-pp-watts="2400" data-pp-hp="2.5">
                        2.5 HP Commercial (~2,400W)
                    </button>
                </div>
            </div>

            <div class="calc-grid">
                <!-- Inputs -->
                <div class="calc-inputs-col">
                    <h2 style="font-size: 1.25rem; color: var(--slate-800); margin-bottom: 12px;">1. Current Single-Speed Pump:</h2>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="ppWattsInput" class="calc-label">Current Motor Power Draw (Watts):</label>
                            <span class="calc-value-badge highlight" id="ppWattsBadge">1,500 Watts</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="ppWattsInput" class="calc-number-input" value="1500" min="200" max="4500" step="50">
                            <span class="input-suffix">Watts</span>
                        </div>
                        <input type="range" id="ppWattsRange" class="calc-range" min="500" max="3000" step="50" value="1500">
                        <span class="calc-help">Single-speed motors run at fixed 3,450 RPM continuous full power.</span>
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="ppHoursInput" class="calc-label">Daily Single-Speed Run Duration (Hours):</label>
                            <span class="calc-value-badge" id="ppHoursBadge">8 hrs/day</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="ppHoursInput" class="calc-number-input" value="8" min="2" max="24" step="1">
                            <span class="input-suffix">Hours</span>
                        </div>
                        <input type="range" id="ppHoursRange" class="calc-range" min="4" max="24" step="1" value="8">
                    </div>

                    <h2 style="font-size: 1.25rem; color: var(--slate-800); margin-top: 24px; margin-bottom: 12px;">2. Variable-Speed Schedule (VSP):</h2>
                    <span class="calc-help" style="margin-top: -6px; margin-bottom: 12px; display: block;">
                        Modern variable-speed pumps run multi-tiered schedules throughout the day to optimize turnover at dramatically lower wattage.
                    </span>

                    <!-- Low Speed -->
                    <div style="background: var(--slate-50); border: 1px solid var(--border-subtle); border-radius: 8px; padding: 12px; margin-bottom: 12px;">
                        <strong style="font-size: 0.875rem; color: var(--emerald-700);">Low Speed (Filtration & Circulation):</strong>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 8px;">
                            <div>
                                <label for="ppVspLowW" class="calc-label" style="font-size: 0.8125rem;">Power (Watts):</label>
                                <input type="number" id="ppVspLowW" class="calc-number-input" value="200" min="50" max="500" step="10">
                            </div>
                            <div>
                                <label for="ppVspLowH" class="calc-label" style="font-size: 0.8125rem;">Hours per Day:</label>
                                <input type="number" id="ppVspLowH" class="calc-number-input" value="12" min="0" max="24" step="1">
                            </div>
                        </div>
                    </div>

                    <!-- Medium Speed -->
                    <div style="background: var(--slate-50); border: 1px solid var(--border-subtle); border-radius: 8px; padding: 12px; margin-bottom: 12px;">
                        <strong style="font-size: 0.875rem; color: var(--cyan-700);">Medium Speed (Surface Skimming & Salt Chlorine):</strong>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 8px;">
                            <div>
                                <label for="ppVspMedW" class="calc-label" style="font-size: 0.8125rem;">Power (Watts):</label>
                                <input type="number" id="ppVspMedW" class="calc-number-input" value="650" min="300" max="1200" step="25">
                            </div>
                            <div>
                                <label for="ppVspMedH" class="calc-label" style="font-size: 0.8125rem;">Hours per Day:</label>
                                <input type="number" id="ppVspMedH" class="calc-number-input" value="3" min="0" max="12" step="1">
                            </div>
                        </div>
                    </div>

                    <!-- High Speed -->
                    <div style="background: var(--slate-50); border: 1px solid var(--border-subtle); border-radius: 8px; padding: 12px; margin-bottom: 16px;">
                        <strong style="font-size: 0.875rem; color: var(--amber-700);">High Speed (Vacuuming, Heater & Waterfalls):</strong>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 8px;">
                            <div>
                                <label for="ppVspHighW" class="calc-label" style="font-size: 0.8125rem;">Power (Watts):</label>
                                <input type="number" id="ppVspHighW" class="calc-number-input" value="1800" min="1000" max="3000" step="50">
                            </div>
                            <div>
                                <label for="ppVspHighH" class="calc-label" style="font-size: 0.8125rem;">Hours per Day:</label>
                                <input type="number" id="ppVspHighH" class="calc-number-input" value="1" min="0" max="8" step="1">
                            </div>
                        </div>
                    </div>

                    <h2 style="font-size: 1.25rem; color: var(--slate-800); margin-top: 20px; margin-bottom: 12px;">3. Utility & Season Parameters:</h2>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div class="calc-group">
                            <div class="calc-label-row">
                                <label for="ppSeasonInput" class="calc-label">Season (Months):</label>
                                <span class="calc-value-badge" id="ppSeasonBadge">6 Mos/yr</span>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="ppSeasonInput" class="calc-number-input" value="6" min="1" max="12" step="1">
                                <span class="input-suffix">Months</span>
                            </div>
                        </div>

                        <div class="calc-group">
                            <div class="calc-label-row">
                                <label for="ppRateInput" class="calc-label">Rate (<span data-currency-symbol>$</span>/kWh):</label>
                                <span class="calc-value-badge">Active</span>
                            </div>
                            <div class="calc-input-wrapper">
                                <input type="number" id="ppRateInput" class="calc-number-input" value="0.1830" min="0.01" max="2.00" step="0.0001">
                                <span class="input-suffix">/kWh</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Results Column -->
                <div class="calc-results-col">
                    <div class="results-header">
                        <h3 class="results-title">Filtration Energy Cost</h3>
                        <span class="results-badge">Comparison</span>
                    </div>

                    <div class="cost-card-primary">
                        <div class="cost-period-label">Current Single-Speed Monthly Cost</div>
                        <div class="cost-big-number">
                            <span id="ppResMonthlyCost" style="color: var(--amber-400);">$66.78</span>
                        </div>
                        <div class="cost-sub-kwh">
                            Using <strong id="ppResMonthlyKwh">365 kWh</strong> each month (<span id="ppResSeasonCost">$400.68</span>/season)
                        </div>
                    </div>

                    <div class="results-breakdown-grid">
                        <div class="breakdown-box">
                            <span class="bb-label">Variable-Speed Bill</span>
                            <span class="bb-value" id="ppResVspMonthlyCost" style="color: var(--emerald-400);">$34.25</span>
                            <span class="bb-sub" id="ppResVspMonthlyKwh">187 kWh/mo (16 hrs/day)</span>
                        </div>
                        <div class="breakdown-box">
                            <span class="bb-label">Energy Reduction</span>
                            <span class="bb-value" id="ppResPctSaved" style="color: var(--emerald-400);">-48.7%</span>
                            <span class="bb-sub">Lower power via Affinity Law</span>
                        </div>
                    </div>

                    <!-- Variable Speed Upgrade ROI -->
                    <div class="comparison-section">
                        <div class="comparison-header">
                            <span class="star-icon">&#9733;</span>
                            <span class="comparison-title">Annual Variable-Speed Dollar Savings</span>
                        </div>
                        <p style="font-size: 0.8125rem; color: var(--slate-300); margin-bottom: 6px;">
                            Net savings from upgrading to the proposed variable-speed schedule:
                        </p>
                        <div style="font-size: 1.35rem; font-weight: 800; color: var(--emerald-400);" id="ppResSavings">
                            +$195.18 / season Saved
                        </div>
                        <span style="font-size: 0.8125rem; color: var(--emerald-300); display: block; margin-top: 4px;" id="ppResMonthlySavings">
                            Save $32.53 / month
                        </span>
                    </div>

                    <button type="button" class="btn btn-share" id="ppCopyBtn">
                        Copy Pool Pump Summary
                    </button>
                </div>
            </div>
        </div>

        <section class="calc-content-section">
            <div class="calc-content-card">
                <h2 class="content-heading-2">Affinity Law Fluid Dynamics: Why Slowing Down Saves Up to 80%</h2>
                <div class="formula-box">
                    <strong>The Affinity Laws of Fluid Dynamics:</strong><br>
                    Flow Rate (Gallons/min) &prop; Speed (RPM)<br>
                    Head Pressure &prop; Speed<sup>2</sup> (RPM<sup>2</sup>)<br>
                    Electrical Power (Watts) &prop; Speed<sup>3</sup> (RPM<sup>3</sup>)
                </div>
                <p class="content-p">
                    Flow rate varies directly with impeller RPM, but electrical power varies with the cube of speed. When you cut motor speed in half (from 3,450 RPM down to 1,725 RPM), the pump power consumption drops to (0.5)<sup>3</sup> = 0.125, or just 12.5% of full wattage. Running at half-speed for twice as long moves the exact same volume of water through your filtration media while saving 75% in electricity.
                </p>
            </div>
        </section>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

<script>
const PoolPumpCalc = {
    state: {
        watts: 1500,
        hours: 8,
        vspLowW: 200,
        vspLowH: 12,
        vspMedW: 650,
        vspMedH: 3,
        vspHighW: 1800,
        vspHighH: 1,
        seasonMonths: 6,
        rate: 0.1830
    },
    init() {
        const dW = document.getElementById('ppWattsInput');
        const rW = document.getElementById('ppWattsRange');
        const bW = document.getElementById('ppWattsBadge');

        const dH = document.getElementById('ppHoursInput');
        const rH = document.getElementById('ppHoursRange');
        const bH = document.getElementById('ppHoursBadge');

        const dLowW = document.getElementById('ppVspLowW');
        const dLowH = document.getElementById('ppVspLowH');
        const dMedW = document.getElementById('ppVspMedW');
        const dMedH = document.getElementById('ppVspMedH');
        const dHighW = document.getElementById('ppVspHighW');
        const dHighH = document.getElementById('ppVspHighH');

        const dS = document.getElementById('ppSeasonInput');
        const bS = document.getElementById('ppSeasonBadge');

        const dR = document.getElementById('ppRateInput');

        const syncW = (val) => {
            this.state.watts = Math.max(100, parseFloat(val) || 1500);
            dW.value = this.state.watts;
            if (rW) rW.value = Math.min(this.state.watts, 3000);
            bW.textContent = this.state.watts.toLocaleString() + ' Watts';
            this.calc();
        };

        const syncH = (val) => {
            const parsed = parseFloat(val);
            this.state.hours = Math.min(24, Math.max(0, isNaN(parsed) ? 8 : parsed));
            dH.value = this.state.hours;
            if (rH) rH.value = this.state.hours;
            bH.textContent = this.state.hours + ' hrs/day';
            this.calc();
        };

        const syncS = (val) => {
            this.state.seasonMonths = Math.min(12, Math.max(1, parseInt(val) || 6));
            dS.value = this.state.seasonMonths;
            if (bS) bS.textContent = this.state.seasonMonths + ' Mos/yr';
            this.calc();
        };

        dW.addEventListener('input', (e) => syncW(e.target.value));
        if (rW) rW.addEventListener('input', (e) => syncW(e.target.value));

        dH.addEventListener('input', (e) => syncH(e.target.value));
        if (rH) rH.addEventListener('input', (e) => syncH(e.target.value));

        dLowW.addEventListener('input', (e) => { this.state.vspLowW = parseFloat(e.target.value) || 200; this.calc(); });
        dLowH.addEventListener('input', (e) => { this.state.vspLowH = parseFloat(e.target.value) || 0; this.calc(); });
        dMedW.addEventListener('input', (e) => { this.state.vspMedW = parseFloat(e.target.value) || 650; this.calc(); });
        dMedH.addEventListener('input', (e) => { this.state.vspMedH = parseFloat(e.target.value) || 0; this.calc(); });
        dHighW.addEventListener('input', (e) => { this.state.vspHighW = parseFloat(e.target.value) || 1800; this.calc(); });
        dHighH.addEventListener('input', (e) => { this.state.vspHighH = parseFloat(e.target.value) || 0; this.calc(); });

        dS.addEventListener('input', (e) => syncS(e.target.value));

        dR.addEventListener('input', (e) => {
            const parsed = parseFloat(e.target.value);
            this.state.rate = Math.max(0, isNaN(parsed) ? 0.1830 : parsed);
            this.calc();
        });

        document.querySelectorAll('[data-pp-watts]').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('[data-pp-watts]').forEach(b => b.classList.remove('is-selected'));
                btn.classList.add('is-selected');
                syncW(btn.getAttribute('data-pp-watts'));
            });
        });

        window.addEventListener('currencyChanged', (e) => {
            this.state.rate = e.detail.data.defaultKwh;
            dR.value = this.state.rate;
            this.calc();
        });

        document.getElementById('ppCopyBtn').addEventListener('click', () => {
            const txt = `VoltMetrics Pool Pump Result: Current single-speed pump costs ${document.getElementById('ppResMonthlyCost').textContent}/mo (${document.getElementById('ppResSeasonCost').textContent}/season). Variable-speed schedule costs ${document.getElementById('ppResVspMonthlyCost').textContent}/mo, saving ${document.getElementById('ppResSavings').textContent}.`;
            navigator.clipboard.writeText(txt);
            document.getElementById('ppCopyBtn').textContent = 'Copied!';
            setTimeout(() => { document.getElementById('ppCopyBtn').textContent = 'Copy Pool Pump Summary'; }, 2000);
        });

        this.calc();
    },

    calc() {
        // Single speed baseline
        const ssDailyKwh = (this.state.watts * this.state.hours) / 1000;
        const ssMonthlyKwh = ssDailyKwh * 30.42;
        const ssMonthlyCost = ssMonthlyKwh * this.state.rate;
        const ssSeasonCost = ssMonthlyCost * this.state.seasonMonths;

        // Proposed Variable-Speed Schedule
        const vspDailyWh = (this.state.vspLowW * this.state.vspLowH) +
                           (this.state.vspMedW * this.state.vspMedH) +
                           (this.state.vspHighW * this.state.vspHighH);
        const vspDailyKwh = vspDailyWh / 1000;
        const vspTotalHours = this.state.vspLowH + this.state.vspMedH + this.state.vspHighH;
        const vspMonthlyKwh = vspDailyKwh * 30.42;
        const vspMonthlyCost = vspMonthlyKwh * this.state.rate;
        const vspSeasonCost = vspMonthlyCost * this.state.seasonMonths;

        // Savings
        const monthlySavings = ssMonthlyCost - vspMonthlyCost;
        const seasonSavings = ssSeasonCost - vspSeasonCost;
        const pctSaved = ssMonthlyKwh > 0 ? (((ssMonthlyKwh - vspMonthlyKwh) / ssMonthlyKwh) * 100) : 0;

        document.getElementById('ppResMonthlyCost').textContent = CurrencyManager.formatCost(ssMonthlyCost);
        document.getElementById('ppResMonthlyKwh').textContent = Math.round(ssMonthlyKwh) + ' kWh';
        document.getElementById('ppResSeasonCost').textContent = CurrencyManager.formatCost(ssSeasonCost);

        document.getElementById('ppResVspMonthlyCost').textContent = CurrencyManager.formatCost(vspMonthlyCost);
        document.getElementById('ppResVspMonthlyKwh').textContent = `${Math.round(vspMonthlyKwh)} kWh/mo (${vspTotalHours} hrs/day)`;
        document.getElementById('ppResPctSaved').textContent = (pctSaved >= 0 ? '-' : '+') + Math.abs(pctSaved).toFixed(1) + '%';

        if (seasonSavings >= 0) {
            document.getElementById('ppResSavings').textContent = `+${CurrencyManager.formatCost(seasonSavings)} / season Saved`;
            document.getElementById('ppResSavings').style.color = 'var(--emerald-400)';
            document.getElementById('ppResMonthlySavings').textContent = `Save ${CurrencyManager.formatCost(monthlySavings)} / month`;
        } else {
            document.getElementById('ppResSavings').textContent = `${CurrencyManager.formatCost(Math.abs(seasonSavings))} / season Added`;
            document.getElementById('ppResSavings').style.color = 'var(--amber-400)';
            document.getElementById('ppResMonthlySavings').textContent = `${CurrencyManager.formatCost(Math.abs(monthlySavings))} / month extra`;
        }
    }
};

document.addEventListener('DOMContentLoaded', () => PoolPumpCalc.init());
</script>

</body>
</html>
