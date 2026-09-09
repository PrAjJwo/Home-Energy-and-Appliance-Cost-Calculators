<?php
// Reusable Category Switcher Navigation Bar
$active_cat_id = $active_cat_id ?? '';
?>
<div style="background: var(--white); border-bottom: 1px solid var(--border-subtle); padding: 12px 0; margin-bottom: 24px;">
    <div class="container" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
        <span style="font-size: 0.8125rem; font-weight: 800; color: var(--slate-500); text-transform: uppercase; letter-spacing: 0.05em;">
            Browse by Category:
        </span>
        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
            <a href="/categories/appliances.php" 
               style="padding: 6px 14px; border-radius: var(--radius-pill); font-size: 0.8125rem; font-weight: 700; text-decoration: none; transition: all var(--transition-fast); <?php echo ($active_cat_id === 'appliances') ? 'background: var(--emerald-600); color: var(--white);' : 'background: var(--slate-100); color: var(--slate-700);'; ?>">
                1. Appliances (3)
            </a>
            <a href="/categories/hvac-cooling-heating.php" 
               style="padding: 6px 14px; border-radius: var(--radius-pill); font-size: 0.8125rem; font-weight: 700; text-decoration: none; transition: all var(--transition-fast); <?php echo ($active_cat_id === 'hvac') ? 'background: var(--emerald-600); color: var(--white);' : 'background: var(--slate-100); color: var(--slate-700);'; ?>">
                2. HVAC & Climate (5)
            </a>
            <a href="/categories/backup-power.php" 
               style="padding: 6px 14px; border-radius: var(--radius-pill); font-size: 0.8125rem; font-weight: 700; text-decoration: none; transition: all var(--transition-fast); <?php echo ($active_cat_id === 'backup') ? 'background: var(--emerald-600); color: var(--white);' : 'background: var(--slate-100); color: var(--slate-700);'; ?>">
                3. Backup Power (4)
            </a>
            <a href="/categories/ev-utility.php" 
               style="padding: 6px 14px; border-radius: var(--radius-pill); font-size: 0.8125rem; font-weight: 700; text-decoration: none; transition: all var(--transition-fast); <?php echo ($active_cat_id === 'ev_utility') ? 'background: var(--emerald-600); color: var(--white);' : 'background: var(--slate-100); color: var(--slate-700);'; ?>">
                4. EV & Utility (3)
            </a>
            <a href="/all-calculators.php" 
               style="padding: 6px 14px; border-radius: var(--radius-pill); font-size: 0.8125rem; font-weight: 800; background: var(--emerald-50); color: var(--emerald-800); border: 1px solid var(--emerald-300); text-decoration: none;">
                All 15 Tools &rarr;
            </a>
        </div>
    </div>
</div>
