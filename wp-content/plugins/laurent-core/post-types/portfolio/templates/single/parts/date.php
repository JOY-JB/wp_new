<?php if(laurent_elated_options()->getOptionValue('portfolio_single_hide_date') === 'yes') : ?>
    <div class="eltdf-ps-info-item eltdf-ps-date">
	    <?php laurent_core_get_cpt_single_module_template_part('templates/single/parts/info-title', 'portfolio', '', array( 'title' => esc_attr__('Date:', 'laurent-core') ) ); ?>
        <p itemprop="dateCreated" class="eltdf-ps-info-date entry-date updated"><?php the_time(get_option('date_format')); ?></p>
        <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(laurent_elated_get_page_id()); ?>"/>
    </div>
<?php endif; ?>