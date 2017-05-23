<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php the_content(); ?>

		<?php if( have_rows('menu_section') ) : 
				while ( have_rows('menu_section') ) : the_row();
		?>

			<div class="menu-section <?php the_sub_field('course_name'); ?> clearfix">
				<div class="col-sm-12 clearfix">
					<h2 class="course-title"><?php the_sub_field('course_name'); ?></h2>
				</div>
				<?php if(get_sub_field('section_featured_item') ) : ?>
					<div class="col-md-2 clearfix">
						<div class="menu-feat-img">
							<img src="<?php the_sub_field('section_featured_item'); ?>" alt="Featured Item">
						</div>
					</div>
				<?php endif; ?>

				<div class="group-menu-items col-sm-12">
					<div class="row">
					<?php 
						$count = 0;
						if( have_rows('menu_items') ) :
							while( have_rows('menu_items') ) : the_row();
					?>
						
						<?php if( $count %2 == 0 && $count != 0 ) : 
							echo '</div><div class="row">'; 
							endif;
						?>

						<article class="col-md-6">
							<div class="food-menu-item">
							<div class="row">
								<div class="menu-item-stuff col-md-12">
									<p class="item-title"><?php the_sub_field('item_title'); ?></p>
								</div>
							</div>
								<div class="row">
									<div class="menu-item-stuff col-md-9">
										<?php if( get_sub_field('item_description') ) : ?>
											<div class="item-description"><?php the_sub_field('item_description'); ?></div>
										<?php endif; ?>

										<?php $gluten = get_sub_field('is_gluten');
											if( $gluten == !false ) : 
										?>
											<img src="<?php bloginfo('template_url'); ?>/img/wheat-free.png" alt="Wheat Free" />
										<?php endif; ?>

										<?php $veggy = get_sub_field('veggy');
											if( $veggy == !false ) : 
										?>
											<img src="<?php bloginfo('template_url'); ?>/img/vegetarian.png" alt="Vegetarian" />
										<?php endif; ?>
									</div>
									<div class="menu-price-chunk col-md-3">
										<?php if (have_rows('item_prices')) : 
											while (have_rows('item_prices')) : the_row();
										?>
											<div class="row">
												<div class="col-md-12">
													<?php $priceCost = get_sub_field('price_option_value');
														  $price = explode('.', $priceCost);
														  $dollars = $price[0];
														  $cents = $price[1];
													?>
													<p><?php echo get_sub_field('price_option_name'); ?>
													<em class="menu-item-price">$<?php echo $dollars; echo $cents ? '.' : false; ?><sup><?php echo $cents ? $cents : false; ?></sup></em></p>
												</div>
											</div>

										<?php endwhile;
											endif;
										?>
									</div>
								</div>
							</div>
						</article>

						<?php $count++; 
						endwhile;
						endif;
					?>
					</div>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>

		<?php endwhile;
			  endif;
		?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
