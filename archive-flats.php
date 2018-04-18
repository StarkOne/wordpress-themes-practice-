<?php get_header(); ?>
	<main class="clearfix">
		<div class="postsFlow clearfix">
		<?php if(have_posts()):
			while (have_posts()): the_post(); ?>
				<article>
					<a href="<?php echo get_the_permalink(); ?>">
						<?php the_post_thumbnail('flats-thumb'); ?>
					</a>
					<h2><?php the_title(); ?></h2>
				</article>
			<?php endwhile; ?>
		<?php else: ?>
			<h2>Записей нет</h2>
		<?php endif; ?>
		</div>
		<div  class="main-footer clearfix">
			<a href= "#">Our Blog</a>
			<a href= "#">See Portfolio</a>
		</div>
		<?php the_posts_pagination(); ?>
	</main>
<aside>
	<h2>form contacts</h2>
	<form>
		<input type="hidden" name="id_flat" value="<?php echo $post->ID; ?>">
		<div>
			<div>Phone</div>
			<div>
				<input type="text" name="phone">
			</div>
			<input type="button" value="send" class="flat-app-btn">
		</div>
	</form>
</aside>
<?php get_footer(); ?>