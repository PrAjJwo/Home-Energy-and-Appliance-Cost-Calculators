<?php
if (!defined('SITE_NAME')) {
    require_once __DIR__ . '/../../config/site_config.php';
}
if (!isset($CURRENCY_EXCHANGE_RATES)) {
    require_once __DIR__ . '/../../config/rates.php';
}

$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'VoltMetrics Admin Console'; ?></title>
    <meta name="robots" content="noindex, nofollow">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Base Styles & SEO Admin Styles -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/calculator.css">
    <link rel="stylesheet" href="/assets/css/seo-dashboard.css">
    
    <style>
        /* Dedicated Admin Header & Shell */
        .admin-topbar {
            background: #0f172a;
            border-bottom: 1px solid #1e293b;
            color: #f8fafc;
            padding: 0 24px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .admin-topbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
            max-width: 1400px;
            margin: 0 auto;
        }
        .admin-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #fff;
        }
        .admin-badge {
            background: rgba(16, 185, 129, 0.18);
            color: #34d399;
            border: 1px solid rgba(52, 211, 153, 0.3);
            font-size: 0.6875rem;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .admin-nav {
            display: flex;
            align-items: center;
            gap: 8px;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .admin-nav a {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            color: #94a3b8;
            text-decoration: none;
            transition: all 0.15s ease;
        }
        .admin-nav a:hover {
            color: #f8fafc;
            background: #1e293b;
        }
        .admin-nav a.active {
            color: #10b981;
            background: rgba(16, 185, 129, 0.12);
            border: 1px solid rgba(16, 185, 129, 0.25);
        }
        .admin-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .btn-view-site {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #1e293b;
            color: #e2e8f0;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.8125rem;
            font-weight: 600;
            text-decoration: none;
            border: 1px solid #334155;
            transition: all 0.2s;
        }
        .btn-view-site:hover {
            background: #334155;
            color: #fff;
            border-color: #475569;
        }
        .admin-content-shell {
            background-color: #f1f5f9;
            min-height: calc(100vh - 120px);
            padding: 32px 0 60px;
        }
    </style>
</head>
<body>

<header class="admin-topbar">
    <div class="admin-topbar-inner">
        <a href="/admin/seo-dashboard.php" class="admin-brand">
            <div class="brand-icon" style="background: linear-gradient(135deg, #10b981, #059669); color: white; width: 34px; height: 34px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
            </div>
            <div>
                <div style="font-family: var(--font-heading); font-weight: 800; font-size: 1.125rem; letter-spacing: -0.02em; line-height: 1.1;">
                    Volt<span style="color: #10b981;">Metrics</span>
                </div>
                <div style="font-size: 0.6875rem; color: #94a3b8; font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase;">
                    Admin & SEO Console
                </div>
            </div>
            <span class="admin-badge">Admin Mode</span>
        </a>

        <nav>
            <ul class="admin-nav">
                <li>
                    <a href="/admin/seo-dashboard.php" class="<?php echo ($current_page == 'seo-dashboard.php') ? 'active' : ''; ?>">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                        Rank Math SEO Manager
                    </a>
                </li>
                <li>
                    <a href="/admin/wordpress-integration.php" class="<?php echo ($current_page == 'wordpress-integration.php') ? 'active' : ''; ?>">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 3v18"/><path d="M14 9h4"/><path d="M14 15h4"/></svg>
                        WordPress & CMS Integration
                    </a>
                </li>
            </ul>
        </nav>

        <div class="admin-actions">
            <a href="/" target="_blank" class="btn-view-site" title="Open public facing site in new tab">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                View Public Site
            </a>
        </div>
    </div>
</header>

<div class="admin-content-shell">
