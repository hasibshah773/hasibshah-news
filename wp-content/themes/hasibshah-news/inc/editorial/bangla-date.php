<?php
/**
 * Bengali Date and Number Utilities
 *
 * Provides functions to convert English numbers to Bengali numerals,
 * and format current Gregorian dates with Bengali weekday and month names.
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'hasibshah_news_to_bangla_number' ) ) :
	/**
	 * Converts an English number or string of digits to Bengali numerals.
	 *
	 * @param string|int $number English numbers/string.
	 * @return string Bengali numeral string.
	 */
	function hasibshah_news_to_bangla_number( $number ) {
		$en_digits = array( '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' );
		$bn_digits = array( '০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯' );

		return str_replace( $en_digits, $bn_digits, (string) $number );
	}
endif;

if ( ! function_exists( 'hasibshah_news_get_editorial_date' ) ) :
	/**
	 * Formats and returns the current localized editorial date string for the topbar.
	 *
	 * @return string Localized date string.
	 */
	function hasibshah_news_get_editorial_date() {
		$timestamp = current_time( 'timestamp' ); // phpcs:ignore WordPress.DateTime.CurrentTimeTimestamp.Requested

		$en_days = array( 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' );
		$bn_days = array( 'রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার', 'শনিবার' );

		$en_months = array(
			'January', 'February', 'March', 'April', 'May', 'June',
			'July', 'August', 'September', 'October', 'November', 'December'
		);
		$bn_months = array(
			'জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন',
			'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'
		);

		$current_day   = gmdate( 'l', $timestamp );
		$current_date  = gmdate( 'j', $timestamp );
		$current_month = gmdate( 'F', $timestamp );
		$current_year  = gmdate( 'Y', $timestamp );

		$bn_day   = str_replace( $en_days, $bn_days, $current_day );
		$bn_month = str_replace( $en_months, $bn_months, $current_month );
		$bn_date  = hasibshah_news_to_bangla_number( $current_date );
		$bn_year  = hasibshah_news_to_bangla_number( $current_year );

		$formatted_bn = sprintf( '%s, %s %s %s', $bn_day, $bn_date, $bn_month, $bn_year );
		$formatted_en = gmdate( 'l, j F Y', $timestamp );

		return apply_filters(
			'hasibshah_news_editorial_date',
			array(
				'bangla'  => $formatted_bn,
				'english' => $formatted_en,
			)
		);
	}
endif;

