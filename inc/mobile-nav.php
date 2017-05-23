<div class="navbar-mobile">  
	  <!-- The WordPress Menu goes here -->
	  <?php wp_nav_menu(
	    array(
	      'theme_location' => 'primary',
	      'container_class' => '',
	      'menu_class' => 'sidenav',
	      'fallback_cb' => '',
	      'menu_id' => 'mySidenav',
	      'walker' => new wp_bootstrap_navwalker()
	    )
	   ); ?>
</div>
<div class="navbar">
	<a id="nav-expander" class="nav-expander fixed">MENU &nbsp;<i class="fa fa-bars fa-lg white"></i></a>
</div>