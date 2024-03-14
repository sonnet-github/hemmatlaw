<?php
/**
 * Two Columns With Image Block Template
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
    $Title = get_field('tcwi_title');
    $Description = get_field('tcwi_description');
    $ButtonOne = get_field('tcwi_one_button');
    $ButtonTwo = get_field('tcwo_two_button');
    $PaID = get_field('block_id');
    $Image = get_field('tcwI_image');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__tcwi';
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
        <div class="tcwi-inner">
            <div class="tcwi-wrap">
                <div class="tcwi-left tcwi-col">
                    <div class="tcwi-left-inner">
                        <div class="tcwi-title">
                            <h2><?= $Title ?></h2>
                        </div>
                        <div class="tcwi-desc">
                            <?= $Description ?>
                        </div>
                        <div class="tcwi-buttons">
                            <div class="tcwi-btn-item global-btn">
                                <a href="<?= $ButtonOne['url'] ?>"><?= $ButtonOne['title'] ?></a>
                            </div>
                            <div class="tcwi-btn-item global-btn global-btn-white global-btn-no-border">
                                <a href="<?= $ButtonTwo['url'] ?>"><?= $ButtonTwo['title'] ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tcwi-right tcwi-col">
                    <div class="tcwi-right-inner">
                        <div class="tcwi-shadows">
                            <div class="tcwi-mask masking">
                                <img src="<?= $Image['url'] ?>" alt="View all" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>