<?php
/**
 * Energy Rates, Currency & Global Physical Constants
 * Centralized source of truth for residential energy intelligence.
 * Strictly NO em dashes throughout this file and system.
 */

// Time Constants
define('DAYS_PER_YEAR', 365);
define('AVERAGE_DAYS_PER_MONTH', 30.42);
define('DEFAULT_BILLING_DAYS', 30);

// Exact Energy Conversion
define('BTU_PER_KWH', 3412.14);

// Carbon Emission Factors (EPA eGRID 2026 Residential Standards)
define('US_CO2_FACTOR_LBS', 0.767209);  // US average lb CO2 per kWh
define('US_CO2E_FACTOR_LBS', 0.770884); // US average lb CO2e per kWh

// Thermal Energy Densities (Delivered Higher Heating Value benchmarks)
define('NATURAL_GAS_BTU_PER_THERM', 100000);
define('PROPANE_BTU_PER_GALLON', 91452); // Exact standard: 91,452 BTU/gal
define('HEATING_OIL_BTU_PER_GALLON', 138500); // No. 2 fuel oil

// Benchmark Fuel Reference Prices (Editable)
define('DEFAULT_GASOLINE_PRICE_PER_GAL', 4.071);
define('DEFAULT_PROPANE_PRICE_PER_GAL', 3.20);
define('DEFAULT_HEATING_OIL_PRICE_PER_GAL', 3.95);
define('DEFAULT_NATURAL_GAS_PRICE_PER_THERM', 1.45);

// Equipment Efficiency Defaults
define('DEFAULT_EV_CHARGING_EFFICIENCY', 0.90); // 90% Level 2 onboard charger
define('DEFAULT_BATTERY_EFFICIENCY', 0.90);     // 90% round-trip system efficiency
define('DEFAULT_GAS_CAR_MPG', 28.0);            // 28 MPG ICE vehicle comparison

// Global Currency and Electricity Rate Benchmarks (Native Currencies)
$CURRENCY_EXCHANGE_RATES = [
    'USD' => [
        'code' => 'USD',
        'symbol' => '$',
        'name' => 'US Dollar',
        'rate_to_usd' => 1.000,
        'default_rate_per_kwh' => 0.1830, // US national baseline: $0.183/kWh
        'standing_charge_per_day' => 0.0000
    ],
    'GBP' => [
        'code' => 'GBP',
        'symbol' => '£',
        'name' => 'British Pound',
        'rate_to_usd' => 0.738,
        'default_rate_per_kwh' => 0.2611, // UK standard unit rate: 26.11p/kWh
        'standing_charge_per_day' => 0.5719 // UK daily standing charge: 57.19p/day
    ],
    'EUR' => [
        'code' => 'EUR',
        'symbol' => '€',
        'name' => 'Euro',
        'rate_to_usd' => 0.860,
        'default_rate_per_kwh' => 0.2896, // EU benchmark average: €0.2896/kWh
        'standing_charge_per_day' => 0.1500
    ],
    'CAD' => [
        'code' => 'CAD',
        'symbol' => 'CA$',
        'name' => 'Canadian Dollar',
        'rate_to_usd' => 1.380,
        'default_rate_per_kwh' => 0.1790, // Canada average benchmark: CA$ 0.179/kWh
        'standing_charge_per_day' => 0.0000
    ],
    'AUD' => [
        'code' => 'AUD',
        'symbol' => 'AU$',
        'name' => 'Australian Dollar',
        'rate_to_usd' => 1.385,
        'default_rate_per_kwh' => 0.3450, // Australia average benchmark: AU$ 0.345/kWh
        'standing_charge_per_day' => 0.9500
    ],
    'INR' => [
        'code' => 'INR',
        'symbol' => '₹',
        'name' => 'Indian Rupee',
        'rate_to_usd' => 94.66,
        'default_rate_per_kwh' => 8.5000, // India typical residential tier: ₹8.50/kWh
        'standing_charge_per_day' => 0.0000
    ]
];

// US State Benchmark Electricity Rates ($ per kWh, 2026 data)
$US_STATE_RATES = [
    'US_AVG' => ['name' => 'US National Baseline (18.30¢)', 'rate' => 0.1830],
    'ND' => ['name' => 'North Dakota (Low: 11.81¢)', 'rate' => 0.1181],
    'WA' => ['name' => 'Washington (12.20¢)', 'rate' => 0.1220],
    'TX' => ['name' => 'Texas (14.65¢)', 'rate' => 0.1465],
    'FL' => ['name' => 'Florida (15.80¢)', 'rate' => 0.1580],
    'OH' => ['name' => 'Ohio (16.40¢)', 'rate' => 0.1640],
    'PA' => ['name' => 'Pennsylvania (18.10¢)', 'rate' => 0.1810],
    'NY' => ['name' => 'New York (23.90¢)', 'rate' => 0.2390],
    'MA' => ['name' => 'Massachusetts (28.40¢)', 'rate' => 0.2840],
    'CA' => ['name' => 'California (High: 32.50¢)', 'rate' => 0.3250],
    'HI' => ['name' => 'Hawaii (Top: 40.59¢)', 'rate' => 0.4059]
];

// Presets for Household Appliances (Feature 1 Data Source)
// All efficiency percentages are user-editable estimated efficiency improvements, NOT guaranteed savings.
$APPLIANCE_PRESETS = [
    'refrigerator' => [
        'id' => 'refrigerator',
        'name' => 'Refrigerator (Standard 18-21 cu ft)',
        'category' => 'Kitchen',
        'watts' => 150,
        'hours_per_day' => 24,
        'duty_cycle' => 35, // 35% duty cycle compressor active run time
        'icon' => '🧊',
        'description' => 'Runs 24 hours with an intermittent compressor cycle of roughly 35% active cooling.',
        'estimated_efficiency_improvement_pct' => 15
    ],
    'gaming_pc' => [
        'id' => 'gaming_pc',
        'name' => 'Gaming PC & Dual Monitors',
        'category' => 'Electronics',
        'watts' => 450,
        'hours_per_day' => 5,
        'duty_cycle' => 100,
        'icon' => '🖥️',
        'description' => 'High performance desktop running GPU-intensive gaming or rendering workloads.',
        'estimated_efficiency_improvement_pct' => 15
    ],
    'smart_tv' => [
        'id' => 'smart_tv',
        'name' => '65 Inch 4K Smart TV',
        'category' => 'Living Room',
        'watts' => 120,
        'hours_per_day' => 4,
        'duty_cycle' => 100,
        'icon' => '📺',
        'description' => 'Standard LED/QLED television in active streaming mode with backlighting.',
        'estimated_efficiency_improvement_pct' => 20
    ],
    'space_heater' => [
        'id' => 'space_heater',
        'name' => 'Portable Electric Space Heater',
        'category' => 'Heating',
        'watts' => 1500,
        'hours_per_day' => 6,
        'duty_cycle' => 90,
        'icon' => '🔥',
        'description' => 'High-wattage resistive electric ceramic or oil-filled radiator heater.',
        'estimated_efficiency_improvement_pct' => 0 // Resistive electric heat has no Energy Star tier
    ],
    'window_ac' => [
        'id' => 'window_ac',
        'name' => 'Window Air Conditioner (8,000 BTU)',
        'category' => 'Cooling',
        'watts' => 750,
        'hours_per_day' => 8,
        'duty_cycle' => 75,
        'icon' => '❄️',
        'description' => 'Room or bedroom window air conditioner operating during summer peaks.',
        'estimated_efficiency_improvement_pct' => 15
    ],
    'dishwasher' => [
        'id' => 'dishwasher',
        'name' => 'Dishwasher (Normal Heated Dry)',
        'category' => 'Kitchen',
        'watts' => 1400,
        'hours_per_day' => 1.2,
        'duty_cycle' => 100,
        'icon' => '🍽️',
        'description' => 'Single wash load including internal water heating element and drying fan.',
        'estimated_efficiency_improvement_pct' => 12
    ],
    'clothes_washer' => [
        'id' => 'clothes_washer',
        'name' => 'Washing Machine (Front-Loader)',
        'category' => 'Laundry',
        'watts' => 500,
        'hours_per_day' => 1,
        'duty_cycle' => 100,
        'icon' => '🧺',
        'description' => 'Standard cycle with variable electric motor agitation.',
        'estimated_efficiency_improvement_pct' => 25
    ],
    'clothes_dryer' => [
        'id' => 'clothes_dryer',
        'name' => 'Electric Clothes Dryer',
        'category' => 'Laundry',
        'watts' => 3000,
        'hours_per_day' => 1,
        'duty_cycle' => 100,
        'icon' => '👕',
        'description' => '240V electric heating coils spinning full damp loads.',
        'estimated_efficiency_improvement_pct' => 20 // Heat pump dryers save ~20-30%
    ],
    'microwave' => [
        'id' => 'microwave',
        'name' => 'Countertop Microwave Oven',
        'category' => 'Kitchen',
        'watts' => 1200,
        'hours_per_day' => 0.5,
        'duty_cycle' => 100,
        'icon' => '🍲',
        'description' => 'Quick reheating and cooking at standard 1000 to 1200 watt output.',
        'estimated_efficiency_improvement_pct' => 10
    ],
    'ceiling_fan' => [
        'id' => 'ceiling_fan',
        'name' => 'Ceiling Fan (Medium Speed)',
        'category' => 'Cooling',
        'watts' => 65,
        'hours_per_day' => 10,
        'duty_cycle' => 100,
        'icon' => '🌀',
        'description' => 'Continuous air circulation running in living room or bedroom.',
        'estimated_efficiency_improvement_pct' => 35
    ],
    'workstation' => [
        'id' => 'workstation',
        'name' => 'Work-from-Home Laptop & Dock',
        'category' => 'Office',
        'watts' => 90,
        'hours_per_day' => 8,
        'duty_cycle' => 100,
        'icon' => '💻',
        'description' => 'Business laptop with external 27 inch monitor and dock setup.',
        'estimated_efficiency_improvement_pct' => 15
    ],
    'wifi_router' => [
        'id' => 'wifi_router',
        'name' => 'Wi-Fi 6 Router & Fiber ONT',
        'category' => 'Network',
        'watts' => 18,
        'hours_per_day' => 24,
        'duty_cycle' => 100,
        'icon' => '📶',
        'description' => 'Always-on broadband networking hardware running continuous telemetry.',
        'estimated_efficiency_improvement_pct' => 15
    ],
    'ev_charger' => [
        'id' => 'ev_charger',
        'name' => 'EV Level 2 Charger (32 Amp)',
        'category' => 'Automotive',
        'watts' => 7680,
        'hours_per_day' => 3.5,
        'duty_cycle' => 100,
        'icon' => '⚡',
        'description' => '240V 32A home charging station delivering 7.7 kW to an electric vehicle.',
        'estimated_efficiency_improvement_pct' => 5
    ]
];
