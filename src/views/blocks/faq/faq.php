<?php
/**
 *FAQ Template
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
    $Title = get_field('faq_title');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__faq';
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

    <div class="block--custom-layout <?= $class_name ?>" id="learn-faq" <?= $anchor ?>>
        <div class="faq-inner">
            <div class="faq-wrap">
                <div class="faq-list">
                    <div class="faq-col faq-left">
                        <div class="faq-left-inner">
                            <div class="faq-title">
                                <h2><?= $Title ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="faq-col faq-right">
                        <div class="faq-right-inner">
                            <?php if( get_field('faq_accordion') ): ?>
                                <?php if( have_rows('faq_accordion') ): ?>
                                    <div class="faq-right-wrap">
                                        <?php while( have_rows('faq_accordion') ): the_row();
                                            $FaqTitle = get_sub_field('faq_item_title');
                                            $FaqDesc = get_sub_field('faq_item_description');
                                            ?>
                                            <a class="accord-item faqs-accord-item">
                                                <div class="accord-btn">
                                                    <?= $FaqTitle ?>
                                                </div>
                                                <div class="accord-body" style="display: none;">
                                                    <div class="accord-content">
                                                        <?= $FaqDesc ?>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>