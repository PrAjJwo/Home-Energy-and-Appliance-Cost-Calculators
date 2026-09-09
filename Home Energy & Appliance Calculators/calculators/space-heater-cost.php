<?php
require_once __DIR__ . '/../config/site_config.php';
require_once __DIR__ . '/../config/rates.php';
require_once __DIR__ . '/../includes/seo_helper.php';

$page_title = "Space Heater Cost Calculator - Electric Heating Bill Estimator";
$meta_description = "Calculate how much it costs to run a 1,500W electric space heater per hour, night, month, and winter. Compare zone heating versus whole-home furnace heating.";
$focus_keyword = "space heater cost calculator";
$canonical_path = "calculators/space-heater-cost.php";

$custom_schema = [
    '@type' => 'WebApplication',
    'name' => $page_title,
    'description' => $meta_description,
    'featureList' => [
        '1,500W and 750W Low/High Heating Wattage Simulation',
        'Nightly and Monthly Winter Electric Bill Impact Analysis',
        'Zone Heating vs Whole-House Central Furnace Comparison'
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
        <a href="/categories/hvac-cooling-heating.php" style="color: var(--slate-600);">HVAC, Heating & Cooling</a>
        <span>/</span>
        <span style="color: var(--emerald-700); font-weight: 700;">Space Heater Cost Calculator</span>
    </nav>
</div>

<main class="section-padding" style="padding-top: 24px;">
    <div class="container">
        <div style="margin-bottom: 30px;">
            <span class="section-tag">Category 2: HVAC &bull; Active Tool</span>
            <h1 style="font-size: 2.5rem; letter-spacing: -0.02em; margin-bottom: 12px; color: var(--slate-900);">
                Space Heater Cost Calculator
            </h1>
            <p style="font-size: 1.125rem; color: var(--slate-600); max-width: 760px; line-height: 1.6;">
                Portable electric space heaters provide concentrated warmth, but running a 1,500-watt heating element continuously adds up rapidly on winter utility bills. Calculate your exact hourly, overnight, and monthly heating expenses.
            </p>
        </div>

        <div class="calculator-wrapper">
            <!-- Space Heater Presets -->
            <div class="calc-presets-section">
                <div class="presets-header">
                    <span class="presets-title">Common Space Heater Setting Presets:</span>
                    <span class="presets-hint">Pre-configures standard wattage levels</span>
                </div>
                <div class="presets-scroll">
                    <button type="button" class="preset-chip is-selected" data-sh-watts="1500" data-sh-hours="8" data-sh-name="Standard High (1,500W Overnight)">
                        Standard High (1,500W &bull; 8 hrs overnight)
                    </button>
                    <button type="button" class="preset-chip" data-sh-watts="1000" data-sh-hours="6" data-sh-name="Medium Heat (1,000W Evening)">
                        Medium Setting (1,000W &bull; 6 hrs)
                    </button>
                    <button type="button" class="preset-chip" data-sh-watts="750" data-sh-hours="8" data-sh-name="Low Eco Mode (750W Office)">
                        Low Eco Mode (750W &bull; 8 hrs desk)
                    </button>
                    <button type="button" class="preset-chip" data-sh-watts="1500" data-sh-hours="16" data-sh-name="Continuous Heavy Cold Snap (1,500W &bull; 16 hrs)">
                        Continuous Freeze (1,500W &bull; 16 hrs)
                    </button>
                    <button type="button" class="preset-chip" data-sh-watts="400" data-sh-hours="8" data-sh-name="Personal Ceramic Mini Heater (400W)">
                        Personal Mini Ceramic (400W &bull; 8 hrs)
                    </button>
                </div>
            </div>

            <div class="calc-grid">
                <!-- Inputs -->
                <div class="calc-inputs-col">
                    <h2 style="font-size: 1.25rem; color: var(--slate-800);">Heating Operating Inputs:</h2>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="shWattsInput" class="calc-label">Heater Power Setting (Watts):</label>
                            <span class="calc-value-badge highlight" id="shWattsBadge">1,500 Watts</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="shWattsInput" class="calc-number-input" value="1500" min="200" max="3000" step="50">
                            <span class="input-suffix">Watts</span>
                        </div>
                        <input type="range" id="shWattsRange" class="calc-range" min="400" max="2000" step="50" value="1500">
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="shHoursInput" class="calc-label">Daily Run Duration (Hours per Day):</label>
                            <span class="calc-value-badge" id="shHoursBadge">8 hrs/day</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="shHoursInput" class="calc-number-input" value="8" min="1" max="24" step="0.5">
                            <span class="input-suffix">Hours</span>
                        </div>
                        <input type="range" id="shHoursRange" class="calc-range" min="1" max="24" step="0.5" value="8">
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="shCycleInput" class="calc-label">Thermostat Duty Cycle:</label>
                            <span class="calc-value-badge" id="shCycleBadge">80% active</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="shCycleInput" class="calc-number-input" value="80" min="20" max="100" step="5">
                            <span class="input-suffix">%</span>
                        </div>
                        <input type="range" id="shCycleRange" class="calc-range" min="30" max="100" step="5" value="80">
                        <span class="calc-help">Heaters with internal thermostats cycle heating elements off once ambient air reaches warmth.</span>
                    </div>

                    <div class="calc-group">
                        <label for="shSeasonDays" class="calc-label">Winter Heating Season Duration:</label>
                        <select id="shSeasonDays" class="state-select" style="padding: 12px;">
                            <option value="60">2 Months / 60 Days (Mild Winter)</option>
                            <option value="90">3 Months / 90 Days (Moderate Winter)</option>
                            <option value="120" selected>4 Months / 120 Days (Standard Winter)</option>
                            <option value="150">5 Months / 150 Days (Long Cold Winter)</option>
                        </select>
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="shRateInput" class="calc-label">Electricity Tariff Rate (<span data-currency-symbol>$</span>/kWh):</label>
                            <span class="calc-value-badge">Benchmark Active</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="shRateInput" class="calc-number-input" value="0.1830" min="0.01" max="2.00" step="0.0001">
                            <span class="input-suffix">per kWh</span>
                        </div>
                    </div>
                </div>

                <!-- Results Column -->
                <div class="calc-results-col">
                    <div class="results-header">
                        <h3 class="results-title">Space Heater Costs</h3>
                        <span class="results-badge">Winter Bill</span>
                    </div>

                    <div class="cost-card-primary">
                        <div class="cost-period-label">Estimated Monthly Bill Impact</div>
                        <div class="cost-big-number">
                            <span id="shResMonthlyCost">$0.00</span>
                        </div>
                        <div class="cost-sub-kwh">
                            Consuming <strong id="shResMonthlyKwh" style="color: var(--emerald-400);">0 kWh</strong> / month
                        </div>
                    </div>

                    <div class="results-breakdown-grid">
                        <div class="breakdown-box">
                            <span class="bb-label">Hourly Operating Cost</span>
                            <span class="bb-value" id="shResHourlyCost">$0.00/hr</span>
                            <span class="bb-sub">At active draw</span>
                        </div>
                        <div class="breakdown-box">
                            <span class="bb-label">Daily Cost</span>
                            <span class="bb-value" id="shResDailyCost">$0.00</span>
                            <span class="bb-sub" id="shResDailyKwh">0.0 kWh/day</span>
                        </div>
                    </div>

                    <div class="breakdown-box" style="margin-bottom: 20px;">
                        <span class="bb-label"><span id="shSeasonLabel">4-Month</span> Winter Total</span>
                        <span class="bb-value" style="font-size: 1.5rem; color: var(--emerald-400);" id="shResWinterCost">$0.00</span>
                        <span class="bb-sub"><span id="shSeasonDaysCount">120</span> days of supplemental heat</span>
                    </div>

                    <button type="button" class="btn btn-share" id="shCopyBtn">
                        Copy Space Heater Summary
                    </button>
                </div>
            </div>
        </div>

        <section class="calc-content-section">
            <div class="calc-content-card">
                <h2 class="content-heading-2">Is It Cheaper to Use a Space Heater or Central Heat?</h2>
                <p class="content-p">
                    Using an electric space heater only saves money if you practice true "zone heating". That means lowering your central thermostat down to 64&deg;F to 66&deg;F and using a single space heater only in the specific room you occupy (such as a bedroom or home office). If you run multiple space heaters in different rooms or leave the central thermostat high, your electric bill will skyrocket because resistance heating is 3 to 4 times more expensive per BTU than heat pumps or natural gas.
                </p>

                <h3 class="content-heading-3">Thermodynamic Reality: All Electric Resistance Heaters are 100% Efficient</h3>
                <p class="content-p">
                    Regardless of whether a space heater is marketed as ceramic, quartz infrared, oil-filled radiator, mica, or fan-forced coil, all electric resistance heaters convert exactly 100% of incoming electricity into heat. Specifically, 1 kilowatt-hour (kWh) of electricity produces exactly 3,412.14 BTU of thermal energy. No portable space heater is "more efficient" than any other at creating raw heat per watt. Differences lie entirely in how heat is delivered (instant directional radiant warmth vs slow room convection) and safety features.
                </p>
            </div>
        </section>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

<script>
const SpaceHeaterCalc = {
    state: { watts: 1500, hours: 8, cycle: 80, rate: 0.1830, seasonDays: 120 },
    init() {
        const dW = document.getElementById('shWattsInput');
        const rW = document.getElementById('shWattsRange');
        const bW = document.getElementById('shWattsBadge');

        const dH = document.getElementById('shHoursInput');
        const rH = document.getElementById('shHoursRange');
        const bH = document.getElementById('shHoursBadge');

        const dC = document.getElementById('shCycleInput');
        const rC = document.getElementById('shCycleRange');
        const bC = document.getElementById('shCycleBadge');

        const dS = document.getElementById('shSeasonDays');
        const dR = document.getElementById('shRateInput');

        const syncW = (val) => {
            this.state.watts = Math.max(100, parseFloat(val) || 1500);
            dW.value = this.state.watts;
            rW.value = Math.min(this.state.watts, 2000);
            bW.textContent = this.state.watts + ' Watts';
            this.calc();
        };

        const syncH = (val) => {
            const parsed = parseFloat(val);
            this.state.hours = Math.min(24, Math.max(0, isNaN(parsed) ? 8 : parsed));
            dH.value = this.state.hours;
            rH.value = this.state.hours;
            bH.textContent = this.state.hours + ' hrs/day';
            this.calc();
        };

        const syncC = (val) => {
            const parsed = parseFloat(val);
            this.state.cycle = Math.min(100, Math.max(0, isNaN(parsed) ? 80 : parsed));
            dC.value = this.state.cycle;
            rC.value = this.state.cycle;
            bC.textContent = this.state.cycle + '% active';
            this.calc();
        };

        dW.addEventListener('input', (e) => syncW(e.target.value));
        rW.addEventListener('input', (e) => syncW(e.target.value));

        dH.addEventListener('input', (e) => syncH(e.target.value));
        rH.addEventListener('input', (e) => syncH(e.target.value));

        dC.addEventListener('input', (e) => syncC(e.target.value));
        rC.addEventListener('input', (e) => syncC(e.target.value));

        if (dS) {
            dS.addEventListener('change', (e) => {
                this.state.seasonDays = parseInt(e.target.value) || 120;
                const months = Math.round(this.state.seasonDays / 30);
                const label = document.getElementById('shSeasonLabel');
                const count = document.getElementById('shSeasonDaysCount');
                if (label) label.textContent = `${months}-Month`;
                if (count) count.textContent = this.state.seasonDays;
                this.calc();
            });
        }

        dR.addEventListener('input', (e) => {
            const parsed = parseFloat(e.target.value);
            this.state.rate = Math.max(0, isNaN(parsed) ? 0.1830 : parsed);
            this.calc();
        });

        document.querySelectorAll('[data-sh-watts]').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('[data-sh-watts]').forEach(b => b.classList.remove('is-selected'));
                btn.classList.add('is-selected');
                syncW(btn.getAttribute('data-sh-watts'));
                syncH(btn.getAttribute('data-sh-hours') || 8);
            });
        });

        window.addEventListener('currencyChanged', (e) => {
            this.state.rate = e.detail.data.defaultKwh;
            dR.value = this.state.rate;
            this.calc();
        });

        document.getElementById('shCopyBtn').addEventListener('click', () => {
            const txt = `VoltMetrics Space Heater Cost: ${this.state.watts}W heater running ${this.state.hours} hrs/day (${this.state.cycle}% duty) costs ${document.getElementById('shResMonthlyCost').textContent}/month (${document.getElementById('shResWinterCost').textContent} for ${this.state.seasonDays} winter days).`;
            navigator.clipboard.writeText(txt);
            document.getElementById('shCopyBtn').textContent = 'Copied!';
            setTimeout(() => { document.getElementById('shCopyBtn').textContent = 'Copy Space Heater Summary'; }, 2000);
        });

        this.calc();
    },

    calc() {
        const hourlyKwh = (this.state.watts / 1000);
        const hourlyCost = hourlyKwh * this.state.rate;
        const dailyKwh = hourlyKwh * this.state.hours * (this.state.cycle / 100);
        const dailyCost = dailyKwh * this.state.rate;
        const monthlyKwh = dailyKwh * 30.42;
        const monthlyCost = monthlyKwh * this.state.rate;
        const winterCost = dailyCost * this.state.seasonDays;

        document.getElementById('shResHourlyCost').textContent = CurrencyManager.formatCost(hourlyCost) + '/hr';
        document.getElementById('shResDailyCost').textContent = CurrencyManager.formatCost(dailyCost);
        document.getElementById('shResDailyKwh').textContent = dailyKwh.toFixed(1) + ' kWh/day';
        document.getElementById('shResMonthlyCost').textContent = CurrencyManager.formatCost(monthlyCost);
        document.getElementById('shResMonthlyKwh').textContent = Math.round(monthlyKwh) + ' kWh';
        document.getElementById('shResWinterCost').textContent = CurrencyManager.formatCost(winterCost);
    }
};

document.addEventListener('DOMContentLoaded', () => SpaceHeaterCalc.init());
</script>

</body>
</html>
