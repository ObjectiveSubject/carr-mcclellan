<?php
get_header();
?>

	<div id="primary" class="content-area terminal-page">

		<header class="page-header">
			<div class="span12 aligncenter">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</div>
		</header>

		<main id="main" class="site-main span12 aligncenter clear" role="main">

			<aside class="aside aside-left span2 push-left">
				<div class="border-block top">
					<h3 class="block-label">Practices</h3>

					<?php
					$practices = new WP_Query( array(
						'post_type'      => 'practices',
						'orderby'        => 'title',
						'order'          => 'ASC',
						'posts_per_page' => 100
					) );

					while ( $practices->have_posts() ) : $practices->the_post();
						?>
						<ul>
							<li class="<?php echo $post->post_name; ?>">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						</ul>

					<?php endwhile; ?>
				</div>
			</aside>

			<section class="span6 push-left">

				<?php
				$today = date( 'y/m/d' );

				$i = 0;
				while ( have_posts() ) : the_post();
					$custom = get_post_custom( $post->ID );

					$date     = $custom["date"][0];
					$fix_date = explode( '/', $date );
					$fix_date = $fix_date[2] . '-' . $fix_date[1] . '-20' . $fix_date[0];

					// This fixes the abbreviation period when the month is May
					$is_may = date( 'M', strtotime( $fix_date ) );
					if ( $is_may == 'May' ) {
						$fix_date = date( 'M j, Y', strtotime( $fix_date ) );
					} else {
						$fix_date = date( 'M. j, Y', strtotime( $fix_date ) );
					}
					$expired = $custom["expired"][0];


					$time        = $custom["time"][0];
					$location    = $custom["location"][0];
					$description = $custom["description"][0];
					$rsvp        = $custom["rsvp"][0];
					$wufoo       = get_post_meta( $post->ID, 'wufoo', true );

					$attachments = attachments_get_attachments();
					$pdf         = $attachments[0]['location'];

					if ( ! $expired ) :
						?>

						<article class="item event">
							<h2><?php the_title(); ?></h2>

							<?php if ( $pdf ) : ?>
								<a href="<?php echo $pdf; ?>" class="link pdf" target="_blank">Download Flyer</a>
							<?php endif; ?>

							<span><?php echo $fix_date; ?></span><br />

							<?php if ( has_post_thumbnail() ): ?>
								<div class="thumbnail"><?php the_post_thumbnail( 'event-large' ); ?></div>
								<br>
							<?php endif; ?>
							<?php echo $description; ?>
							<?php if ( ! empty( $wufoo ) ) : ?>
								<a href="#wufoo-popup-<?php echo $post->ID; ?>" class="wufoo-reister open-popup-link">EVENT REGISTRATION</a>
								<div id="wufoo-popup-<?php echo $post->ID; ?>" class="white-popup mfp-hide">
									<?php echo do_shortcode( $wufoo ); ?>
								</div>
							<?php endif; ?>
						</article>

						<?php
						$i ++;
					endif;
				endwhile;

				if ( $i == 0 ) :
					?>
					<article class="item">
						<h2>There are currently no Upcoming Events.</h2>
					</article>

				<?php endif; ?>

			</section>
		</main>
	</div>

<?php get_footer(); ?>