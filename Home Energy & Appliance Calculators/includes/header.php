<?php
if (!defined('SITE_NAME')) {
    require_once __DIR__ . '/../config/site_config.php';
}
if (!isset($CURRENCY_EXCHANGE_RATES)) {
    require_once __DIR__ . '/../config/rates.php';
}
?>
<!-- Top Ticker & Currency Bar -->
<div class="top-utility-bar">
    <div class="container utility-flex">
        <div class="utility-left">
            <span class="live-dot"></span>
            <span class="utility-text"><strong>2026 Grid Benchmark:</strong> US Baseline 18.3¢/kWh | UK 26.11p + 57.2p/day | EU €0.290 | 15 Specialized Calculators Active</span>
        </div>
        <div class="utility-right">
            <label for="currencySelect" class="currency-label">Currency:</label>
            <select id="currencySelect" class="currency-select" aria-label="Select Currency">
                <?php foreach ($CURRENCY_EXCHANGE_RATES as $code => $cdata): ?>
                    <option value="<?php echo $code; ?>" data-symbol="<?php echo $cdata['symbol']; ?>" data-rate="<?php echo $cdata['rate_to_usd']; ?>" data-default-kwh="<?php echo $cdata['default_rate_per_kwh']; ?>">
                        <?php echo $code; ?> (<?php echo $cdata['symbol']; ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>

<!-- Main Header & Navigation -->
<header class="main-header" id="mainHeader">
    <div class="container nav-container">
        <a href="/" class="brand-logo" aria-label="VoltMetrics Home">
            <div class="brand-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                </svg>
            </div>
            <div class="brand-text">
                <span class="brand-name">Volt<span class="brand-highlight">Metrics</span></span>
                <span class="brand-sub">Home Energy Intelligence</span>
            </div>
        </a>

        <!-- Desktop Navigation -->
        <nav class="desktop-nav" aria-label="Main Navigation">
            <ul class="nav-list">
                <li><a href="/" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php' && strpos($_SERVER['PHP_SELF'], 'calculators') === false) ? 'active' : ''; ?>">Home</a></li>
                
                <li>
                    <a href="/all-calculators.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'all-calculators.php') ? 'active' : ''; ?>">
                        All Calculators
                        <span style="background: var(--emerald-100); color: var(--emerald-800); font-size: 0.6875rem; font-weight: 800; padding: 2px 7px; border-radius: var(--radius-pill); margin-left: 4px;">15</span>
                    </a>
                </li>

                <li class="has-dropdown">
                    <a href="/all-calculators.php" class="nav-link dropdown-toggle">
                        Categories & Tools
                        <svg class="chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                    <div class="nav-dropdown mega-dropdown">
                        <!-- Col 1 -->
                        <div class="mega-col">
                            <div class="mega-col-header">
                                <a href="/categories/appliances.php" class="mega-cat-title">1. Everyday Appliances</a>
                                <span class="mega-cat-count">3 Tools</span>
                            </div>
                            <ul class="mega-tool-list">
                                <li><a href="/calculators/appliance-electricity-cost.php" class="mega-link is-pop"><span class="pop-bullet">&#9733;</span> Appliance Cost</a></li>
                                <li><a href="/calculators/watts-to-monthly-cost.php" class="mega-link">Watts to Monthly Cost</a></li>
                                <li><a href="/calculators/refrigerator-energy-cost.php" class="mega-link">Refrigerator Energy</a></li>
                            </ul>
                            <a href="/categories/appliances.php" class="mega-hub-link">Category Hub &rarr;</a>
                        </div>

                        <!-- Col 2 -->
                        <div class="mega-col">
                            <div class="mega-col-header">
                                <a href="/categories/hvac-cooling-heating.php" class="mega-cat-title">2. HVAC & Climate</a>
                                <span class="mega-cat-count">5 Tools</span>
                            </div>
                            <ul class="mega-tool-list">
                                <li><a href="/calculators/air-conditioner-running-cost.php" class="mega-link is-pop"><span class="pop-bullet">&#9733;</span> AC Running Cost</a></li>
                                <li><a href="/calculators/mini-split-electricity-cost.php" class="mega-link">Mini-Split Inverter</a></li>
                                <li><a href="/calculators/space-heater-cost.php" class="mega-link">Space Heater Cost</a></li>
                                <li><a href="/calculators/heat-pump-savings.php" class="mega-link">Heat Pump Savings</a></li>
                                <li><a href="/calculators/ceiling-fan-electricity.php" class="mega-link">Ceiling Fan Energy</a></li>
                            </ul>
                            <a href="/categories/hvac-cooling-heating.php" class="mega-hub-link">Category Hub &rarr;</a>
                        </div>

                        <!-- Col 3 -->
                        <div class="mega-col">
                            <div class="mega-col-header">
                                <a href="/categories/backup-power.php" class="mega-cat-title">3. Backup Power</a>
                                <span class="mega-cat-count">4 Tools</span>
                            </div>
                            <ul class="mega-tool-list">
                                <li><a href="/calculators/generator-runtime.php" class="mega-link is-pop"><span class="pop-bullet">&#9733;</span> Generator Runtime</a></li>
                                <li><a href="/calculators/generator-fuel-cost.php" class="mega-link">Generator Fuel Cost</a></li>
                                <li><a href="/calculators/solar-battery-runtime.php" class="mega-link">Solar Battery Runtime</a></li>
                                <li><a href="/calculators/portable-power-station-runtime.php" class="mega-link">Power Station Sizing</a></li>
                            </ul>
                            <a href="/categories/backup-power.php" class="mega-hub-link">Category Hub &rarr;</a>
                        </div>

                        <!-- Col 4 -->
                        <div class="mega-col">
                            <div class="mega-col-header">
                                <a href="/categories/ev-utility.php" class="mega-cat-title">4. EV & High Utility</a>
                                <span class="mega-cat-count">3 Tools</span>
                            </div>
                            <ul class="mega-tool-list">
                                <li><a href="/calculators/ev-home-charging-cost.php" class="mega-link is-pop"><span class="pop-bullet">&#9733;</span> EV Home Charging</a></li>
                                <li><a href="/calculators/pool-pump-electricity.php" class="mega-link">Pool Pump Energy</a></li>
                                <li><a href="/calculators/electricity-bill-increase.php" class="mega-link">Bill Increase Spike</a></li>
                            </ul>
                            <a href="/categories/ev-utility.php" class="mega-hub-link">Category Hub &rarr;</a>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="nav-actions">
            <a href="/all-calculators.php" class="btn btn-primary btn-sm">
                Explore All 15 Tools
            </a>
            <button class="mobile-toggle" id="mobileMenuBtn" aria-label="Toggle Navigation Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>

    <!-- Mobile Drawer -->
    <div class="mobile-menu" id="mobileMenu">
        <ul class="mobile-nav-list">
            <li><a href="/" class="mobile-link">Home</a></li>
            <li><a href="/all-calculators.php" class="mobile-link" style="font-weight: 800; color: var(--emerald-700);">All 15 Calculators Directory</a></li>
            
            <li class="mobile-divider">1. Everyday Household Appliances</li>
            <li><a href="/calculators/appliance-electricity-cost.php" class="mobile-link">&bull; Appliance Electricity Cost (Popular)</a></li>
            <li><a href="/calculators/watts-to-monthly-cost.php" class="mobile-link">&bull; Watts to Monthly Cost</a></li>
            <li><a href="/calculators/refrigerator-energy-cost.php" class="mobile-link">&bull; Refrigerator Energy Cost</a></li>

            <li class="mobile-divider">2. HVAC, Heating & Cooling</li>
            <li><a href="/calculators/air-conditioner-running-cost.php" class="mobile-link">&bull; Air-Conditioner Running Cost (Popular)</a></li>
            <li><a href="/calculators/mini-split-electricity-cost.php" class="mobile-link">&bull; Mini-Split Inverter Cost</a></li>
            <li><a href="/calculators/space-heater-cost.php" class="mobile-link">&bull; Space Heater Cost</a></li>
            <li><a href="/calculators/heat-pump-savings.php" class="mobile-link">&bull; Heat Pump Savings</a></li>
            <li><a href="/calculators/ceiling-fan-electricity.php" class="mobile-link">&bull; Ceiling Fan Electricity</a></li>

            <li class="mobile-divider">3. Backup Power & Off-Grid</li>
            <li><a href="/calculators/generator-runtime.php" class="mobile-link">&bull; Generator Runtime (Popular)</a></li>
            <li><a href="/calculators/generator-fuel-cost.php" class="mobile-link">&bull; Generator Fuel Cost</a></li>
            <li><a href="/calculators/solar-battery-runtime.php" class="mobile-link">&bull; Solar Battery Storage Runtime</a></li>
            <li><a href="/calculators/portable-power-station-runtime.php" class="mobile-link">&bull; Portable Power Station Sizing</a></li>

            <li class="mobile-divider">4. EV & High-Load Utility</li>
            <li><a href="/calculators/ev-home-charging-cost.php" class="mobile-link">&bull; EV Home Charging Cost (Popular)</a></li>
            <li><a href="/calculators/pool-pump-electricity.php" class="mobile-link">&bull; Pool Pump Electricity</a></li>
            <li><a href="/calculators/electricity-bill-increase.php" class="mobile-link">&bull; Electricity Bill Increase</a></li>
        </ul>
    </div>
</header>
