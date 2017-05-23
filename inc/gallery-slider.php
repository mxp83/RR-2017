<?php
	$images = get_field('images');

	if ($images):
?>	
	<div class="slide-box">
		
		<?php if(get_field('main_text')) : ?>
				<div class="hero-box text-center">
					<div class="hero-content">
						<h1 class="hero-text"><?php the_field('main_text') ?></h1>
					<?php if(get_field('sub_text')) : ?>
						<h2 class="hero-text"><?php the_field('sub_text') ?></h2>
					<?php endif; ?>
					<?php if(get_field('link_url')) : ?>
						<a class="btn hero-btn" href="<?php the_field('link_url'); ?>"><?php the_field('link_text') ?></a>
					<?php endif; ?>
					</div>
				</div>
		<?php endif; ?>

		<ul class="rslides">
			<?php if(get_field('link_gallery')) : ?>
				<?php foreach ($images as $image): ?>
						<li><a href="<?php echo get_field('link_gallery'); ?>">
							<div class="rslide-image" style="background-image:url('<?php echo $image['url']; ?>');">
								
							</div>
						</a></li>
				<?php endforeach; ?>
			<?php else : ?>
				<?php foreach ($images as $image): ?>
						<li>
							<div class="rslide-image" style="background-image:url('<?php echo $image['url']; ?>');">
								
							</div>
						</li>
				<?php endforeach; ?>
			<?php endif; ?>
		</ul>
	</div>
<?php endif;
?>