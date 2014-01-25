<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

	<article class="entry" role="article">
	
		<header class="entry-header">

			<h1 class="entry-title"><?php the_title(); ?></h1>
		
			<p class="secondary meta"><time itemprop="datePublished" content="<?php the_time('c'); ?>" datetime="<?php the_time('c'); ?>"><?php the_time(get_option('date_format')); ?></time></p>
			
		</header>

		<div class="entry-content prose">
		
			<?php the_content(); ?>
				
		</div>
		
		<p><a class="pure-button pure-button-primary" href="<?php bloginfo('url'); ?>/<?php echo get_option( 'archive-page' ); ?>">More articles &rarr;</a></p>
		
	</article>
	
<?php endwhile; ?>

<?php get_footer(); ?>
