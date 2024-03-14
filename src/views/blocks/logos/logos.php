<?php
/**
 * Logos Block Template
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
    $LogoLink = get_field('logo_link');
    $BlockID = get_field('block_id');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__logos';
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
       
        <div class="logo-inner" >
            <div class="logo-title">
                Powered By
            </div>
            <?php if( get_field('logo_list') ): ?>
                <?php if( have_rows('logo_list') ): ?>
                    <div class="logo-wrap">
                        <?php while( have_rows('logo_list') ): the_row();
                            $Logo = get_sub_field('logo');
                            $LogoLink = get_sub_field('logo_link');
                            ?>
                            <div class="logo-item">
                                <a href="<?= $LogoLink ? $LogoLink['url'] : '#' ?>" target="_blank">
                                    <img src="<?= $Logo['url'] ?>" alt="View all" />
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

<?php endif; ?>