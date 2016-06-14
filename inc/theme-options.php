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

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wfs_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wfs-wingat' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'wfs-wingat' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
	) );
}
add_action( 'widgets_init', 'wfs_widgets_init' );


// function to display number of posts.
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

// function to count views.
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// Add it to a column in WP-Admin
add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
function posts_column_views($defaults){
    $defaults['post_views'] = __('Views');
    return $defaults;
}
function posts_custom_column_views($column_name, $id){
	if($column_name === 'post_views'){
        echo getPostViews(get_the_ID());
    }
}


function wfs_comments( $comment, $args, $depth ) {
	  if ( 'div' === $args['style'] ) {
      $tag       = 'div';
      $add_below = 'comment';
  } else {
      $tag       = 'li';
      $add_below = 'div-comment';
  }
  ?>
  <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
  <?php if ( 'div' != $args['style'] ) : ?>
    <div id="comment-<?php comment_ID() ?>">
  <?php endif; ?>
  		<div class="comment-author vcard">
  			<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        <?php echo get_comment_author_link( ); ?>
  			
  		</div>
  		<div class="comment-meta commentmetadata">
  			<a href="<?php get_comment_link( ) ?>"> <?php echo get_comment_date( 'M d, Y' ); ?></a>
  		</div>
  		<div class="comment-body">
  			<?php if ( $comment->comment_approved == '0' ) : ?>
	   		<em class="comment-awaiting-moderation"><?php echo __( 'Your comment is awaiting moderation.', 'wfs-blogbit' ); ?></em>
	    	<br />
  			<?php endif; ?>
	  		<?php comment_text(); ?>
  		</div>
  		<div class="reply">
		    <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		  </div>
  <?php if ( 'div' != $args['style'] ) : ?>
  	</div>
  <?php endif; ?>
  <?php
}

/**
*
* Следующий фильтр возвращает порядок полей формы комментариев - Имя, Емейл, Сайт, Текст
*
**/

add_filter('comment_form_fields', function($fields) {
  return array_merge(array_splice($fields, 1), $fields);
});