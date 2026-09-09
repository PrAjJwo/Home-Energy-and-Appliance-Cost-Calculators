<?php
require_once __DIR__ . '/../config/site_config.php';
require_once __DIR__ . '/../config/rates.php';
require_once __DIR__ . '/../includes/seo_helper.php';

$page_title = "Backup Power & Generator Calculators - Runtime & Fuel Cost Estimators";
$meta_description = "Calculate generator runtime, gasoline/propane fuel costs, and solar battery storage duration for home emergency power and off-grid resilience.";
$focus_keyword = "backup power generator runtime calculators";
$canonical_path = "categories/backup-power.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php render_seo_head($page_title, $meta_description, $focus_keyword, $canonical_path); ?>
</head>
<body>

<?php require_once __DIR__ . '/../includes/header.php'; ?>

<?php 
$active_cat_id = 'backup';
require_once __DIR__ . '/../includes/category_nav.php'; 
?>

<main class="section-padding" style="padding-top: 10px;">
    <div class="container">
        <div style="background: var(--white); border: 1px solid var(--border-subtle); border-radius: var(--radius-xl); padding: 36px; margin-bottom: 40px; box-shadow: var(--shadow-sm);">
            <div style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 30px; align-items: center;">
                <div>
                    <span class="section-tag">Category 3 Overview</span>
                    <h1 style="font-size: 2.25rem; margin-bottom: 12px; color: var(--slate-900);">
                        Backup Power & Off-Grid Energy
                    </h1>
                    <p style="font-size: 1.0625rem; color: var(--slate-600); line-height: 1.6; margin-bottom: 20px;">
                        Whether preparing for winter ice storms or building an off-grid solar homestead, knowing your generator runtime and battery storage limits prevents blackouts.
                    </p>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <a href="/calculators/generator-runtime.php" class="btn btn-primary">
                            Launch Popular Tool: Generator Runtime &rarr;
                        </a>
                    </div>
                </div>
                <div style="border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--border-subtle); box-shadow: var(--shadow-md);">
                    <img src="/assets/images/backup_power_generator.jpg" 
                         alt="Home emergency backup generator and battery storage setup diagram"
                         width="1280" height="720" loading="lazy">
                </div>
            </div>
        </div>

        <div class="section-header" style="text-align: left; margin-bottom: 24px;">
            <h2 style="font-size: 1.5rem; color: var(--slate-900);">Calculators in this Category</h2>
            <p style="color: var(--slate-600);">Essential planning tools for emergency power readiness.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px;">
            <!-- Generator Runtime (Popular in Category) -->
            <div class="cat-card active-category">
                <span class="cat-tag" style="background: var(--emerald-50); color: var(--emerald-700);">
                    Popular Pick &bull; Active Tool
                </span>
                <h3 class="cat-title">Generator Runtime Calculator</h3>
                <p class="cat-desc">
                    Calculate full tank runtime in hours based on electrical load percentage and fuel tank volume.
                </p>
                <div style="margin-top: auto; padding-top: 16px;">
                    <a href="/calculators/generator-runtime.php" class="btn btn-primary" style="width: 100%;">
                        Open Calculator (Active)
                    </a>
                </div>
            </div>

            <!-- Generator Fuel Cost -->
            <div class="cat-card active-category">
                <span class="cat-tag" style="background: var(--emerald-50); color: var(--emerald-700);">
                    Feature 10 &bull; Active Tool
                </span>
                <h3 class="cat-title">Generator Fuel Cost Calculator</h3>
                <p class="cat-desc">
                    Estimate gasoline, diesel, and propane dollars spent per hour during extended storm blackouts.
                </p>
                <div style="margin-top: auto; padding-top: 16px;">
                    <a href="/calculators/generator-fuel-cost.php" class="btn btn-primary" style="width: 100%;">
                        Open Calculator (Active)
                    </a>
                </div>
            </div>

            <!-- Solar Battery Runtime -->
            <div class="cat-card active-category">
                <span class="cat-tag" style="background: var(--emerald-50); color: var(--emerald-700);">
                    Feature 11 &bull; Active Tool
                </span>
                <h3 class="cat-title">Solar Battery Runtime Calculator</h3>
                <p class="cat-desc">
                    Model usable kilowatt-hours, depth of discharge, and essential load backup duration with solar recharge.
                </p>
                <div style="margin-top: auto; padding-top: 16px;">
                    <a href="/calculators/solar-battery-runtime.php" class="btn btn-primary" style="width: 100%;">
                        Open Calculator (Active)
                    </a>
                </div>
            </div>

            <!-- Portable Power Station -->
            <div class="cat-card active-category">
                <span class="cat-tag" style="background: var(--emerald-50); color: var(--emerald-700);">
                    Feature 12 &bull; Active Tool
                </span>
                <h3 class="cat-title">Portable Power Station Runtime Calculator</h3>
                <p class="cat-desc">
                    Compute how many hours your EcoFlow, Jackery, or Bluetti lithium battery will power essentials.
                </p>
                <div style="margin-top: auto; padding-top: 16px;">
                    <a href="/calculators/portable-power-station-runtime.php" class="btn btn-primary" style="width: 100%;">
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
