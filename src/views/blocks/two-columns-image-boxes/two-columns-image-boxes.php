<?php
/**
 * Two Columns Images Boxes Block Template
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
    $class_name = 'block--custom-layout__tcib';
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
        <div class="tcib-inner">
            <div class="tcib-wrap">
                <div class="tcib-top">
                    <div class="tcib-top-inner">
                        <div class="tcib-top-left tcib-top-col">
                            <div class="tcib-top-left-inner">
                                <div class="tcib-title">
                                    <h2>
                                        <?= $Title ?>
                                    </h2>
                                </div>
                                <div class="tcib-desc">
                                    <?= $Description ?>
                                </div>
                                <?php if( get_field('tcib_button') ): ?>
                                <div class="tcib-btn global-btn">
                                    <a href="<?= $Button['url'] ?>"><?= $Button['title'] ?></a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if( get_field('tcib_image') ): ?>
                            <div class="tcib-top-right tcib-top-col">
                                <div class="tcib-right-inner">
                                    <div class="tcib-shadows">
                                        <div class="tcib-mask masking">
                                            <img src="<?= $Image['url'] ?>" alt="View all" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="tcib-bot">
                    <div class="tcib-bot-inner">
                        <?php if( get_field('tcib_boxes') ): ?>
                            <?php if( have_rows('tcib_boxes') ): ?>
                                <div class="tcib-list">
                                    <?php while( have_rows('tcib_boxes') ): the_row();
                                        $boxTitle = get_sub_field('tcib_boxes_title');
                                        $boxIcon = get_sub_field('tcib_boxes_icon');
                                        $boxDesc = get_sub_field('tcib_boxes_description');
                                        $boxButton = get_sub_field('tcib_boxes_button');
                                        ?>
                                        <div class="tcib-item">
                                            <div class="tcib-item-inner">
                                                <div class="tcib-item-wrap">
                                                    <div class="tcib-item-title">
                                                        <div class="tcib-title-inner">
                                                            <?= $boxTitle ?>
                                                        </div>
                                                        <div class="tcib-item-icon">
                                                            <img src="<?= $boxIcon['url'] ?>" alt="View all" />
                                                        </div>
                                                    </div>
                                                    <div class="tcib-item-desc">
                                                        <?= $boxDesc ?>
                                                    </div>
                                                    <?php if( get_sub_field('tcib_boxes_button') ): ?>
                                                    <div class="tcib-btn">
                                                        <a href="<?= $boxButton['url'] ?>"><?= $boxButton['title'] ?></a>
                                                    </div>
                                                    <?php endif; ?>
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
        </div>
    </div>

<?php endif; ?>