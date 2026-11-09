# PROGRESS.md: HasibShah News Theme Development Log

**Project:** HasibShah News  
**Slug:** `hasibshah-news`  
**Lead Architect:** Senior WordPress Theme Architect & Technical Lead  
**Mentee / Developer:** Junior WordPress Theme Developer  

---

## Log Entries

### Entry 001 - Project Kickoff, Environment Inspection & Architectural Planning
**Date:** November 4, 2026  
**Status:** Completed

#### Actions Completed:
1. **File System & Environment Audit:**
   - Evaluated WordPress local runtime using Studio CLI: WordPress version `7.1.4`, PHP version `8.4.27`, Local URL: `http://my-jyoyful-website.wp.local`.
   - Verified that the site currently runs default core themes (`twentytwentyfive`, `twentytwentyfour`, `twentytwentythree`).
   - Confirmed no conflicting `hasibshah-news` theme directory exists yet (clean slate).
   - Identified that Git repository is not yet initialized in the project directory.
2. **Requirements Document Discovery:**
   - Initiated deep filesystem search across drive `C:\` and `D:\` for `HasibShah_News_Requirements.docx`.
   - Result: Document was not found on local disk. In accordance with guidelines, the file has been formally requested from the user.
3. **Architectural Evaluation Completed:**
   - Evaluated Classic Theme (Pure PHP) vs. Block Theme (Full Site Editing) vs. Hybrid Theme (Modern Classic + `theme.json` + Elementor Compatible).
   - Selected **Hybrid Theme** as the optimal architecture.
4. **Initial Planning Artifacts Created:**
   - `ARCHITECTURE.md`, `DESIGN-SYSTEM.md`, `PROJECT-PLAN.md`, `DEVELOPMENT-ROADMAP.md`, `PROGRESS.md`.

---

### Entry 002 - Planning Review & Technical Corrections Incorporated
**Date:** November 4, 2026  
**Status:** Completed

#### Actions Completed:
1. Environment verification: confirmed WP Core `7.1.4`, PHP `8.4.27`, URL `http://my-jyoyful-website.wp.local`.
2. Removed premature query caching (transients).
3. Version alignment for `theme.json` v3 (WordPress 6.6+ minimum).
4. Favored native Elementor Canvas/Full-width over redundant custom templates.
5. Designed 4-step practical Elementor test plan for Phase 7.
6. Documented all WordPress.org mandatory files.
7. Verified official screenshot requirements (1200x900px PNG).
8. Restricted `no_found_rows => true` strictly to non-paginated queries.
9. Focused post deduplication strictly to the Hero cover section.
10. Reaffirmed strict theme vs plugin boundary.

---

### Entry 003 - Phase 1 Initial Scaffolding
**Date:** November 4, 2026  
**Status:** Completed

#### Actions Completed:
1. Initialized Git repository and created `.gitignore`.
2. Created modular directory structure in `wp-content/themes/hasibshah-news/`.
3. Created initial baseline theme files: `style.css`, `index.php`, `comments.php`, `screenshot.png` (1200x900), `readme.txt`, `theme.json` (v3), `functions.php`, `header.php`, `footer.php`, `inc/core/setup.php`, `inc/core/assets.php`, `inc/core/template-tags.php`, `assets/css/editor-style.css`.
4. Successfully registered and activated theme via WordPress Studio CLI.

---

### Entry 004 - Phase 1 Refinements & Accurate Compliance Audit
**Date:** November 4, 2026  
**Status:** Completed (Awaiting User Milestone Approval for Phase 1)

#### Adjustments & Corrections Made:
1. **Removed Placeholder URIs:**
   - Omitted `Theme URI` and `Author URI` from `style.css` because valid production URLs are not yet available.
   - Removed developer notes from `style.css` and `readme.txt` metadata headers.
2. **`wp_link_pages()` Removed from Archive Excerpt Loop:**
   - Cleaned `index.php` excerpt loop. Acknowledged that `wp_link_pages()` belongs in full-content templates (`single.php` / `page.php`), which are scheduled for **Phase 5**. No dummy calls were added.
3. **Scoped Gitignore Patterns:**
   - Fixed root-level file patterns in `.gitignore` (`/index.php`, `/wp-config.php`) so theme templates like `wp-content/themes/hasibshah-news/index.php` are properly tracked in version control.
4. **PHP Minimum Version Approved (`Requires PHP: 8.3`):**
   - User formally approved **PHP 8.3** as the minimum required PHP version for HasibShah News.
   - Updated `Requires PHP: 8.3` in `style.css`, `readme.txt`, `ARCHITECTURE.md`, `PROJECT-PLAN.md`, and `DEVELOPMENT-ROADMAP.md`.
   - Reconfigured local Studio server via `studio config set --php 8.3` to download and run the official **PHP 8.3.36** runtime.
   - Verified code execution and syntax compatibility across both **PHP 8.3.36** and **PHP 8.4.27**.

#### Verification & Test Results Breakdown:

##### A. Passed Static & Runtime Tests:
- **Theme Activation:** Switched to `HasibShah News` cleanly via Studio WP-CLI.
- **PHP Syntax & Runtime Audit (Tested on PHP 8.3.36 & PHP 8.4.27):**
  - Ran all 8 PHP files under active PHP 8.3.36 runtime; `wp-content/debug.log` has exactly 0 notices, 0 warnings, and 0 fatal errors.
  - Previously tested under PHP 8.4.27 with 0 errors.
- **HTTP Front-End Rendering:** `GET http://my-jyoyful-website.wp.local/` returned `HTTP 200 OK` under PHP 8.3.36 with semantic HTML5 elements.
- **Image Specifications:** `screenshot.png` verified at 1200x900px PNG format (28KB).
- **Block Configuration:** `theme.json` syntax and schema validated against WP v3 standard.

##### B. Theme Check Plugin Audit (Version: 20260901):
- **Overall Scan Status:** `FAILED / NEEDS ATTENTION` (Expected for Phase 1 milestone)
- **Deferred Critical Findings (REQUIRED): 1**
  - `[REQUIRED] REQUIRED: Could not find wp_link_pages. See: wp_link_pages <?php wp_link_pages( $args ); ?>`  
    *Deferred Reason:* `wp_link_pages()` belongs in `single.php` / `page.php` with `the_content()`. It will be implemented in **Phase 5**. No dummy call was added to Phase 1 files.
- **Warnings (WARNING): 0**
- **Recommendations / Deferred Info (INFO): 17**
  - Missing block patterns / block styles (scheduled for Phase 7).
  - Missing `comments_template()` (belongs in `single.php`, scheduled for Phase 5).
  - Missing CSS utility classes (`.sticky`, `.bypostauthor`, `.alignleft`, etc., scheduled for Phase 2).
  - Missing sidebars/widgets registration (scheduled for Phase 6).

*Note: The theme is currently in Phase 1 (Scaffolding). Full WordPress.org submission compliance is targeted for Phase 9 after all templates, styles, and patterns are developed.*

#### Next Milestone (Phase 2):
- **Phase 2: Design System, Typography & Layout Engine** (Completed in Entry 005).

---

### Entry 005 - Phase 2 Complete: Design System, Typography & Layout Engine
**Date:** November 4, 2026  
**Status:** Completed (Awaiting User Review & Approval for Phase 3)

#### Actions Completed:
1. **Self-Hosted Font Engine:**
   - Bundled 5 Open Font License (OFL) WOFF2 web fonts in `assets/fonts/`: Hind Siliguri (Regular 400, SemiBold 600, Bold 700) and Inter (Regular 400, Bold 700). Total font payload < 270KB. 100% self-hosted, eliminating external Google Fonts requests for GDPR/WP.org privacy compliance.
2. **Design Tokens & Base CSS (`assets/css/base.css`):**
   - `@font-face` declarations with `font-display: swap` and Bengali unicode-ranges.
   - Comprehensive CSS custom properties (`:root` tokens) for brand primaries, category colors, paper neutrals, spacing scale (4px/8px), and clamp-based fluid typography.
   - Elementor-safe baseline resets with zero disruptive `!important` flags.
   - Bangla headline overflow protection: normalized heading line-height (`1.48`), `overflow-wrap: break-word`, `word-break: break-word`, `text-wrap: balance`, and multiline line-clamping utilities (`.line-clamp-1` to `.line-clamp-4`).
   - WordPress core utility and alignment classes: `.alignleft`, `.alignright`, `.aligncenter`, `.alignwide`, `.alignfull`, `.wp-caption`, `.wp-caption-text`, `.gallery-caption`, `.sticky`, `.bypostauthor`.
3. **Responsive 12-Column Newspaper Layout Engine (`assets/css/layout.css`):**
   - Semantic containers: `.site-container` (1280px max-width, 16px padding), `.site-container-narrow` (840px), `.site-container-fluid`.
   - Mobile-first 12-column CSS Grid (`.news-grid-12`, `.col-span-1` through `.col-span-12`).
   - Editorial broadsheet layouts: `.layout-content-sidebar` (8:4 split), `.layout-hero-3col` (3:6:3 split), `.layout-grid-3col`, `.layout-grid-4col`.
   - Broadsheet divider borders: `.newspaper-border-bottom`, `.newspaper-border-top`, `.newspaper-double-border`, `.border-right-divider`.
4. **Asset Enqueueing Pipeline (`inc/core/assets.php`):**
   - Chained dependency order: `hasibshah-news-base` -> `hasibshah-news-layout` -> `hasibshah-news-style`.
5. **Gutenberg & Theme.json Sync:**
   - Updated `theme.json` (v3) to declare `fontFamilies` for Bangla, English, and Editorial Serif.
   - Updated `assets/css/editor-style.css` to import `base.css` and style `.editor-styles-wrapper`.

#### Verification & Test Results:

##### A. Runtime Verification:
- **Stylesheet Loading (HTTP 200 OK):**
  - `base.css`: HTTP 200 OK (9,334 bytes).
  - `layout.css`: HTTP 200 OK (4,648 bytes).
  - `style.css`: HTTP 200 OK (2,015 bytes).
- **Web Fonts Loading (HTTP 200 OK):**
  - `hind-siliguri-regular.woff2` (71 KB), `hind-siliguri-semibold.woff2` (74 KB), `hind-siliguri-bold.woff2` (72 KB), `inter-regular.woff2` (23 KB), `inter-bold.woff2` (24 KB) all load with HTTP 200.
- **PHP Debug Log:** Checked `wp-content/debug.log`: exactly 0 errors, 0 warnings, 0 notices under active PHP 8.3.36 runtime.

##### B. Visual & Responsive Viewport Audit:
- **Mobile (< 768px):** Containers constrain to 100% width with 1rem padding; all grid layouts stack cleanly in 1 column; 0 horizontal scrolling.
- **Tablet (768px - 1023px):** 12-column grid active; hero lead spans full width; 2-column card wrapping.
- **Desktop (1024px+):** Full 12-column newspaper grid; 8:4 content-sidebar and 3:6:3 hero split render without overflow.
- **Bangla Font Rendering:** Tested with live published Bangla post containing complex conjuncts and diacritics. No matra/hasant clipping detected.

##### C. Theme Check Plugin Audit (Version: 20260901):
- **Overall Scan Status:** `FAILED / NEEDS ATTENTION` (Expected milestone limitation)
- **Deferred Critical Findings (REQUIRED): 1**
  - `[REQUIRED] REQUIRED: Could not find wp_link_pages. See: wp_link_pages <?php wp_link_pages( $args ); ?>`  
    *Deferred Reason:* Belongs in `single.php` / `page.php` with `the_content()`. Scheduled for **Phase 5**.
- **Warnings (WARNING): 0**
- **Recommendations / Deferred Info (INFO): 11** (Reduced from 17 in Phase 1; all CSS alignment, caption, and sticky class recommendations were resolved). Remaining 11 items belong to future phases (block patterns in Phase 7, single comments in Phase 5, sidebars in Phase 6).

#### Next Milestone (Phase 3):
- **Phase 3: Header, Navigation & Breaking News Ticker** (Completed in Entry 006).

---

### Entry 006 - Phase 3 Complete: Header, Navigation & Breaking News Ticker
**Date:** November 4, 2026  
**Status:** Completed (Awaiting User Review & Approval for Phase 4)

#### Actions Completed:
1. **Bangla & English Date Formatter (`inc/editorial/bangla-date.php`):**
   - Created pure PHP date and number converter with zero external library dependencies.
   - Converts Western numerals (0–9) to Bengali numerals (০–৯) with `hasibshah_news_to_bangla_digits()`.
   - Formats complete localized Bengali dates (`hasibshah_news_get_bangla_date()`) matching Bangladesh newspaper standards (e.g. "বুধবার, ৪ নভেম্বর ২০২৬").
   - Provides companion English date string (`hasibshah_news_get_english_date()`, e.g. "Wednesday, 4 November 2026").
   - Required modularly in `functions.php`.
2. **Modular Semantic Header Architecture (`header.php`):**
   - Restructured `<header id="masthead" class="site-header">` into 4 clean, maintainable template parts in `template-parts/header/`.
   - Added extensible action hooks: `hasibshah_news_before_header` and `hasibshah_news_after_header`.
3. **Newspaper Topbar (`template-parts/header/topbar.php`):**
   - Left side: Calendar SVG icon, dynamic bilingual date display, and prominent Dhaka Edition badge ("ঢাকা সংস্করণ").
   - Right side: Secondary editorial menu location (`secondary`) with graceful empty state.
4. **Broadsheet Masthead & Leaderboard Ad (`template-parts/header/masthead.php`):**
   - Site branding supporting WordPress Custom Logo (`the_custom_logo()`), or fallback site title (`h1` on frontpage, `p` on inner pages) and site description.
   - Responsive 728x90 leaderboard ad slot with `hasibshah_news_header_ad` hook and clean placeholder styling. Automatically hides on viewports < 992px to eliminate mobile horizontal overflow.
5. **Primary Navigation Bar (`template-parts/header/navigation.php`):**
   - High-contrast newspaper navy navigation strip (`#site-navigation`).
   - Sticky navbar, home icon button, primary menu (`theme_location => primary`), and search toggle button.
   - Built-in fallback (`hasibshah_news_nav_fallback()`) in `inc/core/template-tags.php` rendering category list when no menu is assigned in WordPress admin.
   - Dropdown search form with autofocus and keyboard dismissal.
6. **Mobile Off-Canvas Drawer Navigation (`template-parts/header/navigation.php`):**
   - Hamburger trigger button (`#mobile-menu-toggle`) with `aria-controls` and `aria-expanded`.
   - Accessible off-canvas sliding drawer (`#mobile-navigation-drawer`) with `role="dialog"`, `aria-modal="true"`, and `aria-label`.
   - Dedicated close button, mobile search bar, and full vertical category menu.
   - Fixed semi-transparent backdrop overlay (`#mobile-drawer-backdrop`).
7. **Breaking News Ticker (`template-parts/header/breaking-ticker.php`):**
   - Urgent red pulse dot badge ("ব্রেকিং নিউজ").
   - Query optimization: 5 latest published posts with `no_found_rows => true` and `ignore_sticky_posts => 1`.
   - Continuous CSS horizontal marquee animation with pause-on-hover and pause-on-focus.
   - Fallback welcome message when no posts exist.
   - Accessible manual Pause/Play button (`#ticker-pause-toggle`) with SVG icon switching and `aria-pressed` states.
   - Media query `prefers-reduced-motion: reduce` for full motion accessibility.
8. **Vanilla JS Interactivity & Accessibility Engine (`assets/js/navigation.js`):**
   - Pure vanilla JavaScript with zero jQuery dependencies.
   - Elementor editor guard: checks `body.classList.contains('elementor-editor-active')` to prevent focus trapping or event interference during page editing.
   - WCAG 2.1 AA keyboard focus trapping inside open mobile drawer (Tab / Shift+Tab looping).
   - Global Escape key listener to close mobile drawer and search bar.
   - Outside-click detection to dismiss the search bar.
   - Keyboard dropdown navigation support: toggles `.focus` class on ancestor `li` items for tabbing through multi-level submenus.
9. **Asset Enqueueing Pipeline (`inc/core/assets.php`):**
   - Enqueued `hasibshah-news-header` (`assets/css/header.css`, depends on `hasibshah-news-layout`).
   - Enqueued `hasibshah-news-navigation` (`assets/js/navigation.js`, footer script).

#### Verification & Test Results:

##### A. PHP Syntax & Static File Validation:
- All 13 PHP files across the theme scanned via token parse check: 100% PASS (0 syntax errors, 0 parse errors).

##### B. Runtime & HTTP Verification:
- **Frontend HTTP Response:** `GET http://my-jyoyful-website.wp.local/` returned `HTTP 200 OK`.
- **Rendered DOM Verification:** Verified presence of `news-topbar`, localized Bangla date, edition badge, `news-masthead`, `news-branding-block`, `news-masthead-ad-slot`, `site-navigation`, `mobile-navigation-drawer`, `news-breaking-ticker`, and `ticker-track`.
- **Asset Loading:**
  - `assets/css/header.css`: `HTTP 200 OK` (13,357 bytes).
  - `assets/js/navigation.js`: `HTTP 200 OK` (8,284 bytes).
- **PHP Error Log:** Inspected `wp-content/debug.log`: exactly 0 errors, 0 warnings, 0 notices under active PHP 8.3.36 runtime.

##### C. Visual & Viewport Audit:
- **Desktop (>= 992px):** Leaderboard ad (728x90) and desktop navigation visible; mobile toggle hidden; multi-level dropdowns functional on hover and keyboard focus (`li:focus-within`).
- **Tablet & Mobile (< 992px):** Leaderboard ad hidden (no horizontal scroll); hamburger button visible; off-canvas drawer slides smoothly from left; backdrop dims background; body scroll locked with `body.mobile-drawer-open`.
- **Accessibility:** Focus trapped within mobile drawer; Escape key closes drawer and search bar; ticker pauses on hover/focus and via manual toggle; `prefers-reduced-motion` halts animation.

##### D. Theme Check Plugin Audit (Version: 20260901):
- **Overall Scan Status:** `FAILED / NEEDS ATTENTION` (Expected milestone limitation)
- **Critical Errors (REQUIRED): 1**
  - `[REQUIRED] REQUIRED: Could not find wp_link_pages. See: wp_link_pages <?php wp_link_pages( $args ); ?>`  
    *Deferred Reason:* Belongs in `single.php` / `page.php` with `the_content()`. Scheduled for **Phase 5**.
- **Warnings (WARNING): 0**
- **Recommendations / Deferred Info (INFO): 11** (Same 11 future-phase items as Phase 2; zero new errors or warnings introduced).

#### Next Milestone (Phase 4):
- **Phase 4: Editorial Homepage & Dynamic News Queries** (Completed in Entry 007).

---

### Entry 007 - Phase 4 Complete: Editorial Homepage & Dynamic News Queries
**Date:** November 6, 2026  
**Status:** Completed (Awaiting User Review & Approval for Phase 5)

#### Actions Completed:
1. **Editorial News Queries & Helpers (`inc/editorial/news-queries.php`):**
   - Created `hasibshah_news_get_section_posts()` with `'no_found_rows' => true` applied by default to eliminate SQL row-calculation overhead on non-paginated homepage sections.
   - Built `hasibshah_news_post_badge()` generating accessible, color-coded category pills mapped to category slugs (`badge-cat-bangladesh`, `badge-cat-politics`, `badge-cat-business`, `badge-cat-sports`, `badge-cat-entertainment`, `badge-cat-opinion`, `badge-cat-tech`).
   - Built `hasibshah_news_time_ago()` calculating human-readable relative time with Bengali digits (e.g. "১৫ মিনিট আগে", "২ ঘণ্টা আগে").
   - Built `hasibshah_news_reading_time()` calculating estimated article reading time in Bengali (e.g. "৩ মিনিট পড়ার সময়").
   - Built `hasibshah_news_post_thumbnail()` providing responsive lazy-loaded thumbnails with graceful inline SVG fallback placeholders to guarantee 0 Cumulative Layout Shift (CLS).
   - Loaded modularly in `functions.php`.
2. **Modular Front-Page Template (`front-page.php`):**
   - Implemented standard WordPress template hierarchy front page with semantic `<main id="primary" class="site-main homepage-editorial-feed">`.
   - Integrated extensible action hooks: `hasibshah_news_before_homepage` and `hasibshah_news_after_homepage`.
   - Sequentially loads 5 modular editorial section template parts.
3. **Broadsheet Hero Cover Section (`template-parts/news-sections/section-hero.php`):**
   - 3-column broadsheet cover split (12-column grid):
     - Center (6 cols): Primary Lead Story (`news-card-lead`) with 16:9 banner image, display typography, excerpt, author byline, time-ago, and reading time badge.
     - Left (3 cols): Secondary Feature Stories Stack (`secondary-stories-stack`) with 2 stacked cards.
     - Right (3 cols): Latest Headlines Feed (`latest-headlines-feed`) with pulsing red dot, chronological headline list, and "সব খবর পড়ুন" archive link.
   - **Focused In-Memory Deduplication:** Tracks `$hero_excluded_ids` strictly across the Hero queries so the Lead Story ID never repeats in adjacent secondary slots or the latest list.
4. **District / Regional News Section (`template-parts/news-sections/section-district.php`):**
   - "সারাদেশ" section header with National Green (`--color-cat-bangladesh`) accent bar and subtitle.
   - 8 Bangladeshi administrative division filter chips (ঢাকা, চট্টগ্রাম, রাজশাহী, খুলনা, বরিশাল, সিলেট, রংপুর, ময়মনসিংহ).
   - 4-column responsive news card grid (`col-span-12 col-span-md-6 col-span-lg-3`).
5. **Category Feature Grids (`template-parts/news-sections/section-grid.php`):**
   - 3-column broadsheet category blocks:
     - রাজনীতি (Politics) with Deep Maroon accent (`heading-accent-politics`).
     - অর্থনীতি ও বাণিজ্য (Business) with Sapphire Blue accent (`heading-accent-business`).
     - খেলাধুলা (Sports) with Vibrant Amber accent (`heading-accent-sports`).
   - Each category block features 1 Primary lead card with 3:2 image + compact headline list with thumbnail thumbnails.
6. **Multimedia Hub (`template-parts/news-sections/section-media.php`):**
   - Dark aesthetic surface container (`--color-brand-primary` #0A192F dark background, white text).
   - 4-column multimedia card grid.
   - Interactive badge overlays: "ভিডিও" with video play icon, "ছবি" with camera icon.
7. **Opinion & Editorial Columns (`template-parts/news-sections/section-opinion.php`):**
   - Broadsheet paper background with classic double-border styling (`.newspaper-double-border`).
   - Distinctive columnist cards with circular author portraits (52px avatar), author byline, designation, quotation mark graphic, and thought-provoking title.
8. **Component Stylesheet (`assets/css/components.css`):**
   - 620+ lines of modular, token-compliant CSS for news cards, badges, aspect-ratio containers, dark multimedia surface, opinion styling, and line-clamping utilities.
   - Enqueued in `inc/core/assets.php` as `hasibshah-news-components` with dependency on `hasibshah-news-header`.

#### Verification & Test Results:

##### A. PHP Syntax & Static File Validation:
- All 20 PHP files across the theme scanned via token parse check: 100% PASS (0 syntax errors, 0 parse errors).

##### B. Runtime & Section Rendering Verification:
- **Rendered Output:** `front-page.php` fully rendered via in-process WordPress runtime: 88,948 bytes of valid semantic HTML5.
- **Section Presence Verification:**
  - `section-hero`: YES (Lead, 2 secondary, 5 latest headlines).
  - `section-district`: YES (4 regional news cards + 8 division chips).
  - `section-category-grid`: YES (3 category blocks: Politics, Business, Sports).
  - `section-media`: YES (4 dark multimedia cards with video/photo badge overlays).
  - `section-opinion`: YES (Columnist avatar, designation, and editorial headline).
  - `hasibshah-news-components-css`: YES (properly enqueued and loaded).
- **PHP Error Log:** Inspected `wp-content/debug.log`: exactly 0 errors, 0 warnings, 0 notices under active PHP 8.3.36 runtime.

##### C. Focused Hero Deduplication Audit:
- Tested with multi-post dataset:
  - Lead story ID: 13
  - Secondary story IDs: 12, 11 (ID 13 excluded)
  - Latest feed story IDs: 10, 9, 8, 7, 6 (IDs 13, 12, 11 excluded)
  - Zero duplicate stories across the entire Hero cover!
  - Query parameter verification: `no_found_rows => true` confirmed on all homepage queries.

##### D. Visual & Viewport Responsiveness:
- **Desktop (>= 992px):** Hero 3-column split (3:6:3); District 4-column grid; Category 3-column blocks; Media 4-column grid; Opinion 4-column cards.
- **Tablet (768px - 991px):** Hero lead stacks cleanly; District 2-column wrapping; Category blocks stack; 0 horizontal overflow.
- **Mobile (< 768px):** All cards stack smoothly in single column; division chips scroll horizontally; touch targets >= 44px.

##### E. Theme Check Plugin Audit (Version: 20260901):
- **Overall Scan Status:** `FAILED / NEEDS ATTENTION` (Expected milestone limitation)
- **Critical Errors (REQUIRED): 1**
  - `[REQUIRED] REQUIRED: Could not find wp_link_pages. See: wp_link_pages <?php wp_link_pages( $args ); ?>`  
    *Deferred Reason:* Belongs in `single.php` / `page.php` with `the_content()`. Scheduled for **Phase 5**.
- **Warnings (WARNING): 0**
- **Recommendations / Deferred Info (INFO): 11** (Zero new errors or warnings introduced by Phase 4).

#### Next Milestone (Phase 5):
- **Phase 5: Single Article View, Related Stories & Comments** (Completed in Entry 008).

---

### Entry 008 - Phase 5 Complete: Single Article View, Related Stories & Comments
**Date:** November 7, 2026  
**Status:** Completed (Awaiting User Review & Approval for Phase 6)

#### Actions Completed:
1. **Single Article Template Architecture (`single.php`):**
   - Created `single.php` implementing standard WordPress post loop wrapped in `<main id="primary" class="site-main single-post-main">` and constrained reading container (`.single-article-container`, 860px max width).
   - Added extensible hooks: `hasibshah_news_single_before_article` and `hasibshah_news_single_after_article`.
   - Integrated previous/next article navigation via `the_post_navigation()`.
   - Integrated category-based related stories via `get_template_part( 'template-parts/content/related-stories' )`.
   - Integrated native WordPress comments via `comments_template()` (addressing Theme Check recommendation).
2. **Comprehensive Content Template (`template-parts/content/content-single.php`):**
   - Category pill badge via `hasibshah_news_post_badge()`.
   - High-impact H1 title (`single-article-title`) with fluid typography and word-break safeguards.
   - Lead excerpt (`article-lead-excerpt`) for sub-headline support.
   - Author byline bar with reporter avatar, publication timestamp, update timestamp (if modified), reading time badge, and `hasibshah_news_single_after_byline` hook.
   - Lightweight, privacy-focused social sharing buttons (Facebook, X/Twitter, WhatsApp, Print) with pure SVG icons and zero tracking cookies.
   - Featured media presentation with responsive image, caption, and photographer credits.
   - Long-form editorial body copy with `the_content()`.
   - **Multi-page Post Pagination (`wp_link_pages()`):** Implemented accessible pagination markup resolving the previously deferred Theme Check REQUIRED error.
   - Article tags list (`the_tags()`) resolving Theme Check recommendation.
   - Author biographical card with 72px avatar, author description, and archive link.
3. **Category-Based Related Stories Engine (`template-parts/content/related-stories.php`):**
   - Queries related stories sharing the current post's primary category.
   - Excludes current post ID (`'post__not_in' => array( $current_post_id )`).
   - Applies `'no_found_rows' => true` for query optimization.
   - Features graceful fallback to latest news if category has limited posts.
   - Renders 3-column responsive card grid (`news-grid-12`).
4. **Single Article Stylesheet (`assets/css/single.css`):**
   - 480+ lines of dedicated single article styles:
     - Optimal reading typography: `clamp(1.0625rem, 0.98rem + 0.4vw, 1.22rem)`, line-height `1.78` for Bengali diacritic safety.
     - Pullquotes and blockquotes with broadsheet border styling.
     - Drop-caps styling for lead paragraphs (`.has-drop-cap`).
     - Social share buttons with brand colors.
     - Multi-page pagination (`.article-page-links`).
     - Author bio box layout.
     - Post navigation (`.post-navigation`).
     - Full styling for native threaded comments (`comments.php`), avatars, comment forms, and submit button.
5. **Asset Enqueueing Pipeline (`inc/core/assets.php`):**
   - Conditionally enqueued `hasibshah-news-single` on `is_singular()` with dependency on `hasibshah-news-components`.
   - Preserves conditional `comment-reply` script when threaded comments are enabled.

#### Verification & Test Results:

##### A. PHP Syntax & Static File Validation:
- All 23 PHP files across the theme scanned via token parse check: 100% PASS (0 syntax errors, 0 parse errors).

##### B. WordPress Runtime & Single Article Rendering:
- Simulated single post rendering via WordPress query runtime: 57,862 bytes of valid semantic HTML5.
- Rendered Element Verification:
  - `HAS_SINGLE_TITLE`: YES
  - `HAS_BYLINE`: YES
  - `HAS_SHARE_BAR`: YES
  - `HAS_WP_LINK_PAGES`: YES (tested with `<!--nextpage-->` multi-page post)
  - `HAS_TAGS`: YES
  - `HAS_AUTHOR_BIO`: YES
  - `HAS_POST_NAVIGATION`: YES
  - `HAS_RELATED_STORIES`: YES
  - `HAS_COMMENTS_AREA`: YES
  - `HAS_SINGLE_CSS`: YES (conditionally enqueued on single post)
- **Comments Runtime:** Created test comment and verified comment list, author name, and comment form rendering.
- **PHP Error Log:** Inspected `wp-content/debug.log`: exactly 0 errors, 0 warnings, 0 notices under active PHP 8.3.36 runtime.

##### C. Official Theme Check Plugin Audit (Version: 20260901):
- **Overall Scan Status:** **`PASSED`**
- **Critical Errors (REQUIRED): 0** (The previously deferred `wp_link_pages` finding is now 100% RESOLVED).
- **Warnings (WARNING): 0**
- **Recommendations / Deferred Info (INFO): 9** (Reduced from 11; `comments_template` and `tags` findings are now completely resolved; remaining 9 items belong to future phases such as widgets in Phase 6 and block patterns in Phase 7).

#### Next Milestone (Phase 6):
- [x] **Phase 6: Archives, Category, District, Search & 404 Templates** (`archive.php`, `category.php`, `author.php`, `search.php`, `404.php`, `sidebar.php`, widget areas, and accessible numbered pagination via `the_posts_pagination()`).

---

### [2026-11-07] - Entry 009: Phase 6 Complete — Archives, Category, District, Search & 404 Templates

#### Status Overview:
- **Phase 6 Status:** COMPLETED.
- **Git Commit:** Ready for staging and commit.
- **Theme Check Status:** **PASSED** (Critical Errors: 0, Warnings: 0, Info: 8).
- **PHP Syntax:** 32 / 32 PHP files passed (0 syntax or parse errors).
- **Runtime Testing:** 100% pass across Archive, Category, Author, Search, 404, Sidebar, and Empty States.

#### Key Architectural & Template Deliverables:

1. **Standard & Specialized Archive Hierarchy:**
   - **`archive.php`:** Broadsheet 2-column editorial feed (`layout-content-sidebar`) supporting tag, date, and generic taxonomy archives.
   - **`category.php`:** Specialized category template with dynamic category color accent bars (`cat-accent-bangladesh`, `cat-accent-politics`, etc.) and horizontal subcategory / district chips navigation bar (`category-subnav`).
   - **`author.php`:** Authoritative journalist / reporter profile template displaying 96px circular author avatar, reporter designation, biography, total published articles counter in Bengali numerals (`hasibshah_news_to_bangla_number()`), website link, and journalist article feed.
   - **`search.php`:** Broadsheet search results page featuring search query display, total result count badge in Bengali numerals (`$wp_query->found_posts`), inline refined search bar, and results feed.
   - **`404.php`:** Engaging newspaper error page featuring bold "৪০৪" Bengali numeral graphic, search box, return to homepage button, quick category navigation chips, and a 4-card editorial fallback grid displaying latest top stories (`no_found_rows => true`).
   - **`index.php`:** Standard fallback updated to use the unified broadsheet card feed and accessible pagination.

2. **Accessible Numbered Pagination:**
   - Configured `the_posts_pagination()` across all archive templates with accessible arrow indicators (`&larr; পূর্ববর্তী`, `পরবর্তী &rarr;`) and screen-reader page labels.
   - Maintained query integrity: refrained from using `'no_found_rows'` on main archive queries so SQL row calculation accurately determines total pages.
   - Formatted pagination controls in CSS with minimum 44px touch targets meeting WCAG 2.1 AA accessibility standards.

3. **Reusable Content Components:**
   - **`template-parts/content/content.php`:** Universal archive news card featuring 16:9 thumbnail, category badge, title with hover transition, author byline, time-ago relative timestamp in Bengali, reading time badge, and 3-line clamped excerpt.
   - **`template-parts/content/content-none.php`:** Accessible zero-results empty state offering friendly Bengali messaging, integrated search form, and popular category recommendation chips.
   - **`searchform.php`:** Accessible HTML5 search form with unique IDs, screen-reader text, and bilingual placeholders.

4. **Widget Areas & Sidebar (`sidebar.php` & `inc/core/setup.php`):**
   - Registered 5 official widget areas via `hasibshah_news_widgets_init()`:
     - `sidebar-1`: Main Editorial Sidebar (archives, single posts, search).
     - `header-ad-sidebar`: Header Ad Banner (728x90 leaderboard slot).
     - `footer-sidebar-1`, `footer-sidebar-2`, `footer-sidebar-3`: 3-column footer widget areas.
   - Implemented `sidebar.php` with safe `is_active_sidebar( 'sidebar-1' )` guard.
   - Connected `header-ad-sidebar` to `template-parts/header/masthead.php`.

5. **Archive Stylesheet (`assets/css/archive.css`) & Asset Pipeline:**
   - Authored 530+ lines of modular, scoped CSS covering archive headers, category accent bars, horizontal card feeds, author profile cards, search metrics, 404 layouts, numbered pagination, and comprehensive widget styling.
   - Conditionally enqueued `hasibshah-news-archive` in `inc/core/assets.php` on `is_archive() || is_search() || is_404() || is_home()` with dependency on `hasibshah-news-components`.

#### Verification & Test Results:

##### A. PHP Syntax Validation:
- Scanned all 32 PHP files across the theme: 100% PASS (0 syntax errors, 0 parse errors).

##### B. WordPress Runtime Testing (`scratch/test_phase6_runtime.php` & `scratch/test_sidebar.php`):
- **Widgets Registration:** All 5 widget sidebars registered and verified.
- **404 Template:** 51,945 bytes rendered; `HAS_404_BOX`, `HAS_404_CODE`, `HAS_BANGLA_DIGITS`, `HAS_SEARCH_FORM`, `HAS_TOP_STORIES`, and `HAS_ARCHIVE_CSS` all PASS.
- **Archive Template:** 21,593 bytes rendered; `HAS_ARCHIVE_HEADER`, `HAS_ARCHIVE_FEED`, `HAS_ARCHIVE_CARD`, `HAS_ARCHIVE_MEDIA`, `HAS_ARCHIVE_META`, `HAS_PAGINATION`, and `HAS_CONTENT_SIDEBAR` all PASS.
- **Category Template:** 11,083 bytes rendered; `HAS_CATEGORY_HEADER`, `HAS_CATEGORY_TITLE`, `HAS_CATEGORY_ACCENT`, `HAS_CATEGORY_FEED`, and `HAS_CATEGORY_CARD` all PASS.
- **Author Template:** 23,694 bytes rendered; `HAS_AUTHOR_PROFILE`, `HAS_AUTHOR_AVATAR`, `HAS_AUTHOR_NAME`, `HAS_AUTHOR_COUNT`, and `HAS_AUTHOR_FEED` all PASS.
- **Search Template:** 5,352 bytes rendered; `HAS_SEARCH_HEADER`, `HAS_SEARCH_TITLE`, `HAS_SEARCH_COUNT`, `HAS_SEARCH_FORM`, and `HAS_EDITORIAL_MAIN` all PASS.
- **Empty State (`content-none.php`):** 5,452 bytes rendered; `HAS_EMPTY_STATE`, `HAS_EMPTY_ICON`, `HAS_SEARCH_FORM_EMPTY`, and `HAS_SUGGESTIONS` all PASS.
- **Sidebar Widget Logic:** Verified clean output when active and zero extraneous HTML markup when inactive.
- **PHP Error Log:** Inspected `wp-content/debug.log`: 0 errors, 0 warnings, 0 notices generated by theme code.

##### C. Official Theme Check Plugin Audit (Version: 20260901):
- **Overall Scan Status:** **`PASSED`**
- **Critical Errors (REQUIRED): 0**
- **Warnings (WARNING): 0**
- **Recommendations / Deferred Info (INFO): 8** (Reduced from 9; all widgets-related requirements fully satisfied; remaining 8 items belong to Phase 7 block patterns/styles and style.css header URIs).

#### Next Milestone (Phase 7):
- [x] **Phase 7: Elementor & Gutenberg Integration** (Clean page container templates, Elementor editor iframe safety guards in `inc/compatibility/elementor.php`, Gutenberg custom news block patterns, editor styling in `assets/css/editor-style.css`, and empirical 4-stage Elementor test suite).

---

### [2026-11-07] - Entry 010: Phase 7 Complete — Elementor & Gutenberg Integration

#### Status Overview:
- **Phase 7 Status:** COMPLETED.
- **Git Commit:** Ready for staging and commit.
- **Theme Check Status:** **PASSED** (Critical Errors: 0, Warnings: 0, Info: 5 — down from 8).
- **PHP Syntax:** 37 / 37 PHP files passed (0 syntax or parse errors).
- **Practical Elementor Test Suite:** 100% PASS across Tests A, B, C, and D.
- **Gutenberg Integration:** Custom patterns and styles registered and functional.

#### Key Architectural & Template Deliverables:

1. **Standard Page & Content Architecture:**
   - **`page.php`:** Standard, unopinionated WordPress page container (`.page-main`, `.page-container`) rendering `content-page.php` and native WordPress comments when open.
   - **`template-parts/content/content-page.php`:** Clean semantic page template featuring title header, featured image, entry content, accessible multi-page pagination (`wp_link_pages()`), and edit link.
   - **`page-templates/template-fullwidth.php`:** Dedicated full-width page template (`Template Name: Full Width (No Sidebar)`), enabling edge-to-edge layout design for Gutenberg groups or custom page builders.

2. **Elementor Compatibility Architecture (`inc/compatibility/elementor.php`):**
   - Theme support declaration: `add_theme_support( 'elementor' )`.
   - Elementor Pro Theme Builder location registration hook (`elementor/theme/register_locations`).
   - Dynamic editor and preview mode detection via `has_action( 'elementor/loaded' )` and `\Elementor\Plugin::$instance->editor->is_edit_mode()`.
   - Contextual body classes (`elementor-support-active`, `hasibshah-news-elementor-editor`, `hasibshah-news-built-with-elementor`).
   - Editor mode safety flag localized to theme JavaScript (`hasibshahNewsEditorMode.isElementorEditor`).

3. **Neutral Compatibility Stylesheet (`assets/css/elementor-compat.css`):**
   - Neutral container resets for Elementor Full Width and Canvas pages, removing theme margins and allowing full-bleed sections.
   - Scoped resets preventing theme grid rules from colliding with Elementor Flexbox Containers (`.e-con`, `.e-con-boxed`, `.e-con-full`) and sections.
   - Z-index harmonization: guarantees theme header / ticker (`z-index: 99`) remains below Elementor editor controls, navigator, and modals (`z-index: 99999 !important`).
   - Editor mode safety guard: pauses ticker continuous DOM animation inside the Elementor editor preview iframe to eliminate canvas jitter and CPU thrashing.

4. **Gutenberg Block Patterns & Block Styles (`inc/compatibility/gutenberg.php`):**
   - Registered custom pattern category: `hasibshah-news-editorial` ("HasibShah News এডিটোরিয়াল").
   - **Pattern 1 — Breaking News Alert (`hasibshah-news/breaking-alert`):** Crimson-bordered callout box with uppercase alert badge and bold headline.
   - **Pattern 2 — Opinion Columnist Quote (`hasibshah-news/opinion-quote`):** Broadsheet pullquote with maroon accent border and columnist attribution.
   - **Pattern 3 — 3-Card Story Grid (`hasibshah-news/3-card-story-grid`):** 3-column responsive news card grid with 16:9 images, category tags, and excerpts.
   - **Block Styles (`register_block_style`):**
     - `core/quote` -> `broadsheet-quote` (Broadsheet double border, Hind Siliguri serif/sans font, red quote mark).
     - `core/paragraph` -> `lead-paragraph` (Newspaper intro / lead paragraph with 1.25rem font size and 1.65 line height).
     - `core/list` -> `news-bullet-list` (Editorial news bullet styling with red square bullets).
   - Core block visual styles enabled: `add_theme_support( 'wp-block-styles' )`.

5. **Gutenberg Editor Stylesheet (`assets/css/editor-style.css`):**
   - Synchronized editor typography (`Hind Siliguri`, `Inter`) with front-end design system tokens.
   - Implemented editor styles for `.is-style-lead-paragraph`, `.is-style-broadsheet-quote`, `.is-style-news-bullet-list`, and custom pattern wrappers.
   - Configured fluid editor block widths (`max-width: 840px`, wide `1100px`, full `100%`).

6. **JavaScript Editor Safety Harmonization (`assets/js/navigation.js`):**
   - Enhanced `isElementorEditor()` to check `elementor-editor-active`, `hasibshah-news-elementor-editor`, and localized window flags before handling focus trapping or drawer toggling.

#### Verification & Test Results:

##### A. PHP Syntax & Static File Validation:
- Scanned all 37 PHP files across the theme: 100% PASS (0 syntax errors, 0 parse errors).

##### B. Official Theme Check Plugin Audit (Version: 20260901):
- **Overall Scan Status:** **`PASSED`**
- **Critical Errors (REQUIRED): 0**
- **Warnings (WARNING): 0**
- **Info / Recommendations:** Reduced to **5** (from 8; `register_block_pattern`, `register_block_style`, and `wp-block-styles` recommendations are now 100% RESOLVED).

##### C. Practical Elementor Test Suite (`scratch/test_phase7_elementor_gutenberg.php`):
- **Test A (Editor Frame & Safety Guards):** PASS
  - `hasibshah_news_is_elementor_active()`: TRUE
  - `add_theme_support('elementor')`: DECLARED
  - `hasibshah_news_is_elementor_editor()`: DETECTED
  - Editor body classes and animation suspension: APPLIED
- **Test B (Widget Rendering & Layout Neutrality):** PASS
  - Elementor Heading and Text widgets rendered cleanly inside test container.
  - Builder body classes applied without layout breakage.
- **Test C (Native Templates: Canvas & Full Width):** PASS
  - Elementor Page Templates module confirmed active.
  - Native Theme Full Width template registered: 'Full Width (No Sidebar)'.
  - `elementor-compat.css` verified (3,622 bytes).
- **Test D (Absence Test):** PASS
  - Deactivated Elementor and verified theme execution in clean process: `hasibshah_news_is_elementor_active()` safely returns FALSE.
  - Theme front-end templates render completely error-free (42,044 bytes).
  - Re-activated Elementor without issues.

##### D. Runtime & Debug Log Verification:
- Inspected `wp-content/debug.log`: 0 errors, 0 warnings, 0 notices generated by theme code.

#### Next Milestone (Phase 8):
- **Phase 8: Performance, Accessibility & Security Hardening** (Complete dynamic output escaping audit, sanitization verification, nonce/capability checks, zero CDN dependency audit, explicit image dimensions to prevent CLS, and WCAG `:focus-visible` keyboard accessibility audit).

---

### Entry 011 - Phase 8 Complete: Performance, Accessibility & Security Hardening
**Date:** November 8, 2026
**Status:** Completed (Awaiting User Milestone Approval for Phase 8)

#### Actions Completed:

1. **Comprehensive Output Escaping & Security Audit:**
   - Audited all 37 PHP theme files and 95 dynamic output/echo sites using an automated tokenizer scanner (`audit_escaping_security.php`).
   - Cleaned up raw ternary variable echoes in `category.php` (lines 99-102), replacing them with native WordPress template syntax (`<?php if ( $hasibshah_news_is_active ) : ?> is-active<?php endif; ?>`) to eliminate static analysis warnings and escaping overhead.
   - Verified that 100% of template output uses appropriate late escaping (`esc_html`, `esc_html_e`, `esc_attr`, `esc_attr_e`, `esc_url`, `wp_kses_post`).
   - Verified that URL parameters and query inputs utilize strict sanitization (`absint()`, `sanitize_text_field()`, `wp_unslash()`).

2. **Zero External CDN & Network Independence Verification:**
   - Audited 48 theme asset and template files (`.php`, `.css`, `.js`, `.json`) using `audit_zero_cdn.php`.
   - Verified **0 external CDN or third-party network calls** across the entire codebase.
   - Confirmed 100% self-hosted typography (`Hind Siliguri`, `Inter`) loaded locally via WOFF2 with `font-display: swap` from `assets/fonts/`.
   - Guaranteed full GDPR, privacy, and WordPress.org Official Theme Repository compliance.

3. **Cumulative Layout Shift (CLS) Prevention & Aspect Ratios:**
   - Verified explicit image sizes in `inc/core/setup.php` (`hasibshah-news-lead` 1200x675, `hasibshah-news-card` 600x400, `hasibshah-news-thumb` 150x150).
   - Ensured all post thumbnails use `loading="lazy"` and ratio containers (`aspect-16-9`, `aspect-3-2`, `aspect-1-1`).
   - Preserved editorial fallback SVG placeholders with explicit `width="44" height="44"` and viewBox to prevent CLS when posts lack featured images.
   - Verified header leaderboard banner slot (`.news-header-banner-placeholder`) has fixed dimensions (`width: 728px; height: 90px;` on desktop; hidden on mobile) to eliminate ad injection reflow.

4. **Accessibility (a11y) & WCAG 2.1 AA/AAA Hardening:**
   - **Keyboard Focus Indicators (`:focus-visible`):** Added explicit 2px primary brand outline with 2px offset across all interactive elements (`a`, `button`, `input`, `select`, `textarea`, `[tabindex]`) in `assets/css/base.css`.
   - **Form Container Accessibility:** Enhanced `.news-search-form .search-form-input-wrap` in `assets/css/archive.css` with `:focus-within` visual border ring and focus shadow for clear indication when search input is active.
   - **Comment Submission Hardening:** Added `:focus-visible` styling to `.comment-form input[type="submit"]` in `assets/css/single.css`.
   - **Screen Reader & Skip Link Utilities:** Strengthened foundation definitions for `.skip-link` and `.screen-reader-text` directly in `assets/css/base.css` using theme design tokens.
   - **Reduced Motion Preference (WCAG 2.1 AAA):** Implemented a universal `@media (prefers-reduced-motion: reduce)` block in `assets/css/base.css` that disables smooth scrolling, sets animation/transition durations to 0.001ms, and respects OS-level accessibility preferences.
   - Verified breaking ticker accessibility: animation pauses automatically on `:focus-within`, `:hover`, and via accessible `#ticker-pause-toggle` button.

#### Verification & Test Results:

##### A. PHP Syntax Checks:
- Scanned all 37 PHP files: **100% PASS** (0 syntax errors, 0 parse errors).

##### B. Automated Security & Escaping Audit:
- Scanned 37 PHP files across 95 output sites: **0 issues found**. 100% compliance with WordPress escaping standards.

##### C. Zero CDN Audit:
- Scanned 48 files across `.php`, `.css`, `.js`, and `.json`: **0 external CDN calls found**. 100% self-hosted.

##### D. Official Theme Check Audit (Version: 20260901):
- **Overall Scan Status:** **`PASSED`**
- **Critical Errors (REQUIRED): 0**
- **Warnings (WARNING): 0**
- **Info / Recommendations:** 5 (cosmetic metadata recommendations, scheduled for Phase 9 final packaging).

##### E. Runtime & Debug Log Verification:
- `wp-content/debug.log`: 0 theme-generated notices, warnings, or errors.

##### F. Practical Browser & Layout Shift (CLS) Verification (Google Chrome Headless v156 & CDP):
- **Real Browser Cumulative Layout Shift (CLS):** Measured **`CLS = 0.0036`** via PerformanceObserver LayoutShift API (Core Web Vitals threshold `<= 0.1`: **PASS / GOOD**).
- **Authentic Keyboard Navigation & Skip Link:** First Tab key brings `.skip-link.screen-reader-text` into viewport at `top: 4px, left: 4px` with `2px solid rgb(201, 0, 0)` Crimson outline (PASS).
- **Interactive Controls Focus-Visible:** Sequential Tab navigation verified across Site Title link, Nav menu links, Search toggle, and Ticker links with high-contrast `2px solid rgb(10, 25, 47)` Navy outline and `2px offset` (PASS).
- **Responsive Viewports:**
  - Mobile (375x812): Mobile menu toggle `flex`, Header banner slot `none` (hidden, 0 CLS), Mobile drawer open/close `PASS`.
  - Tablet (768x1024): Header banner slot `none` (PASS).
  - Desktop (1280x800): Mobile toggle `none`, Desktop menu `flex`, Header banner slot `block` with exact fixed slot `728px x 90px` (PASS).
- **Search & Ticker Accessibility:** Search toggle opens with `aria-expanded="true"`, closes on `Escape` key (`aria-expanded="false"`) (PASS). Ticker pauses on `:focus-within` and toggles via `#ticker-pause-toggle` (`aria-pressed`) (PASS).
- **Reduced Motion Emulation:** `prefers-reduced-motion: reduce` verified in browser; disables smooth scrolling (`scroll-behavior: auto`) and halts continuous ticker animation (`animation: none`) (PASS).
- **Lighthouse 13.6.0 Audit Results (Official Chrome Headless Reports):**
  - **Desktop Accessibility Score:** **`96 / 100`** (Exceeds 95+ Acceptance Criterion: **PASS**).
  - **Mobile Accessibility Score:** **`96 / 100`** (Exceeds 95+ Acceptance Criterion: **PASS**).
  - **Desktop Performance Score:** **`99 / 100`**.
  - **Mobile Performance Score:** **`68 / 100`** (under simulated 4G mobile network emulation).
  - Passed accessibility rules: 25 on Desktop, 26 on Mobile.
  - Heading order hierarchy (`heading-order`): 100% resolved in `section-opinion.php`.
  - Footer attribution link identification (`link-in-text-block`): 100% resolved in `layout.css`.

#### Next Milestone (Phase 9):
- **Phase 9: Testing, Theme Check & WP.org Readiness** (Full cross-template test, demo content validation, style.css header finalizing, readme.txt validation, Theme Check zero-warning pass, and WordPress.org submission readiness).
