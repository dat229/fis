<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package fis
 */

get_header();
?>
<main>
    <section class="bg-blue page__breadcrumb">
        <div class="container">
            <?php get_template_part('components/section/breadcrumb') ?>
        </div>
    </section>
    <section class="detail__page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="detail__page-content">
                        <?php
                        $term_list = wp_get_post_terms(get_the_ID(), 'category', array('fields' => 'all')); ?>
                        <?php if ($term_list != null) { ?>
                            <div class="page__content-tags mb-20">
                                <?php foreach ($term_list as $term) : ?>
                                    <a href="<?php echo get_term_link($term) ?>">
                                        <?php echo $term->name ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php }
                        ?>
                        <h1 class="page-title">
                            <?php the_title() ?>
                        </h1>
                        <div class="desc ws-sgct">
                            <?php the_content() ?>
                        </div>
                        <div class="detail__page-bottom">
                            <?php
                            $term_list = wp_get_post_terms(get_the_ID(), 'post_tag', array('fields' => 'all')); ?>
                            <?php if ($term_list != null) { ?>
                                <div class="page__content-tags">
                                    <span class="pe-5 fw-bold"><?php _e('Tags', 'fis') ?>:</span>
                                    <?php foreach ($term_list as $term) : ?>
                                        <a href="<?php echo get_term_link($term) ?>">
                                            <?php echo $term->name ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php }
                            ?>
                            <?php echo get_template_part('components/section/share') ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 ">
                    <div class="detail__page-right">
                        <div class="post__author">
                            <?php echo get_template_part('components/section/author') ?>
                            <div class="d-flex justify-content-between align-items-center post__author-info">
                                <p class="date">
                                    <?php _e('Ngày', 'fis') ?> <?php echo get_the_date("d/m/y") ?>
                                </p>
                                <?php echo get_template_part('components/section/share') ?>
                            </div>
                        </div>
                        <?php
                        $title = get_field('cdtt_tag_title', 'option');
                        $cdtt_tag_select = get_field('cdtt_tag_select', 'option');
                        if ($cdtt_tag_select) : ?>
                            <div class="tags__popular">
                                <?php if ($title) { ?>
                                    <h3 class="title">
                                        <?php echo $title ?>
                                    </h3>
                                <?php } ?>
                                <div class="page__content-tags">
                                    <?php foreach ($cdtt_tag_select as $term) : ?>
                                        <a href="<?php echo esc_url(get_term_link($term)); ?>">
                                            #<?php echo esc_html($term->name); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php
                        $baiviet = get_field('cdtt_post_baiviet', 'option');
                        $style_post = $baiviet['select'];
                        $display = $baiviet['display_category'];
                        $custom_taxterms = $baiviet['danh_muc'];
                        $linh_vuc = $baiviet['linh_vuc'];
                        $nang_luc = $baiviet['nang_luc'];
                        $tag = $baiviet['tag'];
                        $bvnb = $baiviet['bvnb'];
                        $number = $baiviet['number'];
                        $tax_query = array('relation' => 'AND');
                        if ($custom_taxterms) {
                            $tax_query[] =  array(
                                'taxonomy' => 'category',
                                'field' => 'id',
                                'terms' => $custom_taxterms
                            );
                        }
                        if ($linh_vuc) {
                            $tax_query[] =  array(
                                'taxonomy' => 'linh_vuc',
                                'field' => 'id',
                                'terms' => $linh_vuc
                            );
                        }
                        if ($nang_luc) {
                            $tax_query[] =  array(
                                'taxonomy' => 'nang_luc',
                                'field' => 'id',
                                'terms' => $nang_luc
                            );
                        }
                        $meta_query = array('relation' => 'AND');
                        if ($bvnb) {
                            $meta_query[] =  array(
                                'key'       => 'bvnb',
                                'value'     => '1',
                                'compare'   => '=',
                            );
                        }
                        $args = array(
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'posts_per_page' => $number,
                            'meta_query' => $meta_query,
                            'tax_query' => $tax_query,
                        );
                        $related_items = new WP_Query($args);
                        if ($related_items->have_posts()) : ?>
                            <div class="detail__page-related mt-5">
                                <div class="post__related-list">
                                    <?php while ($related_items->have_posts()) : $related_items->the_post();
                                    ?>
                                        <?php get_template_part(
                                            'template-parts/content',
                                            get_post_type(),
                                            array(
                                                'display_category' => $baiviet['display_category'],
                                            )
                                        ); ?>
                                    <?php
                                    endwhile; ?>
                                </div>
                            </div>
                        <?php endif;
                        wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    $term_list = wp_get_post_terms(get_the_ID(), 'category', array('fields' => 'all'));
    $url_cat = get_term_link($term_list[0]);
    $custom_taxterms = wp_get_object_terms($post->ID, 'category', array('fields' => 'ids'));
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'orderby' => 'rand',
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'id',
                'terms' => $custom_taxterms
            )
        ),
        'post__not_in' => array($post->ID),
    );
    $related_items = new WP_Query($args);
    if ($related_items->have_posts()) : ?>
        <section class="post__related pt-0">
            <div class="container">
                <div class="post__related-heading d-flex align-center justify-content-between mb-50">
                    <h4 class="heading-title text-start blue-color">
                        <?php _e('Tin liên quan', 'fis') ?>
                    </h4>
                    <?php if ($url_cat) { ?>
                        <div class="button-link no-bg">
                            <a href="<?php echo $url_cat ?>">
                                <?php _e('Xem thêm', 'fis') ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <div class="row g-5">
                    <?php while ($related_items->have_posts()) : $related_items->the_post();
                    ?>
                        <div class="col-lg-4 col-md-6">
                            <?php get_template_part('template-parts/content', get_post_type()); ?>
                        </div>
                    <?php
                    endwhile; ?>
                </div>
            </div>
        </section>
    <?php endif;
    wp_reset_postdata(); ?>
    <?php echo get_template_part('components/form__contact', '', array(
        'global' => true
    )) ?>
</main>



<?php
get_footer();
