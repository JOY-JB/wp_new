<button type="submit" <?php laurent_elated_inline_style($button_styles); ?> <?php laurent_elated_class_attribute($button_classes); ?> <?php echo laurent_elated_get_inline_attrs($button_data); ?> <?php echo laurent_elated_get_inline_attrs($button_custom_attrs); ?>>
    <span class="eltdf-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo laurent_elated_icon_collections()->renderIcon($icon, $icon_pack); ?>
</button>