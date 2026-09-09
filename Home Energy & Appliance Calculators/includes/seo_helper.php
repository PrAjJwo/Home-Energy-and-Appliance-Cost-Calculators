<?php
/**
 * SEO & Rank Math Schema Generator
 * Outputs clean meta tags, OpenGraph, Twitter Cards, and Schema.org JSON-LD.
 * Strictly NO em dashes allowed in titles, descriptions, or keywords.
 */

function render_seo_head($page_title, $meta_description, $focus_keyword, $canonical_path = '', $schema_type = 'WebApplication', $custom_schema = []) {
    $base_url = defined('SITE_URL') ? SITE_URL : 'http://localhost:8080';
    $canonical_url = rtrim($base_url, '/') . '/' . ltrim($canonical_path, '/');
    $image_url = rtrim($base_url, '/') . '/assets/images/smart_energy_home.jpg';
    
    // Clean any accidental em dashes if present
    $clean_title = str_replace(['—', '–'], '-', $page_title);
    $clean_desc = str_replace(['—', '–'], '-', $meta_description);
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($clean_title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($clean_desc); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($focus_keyword); ?>, energy calculator, electricity cost, kilowatt hours, home energy savings, power consumption">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <link rel="canonical" href="<?php echo htmlspecialchars($canonical_url); ?>">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonical_url); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($clean_title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($clean_desc); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($image_url); ?>">
    <meta property="og:site_name" content="VoltMetrics">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo htmlspecialchars($canonical_url); ?>">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($clean_title); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($clean_desc); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($image_url); ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- App Styles -->
    <link rel="stylesheet" href="<?php echo rtrim($base_url, '/'); ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo rtrim($base_url, '/'); ?>/assets/css/calculator.css">

    <!-- Schema.org JSON-LD Markup -->
    <script type="application/ld+json">
    <?php
    $default_schema = [
        '@context' => 'https://schema.org',
        '@type' => $schema_type,
        'name' => $clean_title,
        'description' => $clean_desc,
        'url' => $canonical_url,
        'applicationCategory' => 'UtilityApplication',
        'operatingSystem' => 'All modern web browsers',
        'offers' => [
            '@type' => 'Offer',
            'price' => '0',
            'priceCurrency' => 'USD'
        ],
        'provider' => [
            '@type' => 'Organization',
            'name' => 'VoltMetrics Home Energy Solutions',
            'url' => $base_url
        ]
    ];
    $merged_schema = !empty($custom_schema) ? array_merge($default_schema, $custom_schema) : $default_schema;
    echo json_encode($merged_schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    ?>
    </script>
    <?php
}

function render_rank_math_pill($score = 96, $keyword = '') {
    // Internal SEO audit controls are restricted to /admin/ and excluded from public front-end pages
    return;
}
