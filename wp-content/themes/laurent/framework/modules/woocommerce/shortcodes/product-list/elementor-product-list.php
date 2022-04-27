<?php
class LaurentElatedElementorProductList extends \Elementor\Widget_Base {

	public function get_name() {
		return 'eltdf_product_list'; 
	}

	public function get_title() {
		return esc_html__( 'Product List', 'laurent' );
	}

	public function get_icon() {
		return 'laurent-elementor-custom-icon laurent-elementor-product-list';
	}

	public function get_categories() {
		return [ 'elated' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__( 'General', 'laurent' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'type',
			[
				'label'     => esc_html__( 'Type', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'standard' => esc_html__( 'Standard', 'laurent'),
					'masonry' => esc_html__( 'Masonry', 'laurent')
				),
				'default' => 'standard'
			]
		);

		$this->add_control(
			'info_position',
			[
				'label'     => esc_html__( 'Product Info Position', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'info-on-image' => esc_html__( 'Info On Image Hover', 'laurent'),
					'info-below-image' => esc_html__( 'Info Below Image', 'laurent')
				),
				'default' => 'info-on-image'
			]
		);

		$this->add_control(
			'number_of_posts',
			[
				'label'     => esc_html__( 'Number of Products', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => '8'
			]
		);

		$this->add_control(
			'number_of_columns',
			[
				'label'     => esc_html__( 'Number of Columns', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent'),
					'one' => esc_html__( 'One', 'laurent'),
					'two' => esc_html__( 'Two', 'laurent'),
					'three' => esc_html__( 'Three', 'laurent'),
					'four' => esc_html__( 'Four', 'laurent'),
					'five' => esc_html__( 'Five', 'laurent'),
					'six' => esc_html__( 'Six', 'laurent')
				),
				'default' => 'four'
			]
		);

		$this->add_control(
			'space_between_items',
			[
				'label'     => esc_html__( 'Space Between Items', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'huge' => esc_html__( 'Huge (40)', 'laurent'),
					'large' => esc_html__( 'Large (25)', 'laurent'),
					'medium' => esc_html__( 'Medium (20)', 'laurent'),
					'normal' => esc_html__( 'Normal (15)', 'laurent'),
					'small' => esc_html__( 'Small (10)', 'laurent'),
					'tiny' => esc_html__( 'Tiny (5)', 'laurent'),
					'no' => esc_html__( 'No (0)', 'laurent')
				),
				'default' => 'normal'
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'     => esc_html__( 'Order By', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'date' => esc_html__( 'Date', 'laurent'),
					'ID' => esc_html__( 'ID', 'laurent'),
					'menu_order' => esc_html__( 'Menu Order', 'laurent'),
					'name' => esc_html__( 'Post Name', 'laurent'),
					'rand' => esc_html__( 'Random', 'laurent'),
					'title' => esc_html__( 'Title', 'laurent'),
					'on-sale' => esc_html__( 'On Sale', 'laurent')
				),
				'default' => 'date'
			]
		);

		$this->add_control(
			'order',
			[
				'label'     => esc_html__( 'Order', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'ASC' => esc_html__( 'ASC', 'laurent'),
					'DESC' => esc_html__( 'DESC', 'laurent')
				),
				'default' => 'ASC'
			]
		);

		$this->add_control(
			'taxonomy_to_display',
			[
				'label'     => esc_html__( 'Choose Sorting Taxonomy', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'If you would like to display only certain products, this is where you can select the criteria by which you would like to choose which products to display', 'laurent' ),
				'options' => array(
					'category' => esc_html__( 'Category', 'laurent'),
					'tag' => esc_html__( 'Tag', 'laurent'),
					'id' => esc_html__( 'Id', 'laurent')
				),
				'default' => 'category'
			]
		);

		$this->add_control(
			'taxonomy_values',
			[
				'label'     => esc_html__( 'Enter Taxonomy Values', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Separate values (category slugs, tags, or post IDs) with a comma', 'laurent' )
			]
		);

		$this->add_control(
			'image_size',
			[
				'label'     => esc_html__( 'Image Proportions', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent'),
					'full' => esc_html__( 'Original', 'laurent'),
					'square' => esc_html__( 'Square', 'laurent'),
					'landscape' => esc_html__( 'Landscape', 'laurent'),
					'portrait' => esc_html__( 'Portrait', 'laurent'),
					'medium' => esc_html__( 'Medium', 'laurent'),
					'large' => esc_html__( 'Large', 'laurent'),
					'woocommerce_single' => esc_html__( 'Shop Single', 'laurent'),
					'woocommerce_thumbnail' => esc_html__( 'Shop Thumbnail', 'laurent')
				),
				'default' => 'full'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'product_info',
			[
				'label' => esc_html__( 'Product Info', 'laurent' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'display_title',
			[
				'label'     => esc_html__( 'Display Title', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'laurent'),
					'no' => esc_html__( 'No', 'laurent')
				),
				'default' => 'yes'
			]
		);

		$this->add_control(
			'display_category',
			[
				'label'     => esc_html__( 'Display Category', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'laurent'),
					'yes' => esc_html__( 'Yes', 'laurent')
				),
				'default' => 'no'
			]
		);

		$this->add_control(
			'display_excerpt',
			[
				'label'     => esc_html__( 'Display Excerpt', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'laurent'),
					'yes' => esc_html__( 'Yes', 'laurent')
				),
				'default' => 'no'
			]
		);

		$this->add_control(
			'display_rating',
			[
				'label'     => esc_html__( 'Display Rating', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'laurent'),
					'no' => esc_html__( 'No', 'laurent')
				),
				'default' => 'yes'
			]
		);

		$this->add_control(
			'display_price',
			[
				'label'     => esc_html__( 'Display Price', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'laurent'),
					'no' => esc_html__( 'No', 'laurent')
				),
				'default' => 'yes'
			]
		);

		$this->add_control(
			'display_button',
			[
				'label'     => esc_html__( 'Display Button', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'laurent'),
					'no' => esc_html__( 'No', 'laurent')
				),
				'default' => 'yes'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'product_info_style',
			[
				'label' => esc_html__( 'Product Info Style', 'laurent' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'product_info_skin',
			[
				'label'     => esc_html__( 'Product Info Skin', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'default' => esc_html__( 'Default', 'laurent'),
					'light' => esc_html__( 'Light', 'laurent'),
					'dark' => esc_html__( 'Dark', 'laurent')
				),
				'default' => 'default',
				'condition' => [
					'info_position' => array( 'info-on-image' )
				]
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'     => esc_html__( 'Title Tag', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent'),
					'h1' => esc_html__( 'h1', 'laurent'),
					'h2' => esc_html__( 'h2', 'laurent'),
					'h3' => esc_html__( 'h3', 'laurent'),
					'h4' => esc_html__( 'h4', 'laurent'),
					'h5' => esc_html__( 'h5', 'laurent'),
					'h6' => esc_html__( 'h6', 'laurent')
				),
				'default' => 'h6',
				'condition' => [
					'display_title' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'title_transform',
			[
				'label'     => esc_html__( 'Title Text Transform', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent'),
					'none' => esc_html__( 'None', 'laurent'),
					'capitalize' => esc_html__( 'Capitalize', 'laurent'),
					'uppercase' => esc_html__( 'Uppercase', 'laurent'),
					'lowercase' => esc_html__( 'Lowercase', 'laurent'),
					'initial' => esc_html__( 'Initial', 'laurent'),
					'inherit' => esc_html__( 'Inherit', 'laurent')
				),
				'default' => '',
				'condition' => [
					'display_title' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label'     => esc_html__( 'Excerpt Length', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Number of characters', 'laurent' ),
				'condition' => [
					'display_excerpt' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'button_skin',
			[
				'label'     => esc_html__( 'Button Skin', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'default' => esc_html__( 'Default', 'laurent'),
					'light' => esc_html__( 'Light', 'laurent'),
					'dark' => esc_html__( 'Dark', 'laurent')
				),
				'default' => 'default',
				'condition' => [
					'display_button' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'shader_background_color',
			[
				'label'     => esc_html__( 'Shader Background Color', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::COLOR
			]
		);

		$this->add_control(
			'info_bottom_text_align',
			[
				'label'     => esc_html__( 'Product Info Text Alignment', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent'),
					'left' => esc_html__( 'Left', 'laurent'),
					'center' => esc_html__( 'Center', 'laurent'),
					'right' => esc_html__( 'Right', 'laurent')
				),
				'default' => 'center',
				'condition' => [
					'info_position' => array( 'info-below-image' )
				]
			]
		);

		$this->add_control(
			'info_bottom_margin',
			[
				'label'     => esc_html__( 'Product Info Bottom Margin (px)', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'info_position' => array( 'info-below-image' )
				]
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();

		$params['class_name']     = 'pli';
		$additional_params        = array();
		$additional_params['holder_classes'] = $this->getHolderClasses( $params );
		
		$queryArray                        = $this->generateProductQueryArray( $params );
		$query_result                      = new \WP_Query( $queryArray );
		$additional_params['query_result'] = $query_result;
		
		$params['this_object'] = $this;

        echo laurent_elated_get_woo_shortcode_module_template_part( 'templates/product-list', 'product-list', $params['type'], $params, $additional_params );

	}

	private function getHolderClasses( $params ) {
		$holderClasses   = array();
		$holderClasses[] = ! empty( $params['type'] ) ? 'eltdf-' . $params['type'] . '-layout' : '';
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'eltdf-' . $params['number_of_columns'] . '-columns' : '';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'eltdf-' . $params['space_between_items'] . '-space' : '';
		$holderClasses[] = ! empty( $params['info_position'] ) ? 'eltdf-' . $params['info_position'] : '';
		$holderClasses[] = ! empty( $params['product_info_skin'] ) ? 'eltdf-product-info-' . $params['product_info_skin'] : '';
		
		return implode( ' ', $holderClasses );
	}

	private function generateProductQueryArray( $params ) {
		$queryArray = array(
			'post_status'         => 'publish',
			'post_type'           => 'product',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $params['number_of_posts'],
			'orderby'             => $params['orderby'],
			'order'               => $params['order']
		);
		
		if ( $params['orderby'] === 'on-sale' ) {
			$queryArray['no_found_rows'] = 1;
			$queryArray['post__in']      = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
		}
		
		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'category' ) {
			$queryArray['product_cat'] = $params['taxonomy_values'];
		}
		
		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'tag' ) {
			$queryArray['product_tag'] = $params['taxonomy_values'];
		}
		
		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'id' ) {
			$idArray                = $params['taxonomy_values'];
			$ids                    = explode( ',', $idArray );
            $queryArray['orderby'] = 'post__in';
			$queryArray['post__in'] = $ids;
		}
		
		return $queryArray;
	}

	public function getItemClasses( $params ) {
		$itemClasses = array();
		
		$image_size_meta = get_post_meta( get_the_ID(), 'eltdf_product_featured_image_size', true );
		
		if ( ! empty( $image_size_meta ) ) {
			$itemClasses[] = 'eltdf-fixed-masonry-item eltdf-masonry-size-' . $image_size_meta;
		}
		
		return implode( ' ', $itemClasses );
	}

	public function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_transform'];
		}
		
		return implode( ';', $styles );
	}

	public function getShaderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['shader_background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['shader_background_color'];
		}
		
		return implode( ';', $styles );
	}

	public function getTextWrapperStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['info_bottom_text_align'] ) ) {
			$styles[] = 'text-align: ' . $params['info_bottom_text_align'];
		}
		
		if ( $params['info_bottom_margin'] !== '' ) {
			$styles[] = 'margin-bottom: ' . laurent_elated_filter_px( $params['info_bottom_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new LaurentElatedElementorProductList() );