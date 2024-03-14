<?php
/**
 * Get In Touch Banner Block Template
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
    $GitBanTitle = get_field('git_banner_title');
    $GitBanDesc = get_field('git_banner_description');
    $GitBanImg = get_field('git_banner_image');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__git-banner';
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
       <div class="git-banner-inner">
        <div class="git-banner-wrap">
            <div class="git-banner-left git-banner-col">
                <div class="git-banner-left-inner">
                    <div class="git-banner-left-title">
                        <?= $GitBanTitle ?>
                    </div>
                    <div class="git-banner-left-desc">
                        <?= $GitBanDesc ?>
                    </div>
                    <div class="git-banner-left-form">
                        <div class="git-banner-left-form-inner">
                            <?= do_shortcode('[gravityform id="1" title="true"]') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="git-banner-right git-banner-col">
                <div class="git-banner-right-inner">
                    <div class="git-banner-mask masking">
                        <img src="<?= $GitBanImg['url'] ?>" alt="View all" />
                    </div>
                </div>
            </div>
        </div>
       </div>
    </div>

<?php endif; ?>