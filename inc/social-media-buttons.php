<section id="social-connect" class="text-center">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<p>Connect with Us:
				<?php if(get_field('facebook',14)) : ?>
					<a target="_blank" href="<?php the_field('facebook',14); ?>"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
				<?php endif; ?>
				<?php if(get_field('twitter',14)) : ?>
					<a target="_blank" href="<?php the_field('twitter',14); ?>"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
				<?php endif; ?>
				<?php if(get_field('instagram',14)) : ?>
					<a target="_blank" href="<?php the_field('instagram',14); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
				<?php endif; ?>
				<?php if(get_field('youtube',14)) : ?>
					<a target="_blank" href="<?php the_field('youtube',14); ?>"><i class="fa fa-youtube-square" aria-hidden="true"></i></a>
				<?php endif; ?>
				</p>
			</div>
		</div>
	</div>
</section>