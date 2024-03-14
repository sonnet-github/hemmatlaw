<?php
/**
 * Attorney Testimonials Banner Block Template
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
    $Content = get_field('at_content');
    $BlockID = get_field('block_id');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    $queryHelper = new \SDEV\Helper\Query();
    // $tax_query = ['relation' => 'and'];
    $posts = $queryHelper->setQueryArgs([
        'post_type' => 'attorney_testimonial',
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
        foreach($blogs as $latestnew) {
            $post_id = $latestnew->ID;
            $tags = get_the_tags($post_id);
            $primary_category = get_primary_taxonomy_id($post_id, 'attorney_testimonial_type');
            $prod = get_term($primary_category, 'attorney_testimonial_type');

            

            $results[$post_id] = [
                'title' => $latestnew->post_title,
                'link' => get_permalink($post_id),
                'content' => get_the_content(null, null, $post_id),
                'jd' => get_field('at_job_description', $post_id),
                'star' => get_field('at_star', $post_id),
                'image' => get_field('at_image', $post_id)
            ];
        }
    }

    $aspect_ratio = ($banner_height / 1440) * 100;

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__at';
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
        <div class="at-inner">
            <div class="at-wrap" data-sal="slide-up" data-sal-duration="300">
                <div class="at-top">
                    <div class="at-top-right">
                        <div class="at-title">
                            <h2>
                                Attorney testimonials 
                            </h2>
                        </div>
                        <div class="at-desc">
                            <?= $Content ?>
                        </div>
                    </div>
                    <div class="at-top-left">
                        <div class="at-btn">
                            <div class="global-btn global-btn-green">
                                <a href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="at-bot">
                <?php if($results) : ?>
                    <div class="at-list">
                        <?php foreach($results as $at):?>
                            <?php if($at) : ?>
                                <div class="at-item <?= $at['star'] ?>" >
                                    <div class="at-item-inner">
                                        <div class="at-item-wrap">
                                            <div class="at-item-star">
                                                <div class="at-item-stars at-item-star-one">
                                                    <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/one-star.png') ?>" alt="View all" />
                                                </div>
                                                <div class="at-item-stars at-item-star-two">
                                                    <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/two-star.png') ?>" alt="View all" />
                                                </div>
                                                <div class="at-item-stars at-item-star-three">
                                                    <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/three-star.png') ?>" alt="View all" />
                                                </div>
                                                <div class="at-item-stars at-item-star-four">
                                                    <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/four-star.png') ?>" alt="View all" />
                                                </div>
                                                <div class="at-item-stars at-item-star-five">
                                                    <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/five-star.png') ?>" alt="View all" />
                                                </div>
                                            </div>
                                            <div class="at-item-desc">
                                                <?= $at['content'] ?>
                                            </div>
                                            <div class="at-img-name-jd">
                                                <div class="at-img">
                                                    <img src="<?= $at['image']['url'] ?>" alt="View all" />
                                                </div>
                                                <div class="at-name-jd">
                                                    <div class="at-name"><?= $at['title'] ?></div>
                                                    <div class="at-jd"><?= $at['jd'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                    <div class="at-btn">
                        <div class="global-btn global-btn-green">
                            <a href="/mediation">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>