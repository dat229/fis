<?php

/**
 * Functions which customizer into WordPress
 *
 * @package fis
 */

/**
 * Function help upload SVG
 */
/**
 * Allow SVG uploads for administrator users.
 *
 * @param array $upload_mimes Allowed mime types.
 *
 * @return mixed
 */
add_filter(
    'upload_mimes',
    function ($upload_mimes) {
        // By default, only administrator users are allowed to add SVGs.
        // To enable more user types edit or comment the lines below but beware of
        // the security risks if you allow any user to upload SVG files.
        if (!current_user_can('administrator')) {
            return $upload_mimes;
        }

        $upload_mimes['svg']  = 'image/svg+xml';
        $upload_mimes['svgz'] = 'image/svg+xml';

        return $upload_mimes;
    }
);

/**
 * Add SVG files mime check.
 *
 * @param array        $wp_check_filetype_and_ext Values for the extension, mime type, and corrected filename.
 * @param string       $file Full path to the file.
 * @param string       $filename The name of the file (may differ from $file due to $file being in a tmp directory).
 * @param string[]     $mimes Array of mime types keyed by their file extension regex.
 * @param string|false $real_mime The actual mime type or false if the type cannot be determined.
 */
add_filter(
    'wp_check_filetype_and_ext',
    function ($wp_check_filetype_and_ext, $file, $filename, $mimes, $real_mime) {

        if (!$wp_check_filetype_and_ext['type']) {

            $check_filetype  = wp_check_filetype($filename, $mimes);
            $ext             = $check_filetype['ext'];
            $type            = $check_filetype['type'];
            $proper_filename = $filename;

            if ($type && 0 === strpos($type, 'image/') && 'svg' !== $ext) {
                $ext  = false;
                $type = false;
            }

            $wp_check_filetype_and_ext = compact('ext', 'type', 'proper_filename');
        }

        return $wp_check_filetype_and_ext;
    },
    10,
    5
);


/**
 * Remove Crop Image Wordpress Size: Large + Medium_large + Medium
 */
add_filter('intermediate_image_sizes', function ($sizes) {
    return array_diff($sizes, ['medium_large']);  // Medium Large (768 x 0)
});
//
add_action('init', 'remove_extra_image_sizes');
function remove_extra_image_sizes()
{
    $sizes = array();
    foreach (get_intermediate_image_sizes() as $size) {
        if (!in_array($size, $sizes)) {
            remove_image_size($size);
        }
    }
}

/**
 * Remove Editor Gutenberg, make Edior Classic
 */
// Post
add_filter('use_block_editor_for_post', '__return_false', 10);
// Post type
add_filter('use_block_editor_for_post_type', '__return_false', 10);


/**
 * Style Dashboard
 */
//Css Admin
if (!function_exists('fis_css_admin')) :
    add_action('admin_head', 'fis_css_admin');
    add_action('admin_enqueue_scripts', 'fis_css_admin');
    function fis_css_admin()
    {
        wp_enqueue_style('admin_css', get_template_directory_uri() . '/admin/admin.css');
    }
endif;
//CSS Login
if (!function_exists('fis_css_admin_login')) :
    add_action('login_enqueue_scripts', 'fis_css_admin_login');
    function fis_css_admin_login()
    {
        wp_enqueue_style('admin_login_css', get_template_directory_uri() . '/admin/login.css');
    }
endif;

/**
 * Get home url Author
 */
add_filter('login_headerurl', 'my_custom_login_url');
function my_custom_login_url($url)
{
    $theme_data = wp_get_theme();
    $theme_uri = $theme_data->get('ThemeURI');
    return $theme_uri;
}

/**
 * Automatically set the image Title, Alt-Text, Caption & Description upload (image tab)
 */
add_action('add_attachment', 'fis_set_image_meta_image_upload');
function fis_set_image_meta_image_upload($post_ID)
{
    if (wp_attachment_is_image($post_ID)) {
        $fis_image_title = get_post($post_ID)->post_title;
        $fis_image_title = preg_replace(
            '%\s*[-_\s]+\s*%',
            ' ',
            $fis_image_title
        );
        $fis_image_title = ucwords(strtolower($fis_image_title));
        $fis_my_image_meta = array(
            'ID' => $post_ID,
            'post_title' => $fis_image_title,
            'post_excerpt' => '',
            'post_content' => '',
        );
        update_post_meta($post_ID, '_wp_attachment_image_alt',    $fis_image_title);
        wp_update_post($fis_my_image_meta);
    }
}


/**
 * Disable XMLRPC
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Remove Logo / Version / Help
 */
function fis_remove_version()
{
    return '';
}
add_filter('the_generator', 'fis_remove_version');
function change_footer_admin()
{
    return ' ';
}
add_filter('admin_footer_text', 'change_footer_admin', 9999);
function change_footer_version()
{
    return ' ';
}
add_filter('update_footer', 'change_footer_version', 9999);
remove_action('wp_head', 'wp_generator');
// Remove version from rss
add_filter('the_generator', '__return_empty_string');

add_filter('contextual_help', 'fis_remove_help_tabs', 999, 3);
function fis_remove_help_tabs($fis_old_help, $screen_id, $screen)
{
    $screen->remove_help_tabs();
    return $fis_old_help;
}
add_action('admin_bar_menu', 'remove_wp_logo', 999);
function remove_wp_logo($wp_admin_bar)
{
    $wp_admin_bar->remove_node('wp-logo');
}

/**
 * Disabled Template
 */
function my_remove_page_template()
{
    if (!class_exists('WooCommerce')) {
        global $pagenow;
        if (in_array($pagenow, array('post-new.php', 'post.php')) && get_post_type() == 'page') { ?>
            <script>
                (function($) {
                    $(document).ready(function() {
                        $('#page_template option[value="template-page/content-woocommerce.php"]').remove();
                    })
                })(jQuery)
            </script>
<?php
        }
    }
}
add_action('admin_footer', 'my_remove_page_template', 10);


/**
 * Remove Tag, Category from archive title
 */
add_filter('get_the_archive_title', 'my_theme_archive_title');
function my_theme_archive_title($title)
{
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    }

    return $title;
}

/**
 * Classic Widget
 */
function example_theme_support()
{
    remove_theme_support('widgets-block-editor');
}
add_action('after_setup_theme', 'example_theme_support');


/*
* Fix check child-parent taxonomy in admin
*/
add_filter('wp_terms_checklist_args', function ($args, $idPost) {
    $args['checked_ontop'] = false;

    return $args;
}, 10, 2);

/*
* Add Theme Support
*/
add_action('after_setup_theme', 'remove_site_logo_default_fis', 11);

function remove_site_logo_default_fis()
{
    remove_theme_support('custom-logo');
}

/*
* Add Custom ACF
*/
function include_field_types_menu_chooser($version)
{
    include('customizer-acf.php');
}

add_action('acf/include_field_types', 'include_field_types_menu_chooser');

/*
* Rewrite slug
*/
function fis_remove_slug($post_link, $post, $leavename)
{

    if ('cau_chuyen' != $post->post_type || 'song_hanh' != $post->post_type || 'publish' != $post->post_status) {
        return $post_link;
    }

    $post_link = str_replace('/' . $post->post_type . '/', '/', $post_link);

    return $post_link;
}
add_filter('post_type_link', 'fis_remove_slug', 10, 3);

function fis_parse_request($query)
{

    if (!$query->is_main_query() || 2 != count($query->query) || !isset($query->query['page'])) {
        return;
    }

    if (!empty($query->query['name'])) {
        $query->set('post_type', array('post', 'song_hanh', 'page', 'cau_chuyen'));
    }
}
add_action('pre_get_posts', 'fis_parse_request');

/**
 * Create Option Page from ACF
 */
add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init()
{
    acf_add_options_sub_page(array(
        'page_title'  => 'Header',
        'menu_title'  => 'Header',
        'parent_slug' => 'themes.php',
    ));
    acf_add_options_sub_page(array(
        'page_title'  => 'Footer',
        'menu_title'  => 'Footer',
        'parent_slug' => 'themes.php',
    ));
    acf_add_options_sub_page(array(
        'page_title'  => 'Cài đặt chung',
        'menu_title'  => 'Cài đặt chung',
        'parent_slug' => 'themes.php',
    ));
    acf_add_options_sub_page(array(
        'page_title'  => 'Script',
        'menu_title'  => 'Script',
        'parent_slug' => 'themes.php',
    ));
    acf_add_options_sub_page(array(
        'page_title'  => 'Cài đặt khách hàng',
        'menu_title'  => 'Cài đặt khách hàng',
        'parent_slug' => 'edit.php?post_type=cau_chuyen',
    ));
    acf_add_options_sub_page(array(
        'page_title'  => 'Cài đặt góc nhìn số',
        'menu_title'  => 'Cài đặt góc nhìn số',
        'parent_slug' => 'edit.php?post_type=goc_nhin_so',
    ));
    acf_add_options_sub_page(array(
        'page_title'  => 'Cài đặt tin tức',
        'menu_title'  => 'Cài đặt tin tức',
        'parent_slug' => 'edit.php',
    ));
}

/**
 * Remove Last Post Title
 */
add_filter('rank_math/frontend/breadcrumb/items', function ($crumbs, $class) {
    if (is_single()) {
        array_pop($crumbs);
    }
    return $crumbs;
}, 10, 2);
