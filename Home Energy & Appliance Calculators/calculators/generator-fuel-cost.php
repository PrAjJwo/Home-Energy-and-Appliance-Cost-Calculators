<?php
require_once __DIR__ . '/../config/site_config.php';
require_once __DIR__ . '/../config/rates.php';
require_once __DIR__ . '/../includes/seo_helper.php';

$page_title = "Generator Fuel Cost Calculator - Gas, Propane & Diesel";
$meta_description = "Accurate generator fuel cost calculator to estimate hourly, daily, and storm outage fuel expenses across gas, propane, and natural gas emergency generators.";
$focus_keyword = "generator fuel cost calculator";
$canonical_path = "calculators/generator-fuel-cost.php";

$custom_schema = [
    '@type' => 'WebApplication',
    'name' => $page_title,
    'description' => $meta_description,
    'featureList' => [
        'Gasoline, Propane, and Diesel Price per Gallon Sizing',
        'Cost per Generated Kilowatt-Hour Analysis',
        'Multi-Day Storm Outage Fuel Expense Projections'
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
        <span style="color: var(--emerald-700); font-weight: 700;">Generator Fuel Cost Calculator</span>
    </nav>
</div>

<main class="section-padding" style="padding-top: 24px;">
    <div class="container">
        <div style="margin-bottom: 30px;">
            <span class="section-tag">Category 3: Backup Power &bull; Active Tool</span>
            <h1 style="font-size: 2.5rem; letter-spacing: -0.02em; margin-bottom: 12px; color: var(--slate-900);">
                Generator Fuel Cost Calculator
            </h1>
            <p style="font-size: 1.125rem; color: var(--slate-600); max-width: 760px; line-height: 1.6;">
                Generating off-grid electricity is significantly more expensive than utility power. Calculate fuel expenditures per hour, full tank, and multi-day storm blackouts across gasoline, diesel, and liquid propane systems.
            </p>
        </div>

        <div class="calculator-wrapper">
            <!-- Fuel Type Selector -->
            <div class="calc-presets-section">
                <div class="presets-header">
                    <span class="presets-title">Select Generator Fuel Type:</span>
                    <span class="presets-hint">Pre-loads standard energy density & fuel prices</span>
                </div>
                <div class="presets-scroll">
                    <button type="button" class="preset-chip is-selected" data-gfc-fuel="gasoline" data-gfc-price="4.071" data-gfc-burn="0.45">
                        Regular Unleaded Gasoline ($4.07/gal)
                    </button>
                    <button type="button" class="preset-chip" data-gfc-fuel="diesel" data-gfc-price="3.90" data-gfc-burn="0.38">
                        Diesel Fuel ($3.90/gal)
                    </button>
                    <button type="button" class="preset-chip" data-gfc-fuel="propane" data-gfc-price="2.90" data-gfc-burn="0.58">
                        Liquid Propane LP ($2.90/gal)
                    </button>
                </div>
            </div>

            <div class="calc-grid">
                <!-- Inputs -->
                <div class="calc-inputs-col">
                    <h2 style="font-size: 1.25rem; color: var(--slate-800);">Outage Parameters:</h2>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="gfcGenKwInput" class="calc-label">Generator Rated Capacity (kW):</label>
                            <span class="calc-value-badge highlight" id="gfcGenKwBadge">5.0 kW Rated</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="gfcGenKwInput" class="calc-number-input" value="5.0" min="1" max="25" step="0.5">
                            <span class="input-suffix">kW</span>
                        </div>
                        <input type="range" id="gfcGenKwRange" class="calc-range" min="1" max="15" step="0.5" value="5.0">
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="gfcLoadKwInput" class="calc-label">Actual Connected Electrical Load (kW):</label>
                            <span class="calc-value-badge" id="gfcLoadKwBadge">2.5 kW Active</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="gfcLoadKwInput" class="calc-number-input" value="2.5" min="0.2" max="25" step="0.1">
                            <span class="input-suffix">kW</span>
                        </div>
                        <span class="calc-help">The real household power drawn (refrigerator, well pump, furnace blower, router, lights). Typically 40% to 60% of rated capacity.</span>
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="gfcBurnInput" class="calc-label">Fuel Burn Rate at this Load (Gal/hr):</label>
                            <span class="calc-value-badge" id="gfcBurnBadge">0.45 gal/hr</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="gfcBurnInput" class="calc-number-input" value="0.45" min="0.05" max="3.0" step="0.01">
                            <span class="input-suffix">Gal / hr</span>
                        </div>
                        <input type="range" id="gfcBurnRange" class="calc-range" min="0.1" max="2.0" step="0.05" value="0.45">
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="gfcPriceInput" class="calc-label">Fuel Cost per Gallon (<span data-currency-symbol>$</span>/gal):</label>
                            <span class="calc-value-badge" id="gfcPriceBadge">$4.07/gal</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="gfcPriceInput" class="calc-number-input" value="4.071" min="1.0" max="10.0" step="0.001">
                            <span class="input-suffix">per gallon</span>
                        </div>
                        <input type="range" id="gfcPriceRange" class="calc-range" min="1.5" max="7.0" step="0.1" value="4.07">
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="gfcHoursInput" class="calc-label">Outage Duration (Hours):</label>
                            <span class="calc-value-badge" id="gfcHoursBadge">24 Hours (1 Day)</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="gfcHoursInput" class="calc-number-input" value="24" min="1" max="336" step="1">
                            <span class="input-suffix">Hours</span>
                        </div>
                        <input type="range" id="gfcHoursRange" class="calc-range" min="4" max="168" step="4" value="24">
                        <span class="calc-help">Common emergency periods: 24 hrs (1 day), 72 hrs (3 days), 168 hrs (1 week).</span>
                    </div>
                </div>

                <!-- Results Column -->
                <div class="calc-results-col">
                    <div class="results-header">
                        <h3 class="results-title">Fuel Expenses</h3>
                        <span class="results-badge">Outage Cost</span>
                    </div>

                    <div class="cost-card-primary">
                        <div class="cost-period-label">Total Outage Fuel Expense</div>
                        <div class="cost-big-number">
                            <span id="gfcResTotalCost" style="color: var(--amber-400);">$50.40</span>
                        </div>
                        <div class="cost-sub-kwh">
                            Requiring <strong id="gfcResTotalGal">14.4 gallons</strong> of fuel
                        </div>
                    </div>

                    <div class="results-breakdown-grid">
                        <div class="breakdown-box">
                            <span class="bb-label">Fuel Cost per Hour</span>
                            <span class="bb-value" id="gfcResHourlyCost">$2.10/hr</span>
                            <span class="bb-sub" id="gfcResBurnRateLabel">0.60 gal/hr</span>
                        </div>
                        <div class="breakdown-box">
                            <span class="bb-label">Cost per Generated kWh</span>
                            <span class="bb-value" id="gfcResKwhCost" style="color: var(--emerald-400);">$0.42/kWh</span>
                            <span class="bb-sub">Vs $0.18 grid power</span>
                        </div>
                    </div>

                    <div class="breakdown-box" style="margin-bottom: 20px;">
                        <span class="bb-label">3-Day (72-Hour) Storm Reserve</span>
                        <span class="bb-value" style="font-size: 1.5rem;" id="gfcResThreeDayCost">$151.20</span>
                        <span class="bb-sub" id="gfcResThreeDayGal">43.2 gallons needed in reserve</span>
                    </div>

                    <button type="button" class="btn btn-share" id="gfcCopyBtn">
                        Copy Generator Fuel Summary
                    </button>
                </div>
            </div>
        </div>

        <section class="calc-content-section">
            <div class="calc-content-card">
                <h2 class="content-heading-2">Gasoline vs Diesel vs Propane Generator Fuel Economics</h2>
                <p class="content-p">
                    While gasoline is the most accessible fuel, it spoils in storage within 3 to 6 months without stabilizer. Liquid propane (LP) has an indefinite shelf life and will never gum up carburetors during years of storage, making it the most reliable emergency reserve fuel despite burning roughly 15% to 20% more volume per kilowatt-hour. Diesel engines offer the lowest gallons-per-hour consumption and highest mechanical durability for extended week-long grid failures.
                </p>
            </div>
        </section>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

<script>
const GenFuelCalc = {
    state: { kw: 5.0, loadKw: 2.5, burn: 0.45, price: 4.071, hours: 24 },
    init() {
        const dKw = document.getElementById('gfcGenKwInput');
        const rKw = document.getElementById('gfcGenKwRange');
        const bKw = document.getElementById('gfcGenKwBadge');

        const dLoad = document.getElementById('gfcLoadKwInput');
        const bLoad = document.getElementById('gfcLoadKwBadge');

        const dB = document.getElementById('gfcBurnInput');
        const rB = document.getElementById('gfcBurnRange');
        const bB = document.getElementById('gfcBurnBadge');

        const dP = document.getElementById('gfcPriceInput');
        const rP = document.getElementById('gfcPriceRange');
        const bP = document.getElementById('gfcPriceBadge');

        const dH = document.getElementById('gfcHoursInput');
        const rH = document.getElementById('gfcHoursRange');
        const bH = document.getElementById('gfcHoursBadge');

        const syncKw = (val) => {
            this.state.kw = Math.max(0.5, parseFloat(val) || 5.0);
            dKw.value = this.state.kw;
            if (rKw) rKw.value = Math.min(this.state.kw, 15);
            bKw.textContent = this.state.kw + ' kW Rated';
            this.calc();
        };

        const syncLoad = (val) => {
            this.state.loadKw = Math.max(0.1, parseFloat(val) || 2.5);
            dLoad.value = this.state.loadKw;
            if (bLoad) bLoad.textContent = this.state.loadKw + ' kW Active';
            this.calc();
        };

        const syncB = (val) => {
            this.state.burn = Math.max(0.05, parseFloat(val) || 0.45);
            dB.value = this.state.burn;
            if (rB) rB.value = Math.min(this.state.burn, 2.0);
            bB.textContent = this.state.burn + ' gal/hr';
            this.calc();
        };

        const syncP = (val) => {
            this.state.price = Math.max(0.5, parseFloat(val) || 4.071);
            dP.value = this.state.price;
            if (rP) rP.value = Math.min(this.state.price, 7.0);
            bP.textContent = '$' + this.state.price.toFixed(2) + '/gal';
            this.calc();
        };

        const syncH = (val) => {
            this.state.hours = Math.max(1, parseInt(val) || 24);
            dH.value = this.state.hours;
            if (rH) rH.value = Math.min(this.state.hours, 168);
            bH.textContent = this.state.hours + ' Hours';
            this.calc();
        };

        dKw.addEventListener('input', (e) => syncKw(e.target.value));
        if (rKw) rKw.addEventListener('input', (e) => syncKw(e.target.value));

        if (dLoad) dLoad.addEventListener('input', (e) => syncLoad(e.target.value));

        dB.addEventListener('input', (e) => syncB(e.target.value));
        if (rB) rB.addEventListener('input', (e) => syncB(e.target.value));

        dP.addEventListener('input', (e) => syncP(e.target.value));
        if (rP) rP.addEventListener('input', (e) => syncP(e.target.value));

        dH.addEventListener('input', (e) => syncH(e.target.value));
        if (rH) rH.addEventListener('input', (e) => syncH(e.target.value));

        document.querySelectorAll('[data-gfc-fuel]').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('[data-gfc-fuel]').forEach(b => b.classList.remove('is-selected'));
                btn.classList.add('is-selected');
                syncP(btn.getAttribute('data-gfc-price'));
                syncB(btn.getAttribute('data-gfc-burn'));
            });
        });

        document.getElementById('gfcCopyBtn').addEventListener('click', () => {
            const txt = `VoltMetrics Generator Fuel Result: A ${this.state.kw} kW generator supplying ${this.state.loadKw} kW load for ${this.state.hours} hours burns ${document.getElementById('gfcResTotalGal').textContent} of fuel, costing ${document.getElementById('gfcResTotalCost').textContent} (${document.getElementById('gfcResHourlyCost').textContent}). Effective electricity cost: ${document.getElementById('gfcResKwhCost').textContent}.`;
            navigator.clipboard.writeText(txt);
            document.getElementById('gfcCopyBtn').textContent = 'Copied!';
            setTimeout(() => { document.getElementById('gfcCopyBtn').textContent = 'Copy Generator Fuel Summary'; }, 2000);
        });

        this.calc();
    },

    calc() {
        const hourlyCost = this.state.burn * this.state.price;
        const totalGal = this.state.burn * this.state.hours;
        const totalCost = totalGal * this.state.price;

        // Cost per generated kWh based on actual connected load kW
        const activeLoad = this.state.loadKw > 0 ? this.state.loadKw : this.state.kw;
        const costPerKwh = activeLoad > 0 ? (hourlyCost / activeLoad) : 0;

        const threeDayGal = this.state.burn * 72;
        const threeDayCost = threeDayGal * this.state.price;

        document.getElementById('gfcResTotalCost').textContent = CurrencyManager.formatCost(totalCost);
        document.getElementById('gfcResTotalGal').textContent = totalGal.toFixed(1) + ' gallons';
        document.getElementById('gfcResHourlyCost').textContent = CurrencyManager.formatCost(hourlyCost) + '/hr';
        const burnLabel = document.getElementById('gfcResBurnRateLabel');
        if (burnLabel) burnLabel.textContent = this.state.burn.toFixed(2) + ' gal/hr';
        document.getElementById('gfcResKwhCost').textContent = CurrencyManager.formatCost(costPerKwh) + '/kWh';
        document.getElementById('gfcResThreeDayCost').textContent = CurrencyManager.formatCost(threeDayCost);
        document.getElementById('gfcResThreeDayGal').textContent = threeDayGal.toFixed(1) + ' gallons needed in reserve';
    }
};

document.addEventListener('DOMContentLoaded', () => GenFuelCalc.init());
</script>

</body>
</html>
