# PROJECT-PLAN.md: HasibShah News Theme

**Project:** HasibShah News  
**Slug:** `hasibshah-news`  
**Text Domain:** `hasibshah-news`  
**Architecture:** Modern Hybrid Theme (PHP Templates + `theme.json` v3 + Elementor Compatible)  
**Target Core:** WordPress 6.6+ / 7.x (aligning with `theme.json` v3 specification)  
**Target PHP:** PHP 8.3 - 8.4 (Requires PHP: 8.3)  
**Lead Architect:** Senior WordPress Theme Architect & Technical Lead  
**Mentee / Developer:** Junior WordPress Theme Developer  

---

## 1. Executive Summary & Vision

HasibShah News is an authoritative, high-performance, responsive WordPress theme designed specifically for Bangladeshi news publications, digital portals, and magazines. It supports both **Bangla** and **English** languages with authentic editorial typography, rapid page load times, strict adherence to WordPress Coding Standards, robust security, and verified Elementor compatibility.

The project is structured both as a production-grade directory-ready theme and as a **comprehensive mentorship journey** to master professional PHP-based WordPress theme development.

---

## 2. Environment Audit & Readiness

An automated scan of the local environment was conducted and verified:

| Component | Status / Version | Notes |
| :--- | :--- | :--- |
| **Local Server** | WordPress Studio CLI v2.1.1 | Running locally at `http://my-jyoyful-website.wp.local/` |
| **PHP Version** | **PHP 8.4.27** | Modern PHP standards apply (strict typing, null-safety, modern syntax) |
| **WordPress Core** | **WordPress 7.1.4** | Latest core release (fully supports `theme.json` v3) |
| **Database** | Active (Studio Local Database) | Healthy connection |
| **Active Theme** | Twenty Twenty-Five | Clean slate: `wp-content/themes/hasibshah-news` does not exist yet |
| **Git Repository** | Not Initialized | Will be initialized in Phase 1 for version tracking & milestone tagging |
| **Operating System**| Windows (PowerShell Shell) | Paths formatted with forward slashes for cross-platform theme portability |

---

## 3. Specification Document Status (`HasibShah_News_Requirements.docx`)

> [!IMPORTANT]
> **Action Required from User:**  
> A system-wide search of `C:\` and `D:\` drives for `HasibShah_News_Requirements.docx` returned **no matching file**.  
> In strict accordance with the project instructions (*"If the document is unavailable, ask me to provide it. Do not invent its contents"*), **we request the user to place `HasibShah_News_Requirements.docx` into the project root directory or paste its detailed requirements in chat.**
>
> In the interim, this plan, architecture, and roadmap are constructed from the extensive technical parameters and architectural requirements established in the user's kickoff brief. Any specialized business rules from the DOCX will be integrated once provided.

---

## 4. Scope & Feature Boundaries

### 4.1 Minimum Viable Product (MVP) - Phase 1 Scope

The MVP represents a 100% complete, fully functioning, beautiful news portal ready for editorial testing:

1. **Complete WordPress.org Required & Best-Practice Files:**
   - `style.css` (with required theme metadata headers, `Requires at least: 6.6`, GPL licensing)
   - `index.php` (mandatory fallback template)
   - `comments.php` (mandatory accessible comments template)
   - `screenshot.png` (mandatory: official **1200x900px PNG**, 4:3 aspect ratio, under 2MB)
   - `readme.txt` (mandatory documentation, changelog, and license declarations)
   - Standard templates: `front-page.php`, `single.php`, `page.php`, `archive.php`, `category.php`, `author.php`, `search.php`, `404.php`, `header.php`, `footer.php`.
2. **Editorial Front Page:**
   - **Top Bar:** Bangla/English dynamic dates, Hijri date placeholder, edition switch.
   - **Masthead:** Newspaper logo, tagline, header leaderboard banner slot.
   - **Breaking News Ticker:** Urgent news strip with pause-on-hover and accessible markup.
   - **Hero Section:** 3-column newspaper grid (Secondary story, Lead cover story, Latest news feed) with targeted in-memory deduplication between the lead story and adjacent secondary features.
   - **Category Sections:** Bangladesh, Politics, Business, Sports, Entertainment, Tech.
   - **Multimedia & Opinion Modules:** Video/Photo card layouts and Columnist opinion section.
3. **Bangla & English Typography Engine:**
   - Locally hosted web fonts with `font-display: swap` (GDPR and WordPress.org compliant).
   - Overflow prevention, line-height normalization (1.45 - 1.55), and multiline clamping for Bengali script.
4. **Single Article View:**
   - Author byline, publication timestamp, reading time estimator.
   - Featured image with caption credit, responsive `srcset`.
   - Editorial article content styling (drop cap, pull quotes, rich embeds).
   - Privacy-focused social share links (pure HTML/CSS, zero tracking scripts).
   - Related stories query loop based on matching category or tags.
   - Accessible comments list and form via `comments.php`.
5. **Mobile & Navigation:**
   - Fully responsive mobile drawer menu with keyboard trapping.
   - Accessible dropdown multi-level navigation.
6. **Elementor Compatibility Layer (Non-intrusive):**
   - Clean container markup in `page.php` allowing Elementor's native "Elementor Canvas" and "Elementor Full Width" templates to work without redundant theme templates.
   - Scoped CSS to prevent breaking Elementor flexbox containers, column widths, or editor interface.
7. **WordPress.org Readiness:**
   - Prefixing (`hasibshah_news_`), text-domain (`hasibshah-news`), 100% output escaping, zero plugin territory.

### 4.2 Advanced Features - Phase 2 Scope (Post-MVP)

1. **Interactive District News Filter:** AJAX-powered dynamic division/district news selector.
2. **Dark Mode / Night Reading:** LocalStorage-backed theme switcher with zero flash of unstyled content.
3. **Single Article Enhancements:** Sticky reading progress bar, dynamic text resizer (A- / A+), print-optimized stylesheet.
4. **Live Breaking News Updates:** Lightweight REST API polling for instant breaking alerts without full page reload.
5. **WooCommerce Integration (Optional):** Clean styling for newspaper subscriptions, book sales, or single copy purchases.
6. **Companion Plugin (`hasibshah-news-core`):** Housing Custom Post Types (e.g. `epaper`, `columnist`) and specialized taxonomies to maintain clean theme boundaries.

---

## 5. Comprehensive Risk Analysis & Mitigation Matrix

### 5.1 WordPress.org Theme Review Risks

| Risk Area | Review Rule | Mitigation Strategy |
| :--- | :--- | :--- |
| **Prefixing** | All functions, classes, global variables, and image size handles must start with `hasibshah_news_` or `HASIBSHAH_NEWS_`. | Strict linter rules; automated scan for un-prefixed helper functions. |
| **Plugin Territory** | No custom post types, custom taxonomies, SEO meta tags, custom resource caching, or analytics tracking allowed in the theme. | Keep all data structures in standard WordPress posts/categories or companion plugin. Leave caching to plugins/server. |
| **External CDNs** | Google Fonts, Font Awesome, or external CDNs are strictly prohibited for privacy (GDPR) and stability reasons. | 100% self-hosted fonts in `assets/fonts/` and SVG icons inlined or sprite-based. |
| **Sanitization & Escaping** | Every single dynamic variable printed to HTML must be escaped (`esc_html`, `esc_attr`, `esc_url`, `wp_kses_post`). | Code review pass using `phpcs` with `WordPress-Coding-Standards`. Zero unescaped `echo`. |
| **Translation** | All user-facing strings must use internationalization functions with exact text domain `'hasibshah-news'`. | Audit all strings using `__()`, `_e()`, `esc_html__()`, `esc_attr__()`. No string concatenation in translation calls. |
| **Mandatory Files** | `style.css`, `index.php`, `comments.php`, `screenshot.png` (1200x900 PNG), `readme.txt`. | All mandatory files scaffolded and verified against Theme Check from Phase 1. |

### 5.2 Elementor Compatibility Risks

| Risk Area | Danger | Mitigation Strategy |
| :--- | :--- | :--- |
| **Editor Trapping** | Sticky headers or JavaScript DOM mutations crash or freeze the Elementor editor frame. | Check `\Elementor\Plugin::$instance->editor->is_edit_mode()` and suspend non-critical front-end DOM scripts inside the editor. |
| **CSS Collisions** | Theme resets (`* { box-sizing: border-box; margin: 0; }`) break Elementor column widths or section margins. | Use targeted resets scoped to `.site-main` or explicit HTML tags; avoid high-specificity selector overrides. |
| **False Assumption of Compatibility** | Assuming `wp_body_open()` and `body_class()` alone guarantee compatibility. | Conduct a practical 4-step Elementor test suite in Phase 7 (Editor Frame, Widget Rendering, Native Canvas/Full Width, Absence test). |
| **Template Redundancy** | Creating custom `template-elementor-canvas.php` conflicting with Elementor's native virtual template. | Do not create duplicate templates; let Elementor inject its native canvas/full-width templates over clean theme hooks. |

### 5.3 Performance & Security Risks

| Risk Area | Danger | Mitigation Strategy |
| :--- | :--- | :--- |
| **Heavy Homepage Queries** | Multiple category sections generating heavy database counts. | Use `'no_found_rows' => true` **strictly on non-paginated queries** (Hero, Ticker, Latest News widgets). Omit on paginated archives. |
| **Premature Caching** | Caching database queries via transients causes stale news and plugin conflicts. | Remove all custom query transient caching from the theme. Rely on clean SQL queries and dedicated caching infrastructure. |
| **Duplicate Articles** | Same post appearing in both Hero cover and adjacent sub-lead. | Implement lightweight in-memory deduplication strictly within the Hero Section, avoiding global multi-section complexity. |
| **Layout Shift (CLS)** | Images and ad slots shifting content during page load. | Explicit `width` and `height` attributes on all featured images and reserved aspect-ratio containers for banners. |
| **Bangla Font Bloat** | Bengali fonts can be large (1MB - 3MB per font file). | Use WOFF2 format with unicode-range subsetting to keep font payload under 150KB. |

---

## 6. Communication & Mentorship Protocol

- **Language of Instruction:** Simple, educational Bangla for all explanations, concepts, and architectural logic.
- **Language of Code & Technology:** English for all code snippets, WordPress APIs, filenames, variables, and documentation.
- **Incremental Steps:** No blind massive code dumps. Every file created will be explained step-by-step with practical "why we do this" senior developer insights.
- **Strict Approval Gate:** No theme implementation code will be written until the user reviews and approves this plan.
