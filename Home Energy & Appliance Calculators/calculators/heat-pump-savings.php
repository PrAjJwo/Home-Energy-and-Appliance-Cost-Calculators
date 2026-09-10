<?php
require_once __DIR__ . '/../config/site_config.php';
require_once __DIR__ . '/../config/rates.php';
require_once __DIR__ . '/../includes/seo_helper.php';

$page_title = "Heat Pump Savings Calculator - Baseboard vs Heat Pump";
$meta_description = "Use our heat pump savings calculator to model annual heating bill reductions when switching from electric resistance baseboards to high-COP heat pumps.";
$focus_keyword = "heat pump savings calculator";
$canonical_path = "calculators/heat-pump-savings.php";

$custom_schema = [
    '@type' => 'WebApplication',
    'name' => $page_title,
    'description' => $meta_description,
    'featureList' => [
        'Heating Oil, Propane, and Electric Resistance Cost Comparison',
        'Heat Pump Seasonal COP and HSPF2 Sizing Models',
        '10-Year Cumulative Heating Bill Savings & Carbon Reduction'
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
        <span style="color: var(--emerald-700); font-weight: 700;">Heat Pump Savings Calculator</span>
    </nav>
</div>

<main class="section-padding" style="padding-top: 24px;">
    <div class="container">
        <div style="margin-bottom: 30px;">
            <span class="section-tag">Category 2: HVAC &bull; Active Tool</span>
            <h1 style="font-size: 2.5rem; letter-spacing: -0.02em; margin-bottom: 12px; color: var(--slate-900);">
                Heat Pump Savings Calculator
            </h1>
            <p style="font-size: 1.125rem; color: var(--slate-600); max-width: 760px; line-height: 1.6;">
                Modern air-source heat pumps don't create heat; they extract free ambient heat from outdoor air and transfer it indoors at up to 300% efficiency. Compare your current heating fuel expenses against a high-efficiency heat pump to determine your annual savings.
            </p>
        </div>

        <div class="calculator-wrapper">
            <!-- Quick Heating Comparison Presets -->
            <div class="calc-presets-section">
                <div class="presets-header">
                    <span class="presets-title">Compare Against Your Current Heating System:</span>
                    <span class="presets-hint">Loads benchmark fuel costs and boiler efficiencies</span>
                </div>
                <div class="presets-scroll">
                    <button type="button" class="preset-chip is-selected" data-fuel="oil" data-fuel-price="4.15" data-fuel-eff="80">
                        Heating Oil ($4.15/gal &bull; 80% boiler)
                    </button>
                    <button type="button" class="preset-chip" data-fuel="propane" data-fuel-price="3.20" data-fuel-eff="85">
                        Propane Gas ($3.20/gal &bull; 85% furnace)
                    </button>
                    <button type="button" class="preset-chip" data-fuel="electric_baseboard" data-fuel-price="0.1830" data-fuel-eff="100">
                        Electric Resistance Baseboards (COP 1.0)
                    </button>
                    <button type="button" class="preset-chip" data-fuel="nat_gas" data-fuel-price="1.45" data-fuel-eff="80">
                        Standard Natural Gas ($1.45/therm &bull; 80%)
                    </button>
                </div>
            </div>

            <div class="calc-grid">
                <!-- Inputs -->
                <div class="calc-inputs-col">
                    <h2 style="font-size: 1.25rem; color: var(--slate-800);">Heating Parameters:</h2>

                    <!-- Custom Old Heating System Inputs -->
                    <div class="calc-group" style="background: var(--slate-50); padding: 12px; border-radius: var(--radius-md); border: 1px solid var(--border-subtle); margin-bottom: 16px;">
                        <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 8px;">
                            <label class="calc-label" style="margin: 0;">Old Heating System Specifications:</label>
                            <span class="calc-value-badge highlight" id="hpOldFuelBadge">Heating Oil: $4.15/gal &bull; 80%</span>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                            <div>
                                <label for="hpFuelPriceInput" id="hpFuelPriceLabel" style="font-size: 0.75rem; color: var(--slate-600); font-weight: 700; display: block; margin-bottom: 4px;">
                                    Current Fuel Price ($/gal):
                                </label>
                                <div class="calc-input-wrapper">
                                    <input type="number" id="hpFuelPriceInput" class="calc-number-input" value="4.15" min="0" max="100.0" step="0.01">
                                </div>
                            </div>
                            <div>
                                <label for="hpFuelEffInput" id="hpFuelEffLabel" style="font-size: 0.75rem; color: var(--slate-600); font-weight: 700; display: block; margin-bottom: 4px;">
                                    System Efficiency (AFUE %):
                                </label>
                                <div class="calc-input-wrapper">
                                    <input type="number" id="hpFuelEffInput" class="calc-number-input" value="80" min="40" max="100" step="1">
                                    <span class="input-suffix">%</span>
                                </div>
                            </div>
                        </div>
                        <span class="calc-help" style="margin-top: 6px; display: block; font-size: 0.75rem;">
                            Prefilled from chosen preset. You can manually adjust fuel price and boiler/furnace efficiency.
                        </span>
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="hpLoadInput" class="calc-label">Annual Home Heating Load (Million BTUs):</label>
                            <span class="calc-value-badge highlight" id="hpLoadBadge">60 MMBtu/yr</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="hpLoadInput" class="calc-number-input" value="60" min="20" max="150" step="5">
                            <span class="input-suffix">MMBtu</span>
                        </div>
                        <input type="range" id="hpLoadRange" class="calc-range" min="30" max="120" step="5" value="60">
                        <span class="calc-help">Approximate: 1,500 sq ft home = ~50 MMBtu; 2,000 sq ft = ~65 MMBtu; 2,500+ sq ft = ~85 MMBtu.</span>
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="hpCopInput" class="calc-label">Heat Pump Average Seasonal Efficiency (COP):</label>
                            <span class="calc-value-badge" id="hpCopBadge">3.0 COP</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="hpCopInput" class="calc-number-input" value="3.0" min="2.0" max="4.5" step="0.1">
                            <span class="input-suffix">COP (300%)</span>
                        </div>
                        <input type="range" id="hpCopRange" class="calc-range" min="2.0" max="4.0" step="0.1" value="3.0">
                        <span class="calc-help">A COP of 3.0 means the heat pump outputs 3 units of heat for every 1 unit of electricity consumed.</span>
                    </div>

                    <!-- Auxiliary Resistance Backup Heat -->
                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="hpAuxInput" class="calc-label">Auxiliary Resistance Backup Heat Share (%):</label>
                            <span class="calc-value-badge" id="hpAuxBadge">5% aux backup</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="hpAuxInput" class="calc-number-input" value="5" min="0" max="40" step="1">
                            <span class="input-suffix">% of season</span>
                        </div>
                        <input type="range" id="hpAuxRange" class="calc-range" min="0" max="30" step="1" value="5">
                        <span class="calc-help">Electric resistance heat strips (COP 1.0) activate during severe cold snaps. Modern cold-climate heat pumps typically require only 0% to 10% auxiliary heat.</span>
                    </div>

                    <div class="calc-group">
                        <div class="calc-label-row">
                            <label for="hpRateInput" class="calc-label">Electricity Rate (<span data-currency-symbol>$</span>/kWh):</label>
                            <span class="calc-value-badge">Benchmark Active</span>
                        </div>
                        <div class="calc-input-wrapper">
                            <input type="number" id="hpRateInput" class="calc-number-input" value="0.1830" min="0.01" max="2.00" step="0.0001">
                            <span class="input-suffix">per kWh</span>
                        </div>
                    </div>
                </div>

                <!-- Results Column -->
                <div class="calc-results-col">
                    <div class="results-header">
                        <h3 class="results-title">Annual Savings Projection</h3>
                        <span class="results-badge">Heat Pump ROI</span>
                    </div>

                    <div class="cost-card-primary">
                        <div class="cost-period-label" id="hpResSavingsPeriodLabel">Estimated Annual Heating Savings</div>
                        <div class="cost-big-number">
                            <span id="hpResAnnualSavings" style="color: var(--emerald-400);">$0.00</span>
                        </div>
                        <div class="cost-sub-kwh" id="hpResSavingsSub">
                            Saving <strong id="hpResPercent">0%</strong> on winter heating bills
                        </div>
                    </div>

                    <div class="results-breakdown-grid">
                        <div class="breakdown-box">
                            <span class="bb-label">Current Heating Bill</span>
                            <span class="bb-value" id="hpResOldBill">$0.00</span>
                            <span class="bb-sub" id="hpOldFuelLabel">With heating oil</span>
                        </div>
                        <div class="breakdown-box">
                            <span class="bb-label">New Heat Pump Bill</span>
                            <span class="bb-value" id="hpResNewBill">$0.00</span>
                            <span class="bb-sub" id="hpNewKwhLabel">0 kWh electricity</span>
                        </div>
                    </div>

                    <div class="breakdown-box" style="margin-bottom: 20px;">
                        <span class="bb-label" id="hpResTenYearLabel">10-Year Cumulative Net Savings</span>
                        <span class="bb-value" style="font-size: 1.5rem; color: var(--emerald-400);" id="hpResTenYearSavings">$0.00</span>
                        <span class="bb-sub" id="hpResTenYearSub">Simple 10-year projection (assumes constant fuel and electricity prices)</span>
                    </div>

                    <button type="button" class="btn btn-share" id="hpCopyBtn">
                        Copy Heat Pump Savings Summary
                    </button>
                </div>
            </div>
        </div>

        <section class="calc-content-section">
            <div class="calc-content-card">
                <h2 class="content-heading-2">Why Heat Pumps Save Homeowners Money</h2>
                <p class="content-p">
                    Unlike standard furnaces that burn fuel or heat resistance coils, heat pumps leverage thermodynamic refrigerant cycles to move heat from the outdoor atmosphere into your home. Exactly 1 kilowatt-hour (kWh) of electricity produces 3,412.14 BTU of heat through direct resistance. With a high-efficiency cold-climate heat pump operating at a seasonal COP of 3.0, that same 1 kWh of electricity delivers 10,236.4 BTU of space heat.
                </p>

                <h3 class="content-heading-3">Verified Heating Fuel Heat Densities</h3>
                <ul style="margin-left: 24px; margin-bottom: 18px; color: var(--slate-700); line-height: 1.8;">
                    <li><strong>Heating Oil:</strong> 138,500 BTU per gallon</li>
                    <li><strong>Propane:</strong> 91,452 BTU per gallon</li>
                    <li><strong>Natural Gas:</strong> 100,000 BTU per therm</li>
                    <li><strong>Electricity:</strong> 3,412.14 BTU per kilowatt-hour (kWh)</li>
                </ul>
                <p class="content-p" style="font-size: 0.875rem; color: var(--slate-500);">
                    Disclaimer: 10-year financial projections are simplified estimations assuming static utility tariffs and fuel market prices over the system lifetime. Actual long-term savings will fluctuate with regional fuel commodity inflation and annual winter heating degree days.
                </p>
            </div>
        </section>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

<script>
const HeatPumpCalc = {
    state: {
        loadMmbts: 60,
        fuel: 'oil',
        fuelPrice: 4.15,
        fuelEff: 80,
        cop: 3.0,
        auxPct: 5,
        rate: 0.1830
    },
    init() {
        const dL = document.getElementById('hpLoadInput');
        const rL = document.getElementById('hpLoadRange');
        const bL = document.getElementById('hpLoadBadge');

        const dFuelPrice = document.getElementById('hpFuelPriceInput');
        const dFuelEff = document.getElementById('hpFuelEffInput');
        const bOldFuel = document.getElementById('hpOldFuelBadge');
        const lFuelPrice = document.getElementById('hpFuelPriceLabel');

        const dC = document.getElementById('hpCopInput');
        const rC = document.getElementById('hpCopRange');
        const bC = document.getElementById('hpCopBadge');

        const dA = document.getElementById('hpAuxInput');
        const rA = document.getElementById('hpAuxRange');
        const bA = document.getElementById('hpAuxBadge');

        const dR = document.getElementById('hpRateInput');

        const syncL = (val) => {
            const parsed = parseFloat(val);
            this.state.loadMmbts = Math.max(0, isNaN(parsed) ? 60 : parsed);
            dL.value = this.state.loadMmbts;
            rL.value = Math.min(this.state.loadMmbts, 120);
            bL.textContent = this.state.loadMmbts + ' MMBtu/yr';
            this.calc();
        };

        const syncC = (val) => {
            const parsed = parseFloat(val);
            this.state.cop = Math.min(5.0, Math.max(0.1, isNaN(parsed) ? 3.0 : parsed));
            dC.value = this.state.cop;
            rC.value = this.state.cop;
            bC.textContent = this.state.cop.toFixed(1) + ' COP';
            this.calc();
        };

        const syncA = (val) => {
            const parsed = parseFloat(val);
            this.state.auxPct = Math.min(50, Math.max(0, isNaN(parsed) ? 5 : parsed));
            if (dA) dA.value = this.state.auxPct;
            if (rA) rA.value = this.state.auxPct;
            if (bA) bA.textContent = this.state.auxPct + '% aux backup';
            this.calc();
        };

        dL.addEventListener('input', (e) => syncL(e.target.value));
        rL.addEventListener('input', (e) => syncL(e.target.value));

        dC.addEventListener('input', (e) => syncC(e.target.value));
        rC.addEventListener('input', (e) => syncC(e.target.value));

        if (dA) dA.addEventListener('input', (e) => syncA(e.target.value));
        if (rA) rA.addEventListener('input', (e) => syncA(e.target.value));

        if (dFuelPrice) {
            dFuelPrice.addEventListener('input', (e) => {
                const parsed = parseFloat(e.target.value);
                this.state.fuelPrice = Math.max(0, isNaN(parsed) ? 0 : parsed);
                this.updateFuelBadge();
                this.calc();
            });
        }

        if (dFuelEff) {
            dFuelEff.addEventListener('input', (e) => {
                const parsed = parseFloat(e.target.value);
                this.state.fuelEff = Math.min(100, Math.max(1, isNaN(parsed) ? 80 : parsed));
                this.updateFuelBadge();
                this.calc();
            });
        }

        dR.addEventListener('input', (e) => {
            const parsed = parseFloat(e.target.value);
            this.state.rate = Math.max(0, isNaN(parsed) ? 0.1830 : parsed);
            this.calc();
        });

        document.querySelectorAll('[data-fuel]').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('[data-fuel]').forEach(b => b.classList.remove('is-selected'));
                btn.classList.add('is-selected');
                this.state.fuel = btn.getAttribute('data-fuel');
                this.state.fuelPrice = parseFloat(btn.getAttribute('data-fuel-price'));
                this.state.fuelEff = parseFloat(btn.getAttribute('data-fuel-eff'));

                if (dFuelPrice) dFuelPrice.value = this.state.fuelPrice;
                if (dFuelEff) dFuelEff.value = this.state.fuelEff;

                const unit = (this.state.fuel === 'nat_gas') ? '$/therm' : (this.state.fuel === 'electric_baseboard' ? '$/kWh' : '$/gal');
                if (lFuelPrice) lFuelPrice.textContent = `Current Fuel Price (${unit}):`;

                document.getElementById('hpOldFuelLabel').textContent = 'With ' + this.state.fuel.replace('_', ' ');
                this.updateFuelBadge();
                this.calc();
            });
        });

        window.addEventListener('currencyChanged', (e) => {
            this.state.rate = e.detail.data.defaultKwh;
            dR.value = this.state.rate;
            this.calc();
        });

        document.getElementById('hpCopyBtn').addEventListener('click', () => {
            const txt = `VoltMetrics Heat Pump Savings Result: Upgrading to a ${this.state.cop} COP heat pump: ${document.getElementById('hpResSavingsPeriodLabel').textContent} = ${document.getElementById('hpResAnnualSavings').textContent} (${document.getElementById('hpResTenYearSavings').textContent} over 10 years).`;
            navigator.clipboard.writeText(txt);
            document.getElementById('hpCopyBtn').textContent = 'Copied!';
            setTimeout(() => { document.getElementById('hpCopyBtn').textContent = 'Copy Heat Pump Savings Summary'; }, 2000);
        });

        this.calc();
    },

    updateFuelBadge() {
        const b = document.getElementById('hpOldFuelBadge');
        if (!b) return;
        const unit = (this.state.fuel === 'nat_gas') ? '/therm' : (this.state.fuel === 'electric_baseboard' ? '/kWh' : '/gal');
        const fuelName = this.state.fuel.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
        b.textContent = `${fuelName}: $${this.state.fuelPrice.toFixed(2)}${unit} • ${this.state.fuelEff}%`;
    },

    calc() {
        const totalBtu = this.state.loadMmbts * 1000000;

        // 1. Old heating bill using exact fuel heat densities
        let oldAnnualCost = 0;
        if (this.state.fuel === 'oil') {
            // Heating oil: 138,500 BTU/gal
            const deliveredBtuPerGal = 138500 * (this.state.fuelEff / 100);
            const gallonsNeeded = deliveredBtuPerGal > 0 ? (totalBtu / deliveredBtuPerGal) : 0;
            oldAnnualCost = gallonsNeeded * this.state.fuelPrice;
        } else if (this.state.fuel === 'propane') {
            // Propane: 91,452 BTU/gal
            const deliveredBtuPerGal = 91452 * (this.state.fuelEff / 100);
            const gallonsNeeded = deliveredBtuPerGal > 0 ? (totalBtu / deliveredBtuPerGal) : 0;
            oldAnnualCost = gallonsNeeded * this.state.fuelPrice;
        } else if (this.state.fuel === 'electric_baseboard') {
            // Electric resistance: 3,412.14 BTU/kWh (COP 1.0)
            const deliveredBtuPerKwh = 3412.14 * (this.state.fuelEff / 100);
            const kwhNeeded = deliveredBtuPerKwh > 0 ? (totalBtu / deliveredBtuPerKwh) : 0;
            oldAnnualCost = kwhNeeded * this.state.fuelPrice;
        } else {
            // Natural Gas: 100,000 BTU/therm
            const deliveredBtuPerTherm = 100000 * (this.state.fuelEff / 100);
            const thermsNeeded = deliveredBtuPerTherm > 0 ? (totalBtu / deliveredBtuPerTherm) : 0;
            oldAnnualCost = thermsNeeded * this.state.fuelPrice;
        }

        // 2. Heat pump electricity bill factoring auxiliary resistance backup heat
        const auxFraction = (this.state.auxPct || 0) / 100;
        const hpFraction = 1 - auxFraction;

        const hpBtu = totalBtu * hpFraction;
        const auxBtu = totalBtu * auxFraction;

        // Heat pump delivers 3,412.14 * COP per kWh
        const hpKwh = (3412.14 * this.state.cop) > 0 ? (hpBtu / (3412.14 * this.state.cop)) : 0;
        // Resistance heat strips deliver 3,412.14 BTU/kWh (COP 1.0)
        const auxKwh = auxBtu / 3412.14;

        const newKwhNeeded = hpKwh + auxKwh;
        const newAnnualCost = newKwhNeeded * this.state.rate;

        // Annual Difference: Old Cost - New Cost (Positive = savings, Negative = additional cost)
        const annualDifference = oldAnnualCost - newAnnualCost;
        const percentChange = oldAnnualCost > 0 ? ((annualDifference / oldAnnualCost) * 100) : 0;

        document.getElementById('hpResOldBill').textContent = CurrencyManager.formatCost(oldAnnualCost);
        document.getElementById('hpResNewBill').textContent = CurrencyManager.formatCost(newAnnualCost);
        document.getElementById('hpNewKwhLabel').textContent = Math.round(newKwhNeeded).toLocaleString() + ' kWh / winter';

        const labelEl = document.getElementById('hpResSavingsPeriodLabel');
        const amountEl = document.getElementById('hpResAnnualSavings');
        const subEl = document.getElementById('hpResSavingsSub');
        const tenYearLabel = document.getElementById('hpResTenYearLabel');
        const tenYearAmount = document.getElementById('hpResTenYearSavings');
        const tenYearSub = document.getElementById('hpResTenYearSub');

        if (annualDifference >= 0) {
            labelEl.textContent = 'Estimated Annual Heating Savings';
            amountEl.textContent = CurrencyManager.formatCost(annualDifference);
            amountEl.style.color = 'var(--emerald-400)';
            subEl.innerHTML = `Saving <strong>${Math.round(percentChange)}%</strong> on winter heating bills`;
            tenYearLabel.textContent = '10-Year Cumulative Net Savings';
            tenYearAmount.textContent = CurrencyManager.formatCost(annualDifference * 10);
            tenYearAmount.style.color = 'var(--emerald-400)';
            tenYearSub.textContent = 'Simple 10-year projection (assumes constant fuel and electricity prices)';
        } else {
            const addedCost = Math.abs(annualDifference);
            const higherPct = Math.abs(percentChange).toFixed(1);
            labelEl.textContent = 'Estimated Additional Annual Cost';
            amountEl.textContent = CurrencyManager.formatCost(addedCost);
            amountEl.style.color = 'var(--amber-400)';
            subEl.innerHTML = `<span style="color: var(--amber-400); font-weight: 700;">Heat pump costs approximately ${CurrencyManager.formatCost(addedCost)} more per year</span> (${higherPct}% higher operating cost under these assumptions)`;
            tenYearLabel.textContent = '10-Year Estimated Additional Cost';
            tenYearAmount.textContent = '+' + CurrencyManager.formatCost(addedCost * 10);
            tenYearAmount.style.color = 'var(--amber-400)';
            tenYearSub.textContent = 'Under current fuel prices, heating with current system is more economical than heat pump';
        }
    }
};

document.addEventListener('DOMContentLoaded', () => HeatPumpCalc.init());
</script>

</body>
</html>
