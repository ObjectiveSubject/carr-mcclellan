<?php
/**
 * Template Name: Contact Us
**/
	get_header();
?>

<body>
	<div id="wrapper">
		<div class="w1">
			<div class="w2">
				<?php include('sidebar.php'); ?>
				<div class="container">
					<header id="header" class="header-4 header-our-firm-detail">
						<div class="panel">
							<span class="addthis link-share">Share</span>
						</div>
						<h1><?=get_the_title();?></h1>
					</header>
					
					<div id="main">
						<section id="content">
						
							<div class="block-map block-3">
								<div class="block-1">
									<h4>Office Information</h4>
									<div class="contact-info">
										<?php the_block('Contact Information'); ?>
									</div>
								</div>
								<div class="map-holder block-2 last">
									
									<a href="http://g.co/maps/x8zug" target="_blank"><img src="<?=get_bloginfo('template_url');?>/images/img-10.gif" alt="image description" /></a>
								</div>
							</div>
							
							<div class="block-3" style="margin-bottom: 30px;">
								<div class="block-1">
									<h2>Recruiting Contacts</h2>
									<?php the_block('Recruiting Contacts'); ?>
								</div>
								<div class="block-1">
									<h2>Media Inquiries</h2>
									<?php the_block('Media Inquiries'); ?>
								</div>
								<div class="block-1 last">
									<h2>General Inquiries</h2>
									<?php the_block('General Inquiries'); ?>
								</div>
							</div>
							
							
							<div class="block-3">
								<h2>DRIVING DIRECTIONS</h2>
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
								<h2>PRACTICE CHAIR CONTACTS</h2>
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
													<?php //echo $attorney_thumb;?>
													<?php echo get_the_post_thumbnail( $chair_id, 'attorney-thumb', array('class' => 'alignleft png-bg')); ?>
													<strong><a href="<?= get_permalink($chair_id); ?>"><?=$attorney_name;?></a></strong>
													<dl>
														<dt>P: </dt>
														<dd><?=$attorney_phone;?> <br /></dd>
														<dt>F: </dt>
														<dd><?=$attorney_fax;?></dd>
													</dl>
													<a href="mailto:<?=$attorney_email;?>"><?=$attorney_email;?></a>
												</div>
											</article>
										</li>
										
										
										
									<?php
										endwhile;
									?>
								
								
									
									

								</ul>
							</div>
						</section>
					</div>
					
					
					<?php include('pre-footer.php'); ?>
				</div>
			</div>
		</div>
		
<?php get_footer(); ?>