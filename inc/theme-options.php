<?php
/**
*
* @package wfs-wingad
*
**/
function wfs_remove_wp_version_strings( $src ) {
	
	global $wp_version;
	parse_str( parse_url($src, PHP_URL_QUERY), $query );
	if ( !empty( $query['ver'] ) && $query['ver'] === $wp_version ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
	
}
add_filter( 'script_loader_src', 'wfs_remove_wp_version_strings' );
add_filter( 'style_loader_src', 'wfs_remove_wp_version_strings' );
/* remove metatag generator from header */
function wfs_remove_meta_version() {
	return '';
}
add_filter( 'the_generator', 'wfs_remove_meta_version' );


/*
	
	========================
		THEME SUPPORT OPTIONS
	========================
*/
$options = get_option( 'post_formats' );
$formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
$output = array();
foreach ( $formats as $format ){
	$output[] = ( @$options[$format] == 1 ? $format : '' );
}
if( !empty( $options ) ){
	add_theme_support( 'post-formats', $output );
}
add_theme_support( 'post-thumbnails' );
/* Activate Nav Menu Option */
function sunset_register_nav_menu() {
	register_nav_menu( 'primary', 'Header Navigation Menu' );
	register_nav_menu( 'top-header', 'Top Header Navigation Menu' );
}
add_action( 'after_setup_theme', 'sunset_register_nav_menu' );

add_action( 'after_setup_theme', 'wfs_theme_setup' );
function wfs_theme_setup() {
  add_image_size( 'crop-img', 328, 200, true ); // (cropped)
}

function wfs_page_navi() {
	global $wp_query;
	$bignum = 999999999;
	if ( $wp_query->max_num_pages <= 1 )
	return;
	

	$pages = paginate_links( array(
		'base' 			=> str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
		'format' 		=> '',
		'current' 		=> max( 1, get_query_var('paged') ),
		'total' 		=> $wp_query->max_num_pages,
		'prev_text' 	=> '«',
		'next_text' 	=> '»',
		'type'			=> 'array',
		'end_size'		=> 3,
		'mid_size'		=> 3
  ) );
  if( is_array( $pages ) ) {
    $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
    echo '<div class="pagination-wrap"><ul class="pagination">';
    foreach ( $pages as $page ) {
            echo "<li>$page</li>";
    }
   echo '</ul></div>';
  }
} /* end page navi */


/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wfs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wfs_custom_excerpt_length', 999 );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wfs_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'wfs_excerpt_more' );