<?php 
/**
 * ACF Blocks Registry
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */
    function register_layout_category( $categories ) {
        
        array_unshift($categories, [
            'slug'  => 'custom-layout',
            'title' => 'Custom Layout'
        ]);

        return $categories;
    }

    if ( version_compare( get_bloginfo( 'version' ), '5.8', '>=' ) ) {
        add_filter( 'block_categories_all', 'register_layout_category' );
    } else {
        add_filter( 'block_categories', 'register_layout_category' );
    }

    add_action( 'init', 'register_acf_blocks' );
    function register_acf_blocks() {

        // Add your ACF Blocks here
        $acf_blocks = [
            'full-width-banner',
            'wysiwyg',
            'hero',
            'google-reviews',
            'two-columns-image-boxes',
            'two-columns-with-image',
            'avo-reviews',
            'two-columns-image-with-two-buttons',
            'two-columns-image-with-one-button',
            'three-columns-logo',
            'two-columns-with-phone',
            'two-columns-boxes',
            'blogs',
            'logos',
            'logos-with-slide',
            'two-columns-text-image-with-form',
            'team-banner',
            'our-team',
            'attorney-testimonials',
            'how-it-works',
            'two-columns-image-finance',
            'apply-panel',
            'faq',
            'leadership',
            'compensation-benefits',
            'current-openings',
            'two-columns-with-sidebar',
            'get-in-touch',
            'newsroom',
            'newsroom-result',
            'job-description',
            'thankyou',
            'privacy-policy-terms',
            'git-banner'
        ];

        foreach($acf_blocks as $block){
            register_block_type( __DIR__ . '/' . $block );
        }
        
    }