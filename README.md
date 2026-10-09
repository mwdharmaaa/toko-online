# Mono Archive - Minimalist Monochrome Online Store

A high-craft, production-grade e-commerce storefront and content management system engineered with Laravel 11, SQLite, Native Blade templates, Pure CSS (no framework), and Vanilla JavaScript (no framework). Designed with a strict monochrome visual palette: pure white background and razor-sharp black accents.

## Architecture & Technology Stack

- **Backend**: Laravel 11 (PHP 8.3+) following Laravel best practices, Form Requests, eager loading, and Semantic Atomic Architecture.
- **Database**: SQLite (`database/database.sqlite`), lightweight and zero-configuration.
- **Frontend Views**: Native Laravel Blade components (`resources/views`).
- **Styling**: Pure CSS (`public/css/style.css`, `public/css/admin.css`) with zero framework dependencies (No Tailwind, No Bootstrap).
- **Interactivity**: Vanilla JavaScript (`public/js/app.js`, `public/js/admin.js`) with zero external libraries.
- **Visual Assets**: Procedural SVG vector artwork for products and journal essays.
- **Design Philosophy**: Strict black and white palette (`#ffffff` background, `#09090b` accents), linear typography hierarchy, zero emojis, and zero em dashes.

## Core Features

### 1. Storefront Landing Page (`/`)
- **Welcome Greeting Section**: Prominent store statement and operational value metrics.
- **Curated Collections**: Featured items and latest catalog listings with category tags.
- **Direct Catalog Navigation**: Instant category tabs and search filters.
- **Editorial Journal Preview**: Highlights from the store blog.

### 2. Product Detail Page (`/products/{slug}`)
- High-resolution product showcase and structured technical specifications table (Material, Dimensions, Capacity, Warranty).
- **Interactive WhatsApp Order Builder**:
  - Real-time quantity stepper (+ and -) and optional customer order notes.
  - Live message preview box compiling store name, SKU, price, quantity, subtotal, and notes.
  - Direct "Pesan via WhatsApp Sekarang" button pointing to admin's configured WhatsApp number.
  - "Salin Format Pesan" clipboard button with instant toast notification.

### 3. Administrative Control Panel (`/admin`)
- **Secure Authentication**: Dedicated admin guard and session handling (`admin@monoarchive.id` / `admin12345`).
- **Operational Dashboard**: Real-time stats (Total Products, Low Stock Alerts, Categories, Blog Posts).
- **Product Management (`/admin/products`)**: Full CRUD with search, category filtering, file image uploads, URL fallback, and multiline specification parser.
- **Category Management (`/admin/categories`)**: Full CRUD with active status controls.
- **Blog Management (`/admin/blog`)**: Full CRUD for articles with reading time calculator and publication status.
- **Store & WhatsApp Configuration (`/admin/settings`)**: Live configuration for store name, hero greeting, WhatsApp admin phone number, and customizable WhatsApp template with live sample tester.

### 4. Editorial Blog Section (`/blog`)
- Minimalist publication archive for articles, care guides, and design essays.
- Single post reading layout with estimated reading time, author metadata, and WhatsApp share buttons.

## Directory Structure

```text
toko-online/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/            # Admin controllers (Auth, Dashboard, Product, Category, Blog, Setting)
│   │   │   ├── BlogController.php
│   │   │   ├── HomeController.php
│   │   │   └── ProductController.php
│   │   ├── Middleware/           # EnsureUserIsAdmin guard
│   │   └── Requests/             # Form Requests & DTO validations
│   └── Models/                   # Eloquent models (Product, Category, BlogPost, SiteSetting, User)
├── database/
│   ├── migrations/               # SQLite schema definitions
│   └── seeders/                  # Production-grade seeders & procedural SVG generator
├── public/
│   ├── css/                      # Pure CSS design system (style.css, admin.css)
│   ├── js/                       # Vanilla JS handlers (app.js, admin.js)
│   └── images/                   # Monochrome vector assets
├── resources/
│   └── views/                    # Native Blade templates
├── tests/
│   └── Feature/                  # Automated test suite (StorefrontTest, AdminPanelTest)
├── deploy.sh                     # Single-enter deployment script
├── redeploy.sh                   # Zero-friction redeployment script
└── runtest.sh                    # Automated test runner
```

## Quick Start (Single-Enter)

```bash
# Clone the repository
git clone https://github.com/mwdharmaaa/toko-online.git
cd toko-online

# Execute deployment bundle
./deploy.sh

# Run test suite
./runtest.sh

# Launch local development server
php artisan serve
```

### Default Credentials

- **Storefront**: `http://127.0.0.1:8000`
- **Admin Panel**: `http://127.0.0.1:8000/admin`
- **Email**: `admin@monoarchive.id`
- **Password**: `admin12345`
