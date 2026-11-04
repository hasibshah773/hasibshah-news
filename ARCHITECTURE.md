# ARCHITECTURE.md: HasibShah News Theme

**Theme Name:** HasibShah News  
**Theme Slug:** `hasibshah-news`  
**Text Domain:** `hasibshah-news`  
**PHP Prefix:** `hasibshah_news_` / `HASIBSHAH_NEWS_`  
**Target Environment:** WordPress 6.6+ / 7.x, PHP 8.3 - 8.4 (Requires PHP: 8.3)  
*Note on Version Compatibility:* `theme.json` version 3 was introduced in WordPress 6.6. To guarantee 100% specification compatibility with `theme.json` v3, the minimum supported WordPress version is declared as **WordPress 6.6** (`Requires at least: 6.6`).

---

## 1. Architectural Evaluation: Classic vs. Hybrid vs. Block Theme

Choosing the right theme architecture is the single most critical technical decision for this project. Below is an in-depth comparison of the three architectural models in modern WordPress development.

| Criteria | Classic Theme (Pure PHP) | Block Theme (Full Site Editing / FSE) | Hybrid Theme (Modern Classic + `theme.json`) |
| :--- | :--- | :--- | :--- |
| **Core Template Language** | 100% PHP templates (`index.php`, `header.php`, `single.php`) | HTML block templates (`templates/index.html`) | PHP templates for logic & structure + `theme.json` for block styling |
| **Template Hierarchy** | Standard WordPress PHP Hierarchy | Block Template Hierarchy | Standard WordPress PHP Hierarchy |
| **Gutenberg Compatibility** | Basic (content area only) | Native & complete site-wide | High (styled via `theme.json` + editor styles) |
| **Elementor Compatibility** | Standard template hooks | High friction (FSE template routing conflicts) | **High (Standard hooks, clean containers & native templates)** |
| **Learning Curve for PHP Dev** | Focuses purely on PHP | Shifts away from PHP to JSON & Block markup | **Optimal for mastering PHP, hooks, query loops, and APIs** |
| **Complex Editorial News Grids** | Programmed via custom `WP_Query` loops | Requires custom dynamic blocks | **Modular PHP loops with complete query control** |
| **WordPress.org Acceptance** | Fully supported | Fully supported | **Fully supported & recommended** |

### Detailed Evaluation

#### Option A: Classic Theme (Pure PHP)
- **Advantages:** Complete programmatic freedom; standard WordPress hooks and template hierarchy; familiar workflow for PHP development.
- **Disadvantages:** Lacks modern Gutenberg editor integration if `theme.json` is omitted; block styles inside the content editor do not automatically reflect theme palettes.

#### Option B: Block Theme (FSE - Full Site Editing)
- **Advantages:** Visual site editing for end users; core WordPress direction.
- **Disadvantages:** Does not fit the objective of mastering PHP-based theme development. FSE replaces PHP templates with HTML block markup and JSON files. Furthermore, Elementor integration with pure block themes is prone to template-routing conflicts.

#### Option C: Hybrid Theme (Recommended Architecture)
- **What it is:** A Hybrid theme combines the **power, flexibility, and educational value of PHP templates** with modern WordPress features like **`theme.json` (v3)**, Gutenberg block styles, and block patterns.
- **Why it is recommended for HasibShah News:**
  1. **PHP Mastery:** You write clean, professional PHP using the WordPress Template Hierarchy (`single.php`, `archive.php`, `category.php`, `header.php`, `footer.php`), template parts, and custom template tags.
  2. **Gutenberg Ready:** By including `theme.json` (v3), the block editor automatically inherits the color palette, font sizes, and layout constraints without custom CSS overrides.
  3. **Elementor Compatibility:** Provides standard container wrappers, semantic hooks (`wp_head()`, `wp_footer()`, `wp_body_open()`), and full support for Elementor's native "Elementor Canvas" and "Elementor Full Width" page templates.
  4. **Performance & Control:** Clean `WP_Query` loops with selective `no_found_rows => true` optimization without premature caching overhead.

---

## 2. WordPress Template Hierarchy for HasibShah News

The theme strictly adheres to the official WordPress template resolution order:

```
hasibshah-news/
├── index.php                    # Required: Fallback template for all views
├── front-page.php               # Editorial Newspaper Homepage
├── home.php                     # Fallback blog posts index
├── single.php                   # Default single news article
│   └── (calls template-parts/content/content-single.php)
├── page.php                     # Standard static page
├── archive.php                  # Date, tag, author fallback
├── category.php                 # Category-specific news layout
├── author.php                   # Journalist / Columnist bio and article archive
├── search.php                   # News search results with filters
├── 404.php                      # User-friendly 404 page
├── header.php                   # Top bar, masthead, breaking ticker, main navigation
├── footer.php                   # News footer, editorial disclaimers, copyright
└── comments.php                 # Required: Accessible discussion & moderation template
```

---

## 3. Recommended Folder & File Structure

This structure guarantees clean separation of concerns, scalability, and adherence to WordPress Theme Review Standards:

```
wp-content/themes/hasibshah-news/
├── assets/
│   ├── css/
│   │   ├── base.css              # Reset, typography, CSS custom properties
│   │   ├── layout.css            # Grid, header, masthead, footer, sidebar
│   │   ├── components.css        # News cards, badges, ticker, pagination, buttons
│   │   ├── single.css            # Article typography, social share, author box
│   │   ├── editor-style.css      # Gutenberg editor alignment
│   │   └── elementor-compat.css  # Neutral container styling for Elementor pages
│   ├── js/
│   │   ├── navigation.js         # Accessible keyboard navigation, mobile drawer
│   │   ├── ticker.js             # Accessible breaking news ticker (vanilla JS)
│   │   └── theme-toggle.js       # Light/Dark reading mode (localStorage)
│   ├── fonts/                    # Locally hosted web fonts (Bangla & English - No external CDNs)
│   └── images/                   # Theme icons, default fallbacks, logo placeholder
├── inc/
│   ├── core/
│   │   ├── setup.php             # after_setup_theme, add_theme_support, image sizes
│   │   ├── assets.php            # wp_enqueue_scripts, wp_enqueue_style, conditional loading
│   │   └── template-tags.php     # Custom helper functions (dates, reading time, badges)
│   ├── editorial/
│   │   ├── news-queries.php      # Helper functions for homepage news query parameters & loops
│   │   └── bangla-date.php       # Bangla number and date converter utility
│   ├── compatibility/
│   │   ├── elementor.php         # Elementor theme support hooks & container definitions
│   │   ├── woocommerce.php       # Optional WooCommerce support wrapper
│   │   └── gutenberg.php         # Block patterns, editor styles, block supports
│   ├── security/
│   │   └── sanitization.php      # Custom sanitization and escaping helpers
│   └── customizer/
│       ├── customizer.php        # WP Customizer setup for news branding & layout
│       └── sanitize-callbacks.php# Customizer field sanitizers
├── page-templates/
│   ├── template-fullwidth.php    # Standard full-width page without sidebar
│   └── template-opinion.php      # Opinion & Editorial Hub template
├── template-parts/
│   ├── header/
│   │   ├── topbar.php            # Date, edition switch, meta bar
│   │   ├── masthead.php          # Main newspaper branding & header ad slot
│   │   ├── navigation.php        # Primary navigation & mobile toggle
│   │   └── breaking-ticker.php   # Urgent breaking news strip
│   ├── content/
│   │   ├── content.php           # Default card excerpt
│   │   ├── content-single.php    # Single news layout (headline, byline, content, tags)
│   │   ├── content-page.php      # Standard page content
│   │   └── content-none.php      # Zero search or archive results
│   ├── news-sections/
│   │   ├── section-hero.php      # Lead story + 2 secondary + top headlines list
│   │   ├── section-district.php  # Bangladesh district news grid
│   │   ├── section-grid.php      # Standard 3/4 column category section
│   │   ├── section-media.php     # Video & Photo gallery section
│   │   └── section-opinion.php   # Columnist / Op-Ed columns with circular author photos
│   └── footer/
│       ├── footer-widgets.php    # Editorial links, categories, about
│       └── footer-bottom.php     # Copyright, terms, press accreditation
├── languages/
│   └── hasibshah-news.pot        # Translation template
├── theme.json                    # Block editor styles, color palette, fluid typography (v3)
├── style.css                     # Required: Theme header metadata & primary stylesheet
├── functions.php                 # Theme bootstrap & inc/ loader
├── index.php                     # Required: Main template file
├── comments.php                  # Required: Comments template
├── screenshot.png                # Required: 1200x900px PNG official theme preview
└── readme.txt                    # Required: GPL license, changelog, documentation
```

---

## 4. Theme vs. Plugin Boundary Architecture

To comply with **WordPress.org Theme Review guidelines** and ensure users never lose data upon switching themes, the boundary between theme and plugin is strictly maintained:

### Theme Domain (Allowed & Required):
- Visual presentation, CSS, HTML5 semantic structure.
- Template files and template hierarchy.
- Image size registrations (`add_image_size`).
- Customizer options affecting layout, typography, and color schemes.
- Block patterns (registered via `register_block_pattern`).
- Editorial layout containers and hooks.

### Plugin Domain (Forbidden in Theme):
- Custom Post Types (e.g. `epaper`, `breaking_news`, `reporters` belong in a companion plugin).
- Custom Taxonomies (e.g. `district`, `edition`).
- Ad management engines and impression counters.
- User subscription paywalls and payment gateways.
- Social sharing analytics tracking.
- Search Engine Optimization (SEO) meta tags (title tags, open graph tags handled by WordPress core or SEO plugins).
- Custom database query/resource caching (belongs in caching/optimization plugins or hosting infrastructure).

---

## 5. Extensible Hooks & Filters Architecture

Developers and plugins can extend the theme using custom hooks:

### Action Hooks
- `hasibshah_news_before_header`
- `hasibshah_news_after_header`
- `hasibshah_news_breaking_ticker`
- `hasibshah_news_before_main_content`
- `hasibshah_news_after_main_content`
- `hasibshah_news_single_before_article`
- `hasibshah_news_single_after_article`
- `hasibshah_news_single_after_byline`
- `hasibshah_news_before_footer`
- `hasibshah_news_after_footer`

### Filter Hooks
- `hasibshah_news_breaking_news_query_args`
- `hasibshah_news_lead_story_category`
- `hasibshah_news_bangla_number_trans`
- `hasibshah_news_excerpt_length`
- `hasibshah_news_related_posts_count`

---

## 6. Elementor Compatibility Architecture & Integration Strategy

Elementor is an **optional** companion, not a dependency. Compatibility is designed architecturally and verified empirically through dedicated tests.

### Principles:
1. **Prefer Native Elementor Templates (No Redundant Custom Templates):**
   - Elementor natively provides "Elementor Canvas" and "Elementor Full Width" page templates via internal template filters.
   - We do **not** create duplicate `template-elementor-canvas.php` or `template-elementor-fullwidth.php` files. This avoids template hijacking, user confusion, and code redundancy.
   - The theme ensures standard `page.php` has a clean `<main id="primary" class="site-main">` wrapper that allows Elementor to render cleanly without outer grid interference.
2. **Beyond `wp_body_open()` and `body_class()`:**
   - While `wp_body_open()` and `body_class()` are mandatory prerequisites, true compatibility requires:
     - Neutral CSS reset scoping (no `!important` on generic HTML tags like `div`, `p`, or `section` that break Elementor column widths).
     - Proper z-index layering between the theme's sticky navigation/ticker and the Elementor editor interface.
     - Detecting Elementor editor mode via `\Elementor\Plugin::$instance->editor->is_edit_mode()` to suspend non-critical front-end DOM scripts (like tickers or drawer listeners) inside the editor iframe.
3. **Dedicated Practical Compatibility Tests (Executed in Phase 7):**
   - **Editor Frame Test:** Verify Elementor editor loads with zero console errors or canvas freeze.
   - **Layout & Widget Test:** Verify core Elementor widgets (Heading, Text, Image, Containers, Flexbox/Grid) render without CSS leakage.
   - **Native Canvas & Full Width Test:** Create test pages using Elementor's native "Elementor Canvas" and "Elementor Full Width" attributes and verify clean rendering.
   - **Absence Test:** Verify that deactivating Elementor leaves the theme fully functional with zero PHP errors.

---

## 7. Performance & Query Strategy

1. **No Premature Caching in Theme:**
   - Database query and resource caching belong to dedicated caching plugins (e.g. WP Super Cache, LiteSpeed Cache) or server object caching (Redis/Memcached).
   - The theme will not implement custom transient query caching, eliminating stale news issues and maintaining strict WordPress.org compliance.
2. **Selective `no_found_rows` Optimization:**
   - `'no_found_rows' => true` is used **only** when pagination totals are not needed (e.g., Breaking News Ticker, Lead Story hero section, sidebar latest news lists).
   - For paginated queries (`archive.php`, `category.php`, `search.php`), `no_found_rows` is omitted so WordPress calculates total pages for accessible pagination (`the_posts_pagination()`).
3. **Focused In-Memory Deduplication:**
   - Post deduplication is limited strictly to the **Hero Section** (preventing the primary Lead Story from repeating in immediate adjacent feature slots).
   - Global multi-section deduplication arrays are avoided to prevent query fragility and empty sections.
