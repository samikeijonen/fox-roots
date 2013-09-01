<?php if ( has_nav_menu( 'primary' ) ) { ?>

	<nav id="menu-primary" class="menu" role="navigation">
	
		<div class="wrap">
		
			<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'fox-roots' ); ?>"><?php _e( 'Skip to content', 'fox-roots' ); ?></a></div>
	
			<?php

				wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'menu_id'         => 'menu-primary-items',
						'menu_class'      => 'menu-items',
						'fallback_cb'     => ''
					)
				);
			
			?>
			
		</div><!-- .wrap -->
		
	</nav><!-- #menu-primary .menu -->

<?php } ?>