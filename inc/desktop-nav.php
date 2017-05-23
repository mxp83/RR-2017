<div class="navbar-desktop">
    	<div class="container">
    		
		   <div class="logo">
	   				<?php if ( ! has_custom_logo() ) { ?>

					<?php if ( is_front_page() && is_home() ) : ?>

						<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
						
					<?php else : ?>

						<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
					
					<?php endif; ?>
					
				
				<?php } else {
					the_custom_logo();
				} ?>
				<!-- end custom logo -->
		  </div>
    	<?php wp_nav_menu(
		    array(
		      'theme_location' => 'primary',
		      'container_class' => '',
		      'menu_class' => '',
		      'fallback_cb' => '',
		      'menu_id' => 'main-menu',
		      'walker' => new wp_bootstrap_navwalker()
		    )
		   ); ?>
    	</div>
</div>
