<?php
/**
 * Two Columns Boxes Block Template
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
    $Title = get_field('tcwi_title');
    $Description = get_field('tcwi_description');
    $ButtonOne = get_field('tcwi_one_button');
    $ButtonTwo = get_field('tcwo_two_button');
    $PaID = get_field('block_id');
    $Image = get_field('tcwI_image');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__tcb';
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
        <div class="tcb-inner">
            <div class="tcb-wrap">
                <div class="tcb-holder">
                    <?php if( get_field('boxes_list') ): ?>
                        <?php if( have_rows('boxes_list') ): ?>
                            <div class="tcb-list">
                                <?php while( have_rows('boxes_list') ): the_row();
                                    $Image = get_sub_field('tb_boxes_image');
                                    $Title = get_sub_field('tb_boxes_title');
                                    $boxDesc = get_sub_field('tb_boxes_description');
                                    $boxLink = get_sub_field('tb_boxes_link');
                                    ?>
                                    <div class="tcb-item">
                                        <div class="tcb-item-inner">
                                            <div class="tcb-img">
                                                <canvas width="539" height="300"></canvas>
                                                <img src="<?= $Image['url'] ?>" alt="View all" />
                                            </div>
                                            <div class="tcb-desc">
                                                <div class="tcb-title">
                                                    <?= $Title ?>
                                                </div>
                                                <div class="tcb-desc">
                                                    <?= $boxDesc ?>
                                                </div>
                                                <div class="tcb-btn">
                                                    <a href="<?= $boxLink['url'] ?>">Read more</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>