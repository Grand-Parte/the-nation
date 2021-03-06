<?php
$default_settings = [
    'content_list' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$html_id = ct_get_element_id($settings);
?>
<?php if(isset($content_list) && !empty($content_list) && count($content_list)): ?>
	<div class="ct-particle-animate">
		<?php foreach ($content_list as $key => $value): 
			$particle  = consultio_get_image_by_size( array(
                'attach_id'  => $value['particle']['id'],
                'thumb_size' => 'full',
            ) );
            $particle_tb    = $particle['thumbnail'];
            $parallax_speed = '6';
            $parallax_move = '60';
            if($value['particle_animate'] == 'shape-parallax') {
			    wp_enqueue_script('el-parallax', get_template_directory_uri() . '/assets/js/el-parallax.js', array('jquery'), 'all', true);
			}
			?>
		    <div id="<?php echo esc_attr($html_id.$key); ?>" class="<?php echo esc_attr($value['particle_animate']); ?>" <?php if($value['particle_animate'] == 'shape-parallax') { ?>data-speed="<?php echo esc_attr($parallax_speed); ?>" data-move="<?php echo esc_attr($parallax_move); ?>"<?php } ?>>
		    	<div class="ct-inline-css"  data-css="
		            .ct-particle-animate #<?php echo esc_attr($html_id.$key) ?> {
		                left: <?php echo esc_attr($value['left_positioon']['size']); ?>%;
		                top: <?php echo esc_attr($value['top_positioon']['size']); ?>%;
		            }">
		        </div>
		    	<?php echo wp_kses_post($particle_tb); ?>		
		    </div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
