<?php 
	function the_breadcrumb() {
		if (!is_home()) {
			echo '<a class="breadcrumb-link" href="';
			echo get_option('home');
			echo '">';
			bloginfo('name');
			echo "</a> &#187; ";
				echo "<span class='breadcrumb-current'>";
				echo the_title();
				echo "</span><hr class='breadcrumb-line'>";
		}
	}
 ?>