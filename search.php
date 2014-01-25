<?php get_header(); ?>

<?php if (have_posts()) : ?>

	<h1 class="entry-title">Your search for &#8220;<?php the_search_query(); ?>&#8221;</h1>

	<?php while (have_posts()) : the_post(); ?>
	
		<div class="entry" role="article">
		
			<header class="entry-header">
				
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				
				<p class="secondary meta"><time itemprop="datePublished" content="<?php the_time('c'); ?>" datetime="<?php the_time('c'); ?>"><?php the_time(get_option('date_format')); ?></time></p>
				
			</header>
				
			<div class="entry-content prose">
			
				<?php the_excerpt(); ?>
				
			</div>
					
		</div>
			
	<?php endwhile; ?>
	
	<div class="pagination">
					   
		<p class="next"><?php previous_posts_link(__('Newer search results &rarr;', "scherzo"), '0'); ?></p>
		<p class="previous"><?php next_posts_link(__('&larr; Older search results', "scherzo"), '0'); ?></p>
	   
	</div> <!-- end .pagination -->

<?php else : ?>

	<p>Unfortunately your search didn't return anything. Please try again.</p>

<?php endif; ?>

<?php get_footer(); ?>