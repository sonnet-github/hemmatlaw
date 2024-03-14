<?php
/**
 * Team Banner Block Template
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
    $Title = get_field('tcp_title');
    $Description = get_field('tcp_description');
    $BoxTitle = get_field('tcp_box_title');
    $Phone = get_field('tcp_phone');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__tb';
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
        <div class="tb-inner">
            <div class="tb-wrap">
                <div class="tb-img">
                    <div class="tb-masking">
                        <div class="tb-img">
                            <canvas width="1440" height="744" style="background-image: url(<?= \SDEV\Utils::getThemeResourcePath('assets/images/team-new-banner.jpg') ?>)"></canvas>
                        </div>
                    </div>
                </div>
                <div class="tb-desc-wrap">
                    <div class="tb-desc-wrap-inner">
                        <div class="tb-desc-wrap-hold">
                            <div class="tb-title">
                                <h2>Introducing Our<br> Legal Professionals</h2>
                            </div>
                            <div class="tb-desc">
                                <p>The difference in the Hemmat Law Group is our people. Meet the men and women who make the office function and the world go around. <span>Our secret is that we like each other.</span></p>
                            </div>
                            <div class="tb-btn-wrap">
                                <div class="tb-btn global-btn global-btn-green">
                                    <a href="/contact">Contact The Team </a>
                                </div>
                                <div class="tb-btn global-btn">
                                    <a href="/sign-up">Schedule a Consultation </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>