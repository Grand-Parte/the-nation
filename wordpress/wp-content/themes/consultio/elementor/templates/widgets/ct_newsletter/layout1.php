<?php
$default_settings = [
    'style' => '',
    'button_color1' => '',
    'button_color2' => '',
    'color_gradient_type' => 'vertical',
    'button_label' => esc_html__('Subscribe', 'consultio'),
    'email_label' => esc_html__('Your mail address', 'consultio'),
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$html_id = ct_get_element_id($settings);
if(class_exists('Newsletter')) : 
	$newsletter = Newsletter::instance();
	?>
    <div id="<?php echo esc_attr($html_id); ?>" class="ct-newsletter ct-newsletter1 <?php echo esc_attr($style); ?> type-<?php echo esc_attr($color_gradient_type); ?>">
    	<?php if(!empty($button_color2) && $color_gradient_type == 'vertical') : ?>
	    	<div class="ct-inline-css"  data-css="
	            #<?php echo esc_attr($html_id) ?>.ct-newsletter .tnp-field-button:before {
	                background-image: -webkit-gradient(linear, left top, left bottom, from(<?php echo esc_attr($button_color1); ?>), to(<?php echo esc_attr($button_color2); ?>));
					background-image: -webkit-linear-gradient(top, <?php echo esc_attr($button_color1); ?>, <?php echo esc_attr($button_color2); ?>);
					background-image: -moz-linear-gradient(top, <?php echo esc_attr($button_color1); ?>, <?php echo esc_attr($button_color2); ?>);
					background-image: -ms-linear-gradient(top, <?php echo esc_attr($button_color1); ?>, <?php echo esc_attr($button_color2); ?>);
					background-image: -o-linear-gradient(top, <?php echo esc_attr($button_color1); ?>, <?php echo esc_attr($button_color2); ?>);
					background-image: linear-gradient(top, <?php echo esc_attr($button_color1); ?>, <?php echo esc_attr($button_color2); ?>);
					filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='<?php echo esc_attr($button_color1); ?>', endColorStr='<?php echo esc_attr($button_color2); ?>');
					background-color: transparent;
	            }">
		    </div>
	    <?php endif; ?>
	    <?php if(!empty($button_color2) && $color_gradient_type == 'horizontal') : ?>
	    	<div class="ct-inline-css"  data-css="
	            #<?php echo esc_attr($html_id) ?>.ct-newsletter .tnp-field-button:before {
	                background-image: -webkit-gradient(linear, left top, right top, from(<?php echo esc_attr($button_color1); ?>), to(<?php echo esc_attr($button_color2); ?>));
					background-image: -webkit-linear-gradient(left, <?php echo esc_attr($button_color1); ?>, <?php echo esc_attr($button_color2); ?>);
					background-image: -moz-linear-gradient(left, <?php echo esc_attr($button_color1); ?>, <?php echo esc_attr($button_color2); ?>);
					background-image: -ms-linear-gradient(left, <?php echo esc_attr($button_color1); ?>, <?php echo esc_attr($button_color2); ?>);
					background-image: -o-linear-gradient(left, <?php echo esc_attr($button_color1); ?>, <?php echo esc_attr($button_color2); ?>);
					background-image: linear-gradient(left, <?php echo esc_attr($button_color1); ?>, <?php echo esc_attr($button_color2); ?>);
					filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='<?php echo esc_attr($button_color1); ?>', endColorStr='<?php echo esc_attr($button_color2); ?>', gradientType='1');
					background-color: transparent;
	            }">
		    </div>
	    <?php endif; ?>
	    <form class="newsletter" action="<?php echo esc_url($newsletter->build_action_url('s')); ?>" method="post" onsubmit="return newsletter_check(this)">
	    	<input type="hidden" name="nr" value="widget-minimal"/>
	    	<div class="tnp-field tnp-field-email">
	    		<label><?php echo esc_attr($email_label); ?></label>
	    		<input class="tnp-email" type="email" required name="ne" value="" placeholder="<?php echo esc_attr($email_label); ?>">
	    	</div>
	    	<div class="tnp-field tnp-field-button">
	    		<input class="tnp-button" type="submit" value="<?php echo esc_attr(esc_attr($button_label)); ?>">
	    	</div>
	    </form>
    </div>
<?php endif; ?>
