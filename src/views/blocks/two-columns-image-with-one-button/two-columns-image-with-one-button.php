<?php
/**
 * Two Columns With One Button Block Template
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
    $Image = get_field('tcob_image');
    $Title = get_field('tcob_title');
    $BlockID = get_field('block_id');
    $Description = get_field('tcob_description');
    $Button = get_field('tcob_button');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__tcob';
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
        <div class="tcob-inner">
            <div class="tcob-wrap">
                <div class="tcob-col tcob-left">
                    <div class="tcob-left-inner">
                        <div class="tcob-accent"></div>
                        <div class="tcob-pad">
                            <div class="tcob-shadow">
                                <div class="tcob-masking masking">
                                    <img src="<?= $Image['url'] ?>" alt="View all" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tcob-col tcob-right">
                    <div class="tcob-right-inner">
                        <div class="tcob-title">
                            <h2><?= $Title ?></h2>
                        </div>
                        <div class="tcob-desc">
                            <p><?= $Description ?></p>
                        </div>
                        <?php if( get_field('tcob_button') ): ?>
                        <div class="tcob-buttons">
                            <div class="tcob-btn-item global-btn">
                                <a href="<?= $Button['url'] ?>"><?= $Button['title'] ?></a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>