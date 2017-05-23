<?php
/**
 * Upcoming Events for Front Page
 *
 * @package understrap
 */

?>
<section id="events-front-page" class="">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>Upcoming Events</h3>
			</div>
		</div>
		<div class="row">
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
												'venue' => $venue

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

				//Max out at 5 events on page

				?>
				<?php if ($counter == 0) : ?>
					<div class="event-box col-md-12 col-xl-6">
						<a href="<?php print $permalink ?>">
						<div class="featured-event event-<?php echo $counter; ?>" style="background-image: url(<?php echo $thumb; ?>);">
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
				<?php endif // counter == 0 ?>

				<?php $counter++; ?>
			  <?php endforeach; $i++; ?>
			 <?php 
			 	//sort the array by date
			 	usort($events, function($a, $b) {
			 		return $a['earliest_date'] - $b['earliest_date'];
			 	});

			 	$counter = 0;

			 	echo '<div class="col-lg-12 col-xl-6 sub-features">';
			 	echo '<div class="row">';

			 	//output the event list
			 	foreach ($events as $event) : 

				$permalink = $event['permalink'];
				$title = $event['title'];
				$thumb = $event['thumbnail'];
				$ticket = $event['ticket'];

				//Max out at 5 events on page

				?>
				<?php if ($counter > 0 && $counter < 3) : ?>
							<?php if ($counter == 1 || $counter == 2) { ?>
								<div class="event-box col-lg-6">
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
							<?php } ?>

				<?php endif;  // counter > 1 && < 3

				if($counter == 2) {
					echo '</div><div class="row">';
				}
				?>


				<?php if ($counter > 2 && $counter < 5) : ?>
							<?php if ($counter == 3 || $counter == 4) { ?>
								<div class="event-box col-lg-6">
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
							<?php } ?>

				<?php endif;  // counter > 1 && < 3 ?>

				<?php $counter++; ?>
			  <?php endforeach; $i++; 
			  	echo '</div><!-- Row -->';
			  	echo '</div><!-- Sub Features -->';
			  ?>
			<?php //end have_posts
				// possibly put link to events page below this area but before reset_postdata

			 ?>
			  <?php wp_reset_postdata(); ?>


		</div><!-- row -->
		<div class="row">
			<div class="col-sm-12">
				<a href="#">See more events</a>
			</div>
			
		</div>
	</div><!-- container -->
</section>