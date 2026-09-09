<?php
/**
 * Global Site Configuration & Calculator Directory
 * Zero em dashes allowed in this codebase.
 */

define('SITE_NAME', 'VoltMetrics');
define('SITE_TAGLINE', 'Home Energy and Appliance Cost Calculators');
define('SITE_URL', 'http://localhost:8080'); // Adjust according to your local XAMPP port
define('DEFAULT_ELECTRICITY_RATE', 0.1830); // USD per kWh (2026 US national baseline)

// 4 Distinct Logical Categories with their popular picks
$CATEGORIES = [
    'appliances' => [
        'id' => 'appliances',
        'title' => 'Everyday Household Appliances',
        'short_title' => 'Appliances',
        'description' => 'Calculate daily and monthly power consumption for TVs, computers, refrigerators, and kitchen electronics.',
        'badge' => 'Most Frequent Usage',
        'icon' => 'plug',
        'popular_calculator_id' => 'appliance-electricity-cost',
        'popular_calculator_title' => 'Appliance Electricity Cost Calculator'
    ],
    'hvac-cooling-heating' => [
        'id' => 'hvac-cooling-heating',
        'title' => 'HVAC, Heating & Cooling Systems',
        'short_title' => 'Heating & Cooling',
        'description' => 'Analyze the heavy electrical costs of central air conditioners, mini splits, space heaters, and heat pumps.',
        'badge' => 'Highest Energy Draw',
        'icon' => 'temperature-high',
        'popular_calculator_id' => 'air-conditioner-running-cost',
        'popular_calculator_title' => 'Air-Conditioner Running-Cost Calculator'
    ],
    'backup-power' => [
        'id' => 'backup-power',
        'title' => 'Backup Power & Off-Grid Energy',
        'short_title' => 'Backup & Off-Grid',
        'description' => 'Estimate runtime, fuel expenses, and battery storage capacity for generators, solar stations, and power banks.',
        'badge' => 'Emergency Preparedness',
        'icon' => 'battery-charging',
        'popular_calculator_id' => 'generator-runtime',
        'popular_calculator_title' => 'Generator Runtime Calculator'
    ],
    'ev-utility' => [
        'id' => 'ev-utility',
        'title' => 'Electric Vehicles & High-Load Utility',
        'short_title' => 'EV & Utility',
        'description' => 'Understand charging expenses for electric vehicles, pool pumps, and overall tariff bill increases.',
        'badge' => 'High Capacity Utility',
        'icon' => 'bolt',
        'popular_calculator_id' => 'ev-home-charging-cost',
        'popular_calculator_title' => 'EV Home-Charging Cost Calculator'
    ]
];

// Master list of all 15 planned calculators
$ALL_CALCULATORS = [
    // Category 1: Everyday Appliances
    'appliance-electricity-cost' => [
        'id' => 'appliance-electricity-cost',
        'title' => 'Appliance Electricity Cost Calculator',
        'category' => 'appliances',
        'status' => 'active', // FEATURE 1 ACTIVE
        'is_featured_home' => true, // #1 Most popular overall
        'badge' => 'Popular Pick',
        'file' => 'calculators/appliance-electricity-cost.php',
        'summary' => 'Determine exact operating expenses per day, month, and year for any plug-in home device.'
    ],
    'watts-to-monthly-cost' => [
        'id' => 'watts-to-monthly-cost',
        'title' => 'Watts to Monthly Cost Calculator',
        'category' => 'appliances',
        'status' => 'active',
        'is_featured_home' => false,
        'badge' => 'Active Tool',
        'file' => 'calculators/watts-to-monthly-cost.php',
        'summary' => 'Instantly convert continuous wattage ratings into monthly and annual utility bill totals.'
    ],
    'refrigerator-energy-cost' => [
        'id' => 'refrigerator-energy-cost',
        'title' => 'Refrigerator Energy Cost Calculator',
        'category' => 'appliances',
        'status' => 'active',
        'is_featured_home' => false,
        'badge' => 'Active Tool',
        'file' => 'calculators/refrigerator-energy-cost.php',
        'summary' => 'Inspect compressor duty cycles and older fridge upgrade savings.'
    ],

    // Category 2: HVAC Heating & Cooling
    'air-conditioner-running-cost' => [
        'id' => 'air-conditioner-running-cost',
        'title' => 'Air-Conditioner Running Cost Calculator',
        'category' => 'hvac-cooling-heating',
        'status' => 'active',
        'is_featured_home' => false,
        'badge' => 'Active Tool &bull; Category Top Pick',
        'file' => 'calculators/air-conditioner-running-cost.php',
        'summary' => 'Calculate central AC and window unit electrical expenses across summer heat waves.'
    ],
    'mini-split-electricity-cost' => [
        'id' => 'mini-split-electricity-cost',
        'title' => 'Mini-Split Electricity Cost Calculator',
        'category' => 'hvac-cooling-heating',
        'status' => 'active',
        'is_featured_home' => false,
        'badge' => 'Active Tool',
        'file' => 'calculators/mini-split-electricity-cost.php',
        'summary' => 'Evaluate inverter mini-split SEER/HSPF ratings and multi-zone heating efficiency.'
    ],
    'space-heater-cost' => [
        'id' => 'space-heater-cost',
        'title' => 'Space Heater Cost Calculator',
        'category' => 'hvac-cooling-heating',
        'status' => 'active',
        'is_featured_home' => false,
        'badge' => 'Active Tool',
        'file' => 'calculators/space-heater-cost.php',
        'summary' => 'Find out how fast a 1,500W electric space heater adds up on winter electric bills.'
    ],
    'heat-pump-savings' => [
        'id' => 'heat-pump-savings',
        'title' => 'Heat Pump Savings Calculator',
        'category' => 'hvac-cooling-heating',
        'status' => 'active',
        'is_featured_home' => false,
        'badge' => 'Active Tool',
        'file' => 'calculators/heat-pump-savings.php',
        'summary' => 'Compare heat pump COP coefficients against traditional gas and resistive furnaces.'
    ],
    'ceiling-fan-electricity' => [
        'id' => 'ceiling-fan-electricity',
        'title' => 'Ceiling Fan Electricity Calculator',
        'category' => 'hvac-cooling-heating',
        'status' => 'active',
        'is_featured_home' => false,
        'badge' => 'Active Tool',
        'file' => 'calculators/ceiling-fan-electricity.php',
        'summary' => 'Track pennies spent circulating fresh air vs turning down the thermostat.'
    ],

    // Category 3: Backup Power & Off-Grid
    'generator-runtime' => [
        'id' => 'generator-runtime',
        'title' => 'Generator Runtime Calculator',
        'category' => 'backup-power',
        'status' => 'active',
        'is_featured_home' => false,
        'badge' => 'Active Tool &bull; Category Top Pick',
        'file' => 'calculators/generator-runtime.php',
        'summary' => 'Calculate tank runtime in hours based on appliance load percentage.'
    ],
    'generator-fuel-cost' => [
        'id' => 'generator-fuel-cost',
        'title' => 'Generator Fuel Cost Calculator',
        'category' => 'backup-power',
        'status' => 'active',
        'is_featured_home' => false,
        'badge' => 'Active Tool',
        'file' => 'calculators/generator-fuel-cost.php',
        'summary' => 'Estimate gasoline, diesel, and propane dollars spent per hour during an outage.'
    ],
    'solar-battery-runtime' => [
        'id' => 'solar-battery-runtime',
        'title' => 'Solar Battery Runtime Calculator',
        'category' => 'backup-power',
        'status' => 'active',
        'is_featured_home' => false,
        'badge' => 'Active Tool',
        'file' => 'calculators/solar-battery-runtime.php',
        'summary' => 'Model depth of discharge and essential load backup duration in kilowatt-hours.'
    ],
    'portable-power-station-runtime' => [
        'id' => 'portable-power-station-runtime',
        'title' => 'Portable Power Station Runtime Calculator',
        'category' => 'backup-power',
        'status' => 'active',
        'is_featured_home' => false,
        'badge' => 'Active Tool',
        'file' => 'calculators/portable-power-station-runtime.php',
        'summary' => 'Compute how many hours your EcoFlow or Jackery battery will power gear.'
    ],

    // Category 4: Electric Vehicles & High-Load Utility
    'ev-home-charging-cost' => [
        'id' => 'ev-home-charging-cost',
        'title' => 'EV Home-Charging Cost Calculator',
        'category' => 'ev-utility',
        'status' => 'active',
        'is_featured_home' => false,
        'badge' => 'Active Tool &bull; Category Top Pick',
        'file' => 'calculators/ev-home-charging-cost.php',
        'summary' => 'Calculate cost per full charge, cost per mile, and monthly charging expenses.'
    ],
    'pool-pump-electricity' => [
        'id' => 'pool-pump-electricity',
        'title' => 'Pool Pump Electricity Calculator',
        'category' => 'ev-utility',
        'status' => 'active',
        'is_featured_home' => false,
        'badge' => 'Active Tool',
        'file' => 'calculators/pool-pump-electricity.php',
        'summary' => 'Compare single-speed pool filtration motors against variable speed energy-savers.'
    ],
    'electricity-bill-increase' => [
        'id' => 'electricity-bill-increase',
        'title' => 'Electricity Bill Increase Calculator',
        'category' => 'ev-utility',
        'status' => 'active',
        'is_featured_home' => false,
        'badge' => 'Active Tool',
        'file' => 'calculators/electricity-bill-increase.php',
        'summary' => 'Evaluate tier threshold spikes and seasonal utility tariff rate adjustments.'
    ]
];
