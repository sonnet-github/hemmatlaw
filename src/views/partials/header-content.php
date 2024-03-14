<?php
/**
 * Page Header Template Block (Header Block)
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */  
    $header_type = get_field('header_type') ?: 'default';
    $logo_type = get_field('logo_type', 'options');
    $alt_logo_type = get_field('alt_logo_type', 'options');
    $mobile_logo_type = get_field('mobile_logo_type', 'options');
    $headerAddress = get_field('header_address', 'options');
    $FooterSMI = get_field('footer_smi', 'options');
    $PopupImg = get_field('popup_image', 'options');
    $PopupTxt = get_field('popup_text', 'options');
    $DisablePopup = get_field('disable_popup', 'options');

?>
<header id="page-header" class="page-header--<?= $header_type ?>">
    <div class="header-inner">
        <div class="header-wrap">
            <div class="header-logo">
                <div class="logo-inner">
                    <?php if($header_type == 'home') : ?>
                         <a href="<?= get_site_url(null, ''); ?>" class="main-logo main-logo--home">
                            <?php if($logo_type == 'svg') : ?>
                                    <?= get_field('main_logo_svg', 'options') ?>
                            <?php else: 
                                    $logo = get_field('main_logo','options'); ?>
                                    <img src="<?= $logo['url'] ?>" alt="<?= $logo['alt'] ?>" />
                            <?php endif; ?>
                        </a>
                    <?php else : ?>
                        <a href="<?= get_site_url(null, ''); ?>" class="main-logo">
                            <?php if($mobile_logo_type == 'svg') : ?>
                                    <?= get_field('mobile_logo_svg', 'options') ?>
                            <?php else: 
                                    $logo = get_field('mobile_logo','options'); ?>
                                    <img src="<?= $logo['url'] ?>" alt="<?= $logo['alt'] ?>" />
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                    <a href="<?= get_site_url(null, ''); ?>" class="mobile-logo">
                        <?php if($mobile_logo_type == 'svg') : ?>
                                <?= get_field('mobile_logo_svg', 'options') ?>
                        <?php else: 
                                $logo = get_field('mobile_logo','options'); ?>
                                <img src="<?= $logo['url'] ?>" alt="<?= $logo['alt'] ?>" />
                        <?php endif; ?>
                    </a>
                    <a href="<?= get_site_url(null, ''); ?>" class="alt-logo">
                        <?php if($alt_logo_type == 'svg') : ?>
                                <?= get_field('alt_logo_svg', 'options') ?>
                        <?php else: 
                                $logo = get_field('alt_logo','options'); ?>
                                <img src="<?= $logo['url'] ?>" alt="<?= $logo['alt'] ?>" />
                        <?php endif; ?>
                    </a>
                </div>
            </div>
            <div class="header-nav">
                <div class="header-nav-inner">
                <?php if( get_field('header_menu_list', 'option') ): ?>
                    <?php if( have_rows('header_menu_list', 'option') ): ?>
                        <nav class="main-navigation">
                            <?php while( have_rows('header_menu_list', 'option') ): the_row();
                                $HeaderMenuItem = get_sub_field('header_menu_item', 'option');
                                $HeaderMenuClass = get_sub_field('header_menu_class', 'option');
                                ?>
                                <div class="with-sub">
                                    <a href="<?= $HeaderMenuItem['url'] ?>" class="nav-item <?= $HeaderMenuClass ?>"><?= $HeaderMenuItem['title'] ?></a>
                                    <?php if( get_sub_field('header_menu_sub_left', 'option') ): ?>
                                        <div class="sub-wrap">
                                            <div class="sub-wrap-inner">
                                                <div class="sub-wrap-list">
                                                    <div class="sub-wrap-list-inner">
                                                        <div class="sub-left sub-col">
                                                            <div class="sub-title">
                                                                Practice Areas
                                                            </div>
                                                            <div class="sub-list">
                                                                <?php if( get_sub_field('header_menu_sub_left', 'option') ): ?>
                                                                    <?php if( have_rows('header_menu_sub_left', 'option') ): ?>
                                                                        <ul>
                                                                            <?php while( have_rows('header_menu_sub_left', 'option') ): the_row();
                                                                                $HeaderSubLinkLeft = get_sub_field('header_menu_sub_link_left', 'option');
                                                                                $HeaderSubIconLeft = get_sub_field('header_menu_sub_icon_left', 'option');
                                                                                ?>
                                                                                <li>
                                                                                    <a href="<?= $HeaderSubLinkLeft['url'] ?>">
                                                                                        <div class="icon-sub-nav">
                                                                                            <img src="<?= $HeaderSubIconLeft['url'] ?>" alt="View all" />
                                                                                        </div>
                                                                                        <?= $HeaderSubLinkLeft['title'] ?>
                                                                                    </a>
                                                                                </li>
                                                                            <?php endwhile; ?>
                                                                        </ul>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="sub-mid sub-col">
                                                            <div class="sub-title">
                                                                Representation
                                                            </div>
                                                            <div class="sub-list">
                                                                <?php if( get_sub_field('header_menu_sub_mid', 'option') ): ?>
                                                                    <?php if( have_rows('header_menu_sub_mid', 'option') ): ?>
                                                                        <ul>
                                                                            <?php while( have_rows('header_menu_sub_mid', 'option') ): the_row();
                                                                                $HeaderSubLinkmid = get_sub_field('header_menu_sub_link_mid', 'option');
                                                                                $HeaderSubIconmid = get_sub_field('header_menu_sub_icon_mid', 'option');
                                                                                ?>
                                                                                <li>
                                                                                    <a href="<?= $HeaderSubLinkmid['url'] ?>">
                                                                                        <div class="icon-sub-nav">
                                                                                            <img src="<?= $HeaderSubIconmid['url'] ?>" alt="View all" />
                                                                                        </div>
                                                                                        <?= $HeaderSubLinkmid['title'] ?>
                                                                                    </a>
                                                                                </li>
                                                                            <?php endwhile; ?>
                                                                        </ul>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="sub-mid sub-col">
                                                            <div class="sub-title">
                                                                Services
                                                            </div>
                                                            <div class="sub-list">
                                                                <?php if( get_sub_field('header_menu_sub_right', 'option') ): ?>
                                                                    <?php if( have_rows('header_menu_sub_right', 'option') ): ?>
                                                                        <ul>
                                                                            <?php while( have_rows('header_menu_sub_right', 'option') ): the_row();
                                                                                $HeaderSubLinkRight = get_sub_field('header_menu_sub_link_right', 'option');
                                                                                $HeaderSubIconRight = get_sub_field('header_menu_sub_icon_right', 'option');
                                                                                ?>
                                                                                <li>
                                                                                    <a href="<?= $HeaderSubLinkRight['url'] ?>">
                                                                                        <div class="icon-sub-nav">
                                                                                            <img src="<?= $HeaderSubIconRight['url'] ?>" alt="View all" />
                                                                                        </div>
                                                                                        <?= $HeaderSubLinkRight['title'] ?>
                                                                                    </a>
                                                                                </li>
                                                                            <?php endwhile; ?>
                                                                        </ul>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>    
                                </div>
                            <?php endwhile; ?>
                        </nav>
                    <?php endif; ?>
                <?php endif; ?>
                    <div class="header-phone-mob">
                        <a href="tel:(206) 682-5202 "><img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/ic_round-phone.png') ?>" alt="View all" /></a>
                    </div>
                    <div id="hamburger-menu" class="mobile-menu-trigger">
                        <div class="hm-bar"></div>
                        <div class="hm-bar"></div>
                        <div class="hm-bar"></div>
                    </div>
                    <div id="mobile-menu">
                        <div class="mobile-menu-top">
                            <div class="mobile-logo-wrap">
                                <?php if($header_type == 'home') : ?>
                                    <a href="<?= get_site_url(null, ''); ?>" class="main-logo main-logo--home">
                                        <?php if($logo_type == 'svg') : ?>
                                                <?= get_field('main_logo_svg', 'options') ?>
                                        <?php else: 
                                                $logo = get_field('main_logo','options'); ?>
                                                <img src="<?= $logo['url'] ?>" alt="<?= $logo['alt'] ?>" />
                                        <?php endif; ?>
                                    </a>
                                <?php else : ?>
                                    <a href="<?= get_site_url(null, ''); ?>" class="main-logo">
                                        <?php if($mobile_logo_type == 'svg') : ?>
                                                <?= get_field('mobile_logo_svg', 'options') ?>
                                        <?php else: 
                                                $logo = get_field('mobile_logo','options'); ?>
                                                <img src="<?= $logo['url'] ?>" alt="<?= $logo['alt'] ?>" />
                                        <?php endif; ?>
                                    </a>
                                <?php endif; ?>
                                <a href="<?= get_site_url(null, ''); ?>" class="mobile-logo">
                                    <?php if($mobile_logo_type == 'svg') : ?>
                                            <?= get_field('mobile_logo_svg', 'options') ?>
                                    <?php else: 
                                            $logo = get_field('mobile_logo','options'); ?>
                                            <img src="<?= $logo['url'] ?>" alt="<?= $logo['alt'] ?>" />
                                    <?php endif; ?>
                                </a>
                                <a href="<?= get_site_url(null, ''); ?>" class="alt-logo">
                                    <?php if($alt_logo_type == 'svg') : ?>
                                            <?= get_field('alt_logo_svg', 'options') ?>
                                    <?php else: 
                                            $logo = get_field('alt_logo','options'); ?>
                                            <img src="<?= $logo['url'] ?>" alt="<?= $logo['alt'] ?>" />
                                    <?php endif; ?>
                                </a>
                            </div>
                        </div>
                        <div class="mm-main-wrap">
                            <div class="mobile-nav-wrapper">
                                <nav>
                                    <?php get_template_part('src/views/partials/header', 'navigation-right');  ?>
                                </nav>
                                <div class="mobile-nav-address">
                                    <div class="mobile-add">
                                        <?= $headerAddress ?>
                                    </div>
                                    <?php if( get_field('header_phones', 'option') ): ?>
                                        <?php if( have_rows('header_phones', 'option') ): ?>
                                            <div class="mobile-phones">
                                                <?php while( have_rows('header_phones', 'option') ): the_row();
                                                    $HeaderPhone = get_sub_field('header_phone_item', 'option');
                                                    ?>
                                                <div class="mobile-phone-item">
                                                    <a href="<?= $HeaderPhone['url'] ?>"><?= $HeaderPhone['title'] ?></a>
                                                </div>
                                                <?php endwhile; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="mobile-footer">
                                        <div class="mobile-links">
                                            <?php if( get_field('header_links', 'option') ): ?>
                                                <?php if( have_rows('header_links', 'option') ): ?>
                                                    <ul>
                                                        <?php while( have_rows('header_links', 'option') ): the_row();
                                                            $HeaderLinks = get_sub_field('header_links_item', 'option');
                                                            ?>
                                                            <li>
                                                                <a href="<?= $HeaderLinks['url'] ?>"><?= $HeaderLinks['title'] ?></a>
                                                            </li>
                                                        <?php endwhile; ?>
                                                    </ul>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>    
                                        <div class="mobile-copy-smi">
                                            <div class="mobile-copy">
                                                <?= get_field('footer_main_copy', 'options')  ?>
                                            </div>
                                            <div class="mobile-smi">
                                                <a href="<?= $FooterSMI['url'] ?>" target="_blank">
                                                    <i class="<?= $FooterSMI['title'] ?>"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="popupwrap-hold" style="display: none;">
    <div class="pop-wrap-inner  <?= $DisablePopup ?>">
        <div class="pop-wrap-holder-inner">
            <div class="close-pop">
                <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/close-btn.svg') ?>">
            </div>
            <div class="pop-content">
                <div class="pop-left">
                    <div class="pop-left-inner">
                        <div class="pop-left-img">
                            <canvas width="400" height="500"></canvas>
                            <img src="<?= $PopupImg['url'] ?>">
                        </div>
                    </div>
                </div>
                <div class="pop-right">
                    <div class="pop-right-inner">
                        <?= $PopupTxt ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>