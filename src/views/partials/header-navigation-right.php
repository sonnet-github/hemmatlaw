<?php
/**
 * Navigation Template - Right Side
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */  
?>
<?php
    $main_menu = \SDEV\Utils::getMenuItems('Main Menu', true);
    foreach($main_menu as $key => $fi) : 
        $menu_item = $fi['item']; 
        $classes=''; 
        if(!empty($menu_item->classes)){ 
            foreach($menu_item->classes as $cls) :
                $classes .= $cls.' ';
            endforeach;
        } ?>
        <?php if(empty($fi['submenu'])) { ?>
            
            <a href="<?= $menu_item->url; ?>" data-home="<?= get_site_url(null, '?gt='.ltrim($menu_item->url,'#')); ?>" target="<?= $menu_item->target ?>" data-id="<?= $menu_item->ID; ?>" class="<?= $classes ?> <?= \SDEV\Utils::getMenuItemClass( (rtrim(get_permalink(), '/').'/'), $menu_item->url) ?>"><?= $menu_item->title; ?></a>
        <?php } else { 
            $parent_url = ($menu_item->url == '#' || empty($menu_item->url)) ? 'javascript:void(0)' : $menu_item->url; ?>
            <div class="has-sub-menu">
                <a href="<?= $parent_url; ?>" data-id="<?= $menu_item->ID; ?>"><?= $menu_item->title; ?></a>
                <ul class="sub-nav">
                    <?php foreach($fi['submenu'] as $sub) :
                        $classes='';
                        if(!empty($sub->classes)){ 
                            foreach($sub->classes as $cls) :
                                $classes .= $cls.' ';
                            endforeach;
                        } ?>
                        <li><a href="<?= $sub->url; ?>" target="<?= $sub->target ?>" class="<?= $classes ?>"><?= $sub->title; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php } 
    endforeach; 
?>