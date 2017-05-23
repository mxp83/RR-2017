<?php
/**
 * The template for displaying all single promotions posts and attachments
 *
 * @package understrap
 */

 get_header();
?>
<?php include(get_template_directory() . '/inc/gallery-slider.php'); ?> 

<div class="wrapper" id="full-width-page-wrapper">

  <div class="container" id="content">

    <div class="col-md-12 content-area" id="primary">

      <main class="site-main" id="main" role="main">
      
      	<?php the_breadcrumb(); ?>

        <?php while ( have_posts() ) : the_post(); ?>


          <?php get_template_part( 'loop-templates/content', 'promotions' ); ?>        

        <?php endwhile; // end of the loop. ?>

      </main><!-- #main -->

    </div><!-- #primary -->

  </div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
