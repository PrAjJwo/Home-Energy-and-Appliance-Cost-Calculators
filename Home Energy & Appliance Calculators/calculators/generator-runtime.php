<?php
require_once __DIR__ . '/../config/site_config.php';
require_once __DIR__ . '/../config/rates.php';
require_once __DIR__ . '/../includes/seo_helper.php';

$page_title = "Generator Runtime Calculator - Fuel Tank Hours Estimator";
$meta_description = "Calculate portable and standby generator runtime hours per tank of fuel based on electrical load percentage, tank capacity, and wattage draw.";
$focus_keyword = "generator runtime calculator";
$canonical_path = "calculators/generator-runtime.php";

$custom_schema = [
    '@type' => 'WebApplication',
    'name' => $page_title,
    'description' => $meta_description,
    'featureList' => [
        'Electrical Load Percentage and Wattage Demand Sizing',
        'Gasoline, Propane, and Diesel Fuel Tank Runtime Projections',
        'Emergency Blackout Outage Fuel Planning'
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
        <span style="color: var(--emerald-700); font-weight: 700;">Generator Runtime Calculator</span>
    </nav>
</div>

<main class="section-padding" style="padding-top: 24px;">
    <div class="container">
        <div style="margin-bottom: 30px; display: grid; grid-template-columns: 1.25fr 0.75fr; gap: 32px; align-items: center;">
            <div>
                <span class="section-tag">Category 3: Backup Power &bull; Popular Pick &bull; Active Tool</span>
                <h1 style="font-size: 2.5rem; letter-spacing: -0.02em; margin-bottom: 12px; color: var(--slate-900);">
                    Generator Runtime Calculator
                </h1>
                <p style="font-size: 1.125rem; color: var(--slate-600); line-height: 1.6;">
                    During severe weather storms and emergency power outages, knowing exactly how many hours your generator will run before needing a refill is essential for home safety. Model your electrical load and tank volume to project total runtime.
                </p>
            </div>
            <div style="border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--border-subtle); box-shadow: var(--shadow-md);">
                <img src="/assets/images/backup_power_generator.jpg" 
                     alt="Home emergency backup generator and battery storage setup diagram"
                     width="1280" height="720" loading="eager">
            </div>
        </div>

        <div class="calculator-wrapper">
            <!-- Generator Presets -->
            <div class="calc-presets-section">
                <div class="presets-header">
                    <span class="presets-title">Common Generator Sizing Presets:</span>
                    <span class="presets-hint">Pre-loads tank size and fuel burn curves</span>
                </div>
                <div class="presets-scroll">
                    <button type="button" class="preset-chip" data-gen-cap="2200" data-gen-tank="1.1" data-burn-25="0.075" data-burn-50="0.120" data-burn-75="0.174" data-burn-100="0.228" data-gen-name="2,200W Inverter Generator (Tailgate / Camping)">
                        2,200W Inverter (1.1 gal tank)
                    </button>
                    <button type="button" class="preset-chip is-selected" data-gen-cap="4500" data-gen-tank="3.4" data-burn-25="0.228" data-burn-50="0.380" data-burn-75="0.551" data-burn-100="0.722" data-gen-name="4,500W Dual-Fuel Generator (Emergency Essentials)">
                        4,500W Generator (3.4 gal tank)
                    </button>
                    <button type="button" class="preset-chip" data-gen-cap="7500" data-gen-tank="6.5" data-burn-25="0.390" data-burn-50="0.650" data-burn-75="0.943" data-burn-100="1.235" data-gen-name="7,500W Portable Generator (Well Pump & Fridge)">
                        7,500W Generator (6.5 gal tank)
                    </button>
                    <button type="button" class="preset-chip" data-gen-cap="12000" data-gen-tank="8.0" data-burn-25="0.660" data-burn-50="1.100" data-burn-75="1.595" data-burn-100="2.090" data-gen-name="12,000W Whole-Home Standby (Central AC & Subpanel)">
                        12,000W Heavy Generator (8.0 gal tank)
                    </button>
                </div>
            </div>

            <div class="calc-grid">
                <!-- Inputs -->
                <div class="calc-inputs-col">
                    <h2 style="font-size: 1.25rem; color: var(--slate-800);">Generator Specifications:</h2>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="genTankInput" class="calc-label">Fuel Tank Capacity (Gallons):</label>
                            <span class="calc-value-badge highlight" id="genTankBadge">3.4 Gallons</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="genTankInput" class="calc-number-input" value="3.4" min="0.5" max="30" step="0.1">
                            <span class="input-suffix">Gallons</span>
                        </div>
                        <input type="range" id="genTankRange" class="calc-range" min="1" max="15" step="0.1" value="3.4">
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="genLoadPctInput" class="calc-label">Average Electrical Load Percentage:</label>
                            <span class="calc-value-badge" id="genLoadPctBadge">50% load</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="genLoadPctInput" class="calc-number-input" value="50" min="10" max="100" step="5">
                            <span class="input-suffix">% Load</span>
                        </div>
                        <input type="range" id="genLoadPctRange" class="calc-range" min="20" max="100" step="5" value="50">
                        <span class="calc-help">Higher connected loads require more fuel to maintain engine RPM and 120V/240V frequency.</span>
                    </div>

                    <div class="calc-group" style="background: var(--slate-50); padding: 12px; border-radius: var(--radius-md); border: 1px solid var(--border-subtle);">
                        <div class="calc-label-row">
                            <label class="calc-label" style="margin-bottom: 4px;">Calibrated Load Fuel Burn Rates (gal/hr):</label>
                            <span class="calc-value-badge" id="genBurnBadge">50% Load: 0.38 gal/hr</span>
                        </div>
                        <span class="calc-help" style="margin-bottom: 8px; display: block; font-size: 0.75rem;">
                            Piecewise linear interpolation calculates burn rates for any load between calibrated points.
                        </span>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                            <div>
                                <label for="genBurn25Input" style="font-size: 0.75rem; color: var(--slate-600); font-weight: 700; display: block;">25% Load (gal/hr):</label>
                                <input type="number" id="genBurn25Input" class="calc-number-input" value="0.228" min="0.02" max="3.0" step="0.001" style="font-size: 0.8125rem; padding: 6px 8px;">
                            </div>
                            <div>
                                <label for="genBurnInput" style="font-size: 0.75rem; color: var(--slate-600); font-weight: 700; display: block;">50% Load (gal/hr):</label>
                                <input type="number" id="genBurnInput" class="calc-number-input" value="0.380" min="0.05" max="3.5" step="0.001" style="font-size: 0.8125rem; padding: 6px 8px;">
                            </div>
                            <div>
                                <label for="genBurn75Input" style="font-size: 0.75rem; color: var(--slate-600); font-weight: 700; display: block;">75% Load (gal/hr):</label>
                                <input type="number" id="genBurn75Input" class="calc-number-input" value="0.551" min="0.08" max="4.5" step="0.001" style="font-size: 0.8125rem; padding: 6px 8px;">
                            </div>
                            <div>
                                <label for="genBurn100Input" style="font-size: 0.75rem; color: var(--slate-600); font-weight: 700; display: block;">100% Load (gal/hr):</label>
                                <input type="number" id="genBurn100Input" class="calc-number-input" value="0.722" min="0.10" max="6.0" step="0.001" style="font-size: 0.8125rem; padding: 6px 8px;">
                            </div>
                        </div>
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="genPriceInput" class="calc-label">Fuel Price per Gallon (<span data-currency-symbol>$</span>/gal):</label>
                            <span class="calc-value-badge">Benchmark Active</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="genPriceInput" class="calc-number-input" value="4.071" min="1.0" max="10.0" step="0.001">
                            <span class="input-suffix">per gallon</span>
                        </div>
                    </div>
                </div>

                <!-- Results Column -->
                <div class="calc-results-col">
                    <div class="results-header">
                        <h3 class="results-title">Projected Runtime</h3>
                        <span class="results-badge">Full Tank</span>
                    </div>

                    <div class="cost-card-primary">
                        <div class="cost-period-label">Estimated Continuous Runtime</div>
                        <div class="cost-big-number">
                            <span id="genResHours" style="color: var(--emerald-400);">8.9 Hours</span>
                        </div>
                        <div class="cost-sub-kwh">
                            Burning <strong id="genResBurnRate">0.38 gal</strong> of fuel per hour
                        </div>
                    </div>

                    <div class="results-breakdown-grid">
                        <div class="breakdown-box">
                            <span class="bb-label">Cost per Hour</span>
                            <span class="bb-value" id="genResHourlyCost">$1.55/hr</span>
                            <span class="bb-sub">In fuel expense</span>
                        </div>
                    <div class="results-breakdown-grid">
                        <div class="breakdown-box">
                            <span class="bb-label">Full Tank Cost</span>
                            <span class="bb-value" id="genResTankCost">$13.84</span>
                            <span class="bb-sub">To fill tank</span>
                        </div>
                        <div class="breakdown-box">
                            <span class="bb-label">Interpolated Burn Rate</span>
                            <span class="bb-value" id="genResInterpRate" style="color: var(--emerald-400);">0.38 gal/hr</span>
                            <span class="bb-sub" id="genResInterpSub">At 50% load</span>
                        </div>
                    </div>

                    <div class="breakdown-box" style="margin-bottom: 20px;">
                        <span class="bb-label">Load Interpolation Details</span>
                        <span class="bb-value" style="font-size: 0.9375rem; color: var(--emerald-400);" id="genResInterpDetail">
                            50% burn: 0.380 &bull; 75% burn: 0.551 (frac 0%)
                        </span>
                        <span class="bb-sub" id="genResInterpNote">Approximate fuel consumption. Actual fuel consumption varies by generator size, engine design, fuel type, altitude, maintenance, and load profile.</span>
                    </div>

                    <div class="breakdown-box" style="margin-bottom: 20px;">
                        <span class="bb-label">24-Hour Continuous Run Fuel</span>
                        <span class="bb-value" style="font-size: 1.5rem; color: var(--amber-400);" id="genResDayCost">$37.13</span>
                        <span class="bb-sub" id="genResDayGal">9.1 gallons needed per 24 hours</span>
                    </div>

                    <button type="button" class="btn btn-share" id="genCopyBtn">
                        Copy Generator Runtime Summary
                    </button>
                </div>
            </div>
        </div>

        <section class="calc-content-section">
            <div class="calc-content-card">
                <h2 class="content-heading-2">How to Extend Generator Runtime in a Blackout</h2>
                <p class="content-p">
                    To maximize fuel efficiency during an emergency power outage, switch off unnecessary circuits such as water heaters, hot tubs, and decorative lighting. Modern inverter generators feature an "Eco Throttle" mode that automatically slows engine RPM when electrical loads drop, reducing fuel consumption significantly.
                </p>
                <h3 class="content-heading-3">Engine Specific Fuel Consumption Load Curve</h3>
                <p class="content-p">
                    Small four-stroke utility engines do not scale fuel burn linearly with zero-idle overhead. Due to fixed mechanical friction, pumping losses, and rotor excitation, an idling generator typically consumes about 40% of its 50%-load fuel rate. Our piecewise interpolation accurately reflects standard small engine curves: 0.60&times; at 25% load, 1.00&times; at 50% load, 1.45&times; at 75% load, and 1.90&times; at 100% full continuous rated output.
                </p>
            </div>
        </section>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

<script>
const GenRuntimeCalc = {
    state: {
        tank: 3.4,
        loadPct: 50,
        burn25: 0.228,
        burn50: 0.380,
        burn75: 0.551,
        burn100: 0.722,
        fuelPrice: 4.071
    },
    init() {
        const dT = document.getElementById('genTankInput');
        const rT = document.getElementById('genTankRange');
        const bT = document.getElementById('genTankBadge');

        const dL = document.getElementById('genLoadPctInput');
        const rL = document.getElementById('genLoadPctRange');
        const bL = document.getElementById('genLoadPctBadge');

        const dB25 = document.getElementById('genBurn25Input');
        const dB50 = document.getElementById('genBurnInput');
        const dB75 = document.getElementById('genBurn75Input');
        const dB100 = document.getElementById('genBurn100Input');
        const bB = document.getElementById('genBurnBadge');

        const dP = document.getElementById('genPriceInput');

        const syncT = (val) => {
            const parsed = parseFloat(val);
            this.state.tank = Math.max(0, isNaN(parsed) ? 3.4 : parsed);
            dT.value = this.state.tank;
            rT.value = Math.min(this.state.tank, 15);
            bT.textContent = this.state.tank + ' Gallons';
            this.calc();
        };

        const syncL = (val) => {
            const parsed = parseFloat(val);
            this.state.loadPct = Math.min(100, Math.max(0, isNaN(parsed) ? 50 : parsed));
            dL.value = this.state.loadPct;
            rL.value = this.state.loadPct;
            bL.textContent = this.state.loadPct + '% load';
            this.calc();
        };

        const syncB25 = (val) => {
            const parsed = parseFloat(val);
            this.state.burn25 = Math.max(0.01, isNaN(parsed) ? 0.228 : parsed);
            if (dB25) dB25.value = this.state.burn25;
            this.calc();
        };

        const syncB50 = (val) => {
            const parsed = parseFloat(val);
            this.state.burn50 = Math.max(0.01, isNaN(parsed) ? 0.380 : parsed);
            if (dB50) dB50.value = this.state.burn50;
            if (bB) bB.textContent = `50% Load: ${this.state.burn50.toFixed(2)} gal/hr`;
            this.calc();
        };

        const syncB75 = (val) => {
            const parsed = parseFloat(val);
            this.state.burn75 = Math.max(0.01, isNaN(parsed) ? 0.551 : parsed);
            if (dB75) dB75.value = this.state.burn75;
            this.calc();
        };

        const syncB100 = (val) => {
            const parsed = parseFloat(val);
            this.state.burn100 = Math.max(0.01, isNaN(parsed) ? 0.722 : parsed);
            if (dB100) dB100.value = this.state.burn100;
            this.calc();
        };

        dT.addEventListener('input', (e) => syncT(e.target.value));
        rT.addEventListener('input', (e) => syncT(e.target.value));

        dL.addEventListener('input', (e) => syncL(e.target.value));
        rL.addEventListener('input', (e) => syncL(e.target.value));

        if (dB25) dB25.addEventListener('input', (e) => syncB25(e.target.value));
        if (dB50) dB50.addEventListener('input', (e) => syncB50(e.target.value));
        if (dB75) dB75.addEventListener('input', (e) => syncB75(e.target.value));
        if (dB100) dB100.addEventListener('input', (e) => syncB100(e.target.value));

        dP.addEventListener('input', (e) => {
            const parsed = parseFloat(e.target.value);
            this.state.fuelPrice = Math.max(0, isNaN(parsed) ? 4.071 : parsed);
            this.calc();
        });

        document.querySelectorAll('[data-burn-50]').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('[data-burn-50]').forEach(b => b.classList.remove('is-selected'));
                btn.classList.add('is-selected');
                syncT(btn.getAttribute('data-gen-tank'));
                syncB25(btn.getAttribute('data-burn-25'));
                syncB50(btn.getAttribute('data-burn-50'));
                syncB75(btn.getAttribute('data-burn-75'));
                syncB100(btn.getAttribute('data-burn-100'));
            });
        });

        document.getElementById('genCopyBtn').addEventListener('click', () => {
            const txt = `VoltMetrics Generator Runtime: ${this.state.tank} gal tank at ${this.state.loadPct}% load delivers ${document.getElementById('genResHours').textContent} of continuous power (${document.getElementById('genResHourlyCost').textContent}/hr in fuel).`;
            navigator.clipboard.writeText(txt);
            document.getElementById('genCopyBtn').textContent = 'Copied!';
            setTimeout(() => { document.getElementById('genCopyBtn').textContent = 'Copy Generator Runtime Summary'; }, 2000);
        });

        this.calc();
    },

    getInterpolatedBurnRate(loadPct) {
        // Piecewise linear interpolation between calibrated manufacturer test points
        // Idle (0% load) estimate ~ 67% of 25% load rate (engine friction/excitation overhead)
        const idleBurn = this.state.burn25 * 0.67;
        const points = [
            { load: 0, burn: idleBurn },
            { load: 25, burn: this.state.burn25 },
            { load: 50, burn: this.state.burn50 },
            { load: 75, burn: this.state.burn75 },
            { load: 100, burn: this.state.burn100 }
        ];

        if (loadPct <= 0) {
            return { burn: points[0].burn, lowerLoad: 0, lowerBurn: points[0].burn, upperLoad: 25, upperBurn: points[1].burn, frac: 0 };
        }
        if (loadPct >= 100) {
            return { burn: points[points.length - 1].burn, lowerLoad: 75, lowerBurn: points[3].burn, upperLoad: 100, upperBurn: points[4].burn, frac: 1.0 };
        }

        for (let i = 0; i < points.length - 1; i++) {
            if (loadPct >= points[i].load && loadPct <= points[i + 1].load) {
                const range = points[i + 1].load - points[i].load;
                const frac = range > 0 ? (loadPct - points[i].load) / range : 0;
                const burn = points[i].burn + frac * (points[i + 1].burn - points[i].burn);
                return {
                    burn: burn,
                    lowerLoad: points[i].load,
                    lowerBurn: points[i].burn,
                    upperLoad: points[i + 1].load,
                    upperBurn: points[i + 1].burn,
                    frac: frac
                };
            }
        }
        return { burn: this.state.burn50, lowerLoad: 50, lowerBurn: this.state.burn50, upperLoad: 50, upperBurn: this.state.burn50, frac: 0 };
    },

    calc() {
        const interp = this.getInterpolatedBurnRate(this.state.loadPct);
        const actualBurnRate = interp.burn;
        const runtimeHours = actualBurnRate > 0 ? (this.state.tank / actualBurnRate) : 0;
        const hourlyCost = actualBurnRate * this.state.fuelPrice;
        const tankCost = this.state.tank * this.state.fuelPrice;
        const galPer24Hrs = actualBurnRate * 24;
        const dayCost = galPer24Hrs * this.state.fuelPrice;

        document.getElementById('genResHours').textContent = runtimeHours.toFixed(1) + ' Hours';
        document.getElementById('genResBurnRate').textContent = actualBurnRate.toFixed(3) + ' gal';
        document.getElementById('genResInterpRate').textContent = actualBurnRate.toFixed(3) + ' gal/hr';
        document.getElementById('genResInterpSub').textContent = `At ${this.state.loadPct}% electrical load`;

        const fracPct = (interp.frac * 100).toFixed(1);
        document.getElementById('genResInterpDetail').textContent = 
            `Between ${interp.lowerLoad}% (${interp.lowerBurn.toFixed(3)}) & ${interp.upperLoad}% (${interp.upperBurn.toFixed(3)}) @ frac ${fracPct}%`;

        document.getElementById('genResHourlyCost').textContent = CurrencyManager.formatCost(hourlyCost) + '/hr';
        document.getElementById('genResTankCost').textContent = CurrencyManager.formatCost(tankCost);
        document.getElementById('genResDayCost').textContent = CurrencyManager.formatCost(dayCost) + ' / day';
        document.getElementById('genResDayGal').textContent = galPer24Hrs.toFixed(1) + ' gallons needed per 24 hours';
    }
};

document.addEventListener('DOMContentLoaded', () => GenRuntimeCalc.init());
</script>

</body>
</html>
