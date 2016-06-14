<?php
/**
*
* @package wfs-wingad
*
**/
?>
<div class="col-md-4">
	<?php get_search_form(); ?>
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php endif; ?>
</div> <!-- /.col-md-4 -->