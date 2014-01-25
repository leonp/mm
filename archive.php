<?php get_header(); ?>

<?php if (have_posts()) : ?>

	<?php /* If this is a category archive */ if (is_category()) { ?>
	
		<h1 class="entry-title">Posts filed under &#8220;<?php single_cat_title(); ?>&#8221;</h1>
		
	<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
	
		<h1 class="entry-title">Posts tagged &#8220;<?php single_tag_title(); ?>&#8221;</h1>
	
	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
	
		<h1 class="entry-title">Posts written on <?php the_time('F j, Y'); ?></h1>
		
	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
	
		<h1 class="entry-title">Posts written in <?php the_time('F, Y'); ?></h1>
		
	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
	
		<h1 class="entry-title">Posts written in <?php the_time('Y'); ?></h1>
		
	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
	
		<h1 class="entry-title">Posts written by <?php echo wp_title(''); ?></h1>
	
<?php } ?>

<?php while (have_posts()) : the_post(); ?>

	<div class="entry">
			
		<div class="entry-header">
			
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			
			<p class="secondary meta"><time itemprop="datePublished" content="<?php the_time('c'); ?>" datetime="<?php the_time('c'); ?>"><?php the_time(get_option('date_format')); ?></time></p>
			
		</header>
			
		<div class="entry-content prose">
		
			<?php the_excerpt(); ?>
			
		</div>
				
	</div>
		
<?php endwhile; ?>

<?php else : ?>

	<h1 class="entry-title">No posts found</h1>

<?php endif; ?>

<div class="pagination clearfix">
				   
	<p class="next"><?php previous_posts_link('Newer posts from this archive &rarr;', '0'); ?></p>
	<p class="previous"><?php next_posts_link('&larr; Older posts from this archive', '0'); ?></p>
   
</div> <!-- end .pagination -->

<?php get_footer(); ?>
