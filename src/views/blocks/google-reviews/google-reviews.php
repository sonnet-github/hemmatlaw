<?php
/**
 * Google Reviews Block Template
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
    $BlockID = get_field('block_id');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__gr';
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

    <div class="block--custom-layout <?= $class_name ?>" id="<?= $BlockID ?>" <?= $anchor ?>>
        <div class="gr-inner">
            <div class="gr-wrap">
                <div class="gr-top">
                    <div class="gr-top-inner">
                        <div class="gr-title">
                            <h2>Google Reviews</h2>
                        </div>
                        <div class="gr-btn global-btn global-btn-white">
                            <a href="https://www.google.com/maps/place/Hemmat+Law+Group/@47.613506,-122.289632,14z/data=!3m1!5s0x54906b2708f35df5:0x8cedae2d3262a165!4m17!1m8!3m7!1s0x54906b2708f630d9:0xca297db6039c0f02!2s1421+34th+Ave,+Seattle,+WA+98122!3b1!8m2!3d47.6135063!4d-122.2896321!16s%2Fg%2F11bw3zryby!3m7!1s0x54906aa54a5ae6dd:0xa8b90825d0b89200!8m2!3d47.613489!4d-122.2895709!9m1!1b1!16s%2Fg%2F1td425t5?hl=en&entry=ttu" target="_blank">All Reviews</a>
                        </div>
                    </div>
                </div>
                <div class="gr-bot">
                    <div class="gr-rev">
                    <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
<div class="elfsight-app-81d9c8f4-4f08-4c07-9d19-7af372ab8d05" data-elfsight-app-lazy></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>