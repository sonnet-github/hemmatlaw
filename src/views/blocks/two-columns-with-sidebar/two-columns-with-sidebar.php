<?php
/**
 * Two Columns With Sidebar Block Template
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
    $MedServWrapTitle = get_field('mediation_services_experts_title');
    $SideDesc = get_field('med_sidebar_description');
    $Sidelink = get_field('med_sidebar_link');

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__tcs';
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
        <div class="tcb-inner">
            <div class="tcb-wrap">
                <div class="tcb-list">
                    <div class="tcb-left tcb-col">
                        <?php if( get_field('med_list') ): ?>
                            <?php if( have_rows('med_list') ): ?>
                                <div class="tcb-left-inner">
                                    <?php while( have_rows('med_list') ): the_row();
                                            $MedIcon = get_sub_field('med_icon');
                                            $MedTitle = get_sub_field('med_title');
                                            $MedDesc = get_sub_field('med_description');
                                        ?>
                                        <div class="tcb-left-item">
                                            <div class="tcb-title">
                                                <div class="tcb-icon">
                                                    <img src="<?= $MedIcon['url'] ?>" alt="View all" />
                                                </div>
                                                <div class="tcb-item-title">
                                                    <?= $MedTitle ?>
                                                </div>
                                            </div>
                                            <div class="tct-para">
                                                <?= $MedDesc ?>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="tcb-right tcb-right-col">
                        <div class="tcb-right-inner">
                            <div class="tcb-right-sidebar">
                                <div class="tcb-side-item">
                                    <div class="tcb-side-title">
                                        Schedule with Us
                                    </div>
                                    <div class="tcb-form">
                                        <?= do_shortcode('[gravityform id="2" title="true"]') ?>
                                        <div class="footer-btn global-btn global-btn-white global-btn-no-border">
                                            <a href="tel: (206) 759-8030">Call Us Today</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tcb-side-item">
                                    <div class="tcb-para">
                                        <?= $SideDesc ?>
                                    </div>
                                    <div class="tcb-btn global-btn green-btn">
                                        <a href="<?= $Sidelink['url'] ?>"><?= $Sidelink['title'] ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tcs-wrap">
            <div class="tcs-wrap-inner">
                <div class="tcs-title">
                    <h2><?= $MedServWrapTitle ?></h2>
                </div>
                <?php if( get_field('mediation_services_experts_list') ): ?>
                    <?php if( have_rows('mediation_services_experts_list') ): ?>
                        <div class="tcs-list">
                            <?php while( have_rows('mediation_services_experts_list') ): the_row();
                                    $MedServImg = get_sub_field('mediation_services_experts_image');
                                    $MedServTitle = get_sub_field('mediation_services_experts_item_title');
                                    $MedServDesc = get_sub_field('mediation_services_expert_description');
                                    $MedServJD = get_sub_field('mediation_services_jd');
                                ?>
                                <div class="tcs-item">
                                    <div class="tcs-item-inner">
                                        <div class="tcs-left">
                                            <div class="tcs-item-top">
                                                <div class="tcs-img"><img decoding="async" src="<?= $MedServImg['url'] ?>" alt="View all"></div>
                                            </div>
                                        </div>
                                        <div class="tcs-right">
                                            <div class="tcs-desc">
                                                <div class="tcs-title"><?= $MedServTitle ?></div>
                                                <div class="tcs-jd"><?= $MedServJD ?></div>
                                                <?= $MedServDesc ?>
                                            </div>
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

<?php endif; ?>