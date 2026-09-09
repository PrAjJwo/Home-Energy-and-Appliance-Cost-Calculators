<?php
require_once __DIR__ . '/../config/site_config.php';
require_once __DIR__ . '/../config/rates.php';
require_once __DIR__ . '/../includes/seo_helper.php';

$page_title = "Household Appliance Energy Calculators - Electricity Cost Estimators";
$meta_description = "Calculate electricity costs for household appliances, televisions, gaming computers, and refrigerators. Discover phantom power draw with 2026 tariff data.";
$focus_keyword = "household appliance energy calculators";
$canonical_path = "categories/appliances.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php render_seo_head($page_title, $meta_description, $focus_keyword, $canonical_path); ?>
</head>
<body>

<?php require_once __DIR__ . '/../includes/header.php'; ?>

<?php 
$active_cat_id = 'appliances';
require_once __DIR__ . '/../includes/category_nav.php'; 
?>

<main class="section-padding" style="padding-top: 10px;">
    <div class="container">
        <!-- Category Banner with Graphic -->
        <div style="background: var(--white); border: 1px solid var(--border-subtle); border-radius: var(--radius-xl); padding: 36px; margin-bottom: 40px; box-shadow: var(--shadow-sm);">
            <div style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 30px; align-items: center;">
                <div>
                    <span class="section-tag">Category 1 Overview</span>
                    <h1 style="font-size: 2.25rem; margin-bottom: 12px; color: var(--slate-900);">
                        Everyday Household Appliances
                    </h1>
                    <p style="font-size: 1.0625rem; color: var(--slate-600); line-height: 1.6; margin-bottom: 20px;">
                        Plug-in electronics, kitchen appliances, and entertainment centers account for roughly 20% to 30% of average residential electric bills. Use our calculators below to isolate energy vampires and determine real monthly costs.
                    </p>
                    <a href="/calculators/appliance-electricity-cost.php" class="btn btn-primary">
                        Launch Featured Tool: Appliance Cost Calculator &rarr;
                    </a>
                </div>
                <div style="border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--border-subtle); box-shadow: var(--shadow-md);">
                    <img src="/assets/images/appliances_energy_banner.jpg" 
                         alt="High efficiency household appliances with energy star rating"
                         width="1280" height="720" loading="lazy">
                </div>
            </div>
        </div>

        <!-- Calculators In This Category -->
        <div class="section-header" style="text-align: left; margin-bottom: 24px;">
            <h2 style="font-size: 1.5rem; color: var(--slate-900);">Calculators in this Category</h2>
            <p style="color: var(--slate-600);">Explore active and upcoming tools for everyday plug-in electronics.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px;">
            <!-- Calculator 1: Active Feature 1 -->
            <div class="cat-card active-category">
                <span class="cat-tag" style="background-color: var(--emerald-50); color: var(--emerald-700);">
                    Popular Pick &bull; Active Tool
                </span>
                <h3 class="cat-title">Appliance Electricity Cost Calculator</h3>
                <p class="cat-desc">
                    Determine exact operating expenses per day, month, and year for any plug-in home device with verified presets and Energy Star comparisons.
                </p>
                <div style="margin-top: auto; padding-top: 16px;">
                    <a href="/calculators/appliance-electricity-cost.php" class="btn btn-primary" style="width: 100%;">
                        Open Calculator
                    </a>
                </div>
            </div>

            <!-- Calculator 2: Watts to Monthly Cost -->
            <div class="cat-card active-category">
                <span class="cat-tag" style="background-color: var(--emerald-50); color: var(--emerald-700);">
                    Feature 15 &bull; Active Tool
                </span>
                <h3 class="cat-title">Watts to Monthly Cost Calculator</h3>
                <p class="cat-desc">
                    Instantly convert continuous wattage ratings into monthly and annual utility bill totals with multi-tier tariff support.
                </p>
                <div style="margin-top: auto; padding-top: 16px;">
                    <a href="/calculators/watts-to-monthly-cost.php" class="btn btn-primary" style="width: 100%;">
                        Open Calculator (Active)
                    </a>
                </div>
            </div>

            <!-- Calculator 3: Refrigerator Energy Cost -->
            <div class="cat-card active-category">
                <span class="cat-tag" style="background-color: var(--emerald-50); color: var(--emerald-700);">
                    Feature 7 &bull; Active Tool
                </span>
                <h3 class="cat-title">Refrigerator Energy Cost Calculator</h3>
                <p class="cat-desc">
                    Inspect compressor duty cycles, door configurations, and calculate payback when replacing an older secondary fridge.
                </p>
                <div style="margin-top: auto; padding-top: 16px;">
                    <a href="/calculators/refrigerator-energy-cost.php" class="btn btn-primary" style="width: 100%;">
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
