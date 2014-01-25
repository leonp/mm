				</div> <!-- end #content -->
				
				<footer class="site-footer secondary">
		
			<nav id="nav" role="navigation">
			
				<ul class="h-nav">
				
					<?php wp_nav_menu(array('theme_location' => 'navigation', 'container' => 'false', 'items_wrap' => '%3$s', 'depth' => '1')); ?>
					
				</ul>
				
			</nav>
			
			<p role="contentinfo">Written by <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></p>
			
		</footer>
	
	</body>
	
</html>
