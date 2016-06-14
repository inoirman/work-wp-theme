<?php
/**
*
* Template Name: Full Width Page
* 
* @package wfs-wingad
*
**/
get_header();
?>
<div class="row">
	<div class="col-md-12">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
			<div class="post-wrap posts posts-list">
				<article class="post" id="postTitle">
					<div class="head-post">
						<?php the_title('<h1>', '</h1>'); ?>
					</div>
					<div class="body-post">
						<div class="main-post">
							<div class="entry-post sing-entry-post">
								<?php the_content(); ?>
							</div>
							<?php 
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
							?>
						</div>
					</div>
				</article>
			</div>
		<?php endwhile; ?>
		<?php endif; ?>
	</div>
</div>




<?php
get_footer();