/**
 * VoltMetrics - Feature 3: Mini-Split Electricity-Cost Calculator Engine
 * Exact formulas:
 *   Cooling Mode Method 1 (Rated): Running Watts = clamp(Rated Input Watts * Modulation %, Min Watts, Max Watts)
 *   Cooling Mode Method 2 (EER2): Running Watts = (Cooling BTU/hr / EER2) * (Modulation % / 100)
 *   Heating Mode Method 1 (Rated): Running Watts = clamp(Rated Input Watts * Modulation %, Min Watts, Max Watts)
 *   Heating Mode Method 2 (COP): Running Watts = [Heating BTU/hr / (3.41214 * Operating COP)] * (Modulation % / 100)
 *   Seasonal Cooling kWh = Seasonal Cooling Load BTU / (SEER2 * 1000)
 *   Seasonal Heating kWh = Seasonal Heating Load BTU / (HSPF2 * 1000)
 *   Seasonal Heating COP ~ HSPF2 / 3.41214 (seasonal performance estimate, not peak watts)
 *   Daily kWh = (Running Watts * Daily Hours) / 1000
 *   Monthly Cost = Daily kWh * 30.42 * Rate
 *   Seasonal Cost = Daily kWh * Season Days * Rate
 *   Resistance Heating Equivalent Watts = BTU / 3.41214 (COP = 1.0)
 *   Cooling Baseline Comparison: Standard 10.0 EER2 baseline cooling system
 * Strictly zero em dashes allowed.
 */

const MiniSplitCalculator = {
    state: {
        mode: 'cooling',              // 'cooling' or 'heating'
        method: 'rated',              // 'rated' or 'steady'
        btu: 12000,                  // 1-ton default
        zones: 1,
        seer: 20.0,                  // seasonal cooling efficiency
        hspf: 8.5,                   // seasonal heating efficiency
        eer: 12.0,                   // steady-state cooling efficiency
        cop: 3.0,                    // operating heating COP
        ratedCoolWatts: 1000,        // cooling rated input watts
        minCoolWatts: 300,           // cooling min input watts
        maxCoolWatts: 1400,          // cooling max input watts
        ratedHeatWatts: 1200,        // heating rated input watts
        minHeatWatts: 350,           // heating min input watts
        maxHeatWatts: 1600,          // heating max input watts
        modulation: 50,              // 50% average inverter speed
        hoursPerDay: 10,             // daily operating hours (allows 0-24)
        seasonDays: 120,             // season duration
        ratePerKwh: 0.2000,          // tariff rate ($/kWh)
        comparisonBaselineEer: 10.0, // baseline comparison EER2
        currentPreset: 'single_12k'
    },

    presets: {
        'single_9k': {
            name: 'Single-Zone 9,000 BTU (Bedroom)',
            btu: 9000, zones: 1, seer: 22.0, hspf: 11.0, eer: 12.5, cop: 3.2,
            ratedCool: 750, minCool: 200, maxCool: 1050,
            ratedHeat: 900, minHeat: 250, maxHeat: 1200,
            mod: 45, hours: 10
        },
        'single_12k': {
            name: 'Single-Zone 12,000 BTU (1-Ton Living Area)',
            btu: 12000, zones: 1, seer: 20.0, hspf: 8.5, eer: 12.0, cop: 3.0,
            ratedCool: 1000, minCool: 300, maxCool: 1400,
            ratedHeat: 1200, minHeat: 350, maxHeat: 1600,
            mod: 50, hours: 10
        },
        'single_hyper': {
            name: 'Hyper-Heat Cold Climate 12k BTU',
            btu: 12000, zones: 1, seer: 28.0, hspf: 12.5, eer: 14.0, cop: 3.5,
            ratedCool: 900, minCool: 250, maxCool: 1350,
            ratedHeat: 1150, minHeat: 300, maxHeat: 1700,
            mod: 45, hours: 12
        },
        'dual_18k': {
            name: 'Dual-Zone 18,000 BTU (2 Bedrooms)',
            btu: 18000, zones: 2, seer: 19.0, hspf: 10.0, eer: 11.5, cop: 2.9,
            ratedCool: 1550, minCool: 450, maxCool: 2100,
            ratedHeat: 1800, minHeat: 500, maxHeat: 2400,
            mod: 55, hours: 10
        },
        'tri_27k': {
            name: 'Tri-Zone 27,000 BTU (3 Rooms)',
            btu: 27000, zones: 3, seer: 18.0, hspf: 9.5, eer: 11.0, cop: 2.8,
            ratedCool: 2400, minCool: 700, maxCool: 3200,
            ratedHeat: 2700, minHeat: 800, maxHeat: 3600,
            mod: 60, hours: 12
        },
        'quad_36k': {
            name: 'Quad-Zone 36,000 BTU (Whole Floor)',
            btu: 36000, zones: 4, seer: 17.0, hspf: 9.0, eer: 10.5, cop: 2.7,
            ratedCool: 3300, minCool: 950, maxCool: 4400,
            ratedHeat: 3700, minHeat: 1050, maxHeat: 4900,
            mod: 60, hours: 14
        }
    },

    init() {
        this.cacheDom();
        this.bindEvents();
        this.syncInputsWithState();
        this.calculate();
    },

    cacheDom() {
        this.domBtnCooling = document.getElementById('msModeCooling');
        this.domBtnHeating = document.getElementById('msModeHeating');

        this.domBtnMethodRated = document.getElementById('msMethodRated');
        this.domBtnMethodSteady = document.getElementById('msMethodSteady');
        this.domMethodHelpText = document.getElementById('msMethodHelpText');

        this.domRatedGroup = document.getElementById('msRatedGroup');
        this.domSteadyGroup = document.getElementById('msSteadyGroup');
        this.domEerGroup = document.getElementById('msEerGroup');
        this.domCopGroup = document.getElementById('msCopGroup');

        this.domBtuInput = document.getElementById('msBtuInput');
        this.domBtuRange = document.getElementById('msBtuRange');
        this.domBtuBadge = document.getElementById('msBtuBadge');
        this.domTonsBadge = document.getElementById('msTonsBadge');

        this.domEfficiencyLabel = document.getElementById('msEfficiencyLabel');
        this.domEfficiencyInput = document.getElementById('msEfficiencyInput');
        this.domEfficiencyRange = document.getElementById('msEfficiencyRange');
        this.domEfficiencyBadge = document.getElementById('msEfficiencyBadge');

        this.domRatedWattsLabel = document.getElementById('msRatedWattsLabel');
        this.domRatedWattsInput = document.getElementById('msRatedWattsInput');
        this.domRatedWattsBadge = document.getElementById('msRatedWattsBadge');
        this.domMinWattsInput = document.getElementById('msMinWattsInput');
        this.domMinWattsBadge = document.getElementById('msMinWattsBadge');
        this.domMaxWattsInput = document.getElementById('msMaxWattsInput');
        this.domMaxWattsBadge = document.getElementById('msMaxWattsBadge');

        this.domEerInput = document.getElementById('msEerInput');
        this.domEerBadge = document.getElementById('msEerBadge');
        this.domCopInput = document.getElementById('msCopInput');
        this.domCopBadge = document.getElementById('msCopBadge');

        this.domModInput = document.getElementById('msModInput');
        this.domModRange = document.getElementById('msModRange');
        this.domModBadge = document.getElementById('msModBadge');

        this.domHoursInput = document.getElementById('msHoursInput');
        this.domHoursRange = document.getElementById('msHoursRange');
        this.domHoursBadge = document.getElementById('msHoursBadge');

        this.domSeasonDaysInput = document.getElementById('msSeasonDaysInput');
        this.domSeasonDaysBadge = document.getElementById('msSeasonDaysBadge');

        this.domRateInput = document.getElementById('msRateInput');
        this.domStateSelect = document.getElementById('msStateSelect');

        // Results displays
        this.domRunningWatts = document.getElementById('msResRunningWatts');
        this.domMaxWatts = document.getElementById('msResMaxWatts');
        this.domHourlyCost = document.getElementById('msResHourlyCost');
        this.domMethodNote = document.getElementById('msResMethodNote');
        this.domDailyCost = document.getElementById('msResDailyCost');
        this.domDailyKwh = document.getElementById('msResDailyKwh');
        this.domMonthlyCost = document.getElementById('msResMonthlyCost');
        this.domMonthlyKwh = document.getElementById('msResMonthlyKwh');
        this.domSeasonCost = document.getElementById('msResSeasonCost');
        this.domSeasonSub = document.getElementById('msResSeasonSub');
        this.domActivePresetName = document.getElementById('msActivePresetName');
        this.domSavingsHeading = document.getElementById('msSavingsHeading');
        this.domSavingsText = document.getElementById('msSavingsText');
        this.domSavingsAmount = document.getElementById('msSavingsAmount');

        this.presetButtons = document.querySelectorAll('[data-ms-preset]');
    },

    bindEvents() {
        // Mode Toggle (Cooling vs Heating)
        if (this.domBtnCooling && this.domBtnHeating) {
            this.domBtnCooling.addEventListener('click', () => this.setMode('cooling'));
            this.domBtnHeating.addEventListener('click', () => this.setMode('heating'));
        }

        // Calculation Method Toggle (Rated Watts vs Steady-State)
        if (this.domBtnMethodRated && this.domBtnMethodSteady) {
            this.domBtnMethodRated.addEventListener('click', () => this.setMethod('rated'));
            this.domBtnMethodSteady.addEventListener('click', () => this.setMethod('steady'));
        }

        // BTU Synchronization
        if (this.domBtuInput && this.domBtuRange) {
            this.domBtuInput.addEventListener('input', (e) => {
                const parsed = parseFloat(e.target.value);
                const val = Math.max(0, isNaN(parsed) ? 12000 : parsed);
                this.state.btu = val;
                this.domBtuRange.value = Math.min(val, 48000);
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

        // Seasonal Efficiency (SEER2 or HSPF2)
        if (this.domEfficiencyInput && this.domEfficiencyRange) {
            this.domEfficiencyInput.addEventListener('input', (e) => {
                const parsed = parseFloat(e.target.value);
                const val = Math.max(1, isNaN(parsed) ? 15 : parsed);
                if (this.state.mode === 'cooling') {
                    this.state.seer = val;
                } else {
                    this.state.hspf = val;
                }
                this.domEfficiencyRange.value = val;
                this.updateBadges();
                this.calculate();
            });

            this.domEfficiencyRange.addEventListener('input', (e) => {
                const val = parseFloat(e.target.value);
                if (this.state.mode === 'cooling') {
                    this.state.seer = val;
                } else {
                    this.state.hspf = val;
                }
                this.domEfficiencyInput.value = val;
                this.updateBadges();
                this.calculate();
            });
        }

        // Rated Input Watts
        if (this.domRatedWattsInput) {
            this.domRatedWattsInput.addEventListener('input', (e) => {
                const parsed = parseFloat(e.target.value);
                const val = Math.max(0, isNaN(parsed) ? 1000 : parsed);
                if (this.state.mode === 'cooling') {
                    this.state.ratedCoolWatts = val;
                } else {
                    this.state.ratedHeatWatts = val;
                }
                this.updateBadges();
                this.calculate();
            });
        }

        // Min Input Watts
        if (this.domMinWattsInput) {
            this.domMinWattsInput.addEventListener('input', (e) => {
                const parsed = parseFloat(e.target.value);
                const val = Math.max(0, isNaN(parsed) ? 300 : parsed);
                if (this.state.mode === 'cooling') {
                    this.state.minCoolWatts = val;
                } else {
                    this.state.minHeatWatts = val;
                }
                this.updateBadges();
                this.calculate();
            });
        }

        // Max Input Watts
        if (this.domMaxWattsInput) {
            this.domMaxWattsInput.addEventListener('input', (e) => {
                const parsed = parseFloat(e.target.value);
                const val = Math.max(0, isNaN(parsed) ? 1400 : parsed);
                if (this.state.mode === 'cooling') {
                    this.state.maxCoolWatts = val;
                } else {
                    this.state.maxHeatWatts = val;
                }
                this.updateBadges();
                this.calculate();
            });
        }

        // Steady-State EER2 Input
        if (this.domEerInput) {
            this.domEerInput.addEventListener('input', (e) => {
                const parsed = parseFloat(e.target.value);
                this.state.eer = Math.max(1, isNaN(parsed) ? 12 : parsed);
                this.updateBadges();
                this.calculate();
            });
        }

        // Heating Operating COP Input
        if (this.domCopInput) {
            this.domCopInput.addEventListener('input', (e) => {
                const parsed = parseFloat(e.target.value);
                this.state.cop = Math.max(0.1, isNaN(parsed) ? 3.0 : parsed);
                this.updateBadges();
                this.calculate();
            });
        }

        // Inverter Modulation Load (allows 0% to 100%)
        if (this.domModInput && this.domModRange) {
            this.domModInput.addEventListener('input', (e) => {
                const parsed = parseFloat(e.target.value);
                const val = Math.min(100, Math.max(0, isNaN(parsed) ? 50 : parsed));
                this.state.modulation = val;
                this.domModRange.value = val;
                this.updateBadges();
                this.calculate();
            });

            this.domModRange.addEventListener('input', (e) => {
                const val = parseFloat(e.target.value);
                this.state.modulation = val;
                this.domModInput.value = val;
                this.updateBadges();
                this.calculate();
            });
        }

        // Daily Operating Hours (allows 0 to 24)
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

        // Season Days
        if (this.domSeasonDaysInput) {
            this.domSeasonDaysInput.addEventListener('input', (e) => {
                const parsed = parseInt(e.target.value, 10);
                this.state.seasonDays = Math.max(1, isNaN(parsed) ? 120 : parsed);
                this.updateBadges();
                this.calculate();
            });
        }

        // Tariff Rate Input (allows >= 0)
        if (this.domRateInput) {
            this.domRateInput.addEventListener('input', (e) => {
                const parsed = parseFloat(e.target.value);
                this.state.ratePerKwh = Math.max(0, isNaN(parsed) ? 0 : parsed);
                if (this.domStateSelect) this.domStateSelect.value = 'custom';
                this.calculate();
            });
        }

        // State Benchmarks Dropdown
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
                const key = btn.getAttribute('data-ms-preset');
                if (this.presets[key]) {
                    this.applyPreset(key);
                }
            });
        });

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
        const copyBtn = document.getElementById('msCopySummaryBtn');
        if (copyBtn) {
            copyBtn.addEventListener('click', () => this.copySummary());
        }
    },

    setMode(newMode) {
        this.state.mode = newMode;
        if (newMode === 'cooling') {
            this.domBtnCooling.classList.add('active');
            this.domBtnHeating.classList.remove('active');
            if (this.domEfficiencyLabel) this.domEfficiencyLabel.textContent = 'Seasonal Efficiency (SEER2):';
            if (this.domEfficiencyInput) {
                this.domEfficiencyInput.value = this.state.seer;
            }
            if (this.domEfficiencyRange) {
                this.domEfficiencyRange.value = this.state.seer;
            }
            if (this.domRatedWattsLabel) this.domRatedWattsLabel.textContent = 'Manufacturer Rated Cooling Watts:';
            if (this.domRatedWattsInput) this.domRatedWattsInput.value = this.state.ratedCoolWatts;
            if (this.domMinWattsInput) this.domMinWattsInput.value = this.state.minCoolWatts;
            if (this.domMaxWattsInput) this.domMaxWattsInput.value = this.state.maxCoolWatts;
            if (this.domEerGroup) this.domEerGroup.style.display = 'block';
            if (this.domCopGroup) this.domCopGroup.style.display = 'none';
        } else {
            this.domBtnHeating.classList.add('active');
            this.domBtnCooling.classList.remove('active');
            if (this.domEfficiencyLabel) this.domEfficiencyLabel.textContent = 'Seasonal Efficiency (HSPF2):';
            if (this.domEfficiencyInput) {
                this.domEfficiencyInput.value = this.state.hspf;
            }
            if (this.domEfficiencyRange) {
                this.domEfficiencyRange.value = this.state.hspf;
            }
            if (this.domRatedWattsLabel) this.domRatedWattsLabel.textContent = 'Manufacturer Rated Heating Watts:';
            if (this.domRatedWattsInput) this.domRatedWattsInput.value = this.state.ratedHeatWatts;
            if (this.domMinWattsInput) this.domMinWattsInput.value = this.state.minHeatWatts;
            if (this.domMaxWattsInput) this.domMaxWattsInput.value = this.state.maxHeatWatts;
            if (this.domEerGroup) this.domEerGroup.style.display = 'none';
            if (this.domCopGroup) this.domCopGroup.style.display = 'block';
        }
        this.updateBadges();
        this.calculate();
    },

    setMethod(newMethod) {
        this.state.method = newMethod;
        if (newMethod === 'rated') {
            this.domBtnMethodRated.classList.add('active');
            this.domBtnMethodRated.classList.remove('btn-outline');
            this.domBtnMethodSteady.classList.remove('active');
            this.domBtnMethodSteady.classList.add('btn-outline');
            if (this.domRatedGroup) this.domRatedGroup.style.display = 'block';
            if (this.domSteadyGroup) this.domSteadyGroup.style.display = 'none';
            if (this.domMethodHelpText) {
                this.domMethodHelpText.textContent = 'Uses manufacturer rated electrical wattage clamped to operating modulation bounds.';
            }
        } else {
            this.domBtnMethodSteady.classList.add('active');
            this.domBtnMethodSteady.classList.remove('btn-outline');
            this.domBtnMethodRated.classList.remove('active');
            this.domBtnMethodRated.classList.add('btn-outline');
            if (this.domRatedGroup) this.domRatedGroup.style.display = 'none';
            if (this.domSteadyGroup) this.domSteadyGroup.style.display = 'block';
            if (this.domMethodHelpText) {
                this.domMethodHelpText.textContent = this.state.mode === 'cooling'
                    ? 'Estimates steady-state power draw via EER2 steady-state ratio (BTU/hr / EER2).'
                    : 'Estimates steady-state power draw via Operating COP [BTU/hr / (3.41214 * COP)].';
            }
            if (this.state.mode === 'cooling') {
                if (this.domEerGroup) this.domEerGroup.style.display = 'block';
                if (this.domCopGroup) this.domCopGroup.style.display = 'none';
            } else {
                if (this.domEerGroup) this.domEerGroup.style.display = 'none';
                if (this.domCopGroup) this.domCopGroup.style.display = 'block';
            }
        }
        this.calculate();
    },

    applyPreset(key) {
        const p = this.presets[key];
        this.state.currentPreset = key;
        this.state.btu = p.btu;
        this.state.zones = p.zones;
        this.state.seer = p.seer;
        this.state.hspf = p.hspf;
        this.state.eer = p.eer;
        this.state.cop = p.cop;
        this.state.ratedCoolWatts = p.ratedCool;
        this.state.minCoolWatts = p.minCool;
        this.state.maxCoolWatts = p.maxCool;
        this.state.ratedHeatWatts = p.ratedHeat;
        this.state.minHeatWatts = p.minHeat;
        this.state.maxHeatWatts = p.maxHeat;
        this.state.modulation = p.mod;
        this.state.hoursPerDay = p.hours;

        this.presetButtons.forEach(btn => {
            if (btn.getAttribute('data-ms-preset') === key) {
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
            this.domActivePresetName.textContent = 'Custom Inverter Mini-Split Configuration';
        }
    },

    syncInputsWithState() {
        if (this.domBtuInput) this.domBtuInput.value = this.state.btu;
        if (this.domBtuRange) this.domBtuRange.value = Math.min(this.state.btu, 48000);

        const effVal = (this.state.mode === 'cooling') ? this.state.seer : this.state.hspf;
        if (this.domEfficiencyInput) this.domEfficiencyInput.value = effVal;
        if (this.domEfficiencyRange) this.domEfficiencyRange.value = effVal;

        const isCooling = (this.state.mode === 'cooling');
        const ratedVal = isCooling ? this.state.ratedCoolWatts : this.state.ratedHeatWatts;
        const minVal = isCooling ? this.state.minCoolWatts : this.state.minHeatWatts;
        const maxVal = isCooling ? this.state.maxCoolWatts : this.state.maxHeatWatts;

        if (this.domRatedWattsInput) this.domRatedWattsInput.value = ratedVal;
        if (this.domMinWattsInput) this.domMinWattsInput.value = minVal;
        if (this.domMaxWattsInput) this.domMaxWattsInput.value = maxVal;

        if (this.domEerInput) this.domEerInput.value = this.state.eer;
        if (this.domCopInput) this.domCopInput.value = this.state.cop;

        if (this.domModInput) this.domModInput.value = this.state.modulation;
        if (this.domModRange) this.domModRange.value = this.state.modulation;

        if (this.domHoursInput) this.domHoursInput.value = this.state.hoursPerDay;
        if (this.domHoursRange) this.domHoursRange.value = this.state.hoursPerDay;

        if (this.domSeasonDaysInput) this.domSeasonDaysInput.value = this.state.seasonDays;
        if (this.domRateInput) this.domRateInput.value = this.state.ratePerKwh.toFixed(4);

        this.updateBadges();
    },

    updateBadges() {
        const tons = (this.state.btu / 12000).toFixed(1);
        if (this.domBtuBadge) this.domBtuBadge.textContent = this.state.btu.toLocaleString() + ' BTU/hr';
        if (this.domTonsBadge) this.domTonsBadge.textContent = tons + ' Ton' + (tons === '1.0' ? '' : 's');

        const effText = (this.state.mode === 'cooling') ? (this.state.seer + ' SEER2') : (this.state.hspf + ' HSPF2');
        if (this.domEfficiencyBadge) this.domEfficiencyBadge.textContent = effText;

        const isCooling = (this.state.mode === 'cooling');
        const ratedVal = isCooling ? this.state.ratedCoolWatts : this.state.ratedHeatWatts;
        const minVal = isCooling ? this.state.minCoolWatts : this.state.minHeatWatts;
        const maxVal = isCooling ? this.state.maxCoolWatts : this.state.maxHeatWatts;

        if (this.domRatedWattsBadge) this.domRatedWattsBadge.textContent = ratedVal.toLocaleString() + ' W';
        if (this.domMinWattsBadge) this.domMinWattsBadge.textContent = minVal.toLocaleString() + ' W';
        if (this.domMaxWattsBadge) this.domMaxWattsBadge.textContent = maxVal.toLocaleString() + ' W';

        if (this.domEerBadge) this.domEerBadge.textContent = this.state.eer.toFixed(1) + ' EER2';
        if (this.domCopBadge) this.domCopBadge.textContent = this.state.cop.toFixed(2) + ' COP';

        if (this.domModBadge) this.domModBadge.textContent = this.state.modulation + '% inverter load';
        if (this.domHoursBadge) this.domHoursBadge.textContent = this.state.hoursPerDay + ' hrs/day';
        if (this.domSeasonDaysBadge) this.domSeasonDaysBadge.textContent = this.state.seasonDays + ' days';
    },

    calculate() {
        const isCooling = (this.state.mode === 'cooling');
        let runningWatts = 0;
        let baselineRatedDisplay = '';
        let methodSubtitle = '';

        if (this.state.modulation <= 0 || this.state.hoursPerDay <= 0) {
            runningWatts = 0;
            baselineRatedDisplay = 'Inverter Inactive / 0% Load';
            methodSubtitle = 'System off or zero runtime';
        } else if (this.state.method === 'rated') {
            // Method 1 - Manufacturer Rated Wattage Available (Clamped by operational bounds)
            const ratedWatts = isCooling ? this.state.ratedCoolWatts : this.state.ratedHeatWatts;
            const minWatts = isCooling ? this.state.minCoolWatts : this.state.minHeatWatts;
            const maxWatts = isCooling ? this.state.maxCoolWatts : this.state.maxHeatWatts;

            const unclamped = ratedWatts * (this.state.modulation / 100);
            runningWatts = Math.round(Math.min(maxWatts, Math.max(minWatts, unclamped)));

            baselineRatedDisplay = `Rated: ${ratedWatts.toLocaleString()} W (${minWatts.toLocaleString()}W - ${maxWatts.toLocaleString()}W bounds)`;
            methodSubtitle = `Estimated input power (${this.state.modulation}% modulation)`;
        } else {
            // Method 2 - Steady-State Approximation
            if (isCooling) {
                // Cooling Capacity BTU/hr / EER2 (steady-state 95F benchmark)
                const eer = Math.max(1, this.state.eer);
                const steadyWatts = this.state.btu / eer;
                runningWatts = Math.round(steadyWatts * (this.state.modulation / 100));

                baselineRatedDisplay = `Steady-state: ${Math.round(steadyWatts).toLocaleString()} W @ ${eer.toFixed(1)} EER2`;
                methodSubtitle = 'Estimated electrical input based on EER2';
            } else {
                // Heating Capacity BTU/hr / (3.41214 * Operating COP)
                const cop = Math.max(0.1, this.state.cop);
                const steadyWatts = this.state.btu / (3.41214 * cop);
                runningWatts = Math.round(steadyWatts * (this.state.modulation / 100));

                baselineRatedDisplay = `Steady-state: ${Math.round(steadyWatts).toLocaleString()} W @ ${cop.toFixed(2)} COP`;
                methodSubtitle = 'Estimated heating input based on Operating COP';
            }
        }

        // Hourly Cost
        const hourlyCost = (runningWatts / 1000) * this.state.ratePerKwh;

        // Daily Consumption and Cost
        const dailyKwh = (runningWatts * this.state.hoursPerDay) / 1000;
        const dailyCost = dailyKwh * this.state.ratePerKwh;

        // Monthly (30.42 days) & Seasonal Totals
        const monthlyKwh = dailyKwh * 30.42;
        const monthlyCost = monthlyKwh * this.state.ratePerKwh;
        const seasonalCost = dailyKwh * this.state.seasonDays * this.state.ratePerKwh;
        const seasonalKwh = dailyKwh * this.state.seasonDays;

        // Seasonal Metric Calculations (informational load modeling)
        // Seasonal Heating COP approximation: HSPF2 / 3.41214
        const seasonalHeatingCop = (this.state.hspf / 3.41214).toFixed(2);

        // Efficiency Comparison
        let savingsAmount = 0;
        if (this.domSavingsHeading && this.domSavingsText && this.domSavingsAmount) {
            if (!isCooling) {
                // Heating Comparison vs Electric Baseboard / Resistance (COP 1.0 = 3,412.14 BTU/kWh)
                const resistanceWatts = Math.round(this.state.btu / 3.41214);
                const resistanceDailyKwh = (resistanceWatts * this.state.hoursPerDay * 0.70) / 1000;
                const resistanceMonthlyCost = resistanceDailyKwh * 30.42 * this.state.ratePerKwh;
                savingsAmount = Math.max(0, resistanceMonthlyCost - monthlyCost);

                this.domSavingsHeading.textContent = `Heating Savings vs Electric Baseboard (Seasonal COP ${seasonalHeatingCop} vs 1.0)`;
                this.domSavingsText.textContent = `Electric baseboards use 100% direct resistance (COP 1.0). Running this heat pump (Seasonal COP ${seasonalHeatingCop}) saves approximately:`;
                this.domSavingsAmount.textContent = CurrencyManager.formatCost(savingsAmount) + ' / month';
            } else {
                // Cooling Comparison vs Standard Baseline Cooling System using explicit Comparison EER2 (10.0 EER2)
                const baselineWatts = Math.round(this.state.btu / this.state.comparisonBaselineEer);
                const baselineDailyKwh = (baselineWatts * this.state.hoursPerDay * 0.65) / 1000;
                const baselineMonthlyCost = baselineDailyKwh * 30.42 * this.state.ratePerKwh;
                savingsAmount = Math.max(0, baselineMonthlyCost - monthlyCost);

                this.domSavingsHeading.textContent = `Savings vs Baseline AC (10.0 EER2 System)`;
                this.domSavingsText.textContent = `Compared to a standard baseline cooling unit (${this.state.comparisonBaselineEer.toFixed(1)} EER2), inverter variable-speed modulation saves roughly:`;
                this.domSavingsAmount.textContent = CurrencyManager.formatCost(savingsAmount) + ' / month';
            }
        }

        // Output to DOM
        if (this.domRunningWatts) this.domRunningWatts.textContent = runningWatts.toLocaleString() + ' W';
        if (this.domMaxWatts) this.domMaxWatts.textContent = baselineRatedDisplay;
        if (this.domHourlyCost) this.domHourlyCost.textContent = CurrencyManager.formatCost(hourlyCost) + '/hr';
        if (this.domMethodNote) this.domMethodNote.textContent = methodSubtitle;
        if (this.domDailyCost) this.domDailyCost.textContent = CurrencyManager.formatCost(dailyCost);
        if (this.domDailyKwh) this.domDailyKwh.textContent = dailyKwh.toFixed(2) + ' kWh/day';

        if (this.domMonthlyCost) this.domMonthlyCost.textContent = CurrencyManager.formatCost(monthlyCost);
        if (this.domMonthlyKwh) this.domMonthlyKwh.textContent = Math.round(monthlyKwh).toLocaleString() + ' kWh';

        if (this.domSeasonCost) this.domSeasonCost.textContent = CurrencyManager.formatCost(seasonalCost);
        if (this.domSeasonSub) this.domSeasonSub.textContent = `${this.state.seasonDays} active days (${Math.round(seasonalKwh).toLocaleString()} kWh)`;
    },

    copySummary() {
        const name = this.domActivePresetName ? this.domActivePresetName.textContent : 'Mini-Split';
        const mode = this.state.mode.toUpperCase();
        const method = this.state.method === 'rated' ? 'Rated Input Watts' : 'Steady-State EER2/COP';
        const monthly = this.domMonthlyCost ? this.domMonthlyCost.textContent : '';
        const season = this.domSeasonCost ? this.domSeasonCost.textContent : '';
        const watts = this.domRunningWatts ? this.domRunningWatts.textContent : '';
        const text = `VoltMetrics Mini-Split Estimate for ${name} (${mode} Mode):\n- Capacity: ${this.state.btu} BTU\n- Power Method: ${method}\n- Estimated Running Input: ${watts} (${this.state.modulation}% modulation)\n- Monthly Operating Cost: ${monthly}\n- Full Season Cost (${this.state.seasonDays} days): ${season}\nCalculate yours at: ${window.location.href}`;

        navigator.clipboard.writeText(text).then(() => {
            const btn = document.getElementById('msCopySummaryBtn');
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
    MiniSplitCalculator.init();
});
