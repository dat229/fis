<?php

/**
 * Config CF7
 */
add_filter('wpcf7_autop_or_not', '__return_false');

add_filter('wpcf7_form_elements', 'using_shortcode_in_cf7_fis');
function using_shortcode_in_cf7_fis($form)
{
    $form = do_shortcode($form);
    return $form;
}

add_filter('shortcode_atts_wpcf7', 'custom_shortcode_atts_wpcf7_filter', 10, 3);
function custom_shortcode_atts_wpcf7_filter($out, $pairs, $atts)
{
    $current_url = 'current_url';
    if (isset($atts[$current_url])) {
        $out[$current_url] = $atts[$current_url];
    }
    return $out;
}
