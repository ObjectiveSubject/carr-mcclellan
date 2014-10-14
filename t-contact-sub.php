<?php
/**
 * Template Name: Contact Us - Sub
**/
	get_header();
?>


<body>
	<div id="wrapper">
		<div class="w1">
			<div class="w2">
				<?php include('sidebar.php'); ?>
				<div class="container">
					<header id="header" class="header-4 header-5">
						<div class="panel">
							<span class="addthis link-share">Share</span>
						</div>
						<h1><?=get_the_title();?></h1>
					</header>
					
					<div id="main">
						<section id="content">
							
							
										
										
										
							
							<div class="block-map block-3">
								<div class="map-holder block-2">
									<iframe style="display:none" width="450" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=216+Park+Road+Burlingame,+CA+94010&amp;aq=&amp;sll=37.0625,-95.677068&amp;sspn=68.722451,78.662109&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=216+Park+Rd,+Burlingame,+California+94010&amp;t=m&amp;z=14&amp;ll=37.577726,-122.345757&amp;output=embed&amp;iwloc=near"></iframe>
									
									<a href="http://g.co/maps/x8zug" target="_blank"><img src="<?=get_bloginfo('template_url');?>/images/img-10.gif" alt="image description" /></a>
								</div>
								<div class="block-1 last">
									<h2>Office Information</h2>
									<div class="contact-info">
										
										<?php 
											$query = new WP_Query( 'page_id=20' );
											while($query->have_posts()) :
												$query->the_post();
										?>
									
									
										<?php the_block('Contact Information'); ?>
									</div>
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
											<?php the_block('Directions From San Jose/South Bay');?>
											
											<?php //endwhile; ?>
										</article>
									</li>
								</ul>
							</div>
							
							
							<div style="display:none;">
							<?php
								the_block('Additional Contacts');
								$additional_contacts = get_the_block('Additional Contacts');
								endwhile;
							?>
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
													<strong><a href="<?=$attorney_url;?>"><?=$attorney_name;?></a></strong>
													<dl>
														<dt>P: </dt>
														<dd><?=$attorney_phone;?> <br /></dd>
														<dt>P: </dt>
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
							
							
							<div class="vacancies-list">
								<article class="item">
									<h2 class="block-1 last">Additional Contacts</h2>
									<div class="holder">
										<?php echo $additional_contacts;?>
									</div>
								</article>
							</div>
						</section>
					</div>
					
					
					<?php include('pre-footer.php'); ?>
				</div>
			</div>
		</div>
		
<?php get_footer(); ?>