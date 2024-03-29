<?php
$tags = wp_get_post_terms(get_the_ID(), 'portfolio-tag');
$tag_names = array();

if(is_array($tags) && count($tags)) : ?>
    <div class="eltdf-ps-info-item eltdf-ps-tags">
	    <?php laurent_core_get_cpt_single_module_template_part('templates/single/parts/info-title', 'portfolio', '', array( 'title' => esc_attr__('Tags:', 'laurent-core') ) ); ?>
        <?php
        $i = 0;
        foreach($tags as $tag) { ?>
            <a itemprop="url" class="eltdf-ps-info-tag" href="<?php echo esc_url(get_term_link($tag->term_id)); ?>"><?php echo esc_html($tag->name); ?></a><?php
            $i++;

            if($i !== count($tags)) {
                echo ', ';
            } ?>
        <?php } ?>
    </div>
<?php endif; ?>