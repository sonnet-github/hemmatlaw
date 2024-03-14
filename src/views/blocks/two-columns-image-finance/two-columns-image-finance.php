<?php
/**
 * Two Columns Image Finance Block Template
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
    $Image = get_field('tcf_image');

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__tcf';
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
                <div class="tctb-col tctb-left" data-sal="slide-up" data-sal-duration="300">
                    <div class="tctb-accent"></div>
                    <div class="tctb-left-inner">
                        <img src="<?=$Image['url']?>" alt="View all" />
                    </div>
                </div>
                <div class="tctb-col tctb-right" data-sal="slide-up" data-sal-duration="300">
                    <div class="tctb-right-inner">
                        <div class="tcf-list">
                            <?php if( get_field('tcf_list') ): ?>
                                <?php if( have_rows('tcf_list') ): ?>
                                    <ul>
                                        <?php while( have_rows('tcf_list') ): the_row();
                                                $Item = get_sub_field('tcf_item');
                                            ?>
                                            <li>
                                                <div class="tcf-list-item"><?=$Item?></div>
                                                <div class="tcf-icon">
                                                    <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/tcf-check.svg') ?>" alt="View all" />
                                                </div>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>