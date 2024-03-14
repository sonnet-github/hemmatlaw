<?php 
/* Template Name: 404 Template
 * Template Post Type: post, page
 */
/**
 * 404 Default template
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */
    get_header(); ?>

        <div id="page-content" class="page-blocks" data-tpl="404">

        <div class="error-desc">
                 <h1 class="global-title">Oops - Page Not Found</h1>
                <span>The page you are looking for is under construction.</span>
                <div class="error-btn global-btn secondary-btn">
                    <a href="<?= get_site_url(null, ''); ?>">Home</a>
                </div>
            </div>

        </div>
        </div>

    <?php get_footer(); ?>