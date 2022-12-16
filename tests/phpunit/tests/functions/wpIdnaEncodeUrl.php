<?php

/**
 * Tests for the wp_idna_encode_url() function
 *
 * @group functions.php
 * @covers ::wp_idna_encode_url
 */
class Tests_Functions_wpIdnaEncodeUrl extends WP_UnitTestCase {

	/**
	 * Tests wp_idna_encode_url().
	 *
	 * @dataProvider data_wp_idna_encode_url
	 *
	 * @param string $test_value Test value.
	 * @param string $expected   Expected return value.
	 */
	public function test_wp_idna_encode_url( $test_value, $expected ) {
		$this->assertSame( $expected, wp_idna_encode_url( $test_value ) );
	}

	/**
	 * Data provider for test_wp_idna_encode_url().
	 *
	 * @return array[] Test parameters {
	 *     @type string $test_value Test value.
	 *     @type string $expected   Expected return value.
	 * }
	 */
	public function data_wp_idna_encode_url() {
		return array(
			array( null, false ),
			array( 10, false ),
			array( 'https://wordpress.org', 'https://wordpress.org/' ),
			array( 'https://wordpress.org/', 'https://wordpress.org/' ),
			array( 'https://www.wordpress.org?foo=bar#anchor', 'https://www.wordpress.org/?foo=bar#anchor' ),
			array( 'https://föö.com?foo=bar', 'https://xn--f-1gaa.com/?foo=bar' ),
		);
	}
}
