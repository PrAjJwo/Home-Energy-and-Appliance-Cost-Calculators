/**
 * VoltMetrics - Feature 1: Appliance Electricity Cost Calculator Engine
 * Exact formulas:
 *   Duty Fraction = Duty Cycle / 100
 *   Daily kWh = (Watts / 1000) * HoursPerDay * Duty Fraction
 *   Daily Cost = Daily kWh * RatePerKwh
 *   Monthly kWh = Daily kWh * BillingDays (default 30, customizable or 30.42)
 *   Monthly Cost = Monthly kWh * RatePerKwh
 *   Annual kWh = Daily kWh * 365
 *   Annual Cost = Annual kWh * RatePerKwh
 *   Annual CO2 (lbs) = Annual kWh * 0.767209 (EPA US average)
 *   Annual CO2e (lbs) = Annual kWh * 0.770884 (EPA US average)
 *   Estimated Efficiency Savings = Annual Cost * (Efficiency Improvement % / 100)
 * Strictly zero em dashes.
 */

const ApplianceCalculator = {
    state: {
        watts: 150,
        hoursPerDay: 24,
        dutyCycle: 35, // default refrigerator active compressor cycle
        billingDays: 30, // customizable billing cycle (default 30)
        ratePerKwh: 0.1830, // 2026 US national baseline
        currentPreset: 'refrigerator',
        savingsPct: 15, // editable estimated efficiency improvement %
        carbonMetric: 'co2' // 'co2' (0.767209) or 'co2e' (0.770884)
    },

    init() {
        this.cacheDom();
        this.bindEvents();
        this.syncInputsWithState();
        this.calculate();
    },

    cacheDom() {
        // Inputs
        this.domWattsInput = document.getElementById('calcWattsInput');
        this.domWattsRange = document.getElementById('calcWattsRange');
        this.domWattsBadge = document.getElementById('calcWattsBadge');

        this.domHoursInput = document.getElementById('calcHoursInput');
        this.domHoursRange = document.getElementById('calcHoursRange');
        this.domHoursBadge = document.getElementById('calcHoursBadge');

        this.domDutyInput = document.getElementById('calcDutyInput');
        this.domDutyRange = document.getElementById('calcDutyRange');
        this.domDutyBadge = document.getElementById('calcDutyBadge');

        this.domBillingDaysInput = document.getElementById('calcBillingDaysInput');
        this.domBillingDaysAvgBtn = document.getElementById('calcBillingDaysAvgBtn');

        this.domSavingsPctInput = document.getElementById('calcSavingsPctInput');
        this.domSavingsPctBadge = document.getElementById('calcSavingsPctBadge');

        this.domRateInput = document.getElementById('calcRateInput');
        this.domStateSelect = document.getElementById('calcStateSelect');

        this.domBtnCo2 = document.getElementById('btnMetricCo2');
        this.domBtnCo2e = document.getElementById('btnMetricCo2e');

        // Results displays
        this.domMonthlyCost = document.getElementById('resMonthlyCost');
        this.domMonthlyKwh = document.getElementById('resMonthlyKwh');

        this.domDailyCost = document.getElementById('resDailyCost');
        this.domDailyKwh = document.getElementById('resDailyKwh');

        this.domAnnualCost = document.getElementById('resAnnualCost');
        this.domAnnualKwh = document.getElementById('resAnnualKwh');

        this.domCarbonLbs = document.getElementById('resCarbonLbs');
        this.domCarbonLabel = document.getElementById('resCarbonLabel');
        this.domSavingsText = document.getElementById('resSavingsText');
        this.domActiveApplianceTitle = document.getElementById('activeApplianceTitle');

        this.presetButtons = document.querySelectorAll('[data-preset-id]');
    },

    bindEvents() {
        // Watts Sync
        if (this.domWattsInput && this.domWattsRange) {
            this.domWattsInput.addEventListener('input', (e) => {
                const val = Math.max(1, parseFloat(e.target.value) || 0);
                this.state.watts = val;
                this.domWattsRange.value = Math.min(val, 5000);
                this.updateBadges();
                this.clearPresetSelection();
                this.calculate();
            });

            this.domWattsRange.addEventListener('input', (e) => {
                const val = parseFloat(e.target.value);
                this.state.watts = val;
                this.domWattsInput.value = val;
                this.updateBadges();
                this.clearPresetSelection();
                this.calculate();
            });
        }

        // Hours Sync
        if (this.domHoursInput && this.domHoursRange) {
            this.domHoursInput.addEventListener('input', (e) => {
                const parsed = parseFloat(e.target.value);
                const val = Math.min(24, Math.max(0, isNaN(parsed) ? 0 : parsed));
                this.state.hoursPerDay = val;
                this.domHoursRange.value = val;
                this.updateBadges();
                this.calculate();
            });

            this.domHoursRange.addEventListener('input', (e) => {
                const val = parseFloat(e.target.value);
                this.state.hoursPerDay = val;
                this.domHoursInput.value = val;
                this.updateBadges();
                this.calculate();
            });
        }

        // Duty Cycle Sync
        if (this.domDutyInput && this.domDutyRange) {
            this.domDutyInput.addEventListener('input', (e) => {
                const parsed = parseFloat(e.target.value);
                const val = Math.min(100, Math.max(0, isNaN(parsed) ? 1 : parsed));
                this.state.dutyCycle = val;
                this.domDutyRange.value = val;
                this.updateBadges();
                this.calculate();
            });

            this.domDutyRange.addEventListener('input', (e) => {
                const val = parseFloat(e.target.value);
                this.state.dutyCycle = val;
                this.domDutyInput.value = val;
                this.updateBadges();
                this.calculate();
            });
        }

        // Billing Days Input
        if (this.domBillingDaysInput) {
            this.domBillingDaysInput.addEventListener('input', (e) => {
                const val = Math.max(1, Math.min(365, parseFloat(e.target.value) || 30));
                this.state.billingDays = val;
                this.calculate();
            });
        }

        if (this.domBillingDaysAvgBtn) {
            this.domBillingDaysAvgBtn.addEventListener('click', () => {
                this.state.billingDays = 30.42;
                if (this.domBillingDaysInput) this.domBillingDaysInput.value = 30.42;
                this.calculate();
            });
        }

        // Efficiency Improvement % Sync
        if (this.domSavingsPctInput) {
            this.domSavingsPctInput.addEventListener('input', (e) => {
                const val = Math.min(95, Math.max(0, parseFloat(e.target.value) || 0));
                this.state.savingsPct = val;
                if (this.domSavingsPctBadge) this.domSavingsPctBadge.textContent = val + '%';
                this.calculate();
            });
        }

        // Rate Input
        if (this.domRateInput) {
            this.domRateInput.addEventListener('input', (e) => {
                const parsed = parseFloat(e.target.value);
                const val = Math.max(0, isNaN(parsed) ? 0.1830 : parsed);
                this.state.ratePerKwh = val;
                if (this.domStateSelect) this.domStateSelect.value = 'custom';
                this.calculate();
            });
        }

        // State Benchmarks
        if (this.domStateSelect) {
            this.domStateSelect.addEventListener('change', (e) => {
                const val = e.target.value;
                if (val !== 'custom') {
                    const rate = parseFloat(val);
                    this.state.ratePerKwh = rate;
                    if (this.domRateInput) this.domRateInput.value = rate.toFixed(4);
                    this.calculate();
                }
            });
        }

        // CO2 vs CO2e Metric Toggle
        if (this.domBtnCo2 && this.domBtnCo2e) {
            this.domBtnCo2.addEventListener('click', () => {
                this.state.carbonMetric = 'co2';
                this.domBtnCo2.classList.add('active');
                this.domBtnCo2e.classList.remove('active');
                this.calculate();
            });
            this.domBtnCo2e.addEventListener('click', () => {
                this.state.carbonMetric = 'co2e';
                this.domBtnCo2e.classList.add('active');
                this.domBtnCo2.classList.remove('active');
                this.calculate();
            });
        }

        // Presets Chips
        this.presetButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-preset-id');
                const watts = parseFloat(btn.getAttribute('data-watts'));
                const hours = parseFloat(btn.getAttribute('data-hours'));
                const duty = parseFloat(btn.getAttribute('data-duty'));
                const savings = parseFloat(btn.getAttribute('data-savings')) || 15;
                const name = btn.getAttribute('data-name');
                this.selectPreset(id, watts, hours, duty, savings, name);
            });
        });

        // Global Currency Change Listener
        window.addEventListener('currencyChanged', (e) => {
            this.state.ratePerKwh = e.detail.data.defaultKwh;
            if (this.domRateInput) {
                this.domRateInput.value = this.state.ratePerKwh.toFixed(4);
            }
            if (this.domStateSelect) {
                this.domStateSelect.value = 'custom';
            }
            this.calculate();
        });

        // Copy Summary
        const copyBtn = document.getElementById('calcCopyBtn');
        if (copyBtn) {
            copyBtn.addEventListener('click', () => this.copySummary());
        }

        // Accordion FAQs
        document.querySelectorAll('.faq-question').forEach(button => {
            button.addEventListener('click', () => {
                const parent = button.closest('.faq-item');
                if (parent) parent.classList.toggle('is-active');
            });
        });
    },

    selectPreset(id, watts, hours, duty, savings, name) {
        this.state.currentPreset = id;
        this.state.watts = watts;
        this.state.hoursPerDay = hours;
        this.state.dutyCycle = duty;
        this.state.savingsPct = savings;

        this.presetButtons.forEach(btn => {
            if (btn.getAttribute('data-preset-id') === id) {
                btn.classList.add('is-selected');
            } else {
                btn.classList.remove('is-selected');
            }
        });

        if (this.domActiveApplianceTitle) {
            this.domActiveApplianceTitle.textContent = name;
        }

        this.syncInputsWithState();
        this.calculate();
    },

    clearPresetSelection() {
        this.presetButtons.forEach(btn => btn.classList.remove('is-selected'));
        if (this.domActiveApplianceTitle) {
            this.domActiveApplianceTitle.textContent = 'Custom Electrical Device';
        }
    },

    syncInputsWithState() {
        if (this.domWattsInput) this.domWattsInput.value = this.state.watts;
        if (this.domWattsRange) this.domWattsRange.value = Math.min(this.state.watts, 5000);

        if (this.domHoursInput) this.domHoursInput.value = this.state.hoursPerDay;
        if (this.domHoursRange) this.domHoursRange.value = this.state.hoursPerDay;

        if (this.domDutyInput) this.domDutyInput.value = this.state.dutyCycle;
        if (this.domDutyRange) this.domDutyRange.value = this.state.dutyCycle;

        if (this.domBillingDaysInput) this.domBillingDaysInput.value = this.state.billingDays;
        if (this.domSavingsPctInput) this.domSavingsPctInput.value = this.state.savingsPct;

        if (this.domRateInput) this.domRateInput.value = this.state.ratePerKwh.toFixed(4);

        this.updateBadges();
    },

    updateBadges() {
        if (this.domWattsBadge) this.domWattsBadge.textContent = this.state.watts + ' W';
        if (this.domHoursBadge) this.domHoursBadge.textContent = this.state.hoursPerDay + ' hrs/day';
        if (this.domDutyBadge) this.domDutyBadge.textContent = this.state.dutyCycle + '% cycle';
        if (this.domSavingsPctBadge) this.domSavingsPctBadge.textContent = this.state.savingsPct + '%';
    },

    calculate() {
        // Daily Calculations
        const dutyFraction = this.state.dutyCycle / 100;
        const dailyKwh = (this.state.watts / 1000) * this.state.hoursPerDay * dutyFraction;
        const dailyCost = dailyKwh * this.state.ratePerKwh;

        // Monthly Calculations (Configurable Billing Days, default 30 or 30.42)
        const monthlyKwh = dailyKwh * this.state.billingDays;
        const monthlyCost = monthlyKwh * this.state.ratePerKwh;

        // Annual Calculations (365 days)
        const annualKwh = dailyKwh * 365;
        const annualCost = annualKwh * this.state.ratePerKwh;

        // Carbon Footprint: US Average CO2 = 0.767209 lb/kWh, CO2e = 0.770884 lb/kWh
        const carbonFactor = (this.state.carbonMetric === 'co2e') ? 0.770884 : 0.767209;
        const annualCarbonLbs = annualKwh * carbonFactor;

        // Efficiency Improvement Estimate
        const annualSavings = annualCost * (this.state.savingsPct / 100);

        // Render to DOM
        if (this.domMonthlyCost) {
            this.domMonthlyCost.textContent = CurrencyManager.formatCost(monthlyCost);
        }
        if (this.domMonthlyKwh) {
            this.domMonthlyKwh.textContent = monthlyKwh.toFixed(2) + ' kWh';
        }

        if (this.domDailyCost) {
            this.domDailyCost.textContent = CurrencyManager.formatCost(dailyCost);
        }
        if (this.domDailyKwh) {
            this.domDailyKwh.textContent = dailyKwh.toFixed(2) + ' kWh/day';
        }

        if (this.domAnnualCost) {
            this.domAnnualCost.textContent = CurrencyManager.formatCost(annualCost);
        }
        if (this.domAnnualKwh) {
            this.domAnnualKwh.textContent = annualKwh.toFixed(2) + ' kWh/year';
        }

        if (this.domCarbonLbs) {
            const metricName = (this.state.carbonMetric === 'co2e') ? 'CO2e' : 'CO2';
            this.domCarbonLbs.textContent = annualCarbonLbs.toFixed(2) + ' lbs ' + metricName + '/yr';
        }

        if (this.domSavingsText) {
            if (this.state.savingsPct > 0) {
                this.domSavingsText.innerHTML = `An appliance with an estimated ${this.state.savingsPct}% efficiency improvement could save approx. <span class="savings-highlight">${CurrencyManager.formatCost(annualSavings)}/year</span> (informational estimate, not guaranteed).`;
            } else {
                this.domSavingsText.innerHTML = `Resistive heating components convert electricity directly to thermal energy with no Energy Star rating tier. Reducing runtime is the most reliable way to lower cost.`;
            }
        }
    },

    copySummary() {
        const applianceName = this.domActiveApplianceTitle ? this.domActiveApplianceTitle.textContent.trim() : 'Appliance';
        const costStr = this.domMonthlyCost ? this.domMonthlyCost.textContent : '$0.00';
        const kwhStr = this.domMonthlyKwh ? this.domMonthlyKwh.textContent : '0.0 kWh';
        const text = `VoltMetrics Calculation: ${applianceName} consumes approx. ${kwhStr} per ${this.state.billingDays}-day billing cycle, costing ${costStr} (based on ${this.state.watts}W at ${this.state.ratePerKwh}/kWh).`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = document.getElementById('calcCopyBtn');
            if (btn) {
                const orig = btn.textContent;
                btn.textContent = 'Copied to Clipboard!';
                setTimeout(() => { btn.textContent = orig; }, 2000);
            }
        });
    }
};

document.addEventListener('DOMContentLoaded', () => {
    ApplianceCalculator.init();
});
