<?php
/**
 * Current Openings Block Template
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
    $Title = get_field('co_title');
    $BlockID = get_field('block_id');
    
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__co';
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
        <div class="co-inner">
            <div class="co-title">
                <h2><?= $Title ?></h2>
            </div>
            <div class="co-wrap">
                <?php if( get_field('co_list') ): ?>
                    <?php if( have_rows('co_list') ): ?>
                        <div class="co-list">
                            <?php while( have_rows('co_list') ): the_row();
                                $CoIMG = get_sub_field('co_icon');
                                $CoDesc = get_sub_field('co_description');
                                $CoLink = get_sub_field('co_link');
                                ?>
                                <div class="co-item">
                                    <div class="co-item-inner">
                                        <div class="co-icon">
                                            <img src="<?= $CoIMG['url'] ?>" alt="View all" />
                                        </div>
                                        <div class="co-desc">
                                            <?= $CoDesc ?>
                                        </div>
                                        <div class="co-read">
                                            <a href="<?= $CoLink['url'] ?>"><?= $CoLink['title'] ?></a>
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