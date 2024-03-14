<?php
/**
 * How it Works Block Template
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
    $Title = get_field('tcib_title');
    $PaID = get_field('block_id');
    $Description = get_field('tcib_description');
    $Button = get_field('tcib_button');
    $Image = get_field('tcib_image');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__hiw';
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
        <div class="hiw-inner">
            <div class="hiw-wrap">
                <?php if( get_field('hiw_list') ): ?>
                    <?php if( have_rows('hiw_list') ): ?>
                        <div class="hiw-list">
                            <?php while( have_rows('hiw_list') ): the_row();
                                    $TitleHiw = get_sub_field('hiw_title');
                                    $DescHiw = get_sub_field('hiw_description');
                                ?>
                                <div class="hiw-item">
                                    <div class="hiw-item-inner">
                                        <div class="hiw-title"><?=$TitleHiw?></div>
                                        <div class="hit-item-desc"><?=$DescHiw?></div>
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