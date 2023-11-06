<?php
add_action('wp_ajax_nopriv_gnws_load_more_post', 'prefix_load_posts_gnws_load_more_post');
add_action('wp_ajax_gnws_load_more_post', 'prefix_load_posts_gnws_load_more_post');
function prefix_load_posts_gnws_load_more_post()
{
    ob_start();
    $category = !empty($_POST['category']) ? ($_POST['category']) : '';
    $linh_vuc = !empty($_POST['linh_vuc']) ? ($_POST['linh_vuc']) : '';
    $dich_vu = !empty($_POST['dich_vu']) ? ($_POST['dich_vu']) : '';
    $san_pham = !empty($_POST['san_pham']) ? ($_POST['san_pham']) : '';
    $nang_luc = !empty($_POST['nang_luc']) ? ($_POST['nang_luc']) : '';
    $post_tag = !empty($_POST['post_tag']) ? ($_POST['post_tag']) : '';
    $bvnb = !empty($_POST['bvnb']) ? ($_POST['bvnb']) : '';
    $offset = !empty($_POST['offset']) ? intval($_POST['offset']) : '';
    $search_page = !empty($_POST['search_page']) ? intval($_POST['search_page']) : '';
    $date_query_number = !empty($_POST['date_query']) ? ($_POST['date_query']) : '0';
    $date_query_number = str_replace('/', '', $date_query_number);
    $wrap = !empty($_POST['wrap']) ? ($_POST['wrap']) : '';
    $number = !empty($_POST['number']) ? ($_POST['number']) : '';
    $template = !empty($_POST['template']) ? ($_POST['template']) : '';
    $post_type = !empty($_POST['post_type']) ? ($_POST['post_type']) : '';
    $offset = !empty($_POST['offset']) ? ($_POST['offset']) : '0';
    $display_category = !empty($_POST['display_category']) ? ($_POST['display_category']) : '';
    $template_class = !empty($_POST['template_class']) ? ($_POST['template_class']) : '';
    $search = !empty($_POST['search']) ? ($_POST['search']) : '';
    $tax_query = array('relation' => 'AND');
    $date_query = array('relation' => 'AND');
    if ($date_query && $date_query != 0) {
        $date_query[] = array(
            'year' => $date_query_number
        );
    }
    if ($category && $category != 0) {
        $tax_query[] =  array(
            'taxonomy' => 'category',
            'field' => 'id',
            'terms' => explode(",", $category)
        );
    }
    if ($linh_vuc && $linh_vuc != 0) {
        $tax_query[] =  array(
            'taxonomy' => 'linh_vuc',
            'field' => 'id',
            'terms' => explode(",", $linh_vuc)
        );
    }
    if ($post_tag && $post_tag != 0) {
        $tax_query[] =  array(
            'taxonomy' => 'post_tag',
            'field' => 'id',
            'terms' => explode(",", $post_tag)
        );
    }
    if ($dich_vu && $dich_vu != 0) {
        $tax_query[] =  array(
            'taxonomy' => 'dich_vu',
            'field' => 'id',
            'terms' => explode(",", $dich_vu)
        );
    }
    if ($san_pham && $san_pham != 0) {
        $tax_query[] =  array(
            'taxonomy' => 'san_pham',
            'field' => 'id',
            'terms' => explode(",", $san_pham)
        );
    }
    if ($nang_luc && $nang_luc != 0) {
        $tax_query[] =  array(
            'taxonomy' => 'nang_luc',
            'field' => 'id',
            'terms' => explode(",", $nang_luc)
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
        'post_type' => $post_type,
        'post_status' => 'publish',
        'offset' => $offset,
        'posts_per_page' => $number,
        'meta_query' => $meta_query,
        'tax_query' => $tax_query,
        'date_query' => $date_query,
        's' => $search,
    );
    $related_items = new WP_Query($args);
    $count = $related_items->found_posts;
    if ($search_page == 1) {
        $post_type = 'any';
    }
    if ($related_items->have_posts()) {
        while ($related_items->have_posts()) :
            $related_items->the_post();
?>
            <div class="<?php echo $wrap ?>">
                <?php get_template_part(
                    'template-parts/' . $template,
                    $post_type,
                    array(
                        'class' => $template_class,
                        'display_category' => $display_category,
                    )
                ); ?>
            </div>
        <?php
        endwhile;
        wp_reset_postdata();
    } else { ?>
        <div class="no-result">
            <?php
            _e('Không tìm thấy kết quả !', 'fis') ?>
        </div>
<?php };
    $content = ob_get_contents();
    ob_end_clean();
    echo json_encode(array('status' => true, 'content' => $content, 'count' => $count));
    die();
}
