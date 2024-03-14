<?php
/**
 * Logos With Slide Block Template
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
    $Title = get_field('lws_title');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__lws';
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

    <div class="block--custom-layout <?= $class_name ?>" <?= $anchor ?>>
        <div class="lgs-inner">
            <div class="lgs-wrap">
                <div class="lgs-top-bot-wrap">
                    <div class="lgs-top">
                        <div class="lgs-title">
                            <?= $Title ?>
                        </div>
                    </div>
                    <div class="lgs-bot">
                        <?php if( get_field('lws_logo_list') ): ?>
                            <?php if( have_rows('lws_logo_list') ): ?>
                                <div class="lgs-list">
                                    <?php while( have_rows('lws_logo_list') ): the_row();
                                        $Logo = get_sub_field('lws_logo');
                                        ?>
                                        <div class="lgs-item">
                                            <img src="<?= $Logo['url'] ?>" alt="View all" />
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="lgs-arrow">
                            <div class="lgs-arrows lgs-arrow-prev">
                                <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/lgs-arrow.png') ?>" alt="View all" />
                            </div>
                            <div class="lgs-arrows lgs-arrow-next">
                                <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/lgs-arrow.png') ?>" alt="View all" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>