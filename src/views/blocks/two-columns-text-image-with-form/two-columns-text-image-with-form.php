<?php
/**
 * Two Columns Text Image With Form Banner Block Template
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
    $Image = get_field('tcif_image');
    $Title = get_field('tcif_title');
    $Para = get_field('tcif_paragraph');
    $Desc = get_field('tcif_description');
    $FinLink = get_field('tcif_financing_link');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__tctf';
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

    <div class="block--custom-layout <?= $class_name ?>" id="<?= $BlockId ?>" <?= $anchor ?>>
        <div class="hero-inner">
            <div class="hero-wrap">
                <div class="hero-list">
                    <div class="hero-col hero-left" >
                        <div class="hero-right-inner">
                            <div class="hero-right-title">
                                <h2>
                                    <?= $Title ?>
                                </h2>
                            </div>
                            <div class="hero-para">
                                <?= $Para ?>
                            </div>
                            <div class="hero-desc">
                                <?= $Desc ?>
                            </div>
                            <div class="hero-bot-fin-form">
                                <div class="hero-form">
                                    <div class="hero-form-inner">
                                        <div class="hero-gf-form">
                                            <?= do_shortcode('[gravityform id="7" title="true"]') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hero-col hero-right">
                        <div class="hero-left-inner">
                            <div class="hero-mask masking">
                                <img src="<?= $Image['url'] ?>" alt="View all" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>