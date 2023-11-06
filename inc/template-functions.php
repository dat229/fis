<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package fis
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function fis_body_classes($classes)
{
	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if (!is_active_sidebar('sidebar-1')) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter('body_class', 'fis_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function fis_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'fis_pingback_header');

if (!function_exists('wp_body_open')) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open()
	{
		do_action('wp_body_open');
	}
endif;

/**
 * Function help call file SVG from assets/svg
 */
function svg($name, $width = false, $height = false)
{
	$dir  = TEMPLATEPATH . '/assets/svg/';
	$path = $dir . $name . '.svg';

	if ($name && file_exists($path)) {
		$svg = file_get_contents($path);
		if ($width) {
			$size = '<svg';
			$new_size = '<svg width="' . $width . 'px"';
			$svg = str_replace($size, $new_size, $svg);
		}
		if ($height) {
			$size = '<svg';
			$new_size = '<svg height="' . $height . 'px"';
			$svg = str_replace($size, $new_size, $svg);
		}
		return $svg;
	}
	return '';
}
/**
 * Function help call file SVG from url
 */
function curl_get_contents($url)
{
	$your_username = "adminquantri";
	$your_password = "baomatcao@A";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_USERPWD, $your_username . ":" . $your_password);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
function svg_dir($path, $width = false, $height = false)
{
	if ($path) {
		$user = 'adminquantri';
		$pass = 'baomatcao@A';
		$opts = [
			'http' => [
				'method' => 'GET',
				'header' => 'Authorization: Basic ' . base64_encode($user . ':' . $pass)
			]
		];
		$svg = curl_get_contents($path, false, stream_context_create($opts));
		if ($width) {
			$size = '<svg';
			$new_size = '<svg width="' . $width . 'px"';
			$svg = str_replace($size, $new_size, $svg);
		}
		if ($height) {
			$size = '<svg';
			$new_size = '<svg height="' . $height . 'px"';
			$svg = str_replace($size, $new_size, $svg);
		}
		return $svg;
	}
	return '';
}

if (!function_exists('fis_post_thumbnail')) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function fis_post_thumbnail()
	{
		if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
			echo get_stylesheet_directory_uri() . '/assets/svg/placeholder.svg';
		} else {
			the_post_thumbnail_url('thumbnail');
		}
	}
endif;

if (!function_exists('fis_post_thumbnail_full')) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function fis_post_thumbnail_full()
	{
		if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
			echo get_stylesheet_directory_uri() . '/assets/svg/placeholder.svg';
		} else {
			the_post_thumbnail_url();
		}
	}
endif;

/**
 * Displays pagination style by number page
 */
function fis_pagination()
{

	if (is_singular())
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if ($wp_query->max_num_pages <= 1)
		return;

	$paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
	$max   = intval($wp_query->max_num_pages);

	/** Add current page to the array */
	if ($paged >= 1)
		$links[] = $paged;

	/** Add the pages around the current page to the array */
	if ($paged >= 3) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if (($paged + 2) <= $max) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="fis-pagination"><ul>' . "\n";

	/** Previous Post Link */
	if (get_previous_posts_link())
		printf('<li>%s</li>' . "\n", get_previous_posts_link(svg('angle-left')));

	/** Link to first page, plus ellipses if necessary */
	if (!in_array(1, $links)) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

		if (!in_array(2, $links))
			echo '<li>…</li>';
	}

	/** Link to current page, plus 2 pages in either direction if necessary */
	sort($links);
	foreach ((array) $links as $link) {
		$class = $paged == $link ? ' class="active"' : '';
		printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
	}

	/** Link to last page, plus ellipses if necessary */
	if (!in_array($max, $links)) {
		if (!in_array($max - 1, $links))
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
	}

	/** Next Post Link */
	if (get_next_posts_link())
		printf('<li>%s</li>' . "\n", get_next_posts_link(svg('angle-right')));

	echo '</ul></div>' . "\n";
}


/**
 * Displays exceprt by number string
 * How to use: echo excerpt(x) width x is number length
 */
function excerpt($limit)
{
	$excerpt = explode(' ', get_the_excerpt(), $limit);

	if (count($excerpt) >= $limit) {
		array_pop($excerpt);
		$excerpt = implode(" ", $excerpt) . '...';
	} else {
		$excerpt = implode(" ", $excerpt);
	}

	$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

	return strip_tags($excerpt);
}

/**
 * Check Link
 * If not return javascript:void(0)
 */

function check_link($value)
{
	if ($value) {
		return $value;
	} else {
		return 'javascript:void(0)';
	}
}


/**
 * Random String
 */

function generateRandomString($length = 10)
{
	$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[random_int(0, $charactersLength - 1)];
	}
	return $randomString;
}


function get_archive_links_css_class($link)
{
	$url_home = get_home_url();
	$link = str_replace($url_home, '', $link);
	$link = str_replace('"/', '"', $link);
	return $link;
}
