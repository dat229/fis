<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package fis
 */

get_header();
?>

<?php
if (isset($_GET['post_type'])) {
    $post_type_name = $_GET['post_type'];
} else {
    $post_type_name = 'any';
}
?>
<section class="block__product block__product-customer mt-5">
    <div class="block__product-heading position-relative section-space bg-white pt-0">
        <div class="container position-relative">
            <h2 class="heading-title text-lg-start text-center blue-color ">
                <?php echo __('Kết quả tìm kiếm cho:', 'fis') . ' ' . get_search_query() ?>
            </h2>
        </div>
    </div>
    <div class="block__product-search block__product-filter bg-blue padding-section gnws-xemthem-wrap_all_total">
        <div class="container">
            <form action="<?php echo get_home_url() ?>">
                <div class="block__product-label">
                    <?php _e('Tìm kiếm', 'fis') ?>
                </div>
                <div class="block__product-input gnws_form-search_ajax">
                    <input type="text" class="input-search gnws_value-search_ajax" name="s" placeholder="<?php _e('Nhập nội dung bạn muốn tìm kiếm', 'fis') ?>" value="<?php echo get_search_query() ?>">
                    <input type="hidden" name="post_type" value="<?php echo $post_type_name ?>">
                    <button type="button" class="button-link gnws_button-search_ajax">
                        <span>
                            <?php _e('Search', 'fis') ?>
                            <?php echo svg('search', '24', '24') ?>
                        </span>
                    </button>
                </div>
            </form>
            <div class="block__product-list">
                <div class="row gx-5">
                    <div class="col-lg-3">
                        <div class="block__product-sidebar gnws-xemthem-wrap_all_total_filter">
                            <?php
                            $nang_luc = array();
                            $taxonomies = get_terms(array(
                                'taxonomy' => 'nang_luc',
                                'hide_empty' => false
                            ));

                            if (!empty($taxonomies)) :
                            ?>
                                <div class="filter-item" data-filter="nang_luc">
                                    <h4 class="title">
                                        <?php _e('Chủ đề', 'fis') ?>
                                    </h4>
                                    <div class="list__filter">
                                        <?php
                                        $i = 0;
                                        foreach ($taxonomies as $category) {
                                            $i++;
                                            $nang_luc[] = $category->term_id;
                                        ?>
                                            <div class="form-group ">
                                                <input class="gnws-xemthem-wrap_all_total_select" type="checkbox" name="nang_luc" value="<?php echo $category->term_id ?>" id="<?php echo $category->term_id ?>">
                                                <label for="<?php echo $category->term_id ?>"><?php echo $category->name ?></label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php
                            $linh_vuc = array();
                            $taxonomies = get_terms(array(
                                'taxonomy' => 'linh_vuc',
                                'hide_empty' => false
                            ));

                            if (!empty($taxonomies)) :
                            ?>
                                <div class="filter-item" data-filter="linh_vuc">
                                    <h4 class="title">
                                        <?php _e('Lĩnh vực', 'fis') ?>
                                    </h4>
                                    <div class="list__filter">
                                        <?php
                                        $i = 0;
                                        foreach ($taxonomies as $category) {
                                            $i++;
                                            $linh_vuc[] = $category->term_id;
                                        ?>
                                            <div class="form-group">
                                                <input class="gnws-xemthem-wrap_all_total_select" type="checkbox" name="linh_vuc" value="<?php echo $category->term_id ?>" id="<?php echo $category->term_id ?>">
                                                <label for="<?php echo $category->term_id ?>"><?php echo $category->name ?></label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php
                            $dich_vu = array();
                            $taxonomies = get_terms(array(
                                'taxonomy' => 'dich_vu',
                                'hide_empty' => false
                            ));
                            if (!empty($taxonomies)) :
                            ?>
                                <div class="filter-item" data-filter="dich_vu">
                                    <h4 class="title">
                                        <?php _e('Dịch vụ', 'fis') ?>
                                    </h4>
                                    <div class="list__filter">
                                        <?php
                                        $i = 0;
                                        foreach ($taxonomies as $category) {
                                            $i++;
                                            $dich_vu[] = $category->term_id;
                                        ?>
                                            <div class="form-group">
                                                <input class="gnws-xemthem-wrap_all_total_select" type="checkbox" name="dich_vu" value="<?php echo $category->term_id ?>" id="<?php echo $category->term_id ?>">
                                                <label for="<?php echo $category->term_id ?>"><?php echo $category->name ?></label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php
                            $san_pham = array();
                            $taxonomies = get_terms(array(
                                'taxonomy' => 'san_pham',
                                'hide_empty' => false
                            ));

                            if (!empty($taxonomies)) :
                            ?>
                                <div class="filter-item" data-filter="san_pham">
                                    <h4 class="title">
                                        <?php _e('Sản phẩm', 'fis') ?>
                                    </h4>
                                    <div class="list__filter">
                                        <?php
                                        $i = 0;
                                        foreach ($taxonomies as $category) {
                                            $i++;
                                            $san_pham[] = $category->term_id;
                                        ?>
                                            <div class="form-group">
                                                <input class="gnws-xemthem-wrap_all_total_select" type="checkbox" name="san_pham" value="<?php echo $category->term_id ?>" id="<?php echo $category->term_id ?>">
                                                <label for="<?php echo $category->term_id ?>"><?php echo $category->name ?></label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="block__product-filter-list gnws-xemthem-wrap_all">
                            <div class="row g-5 gnws-xemthem-wrap">
                                <?php
                                $args = array(
                                    'post_type' => $post_type_name,
                                    'post_status' => 'publish',
                                    'posts_per_page' => 9,
                                    's' => get_search_query()
                                );
                                $related_items = new WP_Query($args);
                                $count = $related_items->found_posts;
                                if ($related_items->have_posts()) :
                                ?>
                                    <?php
                                    while ($related_items->have_posts()) :
                                        $related_items->the_post();
                                    ?>
                                        <div class="col-lg-4 col-md-6">
                                            <?php get_template_part(
                                                'template-parts/content_home',
                                                'any',
                                                array(
                                                    'class' => 'no-bg',
                                                )
                                            ); ?>
                                        </div>
                                    <?php
                                    endwhile;
                                    ?>
                                <?php
                                    wp_reset_postdata();
                                else :
                                ?>
                                    <div class="no-result">
                                        <?php
                                        _e('Không tìm thấy kết quả !', 'fis') ?>
                                    </div>
                                <?php endif;
                                ?>
                            </div>
                            <?php if (($count > 9)) {
                                $class_btn = '';
                            } else {
                                $class_btn = 'd-none';
                            } ?>
                            <div class="text-center mt-4 <?php echo $class_btn ?>">
                                <button type="button" class="button-link gnws-button-xemthem" data-search_page="1" data-search="<?php echo get_search_query() ?>" data-linh_vuc="" data-dich_vu="" data-nang_luc="" data-san_pham="" data-wrap="col-lg-4 col-md-6" data-number="9" data-template="content_home" data-post_type="<?php echo $post_type_name ?>" data-offset="9" data-count="<?php echo $count ?>" data-template_class="no-bg">
                                    <span class="py-3 px-5"><?php _e('Xem thêm', 'fis') ?></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
