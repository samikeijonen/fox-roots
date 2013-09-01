<?php if ( pings_open() && !comments_open() ) { ?>

	<p class="comments-closed pings-open">
		<?php printf( __( 'Comments are closed, but <a href="%s" title="Trackback URL for this post">trackbacks</a> and pingbacks are open.', 'fox-roots' ), esc_url( get_trackback_url() ) ); ?>
	</p><!-- .comments-closed .pings-open -->

<?php } elseif ( !comments_open() ) { ?>

	<p class="comments-closed">
		<?php _e( 'Comments are closed.', 'fox-roots' ); ?>
	</p><!-- .comments-closed -->

<?php } ?>