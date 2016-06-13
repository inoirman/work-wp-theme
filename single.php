<?php
/**
*
* @package wfs-wingad
*
**/
get_header();
?>
<div class="row">
	<div class="col-md-8">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); setPostViews(get_the_ID()); ?>
			<div class="post-wrap posts posts-list">
				<article class="post" id="postTitle">
					<div class="head-post">
						<?php the_title('<h1>', '</h1>'); ?>
						<div class="meta">
							<div class="views">
								<i class="fa fa-eye"></i>
								<span class="viewsCount"><?php echo getPostViews(get_the_ID()); ?></span>
							</div>
						</div>
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
	<div class="col-md-4">
		<?php get_sidebar(); ?>
	</div>
</div>




<?php
get_footer();