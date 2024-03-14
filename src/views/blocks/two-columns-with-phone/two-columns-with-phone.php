<?php
/**
 * Two Columns With Phone Block Template
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
    $Title = get_field('tcp_title');
    $Description = get_field('tcp_description');
    $BoxTitle = get_field('tcp_box_title');
    $Phone = get_field('tcp_phone');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__tcp';
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
        <div class="tcp-inner">
            <div class="tcp-wrap">
                <div class="tcp-col tcp-left">
                    <div class="tcp-left-inner">
                        <div class="tcp-title">
                            <h2><?= $Title ?></h2>
                        </div>
                        <div class="tcp-desc">
                            <?= $Description ?>
                        </div>
                    </div>
                </div>
                <div class="tcp-col tcp-right">
                    <div class="tcp-right-inner">
                        <div class="tcp-phone-title-wrap">
                            <div class="tcp-phone-title">
                                <?= $BoxTitle ?>
                            </div>
                            <div class="tcp-phone-bot">
                                <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/ic_round-phone.png') ?>" alt="View all" />
                                <a href="<?= $Phone['url'] ?>"><?= $Phone['title'] ?></a>
                            </div>
                        </div>
                    </div>
                    <?php if( get_field('footer_buttons', 'option') ): ?>
                        <?php if( have_rows('footer_buttons', 'option') ): ?>
                            <div class="footer-btn-wrap">
                                <?php while( have_rows('footer_buttons', 'option') ): the_row();
                                    $FooterBtnItem = get_sub_field('footer_button_item', 'option');
                                    $FooterBtnClass = get_sub_field('footer_button_class', 'option');
                                    ?>
                                <div class="footer-btn global-btn <?= $FooterBtnClass ?>">
                                        <a href="<?= $FooterBtnItem['url'] ?>"><?= $FooterBtnItem['title'] ?></a>
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