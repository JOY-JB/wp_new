<?php

class LaurentTwitterFeedElementorTwitterList extends \Elementor\Widget_Base {

    public function get_name() {
        return 'eltdf_twitter_list';
    }

    public function get_title() {
        return esc_html__( 'Twitter List', 'laurent-twitter-feed' );
    }

    public function get_icon() {
        return 'laurent-elementor-custom-icon laurent-elementor-twitter-list';
    }

    public function get_categories() {
        return [ 'elated' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'laurent-twitter-feed' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
			'user_id',
			[
				'label'       => esc_html__( 'User ID', 'laurent-twitter-feed' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);

        $this->add_control(
            'number_of_columns',
            [
                'label'       => esc_html__( 'Number of Columns', 'laurent-twitter-feed' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => laurent_elated_get_number_of_columns_array( false, array( 'one' ) ),
                'default'     => 'four'
            ]
        );

        $this->add_control(
            'space_between_columns',
            [
                'label'   => esc_html__( 'Space Between Items', 'laurent-twitter-feed' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => laurent_elated_get_space_between_items_array(),
                'default' => 'normal'
            ]
        );

        $this->add_control(
            'number_of_tweets',
            [
                'label'       => esc_html__( 'Number of Tweets', 'laurent-twitter-feed' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
            ]
        );

		$this->add_control(
			'transient_time',
			[
				'label'       => esc_html__( 'Images Cache Time', 'laurent-twitter-feed' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => ''
			]
		);

        $this->end_controls_section();
    }

    public function render() {

		$params = $this->get_settings_for_display();

		$params['holder_classes'] = $this->getHolderClasses( $params );

		$twitter_api           = new \LaurentTwitterApi();
		$params['twitter_api'] = $twitter_api;

		if ( $twitter_api->hasUserConnected() ) {
			$response = $twitter_api->fetchTweets( $params['user_id'], $params['number_of_tweets'], array(
				'transient_time' => $params['transient_time'],
				'transient_id'   => 'eltdf_twitter_' . rand( 0, 1000 )
			) );

			$params['response'] = $response;
		}

		//Get HTML from template based on type of team
		echo laurent_twitter_get_shortcode_module_template_part( 'holder', 'twitter-list', '', $params );
    }

	public function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = 'eltdf-' . $params['number_of_columns'] . '-columns';
		$holderClasses[] = 'eltdf-' . $params['space_between_columns'] . '-space';

		return implode( ' ', $holderClasses );
	}

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new LaurentTwitterFeedElementorTwitterList() );