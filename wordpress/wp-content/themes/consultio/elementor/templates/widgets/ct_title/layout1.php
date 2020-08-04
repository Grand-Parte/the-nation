<?php
$default_settings = [
    'title' => '',
    'style' => 'style1',
];
$settings = array_merge($default_settings, $settings);
extract($settings); ?>
<div class="ct-title1 <?php echo esc_attr($style); ?>">
    <h3>
        <span><?php echo esc_attr($title); ?></span>
        <i></i>
    </h3>
</div>