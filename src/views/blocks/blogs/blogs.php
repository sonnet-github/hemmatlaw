<?php
/**
 * Blogs Block Template
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
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    $queryHelper = new \SDEV\Helper\Query();
    // $tax_query = ['relation' => 'and'];
    $posts = $queryHelper->setQueryArgs([
        'post_type' => 'post',
        'post_status' => 'publish'
    ]);

    // $posts->setTaxQuery($tax_query);

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
        foreach($blogs as $latestnew) {
            $post_id = $latestnew->ID;
            $tags = get_the_tags($post_id);
            $primary_category = get_primary_taxonomy_id($post_id, 'category');
            $prod = get_term($primary_category, 'category');

            

            $results[$post_id] = [
                'title' => $latestnew->post_title,
                'link' => get_permalink($post_id),
                'content' => get_field('short_details', $post_id),
                'image' => get_field('blog_image', $post_id)
            ];
        }
    }

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__blogs';
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
        <div class="blogs-inner">
            <div class="blogs-title">
                <h2>These blogs may be of interest to you.</h2>
            </div>
            <div class="blogs-wrap blog-desk">
            <?php if($results) : ?>
                <div class="blogs-list">
                    <?php foreach($results as $latestnews):?>
                        <?php if($latestnews) : ?>
                            <div class="blogs-item">
                                <div class="blogs-inner">
                                    <div class="blogs-img">
                                        <canvas width="357" height="300"></canvas>
                                        <img src="<?= $latestnews['image']['url'] ?>" alt="View all" />
                                    </div>
                                    <div class="blogs-desc">
                                        <div class="blogs-title-item">
                                            <?= $latestnews['title'] ?>
                                        </div>
                                        <div class="blogs-para">
                                            <p><?= $latestnews['content'] ?></p>
                                        </div>
                                        <div class="blogs-btn">
                                            <a href="<?= $latestnews['link'] ?>">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            </div>
            <div class="blogs-wrap blog-mob">
            <?php if($results) : ?>
                <div class="blogs-list">
                    <?php foreach($results as $latestnews):?>
                        <?php if($latestnews) : ?>
                            <div class="blogs-item">
                                <div class="blogs-inner">
                                    <div class="blogs-img">
                                        <canvas width="357" height="300"></canvas>
                                        <img src="<?= $latestnews['image']['url'] ?>" alt="View all" />
                                    </div>
                                    <div class="blogs-desc">
                                        <div class="blogs-title-item">
                                            <?= $latestnews['title'] ?>
                                        </div>
                                        <div class="blogs-para">
                                            <p><?= $latestnews['content'] ?></p>
                                        </div>
                                        <div class="blogs-btn">
                                            <a href="<?= $latestnews['link'] ?>">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </div>

<?php endif; ?>