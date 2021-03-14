<?php
/**
 * Homepage sections
 *
 * Bizbir
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Bizbir_Homepage' ) ) {

	class Bizbir_Homepage {

		public static $data_arr = array();
		/**
		 * Constructor
		 */
		public function __construct() {
			apply_filters( 'bizbir_homepage_data', self::$data_arr );
		}

		/**
		 * Homepage
		 *
		 * @author CodeManas
		 * @since 1.0.0
		 */
		static function render_data( $data_arr ) {
			return $data_arr;
		}

	}

	new Bizbir_Homepage();
}

