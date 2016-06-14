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
		<div class="box">
			<div class="box-heading">
				<h1>Result of serch "<?php echo get_search_query( ); ?>"</h1>
			</div> <!-- /.box-heading -->
			<div class="short-row row">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<!-- Заголовок -->
					<a href="<?php echo get_the_permalink(); ?>">
						<?php the_title('<h2>', '</h2>'); ?>
					</a>

					<!-- Текст-анонс (20 слов - решулируется фильтром в theme-options) -->
					<div><?php the_excerpt(); ?></div>

					<!-- Ссылка далее -->
					<a href="<?php echo get_the_permalink(); ?>">Читать далее</a>

				<?php endwhile; ?>

					<!-- post navigation -->
					<?php wfs_page_navi(); ?>

				<?php else: ?>
				<!-- no posts found -->
				<?php endif; ?>
			</div> <!-- /.short-row -->
		</div> <!-- /.box -->
	</div> <!-- /.col-md-8 -->
	<?php get_sidebar(); ?>
</div> <!-- /.row -->




<?php
get_footer();