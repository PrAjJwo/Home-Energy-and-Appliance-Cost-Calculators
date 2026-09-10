<?php
require_once __DIR__ . '/../config/site_config.php';
require_once __DIR__ . '/../config/rates.php';
require_once __DIR__ . '/../includes/seo_helper.php';

$page_title = "Refrigerator Energy Cost Calculator - 2026 Fridge Power";
$meta_description = "Free refrigerator energy cost calculator to estimate monthly fridge power bills, compare Energy Star models, and calculate old refrigerator replacement ROI.";
$focus_keyword = "refrigerator energy cost calculator";
$canonical_path = "calculators/refrigerator-energy-cost.php";

$custom_schema = [
    '@type' => 'WebApplication',
    'name' => $page_title,
    'description' => $meta_description,
    'featureList' => [
        'Door Configuration and Cubic Feet Sizing Models',
        'Compressor Duty Cycle and Inverter Linear Compressor Simulation',
        'Older Fridge Replacement ROI Savings Analysis'
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
        <span style="color: var(--emerald-700); font-weight: 700;">Refrigerator Energy Cost Calculator</span>
    </nav>
</div>

<main class="section-padding" style="padding-top: 24px;">
    <div class="container">
        <div style="margin-bottom: 30px;">
            <span class="section-tag">Category 1: Everyday Appliances &bull; Active Tool</span>
            <h1 style="font-size: 2.5rem; letter-spacing: -0.02em; margin-bottom: 12px; color: var(--slate-900);">
                Refrigerator Energy Cost Calculator
            </h1>
            <p style="font-size: 1.125rem; color: var(--slate-600); max-width: 760px; line-height: 1.6;">
                Refrigerators run 24 hours a day, 365 days a year, making them one of your home's most persistent electricity consumers. Calculate your exact monthly bill, inspect compressor duty cycles, and calculate payback when replacing an older unit.
            </p>
        </div>

        <div class="calculator-wrapper">
            <!-- Style Presets -->
            <div class="calc-presets-section">
                <div class="presets-header">
                    <span class="presets-title">1. Select Refrigerator Style & Capacity:</span>
                    <span class="presets-hint">Loads EnergyGuide FTC consumption standards</span>
                </div>
                <div class="presets-scroll">
                    <button type="button" class="preset-chip is-selected" data-fridge-kwh="380" data-fridge-watts="140" data-fridge-name="Top-Freezer (18 cu ft)">
                        Top-Freezer (18 cu ft, 380 kWh/yr)
                    </button>
                    <button type="button" class="preset-chip" data-fridge-kwh="540" data-fridge-watts="160" data-fridge-name="Bottom-Freezer (22 cu ft)">
                        Bottom-Freezer (22 cu ft, 540 kWh/yr)
                    </button>
                    <button type="button" class="preset-chip" data-fridge-kwh="620" data-fridge-watts="180" data-fridge-name="French Door with Ice (26 cu ft)">
                        French Door with Ice (26 cu ft, 620 kWh/yr)
                    </button>
                    <button type="button" class="preset-chip" data-fridge-kwh="690" data-fridge-watts="200" data-fridge-name="Side-by-Side Through-Door (25 cu ft)">
                        Side-by-Side Dispenser (25 cu ft, 690 kWh/yr)
                    </button>
                    <button type="button" class="preset-chip" data-fridge-kwh="220" data-fridge-watts="80" data-fridge-name="Compact Mini Fridge (4.5 cu ft)">
                        Compact Mini Fridge (4.5 cu ft, 220 kWh/yr)
                    </button>
                    <button type="button" class="preset-chip" data-fridge-kwh="1150" data-fridge-watts="350" data-fridge-name="Vintage Pre-2000s Fridge (21 cu ft)">
                        Vintage Pre-2000s Fridge (1,150 kWh/yr)
                    </button>
                </div>
            </div>

            <div class="calc-grid">
                <!-- Inputs -->
                <div class="calc-inputs-col">
                    <h2 style="font-size: 1.25rem; color: var(--slate-800);">Refrigerator Specifications:</h2>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="fridgeKwhInput" class="calc-label">Annual Energy Consumption (kWh/year):</label>
                            <span class="calc-value-badge highlight" id="fridgeKwhBadge">380 kWh/yr</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="fridgeKwhInput" class="calc-number-input" value="380" min="100" max="2500">
                            <span class="input-suffix">kWh/yr</span>
                        </div>
                        <input type="range" id="fridgeKwhRange" class="calc-range" min="150" max="1500" step="10" value="380">
                        <span class="calc-help">Find this number on your yellow EnergyGuide label or manufacturer sticker.</span>
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="fridgeRateInput" class="calc-label">Electricity Rate (<span data-currency-symbol>$</span>/kWh):</label>
                            <span class="calc-value-badge">Benchmark Active</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="fridgeRateInput" class="calc-number-input" value="0.1830" min="0.01" max="2.00" step="0.0001">
                            <span class="input-suffix">per kWh</span>
                        </div>
                    </div>

                    <!-- Upgrade ROI Comparison Section -->
                    <div style="background: var(--slate-50); border: 1px solid var(--border-subtle); padding: 16px; border-radius: var(--radius-md); margin-top: 8px;">
                        <span style="font-size: 0.8125rem; font-weight: 700; color: var(--slate-800); display: block; margin-bottom: 6px;">Compare Against an Older Baseline Model:</span>
                        <div style="margin-bottom: 8px;">
                            <label for="fridgeOldAgeSelect" style="font-size: 0.75rem; color: var(--slate-600); display: block; margin-bottom: 4px;">Select Era or Enter Custom kWh Below:</label>
                            <select id="fridgeOldAgeSelect" class="state-select">
                                <option value="450">Standard Non-Certified Refrigerator (450 kWh/yr)</option>
                                <option value="650">Early 2010s Refrigerator (650 kWh/yr)</option>
                                <option value="850" selected>Late 1990s Garage Refrigerator (850 kWh/yr)</option>
                                <option value="1200">Pre-1995 Vintage Refrigerator (1,200 kWh/yr)</option>
                                <option value="custom">Custom Old Refrigerator kWh</option>
                            </select>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="fridgeOldKwhInput" class="calc-number-input" value="850" min="50" max="3000" step="10">
                            <span class="input-suffix">Old kWh/yr</span>
                        </div>
                    </div>
                </div>

                <!-- Results -->
                <div class="calc-results-col">
                    <div class="results-header">
                        <h3 class="results-title">Annual Fridge Cost</h3>
                        <span class="results-badge">Live</span>
                    </div>

                    <div class="cost-card-primary">
                        <div class="cost-period-label">Estimated Yearly Cost</div>
                        <div class="cost-big-number">
                            <span id="fridgeResAnnualCost">$0.00</span>
                        </div>
                        <div class="cost-sub-kwh">
                            Costing <strong id="fridgeResMonthlyCost" style="color: var(--emerald-400);">$0.00</strong> / month
                        </div>
                    </div>

                    <div class="results-breakdown-grid">
                        <div class="breakdown-box">
                            <span class="bb-label">Daily Cost</span>
                            <span class="bb-value" id="fridgeResDailyCost">$0.00</span>
                            <span class="bb-sub" id="fridgeResDailyKwh">1.04 kWh/day</span>
                        </div>
                        <div class="breakdown-box">
                            <span class="bb-label">10-Year Lifetime</span>
                            <span class="bb-value" id="fridgeResTenYearCost">$0.00</span>
                            <span class="bb-sub">Total operational cost</span>
                        </div>
                    </div>

                    <div class="comparison-section">
                        <div class="comparison-header">
                            <span class="star-icon">&#9733;</span>
                            <span class="comparison-title">Replacement Savings</span>
                        </div>
                        <p style="font-size: 0.8125rem; color: var(--slate-300); margin-bottom: 6px;">
                            Replacing the older comparison unit saves:
                        </p>
                        <div style="font-size: 1.125rem; font-weight: 800; color: var(--emerald-400);" id="fridgeResSavings">
                            $0.00 / year
                        </div>
                    </div>

                    <button type="button" class="btn btn-share" id="fridgeCopyBtn">
                        Copy Fridge Cost Summary
                    </button>
                </div>
            </div>
        </div>

        <section class="calc-content-section">
            <div class="calc-content-card">
                <h2 class="content-heading-2">How Much Power Does a Refrigerator Use?</h2>
                <p class="content-p">
                    Modern refrigerators manufactured under current Department of Energy standards consume roughly 350 to 650 kWh annually thanks to brushless variable-speed inverter compressors, advanced microprocessor defrost sensors, and vacuum-sealed insulation panels.
                </p>
                <p class="content-p">
                    Energy Star certified refrigerators are required to be at least 10% more energy efficient than the federal minimum efficiency standard, rather than any universal fixed percentage. Keeping an old 1990s refrigerator running as a secondary unit in an unconditioned garage often draws 850 to 1,200+ kWh per year, costing $150 to $220 annually at current rates.
                </p>
            </div>
        </section>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

<script>
const FridgeCalc = {
    state: { kwh: 380, rate: 0.1830, oldKwh: 850 },
    init() {
        const dK = document.getElementById('fridgeKwhInput');
        const rK = document.getElementById('fridgeKwhRange');
        const bK = document.getElementById('fridgeKwhBadge');
        const dR = document.getElementById('fridgeRateInput');
        const sO = document.getElementById('fridgeOldAgeSelect');
        const dOldK = document.getElementById('fridgeOldKwhInput');

        const syncK = (val) => {
            this.state.kwh = Math.max(50, parseFloat(val) || 380);
            dK.value = this.state.kwh;
            rK.value = Math.min(this.state.kwh, 1500);
            bK.textContent = this.state.kwh + ' kWh/yr';
            this.calc();
        };

        dK.addEventListener('input', (e) => syncK(e.target.value));
        rK.addEventListener('input', (e) => syncK(e.target.value));

        dR.addEventListener('input', (e) => {
            const parsed = parseFloat(e.target.value);
            this.state.rate = Math.max(0, isNaN(parsed) ? 0.1830 : parsed);
            this.calc();
        });

        if (sO) {
            sO.addEventListener('change', (e) => {
                if (e.target.value !== 'custom') {
                    const v = parseFloat(e.target.value) || 850;
                    this.state.oldKwh = v;
                    if (dOldK) dOldK.value = v;
                    this.calc();
                }
            });
        }

        if (dOldK) {
            dOldK.addEventListener('input', (e) => {
                this.state.oldKwh = Math.max(0, parseFloat(e.target.value) || 0);
                if (sO) sO.value = 'custom';
                this.calc();
            });
        }

        document.querySelectorAll('[data-fridge-kwh]').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('[data-fridge-kwh]').forEach(b => b.classList.remove('is-selected'));
                btn.classList.add('is-selected');
                syncK(btn.getAttribute('data-fridge-kwh'));
            });
        });

        window.addEventListener('currencyChanged', (e) => {
            this.state.rate = e.detail.data.defaultKwh;
            dR.value = this.state.rate;
            this.calc();
        });

        document.getElementById('fridgeCopyBtn').addEventListener('click', () => {
            const txt = `VoltMetrics Refrigerator Energy Result: Consumes ${this.state.kwh} kWh/yr, costing ${document.getElementById('fridgeResMonthlyCost').textContent}/mo (${document.getElementById('fridgeResAnnualCost').textContent}/yr).`;
            navigator.clipboard.writeText(txt);
            document.getElementById('fridgeCopyBtn').textContent = 'Copied!';
            setTimeout(() => { document.getElementById('fridgeCopyBtn').textContent = 'Copy Fridge Cost Summary'; }, 2000);
        });

        this.calc();
    },

    calc() {
        const annualCost = this.state.kwh * this.state.rate;
        const monthlyCost = annualCost / 12;
        const dailyKwh = this.state.kwh / 365;
        const dailyCost = annualCost / 365;
        const tenYearCost = annualCost * 10;
        const savingsAnnual = Math.max(0, (this.state.oldKwh - this.state.kwh) * this.state.rate);

        document.getElementById('fridgeResAnnualCost').textContent = CurrencyManager.formatCost(annualCost);
        document.getElementById('fridgeResMonthlyCost').textContent = CurrencyManager.formatCost(monthlyCost);
        document.getElementById('fridgeResDailyCost').textContent = CurrencyManager.formatCost(dailyCost);
        document.getElementById('fridgeResDailyKwh').textContent = dailyKwh.toFixed(2) + ' kWh/day';
        document.getElementById('fridgeResTenYearCost').textContent = CurrencyManager.formatCost(tenYearCost);
        document.getElementById('fridgeResSavings').textContent = CurrencyManager.formatCost(savingsAnnual) + ' / year';
    }
};

document.addEventListener('DOMContentLoaded', () => FridgeCalc.init());
</script>

</body>
</html>
