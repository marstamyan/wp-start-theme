<?php 

function start_theme_pagination( $args = array() ) {
	$defaults = array(
		'range'           => 4,
		'custom_query'    => FALSE,       
		'previous_string' => esc_html__('Previous', THEME_NAME),
		'next_string'     => esc_html__('Next', THEME_NAME),
		'before_output'   => '<ul class="pagination">',
		'after_output'    => '</ul>'
	);

	$args = wp_parse_args(
		$args,
		apply_filters('start_theme_pagination', $defaults)
	);

	$args['range'] = (int) $args['range'] - 1;
	if (!$args['custom_query'])
		$args['custom_query'] = @$GLOBALS['wp_query'];
	$count = (int) $args['custom_query']->max_num_pages;
	$page  = intval(get_query_var('paged'));
	$ceil  = ceil($args['range'] / 2);
	//$end_size = (int) $args['end_size'];
	//$mid_size = (int) $args['mid_size'];

	if ($count <= 1)
		return FALSE;

	if (!$page)
		$page = 1;

	if ($count > $args['range']) {
		if ($page <= $args['range']) {
			$min = 1;
			$max = $args['range'] + 1;
		} elseif ($page >= ($count - $ceil)) {
			$min = $count - $args['range'];
			$max = $count;
		} elseif ($page >= $args['range'] && $page < ($count - $ceil)) {
			$min = $page - $ceil;
			$max = $page + $ceil;
		}
	} else {
		$min = 1;
		$max = $count;
	}

	$echo = '';
	$previous = intval($page) - 1;
	$previous = esc_attr(get_pagenum_link($previous));

	$firstpage = esc_attr(get_pagenum_link(1));
	if ($firstpage && (1 != $page))
		$echo .= '<li class="page-item previous"><a href="' . $firstpage . '" class="page-link">' . esc_html__('First', THEME_NAME) . '</a></li>';

	if ($previous && (1 != $page))
		$echo .= '<li class="page-item"><a href="' . $previous . '" title="' . esc_html__('previous', THEME_NAME) . '" class="page-link">' . $args['previous_string'] . '</a></li>';

	if (!empty($min) && !empty($max)) {
		for ($i = $min; $i <= $max; $i++) {
			if ($page == $i) {
				$echo .= '<li class="page-item active"><span class="page-link sr-only">' . str_pad((int) $i, 1, '0', STR_PAD_LEFT) . '</span></li>';
			} else {
				$echo .= sprintf('<li><a href="%s" class="page-link">%2d</a></li>', esc_attr(get_pagenum_link($i)), $i);
			}
		}
	}

	$next = intval($page) + 1;
	$next = esc_attr(get_pagenum_link($next));
	if ($next && ($count != $page))
		$echo .= '<li><a href="' . $next . '" title="' . esc_html__('next', THEME_NAME) . '" class="page-link">' . $args['next_string'] . '</a></li>';

	$lastpage = esc_attr(get_pagenum_link($count));
	if ($lastpage && ($count != $page)) {
		$echo .= '<li class="page-item next"><a href="' . $lastpage . '" class="page-link">' . esc_html__('Last', THEME_NAME) . '</a></li>';
	}

	if (isset($echo))
		echo $args['before_output'] . $echo . $args['after_output'];
}