<?php
/**
 * Our Team Boxes Block Template
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
    $Title = get_field('tcib_title');
    $PaID = get_field('block_id');
    $Description = get_field('tcib_description');
    $Button = get_field('tcib_button');
    $Image = get_field('tcib_image');
    $banner_height = get_field('banner_height') ?: 654;

    $aspect_ratio = ($banner_height / 1440) * 100;

    $queryHelper = new \SDEV\Helper\Query();
    // $tax_query = ['relation' => 'and'];
    $posts = $queryHelper->setQueryArgs([
        'post_type' => 'team',
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
            $primary_category = get_primary_taxonomy_id($post_id, 'team_type');
            $prod = get_term($primary_category, 'team_type');

            

            $results[$post_id] = [
                'title' => $latestnew->post_title,
                'link' => get_permalink($post_id),
                'jd' => get_field('team_jd', $post_id),
                'delay' => get_field('team_animation_delay', $post_id),
                'image' => get_field('team_image', $post_id)
            ];
        }
    }

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__team';
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

    <div class="block--custom-layout <?= $class_name ?>" id="<?= $PaID ?>" <?= $anchor ?>>
        <div class="team-inner">
            <div class="team-wrap">
                <div class="team-title" data-sal="slide-right" data-sal-duration="300">
                    <h2>The <span>Hemmat</span> Law Team</h2>
                </div>
                <?php if($results) : ?>
                    <div class="team-list">
                        <?php foreach($results as $team):?>
                            <?php if($team) : ?>
                                <div class="team-item" data-sal="slide-right" data-sal-duration="300" data-sal-delay="<?= $team['delay'] ?>">
                                    <a href="<?= $team['link'] ?>">
                                        <div class="team-img">
                                            <canvas width="380" height="425"></canvas>
                                            <img src="<?= $team['image']['url'] ?>" alt="View all" />
                                        </div>
                                        <div class="team-desc">
                                            <div class="team-name">
                                                <?= $team['title'] ?>
                                            </div>
                                            <div class="team-jd-and-btn">
                                                <div class="team-jd"><?= $team['jd'] ?></div>
                                                <div class="team-btn">
                                                    <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/team-arrow.svg') ?>" alt="View all" />
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <div class="team-last-img" data-sal="slide-right" data-sal-duration="300">
                            <div class="team-join">
                                <div class="team-join-inner">
                                    <div class="team-join-img"><canvas width="1440" height="535" style="background-image: url('/wp-content/uploads/2024/01/Meet-the-team-scaled.jpeg')"></canvas></div>
                                    <div class="team-join-desc-wrap">
                                        <div class="team-join-title">
                                            <h2>Join The Team</h2>
                                        </div>
                                        <div class="team-join-desc">
                                            <p>We believe the law should be a force for good-for our clients and our team members</p>
                                        </div>
                                        <div class="team-join-btn global-btn global-btn-green">
                                            <a href="/careers/">Join The Team</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php endif; ?>