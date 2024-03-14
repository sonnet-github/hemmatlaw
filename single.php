<?php 
/* Template Name: Single Post Template
 * Template Post Type: post, page
 */
/**
 * Single Post Default template
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */
$post_id = get_the_ID();
$BlogList = get_field('team_post');
$categorys = get_primary_category(get_the_ID(), 'category');
$SidebarTitle = get_field('blog_sidebar_title');
$SidebarDesc = get_field('blog_sidebar_description');
$SidebarButton = get_field('blog_sidebar_button');
$SidebarRelatedDesc = get_field('blog_sidebar_related_description');
$bottom_logos = get_field('blog_team_bottom_logos', get_the_ID());
$banner_image = get_field('blog_image', $post_id);
$current_post_terms = get_the_terms($post_id, 'post_tag');
$post_tags = '';

if($current_post_terms) {
    $tags_count = 1;

    foreach($current_post_terms as $term) {
        $prefix = $tags_count != 1 ? ', ' : '';
    
        $post_tags .= $prefix . $term->name;
        $tags_count++;
    }

}


$queryHelper = new \SDEV\Helper\Query();
// $tax_query = ['relation' => 'and'];

$posts = $queryHelper->setQueryArgs([
    'post_type' => 'post',
    'post_status' => 'publish'
]);

$posts->setOrder('date', 'desc');
$posts->setPageSize(3);
$posts->setPage(1);
$blogs  = $posts->getList();

if ( ! function_exists( 'get_primary_taxonomy_id' ) ) {
    function get_primary_taxonomy_id( $post_id, $taxonomy ) {
        $prm_term = '';
        if (class_exists('WPSEO_Primary_Term')) {
            $wpseo_primary_term = new WPSEO_Primary_Term( $taxonomy, $post_id );
            $prm_term = $wpseo_primary_term->get_primary_term();
        }
        if ( !is_object($wpseo_primary_term) && empty( $prm_term ) ) {
            $term = wp_get_post_terms( $post_id, $taxonomy );
            if (isset( $term ) && !empty( $term ) ) {
                return wp_get_post_terms( $post_id, $taxonomy )[0]->term_id;
            }
            return '';
        }
        return $wpseo_primary_term->get_primary_term();
    }
}

if($blogs) {
    foreach($blogs as $services) {
        $post_id = $services->ID;
        $tags = get_the_tags($post_id);
        $primary_category = get_primary_taxonomy_id($post_id, 'category');
        $prod = get_term($primary_category, 'category');

        

        $results[$post_id] = [
            'title' => $services->post_title,
            'link' => get_permalink($post_id),
            'post_date' => date("F j, Y", strtotime($services->post_date)),
            'image' => get_field('blog_image', $post_id)
        ];
    }
}

get_header(); ?>

    <div id="page-content" class="page-blocks page-blocks__single-news" data-tpl="single">
        <div class="single-news-inner-wrap">
            <div class="single-news-wrap">
                <div class="single-news-banner">
                    <div class="single-news-banner-inner">
                        <canvas width="1440" height="492"></canvas>
                        <?php if($banner_image):?>
                            <img src="<?= $banner_image['url']?>" alt="<?= $banner_image['alt']?>">
                        <?php else:?>
                            <img src="/wp-content/uploads/2023/11/AdobeStock_610534531-scaled.jpeg" alt="Banner" />
                        <?php endif;?>
                        <?= $FinLink['title'] ?>
                    </div>
                </div>
                <div class="single-news-desc-wrap">
                    <div class="single-news-desc-inner">
                        <div class="single-news-desc-left single-news-desc-col">
                            <div class="single-desc-left-inner">
                                <div class="single-date-tags-auth">
                                    <ul>
                                        <li>
                                            <div class="single-date">
                                                <div class="icon-img">
                                                    <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/date-icon.svg') ?>" alt="View all" />
                                                </div>
                                                <div class="icon-desc">
                                                    <?= get_the_date( ' F j, Y') ;?>
                                                </div>
                                            </div>
                                        </li>
                                        <?php if($post_tags):?>
                                            <li>
                                                <div class="single-date">
                                                    <div class="icon-img">
                                                        <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/tags-icon.svg') ?>" alt="View all" />
                                                    </div>
                                                    <div class="icon-desc">
                                                        <?= $post_tags?>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endif;?>
                                        <li>
                                            <div class="single-date">
                                                <div class="icon-img">
                                                    <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/auth-icon.svg') ?>" alt="View all" />
                                                </div>
                                                <div class="icon-desc">
                                                    <?php if(get_field('blog_author_news_page')):
                                                            $post_data = get_post(get_field('blog_author_news_page'));  
                                                        ?>
                                                        <?= $post_data->post_title?>
                                                    <?php endif;?>
                                                    
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="single-news-title">
                                    <h1><?= get_the_title() ?></h1>
                                </div>
                                <?php if(get_the_excerpt()):?>
                                    <div class="single-inro">
                                        <?= get_the_excerpt()?>
                                    </div>
                                <?php endif;?>
                                <div class="single-news-para">
                                    <?= the_content();?>
                                </div>
                            </div>
                        </div>
                        <div class="single-news-desc-right single-news-desc-col">
                            <div class="single-news-desc-right-inner">
                                <div class="single-news-side">
                                    <div class="single-news-side-item">
                                        <div class="single-news-side-item-inner">
                                            <div class="single-news-side-title">
                                                <?= $SidebarTitle ?>
                                            </div>
                                            <div class="single-news-side-desc">
                                                <?= $SidebarDesc ?>
                                            </div>
                                            <div class="single-news-side-btn">
                                                <a href="<?= $SidebarButton['url'] ?>">
                                                    <?= $SidebarButton['title'] ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-news-side-item">
                                            <?php if(get_field('blog_sidebar_related_page')):
                                                    $post_data_rel = get_post(get_field('blog_sidebar_related_page'));  
                                                ?>
                                                
                                            <?php endif;?>
                                        <div class="single-news-side-item-inner">
                                            <div class="single-news-side-title">
                                                <?= $post_data_rel->post_title?>
                                            </div>
                                            <div class="single-news-side-desc">
                                                <?= $SidebarRelatedDesc ?>
                                            </div>
                                            <div class="single-news-side-form">
                                                <div class="single-news-form">
                                                    <?= do_shortcode('[gravityform id="1" title="true"]')?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-news-side-item">
                                        <?php if(get_field('blog_author_news_page')):
                                                $post_data_team = get_post(get_field('blog_author_news_page'));  
                                                $post_data_img = get_field('team_image', $post_data_team->ID);
                                                $post_data_JD = get_field('team_jd', $post_data_team->ID);
                                                $TeamLink = get_permalink($post_data_team->ID);  
                                            ?>
                                        <?php endif;?>
                                        <div class="single-news-side-item-inner">
                                            <div class="single-news-img">
                                                <img src="<?= $post_data_img['url'] ?>" alt="View all" />
                                            </div>
                                            <div class="single-news-article-by">
                                                Article by <?= $post_data_team->post_title?>
                                            </div>
                                            <div class="single-news-jd">
                                                <?= $post_data_JD ?>
                                            </div>
                                            <div class="single-news-team-link">
                                                <a href="<?= $TeamLink ?>">Learn more about the author</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-team-art" data-sal="slide-up" data-sal-duration="300">
                        <div class="single-team-art-inner single-team-desk">
                            <div class="single-team-art-title">
                                Related Posts
                            </div>
                            <div class="single-team-art-list">
                                <?php if($results) : ?>
                                    <div class="single-team-art-list">
                                        <?php foreach($results as $latestnews):?>
                                            <?php if($latestnews): 
                                                  $categorys = get_primary_category(get_the_ID(), 'category');
                                                ?>
                                                <div class="single-team-art-item">
                                                    <a href="<?= $latestnews['link'] ?>">
                                                        <div class="single-team-art-img">
                                                            <canvas width="357" height="300"></canvas>
                                                            <img src="<?= $latestnews['image']['url'] ?>" alt="View all" />
                                                        </div>
                                                        <div class="single-team-art-desc">
                                                            <div class="single-team-art-cat">
                                                            <?php if($categorys):?>
                                                                <?= $categorys ?>
                                                            <?php endif;?>
                                                            
                                                            </div>
                                                            <div class="single-team-art-item-title">
                                                                <?= $latestnews['title'] ?>
                                                            </div>
                                                            <div class="single-team-art-date">
                                                                <?= $latestnews['post_date'] ?>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="single-team-art-inner single-team-mob">
                            <div class="single-team-art-title">
                                <?= $TeamPostTitle ?>
                            </div>
                            <?php if($results) : ?>
                                <div class="single-team-art-list">
                                    <?php foreach($results as $latestnews):?>
                                        <?php if($latestnews) : 
                                             $categorys = get_primary_category(get_the_ID(), 'category');
                                            ?>
                                            <div class="single-team-art-item">
                                                <a href="<?= $latestnews['link'] ?>">
                                                    <div class="single-team-art-img">
                                                        <canvas width="357" height="300"></canvas>
                                                        <img src="<?= $latestnews['image']['url'] ?>" alt="View all" />
                                                    </div>
                                                    <div class="single-team-art-desc">
                                                        <div class="single-team-art-cat">
                                                        <?php if($categorys):?>
                                                                <?= $categorys ?>
                                                            <?php endif;?>
                                                        </div>
                                                        <div class="single-team-art-item-title">
                                                            <?= $latestnews['title'] ?>
                                                        </div>
                                                        <div class="single-team-art-date">
                                                            <?= $latestnews['post_date'] ?>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <div class="team-col-logo" data-sal="slide-up" data-sal-duration="300">
            <div class="tcl-inner">
            <div class="logos-title">
                    Powered By
                </div>
                <div class="tcl-wrap">
                    

                    <div class="tcl-list">

                    
                    
                    <?php foreach($bottom_logos as $bl){
                        $logo = $bl['blog_team_logo_item']; ?>
                        <div class="tcl-item" data-sal="slide-up" data-sal-duration="300">
                            <img src="<?= $logo['url'] ?>" alt="<?= $logo['alt'] ?>" />
                        </div>
                    <?php } ?>

                    
                    
                    </div>
                </div>
            </div>
        </div>      
    </div>

    <?php get_footer(); ?>