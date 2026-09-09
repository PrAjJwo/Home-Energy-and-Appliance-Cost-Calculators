<?php
require_once __DIR__ . '/config/site_config.php';
require_once __DIR__ . '/config/rates.php';
require_once __DIR__ . '/includes/seo_helper.php';

$page_title = "All 15 Energy & Appliance Calculators - Directory by Category";
$meta_description = "Browse all 15 home energy, appliance, HVAC, backup generator, solar battery, and electric vehicle charging cost calculators in one directory.";
$focus_keyword = "all energy and appliance calculators directory";
$canonical_path = "all-calculators.php";

$calculators_catalog = [
    // Category 1
    [
        'category_id' => 'appliances',
        'category_name' => 'Everyday Household Appliances',
        'sub_category' => 'Plug-in Electronics',
        'name' => 'Appliance Electricity-Cost Calculator',
        'slug' => 'appliance-electricity-cost',
        'url' => '/calculators/appliance-electricity-cost.php',
        'is_popular' => true,
        'tag' => 'Platform #1 Popular Pick',
        'desc' => 'Calculate daily, monthly, and annual operating costs for any household plug-in device with 12 presets, duty cycles, and Energy Star upgrade savings.',
        'features' => ['12 Appliance Presets', 'Duty Cycle Adjustments', 'Phantom Power Loss', 'Energy Star ROI']
    ],
    [
        'category_id' => 'appliances',
        'category_name' => 'Everyday Household Appliances',
        'sub_category' => 'Electrical Benchmarks',
        'name' => 'Watts-to-Monthly-Cost Calculator',
        'slug' => 'watts-to-monthly-cost',
        'url' => '/calculators/watts-to-monthly-cost.php',
        'is_popular' => false,
        'tag' => 'Continuous Load',
        'desc' => 'Instantly convert continuous wattage ratings into hourly, daily, monthly, and yearly electricity costs with multi-tier utility rates.',
        'features' => ['Direct Wattage Input', 'Daily / Monthly / Annual Breakdown', 'Multi-Tier Utility Rates']
    ],
    [
        'category_id' => 'appliances',
        'category_name' => 'Everyday Household Appliances',
        'sub_category' => 'Kitchen Cold Storage',
        'name' => 'Refrigerator Energy-Cost Calculator',
        'slug' => 'refrigerator-energy-cost',
        'url' => '/calculators/refrigerator-energy-cost.php',
        'is_popular' => false,
        'tag' => 'Kitchen Cooling',
        'desc' => 'Model compressor duty cycles, interior cubic feet volume, door configurations, and calculate payback on replacing an older secondary fridge.',
        'features' => ['Cubic Feet Sizing (10 to 30 cu ft)', 'Compressor Duty Cycle (30%-60%)', 'Old vs New Fridge ROI']
    ],

    // Category 2
    [
        'category_id' => 'hvac',
        'category_name' => 'HVAC, Heating & Cooling Systems',
        'sub_category' => 'Central & Room Cooling',
        'name' => 'Air-Conditioner Running-Cost Calculator',
        'slug' => 'air-conditioner-running-cost',
        'url' => '/calculators/air-conditioner-running-cost.php',
        'is_popular' => true,
        'tag' => 'Category Popular Pick',
        'desc' => 'Calculate central AC, window unit, and portable AC cooling expenses across summer heat waves with SEER ratings and 10-year upgrade ROI.',
        'features' => ['Tonnage / BTU Sizing (0.5 to 5 Tons)', 'SEER 10 to 24 Ratings', 'Summer 90-Day Seasonal Costs', '10-Year Upgrade ROI']
    ],
    [
        'category_id' => 'hvac',
        'category_name' => 'HVAC, Heating & Cooling Systems',
        'sub_category' => 'Inverter Heat Pumps',
        'name' => 'Mini-Split Electricity-Cost Calculator',
        'slug' => 'mini-split-electricity-cost',
        'url' => '/calculators/mini-split-electricity-cost.php',
        'is_popular' => false,
        'tag' => 'Inverter Efficiency',
        'desc' => 'Dual-mode heating (HSPF2) and cooling (SEER2) calculator with variable-speed compressor modulation and baseboard replacement savings.',
        'features' => ['Cooling & Heating Dual Mode', 'Inverter Modulation (20%-100%)', 'Baseboard Resistance Savings']
    ],
    [
        'category_id' => 'hvac',
        'category_name' => 'HVAC, Heating & Cooling Systems',
        'sub_category' => 'Portable Zone Heating',
        'name' => 'Space-Heater Cost Calculator',
        'slug' => 'space-heater-cost',
        'url' => '/calculators/space-heater-cost.php',
        'is_popular' => false,
        'tag' => 'Winter Heating',
        'desc' => 'Find out how fast a 1,500W electric space heater adds up on winter electric bills. Compare overnight zone heating versus whole-house furnace heating.',
        'features' => ['400W to 1,500W Settings', 'Overnight vs Winter Bills', 'Zone vs Central Furnace Comparison']
    ],
    [
        'category_id' => 'hvac',
        'category_name' => 'HVAC, Heating & Cooling Systems',
        'sub_category' => 'Fuel Conversion ROI',
        'name' => 'Heat-Pump Savings Calculator',
        'slug' => 'heat-pump-savings',
        'url' => '/calculators/heat-pump-savings.php',
        'is_popular' => false,
        'tag' => 'Decarbonization',
        'desc' => 'Compare heat pump seasonal COP efficiency against heating oil, propane, natural gas, and electric resistance for 10-year fuel savings.',
        'features' => ['Home Load (MMBtu/yr)', 'Seasonal COP (2.0 to 4.5)', 'Heating Oil vs Propane vs Heat Pump']
    ],
    [
        'category_id' => 'hvac',
        'category_name' => 'HVAC, Heating & Cooling Systems',
        'sub_category' => 'Air Circulation',
        'name' => 'Ceiling-Fan Electricity Calculator',
        'slug' => 'ceiling-fan-electricity',
        'url' => '/calculators/ceiling-fan-electricity.php',
        'is_popular' => false,
        'tag' => 'AC Thermostat Offset',
        'desc' => 'Calculate ceiling fan operating costs and determine net dollar savings when raising your AC thermostat 4 degrees using the wind-chill effect.',
        'features' => ['30W to 75W Fan Speeds', 'Wind-Chill AC Offset', 'Net Summer Dollar Savings']
    ],

    // Category 3
    [
        'category_id' => 'backup',
        'category_name' => 'Backup Power & Off-Grid Resilience',
        'sub_category' => 'Portable & Standby Generators',
        'name' => 'Generator Runtime Calculator',
        'slug' => 'generator-runtime',
        'url' => '/calculators/generator-runtime.php',
        'is_popular' => true,
        'tag' => 'Category Popular Pick',
        'desc' => 'Calculate fuel tank runtime in hours based on electrical load percentage, generator wattage capacity, and fuel burn curves.',
        'features' => ['Tank Capacity (Gallons)', 'Load Demand % (25% to 100%)', 'Continuous Run Hours Per Tank']
    ],
    [
        'category_id' => 'backup',
        'category_name' => 'Backup Power & Off-Grid Resilience',
        'sub_category' => 'Fuel Economics',
        'name' => 'Generator Fuel-Cost Calculator',
        'slug' => 'generator-fuel-cost',
        'url' => '/calculators/generator-fuel-cost.php',
        'is_popular' => false,
        'tag' => 'Outage Budgeting',
        'desc' => 'Estimate gasoline, diesel, and propane dollars spent per hour, 24-hour storm runs, and multi-day blackout emergency scenarios.',
        'features' => ['Gasoline, Diesel, Propane', 'Hourly & Daily Fuel Expenses', '3-Day Outage Planning']
    ],
    [
        'category_id' => 'backup',
        'category_name' => 'Backup Power & Off-Grid Resilience',
        'sub_category' => 'Stationary Battery Storage',
        'name' => 'Solar Battery Runtime Calculator',
        'slug' => 'solar-battery-runtime',
        'url' => '/calculators/solar-battery-runtime.php',
        'is_popular' => false,
        'tag' => 'Home Storage Sizing',
        'desc' => 'Model usable kWh, depth of discharge (DoD), essential circuit wattage draw, and backup hours with daytime solar array recharging.',
        'features' => ['Usable Battery kWh (5 to 30 kWh)', 'Depth of Discharge (80%-100%)', 'Daytime Solar Offset']
    ],
    [
        'category_id' => 'backup',
        'category_name' => 'Backup Power & Off-Grid Resilience',
        'sub_category' => 'Lithium Battery Packs',
        'name' => 'Portable Power-Station Runtime Calculator',
        'slug' => 'portable-power-station-runtime',
        'url' => '/calculators/portable-power-station-runtime.php',
        'is_popular' => false,
        'tag' => 'Emergency Essentials',
        'desc' => 'Compute how many hours your portable lithium power station (EcoFlow, Jackery, Bluetti) will power CPAP machines, mini-fridges, and laptops.',
        'features' => ['Capacity in Watt-Hours (Wh)', 'Inverter Conversion Efficiency', 'Device Recharge Cycle Counts']
    ],

    // Category 4
    [
        'category_id' => 'ev_utility',
        'category_name' => 'Electric Vehicles & High-Load Utility',
        'sub_category' => 'Transportation Energy',
        'name' => 'EV Home-Charging Cost Calculator',
        'slug' => 'ev-home-charging-cost',
        'url' => '/calculators/ev-home-charging-cost.php',
        'is_popular' => true,
        'tag' => 'Category Popular Pick',
        'desc' => 'Calculate cost per full charge, cost per mile driven, and monthly charging expenses at Level 1 vs Level 2 with gasoline fuel savings.',
        'features' => ['Battery Pack kWh (Tesla, Ioniq, Rivian)', 'Level 1 (120V) vs Level 2 (240V)', 'Cost per Mile & Gas Savings']
    ],
    [
        'category_id' => 'ev_utility',
        'category_name' => 'Electric Vehicles & High-Load Utility',
        'sub_category' => 'Heavy-Duty Filtration',
        'name' => 'Pool-Pump Electricity Calculator',
        'slug' => 'pool-pump-electricity',
        'url' => '/calculators/pool-pump-electricity.php',
        'is_popular' => false,
        'tag' => 'Swimming Pool Efficiency',
        'desc' => 'Compare single-speed pool filtration motors against modern variable-speed energy savers to project monthly and seasonal savings.',
        'features' => ['0.75HP to 2.0HP Motor Sizing', 'Single vs Variable Speed RPM', 'Affinity Law Seasonal Savings']
    ],
    [
        'category_id' => 'ev_utility',
        'category_name' => 'Electric Vehicles & High-Load Utility',
        'sub_category' => 'Utility Tariff Shocks',
        'name' => 'Electricity Bill Increase Calculator',
        'slug' => 'electricity-bill-increase',
        'url' => '/calculators/electricity-bill-increase.php',
        'is_popular' => false,
        'tag' => 'Rate Hikes & Loads',
        'desc' => 'Evaluate baseline kilowatt-hour spikes and tiered rate threshold shifts before and after adding heavy equipment or after utility rate hikes.',
        'features' => ['Baseline vs New kWh Draw', 'Tiered Tariff Rate Escalation', 'Monthly Bill Surge Projections']
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php render_seo_head($page_title, $meta_description, $focus_keyword, $canonical_path); ?>
    <style>
        .filter-btn-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }
        .filter-btn {
            background: var(--white);
            border: 1px solid var(--border-subtle);
            color: var(--slate-700);
            padding: 10px 18px;
            border-radius: var(--radius-pill);
            font-size: 0.875rem;
            font-weight: 700;
            cursor: pointer;
            transition: all var(--transition-fast);
        }
        .filter-btn:hover {
            border-color: var(--emerald-500);
            color: var(--emerald-700);
        }
        .filter-btn.active {
            background: var(--emerald-600);
            border-color: var(--emerald-600);
            color: var(--white);
            box-shadow: var(--shadow-sm);
        }
        .calc-directory-card {
            background: var(--white);
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius-lg);
            padding: 24px;
            display: flex;
            flex-direction: column;
            transition: transform var(--transition-fast), box-shadow var(--transition-fast), border-color var(--transition-fast);
        }
        .calc-directory-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            border-color: var(--emerald-400);
        }
        .calc-dir-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
            gap: 8px;
        }
        .calc-subcat-badge {
            background: var(--slate-100);
            color: var(--slate-600);
            font-size: 0.75rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: var(--radius-pill);
        }
        .calc-popular-badge {
            background: var(--emerald-50);
            color: var(--emerald-800);
            border: 1px solid var(--emerald-300);
            font-size: 0.75rem;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: var(--radius-pill);
        }
        .calc-dir-title {
            font-size: 1.1875rem;
            font-weight: 800;
            color: var(--slate-900);
            margin-bottom: 8px;
            line-height: 1.35;
        }
        .calc-dir-desc {
            font-size: 0.875rem;
            color: var(--slate-600);
            line-height: 1.55;
            margin-bottom: 16px;
            flex-grow: 1;
        }
        .calc-feature-list {
            list-style: none;
            padding: 0;
            margin: 0 0 16px 0;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .calc-feature-item {
            font-size: 0.75rem;
            color: var(--slate-600);
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .calc-feature-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--emerald-500);
        }
        .dir-search-wrap {
            position: relative;
            margin-bottom: 24px;
            max-width: 540px;
        }
        .dir-search-input {
            width: 100%;
            padding: 12px 16px 12px 42px;
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius-md);
            font-size: 0.9375rem;
            font-family: inherit;
        }
        .dir-search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--slate-400);
        }
    </style>
</head>
<body>

<?php require_once __DIR__ . '/includes/header.php'; ?>

<main class="section-padding">
    <div class="container">
        <!-- Hero Header -->
        <div style="background: var(--white); border: 1px solid var(--border-subtle); border-radius: var(--radius-xl); padding: 36px; margin-bottom: 36px; box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 20px;">
                <div>
                    <span class="section-tag">Complete Suite Directory</span>
                    <h1 style="font-size: 2.25rem; color: var(--slate-900); margin-bottom: 10px;">
                        All 15 Home Energy & Utility Calculators
                    </h1>
                    <p style="font-size: 1.0625rem; color: var(--slate-600); max-width: 760px; line-height: 1.6;">
                        Every tool below is individually engineered with verified mathematical models, 2026 tariff benchmarks, multi-currency conversion, and dedicated educational guides.
                    </p>
                </div>
                <div style="background: var(--emerald-50); border: 1px solid var(--emerald-200); padding: 12px 18px; border-radius: var(--radius-lg); text-align: right;">
                    <div style="font-size: 1.75rem; font-weight: 800; color: var(--emerald-700);">15 / 15</div>
                    <div style="font-size: 0.8125rem; font-weight: 700; color: var(--emerald-800);">Active Calculators</div>
                </div>
            </div>
        </div>

        <!-- Search and Category Filters -->
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 8px;">
            <div class="dir-search-wrap">
                <svg class="dir-search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text" id="dirSearchInput" class="dir-search-input" placeholder="Search by name, appliance, fuel, or formula...">
            </div>

            <div class="filter-btn-group">
                <button type="button" class="filter-btn active" data-cat="all">All 15 Tools</button>
                <button type="button" class="filter-btn" data-cat="appliances">Everyday Appliances (3)</button>
                <button type="button" class="filter-btn" data-cat="hvac">HVAC & Climate (5)</button>
                <button type="button" class="filter-btn" data-cat="backup">Backup Power & Off-Grid (4)</button>
                <button type="button" class="filter-btn" data-cat="ev_utility">EV & Utility (3)</button>
            </div>
        </div>

        <!-- Calculators Grid -->
        <div id="dirGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 24px;">
            <?php foreach ($calculators_catalog as $tool): ?>
                <div class="calc-directory-card" 
                     data-cat="<?php echo $tool['category_id']; ?>" 
                     data-keywords="<?php echo strtolower($tool['name'] . ' ' . $tool['sub_category'] . ' ' . $tool['desc']); ?>">
                    <div class="calc-dir-top">
                        <span class="calc-subcat-badge"><?php echo htmlspecialchars($tool['sub_category']); ?></span>
                        <?php if ($tool['is_popular']): ?>
                            <span class="calc-popular-badge"><?php echo $tool['tag']; ?></span>
                        <?php else: ?>
                            <span style="font-size: 0.75rem; color: var(--slate-400); font-weight: 600;"><?php echo $tool['tag']; ?></span>
                        <?php endif; ?>
                    </div>

                    <h2 class="calc-dir-title">
                        <a href="<?php echo $tool['url']; ?>" style="color: var(--slate-900); text-decoration: none;">
                            <?php echo htmlspecialchars($tool['name']); ?>
                        </a>
                    </h2>

                    <p class="calc-dir-desc">
                        <?php echo htmlspecialchars($tool['desc']); ?>
                    </p>

                    <ul class="calc-feature-list">
                        <?php foreach ($tool['features'] as $feat): ?>
                            <li class="calc-feature-item">
                                <span class="calc-feature-dot"></span>
                                <span><?php echo htmlspecialchars($feat); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <div style="margin-top: auto; padding-top: 14px; border-top: 1px solid var(--slate-100);">
                        <a href="<?php echo $tool['url']; ?>" class="btn btn-primary btn-sm" style="width: 100%; text-align: center;">
                            Launch Calculator &rarr;
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="noResultsMsg" style="display: none; text-align: center; padding: 60px 20px; background: var(--white); border-radius: var(--radius-lg); margin-top: 20px;">
            <p style="font-size: 1.125rem; color: var(--slate-600);">No calculator matched your search query.</p>
            <button type="button" id="resetFiltersBtn" class="btn btn-outline btn-sm" style="margin-top: 12px;">Reset Filters</button>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

<script>
    // Live Directory Filtering & Search
    const searchInput = document.getElementById('dirSearchInput');
    const filterBtns = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.calc-directory-card');
    const noResultsMsg = document.getElementById('noResultsMsg');
    const resetBtn = document.getElementById('resetFiltersBtn');

    let currentCat = 'all';

    function filterCards() {
        const query = searchInput.value.trim().toLowerCase();
        let visibleCount = 0;

        cards.forEach(card => {
            const cardCat = card.getAttribute('data-cat');
            const cardKeywords = card.getAttribute('data-keywords');

            const matchesCat = (currentCat === 'all' || cardCat === currentCat);
            const matchesQuery = (!query || cardKeywords.includes(query));

            if (matchesCat && matchesQuery) {
                card.style.display = 'flex';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        noResultsMsg.style.display = (visibleCount === 0) ? 'block' : 'none';
    }

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            currentCat = this.getAttribute('data-cat');
            filterCards();
        });
    });

    searchInput.addEventListener('input', filterCards);

    if (resetBtn) {
        resetBtn.addEventListener('click', function() {
            searchInput.value = '';
            currentCat = 'all';
            filterBtns.forEach(b => b.classList.remove('active'));
            filterBtns[0].classList.add('active');
            filterCards();
        });
    }
</script>

</body>
</html>
