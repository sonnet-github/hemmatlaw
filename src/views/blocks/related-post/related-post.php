<?php
/**
 * Related Post Block Template
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

    // Get acf fields value and set default
    $related_posts = get_field('related_category');
    $layout = get_field('banner_layout') ?: 'default';
    $banner = get_field('banner_image');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    $queryHelper = new \SDEV\Helper\Query();
    

    $final_related_posts = ($related_posts) ? $related_posts : [];
    $rp_count = ($related_posts) ? sizeOf($related_posts) : 0; 
    $post_ids = [];

    if($related_posts){
        foreach($related_posts as $rp){
            $post_ids[] = $rp->ID;
        }
    }

    if($rp_count < 3){
        $page_size = 3 - $rp_count;
        $posts = $queryHelper->setQueryArgs([
            'post_type' => 'post',
            'post_status' => 'publish',
            'post__not_in' => $post_ids
        ]);

        $primary_tax = get_primary_taxonomy_id(get_the_ID(), 'category');

        $posts->setTaxQuery([
            'relation' => 'and',
            [
                'taxonomy'  => 'category',
                'field'     => 'term_id',
                'terms'     => [$primary_tax],
            ]
        ]);
        $posts->setOrder('rand', 'desc');
        $posts->setPageSize($page_size);
        $posts->setPage(1);
        $blogs = $posts->getList();
        $results_size = ($blogs) ? sizeOf($blogs) : 0;

        if($blogs) {
            foreach($blogs as $b) {
                $final_related_posts[] = $b;
                $post_ids[] = $b->ID;
            }
        }

        $total_related = ($final_related_posts) ? sizeOf($final_related_posts) : 0;

        if($total_related < 3){
            $page_size = 3 - $total_related;
            $posts = $queryHelper->setQueryArgs([
                'post_type' => 'post',
                'post_status' => 'publish',
                'post__not_in' => $post_ids
            ]);
            $posts->setOrder('date', 'desc');
            $posts->setPageSize($page_size);
            $posts->setPage(1);
            $blogs  = $posts->getList();
            if($blogs) {
                foreach($blogs as $b) {
                    $final_related_posts[] = $b;
                    $post_ids[] = $b->ID;
                }
            }
        }
    }

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__related-post';
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

    <div class="block--custom-layout <?= $class_name ?>" id="<?= $BlockId ?>" <?= $anchor ?>>
        <div class="related-post-inner">
            <div class="related-post-title">
            <h2>These blogs may be of interest to you.</h2>
            </div>
                <div class="related-post">
                    <div class="related-post-inners related-post-desk">
                        <div class="related-post-list">
                            <?php foreach($final_related_posts as $relatedP):
                                        $image = get_field('blog_image', $relatedP->ID);
                                        $date = get_the_date( ' F j, Y', $relatedP->ID);
                                        $terms = get_the_terms($relatedP->ID, 'category');
                                        $link = get_permalink($relatedP->ID); 
                                        $title = get_the_title($relatedP->ID);
                                    ?>
                                    
                                    <div class="related-post-item">
                                        <a href="<?php echo $link?>">
                                        <div class="related-post-inner">
                                                <div class="related-post-img">
                                                    <canvas width="334" height="300"></canvas>
                                                    <img src="<?= $image['url'] ?>" alt="View all" />
                                                </div>
                                                <div class="related-post-desc">
                                                    <div class="related-post-cat">
                                                        <?php if($terms){echo $terms[0]->name;}?>
                                                    </div>
                                                    <div class="related-post-item-title">
                                                        <?= $title ?>
                                                    </div>
                                                    <div class="related-post-date">
                                                        <?= $date ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                            <?php endforeach;?>
                        </div>
                    </div>

                    <div class="related-post-inners related-post-mob">
                        <div class="related-post-list">
                                <?php foreach($final_related_posts as $relatedP):
                                        $image = get_field('blog_image', $relatedP->ID);
                                        $date = get_the_date( ' F j, Y', $relatedP->ID);
                                        $terms = get_the_terms($relatedP->ID, 'category');
                                        $link = get_permalink($relatedP->ID); 
                                        $title = get_the_title($relatedP->ID);
                                    ?>
                                    <div class="related-post-item">
                                        <a href="<?php echo $link?>">
                                        <div class="related-post-inner">
                                                <div class="related-post-img">
                                                    <canvas width="334" height="300"></canvas>
                                                    <img src="<?= $image['url'] ?>" alt="View all" />
                                                </div>
                                                <div class="related-post-desc">
                                                    <div class="related-post-cat">
                                                        <?php if($terms){echo $terms[0]->name;}?>
                                                    </div>
                                                    <div class="related-post-item-title">
                                                    <?= $title ?>
                                                    </div>
                                                    <div class="related-post-date">
                                                        <?= $date ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php endif; ?>