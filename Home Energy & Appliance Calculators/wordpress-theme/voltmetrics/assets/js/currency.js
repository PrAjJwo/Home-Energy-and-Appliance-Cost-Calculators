/**
 * VoltMetrics - Currency, Rates & Global Energy Constants Controller
 * Benchmarked to 2026 EIA & Global Standards
 * Strictly NO em dashes.
 */

const EnergyConstants = {
    DAYS_PER_YEAR: 365,
    AVERAGE_DAYS_PER_MONTH: 30.42,
    DEFAULT_BILLING_DAYS: 30,
    BTU_PER_KWH: 3412.14,
    US_CO2_FACTOR: 0.767209,   // lb CO2 per kWh
    US_CO2E_FACTOR: 0.770884,  // lb CO2e per kWh
    DEFAULT_GASOLINE_PRICE: 4.071, // $ / gallon
    DEFAULT_EV_CHARGING_EFFICIENCY: 0.90, // 90% Level 2
    DEFAULT_BATTERY_EFFICIENCY: 0.90,     // 90% round-trip
    PROPANE_BTU_PER_GAL: 91452,
    HEATING_OIL_BTU_PER_GAL: 138500,
    NATURAL_GAS_BTU_PER_THERM: 100000
};

const CurrencyManager = {
    rates: {
        USD: { symbol: '$', rateToUsd: 1.000, defaultKwh: 0.1830, name: 'US Dollar', standingCharge: 0.0 },
        GBP: { symbol: '£', rateToUsd: 0.738, defaultKwh: 0.2611, name: 'British Pound', standingCharge: 0.5719 },
        EUR: { symbol: '€', rateToUsd: 0.860, defaultKwh: 0.2896, name: 'Euro', standingCharge: 0.1500 },
        CAD: { symbol: 'CA$', rateToUsd: 1.380, defaultKwh: 0.1790, name: 'Canadian Dollar', standingCharge: 0.0 },
        AUD: { symbol: 'AU$', rateToUsd: 1.385, defaultKwh: 0.3450, name: 'Australian Dollar', standingCharge: 0.9500 },
        INR: { symbol: '₹', rateToUsd: 94.66, defaultKwh: 8.5000, name: 'Indian Rupee', standingCharge: 0.0 }
    },
    
    currentCurrency: 'USD',

    init() {
        const saved = localStorage.getItem('voltmetrics_currency');
        if (saved && this.rates[saved]) {
            this.currentCurrency = saved;
        }

        const selector = document.getElementById('currencySelect');
        if (selector) {
            selector.value = this.currentCurrency;
            selector.addEventListener('change', (e) => {
                this.setCurrency(e.target.value);
            });
        }

        this.applyCurrency();
    },

    setCurrency(currencyCode) {
        if (!this.rates[currencyCode]) return;
        this.currentCurrency = currencyCode;
        localStorage.setItem('voltmetrics_currency', currencyCode);
        this.applyCurrency();

        // Dispatch event with native tariff and standing charge details
        window.dispatchEvent(new CustomEvent('currencyChanged', {
            detail: {
                code: currencyCode,
                data: this.rates[currencyCode]
            }
        }));
    },

    applyCurrency() {
        const curr = this.rates[this.currentCurrency];
        // Update all symbol spans
        document.querySelectorAll('[data-currency-symbol]').forEach(el => {
            el.textContent = curr.symbol;
        });

        // Update selector value if out of sync
        const selector = document.getElementById('currencySelect');
        if (selector && selector.value !== this.currentCurrency) {
            selector.value = this.currentCurrency;
        }
    },

    formatCost(amountInCurrentCurrency) {
        const curr = this.rates[this.currentCurrency];
        const val = parseFloat(amountInCurrentCurrency) || 0;
        
        let decimals = 2;
        if (Math.abs(val) < 0.01 && val !== 0) decimals = 3;
        if (this.currentCurrency === 'INR' && Math.abs(val) > 100) decimals = 0;

        return curr.symbol + val.toLocaleString(undefined, {
            minimumFractionDigits: decimals,
            maximumFractionDigits: decimals
        });
    },

    getCurrent() {
        return {
            code: this.currentCurrency,
            ...this.rates[this.currentCurrency]
        };
    }
};

document.addEventListener('DOMContentLoaded', () => {
    CurrencyManager.init();
});
