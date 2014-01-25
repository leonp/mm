<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

	<article class="entry" role="article">

		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-content prose">
		
			<?php the_content(); ?>
				
		</div>
		
	</article>
	
<?php endwhile; ?>

<?php get_footer(); ?>
