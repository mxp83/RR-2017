<?php
/**
 * Template Name: Promotions Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<?php include(get_template_directory() . '/inc/gallery-slider.php'); ?> 

<div class="wrapper" id="promos">

	<div class="<?php echo esc_html( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<div class="container">

						<header class="entry-header">

							<h1 class="entry-title">Promotions</h1>

						</header><!-- .entry-header -->
						
						<div class="row">
							
							<?php 
								$args = array('post_type' => 'promotions', 'posts_per_page' => 100);

								$query = new WP_Query($args);

								if( $query->have_posts() ) : 
									while ($query->have_posts()) : $query->the_post();

							?>

							<?php		$terms = get_the_terms($post->ID, 'type-promotions');
									$post_type = get_post_type($post->ID);
							?>

							<?php if (get_field('promotion_active')) : ?>
								<div class="col-md-4 clearfix promo-item">
										<div class="promo-image-box <?php foreach ($terms as $term) echo ' '.$term->slug; ?>"  style="background-image: url('<?php echo get_the_post_thumbnail_url($post->ID); ?>');">
											<div class="overlay"></div>
									    	<div class="promo-image-text text-center">
									    		<h5><?php echo get_the_title( $p->ID ); ?></h5>
									    		<a href="<?php if(get_field('external_link',$p->ID)) : the_field('external_link',$p->ID); else : the_permalink( $p->ID ); endif; ?>" class="btn promo-btn">
									    		<?php if(get_field('button_text',$p->ID)) : the_field('button_text',$p->ID); else : echo 'Learn More'; endif; ?>
									    		</a>
									    	</div>
										</div>
								</div>
							<?php endif; ?>

							<?php endwhile; //line 32 ?>
							<?php wp_reset_postdata(); ?>
							<?php endif; //line 31 ?>


						</div><!-- .row -->
					</div><!-- container -->
				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
