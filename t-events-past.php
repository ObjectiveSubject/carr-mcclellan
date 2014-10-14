<?php
/**
 * Template Name: Past Events
**/
	get_header();
?>

<body>
	<div id="wrapper">
		<div class="w1">
			<div class="w2">
				<?php include('sidebar.php'); ?>
				<div class="container">


					<header id="header" class="header-4 header-news-search-detail">
						<div class="panel">
							<span class="addthis link-share">Share</span>
						</div>
						<div class="holder">
							<h1><?php the_title();?></h1>
						</div>
					</header>

					<div id="main">
						<section id="content">
							<p><a href="<?php echo get_permalink('39'); ?>">&laquo; Upcoming Events</a></p>

							<div class="events">

								<?php

									$today = date('y/m/d');

									$loop = new WP_Query(array(
											'post_type' => 'events',
											'meta_key' => 'date',
											'orderby' => 'meta_value',
											'order' => 'DESC',
											'posts_per_page' => 100
										));
									while ( $loop->have_posts() ) : $loop->the_post();
										$custom = get_post_custom($post->ID);

										$date = $custom["date"][0];
										$fix_date = explode('/', $date);
										$fix_date = $fix_date[2] . '-' . $fix_date[1] . '-20' . $fix_date[0];

										// This fixes the abbreviation period when the month is May
										$is_may = date('M', strtotime($fix_date));
										if($is_may == 'May') {
											$fix_date = date('M j, Y', strtotime($fix_date));
										} else {
											$fix_date = date('M. j, Y', strtotime($fix_date));
										}
										$expired = $custom["expired"][0];

										$time = $custom["time"][0];
										$location = $custom["location"][0];
										$description = $custom["description"][0];
										$rsvp = $custom["rsvp"][0];

										$attachments = attachments_get_attachments();
										$pdf = $attachments[0]['location'];
										$presentation = get_field('event_presentation_materials');

									if( $expired ) :
								?>

									<article class="item">
										<h2><?php the_title(); ?></h2>
										<?php if($pdf) : ?>
										<a href="<?php echo $pdf;?>" class="link pdf" style="float:right;" target="_blank">Download Flyer</a>
										<?php endif; ?>
										<span><?php echo $fix_date;?></span><br/>
										<?php echo $description;?>
										<?php if($presentation) : ?>
										<a href="<?php echo $presentation; ?>" class="presentation-btn" target="_blank">Download Presentation</a>
										<?php endif; ?>
									</article>

								<?php
									endif;
									endwhile;
								?>

							</div>
						</section>
					</div>
				</div>
			</div>
		</div>

<?php get_footer(); ?>