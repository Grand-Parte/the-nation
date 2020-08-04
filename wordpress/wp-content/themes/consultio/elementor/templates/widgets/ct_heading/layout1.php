<?php
$default_settings = [
    'title' => '',
    'title_tag' => 'h3',
    'style' => 'st-default',
    'sub_title' => '',
    'sub_title_line' => 'show',
    'sub_title_style' => 'style1',
    'content_alignment_section' => 'left',
    'text_align' => '',
    'ct_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings); ?>
<div class="ct-heading h-align-<?php echo esc_attr($text_align); ?> <?php echo esc_attr($ct_animate); ?> sub-<?php echo esc_attr($sub_title_style); ?> ct-heading-<?php echo esc_attr($content_alignment_section); ?> item-<?php echo esc_attr($style); ?>">
	<?php if(!empty($sub_title)) : ?>
		<div class="item--sub-title <?php echo esc_attr($sub_title_style); ?> <?php echo esc_attr($sub_title_line); ?>-line"><?php echo esc_attr($sub_title); ?></div>
	<?php endif; ?>
    <<?php echo esc_attr($title_tag); ?> class="item--title <?php echo esc_attr($style); ?>">
        <?php if($style == 'st-line-top1' || $style == 'st-line-top2') : ?>
            <div class="ct-heading-divider"><span></span></div>
        <?php endif; ?>
        <span>
            <?php if($style == 'st-line-left1' || $style == 'st-line-right1' || $style == 'st-line-left2') : ?>
                <i></i>
            <?php endif; ?>
            <?php echo wp_kses_post($title); ?>
            <?php if($style == 'st-line-left3') : ?>
                <i class="dot-shape">
                    <i></i>
                    <i></i>
                    <i></i>
                    <i></i>
                    <i></i>
                    <i></i>
                </i>
            <?php endif; ?>
        </span>
        <?php if($style == 'st-line-bottom1') : ?>
            <div class="ct-heading-divider"><span></span></div>
        <?php endif; ?>
    </<?php echo esc_attr($title_tag); ?>>
</div>