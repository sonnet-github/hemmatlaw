<?php
/**
 * Footer Upper Template (Footer Block)
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */  

    $phone = get_field('gen_phone_number', 'options');
    $email = get_field('gen_email_address', 'options');
    $location = get_field('gen_location', 'options');
    $address = get_field('footer_address', 'options');
    $Footerlogo = get_field('footer_logo_image', 'options');
    $FooterSMI = get_field('footer_smi', 'options');
    $icon_class = (defined('FOOTER_ALT_CLASS')) ? '-light' : '';
?>
<div class="pf-upper">
    <div class="footer-upper-inner">
        <div class="footer-upper-left" data-sal="slide-up" data-sal-duration="300">
            <div class="footer-upper-left-inner">
                <div class="footer-logo">
                    <img src="<?= $Footerlogo['url'] ?>" alt="View all" />
                </div>
                <div class="footer-add">
                    <a href="<?= $address['url'] ?>" target="_blank">
                        <?= $address['title'] ?>
                    </a>
                </div>
                <?php if( get_field('footer_contact', 'option') ): ?>
                    <?php if( have_rows('footer_contact', 'option') ): ?>
                        <div class="footer-phones">
                            <?php while( have_rows('footer_contact', 'option') ): the_row();
                                $FooterPhone = get_sub_field('footer_phone', 'option');
                                ?>
                                <div class="footer-phone-item">
                                    <a href="<?= $FooterPhone['url'] ?>"><?= $FooterPhone['title'] ?></a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="footer-upper-mid" data-sal="slide-up" data-sal-duration="300" data-sal-delay="100">
            <div class="footer-upper-mid-inner">
                <?php if( get_field('footer_navigation_left', 'option') ): ?>
                    <?php if( have_rows('footer_navigation_left', 'option') ): ?>
                        <ul>
                            <?php while( have_rows('footer_navigation_left', 'option') ): the_row();
                                $FooterNavItemLeft = get_sub_field('footer_navigation_item_left', 'option');
                                ?>
                               <li>
                                    <a href="<?= $FooterNavItemLeft['url'] ?>" target="<?= $FooterNavItemLeft['link']['target']; ?>"><?= $FooterNavItemLeft['title'] ?></a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if( get_field('footer_navigation_right', 'option') ): ?>
                    <?php if( have_rows('footer_navigation_right', 'option') ): ?>
                        <ul>
                            <?php while( have_rows('footer_navigation_right', 'option') ): the_row();
                                $FooterNavItemRight = get_sub_field('footer_navigation_item_right', 'option');
                                ?>
                               <li>
                                    <a href="<?= $FooterNavItemRight['url'] ?>" target="<?= $FooterNavItemRight['target']; ?>"><?= $FooterNavItemRight['title'] ?></a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="footer-copy-smi footer-copy-smi-mob">
                <div class="footer-copy">
                    <?= get_field('footer_main_copy', 'options')  ?>
                </div>
                <div class="footer-smi">
                    <a href="<?= $FooterSMI['url']?>" target="_blank">
                        <i class="<?= $FooterSMI['title']?>"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-upper-right" data-sal="slide-up" data-sal-duration="300" data-sal-delay="200">
            <div class="footer-upper-right-inner">
                <?php if( get_field('footer_buttons', 'option') ): ?>
                    <?php if( have_rows('footer_buttons', 'option') ): ?>
                        <div class="footer-btn-wrap">
                            <?php while( have_rows('footer_buttons', 'option') ): the_row();
                                $FooterBtnItem = get_sub_field('footer_button_item', 'option');
                                $FooterBtnClass = get_sub_field('footer_button_class', 'option');
                                ?>
                               <div class="footer-btn global-btn <?= $FooterBtnClass ?>">
                                    <a href="<?= $FooterBtnItem['url'] ?>"><?= $FooterBtnItem['title'] ?></a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="footer-copy-smi">
                    <div class="footer-copy">
                        <?= get_field('footer_main_copy', 'options')  ?>
                    </div>
                    <div class="footer-smi">
                        <a href="<?= $FooterSMI['url']?>" target="_blank">
                            <i class="<?= $FooterSMI['title']?>"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>