<?php get_header(); ?>

	<?php $the_query = new WP_Query( 'posts_per_page=1' ); ?>
	
	<?php if ( $the_query->have_posts() ) : ?>

		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

			<article class="entry" role="article">
					
				<header class="entry-header">
					
					<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					
					<p class="secondary meta"><time itemprop="datePublished" content="<?php the_time('c'); ?>" datetime="<?php the_time('c'); ?>"><?php the_time(get_option('date_format')); ?></time></p>
					
				</header>
					
				<div class="entry-content prose">
				
					<?php the_excerpt(); ?>
					
				</div>
				
				<p><a href="<?php the_permalink(); ?>">Read <cite><?php the_title(); ?></cite> in full.</a></p>
						
			</article>
			
		<?php endwhile; ?>
		
	<?php endif; ?>
	
	<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>
