<?php

namespace LaurentCore\CPT\Shortcodes\PortfolioCategoryList;

use LaurentCore\Lib;

class PortfolioCategoryList implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'eltdf_portfolio_category_list';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map( array(
					'name'     => esc_html__( 'Portfolio Category List', 'laurent-core' ),
					'base'     => $this->getBase(),
					'category' => esc_html__( 'by LAURENT', 'laurent-core' ),
					'icon'     => 'icon-wpb-portfolio-category-list extended-custom-icon',
					'params'   => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'laurent-core' ),
							'value'       => array_flip( laurent_elated_get_number_of_columns_array( true, array( 'one' ) ) ),
							'description' => esc_html__( 'Default value is Three', 'laurent-core' ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'laurent-core' ),
							'value'       => array_flip( laurent_elated_get_space_between_items_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_of_items',
							'heading'     => esc_html__( 'Number of Items Per Page', 'laurent-core' ),
							'description' => esc_html__( 'Set number of items for your portfolio category list. Default value is 6', 'laurent-core' ),
							'value'       => '-1'
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'orderby',
							'heading'     => esc_html__( 'Order By', 'laurent-core' ),
							'value'       => array_flip( laurent_elated_get_query_order_by_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'order',
							'heading'     => esc_html__( 'Order', 'laurent-core' ),
							'value'       => array_flip( laurent_elated_get_query_order_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'image_proportions',
							'heading'     => esc_html__( 'Image Proportions', 'laurent-core' ),
							'value'       => array(
								esc_html__( 'Original', 'laurent-core' )  => 'full',
								esc_html__( 'Square', 'laurent-core' )    => 'square',
								esc_html__( 'Landscape', 'laurent-core' ) => 'landscape',
								esc_html__( 'Portrait', 'laurent-core' )  => 'portrait',
								esc_html__( 'Medium', 'laurent-core' )    => 'medium',
								esc_html__( 'Large', 'laurent-core' )     => 'large',
								esc_html__( 'Custom', 'laurent-core' )    => 'custom'
							),
							'description' => esc_html__( 'Set image proportions for your portfolio category list', 'laurent-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_image_width',
							'heading'     => esc_html__( 'Custom Image Width', 'laurent-core' ),
							'description' => esc_html__( 'Enter image width in px', 'laurent-core' ),
							'dependency'  => array( 'element' => 'image_proportions', 'value' => 'custom' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_image_height',
							'heading'     => esc_html__( 'Custom Image Height', 'laurent-core' ),
							'description' => esc_html__( 'Enter image height in px', 'laurent-core' ),
							'dependency'  => array( 'element' => 'image_proportions', 'value' => 'custom' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_tag',
							'heading'    => esc_html__( 'Title Tag', 'laurent-core' ),
							'value'      => array_flip( laurent_elated_get_title_tag( true ) )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'number_of_columns'   => 'three',
			'space_between_items' => 'normal',
			'number_of_items'     => '6',
			'orderby'             => 'date',
			'order'               => 'ASC',
			'image_proportions'   => 'full',
			'custom_image_width'  => '',
			'custom_image_height' => '',
			'title_tag'           => 'h3'
		);
		$params = shortcode_atts( $args, $atts );
		
		$query_array              = $this->getQueryArray( $params );
		$params['query_results']  = get_terms( $query_array );
		$params['holder_classes'] = $this->getHolderClasses( $params, $args );
		$params['image_size']     = $this->getImageSize( $params );
		$params['title_tag']      = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		
		$html = laurent_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'portfolio-category-holder', '', $params );
		
		return $html;
	}
	
	public function getQueryArray( $params ) {
		$query_array = array(
			'taxonomy'   => 'portfolio-category',
			'number'     => $params['number_of_items'],
			'orderby'    => $params['orderby'],
			'order'      => $params['order'],
			'hide_empty' => true
		);
		
		return $query_array;
	}
	
	public function getHolderClasses( $params, $args ) {
		$classes = array();
		
		$classes[] = ! empty( $params['number_of_columns'] ) ? 'eltdf-' . $params['number_of_columns'] . '-columns' : 'eltdf-' . $args['number_of_columns'] . '-columns';
		$classes[] = ! empty( $params['space_between_items'] ) ? 'eltdf-' . $params['space_between_items'] . '-space' : 'eltdf-' . $args['space_between_items'] . '-space';
		
		return implode( ' ', $classes );
	}
	
	public function getImageSize( $params ) {
		$thumb_size = 'full';
		
		if ( ! empty( $params['image_proportions'] ) ) {
			$image_size = $params['image_proportions'];
			
			switch ( $image_size ) {
				case 'landscape':
					$thumb_size = 'laurent_elated_image_landscape';
					break;
				case 'portrait':
					$thumb_size = 'laurent_elated_image_portrait';
					break;
				case 'square':
					$thumb_size = 'laurent_elated_image_square';
					break;
				case 'medium':
					$thumb_size = 'medium';
					break;
				case 'large':
					$thumb_size = 'large';
					break;
				case 'full':
					$thumb_size = 'full';
					break;
				case 'custom':
					$thumb_size = 'custom';
					break;
			}
		}
		
		return $thumb_size;
	}
}