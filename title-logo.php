<?php

/* Get logo image or title. */
if ( get_theme_mod( 'logo_upload') ) { ?>
	
	<h1 id="site-title">
		<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<img class="site-logo" src="<?php echo esc_url( get_theme_mod( 'logo_upload' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
		</a>
	</h1>
	
<?php } else { ?>
	
	<h1 id="site-title"><a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

<?php } ?>	
