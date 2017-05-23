<?php
/**
 * Promo Boxes for Front Page
 *
 * @package understrap
 */

?>
<?php if(get_field('current_promo_squares')) : ?>
<section id="promo-squares" class="promo-squares">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>Current Promotions</h3>
			</div>
		</div>
		<div class="row">

			<?php 

		$posts = get_field('current_promo_squares');

		if( $posts ): ?>
			<?php foreach( $posts as $p ): // variable must NOT be called $post (IMPORTANT) ?>
				<?php if( get_post_status($p->ID) == publish) : ?>

				    <div class="col-md-12 col-lg-4 clearfix promo-item">
				    	<div class="promo-image-box" style="background-image: url('<?php echo get_the_post_thumbnail_url($p->ID); ?>');">
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
			<?php endforeach; ?>
		<?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>