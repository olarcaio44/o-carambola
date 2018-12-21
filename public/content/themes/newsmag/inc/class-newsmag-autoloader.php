<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Newsmag_Autoloader
 */
class Newsmag_Autoloader {
	public function __construct() {
		spl_autoload_register( array( $this, 'load' ) );
	}

	/**
	 * @param $class
	 */
	public function load( $class ) {
		/**
		 * All classes are prefixed with Sigma_
		 */
		$parts = explode( '_', $class );
		$bind  = implode( '-', $parts );

		$directories = array(
			get_template_directory() . '/inc/',
			get_template_directory() . '/inc/libraries/',
			get_template_directory() . '/inc/libraries/customizer/',
			get_template_directory() . '/inc/libraries/epsilon-framework/',
			get_template_directory() . '/inc/libraries/welcome-screen/',
		);

		foreach ( $directories as $directory ) {
			if ( file_exists( $directory . '/class-' . strtolower( $bind ) . '.php' ) ) {
				require_once $directory . '/class-' . strtolower( $bind ) . '.php';

				return;
			}
		}

		/**
		 * Load widgets
		 */
		if ( ( count( $parts ) > 2 ) && 'Widget' == $parts[0] && 'Newsmag' == $parts[1] ) {
			$path = get_template_directory() . '/inc/libraries/widgets/' . strtolower( $bind ) . '/class-' . strtolower( $bind ) . '.php';
			if ( file_exists( $path ) ) {
				require_once $path;
			}
		}

	}
}

$autoloader = new Newsmag_Autoloader();
