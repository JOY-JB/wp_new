<div class="eltdf-portfolio-vertical-loop-holder" <?php echo wp_kses($holder_data, array('data')); ?>>
    <div class="eltdf-pvl-inner clearfix">
        <?php if(!empty($id)): ?>
            <div class="eltdf-pvl-navigation-holder" <?php echo wp_kses($holder_data, array('data')); ?>>
                <?php echo laurent_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/navigation', 'standard', $params, $additional_params); ?>
            </div>
            <?php echo laurent_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'portfolio-vertical-loop-item', '', $params, $additional_params); ?>
        <?php else:
            if($query_results->have_posts()):
                while ( $query_results->have_posts() ) : $query_results->the_post();
                    $holder_data .= " data-id=" . get_the_ID() . " ";
                    $next_item_same_category = get_next_post(true, '', 'portfolio-category');
                    $next_item = get_next_post(false, '');

                    if($category !== '' && $category!== null) {
                        $next_item_id = $next_item_same_category->ID;
                    } else {
                        $next_item_id = $next_item->ID;
                    }

                    $holder_data .= " data-next-item-id=" . $next_item_id;
                    ?>
                    <div class="eltdf-pvl-navigation-holder" <?php echo wp_kses($holder_data, array('data')); ?>>
                        <?php echo laurent_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/navigation', 'standard', $params, $additional_params); ?>
                    </div>
                    <?php echo laurent_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'portfolio-vertical-loop-item', '', $params, $additional_params); ?>
                <?php endwhile;
            else:
                echo laurent_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/posts-not-found');
            endif;
            wp_reset_postdata();
        endif; ?>
    </div>
</div>