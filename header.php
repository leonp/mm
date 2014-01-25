<!doctype html>

<html <?php language_attributes(); ?>>

	<head>
	
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		
		<title><?php wp_title('&ndash;',true,'right'); ?><?php bloginfo('name'); ?></title>

		<?php if ( is_home() ) {?>
			
			<meta name="description" content="<?php bloginfo('description'); ?>">
						
		<?php } ?>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!--[if lt IE 9]>
		
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			
		<![endif]-->

		<?php wp_head(); ?>
		
	</head>
	
	<body>
	
		<ul class="hide">
		
			<li><a href="#content">Skip to content</a></li>
			<li><a href="#nav">Skip to navigation</a></li>
			
		</ul>
	
		<div class="logo"><a href="<?php bloginfo('url'); ?>" rel="index" class="logo-link"><?php bloginfo('name'); ?></a></div>
		
		<div id="content" role="main">
