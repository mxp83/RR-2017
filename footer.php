<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'understrap_container_type' );
?>

<?php include(get_template_directory() . '/inc/social-media-buttons.php'); ?> 
<?php get_sidebar( 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_html( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="row">
						<div class="col-md-9">
							<!-- The WordPress Menu goes here -->
				              <?php wp_nav_menu(
				                array(
				                  'theme_location' => 'secondary',
				                  'container_class' => '',
				                  'menu_class' => 'nav',
				                  'fallback_cb' => '',
				                  'menu_id' => 'secondary-menu'
				                )
				               ); ?>
						</div>
						<div class="col-md-3">
							<div class="site-info">
								<p>Great American Casino Des Moines<br>
								   22406 Pacific Hwy S.,<br>
								   Des Moines, WA<br>
								   98198</p>
							</div><!-- .site-info -->
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="site-info">
								<p>&copy; 2017 Great American Gaming Corporation</p>
							</div>
						</div>
					</div>

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->
</div><!-- page-main -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>
