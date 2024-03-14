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
    $Title = get_field('git_title');
    $FormTitle = get_field('git_form_title');
    $AddressTitle = get_field('git_address_title');
    $AddressLink = get_field('git_address_link');
    $AddressIcon = get_field('git_address_icon');
    $Address = get_field('git_address');
    $PhoneTitle = get_field('git_phone_title');
    $PhoneIconOne = get_field('git_phone_icon_one');
    $PhoneOne = get_field('git_phone_one');
    $PhoneIconTwo = get_field('git_phone_icon_two');
    $PhoneTwo = get_field('git_phone_two');
    $SidebarBottomDesc = get_field('git_sidebar_bottom_description');
    $MapIFrame = get_field('git_map_iframe');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__git';
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

    <div class="block--custom-layout <?= $class_name ?>" id="contact-form" <?= $anchor ?>>
        <div class="git-inner">
            <div class="git-wrap">
                <div class="git-title">
                    <h2><?= $Title ?></h2>
                </div>
                <div class="git-list">
                    <div class="git-col git-left">
                        <div class="git-left-inner">
                            <div class="git-left-side-item">
                                <div class="git-side-title">
                                    <?= $FormTitle ?>
                                </div>
                                <div class="git-form">
                                    <?= do_shortcode('[gravityform id="3" title="true"]')?>
                                </div>
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
									<div class="git-text-sms-right">
                                        We are <a href="<?= $PhoneTwo['url'] ?>">Text enabled!</a>
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
                <div class="git-map">
                    <div class="git-loc-top">
                        <div class="git-loc-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <path d="M20 22.5C18.7639 22.5 17.5555 22.1334 16.5277 21.4467C15.4999 20.7599 14.6988 19.7838 14.2258 18.6418C13.7527 17.4997 13.6289 16.2431 13.8701 15.0307C14.1113 13.8183 14.7065 12.7047 15.5806 11.8306C16.4547 10.9565 17.5683 10.3613 18.7807 10.1201C19.9931 9.87894 21.2497 10.0027 22.3918 10.4758C23.5338 10.9488 24.5099 11.7499 25.1967 12.7777C25.8834 13.8055 26.25 15.0139 26.25 16.25C26.248 17.907 25.5889 19.4956 24.4172 20.6672C23.2456 21.8389 21.657 22.498 20 22.5ZM20 12.5C19.2583 12.5 18.5333 12.7199 17.9166 13.132C17.2999 13.544 16.8193 14.1297 16.5355 14.8149C16.2516 15.5002 16.1774 16.2542 16.3221 16.9816C16.4668 17.709 16.8239 18.3772 17.3484 18.9017C17.8728 19.4261 18.541 19.7833 19.2684 19.9279C19.9958 20.0726 20.7498 19.9984 21.4351 19.7146C22.1203 19.4307 22.706 18.9501 23.118 18.3334C23.5301 17.7167 23.75 16.9917 23.75 16.25C23.749 15.2557 23.3536 14.3025 22.6506 13.5994C21.9475 12.8964 20.9943 12.501 20 12.5Z" fill="#07B88C"/>
                                <path d="M20 37.5L9.45501 25.0638C9.30849 24.877 9.16349 24.6891 9.02001 24.5C7.21874 22.1272 6.24565 19.229 6.25001 16.25C6.25001 12.6033 7.69867 9.10591 10.2773 6.52728C12.8559 3.94866 16.3533 2.5 20 2.5C23.6467 2.5 27.1441 3.94866 29.7227 6.52728C32.3014 9.10591 33.75 12.6033 33.75 16.25C33.7544 19.2277 32.7817 22.1246 30.9813 24.4963L30.98 24.5C30.98 24.5 30.605 24.9925 30.5488 25.0588L20 37.5ZM11.015 22.9938C11.0175 22.9938 11.3075 23.3787 11.3738 23.4612L20 33.635L28.6375 23.4475C28.6925 23.3787 28.985 22.9913 28.9863 22.99C30.4577 21.0514 31.2529 18.6838 31.25 16.25C31.25 13.2663 30.0647 10.4048 27.955 8.29505C25.8452 6.18526 22.9837 5 20 5C17.0163 5 14.1548 6.18526 12.0451 8.29505C9.93528 10.4048 8.75001 13.2663 8.75001 16.25C8.74739 18.6853 9.54224 21.0543 11.015 22.9938Z" fill="#07B88C"/>
                            </svg>
                            <?= $Address ?>
                        </div>
                        <div class="git-loc-btn global-btn global-btn-green">
                            <a href="<?= $AddressLink['url'] ?>" target="_blank">Open In Maps</a>
                        </div>
                    </div>
                    <div class="git-map-inner">
                        <iframe src="<?= $MapIFrame ?>" width="1200" height="348" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>