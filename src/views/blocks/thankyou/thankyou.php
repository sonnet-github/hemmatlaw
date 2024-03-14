<?php
/**
 * Thankyou Template
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */  

    // Support custom "anchor" values.
    $anchor = '';
    if ( ! empty( $block['anchor'] ) ) {
        $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
    }

    // Get acf fields value and set default
    $layout = get_field('banner_layout') ?: 'default';
    $banner = get_field('banner_image');
    $Title = get_field('tcib_title');
    $PaID = get_field('block_id');
    $Description = get_field('tcib_description');
    $phone = get_field('thanks_phone_number');
    $Image = get_field('tcib_image');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__thanks';
    if ( ! empty( $block['className'] ) ) {
        $class_name .= ' ' . $block['className'];
    }
    if ( ! empty( $block['align'] ) ) {
        $class_name .= ' align' . $block['align'];
    }

    $class_name .= ' block-layout-'.$layout;

    // Show preview image in preview mode
    if(get_field('preview_image')) :

        echo '<img src="'.\SDEV\Utils::getThemeResourcePath('src/views/blocks/').get_field('preview_image').'" style="width: 100%;" />';

    else :
?>

    <div class="block--custom-layout <?= $class_name ?>" id="<?= $PaID ?>" <?= $anchor ?>>
        <div class="thanks-inner">
            <div class="thanks-wrap">
                <div class="thanks-left">
                    <div class="thanks-left-inner">
                        <h2>Thank you!</h2>
                        <span>We'll get back to you shortly to discuss your case further.</span>
                        <div class="thanks-num"><img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/screen-phone.jpg') ?>" alt="View all" /></div>
                        <div class="thanks-btn global-btn">
                            <a href="<?= get_site_url(null, ''); ?>">Back to home page</a>
                        </div>
                    </div>
                </div>
                <div class="thanks-right">
                    <div class="thanks-right-inner">
                        <div class="thanks-masking masking">
                            <img src="/wp-content/uploads/2023/11/about-img-1.png" alt="View all" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>