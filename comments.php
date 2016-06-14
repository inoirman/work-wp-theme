<?php
/**
*
* @package wfs-wingad
*
**/
?>

<?php 
 if ( get_comments_number(  ) == 0 ) { ?>
 	<h3>No Comments</h3>
<?php } else { ?>
<div class="wrap-comments">
	<h3>Comments for <?php echo get_the_title(); ?></h3>
	<ol class="commentslist">
	<?php 
		$args = array (
			'avatar_size' => 64,
			'replay_text' => 'Replay',
			'callback' => 'wfs_comments'
		);
	?>
	<?php wp_list_comments( $args ); ?>
	</ol>
	
</div><!-- wrap-comments -->
<?php } ?>

<?php comment_form(); ?>

<?php
