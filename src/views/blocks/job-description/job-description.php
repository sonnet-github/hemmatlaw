<?php
/**
 * Job Description Block Template
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
    $tag_list = get_field('tag_list');
    $Title = get_field('jd_title');
    $Paragraph = get_field('jd_paragraph');
    $ResTitle = get_field('res_jd_title');
    $ResDesc = get_field('jd_responsibilities_description');
    $ReqTitle = get_field('jd_requirements_title');
    $ReqDesc = get_field('jd_requirements_description');
    $PayTitle = get_field('jd_pay_range_title');
    $PayDesc = get_field('jd_pay_range_description');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__jd';
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
        <div class="jd-inner">
            <div class="jd-wrap">
                <div class="jd-list">
                    <div class="jd-left jd-col">
                        <div class="jd-left-inner">
                            <div class="jd-auth-top">
                                <div class="jd-auth-item">
                                    <div class="jd-icon">
                                        <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/date-icon.svg') ?>" alt="View all" />
                                    </div>
                                    <div class="jd-text">
                                        <?= get_the_date( ' F j, Y');?>
                                    </div>
                                </div>
                                <div class="jd-auth-item">
                                    <div class="jd-icon">
                                        <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/tags-icon.svg') ?>" alt="View all" />
                                    </div>
                                    <div class="jd-text">
                                        <?php if($tag_list):
                                            $count = 1;    
                                        ?>
                                            <?php foreach($tag_list as $tag):?>
                                                <?php if($tag['tag']):
                                                    $prefix = $count != 1 ? ', ' : '';    
                                                ?>
                                                    <?= $prefix . $tag['tag']?>
                                                <?php $count++; endif;?>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <div class="jd-auth-item">
                                    <div class="jd-icon">
                                        <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/auth-icon.svg') ?>" alt="View all" />
                                    </div>
                                    <div class="jd-text">
                                        <?= get_the_author();?>
                                    </div>
                                </div>
                            </div>
                            <div class="jd-title">
                                <h2><?= $Title ?></h2>
                            </div>
                            <div class="jd-para">
                                <?= $Paragraph ?>
                            </div>
                            <div class="jd-response">
                                <h3><?= $ResTitle ?></h3>
                                <p><?= $ResDesc ?></p>
                            </div>
                            <div class="jd-req">
                                <h3><?= $ReqTitle ?></h3>
                                <?= $ReqDesc ?>
                            </div>
                            <div class="jd-pay">
                                <h3><?= $PayTitle ?></h3>
                                <p><?= $PayDesc ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="jd-right jd-col">
                        <div class="jd-right-inner">
                            <div class="jd-form">
                                <div class="jd-form-title">
                                    <h2>Apply</h2>
                                </div>
                                <?= do_shortcode('[gravityform id="4" title="true"]')?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>