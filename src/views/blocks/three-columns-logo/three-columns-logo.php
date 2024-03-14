<?php
/**
 * Three Columns Logo Block Template
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
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__tcl';
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
        <div class="tcl-inner">
            <div class="logos-title">
                Powered By
            </div>
            <div class="tcl-wrap">
                <?php if( get_field('logos_list') ): ?>
                    <?php if( have_rows('logos_list') ): ?>
                        <div class="tcl-list">
                            <?php while( have_rows('logos_list') ): the_row();
                                $LogoImage = get_sub_field('logo_item');
                                $LogoLink = get_sub_field('logo_link');
                                ?>
                                
                                <?php if($LogoLink):?>
                                    <div class="tcl-item">
                                        <a href="<?= $LogoLink['url'] ?>" target="_blank">
                                            <img src="<?= $LogoImage['url'] ?>" alt="View all" />
                                        </a>
                                    </div>
                                <?php else:?>
                                    <div class="tcl-item">
                                        <img src="<?= $LogoImage['url'] ?>" alt="View all" />
                                    </div>
                                <?php endif;?>
                                
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php endif; ?>