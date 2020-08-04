<?php
$default_settings = [
    'menu_item' => '',
    'ct_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
?>
<?php if(isset($menu_item) && !empty($menu_item) && count($menu_item)): ?>
    <ul class="ct-menu-item <?php echo esc_attr($ct_animate); ?>">
        <?php
        	foreach ($menu_item as $key => $item):
                $link_key = $widget->get_repeater_setting_key( 'title', 'value', $key );
                if ( ! empty( $item['link']['url'] ) ) {
                    $widget->add_render_attribute( $link_key, 'href', $item['link']['url'] );

                    if ( $item['link']['is_external'] ) {
                        $widget->add_render_attribute( $link_key, 'target', '_blank' );
                    }

                    if ( $item['link']['nofollow'] ) {
                        $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                    }
                }
                $link_attributes = $widget->get_render_attribute_string( $link_key );
                ?>
                <li><a <?php echo implode( ' ', [ $link_attributes ] ); ?>><?php echo ct_print_html($item['text']); ?></a></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>