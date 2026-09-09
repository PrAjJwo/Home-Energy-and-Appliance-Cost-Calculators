<?php
require_once __DIR__ . '/../config/site_config.php';
require_once __DIR__ . '/../config/rates.php';
require_once __DIR__ . '/../includes/seo_helper.php';

$page_title = "EV & High-Load Utility Calculators - Home Charging & Pool Cost Estimators";
$meta_description = "Calculate electric vehicle home charging costs per mile, swimming pool pump filtration energy, and monthly utility bill tariff increases.";
$focus_keyword = "ev home charging utility cost calculators";
$canonical_path = "categories/ev-utility.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php render_seo_head($page_title, $meta_description, $focus_keyword, $canonical_path); ?>
</head>
<body>

<?php require_once __DIR__ . '/../includes/header.php'; ?>

<?php 
$active_cat_id = 'ev_utility';
require_once __DIR__ . '/../includes/category_nav.php'; 
?>

<main class="section-padding" style="padding-top: 10px;">
    <div class="container">
        <!-- Category Banner with Graphic -->
        <div style="background: var(--white); border: 1px solid var(--border-subtle); border-radius: var(--radius-xl); padding: 36px; margin-bottom: 40px; box-shadow: var(--shadow-sm);">
            <div style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 30px; align-items: center;">
                <div>
                    <span class="section-tag">Category 4 Overview</span>
                    <h1 style="font-size: 2.25rem; margin-bottom: 12px; color: var(--slate-900);">
                        Electric Vehicles & High-Load Utility
                    </h1>
                    <p style="font-size: 1.0625rem; color: var(--slate-600); line-height: 1.6; margin-bottom: 20px;">
                        Adding a 7 kW Level 2 EV charger or a 1.5 HP swimming pool pump can easily double a household utility bill. Model your continuous high-load circuits before you see your next bill.
                    </p>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <a href="/calculators/ev-home-charging-cost.php" class="btn btn-primary">
                            Launch Popular Tool: EV Charging Cost &rarr;
                        </a>
                    </div>
                </div>
                <div style="border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--border-subtle); box-shadow: var(--shadow-md);">
                    <img src="/assets/images/ev_charging_utility.jpg" 
                         alt="Electric vehicle Level 2 home charging station and swimming pool filtration equipment diagram"
                         width="1280" height="720" loading="lazy">
                </div>
            </div>
        </div>

        <div class="section-header" style="text-align: left; margin-bottom: 24px;">
            <h2 style="font-size: 1.5rem; color: var(--slate-900);">Calculators in this Category</h2>
            <p style="color: var(--slate-600);">High-amperage dedicated circuits and utility tariff spikes.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px;">
            <!-- EV Home Charging (Popular in Category) -->
            <div class="cat-card active-category">
                <span class="cat-tag" style="background: var(--emerald-50); color: var(--emerald-700);">
                    Popular Pick &bull; Active Tool
                </span>
                <h3 class="cat-title">EV Home-Charging Cost Calculator</h3>
                <p class="cat-desc">
                    Calculate cost per full charge, cost per mile driven, and monthly charging expenses at Level 1 vs Level 2.
                </p>
                <div style="margin-top: auto; padding-top: 16px;">
                    <a href="/calculators/ev-home-charging-cost.php" class="btn btn-primary" style="width: 100%;">
                        Open Calculator (Active)
                    </a>
                </div>
            </div>

            <!-- Pool Pump -->
            <div class="cat-card active-category">
                <span class="cat-tag" style="background: var(--emerald-50); color: var(--emerald-700);">
                    Feature 8 &bull; Active Tool
                </span>
                <h3 class="cat-title">Pool Pump Electricity Calculator</h3>
                <p class="cat-desc">
                    Compare single-speed pool filtration motors against modern variable-speed energy-savers.
                </p>
                <div style="margin-top: auto; padding-top: 16px;">
                    <a href="/calculators/pool-pump-electricity.php" class="btn btn-primary" style="width: 100%;">
                        Open Calculator (Active)
                    </a>
                </div>
            </div>

            <!-- Bill Increase -->
            <div class="cat-card active-category">
                <span class="cat-tag" style="background: var(--emerald-50); color: var(--emerald-700);">
                    Feature 14 &bull; Active Tool
                </span>
                <h3 class="cat-title">Electricity Bill Increase Calculator</h3>
                <p class="cat-desc">
                    Evaluate baseline kilowatt-hour spikes and tiered rate threshold shifts before and after adding heavy equipment.
                </p>
                <div style="margin-top: auto; padding-top: 16px;">
                    <a href="/calculators/electricity-bill-increase.php" class="btn btn-primary" style="width: 100%;">
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
