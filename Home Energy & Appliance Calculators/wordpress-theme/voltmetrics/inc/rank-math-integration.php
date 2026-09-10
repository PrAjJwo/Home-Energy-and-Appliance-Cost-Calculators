<?php
/**
 * Rank Math SEO Native Integration for VoltMetrics
 * Automatically configures Rank Math focus keywords, titles, descriptions,
 * robots directives, and Schema.org rich snippets for all 15 calculators.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Registry of all 15 calculators and their Rank Math SEO parameters.
 */
function voltmetrics_get_seo_catalog() {
    return [
        'air-conditioner-running-cost' => [
            'template'       => 'page-template-air-conditioner-running-cost.php',
            'name'           => 'Air Conditioner Running Cost Calculator',
            'focus_keyword'  => 'air conditioner running cost calculator',
            'secondary_kw'   => 'ac running cost, seer2 cooling cost, air conditioner electricity cost',
            'seo_title'      => 'Air Conditioner Running Cost Calculator (2026 SEER2)',
            'meta_desc'      => 'Use our air conditioner running cost calculator to estimate central AC and window unit electricity costs per hour, month, and summer season with 2026 rates.',
            'schema_type'    => 'WebApplication',
            'category'       => 'Heating & Cooling (HVAC)',
            'category_slug'  => 'hvac-cooling-heating'
        ],
        'appliance-electricity-cost' => [
            'template'       => 'page-template-appliance.php',
            'name'           => 'Appliance Electricity Cost Calculator',
            'focus_keyword'  => 'appliance electricity cost calculator',
            'secondary_kw'   => 'home appliance power usage, electricity cost per kwh, energy star savings',
            'seo_title'      => 'Appliance Electricity Cost Calculator - 2026 Power Usage',
            'meta_desc'      => 'Free appliance electricity cost calculator to estimate kWh usage and power bills for 50+ home appliances. Compare Energy Star savings with 2026 tariffs.',
            'schema_type'    => 'WebApplication',
            'category'       => 'Home Appliances & Daily Power',
            'category_slug'  => 'appliances'
        ],
        'ceiling-fan-electricity' => [
            'template'       => 'page-template-ceiling-fan-electricity.php',
            'name'           => 'Ceiling Fan Electricity Calculator',
            'focus_keyword'  => 'ceiling fan electricity calculator',
            'secondary_kw'   => 'ceiling fan wattage cost, fan running cost, ceiling fan ac savings',
            'seo_title'      => 'Ceiling Fan Electricity Calculator (2026 Power Cost)',
            'meta_desc'      => 'Our ceiling fan electricity calculator estimates hourly, daily, and monthly operating costs. Discover how the wind-chill effect saves on AC cooling bills.',
            'schema_type'    => 'WebApplication',
            'category'       => 'Home Appliances & Daily Power',
            'category_slug'  => 'appliances'
        ],
        'electricity-bill-increase' => [
            'template'       => 'page-template-electricity-bill-increase.php',
            'name'           => 'Electricity Bill Increase Calculator',
            'focus_keyword'  => 'electricity bill increase calculator',
            'secondary_kw'   => 'electric bill spike estimator, tiered tariff calculator, ev power bill increase',
            'seo_title'      => 'Electricity Bill Increase Calculator - Tariff Spikes (2026)',
            'meta_desc'      => 'Use this electricity bill increase calculator to forecast utility bill spikes from new appliances, EVs, heat pumps, or higher tiered kilowatt-hour tariffs.',
            'schema_type'    => 'WebApplication',
            'category'       => 'Electric Vehicles & Utility Planning',
            'category_slug'  => 'ev-utility'
        ],
        'ev-home-charging-cost' => [
            'template'       => 'page-template-ev-home-charging-cost.php',
            'name'           => 'EV Home Charging Cost Calculator',
            'focus_keyword'  => 'ev home charging cost calculator',
            'secondary_kw'   => 'electric car charging cost, level 2 charger cost, ev vs gas savings',
            'seo_title'      => 'EV Home Charging Cost Calculator - 2026 Electric Car Bill',
            'meta_desc'      => 'Calculate EV charging costs per full charge, per mile, and per month with our ev home charging cost calculator. Compare Level 1 vs Level 2 and gas savings.',
            'schema_type'    => 'WebApplication',
            'category'       => 'Electric Vehicles & Utility Planning',
            'category_slug'  => 'ev-utility'
        ],
        'generator-fuel-cost' => [
            'template'       => 'page-template-generator-fuel-cost.php',
            'name'           => 'Generator Fuel Cost Calculator',
            'focus_keyword'  => 'generator fuel cost calculator',
            'secondary_kw'   => 'generator gas cost per hour, propane generator cost, diesel generator fuel expense',
            'seo_title'      => 'Generator Fuel Cost Calculator - Gas, Propane & Diesel',
            'meta_desc'      => 'Accurate generator fuel cost calculator to estimate hourly, daily, and storm outage fuel expenses across gas, propane, and natural gas emergency generators.',
            'schema_type'    => 'WebApplication',
            'category'       => 'Backup Power & Off-Grid Energy',
            'category_slug'  => 'backup-power'
        ],
        'generator-runtime' => [
            'template'       => 'page-template-generator-runtime.php',
            'name'           => 'Generator Runtime Calculator',
            'focus_keyword'  => 'generator runtime calculator',
            'secondary_kw'   => 'generator hours per tank, fuel consumption calculator, generator outage runtime',
            'seo_title'      => 'Generator Runtime Calculator - Hours Per Tank (2026)',
            'meta_desc'      => 'Our generator runtime calculator estimates operating hours per tank across 25%, 50%, and 100% electrical loads for gas, propane, and diesel generators.',
            'schema_type'    => 'WebApplication',
            'category'       => 'Backup Power & Off-Grid Energy',
            'category_slug'  => 'backup-power'
        ],
        'heat-pump-savings' => [
            'template'       => 'page-template-heat-pump-savings.php',
            'name'           => 'Heat Pump Savings Calculator',
            'focus_keyword'  => 'heat pump savings calculator',
            'secondary_kw'   => 'heat pump vs baseboard savings, heat pump heating cost, cop efficiency savings',
            'seo_title'      => 'Heat Pump Savings Calculator - Baseboard vs Heat Pump',
            'meta_desc'      => 'Use our heat pump savings calculator to model annual heating bill reductions when switching from electric resistance baseboards to high-COP heat pumps.',
            'schema_type'    => 'WebApplication',
            'category'       => 'Heating & Cooling (HVAC)',
            'category_slug'  => 'hvac-cooling-heating'
        ],
        'mini-split-electricity-cost' => [
            'template'       => 'page-template-mini-split-electricity-cost.php',
            'name'           => 'Mini-Split Electricity Cost Calculator',
            'focus_keyword'  => 'mini-split electricity cost calculator',
            'secondary_kw'   => 'ductless heat pump cost, seer2 hspf2 calculator, multi-zone mini-split running cost',
            'seo_title'      => 'Mini-Split Electricity Cost Calculator (SEER2 & HSPF2)',
            'meta_desc'      => 'Free mini-split electricity cost calculator for ductless heat pumps. Model seasonal cooling and winter heating expenses with modern SEER2 and HSPF2 metrics.',
            'schema_type'    => 'WebApplication',
            'category'       => 'Heating & Cooling (HVAC)',
            'category_slug'  => 'hvac-cooling-heating'
        ],
        'pool-pump-electricity' => [
            'template'       => 'page-template-pool-pump-electricity.php',
            'name'           => 'Pool Pump Electricity Calculator',
            'focus_keyword'  => 'pool pump electricity calculator',
            'secondary_kw'   => 'pool pump power cost, variable speed pool pump savings, pool pump kwh',
            'seo_title'      => 'Pool Pump Electricity Calculator - Variable Speed (2026)',
            'meta_desc'      => 'Calculate operating costs with our pool pump electricity calculator. Compare single-speed pumps against high-efficiency variable-speed pumps for savings.',
            'schema_type'    => 'WebApplication',
            'category'       => 'Electric Vehicles & Utility Planning',
            'category_slug'  => 'ev-utility'
        ],
        'portable-power-station-runtime' => [
            'template'       => 'page-template-portable-power-station-runtime.php',
            'name'           => 'Portable Power Station Runtime Calculator',
            'focus_keyword'  => 'portable power station runtime calculator',
            'secondary_kw'   => 'solar generator runtime, battery backup hours, power station wh calculator',
            'seo_title'      => 'Portable Power Station Runtime Calculator (2026 Wh)',
            'meta_desc'      => 'Accurate portable power station runtime calculator with 85% inverter efficiency and Depth of Discharge (DoD) modeling for EcoFlow, Jackery, and Bluetti.',
            'schema_type'    => 'WebApplication',
            'category'       => 'Backup Power & Off-Grid Energy',
            'category_slug'  => 'backup-power'
        ],
        'refrigerator-energy-cost' => [
            'template'       => 'page-template-refrigerator-energy-cost.php',
            'name'           => 'Refrigerator Energy Cost Calculator',
            'focus_keyword'  => 'refrigerator energy cost calculator',
            'secondary_kw'   => 'fridge electricity cost, refrigerator annual kwh, energy star fridge savings',
            'seo_title'      => 'Refrigerator Energy Cost Calculator - 2026 Fridge Power',
            'meta_desc'      => 'Free refrigerator energy cost calculator to estimate monthly fridge power bills, compare Energy Star models, and calculate old refrigerator replacement ROI.',
            'schema_type'    => 'WebApplication',
            'category'       => 'Home Appliances & Daily Power',
            'category_slug'  => 'appliances'
        ],
        'solar-battery-runtime' => [
            'template'       => 'page-template-solar-battery-runtime.php',
            'name'           => 'Solar Battery Runtime Calculator',
            'focus_keyword'  => 'solar battery runtime calculator',
            'secondary_kw'   => 'home battery backup hours, powerwall runtime, solar battery duration',
            'seo_title'      => 'Solar Battery Runtime Calculator - Home Backup Duration',
            'meta_desc'      => 'Use our solar battery runtime calculator to estimate home backup duration in hours and days based on battery kWh capacity, critical loads, and solar replenishment.',
            'schema_type'    => 'WebApplication',
            'category'       => 'Backup Power & Off-Grid Energy',
            'category_slug'  => 'backup-power'
        ],
        'space-heater-cost' => [
            'template'       => 'page-template-space-heater-cost.php',
            'name'           => 'Space Heater Cost Calculator',
            'focus_keyword'  => 'space heater cost calculator',
            'secondary_kw'   => 'electric heater running cost, 1500w heater electricity, space heater per hour',
            'seo_title'      => 'Space Heater Cost Calculator - 1500W Power Bill (2026)',
            'meta_desc'      => 'Calculate 750W to 1500W electric heater costs per hour, night, and month with our space heater cost calculator. Discover thermostat cycling economics.',
            'schema_type'    => 'WebApplication',
            'category'       => 'Heating & Cooling (HVAC)',
            'category_slug'  => 'hvac-cooling-heating'
        ],
        'watts-to-monthly-cost' => [
            'template'       => 'page-template-watts-to-monthly-cost.php',
            'name'           => 'Watts to Monthly Cost Calculator',
            'focus_keyword'  => 'watts to monthly cost calculator',
            'secondary_kw'   => 'watt to kwh cost, wattage to electricity bill, electrical power cost converter',
            'seo_title'      => 'Watts to Monthly Cost Calculator - 2026 Power Converter',
            'meta_desc'      => 'Convert wattage into daily and monthly utility bill impacts with our watts to monthly cost calculator. Instant kWh conversion for any household device.',
            'schema_type'    => 'WebApplication',
            'category'       => 'Home Appliances & Daily Power',
            'category_slug'  => 'appliances'
        ]
    ];
}

/**
 * Match current queried page to a calculator in our catalog.
 */
function voltmetrics_get_current_calculator_seo() {
    if ( ! is_page() ) {
        return null;
    }

    $catalog = voltmetrics_get_seo_catalog();
    $current_template = get_page_template_slug();
    $page_slug = get_post_field( 'post_name', get_queried_object_id() );

    foreach ( $catalog as $key => $data ) {
        if ( ( $current_template && $current_template === $data['template'] ) || $page_slug === $key ) {
            return $data;
        }
    }

    return null;
}

/**
 * Hook into Rank Math Title filter.
 */
add_filter( 'rank_math/frontend/title', function( $title ) {
    $calc = voltmetrics_get_current_calculator_seo();
    if ( $calc && ! empty( $calc['seo_title'] ) ) {
        return $calc['seo_title'];
    }
    return $title;
}, 15 );

/**
 * Hook into Rank Math Description filter.
 */
add_filter( 'rank_math/frontend/description', function( $description ) {
    $calc = voltmetrics_get_current_calculator_seo();
    if ( $calc && ! empty( $calc['meta_desc'] ) ) {
        return $calc['meta_desc'];
    }
    return $description;
}, 15 );

/**
 * Hook into Rank Math Focus Keyword filter.
 */
add_filter( 'rank_math/frontend/keywords', function( $keywords ) {
    $calc = voltmetrics_get_current_calculator_seo();
    if ( $calc && ! empty( $calc['focus_keyword'] ) ) {
        return $calc['focus_keyword'];
    }
    return $keywords;
}, 15 );

/**
 * Automatically inject SoftwareApplication schema into Rank Math JSON-LD.
 */
add_filter( 'rank_math/json_ld', function( $data, $jsonld ) {
    $calc = voltmetrics_get_current_calculator_seo();
    if ( ! $calc ) {
        return $data;
    }

    $permalink = get_permalink();
    $app_schema = [
        '@context'            => 'https://schema.org',
        '@type'               => 'SoftwareApplication',
        'name'                => $calc['seo_title'],
        'headline'            => $calc['name'],
        'description'         => $calc['meta_desc'],
        'url'                 => $permalink,
        'applicationCategory' => 'UtilityApplication',
        'operatingSystem'     => 'All modern web browsers (Chrome, Safari, Firefox, Edge)',
        'offers'              => [
            '@type'         => 'Offer',
            'price'         => '0',
            'priceCurrency' => 'USD'
        ],
        'provider'            => [
            '@type' => 'Organization',
            'name'  => 'VoltMetrics',
            'url'   => home_url( '/' )
        ]
    ];

    $data['SoftwareApplication'] = $app_schema;
    return $data;
}, 20, 2 );

/**
 * Admin action to batch-update Rank Math postmeta on all pages.
 */
function voltmetrics_sync_rank_math_meta() {
    $catalog = voltmetrics_get_seo_catalog();
    foreach ( $catalog as $slug => $data ) {
        $page = get_page_by_path( $slug );
        if ( ! $page ) {
            // Check by title
            $page = get_page_by_title( $data['name'] );
        }
        if ( $page ) {
            update_post_meta( $page->ID, 'rank_math_title', $data['seo_title'] );
            update_post_meta( $page->ID, 'rank_math_description', $data['meta_desc'] );
            update_post_meta( $page->ID, 'rank_math_focus_keyword', $data['focus_keyword'] );
            update_post_meta( $page->ID, 'rank_math_robots', [ 'index' ] );
        }
    }
}
add_action( 'after_switch_theme', 'voltmetrics_sync_rank_math_meta' );
