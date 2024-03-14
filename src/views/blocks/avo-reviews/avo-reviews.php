<?php
/**
 * Avo Reviews Block Template
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
    $Logo = get_field('avvo_logo');
    $Title = get_field('avvo_title');
    $Description = get_field('avvo_description');
    $Image = get_field('avvo_image');
    $Avvocheck = get_field('avvo_check');
    $AvvoDesc = get_field('avvo_rewards_description');
    $AvvoImg = get_field('avvo_rewards_image');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__ar';
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
        <div class="ar-inner">
            <div class="ar-wrap">
                <div class="ar-top">
                    <div class="ar-log">
                        <img src="<?= $Logo['url'] ?>" alt="Logo">
                    </div>
                    <div class="ar-title">
                        <h2>
                            <?= $Title ?>
                        </h2>
                    </div>
                    <div class="ar-desc">
                        <?= $Description ?>
                    </div>
                </div>
                <div class="ar-reviews-bot">
                    <div class="ar-reviews-col ar-left">
                        <div class="ar-left-inner">
                            <div class="avvo-masking masking">
                                <img src="<?= $Image['url'] ?>" alt="View all" />
                            </div>
                        </div>
                    </div>
                    <div class="ar-reviews-col ar-right">
                        <div class="ar-right-inner">
                        <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
<div class="elfsight-app-a46e2dfa-1f8d-45a9-8900-c02434074801" data-elfsight-app-lazy></div>
                        </div>
                    </div>
                </div>
                <div class="avo-awards">
                    <div class="avo-awards-inner">
                        <div class="avo-awards-wrap">
                            <div class="avo-check"><img src="<?= $Avvocheck['url'] ?>" alt="View all" /></div>
                            <div class="avo-desc"><?= $AvvoDesc ?></div>
                            <div class="avo-award-img">
                                <img src="<?= $AvvoImg['url'] ?>" alt="View all" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>