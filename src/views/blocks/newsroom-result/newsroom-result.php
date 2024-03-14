<?php
/**
 * Newsroom Block Template
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
    $categorys = get_primary_category(get_the_ID(), 'category');
    $BlockID = get_field('block_id');
    $Title = get_field('tcwi_title');
    $Description = get_field('tcwi_description');
    $ButtonOne = get_field('tcwi_one_button');
    $ButtonTwo = get_field('tcwo_two_button');
    $PaID = get_field('block_id');
    $Image = get_field('tcwI_image');
    $banner_height = get_field('banner_height') ?: 654;

    $filter_title = isset($_GET['st']) ? $_GET['st'] : false;

    $aspect_ratio = ($banner_height / 1440) * 100;

    $queryHelper = new \SDEV\Helper\Query();
    // $tax_query = ['relation' => 'and'];

    $posts = $queryHelper->setQueryArgs([
        'post_type' => 'post',
        'post_status' => 'publish'
    ]);

    $posts->setOrder('date', 'desc');
    $posts->setPageSize(99999);
    $posts->setPage(1);
    if($filter_title && !empty($filter_title)){
        $posts->setSearch($filter_title);
        var_dump($filter_title);
    }
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

    $ln_parent_terms = get_terms(array(
        'taxonomy' => 'category',
        'parent' => 0,
        'hide_empty' => false) 
    );

    $cp = isset($_GET['cp']) ? $_GET['cp'] : 1;

    $terms = get_terms( 'category' ); 
    

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__news';
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
    <div class="news-backdrop"></div>
        <div class="news-top">
            <div class="news-inner">
                <div class="news-top-inner">
                    <div class="news-title">
                        <h2>Newsroom</h2>
                    </div>
                    <div class="news-drop-sel">
                        <div class="news-drop-sel-inner">
                            <div class="news-search">
                                <div class="news-search-inner">
                                    <form action="/newsroom/" method="get">
                                        <input type="text" name="st" id="search" placeholder="Search" value="<?= $filter_title ? $filter_title : ''?>">
                                        <?php if($filter_title):?>
                                            <a href="/newsroom/"><i class="fas fa-times"></i></a>
                                        <?php endif;?>
                                        <div class="ar-search-magni">
                                            <button type="submit" class="site-search-submit" aria-label="Search">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="news-select">
                                <div class="select" name="tidate" id="tidate">
                                    <div class="selectBtn" data-value="title|asc">Categories</div>
                                    <div class="selectDropdown" name="orderby" id="orderby">
                                        <div class="option">
                                            <a href="#" class="all-news">
                                                Latest News
                                            </a>
                                        </div>
                                        <?php $filter_terms = $terms; ?>
                                        <?php foreach($filter_terms as $c) : ?>
                                            
                                            <div class="option <?= $c->slug  ?>">
                                                
                                                <a href="/blog/?sc=<?= $c->slug  ?>">
                                                    <?= $c->name ?>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="news-drop">
                    <div class="news-drop-inner">
                        <div class="news-cat">
                            <div class="news-cat-drop">
                                <div class="single-team-art">
                                    <div class="single-team-art-inner">
                                        <div class="single-team-art-list latest-news single-not-slick">
                                        <?php 
                                            echo '<h2>Latest News</h2>';
                                            $queryHelper = new \SDEV\Helper\Query();
                                            // query mo ung posts 
                                            $posts = $queryHelper->setQueryArgs([
                                                'post_type' => 'post',
                                                'post_status' => 'publish'
                                            ])
                                            ->setOrder('date', 'desc')
                                            ->setPageSize(9)
                                            ->setPage($cp);
                                                
                                            if($filter_title && !empty($filter_title)){
                                                $posts->setSearch($filter_title);
                                            }
                                            $posts = $posts->getList();
                                            ?>
                                            <div class="single-team-art-not-slick">
                                                <?php 
                                                    foreach($posts as $p) : 
                                                    // dito na yung details
                                                            $title = get_the_title($p->ID);
                                                            $permalink = get_permalink($p->ID);
                                                            $date = get_the_date("F j, Y", $p->ID);
                                                            $thumbnail = get_field('blog_image', $p->ID);
                                                            
                                                        if($p) : ?>
                                                            <div class="single-team-art-item" id="<?= $rbName?>">
                                                                <a href="<?= $permalink ?>">
                                                                    <div class="single-team-art-img">
                                                                        <canvas width="357" height="300"></canvas>
                                                                        <img src="<?= $thumbnail['url'] ?>" alt="View all" />
                                                                    </div>
                                                                    <div class="single-team-art-desc">
                                                                        <div class="single-team-art-cat">
                                                                            Latest News
                                                                        </div>
                                                                        <div class="single-team-art-item-title">
                                                                            <?= $title ?>
                                                                        </div>
                                                                        <div class="single-team-art-date">
                                                                            <?= $date ?>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        <?php else:?>
                                                            <h2 class="bl-messge">No results found.</h2>
                                                        <?php endif;
                                                    endforeach; 
                                                ?>
                                            </div>
                                            <div class="pagination-wrapper">
                                                <?php
                                                $query = $queryHelper->getQuery();
                                                $total_pages = $query->max_num_pages;
                                            
                                                if ($total_pages > 1) {
                                                    echo paginate_links([
                                                        'base' => '?cp=%#%',
                                                        "format" => "",
                                                        "current" => max(1, $cp),
                                                        "total" => $total_pages,
                                                        "show_all" => false,
                                                        "end_size" => 2,
                                                        "mid_size" => 3,
                                                        "prev_next" => true,
                                                        "prev_text" => __("Previous"),
                                                        "next_text" => __("Next"),
                                                    ]);
                                                }
                                                ?>
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
        <div class="news-bot">
            <div class="news-bot-wrap"></div>
        </div>
    </div>

<?php endif; ?>