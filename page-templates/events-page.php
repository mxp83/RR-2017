<?php
/**
 * Template Name: Events Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_html( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

      				<?php the_breadcrumb(); ?>

							<div class="row">
								<div class="col-sm-12">
									<h3>Upcoming Events</h3>
								</div>
							</div>
							<div class="main-event row">
								<?php 
									// Events List

									$today = current_time('timestamp');
									$args = array(
										'post_type' => 'events',
										'post_status' => 'publish',
										'posts_per_page' => 5,
										'meta_query' => array(
										// 	// has Theater selected as venue
										// 	'key' => 'event_venue',
										// 	'value' => 'Theater'
										// ),
										// array(
											'key' => 'dates',
											'value' => 0,
											'type' => 'NUMERIC',
											'compare' => '>'
										)
									);

									$the_query = new WP_Query( $args );

									if ($the_query->have_posts() ) {
										$i = 0;
										$events = array();

										while ($the_query->have_posts() ) {
											$the_query->the_post();

												do {
													if(get_sub_field('event_date')){
														$event_date = strtotime(get_sub_field('event_date'));
														$permalink = get_permalink();
														$thumbnail = get_the_post_thumbnail_url($post_id,'large');
														$ticket = get_sub_field('event_ticket_link');
														$price = get_field('event_price');
														$title = get_the_title();
														$venue = get_field('event_venue');
														$excerpt = get_the_excerpt();

														if($event_date >= $today) {
															if(isset($events[$title])){
																$events[$title]['dates'][] = $event_date;
																if($event_date < $events[$title]['earliest_date']){
																	$events[$title]['earliest_date'] = $event_date;
																}
															} else {
																$events[$title] = array(
																	'title' => $title,
																	'permalink' => $permalink,
																	'price' => $price,
																	'ticket' => $ticket,
																	'dates' => array($event_date),
																	'earliest_date' => $event_date,
																	'thumbnail' => $thumbnail,
																	'venue' => $venue,
																	'excerpt' => $excerpt

																);
															}
														}; $i++;
													}
												} while(has_sub_field('dates')); ?>
										<?php }; //endwhile ?> 
									<?php }; //endif 
								 ?>

								 <?php 
								 	//sort the array by date
								 	usort($events, function($a, $b) {
								 		return $a['earliest_date'] - $b['earliest_date'];
								 	});

								 	$counter = 0;

								 	//output the event list
								 	foreach ($events as $event) : 

									$permalink = $event['permalink'];
									$title = $event['title'];
									$thumb = $event['thumbnail'];
									$ticket = $event['ticket'];


									?>
									<?php if ($counter == 0) : ?>
											<div class="event-box col-sm-12 col-lg-6">
												<a href="<?php print $permalink ?>">
												<div class="featured-event event-<?php echo $counter; ?>" style="background-image: url(<?php echo $thumb; ?>);">												
												</div>

												</a>
											</div>
											<div class="event-text col-sm-12 col-lg-6">
														<?php //Dates
															$numDates = count($event['dates']);
															$i = 0;
															foreach ($event['dates'] as $date) {
																if($numDates == 1){
																	echo '<div class="calendar-box">';
																	echo '<div class="month">' . date('M', $date) . '</div>';
																	echo '<div class="date">' . date('j', $date) . '</div>';
																	echo '<div class="day">' . date('D', $date) . '</div>';
																	echo '</div>';
																} elseif($i == $numDates-1){
																	$first = date('M', $event['dates'][0]);

																	if($last != $first){
																		echo '<div class="calendar-box">';
																		echo '<div class="month">' . date('M', $event['dates'][0]) . '</div>';
																		echo '<div class="date">' . date('j', $event['dates'][0]) . '</div>';
																		echo '<div class="day">' . date('D', $event['dates'][0]) . '</div>';
																		echo '</div>';
																	}
																} $i++;
															}
														 ?>
														 <div class="event-description">
															<h4><?php echo $title; ?></h4>
															<p>
															<?php echo $event['venue']; ?>
															 </p>
														 </div>
														 <hr>
														 <div class="container">
															 <div class="row justify-content-lg-center">
															 	<div class="col-sm-6">
															 		<a class="btn event-btn buy-btn" href="<?php echo $ticket; ?>">Buy Tickets</a>
															 	</div>
															 	<div class="col-sm-6">
															 		<a class="btn event-btn" href="<?php echo $permalink; ?>">Learn More</a>
															 	</div>
															 </div>
															 <div class="row">
															 	<div class="col-sm-12">
															 		<?php echo $excerpt; ?>
															 	</div>
															 </div>
														 </div>
													</div>
									<?php endif // counter == 0 ?>

									<?php $counter++; ?>
								  <?php endforeach; $i++; ?>


								<!-- THIS IS WHERE ISOTOPE SHOULD GO -->

								<div class="grid" data-isotope='{ "itemSelector" : ".gird-item", "layoutMode" : "fitRows" }'>
								  <?php 
								 	//sort the array by date
								 	usort($events, function($a, $b) {
								 		return $a['earliest_date'] - $b['earliest_date'];
								 	});

								 	$counter = 0;

								 	echo '<div class="col-lg-12 col-xl-12 sub-features">';
								 	echo '<div class="row">';

								 	//output the event list
								 	foreach ($events as $event) : 

									$permalink = $event['permalink'];
									$title = $event['title'];
									$thumb = $event['thumbnail'];
									$ticket = $event['ticket'];
									$venue = $event['venue'];

									//Max out at 5 events on page

									?>
									<?php if ($counter > 0) : ?>
													<div class="grid-item event-box col-lg-3 <?php echo $venue; ?>">
														<a href="<?php print $permalink ?>">
														<div class="sub-event event-<?php echo $counter; ?>" style="background-image: url(<?php echo $thumb; ?>);">
															<div class="event-text">
																<?php //Dates
																	$numDates = count($event['dates']);
																	$i = 0;
																	foreach ($event['dates'] as $date) {
																		if($numDates == 1){
																			echo '<div class="calendar-box">';
																			echo '<div class="month">' . date('M', $date) . '</div>';
																			echo '<div class="date">' . date('j', $date) . '</div>';
																			echo '<div class="day">' . date('D', $date) . '</div>';
																			echo '</div>';
																		} elseif($i == $numDates-1){
																			$first = date('M', $event['dates'][0]);

																			if($last != $first){
																				echo '<div class="calendar-box">';
																				echo '<div class="month">' . date('M', $event['dates'][0]) . '</div>';
																				echo '<div class="date">' . date('j', $event['dates'][0]) . '</div>';
																				echo '<div class="day">' . date('D', $event['dates'][0]) . '</div>';
																				echo '</div>';
																			}
																		} $i++;
																	}
																 ?>
																 <div class="event-description">
																	<h4><?php echo $title; ?></h4>
																	<p>
																	<?php echo $event['venue']; ?>
																	 </p>
																 </div>
															</div>
														</div>
														<hr>
														</a>
													</div>

									<?php endif;
											if($counter % 4 == 0) {
												echo '</div><div class="row">';
											}
									?>

									<?php $counter++; ?>
								  <?php endforeach; $i++; 
								  	echo '</div><!-- Row -->';
								  	echo '</div><!-- Sub Features -->';
								  	echo '</div><!-- Grid -->';
								  ?>
								  <?php wp_reset_postdata(); ?>


							</div><!-- row -->
	
				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->


<?php get_footer(); ?>