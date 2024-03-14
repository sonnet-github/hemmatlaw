<?php
/**
 * Two Columns With Two Buttons Block Template
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
    $Title = get_field('tctb_title');
    $Description = get_field('tctb_description');
    $ButtonOne = get_field('tctb_one_button');
    $ButtonTwo = get_field('tctb_two_button');
    $Image = get_field('tctb_image');
    $BlockID = get_field('block_id');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__tctb';
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
        <div class="tctb-inner">
            <div class="tctb-wrap">
                <div class="tctb-col tctb-left">
                    <div class="tctb-left-inner">
                        <div class="tctb-title">
                            <h2><?= $Title ?></h2>
                        </div>
                        <div class="tctb-desc">
                            <?= $Description ?>
                        </div>
                        <div class="tctb-buttons">
                            <div class="tctb-btn-item global-btn">
                                <a href="<?= $ButtonOne['url'] ?>" target="_blank"><?= $ButtonOne['title'] ?></a>
                            </div>
                            <div class="tctb-btn-item global-btn global-btn-white global-btn-no-border">
                                <a href="<?= $ButtonTwo['url'] ?>"><?= $ButtonTwo['title'] ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tctb-col tctb-right">
                    <div class="tctb-accent"></div>
                    <div class="tctb-right-inner">
                        <div class="tctb-masking">
                            <img src="<?= $Image['url'] ?>" alt="View all" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>