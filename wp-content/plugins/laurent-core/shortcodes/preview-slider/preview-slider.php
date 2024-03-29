<?php

namespace LaurentCore\CPT\Shortcodes\PreviewSlider;

use LaurentCore\Lib;

class PreviewSlider implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'eltdf_preview_slider';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map( array(
				'name'                    => esc_html__( 'Preview Slider', 'laurent-core' ),
				'base'                    => $this->base,
				'icon'                    => 'icon-wpb-preview-slider extended-custom-icon',
				'category'                => esc_html__( 'by LAURENT', 'laurent-core' ),
				'as_parent'               => array( 'only' => 'eltdf_preview_slide' ),
				'show_settings_on_create' => true,
				'js_view'                 => 'VcColumnView',
				'params'                  => array(
                    array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading'     => esc_html__( 'Autoplay Speed', 'laurent-core' ),
						'param_name'  => 'autoplay_speed',
						'description' => esc_html__( 'Enter autoplay speed interval in milliseconds.', 'laurent-core' )
					)
				)
			) );
		}
	}

	public function render( $atts, $content = null ) {

		$args   = array(
			'autoplay'         => 'yes',
			'autoplay_speed'   => ''
		);
		$params = shortcode_atts( $args, $atts );
		extract( $params );
		$params['content'] = $content;

		$params['laptop_images']  = $this->getLaptopImages( $params );
		$params['tablet_images']  = $this->getTabletImages( $params );
		$params['mobile_images']  = $this->getMobileImages( $params );
		$params['slider_data']    = $this->getSliderData( $params );
		$params['slider_links']   = $this->getLinks( $params );
		$params['slider_targets'] = $this->getTargets( $params );
		$html                     = laurent_core_get_shortcode_module_template_part( 'templates/preview-slider-template', 'preview-slider', '', $params );

		return $html;

	}

	private function getLaptopImages( $params ) {

		$laptop_images_array = array();

		preg_match_all( '/ps_laptop_image="([^\"]+)"/i', $params['content'], $laptop_images_matches, PREG_OFFSET_CAPTURE );

		if ( isset( $laptop_images_matches[0] ) ) {
			$laptop_images = $laptop_images_matches[0];
		}

		foreach ( $laptop_images as $laptop_image ) {
			preg_match( '/ps_laptop_image="([^\"]+)"/i', $laptop_image[0], $slide_laptop_images_matches, PREG_OFFSET_CAPTURE );
			$laptop_images_array[] = $slide_laptop_images_matches[1][0];
		}


		return $laptop_images_array;
	}

	private function getTabletImages( $params ) {

		$tablet_images_array = array();

		preg_match_all( '/ps_tablet_image="([^\"]+)"/i', $params['content'], $tablet_images_matches, PREG_OFFSET_CAPTURE );

		if ( isset( $tablet_images_matches[0] ) ) {
			$tablet_images = $tablet_images_matches[0];
		}

		foreach ( $tablet_images as $tablet_image ) {
			preg_match( '/ps_tablet_image="([^\"]+)"/i', $tablet_image[0], $slide_tablet_images_matches, PREG_OFFSET_CAPTURE );
			$tablet_images_array[] = $slide_tablet_images_matches[1][0];
		}


		return $tablet_images_array;
	}

	private function getMobileImages( $params ) {

		$mobile_images_array = array();

		preg_match_all( '/ps_mobile_image="([^\"]+)"/i', $params['content'], $mobile_images_matches, PREG_OFFSET_CAPTURE );

		if ( isset( $mobile_images_matches[0] ) ) {
			$mobile_images = $mobile_images_matches[0];
		}

		foreach ( $mobile_images as $mobile_image ) {
			preg_match( '/ps_mobile_image="([^\"]+)"/i', $mobile_image[0], $slide_mobile_images_matches, PREG_OFFSET_CAPTURE );
			$mobile_images_array[] = $slide_mobile_images_matches[1][0];
		}


		return $mobile_images_array;
	}

	private function getLinks( $params ) {

		$ps_links = array();

		preg_match_all( '/ps_link="([^\"]+)"/i', $params['content'], $links_matches, PREG_OFFSET_CAPTURE );

		if ( isset( $links_matches[0] ) ) {
			$links = $links_matches[0];
		}

		foreach ( $links as $link ) {
			preg_match( '/ps_link="([^\"]+)"/i', $link[0], $slide_links_matches, PREG_OFFSET_CAPTURE );
			$ps_links[] = $slide_links_matches[1][0];
		}


		return $ps_links;
	}

	private function getTargets( $params ) {

		$ps_targets = array();

		preg_match_all( '/ps_target="([^\"]+)"/i', $params['content'], $targets_matches, PREG_OFFSET_CAPTURE );

		if ( isset( $targets_matches[0] ) ) {
			$targets = $targets_matches[0];
		}

		foreach ( $targets as $target ) {
			preg_match( '/ps_target="([^\"]+)"/i', $target[0], $slide_targets_matches, PREG_OFFSET_CAPTURE );
			$ps_targets[] = $slide_targets_matches[1][0];
		}


		return $ps_targets;
	}

	private function getSliderData( $params ) {

		$data = array();

		if ( $params['autoplay'] != '' ) {
			$data['data-autoplay'] = $params['autoplay'];
		}

		if ( $params['autoplay_speed'] != '' ) {
			$data['data-autoplay-speed'] = $params['autoplay_speed'];
		}

		return $data;
	}

}
