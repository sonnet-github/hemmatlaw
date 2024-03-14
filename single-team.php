<?php 
/* Template Name: Single Team Template
 * Template Team Type: team, page
 */
/**
 * Single Team Default template
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */

    $BlogList = get_field('team_post');
    $category = get_primary_category(get_the_ID(), 'category');
    $categorywrap = get_the_terms(get_the_ID(), 'category');
    $Img = get_field('team_image');
    $JD = get_field('team_jd');
    $TeamTopDesc = get_field('team_top_description');
    $TeamTopSpec = get_field('team_top_specialist');
    $TeamEXPRightTitle = get_field('team_exp_right_title');
    $TeamEXPRightList= get_field('team_exp_right_list');
    $TeamSideContactTitle = get_field('team_sidebar_contact_title');
    $TeamSideLink = get_field('team_sidebar_link');
    $TeamSideAdd = get_field('team_sidebar_address');
    $TeamSideFormTitle = get_field('team_sidebar_form_title');
    $TeamPostTitle = get_field('team_post_title');
    $TeamBotLogo = get_field('team_bottom_logos');
    $bottom_logos = get_field('team_bottom_logos', get_the_ID());
    

    $queryHelper = new \SDEV\Helper\Query();
    // $tax_query = ['relation' => 'and'];
    $posts = $queryHelper->setQueryArgs([
        'post_type' => 'post',
        'post_status' => 'publish'
    ]);

    $posts->setOrder('date', 'desc');
    $posts->setPageSize(-1);
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
                'content' => get_field('service_short_details', $post_id),
                
                'image' => get_field('service_image', $post_id)
            ];
        }
    }

    get_header(); ?>

        <div id="page-content" class="page-blocks page-blocks__single" data-tpl="single">

            <div class="single-team-wrap">
                <div class="single-team-section">
                    <div class="single-team-section-inner">
                        <div class="single-team-col single-team-left">
                            <div class="single-team-left-inner">
                                <div class="single-team-img">
                                    <canvas width="389" height="486"></canvas>
                                    <img src="<?= $Img['url'] ?>" alt="View all" />
                                </div>
                            </div>
                        </div>
                        <div class="single-team-col single-team-right">
                            <div class="single-team-right-inner">
                                <div class="single-team-name">
                                    <?= get_the_title() ?>
                                </div>
                                <div class="single-team-jd">
                                    <?= $JD ?>
                                </div>
                                <div class="single-team-desc">
                                    <?= $TeamTopDesc ?>
                                </div>
                                <div class="single-team-spe-list">
                                    <?= $TeamTopSpec ?>
                                </div>
                                <div class="single-form">
                                    <div class="hero-form-inner">
                                        <div class="hero-gf-form">
                                            <?= do_shortcode('[gravityform id="6" title="true"]')?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="single-team-exp">
                    <div class="single-exp-inner">
                        <div class="single-exp-col single-exp-left">
                            <div class="single-exp-left-inner">
                                <div class="single-exp-edu">    
                                    <?php if( get_field('team_exp_logos') ): ?>
                                        <?php if( have_rows('team_exp_logos') ): ?>
                                            <div class="single-exp-list">
                                                <?php while( have_rows('team_exp_logos') ): the_row();
                                                    $teamEXPTitle = get_sub_field('team_exp_title');
                                                    ?>
                                                    <div class="single-exp-item">
                                                        <div class="single-exp-item-title">
                                                            <?= $teamEXPTitle ?>
                                                        </div>
                                                        <?php if( get_sub_field('team_exp_logo_item') ): ?>
                                                            <?php if( have_rows('team_exp_logo_item') ): ?>
                                                                <div class="single-exp-logo-with-title">
                                                                    <?php while( have_rows('team_exp_logo_item') ): the_row();
                                                                        $teamEXPLogoItem = get_sub_field('team_exp_image');
                                                                        $teamEXPLogoItemImg = get_sub_field('team_exp_title');
                                                                        ?>
                                                                        <div class="single-exp-logo-item">
                                                                            <div class="single-exp-logo">
                                                                                <img src="<?= $teamEXPLogoItem['url'] ?>" alt="View all" />
                                                                            </div>
                                                                            <div class="single-exp-logo-title">
                                                                                <?= $teamEXPLogoItemImg ?>
                                                                            </div>
                                                                        </div>
                                                                    <?php endwhile; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endwhile; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="single-arrows">
                                        <div class="single-arrow-prev">
                                            <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/arrow-edu.png') ?>" alt="View all" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-exp-col single-exp-right">
                            <div class="single-exp-right-inner">
                                <div class="single-exp-arrow-down">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="single-exp-title">
                                    <?= $TeamEXPRightTitle ?>
                                </div>
                                <div class="single-exp-right-list">
                                    <?= $TeamEXPRightList ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="single-team-bio">
                    <div class="single-team-bio-inner">
                        <div class="single-bio-wrap">
                            <div class="single-bio-col single-bio-left">
                                <div class="single-bio-left-inner">
                                    <?= the_content();?>
                                </div>
                            </div>
                            <div class="single-bio-col single-bio-right">
                                <div class="single-bio-right-inner">
                                    <div class="single-bio-sidebar">
                                        <div class="single-bio-side-item">
                                            <div class="single-bio-side-item-inner">
                                                <div class="single-bio-side-title">
                                                    <?= $TeamSideContactTitle ?>
                                                </div>
                                                <div class="single-bio-phone">
                                                    <a href="<?= $TeamSideLink['url'] ?>"><?= $TeamSideLink['title'] ?></a>
                                                </div>
                                                <div class="single-bio-address">
                                                    <?= $TeamSideAdd ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-bio-side-item">
                                            <div class="single-bio-side-item-inner">
                                                <div class="single-bio-side-title">
                                                    <?= $TeamSideFormTitle ?>
                                                </div>
                                                <div class="single-bio-side-form">
                                                    <?= do_shortcode('[gravityform id="8" title="true"]')?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php if([$BlogList]):?>
                <div class="single-team-art">
                    <div class="single-team-art-inner single-team-desk">
                        <div class="single-team-art-title">
                            <?= $TeamPostTitle ?>
                        </div>
                        <div class="single-team-art-list">
                                <?php foreach($BlogList as $post):?>
                                    <?php if($post['post_newsroom']):
                                        $post_data = get_post($post['post_newsroom']);  
                                        $link = get_permalink($post['post_newsroom']);  
                                        $image = get_field('blog_image', $post['post_newsroom']);
                                        $date = get_the_date( ' F j, Y', $post['post_newsroom']);
                                        $terms = get_the_terms($post['post_newsroom'], 'category');
                                    ?>
                                    
                                    <div class="single-team-art-item">
                                        <a href="<?php echo $link?>">
                                            <div class="single-team-art-img">
                                                <canvas width="334" height="300"></canvas>
                                                <img src="<?= $image['url'] ?>" alt="View all" />
                                            </div>
                                            <div class="single-team-art-desc">
                                                <div class="single-team-art-cat">
                                                    <?php if($terms){echo $terms[0]->name;}?>
                                                </div>
                                                <div class="single-team-art-item-title">
                                                    <?= $post_data->post_title?>
                                                </div>
                                                <div class="single-team-art-date">
                                                    <?= $date ?>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <?php endif;?>
                                <?php endforeach;?>
                        </div>
                    </div>
                    <?php endif;?>  

                    <?php if([$BlogList]):?>
                    <div class="single-team-art-inner single-team-mob">
                        <div class="single-team-art-title">
                            <?= $TeamPostTitle ?>
                        </div>
                        <div class="single-team-art-list">
                           
                                <?php foreach($BlogList as $post):?>
                                    <?php if($post['post_newsroom']):
                                        $post_data = get_post($post['post_newsroom']);  
                                        $link = get_permalink($post['post_newsroom']);  
                                        $image = get_field('blog_image', $post['post_newsroom']);
                                        $date = get_the_date( ' F j, Y', $post['post_newsroom']);
                                        $terms = get_the_terms($post['post_newsroom'], 'newsroom-type');
                                    ?>
                                    
                                    <div class="single-team-art-item">
                                        <a href="<?php echo $link?>">
                                            <div class="single-team-art-img">
                                                <canvas width="334" height="300"></canvas>
                                                <img src="<?= $image['url'] ?>" alt="View all" />
                                            </div>
                                            <div class="single-team-art-desc">
                                                <div class="single-team-art-cat">
                                                    <?php if($terms){echo $terms[0]->name;}?>
                                                </div>
                                                <div class="single-team-art-item-title">
                                                    <?= $post_data->post_title?>
                                                </div>
                                                <div class="single-team-art-date">
                                                    <?= $date ?>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <?php endif;?>
                                <?php endforeach;?>
                            
                        </div>
                    </div>
                </div>
                <?php endif;?>                 
                

            </div>

            <div class="team-col-logo">
                <div class="tcl-inner">
                <div class="logos-title">
                    Powered By
                </div>
                    <div class="tcl-wrap">
                        
 
                        <div class="tcl-list">

                        
                        
                        <?php foreach($bottom_logos as $bl){
                            $logo = $bl['team_logo_bottom_item'];
                            $LogoLink = $bl['team_logo_link']; ?>
                            
                            <div class="tcl-item" data-sal="slide-up" data-sal-duration="800">
                                <a href="<?= $LogoLink ? $LogoLink['url'] : '#' ?>" target="_blank">
                                    <img src="<?= $logo['url'] ?>" alt="<?= $logo['alt'] ?>" />
                                </a>
                            </div>
                        <?php } ?>

                        
                        
                        </div>
                    </div>
                </div>
            </div>
        
        </div>

    <?php get_footer(); ?>