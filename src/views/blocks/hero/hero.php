<?php
/**
 * Full Width Banner Block Template
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
    $HeroImage = get_field('hero_image');
    $HeroTitle = get_field('hero_title');
    $HeroPara = get_field('hero_para');
    $BlockId = get_field('block_id');
    $HeroDesc = get_field('hero_description');
    $HeroBtnOne = get_field('hero_button_one');
    $HeroBtnTwo = get_field('hero_button_two');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__hero';
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
        <canvas width="1920" height="800"></canvas>
        <div class="hero-inner">
            <div class="hero-wrap">
                <div class="hero-list">
                    <div class="hero-col hero-left">
                        <div class="hero-left-inner">
                            <div class="hero-mask masking">
                                <img src="<?= $HeroImage['url'] ?>" alt="View all" />
                            </div>
                        </div>
                    </div>
                    <div class="hero-col hero-right">
                        <div class="hero-right-inner">
                            <div class="hero-right-title">
                                <h1>
                                    <?= $HeroTitle ?>
                                </h1>
                            </div>
                            <div class="hero-desc">
                                <?= $HeroDesc ?>
                            </div>
                            <?php if( get_field('hero_para') ): ?>
                                <div class="hero-para">
                                    <?= $HeroPara ?>
                                </div>
                            <?php endif; ?>
                            <div class="hero-form">
                                <div class="hero-form-inner">
                                    <div class="hero-gf-form">
                                        <?= do_shortcode('[gravityform id="1" title="true"]') ?>
                                    </div>
                                </div>
                            </div>
                            <?php if( get_field('hero_button_one') ): ?>
                            <div class="hero-btn-wrap">
                                <div class="hero-btn-inner">
                                    <div class="hero-btn-item global-btn">
                                        <a href="<?= $HeroBtnOne['url'] ?>" target="<?= $HeroBtnOne['target']?>"><?= $HeroBtnOne['title'] ?></a>
                                    </div>
                                    <div class="hero-btn-item global-btn global-btn-white global-btn-no-border">
                                        <a href="<?= $HeroBtnTwo['url'] ?>" target="<?= $HeroBtnTwo['target']?>"><?= $HeroBtnTwo['title'] ?></a>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>