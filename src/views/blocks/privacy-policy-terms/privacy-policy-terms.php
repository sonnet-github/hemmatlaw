<?php
/**
 * Get In Touch Template
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
    $Description = get_field('ppt_description');
    $AddressTitle = get_field('ppt_address_title');
    $AddressIcon = get_field('ppt_address_icon');
    $Address = get_field('ppt_address');
    $AddressLink = get_field('ppt_address_link');
    $PhoneTitle = get_field('ppt_phone_title');
    $PhoneIconOne = get_field('ppt_phone_icon_one');
    $PhoneOne = get_field('ppt_phone_one');
    $PhoneIconTwo = get_field('ppt_phone_icon_two');
    $PhoneTwo = get_field('ppt_phone_two');
    $SidebarBottomDesc = get_field('ppt_sidebar_bottom_description');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__ppt';
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
        <div class="git-inner">
            <div class="git-wrap">
                <div class="git-list">
                    <div class="git-col git-left">
                        <div class="git-left-inner">
                            <div class="ppt-title">
                                <?= $Description ?>
                            </div>
                        </div>
                    </div>
                    <div class="git-col git-right">
                        <div class="git-right-inner">
                            <div class="git-right-wrap">
                                <div class="git-right-title">
                                    <?= $AddressTitle ?>
                                </div>
                                <div class="git-address">
                                    <div class="git-icon">
                                        <img src="<?= $AddressIcon['url'] ?>" alt="View all" />
                                    </div>
                                    <div class="git-text">
                                        <a href="<?= $AddressLink['url'] ?>" target="_blank">
                                            <?= $Address ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="git-right-title">
                                    <?= $PhoneTitle ?>
                                </div>
                                <div class="git-phone-item">
                                    <div class="git-icon">
                                        <img src="<?= $PhoneIconOne['url'] ?>" alt="View all" />
                                    </div>
                                    <div class="git-text-phone">
                                        <a href="<?= $PhoneOne['url'] ?>"><?= $PhoneOne['title'] ?></a>
                                    </div>
                                </div>
                                <div class="git-phone-item">
                                    <div class="git-icon">
                                        <img src="<?= $PhoneIconTwo['url'] ?>" alt="View all" />
                                    </div>
                                    <div class="git-text-phone">
                                        <a href="<?= $PhoneTwo['url'] ?>"><?= $PhoneTwo['title'] ?></a>
                                    </div>
                                </div>
                                <div class="git-para">
                                    <?= $SidebarBottomDesc ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>