<?php
/**
 * The header for our theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

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
                <?php 
                global $CURRENCY_EXCHANGE_RATES;
                if (!empty($CURRENCY_EXCHANGE_RATES)): 
                    foreach ($CURRENCY_EXCHANGE_RATES as $code => $cdata): ?>
                        <option value="<?php echo esc_attr($code); ?>" data-symbol="<?php echo esc_attr($cdata['symbol']); ?>" data-rate="<?php echo esc_attr($cdata['rate_to_usd']); ?>" data-default-kwh="<?php echo esc_attr($cdata['default_rate_per_kwh']); ?>">
                            <?php echo esc_html($code); ?> (<?php echo esc_html($cdata['symbol']); ?>)
                        </option>
                    <?php endforeach; 
                endif; ?>
            </select>
        </div>
    </div>
</div>

<!-- Main Header & Navigation -->
<header class="main-header" id="mainHeader">
    <div class="container nav-container">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-logo" aria-label="VoltMetrics Home">
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
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class'     => 'nav-list',
                'container'      => false,
                'fallback_cb'    => false,
            ));
            ?>
        </nav>

        <div class="nav-actions">
            <a href="<?php echo esc_url(home_url('/all-calculators/')); ?>" class="btn btn-primary btn-sm">
                Explore All Tools
            </a>
            <button class="mobile-toggle" id="mobileMenuBtn" aria-label="Toggle Navigation Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>
