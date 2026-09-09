/**
 * VoltMetrics - Feature 2: Air-Conditioner Running-Cost Calculator Engine
 * Exact formulas:
 *   Peak Running Watts = Cooling Capacity (BTU/hr) / EER2 (steady-state 95 deg F)
 *   Daily kWh = (BTU/hr * Daily Hours * (Duty Cycle / 100)) / (SEER2 * 1000)
 *   Monthly Cost = Daily kWh * 30.42 * Rate
 *   Seasonal Summer Cost = Daily kWh * Summer Days * Rate
 *   Upgrade Savings = Old SEER2 Seasonal kWh - New SEER2 Seasonal kWh (both in same SEER2 standard)
 *   Old Seasonal kWh = (BTU * effectiveHours * seasonDays) / (Old SEER2 * 1000)
 *   New Seasonal kWh = (BTU * effectiveHours * seasonDays) / (New SEER2 * 1000)
 *   Hours=0, Duty=0, Rate=0 are all valid (produce zero cost, no clamping).
 * Zero em dashes allowed.
 */

const ACCalculator = {
    state: {
        btu: 36000,          // 3-ton standard central AC
        seer: 14.3,          // 2026 federal minimum SEER2 baseline
        eer: 12.2,           // Peak 95 deg F steady-state EER2 baseline (approx 0.85 * SEER2)
        hoursPerDay: 9,      // typical daily thermostat demand hours
        dutyCycle: 65,       // 65% compressor cycling on warm days
        seasonDays: 120,     // 4-month cooling season
        ratePerKwh: 0.1830,  // 2026 US baseline rate
        oldSeer2: 10.0,      // comparison baseline in SEER2 (same standard as new system)
        currentPreset: 'central_3ton'
    },

    presets: {
        'window_small': { name: 'Small Window AC (5,000 BTU)', btu: 5000, seer: 11.0, eer: 9.7, hours: 8, duty: 70 },
        'window_med':   { name: 'Medium Window AC (8,000 BTU)', btu: 8000, seer: 12.0, eer: 10.5, hours: 8, duty: 70 },
        'window_large': { name: 'Large Window AC (12,000 BTU)', btu: 12000, seer: 12.0, eer: 10.5, hours: 9, duty: 75 },
        'portable':     { name: 'Portable AC Unit (10,000 BTU)', btu: 10000, seer: 9.0, eer: 8.0, hours: 8, duty: 80 },
        'minisplit_1t': { name: 'Inverter Mini-Split 1-Ton (12,000 BTU)', btu: 12000, seer: 20.0, eer: 13.0, hours: 10, duty: 50 },
        'central_2ton': { name: 'Central AC 2-Ton (24,000 BTU)', btu: 24000, seer: 14.3, eer: 12.2, hours: 9, duty: 65 },
        'central_3ton': { name: 'Central AC 3-Ton (36,000 BTU)', btu: 36000, seer: 14.3, eer: 12.2, hours: 9, duty: 65 },
        'central_3t_hi':{ name: 'High-Efficiency 3-Ton (36,000 BTU)', btu: 36000, seer: 18.0, eer: 14.0, hours: 9, duty: 60 },
        'central_4ton': { name: 'Central AC 4-Ton (48,000 BTU)', btu: 48000, seer: 14.3, eer: 12.2, hours: 9, duty: 70 },
        'central_5ton': { name: 'Central AC 5-Ton (60,000 BTU)', btu: 60000, seer: 14.3, eer: 12.2, hours: 10, duty: 70 }
    },

    init() {
        this.cacheDom();
        this.bindEvents();
        this.syncInputsWithState();
        this.calculate();
    },

    cacheDom() {
        this.domBtuInput = document.getElementById('acBtuInput');
        this.domBtuRange = document.getElementById('acBtuRange');
        this.domBtuBadge = document.getElementById('acBtuBadge');
        this.domTonsBadge = document.getElementById('acTonsBadge');

        this.domSeerInput = document.getElementById('acSeerInput');
        this.domSeerRange = document.getElementById('acSeerRange');
        this.domSeerBadge = document.getElementById('acSeerBadge');

        this.domEerInput = document.getElementById('acEerInput');
        this.domEerBadge = document.getElementById('acEerBadge');

        this.domHoursInput = document.getElementById('acHoursInput');
        this.domHoursRange = document.getElementById('acHoursRange');
        this.domHoursBadge = document.getElementById('acHoursBadge');

        this.domDutyInput = document.getElementById('acDutyInput');
        this.domDutyRange = document.getElementById('acDutyRange');
        this.domDutyBadge = document.getElementById('acDutyBadge');

        this.domSeasonDays = document.getElementById('acSeasonDays');
        this.domRateInput = document.getElementById('acRateInput');
        this.domStateSelect = document.getElementById('acStateSelect');

        // Results displays
        this.domRunningWatts = document.getElementById('acResRunningWatts');
        this.domHourlyCost = document.getElementById('acResHourlyCost');
        this.domDailyCost = document.getElementById('acResDailyCost');
        this.domDailyKwh = document.getElementById('acResDailyKwh');
        this.domMonthlyCost = document.getElementById('acResMonthlyCost');
        this.domMonthlyKwh = document.getElementById('acResMonthlyKwh');
        this.domSeasonalCost = document.getElementById('acResSeasonalCost');
        this.domSeasonalKwh = document.getElementById('acResSeasonalKwh');

        // Upgrade comparison displays
        this.domOldSeerSelect = document.getElementById('acOldSeerSelect');
        this.domUpgradeSavingsSeason = document.getElementById('acUpgradeSavingsSeason');
        this.domUpgradeSavings10Yr = document.getElementById('acUpgradeSavings10Yr');
        this.domActivePresetName = document.getElementById('acActivePresetName');

        this.presetButtons = document.querySelectorAll('[data-ac-preset]');
    },

    bindEvents() {
        // BTU Synchronization
        if (this.domBtuInput && this.domBtuRange) {
            this.domBtuInput.addEventListener('input', (e) => {
                const val = Math.max(3000, parseFloat(e.target.value) || 3000);
                this.state.btu = val;
                this.domBtuRange.value = Math.min(val, 60000);
                this.updateBadges();
                this.clearActivePreset();
                this.calculate();
            });

            this.domBtuRange.addEventListener('input', (e) => {
                const val = parseFloat(e.target.value);
                this.state.btu = val;
                this.domBtuInput.value = val;
                this.updateBadges();
                this.clearActivePreset();
                this.calculate();
            });
        }

        // SEER Synchronization
        if (this.domSeerInput && this.domSeerRange) {
            this.domSeerInput.addEventListener('input', (e) => {
                const val = Math.min(32, Math.max(7, parseFloat(e.target.value) || 14.3));
                this.state.seer = val;
                this.domSeerRange.value = val;
                // Auto-sync EER2 if not decoupled
                if (!this.eerUserCustomized) {
                    this.state.eer = parseFloat((val * 0.85).toFixed(1));
                    if (this.domEerInput) this.domEerInput.value = this.state.eer;
                }
                this.updateBadges();
                this.calculate();
            });

            this.domSeerRange.addEventListener('input', (e) => {
                const val = parseFloat(e.target.value);
                this.state.seer = val;
                this.domSeerInput.value = val;
                if (!this.eerUserCustomized) {
                    this.state.eer = parseFloat((val * 0.85).toFixed(1));
                    if (this.domEerInput) this.domEerInput.value = this.state.eer;
                }
                this.updateBadges();
                this.calculate();
            });
        }

        // EER2 Direct Input
        if (this.domEerInput) {
            this.domEerInput.addEventListener('input', (e) => {
                this.eerUserCustomized = true;
                const val = Math.min(25, Math.max(5, parseFloat(e.target.value) || 10));
                this.state.eer = val;
                this.updateBadges();
                this.calculate();
            });
        }

        // Hours Synchronization
        if (this.domHoursInput && this.domHoursRange) {
            this.domHoursInput.addEventListener('input', (e) => {
                const parsed = parseFloat(e.target.value);
                const val = Math.min(24, Math.max(0, isNaN(parsed) ? 9 : parsed));
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

        // Duty Cycle Synchronization
        if (this.domDutyInput && this.domDutyRange) {
            this.domDutyInput.addEventListener('input', (e) => {
                const parsed = parseFloat(e.target.value);
                const val = Math.min(100, Math.max(0, isNaN(parsed) ? 65 : parsed));
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

        // Season Days
        if (this.domSeasonDays) {
            this.domSeasonDays.addEventListener('change', (e) => {
                this.state.seasonDays = parseInt(e.target.value) || 120;
                this.calculate();
            });
        }

        // Electricity Rate Input
        if (this.domRateInput) {
            this.domRateInput.addEventListener('input', (e) => {
                const parsed = parseFloat(e.target.value);
                this.state.ratePerKwh = Math.max(0, isNaN(parsed) ? 0.1830 : parsed);
                if (this.domStateSelect) this.domStateSelect.value = 'custom';
                this.calculate();
            });
        }

        // State Benchmark Dropdown
        if (this.domStateSelect) {
            this.domStateSelect.addEventListener('change', (e) => {
                const selected = parseFloat(e.target.value);
                if (!isNaN(selected)) {
                    this.state.ratePerKwh = selected;
                    if (this.domRateInput) this.domRateInput.value = selected.toFixed(4);
                    this.calculate();
                }
            });
        }

        // Presets Click
        this.presetButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const key = btn.getAttribute('data-ac-preset');
                if (this.presets[key]) {
                    this.applyPreset(key);
                }
            });
        });

        // Comparison Old SEER2 Change
        if (this.domOldSeerSelect) {
            this.domOldSeerSelect.addEventListener('change', (e) => {
                this.state.oldSeer2 = parseFloat(e.target.value) || 10.0;
                this.calculate();
            });
        }

        // Global Currency Change Listener
        window.addEventListener('currencyChanged', (e) => {
            const curr = e.detail.data;
            if (this.domRateInput) {
                this.state.ratePerKwh = curr.defaultKwh;
                this.domRateInput.value = curr.defaultKwh;
            }
            this.calculate();
        });

        // Copy Results Summary
        const copyBtn = document.getElementById('acCopySummaryBtn');
        if (copyBtn) {
            copyBtn.addEventListener('click', () => this.copySummary());
        }
    },

    applyPreset(key) {
        const p = this.presets[key];
        this.state.currentPreset = key;
        this.state.btu = p.btu;
        this.state.seer = p.seer;
        this.state.eer = p.eer || parseFloat((p.seer * 0.85).toFixed(1));
        this.state.hoursPerDay = p.hours;
        this.state.dutyCycle = p.duty;
        this.eerUserCustomized = false;

        this.presetButtons.forEach(btn => {
            if (btn.getAttribute('data-ac-preset') === key) {
                btn.classList.add('is-selected');
            } else {
                btn.classList.remove('is-selected');
            }
        });

        if (this.domActivePresetName) {
            this.domActivePresetName.textContent = p.name;
        }

        this.syncInputsWithState();
        this.calculate();
    },

    clearActivePreset() {
        this.presetButtons.forEach(btn => btn.classList.remove('is-selected'));
        if (this.domActivePresetName) {
            this.domActivePresetName.textContent = 'Custom Air Conditioner Configuration';
        }
    },

    syncInputsWithState() {
        if (this.domBtuInput) this.domBtuInput.value = this.state.btu;
        if (this.domBtuRange) this.domBtuRange.value = Math.min(this.state.btu, 60000);

        if (this.domSeerInput) this.domSeerInput.value = this.state.seer;
        if (this.domSeerRange) this.domSeerRange.value = this.state.seer;

        if (this.domEerInput) this.domEerInput.value = this.state.eer;

        if (this.domHoursInput) this.domHoursInput.value = this.state.hoursPerDay;
        if (this.domHoursRange) this.domHoursRange.value = this.state.hoursPerDay;

        if (this.domDutyInput) this.domDutyInput.value = this.state.dutyCycle;
        if (this.domDutyRange) this.domDutyRange.value = this.state.dutyCycle;

        if (this.domRateInput) this.domRateInput.value = this.state.ratePerKwh.toFixed(4);

        this.updateBadges();
    },

    updateBadges() {
        const tons = (this.state.btu / 12000).toFixed(1);
        if (this.domBtuBadge) this.domBtuBadge.textContent = this.state.btu.toLocaleString() + ' BTU/hr';
        if (this.domTonsBadge) this.domTonsBadge.textContent = tons + ' Ton' + (tons === '1.0' ? '' : 's');
        if (this.domSeerBadge) this.domSeerBadge.textContent = this.state.seer + ' SEER2';
        if (this.domEerBadge) this.domEerBadge.textContent = this.state.eer + ' EER2';
        if (this.domHoursBadge) this.domHoursBadge.textContent = this.state.hoursPerDay + ' hrs/day';
        if (this.domDutyBadge) this.domDutyBadge.textContent = this.state.dutyCycle + '% cycle';
    },

    calculate() {
        // 1. Instantaneous peak running electrical power = BTU / EER2 (steady-state 95F full load)
        const peakRunningWatts = Math.round(this.state.btu / this.state.eer);

        // 2. Active run hours factoring compressor duty cycle
        const effectiveHours = this.state.hoursPerDay * (this.state.dutyCycle / 100);

        // 3. Hourly continuous cost at peak power
        const hourlyKwh = peakRunningWatts / 1000;
        const hourlyCost = hourlyKwh * this.state.ratePerKwh;

        // 4. Daily consumption based on seasonal SEER2 efficiency metric:
        //    Total daily cooling load in BTU = BTU/hr * effectiveHours
        //    Daily kWh = (BTU/hr * effectiveHours) / (SEER2 * 1000)
        const dailyKwh = (this.state.btu * effectiveHours) / (this.state.seer * 1000);
        const dailyCost = dailyKwh * this.state.ratePerKwh;

        // 5. Monthly (30.42 days average) & Seasonal Totals
        const monthlyKwh = dailyKwh * 30.42;
        const monthlyCost = monthlyKwh * this.state.ratePerKwh;

        const seasonalKwh = dailyKwh * this.state.seasonDays;
        const seasonalCost = seasonalKwh * this.state.ratePerKwh;

        // 6. Upgrade Comparison: Old SEER2 vs New SEER2 (same rating standard on both sides)
        //    Old Seasonal kWh = (BTU * effectiveHours * seasonDays) / (Old SEER2 * 1000)
        //    New Seasonal kWh = (BTU * effectiveHours * seasonDays) / (New SEER2 * 1000)
        let upgradeSavingsSeason = 0;
        const oldSeer2 = Math.max(1, this.state.oldSeer2);
        const newSeer2 = Math.max(1, this.state.seer);
        if (newSeer2 > oldSeer2) {
            const oldSeasonalKwh = (this.state.btu * effectiveHours * this.state.seasonDays) / (oldSeer2 * 1000);
            const savedSeasonalKwh = Math.max(0, oldSeasonalKwh - seasonalKwh);
            upgradeSavingsSeason = savedSeasonalKwh * this.state.ratePerKwh;
        }

        // Output to DOM
        if (this.domRunningWatts) this.domRunningWatts.textContent = peakRunningWatts.toLocaleString() + ' W';
        if (this.domHourlyCost) this.domHourlyCost.textContent = CurrencyManager.formatCost(hourlyCost) + '/hr';
        if (this.domDailyCost) this.domDailyCost.textContent = CurrencyManager.formatCost(dailyCost);
        if (this.domDailyKwh) this.domDailyKwh.textContent = dailyKwh.toFixed(2) + ' kWh/day';

        if (this.domMonthlyCost) this.domMonthlyCost.textContent = CurrencyManager.formatCost(monthlyCost);
        if (this.domMonthlyKwh) this.domMonthlyKwh.textContent = Math.round(monthlyKwh).toLocaleString() + ' kWh';

        if (this.domSeasonalCost) this.domSeasonalCost.textContent = CurrencyManager.formatCost(seasonalCost);
        if (this.domSeasonalKwh) this.domSeasonalKwh.textContent = Math.round(seasonalKwh).toLocaleString() + ' kWh/season';

        if (this.domUpgradeSavingsSeason) {
            if (upgradeSavingsSeason > 0) {
                this.domUpgradeSavingsSeason.textContent = CurrencyManager.formatCost(upgradeSavingsSeason) + ' / summer';
            } else {
                this.domUpgradeSavingsSeason.textContent = '$0 (Identical or higher efficiency)';
            }
        }

        if (this.domUpgradeSavings10Yr) {
            if (upgradeSavingsSeason > 0) {
                this.domUpgradeSavings10Yr.textContent = CurrencyManager.formatCost(upgradeSavingsSeason * 10) + ' over 10 years';
            } else {
                this.domUpgradeSavings10Yr.textContent = '$0';
            }
        }
    },

    copySummary() {
        const name = this.domActivePresetName ? this.domActivePresetName.textContent : 'Air Conditioner';
        const monthly = this.domMonthlyCost ? this.domMonthlyCost.textContent : '';
        const season = this.domSeasonalCost ? this.domSeasonalCost.textContent : '';
        const text = `VoltMetrics AC Cost Estimate for ${name}:\n- Cooling Capacity: ${this.state.btu} BTU (${this.state.seer} SEER)\n- Daily Runtime: ${this.state.hoursPerDay} hrs (${this.state.dutyCycle}% compressor cycle)\n- Monthly Summer Cost: ${monthly}\n- Full Season Cost (${this.state.seasonDays} days): ${season}\nCalculate yours at: ${window.location.href}`;

        navigator.clipboard.writeText(text).then(() => {
            const btn = document.getElementById('acCopySummaryBtn');
            if (btn) {
                const orig = btn.textContent;
                btn.textContent = 'Copied to Clipboard!';
                btn.classList.add('btn-primary');
                setTimeout(() => {
                    btn.textContent = orig;
                    btn.classList.remove('btn-primary');
                }, 2000);
            }
        });
    }
};

document.addEventListener('DOMContentLoaded', () => {
    ACCalculator.init();
});
