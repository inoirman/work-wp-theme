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

			</div> <!-- /.box-heading -->
			<div class="short-row row">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<!-- Заголовок -->
					<?php the_title('<a href="<?php echo get_the_permalink(); ?>"><h2>', '</h2></a>'); ?>

					<!-- Мета информация (автор, дата, категории) -->
					<div class="meta">
						Автор: <a class="url fn n" href="<?php echo get_the_author_link(); ?>" ><?php echo get_the_author( );?></a><br>
						Размещено: <?php echo get_the_date( 'M d, Y' ); ?><br>
						<?php echo get_the_category_list( ', ' ); ?>
					</div> <!-- /.meta -->

					<!-- Превьюшка (если есть) -->
					<?php if ( has_post_thumbnail() ) { ?>
						<?php the_post_thumbnail( 'crop-img' ); ?>
					<?php } ?>

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
	<div class="col-md-4">
		<?php get_sidebar(); ?>
	</div> <!-- /.col-md-4 -->
</div> <!-- /.row -->




<?php
get_footer();