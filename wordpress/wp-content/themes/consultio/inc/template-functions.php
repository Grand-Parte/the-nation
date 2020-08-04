<?php
/**
 * Helper functions for the theme
 *
 * @package Consultio
 */

/**
 * Get Post List 
*/
if(!function_exists('consultio_list_post')){
    function consultio_list_post($post_type = 'post', $default = false){
        $post_list = array();
        $posts = get_posts(array('post_type' => $post_type,'posts_per_page' => '-1'));
        foreach($posts as $post){
            $post_list[$post->ID] = $post->post_title;
        }
        return $post_list;
    }
}

/**
 * Get theme option based on its id.
 *
 * @param  string $opt_id Required. the option id.
 * @param  mixed $default Optional. Default if the option is not found or not yet saved.
 *                         If not set, false will be used
 *
 * @return mixed
 */
function consultio_get_opt( $opt_id, $default = false ) {
	$opt_name = consultio_get_opt_name();
	if ( empty( $opt_name ) ) {
		return $default;
	}

	global ${$opt_name};
	if ( ! isset( ${$opt_name} ) || ! isset( ${$opt_name}[ $opt_id ] ) ) {
		$options = get_option( $opt_name );
	} else {
		$options = ${$opt_name};
	}
	if ( ! isset( $options ) || ! isset( $options[ $opt_id ] ) || $options[ $opt_id ] === '' ) {
		return $default;
	}
	if ( is_array( $options[ $opt_id ] ) && is_array( $default ) ) {
		foreach ( $options[ $opt_id ] as $key => $value ) {
			if ( isset( $default[ $key ] ) && $value === '' ) {
				$options[ $opt_id ][ $key ] = $default[ $key ];
			}
		}
	}

	return $options[ $opt_id ];
}

/**
 * Get theme option based on its id.
 *
 * @param  string $opt_id Required. the option id.
 * @param  mixed $default Optional. Default if the option is not found or not yet saved.
 *                         If not set, false will be used
 *
 * @return mixed
 */
function consultio_get_page_opt( $opt_id, $default = false ) {
	$page_opt_name = consultio_get_page_opt_name();
	if ( empty( $page_opt_name ) ) {
		return $default;
	}
	$id = get_the_ID();
	if ( ! is_archive() && is_home() ) {
		if ( ! is_front_page() ) {
			$page_for_posts = get_option( 'page_for_posts' );
			$id             = $page_for_posts;
		}
	}

	// Get page option for Shop Page
    if(class_exists('WooCommerce') && is_shop()){
        $id = get_option( 'woocommerce_shop_page_id' );
    }

	return $options = ! empty($id) ? get_post_meta( intval( $id ), $opt_id, true ) : $default;
}

/**
 *
 * Get post format values.
 *
 * @param $post_format_key
 * @param bool $default
 *
 * @return bool|mixed
 */
function consultio_get_post_format_value( $post_format_key, $default = false ) {
	global $post;

	return $value = ! empty( $post->ID ) ? get_post_meta( $post->ID, $post_format_key, true ) : $default;
}


/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function consultio_get_opt_name() {
	return apply_filters( 'consultio_opt_name', 'ct_theme_options' );
}

/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function consultio_get_page_opt_name() {
	return apply_filters( 'consultio_page_opt_name', 'ct_page_options' );
}

/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function consultio_get_post_opt_name() {
	return apply_filters( 'consultio_post_opt_name', 'consultio_post_options' );
}

/**
 * Get page title and description.
 *
 * @return array Contains 'title'
 */
function consultio_get_page_titles() {
	$title = '';

	// Default titles
	if ( ! is_archive() ) {
		// Posts page view
		if ( is_home() ) {
			// Only available if posts page is set.
			if ( ! is_front_page() && $page_for_posts = get_option( 'page_for_posts' ) ) {
				$title = get_post_meta( $page_for_posts, 'custom_title', true );
				if ( empty( $title ) ) {
					$title = get_the_title( $page_for_posts );
				}
			}
			if ( is_front_page() ) {
				$title = esc_html__( 'Blog', 'consultio' );
			}
		} // Single page view
        elseif ( is_page() ) {
			$title = get_post_meta( get_the_ID(), 'custom_title', true );
			if ( ! $title ) {
				$title = get_the_title();
			}
		} elseif ( is_404() ) {
			$title = esc_html__( '404', 'consultio' );
		} elseif ( is_search() ) {
			$title = esc_html__( 'Search results', 'consultio' );
		} else {
			$title = get_post_meta( get_the_ID(), 'custom_title', true );
			if ( ! $title ) {
				$title = get_the_title();
			}
		}
	} else {
		$title = get_the_archive_title();
		if( (class_exists( 'WooCommerce' ) && is_shop()) ) {
			$title = get_post_meta( wc_get_page_id('shop'), 'custom_title', true );
			if(!$title) {
				$title = get_the_title( get_option( 'woocommerce_shop_page_id' ) );
			}
		}
	}

	return array(
		'title' => $title,
	);
}

add_filter( 'get_the_archive_title', 'consultio_archive_title_remove_label' );
function consultio_archive_title_remove_label( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author();
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_home() ) {
		$title = single_post_title( '', false );
	}

	return $title;
}

/**
 * Generates an excerpt from the post content with custom length.
 * Default length is 55 words, same as default the_excerpt()
 *
 * The excerpt words amount will be 55 words and if the amount is greater than
 * that, then the string '&hellip;' will be appended to the excerpt. If the string
 * is less than 55 words, then the content will be returned as it is.
 *
 * @param int $length Optional. Custom excerpt length, default to 55.
 * @param int|WP_Post $post Optional. You will need to provide post id or post object if used outside loops.
 *
 * @return string           The excerpt with custom length.
 */
function consultio_get_the_excerpt( $length = 55, $post = null ) {
	$post = get_post( $post );

	if ( empty( $post ) || 0 >= $length ) {
		return '';
	}

	if ( post_password_required( $post ) ) {
		return esc_html__( 'Post password required.', 'consultio' );
	}

	$content = apply_filters( 'the_content', strip_shortcodes( $post->post_content ) );
	$content = str_replace( ']]>', ']]&gt;', $content );

	$excerpt_more = apply_filters( 'consultio_excerpt_more', '&hellip;' );
	$excerpt      = wp_trim_words( $content, $length, $excerpt_more );

	return $excerpt;
}


/**
 * Check if provided color string is valid color.
 * Only supports 'transparent', HEX, RGB, RGBA.
 *
 * @param  string $color
 *
 * @return boolean
 */
function consultio_is_valid_color( $color ) {
	$color = preg_replace( "/\s+/m", '', $color );

	if ( $color === 'transparent' ) {
		return true;
	}

	if ( '' == $color ) {
		return false;
	}

	// Hex format
	if ( preg_match( "/(?:^#[a-fA-F0-9]{6}$)|(?:^#[a-fA-F0-9]{3}$)/", $color ) ) {
		return true;
	}

	// rgb or rgba format
	if ( preg_match( "/(?:^rgba\(\d+\,\d+\,\d+\,(?:\d*(?:\.\d+)?)\)$)|(?:^rgb\(\d+\,\d+\,\d+\)$)/", $color ) ) {
		preg_match_all( "/\d+\.*\d*/", $color, $matches );
		if ( empty( $matches ) || empty( $matches[0] ) ) {
			return false;
		}

		$red   = empty( $matches[0][0] ) ? $matches[0][0] : 0;
		$green = empty( $matches[0][1] ) ? $matches[0][1] : 0;
		$blue  = empty( $matches[0][2] ) ? $matches[0][2] : 0;
		$alpha = empty( $matches[0][3] ) ? $matches[0][3] : 1;

		if ( $red < 0 || $red > 255 || $green < 0 || $green > 255 || $blue < 0 || $blue > 255 || $alpha < 0 || $alpha > 1.0 ) {
			return false;
		}
	} else {
		return false;
	}

	return true;
}

/**
 * Minify css
 *
 * @param  string $css
 *
 * @return string
 */
function consultio_css_minifier( $css ) {
	// Normalize whitespace
	$css = preg_replace( '/\s+/', ' ', $css );
	// Remove spaces before and after comment
	$css = preg_replace( '/(\s+)(\/\*(.*?)\*\/)(\s+)/', '$2', $css );
	// Remove comment blocks, everything between /* and */, unless
	// preserved with /*! ... */ or /** ... */
	$css = preg_replace( '~/\*(?![\!|\*])(.*?)\*/~', '', $css );
	// Remove ; before }
	$css = preg_replace( '/;(?=\s*})/', '', $css );
	// Remove space after , : ; { } */ >
	$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );
	// Remove space before , ; { } ( ) >
	$css = preg_replace( '/ (,|;|\{|}|\(|\)|>)/', '$1', $css );
	// Strips leading 0 on decimal values (converts 0.5px into .5px)
	$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
	// Strips units if value is 0 (converts 0px to 0)
	$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );
	// Converts all zeros value into short-hand
	$css = preg_replace( '/0 0 0 0/', '0', $css );
	// Shortern 6-character hex color codes to 3-character where possible
	$css = preg_replace( '/#([a-f0-9])\\1([a-f0-9])\\2([a-f0-9])\\3/i', '#\1\2\3', $css );

	return trim( $css );
}

/**
 * Header Tracking Code to wp_head hook.
 */
function consultio_header_code() {
	$site_header_code = consultio_get_opt( 'site_header_code' );
	if ( $site_header_code !== '' ) {
		print wp_kses( $site_header_code, wp_kses_allowed_html() );
	}
}

add_action( 'wp_head', 'consultio_header_code' );

/**
 * Footer Tracking Code to wp_footer hook.
 */
function consultio_footer_code() {
	$site_footer_code = consultio_get_opt( 'site_footer_code' );
	if ( $site_footer_code !== '' ) {
		print wp_kses( $site_footer_code, wp_kses_allowed_html() );
	}
}

add_action( 'wp_footer', 'consultio_footer_code' );

/**
 * Custom Comment List
 */
function consultio_comment_list( $comment, $args, $depth ) {
	if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
	?>
    <<?php echo ''.$tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		    <div class="comment-inner">
		        <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, 90); ?>
		        <div class="comment-content">
		            <h4 class="comment-title">
		            	<?php printf( '%s', get_comment_author_link() ); ?>
		            </h4>
		            <div class="comment-meta">
		            	<span class="comment-date">
	                        <?php echo get_comment_date().' - '.get_comment_time(); ?>
	                    </span>
		            </div>
		            <div class="comment-text"><?php comment_text(); ?></div>
		            <div class="comment-reply">
						<?php comment_reply_link( array_merge( $args, array(
							'add_below' => $add_below,
							'depth'     => $depth,
							'max_depth' => $args['max_depth']
						) ) ); ?>
		            </div>
		        </div>
		    </div>
		<?php if ( 'div' != $args['style'] ) : ?>
        </div>
	<?php endif;
}

function consultio_comment_reply_text( $link ) {
$link = str_replace( 'Reply', '<span>'.esc_attr__('Reply', 'consultio').'</span>', $link );
return $link;
}
add_filter( 'comment_reply_link', 'consultio_comment_reply_text' );

/**
 * Add field subtitle to post.
 */
function consultio_add_subtitle_field() {
	global $post;

	$screen = get_current_screen();

	if ( in_array( $screen->id, array( 'acm-post' ) ) ) {

		$value = get_post_meta( $post->ID, 'post_subtitle', true );

		echo '<div class="subtitle"><input type="text" name="post_subtitle" value="' . esc_attr( $value ) . '" id="subtitle" placeholder = "' . esc_attr__( 'Subtitle', 'consultio' ) . '" style="width: 100%;margin-top: 4px;"></div>';
	}
}

add_action( 'edit_form_after_title', 'consultio_add_subtitle_field' );

/**
 * Save custom theme meta
 */
function consultio_save_meta_boxes( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['post_subtitle'] ) ) {
		update_post_meta( $post_id, 'post_subtitle', $_POST['post_subtitle'] );
	}
}

add_action( 'save_post', 'consultio_save_meta_boxes' );


add_filter( 'ct_extra_post_types', 'consultio_add_posttype' );
function consultio_add_posttype( $postypes ) {
	$portfolio_slug = consultio_get_opt( 'portfolio_slug', 'portfolio' );
	$portfolio_name = consultio_get_opt( 'portfolio_name', esc_attr__('Portfolio', 'consultio') );
	$postypes['portfolio'] = array(
		'status' => true,
		'item_name'  => $portfolio_name,
		'items_name' => $portfolio_name,
		'args'       => array(
			'rewrite'             => array(
                'slug'       => $portfolio_slug,
 		 	),
		),
	);

	$service_slug = consultio_get_opt( 'service_slug', 'service' );
	$service_name = consultio_get_opt( 'service_name', esc_attr__('Services', 'consultio') );
	$postypes['service'] = array(
		'status'     => true,
		'item_name'  => $service_name,
		'items_name' => $service_name,
		'args'       => array(
			'menu_icon'          => 'dashicons-hammer',
			'supports'           => array(
				'title',
				'thumbnail',
				'editor',
			),
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'             => array(
                'slug'       => $service_slug
 		 	),
		),
		'labels'     => array()
	);

	$case_study_slug = consultio_get_opt( 'case_study_slug', 'case-study' );
	$case_study_name = consultio_get_opt( 'case_study_name', esc_attr__( 'Case Studies', 'consultio' ) );
	$postypes['case-study'] = array(
		'status'     => true,
		'item_name'  => $case_study_name,
		'items_name' => $case_study_name,
		'args'       => array(
			'menu_icon'          => 'dashicons-shield-alt',
			'supports'           => array(
				'title',
				'thumbnail',
				'editor',
			),
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'             => array(
                'slug'       => $case_study_slug
 		 	),
		),
		'labels'     => array()
	);

	$postypes['footer'] = array(
		'status'     => true,
		'item_name'  => esc_html__( 'Footers', 'consultio' ),
		'items_name' => esc_html__( 'Footers', 'consultio' ),
		'args'       => array(
			'menu_icon'          => 'dashicons-editor-insertmore',
			'supports'           => array(
				'title',
				'editor',
			),
			'public'             => true,
			'publicly_queryable' => true,
		),
		'labels'     => array()
	);

	return $postypes;
}

add_filter( 'ct_extra_taxonomies', 'consultio_add_tax' );
function consultio_add_tax( $taxonomies ) {

	$taxonomies['service-category'] = array(
		'status'     => true,
		'post_type'  => array( 'service' ),
		'taxonomy' => esc_attr__( 'Service Category', 'consultio' ),
		'taxconsultiomy'   => esc_attr__( 'Service Category', 'consultio' ),
		'taxonomies' => esc_attr__( 'Service Categories', 'consultio' ),
		'args'       => array(),
		'labels'     => array()
	);

	$taxonomies['case-study-category'] = array(
		'status'     => true,
		'post_type'  => array( 'case-study' ),
		'taxonomy' => esc_attr__( 'Case Study Category', 'consultio' ),
		'taxconsultiomy'   => esc_attr__( 'Case Study Category', 'consultio' ),
		'taxonomies' => esc_attr__( 'Case Studies Categories', 'consultio' ),
		'args'       => array(),
		'labels'     => array()
	);
	
	return $taxonomies;
}

add_filter( 'ct_enable_megamenu', 'consultio_enable_megamenu' );
function consultio_enable_megamenu() {
	return true;
}
add_filter( 'ct_enable_onepage', 'consultio_enable_onepage' );
function consultio_enable_onepage() {
	return false;
}

/* Add default pagram Carousel */
function consultio_get_param_carousel( $atts ) {
	$default  = array(
		'col_xs'           => '1',
		'col_sm'           => '2',
		'col_md'           => '3',
		'col_lg'           => '4',
		'col_xl'           => '4',
		'col_xxl'           => '4',
		'margin'           => '30',
		'loop'             => 'false',
		'autoplay'         => 'false',
		'autoplay_timeout' => '5000',
		'smart_speed'      => '250',
		'center'           => 'false',
		'stage_padding'    => '0',
		'arrows'           => 'false',
		'bullets'          => 'false',
	);
	$new_data = array_merge( $default, $atts );
	extract( $new_data );
	$carousel      = array(
		'data-item-xs' => $col_xs,
		'data-item-sm' => $col_sm,
		'data-item-md' => $col_md,
		'data-item-lg' => $col_lg,
		'data-item-xl' => $col_xl,
		'data-item-xxl' => $col_xxl,

		'data-margin'          => $margin,
		'data-loop'            => $loop,
		'data-autoplay'        => $autoplay,
		'data-autoplaytimeout' => $autoplay_timeout,
		'data-smartspeed'      => $smart_speed,
		'data-center'          => $center,
		'data-arrows'          => $arrows,
		'data-bullets'         => $bullets,
		'data-stagepadding'    => $stage_padding,
		'data-rtl'             => is_rtl() ? 'true' : 'false',
	);
	$carousel_data = '';
	foreach ( $carousel as $key => $value ) {
		if ( isset( $value ) ) {
			$carousel_data .= $key . '=' . $value . ' ';
		}
	}
	$new_data['carousel_data'] = $carousel_data;

	return $new_data;
}

/* Show/hide CMS Carousel */
add_filter( 'enable_ct_carousel', 'consultio_enable_ct_carousel' );
function consultio_enable_ct_carousel() {
	return false;
}

/*
 * Set post views count using post meta
 */
function consultio_set_post_views( $postID ) {
	$countKey = 'post_views_count';
	$count    = get_post_meta( $postID, $countKey, true );
	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $postID, $countKey );
		add_post_meta( $postID, $countKey, '0' );
	} else {
		$count ++;
		update_post_meta( $postID, $countKey, $count );
	}
}

/* Create Demo Data */
add_filter('ct_ie_export_mode', 'consultio_enable_export_mode');
function consultio_enable_export_mode()
{
    return false;
}
/* Dashboard Theme */
add_filter('ct_documentation_link',function(){
    return 'http://casethemes.net/docs/consultio/';
});
add_filter('ct_video_tutorial_link',function(){
    return 'https://www.youtube.com/watch?v=bGQAq9p2QGo';
});

add_action( 'elementor/editor/before_enqueue_scripts', function() {
    wp_enqueue_style( 'consultio-elementor-custom-editor', get_template_directory_uri() . '/assets/css/elementor-custom-editor.css', array(), '1.0.0' );
} );

if(class_exists("Case_Theme_Core")){
	if(!function_exists("consultio_add_icons_to_ct_iconpicker_field")){
		add_filter("redux_ct_iconpicker_field/get_icons", "consultio_add_icons_to_ct_iconpicker_field");
		function consultio_add_icons_to_ct_iconpicker_field($icons){
			$custom_icons = [
				'Flaticon' => array(
                    array('flaticon-skill' => 'flaticon-skill'),
                    array('flaticon-setting-spanner' => 'flaticon-setting-spanner'),
                    array('flaticon-bar-graph' => 'flaticon-bar-graph'),
                    array('flaticon-target' => 'flaticon-target'),
                    array('flaticon-gear' => 'flaticon-gear'),
                    array('flaticon-telephone' => 'flaticon-telephone'),
                    array('flaticon-map' => 'flaticon-map'),
                    array('flaticon-add-location-point' => 'flaticon-add-location-point'),
                    array('flaticon-puzzle' => 'flaticon-puzzle'),
                    array('flaticon-diagram' => 'flaticon-diagram'),
                    array('flaticon-stats' => 'flaticon-stats'),
                    array('flaticon-presentation' => 'flaticon-presentation'),
                    array('flaticon-chart' => 'flaticon-chart'),
                    array('flaticon-award-symbol' => 'flaticon-award-symbol'),
                    array('flaticon-strategy' => 'flaticon-strategy'),
                    array('flaticon-group' => 'flaticon-group'),
                    array('flaticon-leadership' => 'flaticon-leadership'),
                    array('flaticon-growth' => 'flaticon-growth'),
                    array('flaticon-report' => 'flaticon-report'),
                    array('flaticon-marketing-strategy' => 'flaticon-marketing-strategy'),
                    array('flaticon-menu' => 'flaticon-menu'),
                    array('flaticon-product' => 'flaticon-product'),
                    array('flaticon-bank' => 'flaticon-bank'),
                    array('flaticon-graph' => 'flaticon-graph'),
                    array('flaticon-pie-chart' => 'flaticon-pie-chart'),
                    array('flaticon-internet' => 'flaticon-internet'),
                    array('flaticon-earnings' => 'flaticon-earnings'),
                    array('flaticon-award' => 'flaticon-award'),
                    array('flaticon-social-media' => 'flaticon-social-media'),
                    array('flaticon-target-1' => 'flaticon-target-1'),
                    array('flaticon-bank-building' => 'flaticon-bank-building'),
                    array('flaticon-handshake' => 'flaticon-handshake'),
                    array('flaticon-presentation-board-with-graph' => 'flaticon-presentation-board-with-graph'),
                    array('flaticon-increased-revenue' => 'flaticon-increased-revenue'),
                    array('flaticon-teamwork' => 'flaticon-teamwork'),
                    array('flaticon-tools' => 'flaticon-tools'),
                    array('flaticon-target-2' => 'flaticon-target-2'),
                    array('flaticon-male-job-search-symbol' => 'flaticon-male-job-search-symbol'),
                    array('flaticon-credit-card' => 'flaticon-credit-card'),
                    array('flaticon-placeholder' => 'flaticon-placeholder'),
                    array('flaticon-phone-call' => 'flaticon-phone-call'),
                    array('flaticon-black-back-closed-envelope-shape' => 'flaticon-black-back-closed-envelope-shape'),
                    array('flaticon-scales-of-justice' => 'flaticon-scales-of-justice'),
                    array('flaticon-auction' => 'flaticon-auction'),
                    array('flaticon-court' => 'flaticon-court'),
                    array('flaticon-mace' => 'flaticon-mace'),
                    array('flaticon-light-bulb' => 'flaticon-light-bulb'),
                    array('flaticon-shield' => 'flaticon-shield'),
                    array('flaticon-dollar-symbol' => 'flaticon-dollar-symbol'),
                    array('flaticon-chart-1' => 'flaticon-chart-1'),
                    array('flaticon-eye' => 'flaticon-eye'),
                    array('flaticon-cloud' => 'flaticon-cloud'),
                    array('flaticon-graph-1' => 'flaticon-graph-1'),
                    array('flaticon-document' => 'flaticon-document'),
                ),

				'Flaticon Version 2' => array(
                    array('flaticonv2-aeroplane' => 'flaticonv2-aeroplane'),
                    array('flaticonv2-id-card' => 'flaticonv2-id-card'),
                    array('flaticonv2-shield' => 'flaticonv2-shield'),
                    array('flaticonv2-earning-money-idea' => 'flaticonv2-earning-money-idea'),
                    array('flaticonv2-list' => 'flaticonv2-list'),
                    array('flaticonv2-menu' => 'flaticonv2-menu'),
                    array('flaticonv2-banknote' => 'flaticonv2-banknote'),
                    array('flaticonv2-creative' => 'flaticonv2-creative'),
                    array('flaticonv2-network' => 'flaticonv2-network'),
                    array('flaticonv2-speech-bubble' => 'flaticonv2-speech-bubble'),
                    array('flaticonv2-layers' => 'flaticonv2-layers'),
                    array('flaticonv2-gear' => 'flaticonv2-gear'),
                    array('flaticonv2-computer' => 'flaticonv2-computer'),
                    array('flaticonv2-objective' => 'flaticonv2-objective'),
                    array('flaticonv2-right-arrow' => 'flatiflaticonv2-right-arrowcon'),
                    array('flaticonv2-long-arrow-pointing-to-the-right' => 'flaticonv2-long-arrow-pointing-to-the-right'),
                    array('flaticonv2-edit' => 'flaticonv2-edit'),
                    array('flaticonv2-responsive' => 'flaticonv2-responsive'),
                    array('flaticonv2-speed' => 'flaticonv2-speed'),
                    array('flaticonv2-happiness' => 'flaticonv2-happiness'),
                    array('flaticonv2-play-button' => 'flaticonv2-play-button'),
                    array('flaticonv2-pin' => 'flaticonv2-pin'),
                    array('flaticonv2-thin-arrowheads-pointing-down' => 'flaticonv2-thin-arrowheads-pointing-down'),
                    array('flaticonv2-multiply' => 'flaticonv2-multiply'),
                    array('flaticonv2-right-quotation-mark' => 'flaticonv2-right-quotation-mark'),
                ),
			];
			$icons = array_merge($custom_icons, $icons);
			return $icons;
		}
	}
}

if(!function_exists('consultio_get_image_by_size')){
    function consultio_get_image_by_size( $params = array() ) {
    	$lazy_image = consultio_get_opt( 'lazy_image', false);
    	$lazy_class = '';
    	if($lazy_image == true) {
    		$lazy_class = 'ct-lazy';
    	}
        $params = array_merge( array(
            'post_id' => null,
            'attach_id' => null,
            'thumb_size' => 'thumbnail',
            'class' => $lazy_class,
        ), $params );

        if ( ! $params['thumb_size'] ) {
            $params['thumb_size'] = 'thumbnail';
        }

        if ( ! $params['attach_id'] && ! $params['post_id'] ) {
            return false;
        }

        $post_id = $params['post_id'];

        $attach_id = $post_id ? get_post_thumbnail_id( $post_id ) : $params['attach_id'];
        $attach_id = apply_filters( 'vc_object_id', $attach_id );
        $thumb_size = $params['thumb_size'];
        $thumb_class = ( isset( $params['class'] ) && '' !== $params['class'] ) ? $params['class'] . ' ' : '';

        global $_wp_additional_image_sizes;
        $thumbnail = '';

        $sizes = array(
            'thumbnail',
            'thumb',
            'medium',
            'large',
            'full',
        );
        if ( is_string( $thumb_size ) && ( ( ! empty( $_wp_additional_image_sizes[ $thumb_size ] ) && is_array( $_wp_additional_image_sizes[ $thumb_size ] ) ) || in_array( $thumb_size, $sizes, true ) ) ) {
            $attributes = array( 'class' => $thumb_class . 'attachment-' . $thumb_size );
            $thumbnail = wp_get_attachment_image( $attach_id, $thumb_size, false, $attributes );
        } elseif ( $attach_id ) {
            if ( is_string( $thumb_size ) ) {
                preg_match_all( '/\d+/', $thumb_size, $thumb_matches );
                if ( isset( $thumb_matches[0] ) ) {
                    $thumb_size = array();
                    $count = count( $thumb_matches[0] );
                    if ( $count > 1 ) {
                        $thumb_size[] = $thumb_matches[0][0]; // width
                        $thumb_size[] = $thumb_matches[0][1]; // height
                    } elseif ( 1 === $count ) {
                        $thumb_size[] = $thumb_matches[0][0]; // width
                        $thumb_size[] = $thumb_matches[0][0]; // height
                    } else {
                        $thumb_size = false;
                    }
                }
            }
            if ( is_array( $thumb_size ) ) {
                // Resize image to custom size
                $p_img = ct_resize( $attach_id, null, $thumb_size[0], $thumb_size[1], true );
                $alt = trim( wp_strip_all_tags( get_post_meta( $attach_id, '_wp_attachment_image_alt', true ) ) );
                $attachment = get_post( $attach_id );
                if ( ! empty( $attachment ) ) {
                    $title = trim( wp_strip_all_tags( $attachment->post_title ) );

                    if ( empty( $alt ) ) {
                        $alt = trim( wp_strip_all_tags( $attachment->post_excerpt ) ); // If not, Use the Caption
                    }
                    if ( empty( $alt ) ) {
                        $alt = $title;
                    }
                    if ( $p_img ) {

                    	$lazy_src = 'src';
                    	if($lazy_image == true) {
                    		$lazy_src = 'data-src';
                    	}

                        $attributes = ct_stringify_attributes( array(
                            'class' => $thumb_class,
                            $lazy_src => $p_img['url'],
                            'width' => $p_img['width'],
                            'height' => $p_img['height'],
                            'alt' => $alt,
                            'title' => $title,
                        ) );

                        $thumbnail = '<img ' . $attributes . ' />';
                    }
                }
            }
        }

        $p_img_large = wp_get_attachment_image_src( $attach_id, 'large' );

        return apply_filters( 'vc_wpb_getimagesize', array(
            'thumbnail' => $thumbnail,
            'p_img_large' => $p_img_large,
        ), $attach_id, $params );
    }
}