<?php
/**
 * Leadership Block Template
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
    $Title = get_field('leader_title');
    $Description = get_field('leader_description');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__leader';
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

    <div class="block--custom-layout <?= $class_name ?>" id="leadership" <?= $anchor ?>>
        <div class="leadership-wrap">
            <div class="leader-inner">
                <div class="leader-list">
                    <div class="leader-title">
                        <h2><?= $Title ?></h2>
                        <?= $Description ?>
                    </div>
                    <?php if( get_field('leader_list') ): ?>
                        <?php if( have_rows('leader_list') ): ?>
                            <div class="team-list">
                                <?php while( have_rows('leader_list') ): the_row();
                                        $LeaderImage = get_sub_field('leader_item_image');
                                        $LeaderTitle = get_sub_field('leader_item_title');
                                        $LeaderJD = get_sub_field('leader_item_jd');
                                        $LeaderLink = get_sub_field('leader_item_link');
                                    ?>
                                    <div class="team-item">
                                        <a href="<?= $LeaderLink['url'] ?>">
                                            <div class="team-img">
                                                <canvas width="380" height="425"></canvas>
                                                <img src="<?= $LeaderImage['url'] ?>" alt="View all" />
                                            </div>
                                            <div class="team-desc">
                                                <div class="team-name">
                                                    <?= $LeaderTitle ?>
                                                </div>
                                                <div class="team-jd-and-btn">
                                                    <div class="team-jd"><?= $LeaderJD ?></div>
                                                    <div class="team-btn">
                                                        <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/team-arrow.svg') ?>" alt="View all" />
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
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