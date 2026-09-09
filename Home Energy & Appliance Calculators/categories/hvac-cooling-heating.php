<?php
require_once __DIR__ . '/../config/site_config.php';
require_once __DIR__ . '/../config/rates.php';
require_once __DIR__ . '/../includes/seo_helper.php';

$page_title = "HVAC, Heating & Cooling Energy Calculators - Climate Cost Estimators";
$meta_description = "Calculate running costs for central air conditioners, inverter mini-splits, heat pumps, space heaters, and ceiling fans with 2026 tariff benchmarks.";
$focus_keyword = "hvac heating cooling calculators";
$canonical_path = "categories/hvac-cooling-heating.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php render_seo_head($page_title, $meta_description, $focus_keyword, $canonical_path); ?>
</head>
<body>

<?php require_once __DIR__ . '/../includes/header.php'; ?>

<?php 
$active_cat_id = 'hvac';
require_once __DIR__ . '/../includes/category_nav.php'; 
?>

<main class="section-padding" style="padding-top: 10px;">
    <div class="container">
        <div style="background: var(--white); border: 1px solid var(--border-subtle); border-radius: var(--radius-xl); padding: 36px; margin-bottom: 40px; box-shadow: var(--shadow-sm);">
            <div style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 30px; align-items: center;">
                <div>
                    <span class="section-tag">Category 2 Overview</span>
                    <h1 style="font-size: 2.25rem; margin-bottom: 12px; color: var(--slate-900);">
                        HVAC, Heating & Cooling Systems
                    </h1>
                    <p style="font-size: 1.0625rem; color: var(--slate-600); line-height: 1.6; margin-bottom: 20px;">
                        Heating and air conditioning represent over 50% of typical home energy consumption. Explore our climate calculators to evaluate seasonal runtimes, SEER efficiency ratings, and heat pump savings.
                    </p>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <a href="/calculators/air-conditioner-running-cost.php" class="btn btn-primary">
                            Launch Popular Tool: AC Running Cost &rarr;
                        </a>
                    </div>
                </div>
                <div style="border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--border-subtle); box-shadow: var(--shadow-md);">
                    <img src="/assets/images/air_conditioner_energy.jpg" 
                         alt="Central air conditioner and mini-split heat pump energy flow diagram"
                         width="1280" height="720" loading="lazy">
                </div>
            </div>
        </div>

        <div class="section-header" style="text-align: left; margin-bottom: 24px;">
            <h2 style="font-size: 1.5rem; color: var(--slate-900);">Calculators in this Category</h2>
            <p style="color: var(--slate-600);">Detailed models for cooling and thermal regulation.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px;">
            <!-- Air Conditioner Running Cost (Popular in Category) -->
            <div class="cat-card active-category">
                <span class="cat-tag" style="background: var(--emerald-50); color: var(--emerald-700);">
                    Popular Pick &bull; Active Tool
                </span>
                <h3 class="cat-title">Air-Conditioner Running Cost Calculator</h3>
                <p class="cat-desc">
                    Calculate central AC, window unit, and mini-split electrical expenses across summer heat waves with SEER ratings and 10-year upgrade ROI.
                </p>
                <div style="margin-top: auto; padding-top: 16px;">
                    <a href="/calculators/air-conditioner-running-cost.php" class="btn btn-primary" style="width: 100%;">
                        Open Calculator (Active)
                    </a>
                </div>
            </div>

            <!-- Mini Split (Feature 3 Active) -->
            <div class="cat-card active-category">
                <span class="cat-tag" style="background: var(--emerald-50); color: var(--emerald-700);">
                    Feature 3 &bull; Active Tool
                </span>
                <h3 class="cat-title">Mini-Split Electricity Cost Calculator</h3>
                <p class="cat-desc">
                    Evaluate inverter mini-split SEER2 cooling, HSPF2 heat pump ratings, and electric baseboard savings.
                </p>
                <div style="margin-top: auto; padding-top: 16px;">
                    <a href="/calculators/mini-split-electricity-cost.php" class="btn btn-primary" style="width: 100%;">
                        Open Calculator (Active)
                    </a>
                </div>
            </div>

            <!-- Space Heater (Feature 4 Active) -->
            <div class="cat-card active-category">
                <span class="cat-tag" style="background: var(--emerald-50); color: var(--emerald-700);">
                    Feature 4 &bull; Active Tool
                </span>
                <h3 class="cat-title">Space Heater Cost Calculator</h3>
                <p class="cat-desc">
                    Find out how fast a 1,500W electric space heater adds up on winter electric bills and model zone heating efficiency.
                </p>
                <div style="margin-top: auto; padding-top: 16px;">
                    <a href="/calculators/space-heater-cost.php" class="btn btn-primary" style="width: 100%;">
                        Open Calculator (Active)
                    </a>
                </div>
            </div>

            <!-- Heat Pump Savings (Feature 5 Active) -->
            <div class="cat-card active-category">
                <span class="cat-tag" style="background: var(--emerald-50); color: var(--emerald-700);">
                    Feature 5 &bull; Active Tool
                </span>
                <h3 class="cat-title">Heat Pump Savings Calculator</h3>
                <p class="cat-desc">
                    Compare heat pump COP coefficients against traditional heating oil, propane, and resistive furnaces for 10-year fuel savings.
                </p>
                <div style="margin-top: auto; padding-top: 16px;">
                    <a href="/calculators/heat-pump-savings.php" class="btn btn-primary" style="width: 100%;">
                        Open Calculator (Active)
                    </a>
                </div>
            </div>

            <!-- Ceiling Fan (Feature 6 Active) -->
            <div class="cat-card active-category">
                <span class="cat-tag" style="background: var(--emerald-50); color: var(--emerald-700);">
                    Feature 6 &bull; Active Tool
                </span>
                <h3 class="cat-title">Ceiling Fan Electricity Calculator</h3>
                <p class="cat-desc">
                    Calculate fan wattage and discover how raising your central AC thermostat with the wind-chill effect generates net monthly savings.
                </p>
                <div style="margin-top: auto; padding-top: 16px;">
                    <a href="/calculators/ceiling-fan-electricity.php" class="btn btn-primary" style="width: 100%;">
                        Open Calculator (Active)
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>
