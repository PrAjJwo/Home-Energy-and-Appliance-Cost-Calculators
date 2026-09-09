# Home Energy & Appliance Cost Calculators

A high-precision, client-side energy intelligence and electrical cost calculation suite designed for homeowners, property managers, solar/battery installers, EV owners, and HVAC specialists.

---

## 📁 Repository Structure

```
home-energy-and-appliance-cost-calculators/
│
├── README.md                              # Main repository overview & documentation
├── .gitignore                             # Global Git exclusion rules
│
└── Home Energy & Appliance Calculators/   # Full Application Suite
    ├── assets/                            # CSS styles, JS logic, and media assets
    │   ├── css/                           # Core stylesheets and responsive layouts
    │   ├── js/                            # Currency converters, calculator engines, presets
    │   └── images/                        # Infographics, badges, and visual diagrams
    │
    ├── calculators/                       # 15 Interactive PHP Calculator Applications
    ├── categories/                        # 4 Curated Category Hub Pages
    ├── config/                            # Regional electricity benchmarks & currency rates
    ├── includes/                          # Shared components (navigation, header, footer, SEO)
    │
    ├── wordpress-theme/                   # Complete Native WordPress Theme (VoltMetrics)
    │   └── voltmetrics/                   # Full WP theme files with all 15 page templates
    │
    ├── wordpress-plugin/                  # Companion Plugin for Embeds & Shortcodes
    │   └── voltmetrics-calculators/
    │
    ├── voltmetrics-theme.zip              # Production-ready installable WordPress Theme package
    ├── index.php                          # Main suite homepage & quick-access portal
    └── all-calculators.php                # Complete categorized directory of all tools
```

---

## ⚡ Quick Start

### Option 1: Standalone Web Server
Run the suite using any standard PHP development server:

```cmd
cd "Home Energy & Appliance Calculators"
php -S localhost:8080
```
- **Website URL**: `http://localhost:8080/`
- **All Calculators Directory**: `http://localhost:8080/all-calculators.php`

### Option 2: WordPress Installation
The repository includes the complete, native WordPress theme **VoltMetrics**:

1. Log into your WordPress Dashboard (`/wp-admin/`).
2. Navigate to **Appearance → Themes → Add New → Upload Theme**.
3. Upload `voltmetrics-theme.zip` and click **Activate**.
4. All 15 calculators, 4 category hubs, and the homepage are ready to publish and manage. Fully compatible with **Rank Math SEO** and modern block editors.

---

## 🛠️ The 15 Included Calculators

### ⚡ 1. Home Appliances & Daily Power (`/categories/appliances.php`)
1. **Appliance Electricity Cost Calculator** (`/calculators/appliance-electricity-cost.php`): Models kilowatt-hour (kWh) usage and operating cost over hourly, daily, monthly, and annual cycles across 50+ household appliance presets.
2. **Refrigerator Energy Cost Calculator** (`/calculators/refrigerator-energy-cost.php`): Compares standard versus ENERGY STAR certified refrigerators, annual kWh ratings, age degradation factors, and replacement payback periods.
3. **Ceiling Fan Electricity Cost Calculator** (`/calculators/ceiling-fan-electricity.php`): Calculates operating expenses across speed settings (low, medium, high) and models AC savings realized from the wind-chill thermostat offset effect.
4. **Watts to Monthly Cost Calculator** (`/calculators/watts-to-monthly-cost.php`): Instant electrical wattage converter transforming continuous or intermittent wattage draw into daily, monthly, and yearly utility bill impacts.

### ❄️ 2. Heating & Cooling (HVAC) (`/categories/hvac-cooling-heating.php`)
5. **Air Conditioner Running Cost Calculator** (`/calculators/air-conditioner-running-cost.php`): Comprehensive cooling cost model factoring BTU capacities, SEER/SEER2 efficiency ratings, regional climate duty cycles, and electricity rate tiers.
6. **Mini-Split Heat Pump Operating Cost Calculator** (`/calculators/mini-split-electricity-cost.php`): Evaluates dual heating and cooling costs with SEER2 cooling and HSPF2 heating metrics, multi-zone configurations, and inverter modulation factors.
7. **Space Heater Electricity Cost Calculator** (`/calculators/space-heater-cost.php`): Analyzes 750W–1500W electric space heater runtime costs, duty cycle thermostat cycling, and room heating economics.
8. **Heat Pump vs Electric Baseboard Savings Calculator** (`/calculators/heat-pump-savings.php`): Calculates operational cost reductions and annual financial savings when upgrading from 100% efficient electric resistance heating (COP 1.0) to high-efficiency cold-climate heat pumps (COP 2.5–4.0).

### 🚗 3. Electric Vehicles & Utility Planning (`/categories/ev-utility.php`)
9. **EV Home Charging Cost Calculator** (`/calculators/ev-home-charging-cost.php`): Calculates full recharge expense, cost-per-mile, and monthly charging budgets based on battery capacity (kWh), Level 1 vs Level 2 charging efficiency (85%–90%), and utility rates.
10. **Electricity Bill Increase / Tiered Rate Calculator** (`/calculators/electricity-bill-increase.php`): Models utility bill spikes, baseline baseline allowances, and tiered marginal kWh rate pricing brackets.
11. **Pool Pump Energy Cost Calculator** (`/calculators/pool-pump-electricity.php`): Compares single-speed, dual-speed, and variable-speed pool pumps (VSP) running schedules, flow rates, and annual energy conservation savings.

### 🔋 4. Backup Power & Off-Grid Energy (`/categories/backup-power.php`)
12. **Portable Power Station Runtime Calculator** (`/calculators/portable-power-station-runtime.php`): Precision battery runtime estimator factoring usable capacity (Depth of Discharge / DoD), DC-to-AC inverter conversion efficiency (85%), and device standby power drain.
13. **Solar Battery Storage Runtime Calculator** (`/calculators/solar-battery-runtime.php`): Determines whole-home or critical-load backup duration in hours and days based on battery bank capacity (kWh), continuous load, and solar PV recharge replenishment.
14. **Generator Fuel Cost Calculator** (`/calculators/generator-fuel-cost.php`): Projects fuel expenses per hour, day, and extended outage across Gasoline, Propane (LPG), and Natural Gas generator models at 25%, 50%, and 100% electrical loads.
15. **Generator Runtime & Fuel Consumption Calculator** (`/calculators/generator-runtime.php`): Models run hours per tank, fuel consumption rates (gal/hr or L/hr), and refueling schedules during emergency power interruptions.

---

## 📐 Mathematical Modeling & Standards

All calculators implement formulas benchmarked against standard engineering references:

- **Kilowatt-Hour Conversion**:
  $$\text{Daily kWh} = \frac{\text{Watts} \times \text{Hours/Day}}{1000}$$
  $$\text{Cost} = \text{kWh} \times \text{Utility Rate (\$/kWh)}$$

- **HVAC SEER2 Electrical Power**:
  $$\text{Average Power (Watts)} = \frac{\text{Capacity (BTU/hr)}}{\text{SEER2}}$$

- **Battery Runtime with Inverter Efficiency & DoD**:
  $$\text{Effective Capacity (Wh)} = \text{Rated Capacity (Wh)} \times \text{DoD (0.85 - 0.95)}$$
  $$\text{Runtime (Hours)} = \frac{\text{Effective Capacity (Wh)} \times \eta_{\text{inverter}} (0.85)}{\text{Load (Watts)} + P_{\text{standby}}}$$

- **Zero-Value Safe Validation**:
  All calculators include input sanitation guarding against division by zero, non-numeric values, and negative inputs.

---

## 📈 SEO & Performance Highlights

- **Semantic HTML5 & Accessible Controls**: Structured form inputs with proper ARIA attributes, explicit labels, and intuitive tooltips.
- **Rank Math Schema Compatible**: Ready for `SoftwareApplication`, `WebApplication`, and `FAQPage` structured JSON-LD data.
- **Client-Side Responsiveness**: Calculations execute instantly in vanilla JavaScript with zero network latency.
- **Multi-Currency Engine**: Integrated switcher for USD ($), EUR (€), GBP (£), CAD ($), AUD ($), and custom utility pricing.

---

## 📄 License

GPL-2.0-or-later
