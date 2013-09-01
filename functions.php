<?php
/**
 * The functions file is used to initialize everything in the theme.  It controls how the theme is loaded and 
 * sets up the supported features, default actions, and default filters.  If making customizations, users 
 * should create a child theme and make changes to its functions.php file (not this one).  Friends don't let 
 * friends modify parent theme files. ;)
 *
 * Child themes should do their setup on the 'after_setup_theme' hook with a priority of 11 if they want to
 * override parent theme features.  Use a priority of 9 if wanting to run before the parent theme.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License as published by the Free Software Foundation; either version 2 of the License, 
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package    HybridBase
 * @subpackage Functions
 * @version    0.1.0
 * @since      0.1.0
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2013, Justin Tadlock
 * @link       http://themehybrid.com/themes/fox-roots
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Load the core theme framework. */
require_once( trailingslashit( get_template_directory() ) . 'library/hybrid.php' );
new Hybrid();

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'fox_roots_theme_setup' );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function fox_roots_theme_setup() {

	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix();

	/* Register menus. */
	add_theme_support( 
		'hybrid-core-menus', 
		array( 'primary', 'secondary', 'subsidiary' ) 
	);

	/* Register sidebars. */
	add_theme_support( 
		'hybrid-core-sidebars', 
		array( 'primary', 'secondary', 'subsidiary' ) 
	);

	/* Load scripts. */
	add_theme_support( 
		'hybrid-core-scripts', 
		array( 'comment-reply' ) 
	);

	/* Load styles. */
	add_theme_support( 
		'hybrid-core-styles', 
		array( '25px', 'gallery', 'parent', 'style' ) 
	);

	/* Load widgets. */
	add_theme_support( 'hybrid-core-widgets' );

	/* Load shortcodes. */
	add_theme_support( 'hybrid-core-shortcodes' );

	/* Enable custom template hierarchy. */
	add_theme_support( 'hybrid-core-template-hierarchy' );
	
	/* Load the media grabber script. */
	add_theme_support( 'hybrid-core-media-grabber' );

	/* Enable theme layouts (need to add stylesheet support). */
	add_theme_support( 
		'theme-layouts', 
		array( '1c', '2c-l', '2c-r', '3c-l', '3c-c', '3c-r' ), 
		array( 'default' => '1c', 'customizer' => true ) 
	);

	/* Allow per-post stylesheets. */
	add_theme_support( 'post-stylesheets' );

	/* Support pagination instead of prev/next links. */
	add_theme_support( 'loop-pagination' );

	/* The best thumbnail/image script ever. */
	add_theme_support( 'get-the-image' );

	/* Use breadcrumbs. */
	add_theme_support( 'breadcrumb-trail' );

	/* Nicer [gallery] shortcode implementation. */
	add_theme_support( 'cleaner-gallery' );

	/* Better captions for themes to style. */
	add_theme_support( 'cleaner-caption' );

	/* Automatically add feed links to <head>. */
	add_theme_support( 'automatic-feed-links' );

	/* Post formats. */
	add_theme_support( 
		'post-formats', 
		array( 'aside', 'audio', 'chat', 'image', 'gallery', 'link', 'quote', 'status', 'video' ) 
	);

	/* Add support for a custom header image. */
	add_theme_support(
		'custom-header',
		array( 'header-text' => false ) );

	/* Custom background. */
	add_theme_support( 
		'custom-background',
		array( 'default-color' => 'ffffff' )
	);

	/* Handle content width for embeds and images. */
	hybrid_set_content_width( 1300 );
	
	/* Enqueue styles and scripts. */
	add_action( 'wp_enqueue_scripts', 'fox_roots_enqueue_scripts' );
	
	/* Register custom nav menus. */
	add_action( 'init', 'fox_roots_register_nav_menus', 11 );
	
	/* Register additional sidebar to 'front page' page template. */
	add_action( 'widgets_init', 'fox_roots_register_sidebars' );
	
	/* Add number of subsidiary and front page widgets to body_class. */
	add_filter( 'body_class', 'fox_roots_subsidiary_classes' );
	add_filter( 'body_class', 'fox_roots_front_page_classes' );
	
	/* Add menu-item-parent class to parent menu items.  */
	add_filter( 'wp_nav_menu_objects', 'fox_roots_add_menu_parent_class' );

}

/**
 * Enqueue styles and scripts
 *
 * @since 1.0
 */
function fox_roots_enqueue_scripts() {

	/* Enqueue responsive nav. */
	wp_enqueue_script( 'fox-roots-responsive-nav', trailingslashit( get_template_directory_uri() ) . 'js/responsive-nav/responsive-nav.min.js', array(), '20131101', true );
	
	/* Enqueue settings. */
	wp_enqueue_script( 'fox-roots-settings', trailingslashit( get_template_directory_uri() ) . 'js/settings/settings.js', array( 'fox-roots-responsive-nav' ), '20131101', true );

}

/**
 * Registers custom nav menus for the theme.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function fox_roots_register_nav_menus() {

	/* Register social links menu. */
	register_nav_menu( 'social', esc_html__( 'Social', 'fox-roots' ) );
	
	/* Register portfolio menu. */
	if ( post_type_exists( 'portfolio_item' ) )
		register_nav_menu( 'portfolio', esc_html__( 'Portfolio', 'fox-roots' ) );

}

/**
 * Register additional sidebar to 'front page' page template.
 * 
 * @since 0.1.0
 */
function fox_roots_register_sidebars() {

	/* Register the 'front-page' sidebar. */
	register_sidebar(
		array(
			'id' => 'front-page',
			'name' => __( 'Front Page Widget', 'eino' ),
			'description' => __( 'Front Page widget area.', 'eino' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s widget-%2$s"><div class="widget-wrap widget-inside">',
			'after_widget' => '</div></section>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);

}

/**
 * Counts widgets number in subsidiary sidebar and ads css class (.sidebar-subsidiary-$number) to body_class.
 * Used to increase / decrease widget size according to number of widgets.
 * Example: if there's one widget in subsidiary sidebar - widget width is 100%, if two widgets, 50% each...
 * @author Sinisa Nikolic
 * @copyright Copyright (c) 2012
 * @link http://themehybrid.com/themes/sukelius-magazine
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since 0.1.0
 */
function fox_roots_subsidiary_classes( $classes ) {
    
	if ( is_active_sidebar( 'subsidiary' ) ) {
		
		$the_sidebars = wp_get_sidebars_widgets();
		$num = count( $the_sidebars['subsidiary'] );
		$classes[] = 'sidebar-subsidiary-' . $num;
		
    }
    
    return $classes;
	
}

/**
 * Counts widgets number in front-page sidebar and ads css class (.sidebar-front-page-$number) to body_class.
 * @author Sinisa Nikolic
 * @copyright Copyright (c) 2012
 * @link http://themehybrid.com/themes/sukelius-magazine
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since 0.1.0
 */
function fox_roots_front_page_classes( $classes ) {
	
	if ( is_active_sidebar( 'front-page' ) && is_page_template( 'pages/front-page.php' ) ) {
		
		$the_sidebars = wp_get_sidebars_widgets();
		$num = count( $the_sidebars['front-page'] );
		$classes[] = 'sidebar-front-page-' . $num;
		
    }
    
    return $classes;
	
}

/**
 * Add menu-item-parent class to parent menu items. Thanks to Chip Bennett.
 *
 * @since 0.1.0
 */
function fox_roots_add_menu_parent_class( $items ) {

	$parents = array();

	foreach ( $items as $item ) {

		if ( $item->menu_item_parent && $item->menu_item_parent > 0 )
			$parents[] = $item->menu_item_parent;
		
	}

	foreach ( $items as $item ) {

		if ( in_array( $item->ID, $parents ) )
			$item->classes[] = 'menu-item-parent';

	}

	return $items;    

}

?>