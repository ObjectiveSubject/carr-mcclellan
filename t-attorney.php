<?php
/**
 * Template Name: Attorney Landing
**/
	get_header();
?>

<body>
	<div id="wrapper">
		<div class="w1">
			<div class="w2">
				<?php include('sidebar.php'); ?>
				<div class="container">
					<header id="header" class="header-2 header-attorney-overview">
						<div class="panel">
							<span class="addthis link-share">Share</span>
						</div>
						<div class="holder">
							<h1><?php the_block('Banner'); ?></h1>
						</div>
					</header>
					
					<div id="main">
						<section id="content">
							
							
							<section class="block-attorneys">
								<div class="panel">
									<h2>Our Attorneys</h2>
									<ul class="tabset view-type">
										<li><a href="#tab-1" class="tab active type-1" title="List View">list</a></li>
										<li><a href="#tab-2" class="tab type-2" title="Compact View">table</a></li>
									</ul>
								</div>
								<!-- tab1 -->
								<div class="tab-content" id="tab-1">

								
								
								
									<ul class="paging">
										<li><a href="#" class="view-1">A-G</a></li>
										<li><a href="#" class="view-2">H-P</a></li>
										<li><a href="#" class="view-3">Q-Z</a></li>
										<li class="active"><a href="#" class="view-all">View All</a></li>
									</ul>
									<div class="attorneys">
									
									<?php
										$loop = new WP_Query(array(
												'post_type' => 'attorneys',
												'post_status' => 'publish',
												'orderby' => 'menu_order',
												'order' => 'ASC',
												'posts_per_page' => -1
											));
										while ( $loop->have_posts() ) : $loop->the_post();
											$custom = get_post_custom($post->ID);
											$name = $custom["first_name"][0].' ';
											$name .= $custom["middle_initial"][0] . ' ';
											$name .= $custom["last_name"][0];
											
											$title = $custom["title"][0];
											$sec_title = $custom["secondary_title"][0];
											$abbr_biography = $custom["abbr_biography"][0];
											$areas_practice = get_post_meta($post->ID, 'areas_practice', true);
											
											$last_initial = $custom["last_name"][0];
											$last_initial = strtolower(substr($last_initial,0,1));
											$a_g = array('a','b','c','d','e','f','g');
											$h_p = array('h','i','j','k','l','m','n','o','p');
											$q_z = array('q','r','s','t','u','v','w','x','y','z');
											
											if(in_array($last_initial, $a_g)){
												$view = 'view-1';
											}
											if(in_array($last_initial, $h_p)){
												$view = 'view-2';
											}
											if(in_array($last_initial, $q_z)){
												$view = 'view-3';
											}
									?>
										<article class="item attorney-list <?=$view;?>">
											<div class="block-2">
												<?php the_post_thumbnail('attorney-thumb', array('class' => 'alignleft png-bg')); ?>
												<?php 
													/*
if (class_exists('MultiPostThumbnails')
													&& MultiPostThumbnails::has_post_thumbnail('attorneys', 'secondary-image')) :
													MultiPostThumbnails::the_post_thumbnail(
														'attorneys', 'secondary-image', NULL, 'attorney-thumb', array('class' => 'alignleft')
													); 
													endif; 
*/
												?>
												<h3><a href="<?php the_permalink() ?>"><?=$name;?></a></h3>
												<em class="post">
													<?=$title;?>
													<?=($title && $sec_title) ? ' | ' : ''; ?>
													<?=$sec_title;?>
												</em>
												<p><?=$abbr_biography;?>… <a href="<?php the_permalink() ?>">read bio</a></p>
											</div>
											<div class="block-1 last">
												<span>Areas of Practice:</span>
												<ul class="list">
												
													<?php
														$practices = new WP_Query(array(
																'post_type' => 'practices', 
																'orderby' => 'title',
																'order' => 'ASC',
																'posts_per_page' => 100
															));
														while ( $practices->have_posts()) :
															$practices->the_post();
															$custom = get_post_custom($post->ID);
															$name = get_the_title();
															$cust_name = str_replace(',','', $name);
															$cust_name = str_replace('&','', $cust_name);
															if(is_array($areas_practice) && in_array($cust_name, $areas_practice)) :
													?>
														<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
													<?php
														endif;
														endwhile;
													?>
												</ul>
											</div>
										</article>										
									<?php
										endwhile;
									?>
												
										
									</div>
									<ul class="paging">
										<li><a href="#" class="view-1">A-G</a></li>
										<li><a href="#" class="view-2">H-P</a></li>
										<li><a href="#" class="view-3">Q-Z</a></li>
										<li class="active"><a href="#" class="view-all">View All</a></li>
									</ul>
								</div>
								<!-- tab2 -->
								<div id="tab-2" class="tab-content">
									<ul class="attorney-2">
										<?php
											$attorneys_z = new WP_Query(array(
													'post_type' => 'attorneys', 
													'meta_key' => 'last_name',
													'orderby' => 'meta_value',
													'order' => 'ASC',
													'posts_per_page' => 100
												));
											$o = 1;
											while ( $attorneys_z->have_posts() ) : 
												$attorneys_z->the_post();
												$custom = get_post_custom($post->ID);
												$name = $custom["first_name"][0].' ';
												$name .= $custom["middle_initial"][0] . ' ';
												$name .= $custom["last_name"][0];
												
												$title = $custom["title"][0];
												$sec_title = $custom["secondary_title"][0];
												
												echo ($o & 1) ? '<li>' : '';
										?>
										
											<div class="item">
												<h2><a href="<?php the_permalink();?>"><?=$name;?></a></h2>
												<strong><?=$title;?></strong>
												<strong><?=$sec_title;?></strong>
											</div>
										
										<?php
											echo ($o & 1) ? '' : '</li>';
											$o++;
											endwhile;
										?>
										
										
									</ul>
								</div>
							</section>
						</section>
					</div>	
					
					<?php include('pre-footer.php'); ?>
				</div>
			</div>
		</div>
		
<?php get_footer(); ?>