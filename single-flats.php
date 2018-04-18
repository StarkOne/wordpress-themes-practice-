<?php get_header(); ?>

	<main class="clearfix">
		<div class="postsFlow clearfix">
			<?php the_post(); ?>
				<article class="postItem-full">
						<?php 
							$cities = get_the_terms($post->ID ,'city'); 
						?>
						<div>
							<strong>Город</strong>
							<?php foreach ($cities as $city) { ?>
								<a href="<?php echo get_term_link($city->term_id) ?>"><?php echo $city->name; ?></a> 
							<?php } ?>
						</div>
						<?php the_post_thumbnail('large'); ?>
						<h2><?php the_title(); ?></h2>
						<div><?php the_content(); ?></div>
						<div><?php the_date(); ?></div>
						<div><?php the_tags(); ?></div>
						<div><?php the_category(); ?></div>
				</article>
		</div>
	</main>
<aside>
	<h2>form contacts</h2>
	<form>
		<input class="inp-hid" type="hidden" name="id_flat" value="<?php echo $post->ID; ?>">
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