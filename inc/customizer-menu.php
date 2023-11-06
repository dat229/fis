<?php
class WP_fis_nav_menu extends Walker_Nav_menu
{
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $object      = $item->object;
        $type        = $item->type;
        $title       = $item->title;
        $description = $item->description;
        $permalink   = $item->url;
        $active_class = '';
        if (in_array('current-menu-item', $item->classes)) {
            $active_class = 'active';
        }
        if ($depth == 0) {
            $class_css = get_field('menu_style', $item);
        } else {
            $class_css = '';
        }
        $output .= "<li class='$active_class $class_css" .  implode(" ", $item->classes) . "'>";
        $output .= '<a href="' . esc_url($permalink) . '">' . $title . '</a>';
    }

    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= "<ul class='sub-menu depth_$depth'>";
    }
}
