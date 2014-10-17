<?php
/**
 * Template Name: Contact Us
**/
	get_header();

	$recruiting = get_the_block('Recruiting Contacts');
	$media = get_the_block('Media Inquiries');
	$general = get_the_block('General Inquiries');

?>

	<header class="page-header">
		<div class="span12 aligncenter">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>
	</header>

	<main id="main" class="site-main span12 aligncenter clear" role="main">

		<aside class="aside aside-left span2 push-left">
			<div class="border-block top">
				<h3 class="block-label">Office Information</h3>

				<div class="contact-info">
					<?php the_block('Contact Information'); ?>
				</div>
			</div>
		</aside>

		<section class="span6 push-left">

			<div class="map">
				<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3162.039735687411!2d-122.345876!3d37.577681999999974!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x77e71cc26af14a88!2sCarr+Mc+Clellan+Ingersoll!5e0!3m2!1sen!2sus!4v1413574578515"></iframe>
			</div>

			<div class="block-3">
				<h2>Driving Directions</h2>
				<ul class="list-content accordion">
					<li>
						<a href="#" class="opener">From San Francisco/North Bay</a>
						<article class="slide">
							<?php the_block('Directions From San Francisco/North Bay'); ?>
						</article>
					</li>
					<li>
						<a href="#" class="opener">From San Jose/South Bay</a>
						<article class="slide">
							<?php the_block('Directions From San Jose/South Bay'); ?>
						</article>
					</li>
				</ul>
			</div>

			<div class="block-3">
				<h2>Practice Chair Contacts</h2>
				<ul class="list-content accordion">

					<?php
						$loop = new WP_Query(array(
								'post_type' => 'practices',
								'orderby' => 'title',
								'order' => 'ASC',
								'posts_per_page' => 100
							));
						while ( $loop->have_posts() ) :
							$loop->the_post();
							$custom = get_post_custom($post->ID);
							$chair_id = $custom["chair_id"][0];

							$attorney = get_post_custom($chair_id);
							$attorney_name = $attorney['first_name'][0] . ' ';
							$attorney_name .= $attorney['middle_initial'][0] . ' ';
							$attorney_name .= $attorney['last_name'][0];
							$attorney_phone = $attorney['phone'][0];
							$attorney_fax = $attorney['fax'][0];
							$attorney_email = $attorney['email'][0];
							$attorney_url = site_url() . '/?page_id=' . $chair_id;

							$attorney_thumb_id = $attorney['attorneys_secondary-image_thumbnail_id'][0];
							$attorney_thumb = wp_get_attachment_image($attorney_thumb_id, 'attorney-thumb');

					?>


						<li>
							<a href="#" class="opener"><?php the_title();?></a>
							<article class="slide">
								<div class="block-person">
									<?php echo get_the_post_thumbnail( $chair_id, 'attorney-thumb', array('class' => 'alignleft png-bg') ); ?>
									<strong><a href="<?php get_permalink($chair_id); ?>"><?php echo $attorney_name; ?></a></strong>
									<dl>
										<dt>P: </dt>
										<dd><?php echo $attorney_phone; ?> <br /></dd>
										<dt>F: </dt>
										<dd><?php echo $attorney_fax; ?></dd>
									</dl>
									<a href="mailto:<?php echo $attorney_email; ?>"><?php echo $attorney_email; ?></a>
								</div>
							</article>
						</li>



					<?php endwhile; ?>

				</ul>
			</div>

		</section>

		<aside class="aside aside-right span2">
			<div class="border-block top">
				<h3 class="block-label">Recruiting Contacts</h3>

				<?php echo $recruiting; ?>
			</div>
			<div class="block-1">
				<h3 class="block-label">Media Inquiries</h3>
				<?php echo $media; ?>
			</div>
			<div class="block-1 last">
				<h3 class="block-label">General Inquiries</h3>
				<?php echo $general; ?>
			</div>
		</aside>

	</main>
		
<?php get_footer(); ?>