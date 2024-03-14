<?php
/**
 * Compensation and Benefits Block Template
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
    $Title = get_field('cab_title');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__cab';
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
        <div class="cab-wrap">
            <div class="cab-inner">
                <div class="cab-title">
                    <h2>
                        <?= $Title?>
                    </h2>
                </div>
                <?php if( get_field('cab_list') ): ?>
                    <?php if( have_rows('cab_list') ): ?>
                        <div class="cab-list">
                            <?php while( have_rows('cab_list') ): the_row();
                                    $IconCab = get_sub_field('cab_icon');
                                    $DescCab = get_sub_field('cab_description');
                                ?>
                                <div class="cab-item">
                                    <div class="cab-item-inner">
                                        <div class="cab-icon">
                                            <img src="<?= $IconCab['url'] ?>" alt="View all" />
                                        </div>
                                        <div class="cab-desc">
                                            <?= $DescCab ?>
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

<?php endif; ?>