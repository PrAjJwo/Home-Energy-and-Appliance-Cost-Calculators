<?php
require_once __DIR__ . '/../config/site_config.php';
require_once __DIR__ . '/../config/rates.php';
require_once __DIR__ . '/../includes/seo_helper.php';

$page_title = "Watts to Monthly Cost Calculator - 2026 Power Converter";
$meta_description = "Convert wattage into daily and monthly utility bill impacts with our watts to monthly cost calculator. Instant kWh conversion for any household device.";
$focus_keyword = "watts to monthly cost calculator";
$canonical_path = "calculators/watts-to-monthly-cost.php";

$custom_schema = [
    '@type' => 'WebApplication',
    'name' => $page_title,
    'description' => $meta_description,
    'featureList' => [
        'Instant Wattage to Kilowatt-Hour Conversion',
        'Hourly, Daily, Monthly, and Annual Cost Projections',
        '2026 Global Tariffs and Multi-Currency Switcher'
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
        <a href="/categories/appliances.php" style="color: var(--slate-600);">Everyday Appliances</a>
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

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

<script>
const WattsCalc = {
    state: { watts: 100, hours: 8, days: 30, rate: 0.1830 },
    init() {
        const dW = document.getElementById('wtWattsInput');
        const rW = document.getElementById('wtWattsRange');
        const bW = document.getElementById('wtWattsBadge');

        const dH = document.getElementById('wtHoursInput');
        const rH = document.getElementById('wtHoursRange');
        const bH = document.getElementById('wtHoursBadge');

        const dD = document.getElementById('wtDaysInput');
        const bD = document.getElementById('wtDaysBadge');

        const dR = document.getElementById('wtRateInput');

        const syncW = (val) => {
            this.state.watts = Math.max(1, parseFloat(val) || 1);
            dW.value = this.state.watts;
            rW.value = Math.min(this.state.watts, 3000);
            bW.textContent = this.state.watts + ' Watts';
            this.calc();
        };

        const syncH = (val) => {
            const parsed = parseFloat(val);
            this.state.hours = Math.min(24, Math.max(0, isNaN(parsed) ? 1 : parsed));
            dH.value = this.state.hours;
            rH.value = this.state.hours;
            bH.textContent = this.state.hours + ' hrs/day';
            this.calc();
        };

        const syncD = (val) => {
            this.state.days = Math.min(31, Math.max(1, parseFloat(val) || 30));
            dD.value = this.state.days;
            bD.textContent = this.state.days + ' days';
            this.calc();
        };

        dW.addEventListener('input', (e) => syncW(e.target.value));
        rW.addEventListener('input', (e) => syncW(e.target.value));

        dH.addEventListener('input', (e) => syncH(e.target.value));
        rH.addEventListener('input', (e) => syncH(e.target.value));

        dD.addEventListener('input', (e) => syncD(e.target.value));

        dR.addEventListener('input', (e) => {
            const parsed = parseFloat(e.target.value);
            this.state.rate = Math.max(0, isNaN(parsed) ? 0.1830 : parsed);
            this.calc();
        });

        document.querySelectorAll('[data-watt-val]').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('[data-watt-val]').forEach(b => b.classList.remove('is-selected'));
                btn.classList.add('is-selected');
                syncW(btn.getAttribute('data-watt-val'));
                syncH(btn.getAttribute('data-hours-val') || 8);
            });
        });

        window.addEventListener('currencyChanged', (e) => {
            this.state.rate = e.detail.data.defaultKwh;
            dR.value = this.state.rate;
            this.calc();
        });

        document.getElementById('wtCopyBtn').addEventListener('click', () => {
            const txt = `VoltMetrics Watts to Cost Result: ${this.state.watts} Watts used ${this.state.hours} hrs/day (${this.state.days} days/mo) costs ${document.getElementById('wtResMonthlyCost').textContent}/month.`;
            navigator.clipboard.writeText(txt);
            document.getElementById('wtCopyBtn').textContent = 'Copied!';
            setTimeout(() => { document.getElementById('wtCopyBtn').textContent = 'Copy Calculation Summary'; }, 2000);
        });

        this.calc();
    },

    calc() {
        const kw = this.state.watts / 1000;
        const hourlyCost = kw * this.state.rate;
        const dailyKwh = kw * this.state.hours;
        const dailyCost = dailyKwh * this.state.rate;
        const monthlyKwh = dailyKwh * this.state.days;
        const monthlyCost = monthlyKwh * this.state.rate;
        const annualKwh = dailyKwh * 365;
        const annualCost = annualKwh * this.state.rate;

        document.getElementById('wtResKw').textContent = kw.toFixed(3) + ' kW';
        document.getElementById('wtResHourlyCost').textContent = CurrencyManager.formatCost(hourlyCost);
        document.getElementById('wtResDailyCost').textContent = CurrencyManager.formatCost(dailyCost);
        document.getElementById('wtResDailyKwh').textContent = dailyKwh.toFixed(2) + ' kWh/day';
        document.getElementById('wtResMonthlyCost').textContent = CurrencyManager.formatCost(monthlyCost);
        document.getElementById('wtResMonthlyKwh').textContent = monthlyKwh.toFixed(1) + ' kWh';
        document.getElementById('wtResAnnualCost').textContent = CurrencyManager.formatCost(annualCost);
        document.getElementById('wtResAnnualKwh').textContent = Math.round(annualKwh) + ' kWh/yr';
    }
};

document.addEventListener('DOMContentLoaded', () => WattsCalc.init());
</script>

</body>
</html>
