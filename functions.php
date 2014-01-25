<?php

// Call the cleanup script
// It cleans the wp header and image markup

require_once('lib/clean.php');


// Allow additional features (feed links and shortcodes in widgets)

add_theme_support('automatic-feed-links');
add_filter('widget_text', 'do_shortcode');


// Set up custom navigation menu

add_action('init', 'register_custom_menu');

 
function register_custom_menu() {

	register_nav_menus(
	
		array (
		
		  'navigation' => __( 'navigation' )
		  
		)		
		
	);
	
}


// Set up a widget area
// We'll put this in the widget page template

add_action( 'widgets_init', 'mm_register_sidebars' );

if ( !function_exists( 'mm_register_sidebars' ) ) :

	function mm_register_sidebars() {
	
		register_sidebar(
		
			array(
			
				'id' => 'widgetpage',
				'name' => 'Widget page area',
				'description' => __('Put widgets here and they will appear on any pages that use the Widget Page template', "mm"),
				'before_widget' => '<section class="widget %2$s">',
				'after_widget' => '</section>',
				
			)
			
		);
		
	}
	
endif;


// Add an admin field to point to the archive page

add_action( 'admin_menu', 'mm_admin_menu' );

	function mm_admin_menu() {

		add_options_page( 'mm options', 'mm theme options', 'manage_options', 'mm-options', 'mm_options_page' );
	
	}


add_action( 'admin_init', 'mm_admin_init' );

function mm_admin_init() {

    register_setting( 'mm-settings-group', 'archive-page' );
    add_settings_section( 'archive-page-section', 'Archive page', 'section_one_callback', 'mm-options' );
    add_settings_field( 'mm-archive', 'Archive page', 'mm_archive_page_callback', 'mm-options', 'archive-page-section' );
	
}

function section_one_callback() {
    echo 'Your archive page slug. If your archive page is http://yoursite.com/archives enter <strong>archives</strong>';
}

function mm_archive_page_callback() {
    $setting = esc_attr( get_option( 'archive-page' ) );
    echo "<input type='text' name='archive-page' value='$setting' />";
}

function mm_options_page() { ?>

    <div class="wrap">
	
        <h2>mm theme options</h2>
		
        <form action="options.php" method="POST">
		
            <?php settings_fields( 'mm-settings-group' ); ?>
            <?php do_settings_sections( 'mm-options' ); ?>
            <?php submit_button(); ?>
			
        </form>
		
    </div>
	
<?php }


// Add stylesheets and scripts

if ( !function_exists( 'mm_scripts_styles' ) ) :

	function mm_scripts_styles()

	{
		wp_enqueue_style( 'mm-styles', get_template_directory_uri() . '/css/style.css' );
		
	}

	add_action('wp_enqueue_scripts', 'mm_scripts_styles');

endif;

?>
