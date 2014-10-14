<?php
/**
 * Template Name: Events
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
							<p style="text-align:right"><a href="<?php echo get_permalink('462'); ?>">Archive of Past Events &raquo;</a></p>

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
									$i = 0;
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
										$wufoo = get_post_meta($post->ID, 'wufoo', true);

										$attachments = attachments_get_attachments();
										$pdf = $attachments[0]['location'];

									if( !$expired ) :
								?>

									<article class="item">
										<h2 style="float: left; width: 70%;"><?php the_title(); ?></h2>
										<?php if($pdf) : ?>
										<a href="<?php echo $pdf;?>" class="link pdf" style="float:right;" target="_blank">Download Flyer</a>
										<?php endif; ?>
										<div style="clear:both;"></div>

										<span><?php echo $fix_date;?></span><br />

										<?php if (has_post_thumbnail()):?>
											<div class="thumbnail"><?php the_post_thumbnail('event-large');?></div><br>
										<?php endif; ?>
										<?php echo $description; ?>
										<?php if( !empty($wufoo) ) : ?>
											<a href="#wufoo-popup-<?php echo $post->ID; ?>" class="wufoo-reister open-popup-link">EVENT REGISTRATION</a>
											<div id="wufoo-popup-<?php echo $post->ID; ?>" class="white-popup mfp-hide">
												<?php echo do_shortcode( $wufoo ); ?>
											</div>
										<?php endif; ?>
									</article>

								<?php
									$i++;
									endif;
									endwhile;

									if($i == 0) :
								?>
									<article class="item">
										<h2>There are currently no Upcoming Events.</h2>
									</article>

								<?php endif; ?>

							</div>
						</section>
					</div>

					<?php include('pre-footer.php'); ?>

				</div>
			</div>
		</div>

<?php get_footer(); ?>