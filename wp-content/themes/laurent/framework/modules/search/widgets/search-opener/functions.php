<?php

if ( ! function_exists( 'laurent_elated_register_search_opener_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function laurent_elated_register_search_opener_widget( $widgets ) {
		$widgets[] = 'LaurentElatedClassSearchOpener';
		
		return $widgets;
	}
	
	add_filter( 'laurent_core_filter_register_widgets', 'laurent_elated_register_search_opener_widget' );
}