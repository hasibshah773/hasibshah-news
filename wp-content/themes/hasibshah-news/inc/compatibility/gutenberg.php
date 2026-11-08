<?php
/**
 * Gutenberg Block Editor Integration, Patterns & Styles
 *
 * Registers custom editorial block patterns, block styles, and editor enhancements
 * tailored for broadsheet journalism in Bengali and English.
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'hasibshah_news_register_block_patterns' ) ) :
	/**
	 * Registers custom Gutenberg block patterns and categories.
	 */
	function hasibshah_news_register_block_patterns() {
		// 1. Register editorial pattern category
		if ( function_exists( 'register_block_pattern_category' ) ) {
			register_block_pattern_category(
				'hasibshah-news-editorial',
				array(
					'label' => esc_html__( 'HasibShah News এডিটোরিয়াল', 'hasibshah-news' ),
				)
			);
		}

		if ( ! function_exists( 'register_block_pattern' ) ) {
			return;
		}

		// 2. Pattern: Breaking News Alert Box
		register_block_pattern(
			'hasibshah-news/breaking-alert',
			array(
				'title'       => esc_html__( 'জরুরি সংবাদ অ্যালার্ট / Breaking News Alert', 'hasibshah-news' ),
				'description' => esc_html__( 'High-priority editorial news callout banner with crimson badge.', 'hasibshah-news' ),
				'categories'  => array( 'hasibshah-news-editorial' ),
				'keywords'    => array( 'breaking', 'alert', 'news', 'urgent', 'জরুরি' ),
				'content'     => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"1.25rem","bottom":"1.25rem","left":"1.5rem","right":"1.5rem"},"margin":{"top":"1.5rem","bottom":"1.5rem"}},"border":{"width":"2px","color":"#C90000","radius":"4px"}},"backgroundColor":"surface","className":"hasibshah-pattern-breaking-alert"} -->
<div class="wp-block-group hasibshah-pattern-breaking-alert has-surface-background-color has-background" style="border-color:#C90000;border-width:2px;border-radius:4px;margin-top:1.5rem;margin-bottom:1.5rem;padding-top:1.25rem;padding-right:1.5rem;padding-bottom:1.25rem;padding-left:1.5rem">
<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.85rem","fontStyle":"normal","fontWeight":"700"}},"backgroundColor":"accent","textColor":"white","className":"news-alert-pill"} -->
<p class="news-alert-pill has-white-color has-accent-background-color has-text-color has-background" style="font-size:0.85rem;font-style:normal;font-weight:700;display:inline-block;padding:0.2rem 0.6rem;border-radius:2px;text-transform:uppercase">জরুরি সংবাদ / Breaking News</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.35rem","lineHeight":"1.3"}},"textColor":"primary"} -->
<h3 class="wp-block-heading has-primary-color has-text-color" style="font-size:1.35rem;line-height:1.3">এখানে জরুরি সংবাদের প্রধান শিরোনামটি লিখুন</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.95rem","lineHeight":"1.6"}}} -->
<p style="font-size:0.95rem;line-height:1.6">ঘটনার সংক্ষিপ্ত বিবরণ এবং সর্বশেষ প্রাপ্ত তথ্যের সারাংশ এখানে তুলে ধরুন। সংবাদটি প্রতিনিয়ত আপডেট করা হচ্ছে।</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->',
			)
		);

		// 3. Pattern: Opinion Columnist Pullquote
		register_block_pattern(
			'hasibshah-news/opinion-quote',
			array(
				'title'       => esc_html__( 'সম্পাদকীয় উক্তি ও কলামিস্ট কোট / Opinion & Columnist Pullquote', 'hasibshah-news' ),
				'description' => esc_html__( 'Broadsheet pullquote box with columnist portrait slot and attribution.', 'hasibshah-news' ),
				'categories'  => array( 'hasibshah-news-editorial' ),
				'keywords'    => array( 'quote', 'opinion', 'columnist', 'মতামত', 'সম্পাদকীয়' ),
				'content'     => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"2rem","right":"2rem"},"margin":{"top":"2rem","bottom":"2rem"}},"border":{"left":{"color":"#8A1C14","width":"4px"}}},"backgroundColor":"surface","className":"hasibshah-pattern-opinion-quote"} -->
<div class="wp-block-group hasibshah-pattern-opinion-quote has-surface-background-color has-background" style="border-left-color:#8A1C14;border-left-width:4px;margin-top:2rem;margin-bottom:2rem;padding-top:1.5rem;padding-right:2rem;padding-bottom:1.5rem;padding-left:2rem">
<!-- wp:quote {"className":"is-style-broadsheet-quote"} -->
<blockquote class="wp-block-quote is-style-broadsheet-quote">
<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.2rem","lineHeight":"1.6"}}} -->
<p style="font-size:1.2rem;line-height:1.6">"সমাজ ও রাষ্ট্রের ইতিবাচক পরিবর্তনের জন্য নিরপেক্ষ ও দায়িত্বশীল সাংবাদিকতার বিকল্প নেই। সত্য প্রকাশে কোনো আপস হতে পারে না।"</p>
<!-- /wp:paragraph -->
<cite>— বিশিষ্ট কলামিস্ট ও বিশ্লেষক</cite>
</blockquote>
<!-- /wp:quote -->
</div>
<!-- /wp:group -->',
			)
		);

		// 4. Pattern: 3-Card Story Grid
		register_block_pattern(
			'hasibshah-news/3-card-story-grid',
			array(
				'title'       => esc_html__( '৩-কলাম সংবাদ গ্রিড / 3-Card Story Grid', 'hasibshah-news' ),
				'description' => esc_html__( '3-column responsive broadsheet news story card layout.', 'hasibshah-news' ),
				'categories'  => array( 'hasibshah-news-editorial' ),
				'keywords'    => array( 'grid', 'columns', 'stories', 'cards', 'সংবাদ গ্রিড' ),
				'content'     => '<!-- wp:columns {"style":{"spacing":{"margin":{"top":"2rem","bottom":"2rem"},"blockGap":"1.5rem"}},"className":"hasibshah-pattern-story-grid"} -->
<div class="wp-block-columns hasibshah-pattern-story-grid" style="margin-top:2rem;margin-bottom:2rem">
<!-- wp:column {"style":{"spacing":{"padding":{"top":"1rem","bottom":"1rem","left":"1rem","right":"1rem"}},"border":{"width":"1px","color":"#E9ECEF","radius":"4px"}}} -->
<div class="wp-block-column" style="border-color:#E9ECEF;border-width:1px;border-radius:4px;padding-top:1rem;padding-right:1rem;padding-bottom:1rem;padding-left:1rem">
<!-- wp:image {"aspectRatio":"16/9","scale":"cover","sizeSlug":"medium"} -->
<figure class="wp-block-image size-medium"><img alt="সংবাদের ছবি" style="aspect-ratio:16/9;object-fit:cover"/></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"1.15rem","lineHeight":"1.3"}}} -->
<h4 class="wp-block-heading" style="font-size:1.15rem;line-height:1.3"><a href="#">জাতীয় পর্যায়ে ডিজিটাল রূপান্তরের নতুন মাইলফলক</a></h4>
<!-- /wp:heading -->
<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem","lineHeight":"1.5"}},"textColor":"muted"} -->
<p class="has-muted-color has-text-color" style="font-size:0.9rem;line-height:1.5">সারাদেশে তথ্যপ্রযুক্তি অবকাঠামো আধুনিকায়নে নেওয়া প্রকল্পের অগ্রগতি তুলে ধরা হয়েছে আজকের সম্মেলনে...</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":{"top":"1rem","bottom":"1rem","left":"1rem","right":"1rem"}},"border":{"width":"1px","color":"#E9ECEF","radius":"4px"}}} -->
<div class="wp-block-column" style="border-color:#E9ECEF;border-width:1px;border-radius:4px;padding-top:1rem;padding-right:1rem;padding-bottom:1rem;padding-left:1rem">
<!-- wp:image {"aspectRatio":"16/9","scale":"cover","sizeSlug":"medium"} -->
<figure class="wp-block-image size-medium"><img alt="সংবাদের ছবি" style="aspect-ratio:16/9;object-fit:cover"/></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"1.15rem","lineHeight":"1.3"}}} -->
<h4 class="wp-block-heading" style="font-size:1.15rem;line-height:1.3"><a href="#">অর্থনীতিতে রপ্তানি আয়ের ইতিবাচক প্রবৃদ্ধি অব্যাহত</a></h4>
<!-- /wp:heading -->
<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem","lineHeight":"1.5"}},"textColor":"muted"} -->
<p class="has-muted-color has-text-color" style="font-size:0.9rem;line-height:1.5">চলতি অর্থবছরের তৃতীয় প্রান্তিকে সার্বিক বাণিজ্য ঘাটতি হ্রাসের তথ্য প্রকাশ করেছে কেন্দ্রীয় ব্যাংক...</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":{"top":"1rem","bottom":"1rem","left":"1rem","right":"1rem"}},"border":{"width":"1px","color":"#E9ECEF","radius":"4px"}}} -->
<div class="wp-block-column" style="border-color:#E9ECEF;border-width:1px;border-radius:4px;padding-top:1rem;padding-right:1rem;padding-bottom:1rem;padding-left:1rem">
<!-- wp:image {"aspectRatio":"16/9","scale":"cover","sizeSlug":"medium"} -->
<figure class="wp-block-image size-medium"><img alt="সংবাদের ছবি" style="aspect-ratio:16/9;object-fit:cover"/></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"1.15rem","lineHeight":"1.3"}}} -->
<h4 class="wp-block-heading" style="font-size:1.15rem;line-height:1.3"><a href="#">বিশ্বকাপ প্রস্তুতি ম্যাচে দলের চমৎকার পারফরম্যান্স</a></h4>
<!-- /wp:heading -->
<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem","lineHeight":"1.5"}},"textColor":"muted"} -->
<p class="has-muted-color has-text-color" style="font-size:0.9rem;line-height:1.5">ব্যাটিং ও ফিল্ডিংয়ে দৃঢ়তা দেখিয়ে প্রতিপক্ষকে হারিয়ে দারুণ প্রস্তুতি সম্পন্ন করেছে তরুণ দল...</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->',
			)
		);
	}
endif;
add_action( 'init', 'hasibshah_news_register_block_patterns' );

if ( ! function_exists( 'hasibshah_news_register_block_styles' ) ) :
	/**
	 * Registers custom Gutenberg block styles.
	 */
	function hasibshah_news_register_block_styles() {
		if ( ! function_exists( 'register_block_style' ) ) {
			return;
		}

		// 1. Core Quote: Broadsheet Quote Style
		register_block_style(
			'core/quote',
			array(
				'name'  => 'broadsheet-quote',
				'label' => esc_html__( 'Broadsheet Quote / সংবাদপত্রের উক্তি', 'hasibshah-news' ),
			)
		);

		// 2. Core Paragraph: Lead Paragraph Style
		register_block_style(
			'core/paragraph',
			array(
				'name'  => 'lead-paragraph',
				'label' => esc_html__( 'Lead Paragraph / প্রারম্ভিক অনুচ্ছেদ', 'hasibshah-news' ),
			)
		);

		// 3. Core List: News Bullet List Style
		register_block_style(
			'core/list',
			array(
				'name'  => 'news-bullet-list',
				'label' => esc_html__( 'News Bullets / সংবাদ বুলেট', 'hasibshah-news' ),
			)
		);
	}
endif;
add_action( 'init', 'hasibshah_news_register_block_styles' );
