<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Consultio
 */
$content_404_page = consultio_get_opt( 'content_404_page' );
$btn_text_404_page = consultio_get_opt( 'btn_text_404_page' );
get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="row">
                <div class="col-12">
                    <section class="error-404">
                        <div class="error-404-content">
                            <div class="error-404-holder">
                                <h3 class="error-404-title"><?php echo esc_html__('Error 404', 'consultio'); ?></h3>
                                <div class="error-404-sub">
                                    <span><?php echo esc_html__('Page not found', 'consultio'); ?></span>
                                </div>
                                <a class="btn" href="<?php echo esc_url(home_url('/')); ?>">
                                    <i class="fac fac-cog space-right"></i>
                                    <?php echo esc_html__('Go Home now', 'consultio'); ?>   
                                </a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
