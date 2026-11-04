# DESIGN-SYSTEM.md: HasibShah News Theme

**Design Language:** Editorial Broadsheet meets Modern Digital Newspaper  
**Target Market:** Bangladesh-focused online news portals & magazines  
**Supported Languages:** Bangla (বাংলা) & English  
**Design Philosophy:** High density, maximum legibility, zero layout shifts, cultural authenticity, authoritative editorial presence.

---

## 1. Typography System

Bangla typography requires specialized consideration. Unlike Latin scripts, Bengali script has ascenders, descenders, vowel diacritics (*kar*), and conjunct consonants (*juktakkhor*). Standard line-heights often clip Bengali accents or cause overlapping.

### 1.1 Font Families (Self-Hosted, GDPR/WP.org Compliant)

| Script | Primary Font | Fallback Stack | Purpose |
| :--- | :--- | :--- | :--- |
| **Bangla** | **SolaimanLipi** / **Tiro Bangla** / **Hind Siliguri** | `'Kalpurush'`, `'SutonnyMJ'`, `'Vrinda'`, sans-serif | Headlines, body text, bylines, meta information |
| **English** | **Inter** (or System UI) | `-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif` | English headlines, metadata, numbers |
| **Editorial Serif** | **Merriweather** / **Noto Serif Bengali** | Georgia, 'Times New Roman', serif | Opinion pieces, editorial quotes, featured lead articles |

*Note: All web fonts will be stored locally inside `assets/fonts/` with `@font-face` declarations using `font-display: swap` to prevent FOUT/FOIT and eliminate external Google Fonts API requests (mandatory for WordPress.org privacy standards).*

### 1.2 Bangla Headline & Text Overflow Prevention Rules

Bangla headlines can be significantly longer than their English counterparts. To ensure headlines never overflow or break layouts:

```css
/* Core Bangla Typography Rules */
.bangla-text,
:lang(bn),
.entry-title,
.news-headline {
    /* Prevent clipping of matras and hasant diacritics */
    line-height: 1.45;
    
    /* Word breaking and overflow protection */
    overflow-wrap: break-word;
    word-break: break-word;
    
    /* Modern balanced headline wrapping */
    text-wrap: balance;
    
    /* Smooth font rendering */
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

/* Multi-line Truncation Clamping for News Cards */
.news-card-title-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 1.45;
    max-height: calc(1.45em * 2);
}

.news-card-title-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 1.45;
    max-height: calc(1.45em * 3);
}

/* Article Body Typography for Sustained Reading */
.single-post .entry-content p {
    font-size: clamp(1.0625rem, 0.95rem + 0.5vw, 1.25rem); /* 17px - 20px */
    line-height: 1.75;
    margin-bottom: 1.6em;
    color: var(--color-text-main);
    letter-spacing: 0.01em;
}
```

### 1.3 Fluid Typography Scale

Calculated using modern CSS `clamp()` for smooth scaling between mobile (`360px`) and desktop (`1440px`):

- **Display Lead / Hero Headline:** `clamp(1.75rem, 1.2rem + 2.5vw, 2.75rem)` (28px - 44px)
- **H1 (Article Headline):** `clamp(1.6rem, 1.1rem + 2vw, 2.375rem)` (25px - 38px)
- **H2 (Section Header / Secondary Lead):** `clamp(1.35rem, 1rem + 1.2vw, 1.75rem)` (21px - 28px)
- **H3 (Standard News Card Title):** `clamp(1.125rem, 0.95rem + 0.8vw, 1.35rem)` (18px - 21px)
- **H4 (Sidebar / List Item Title):** `clamp(0.95rem, 0.85rem + 0.4vw, 1.125rem)` (15px - 18px)
- **Body Regular:** `1rem` (16px)
- **Meta / Timestamp / Byline:** `0.875rem` (14px)
- **Small Badge / Microcopy:** `0.75rem` (12px)

---

## 2. Color Palette & Theming

Designed for high contrast (WCAG AAA compliant for body copy, AA compliant for UI controls) and true editorial authority.

### 2.1 Color Tokens (CSS Custom Properties)

```css
:root {
    /* Brand & Editorial Primaries */
    --color-brand-primary: #0A192F;      /* Deep Editorial Navy (Trust, Depth) */
    --color-brand-accent: #C90000;       /* Urgent Crimson / Breaking News Red */
    --color-brand-accent-hover: #A00000;

    /* Semantic News Category Accents */
    --color-cat-bangladesh: #006A4E;     /* National Green */
    --color-cat-politics: #8A1C14;       /* Deep Maroon */
    --color-cat-business: #0F52BA;       /* Sapphire Blue */
    --color-cat-sports: #E65100;         /* Vibrant Amber */
    --color-cat-tech: #00838F;           /* Teal Cyan */
    --color-cat-entertainment: #6A1B9A;  /* Plum Violet */
    --color-cat-opinion: #37474F;        /* Slate Charcoal */

    /* Neutrals & Surfaces */
    --color-bg-body: #FFFFFF;
    --color-bg-surface: #F8F9FA;         /* Soft paper off-white */
    --color-bg-surface-alt: #F1F3F5;
    --color-border-subtle: #E9ECEF;
    --color-border-medium: #CED4DA;
    --color-border-strong: #212529;      /* Classic newspaper dividing lines */

    /* Typography */
    --color-text-main: #1A1A1A;          /* 90% Black for comfortable reading */
    --color-text-muted: #555555;         /* Metadata, dates, bylines */
    --color-text-light: #767676;
    --color-text-inverse: #FFFFFF;

    /* Shadows & Elevation */
    --shadow-card: 0 1px 3px rgba(0, 0, 0, 0.08);
    --shadow-hover: 0 4px 12px rgba(0, 0, 0, 0.12);
    --shadow-sticky: 0 2px 8px rgba(0, 0, 0, 0.08);

    /* Grid & Layout */
    --container-max-width: 1280px;
    --container-padding: 1rem;
    --newspaper-column-gap: 1.5rem;
}

/* Dark Mode / Night Reading Palette */
[data-theme="dark"] {
    --color-bg-body: #121416;
    --color-bg-surface: #1A1D20;
    --color-bg-surface-alt: #24282C;
    --color-border-subtle: #2C3036;
    --color-border-medium: #3E444B;
    --color-border-strong: #E9ECEF;

    --color-text-main: #E6E8EA;
    --color-text-muted: #A0A5AA;
    --color-text-light: #80858B;
    --color-brand-primary: #64B5F6;
    --color-brand-accent: #FF5252;
}
```

---

## 3. Grid & Spacing System

- **Desktop (1200px+):** 12-Column Flexible CSS Grid with standard 24px gutters.
- **Tablet (768px - 1024px):** 6-Column or 8-Column Grid.
- **Mobile (< 768px):** Single-column stacked cards with horizontal scroll chips for secondary links.
- **Baseline Scale:** 4px / 8px scale (`4px`, `8px`, `12px`, `16px`, `24px`, `32px`, `48px`, `64px`).

---

## 4. News Portal Component Library

### 4.1 Newspaper Masthead
- **Top Bar:** 
  - Left: Bengali Date (e.g., ১৯ কার্তিক ১৪৩১), English Date, Islamic Hijri Date.
  - Center: Edition indicator (ঢাকা সংস্করণ / জাতীয়).
  - Right: Weather badge hook, Dark mode toggle, Social links, Search trigger.
- **Main Masthead Branding:**
  - Classic centered or left-aligned authoritative publication logo.
  - Tagline in authentic editorial typeface.
  - Header Leaderboard Banner Ad slot (`728x90` / `970x90` responsive slot with hook).

### 4.2 Breaking News Ticker (ব্রেকিং নিউজ)
- High-visibility crimson badge: `ব্রেকিং নিউজ` or `জরুরি`.
- Smooth scrolling or sliding headline loop (vanilla JS or pure CSS).
- Pause on hover, focusable for screen readers (`aria-live="polite"`).

### 4.3 Editorial Homepage Layout Modules
1. **Hero Lead Section (The Big Cover):**
   - 3-Column Split: 
     - Column 1: Secondary Feature Story (card with medium thumbnail).
     - Column 2 (Center - 50% width): **Lead Story** with huge banner image, high-impact headline, sub-headline, and excerpt.
     - Column 3: "সর্বশেষ" (Latest Headlines) chronologically sorted vertical list with time tags.
2. **Bangladesh / District News Section (সারাদেশ):**
   - Interactive district/division filter tabs (ঢাকা, চট্টগ্রাম, রাজশাহী, খুলনা, বরিশাল, সিলেট, রংপুর, ময়মনসিংহ).
   - Dynamic 4-column card grid showing localized reports.
3. **Category Feature Grids (রাজনীতি, অর্থনীতি, আন্তর্জাতিক):**
   - Section header with solid color-coded accent border.
   - Left side: 1 Primary Card with image; Right side: 3 compact thumbnail list items.
4. **Multimedia Hub (ভিডিও ও ছবি):**
   - Dark aesthetic surface (`#0A192F` background).
   - Video cards with duration badge & overlay play icon.
   - Photo gallery cards with photo count badge.
5. **Opinion & Editorial (মতামত ও সম্পাদকীয়):**
   - Distinctive border treatment.
   - Circular author/columnist portrait avatars (64px x 64px) with columnist name, designation, and thought-provoking title.

### 4.4 Single Article Details View
- **Category Badge:** Colored pill link.
- **Main Headline:** Authoritative `H1` with optimal line-height.
- **Byline & Metadata:**
  - Reporter name with link to author archive.
  - Publication timestamp and "আপডেট" (Updated) timestamp.
  - Estimated reading time (e.g. `৩ মিনিট পড়ার সময়`).
- **Media Presentation:**
  - Featured image with responsive `srcset`.
  - Photo caption and photographer credit.
- **Social Sharing Bar:**
  - Lightweight, accessible share buttons (Facebook, X, WhatsApp, Copy Link, Print).
- **Article Body:**
  - Drop-cap styling for lead paragraph (optional toggle).
  - High readability font sizing.
  - Pull quotes with left accent border.
- **Related News Grid:**
  - 3 or 4 relevant stories based on matching tags or category.
- **Accessible Comments Section:**
  - Nested replies, character counts, clean moderation flags.

---

## 5. Responsive Design & Accessibility (a11y) Specifications

- **Mobile First:** Every layout component is coded mobile-first, using CSS Grid and Flexbox.
- **Touch Targets:** Minimum 44px x 44px for all interactive buttons, burger menu triggers, and pagination links.
- **Skip Links:** Native `#main-content` skip link as the very first focusable element for keyboard and screen reader navigation.
- **Screen Reader Only Classes:** Standard `.screen-reader-text` class strictly implemented.
- **Reduced Motion:** Support for `@media (prefers-reduced-motion: reduce)` disabling all ticker animations and smooth scrolls for sensitive users.

