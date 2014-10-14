<?php
/**
 * Template Name: Sitemap
**/
	get_header();
?>

<body>
	<div id="wrapper">
		<div class="w1">
			<div class="w2">
				<?php include('sidebar.php'); ?>
				<div class="container">					
					<header id="header" class="header-2 header-news-search-overview">
						<div class="panel">
							<span class="addthis link-share">Share</span>
						</div>
						<div class="holder">
							<h1>Sitemap</h1>
						</div>
					</header>
					
					<div id="main">
						<section id="content">
							<div class="block-practices">
							
							<div style="float: left;width:30%;">
								
								<h3><a href="<?= get_permalink('24'); ?>>">Attorneys</a></h3>
								<ul class="list">
									<?php
										$loop = new WP_Query(array(
												'post_type' => 'attorneys', 
												'meta_key' => 'last_name',
												'orderby' => 'meta_value',
												'order' => 'ASC',
												'posts_per_page' => 100
											));
										while ( $loop->have_posts() ) : 
											$loop->the_post();
											$custom = get_post_custom($post->ID);
									?>
										<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
									<?php
										endwhile;
									?>
								</ul>
								
							</div>
							
							
							
							
							<div style="float: left;width:30%;margin-left:4%;">
							
								<h3><a href="<?= get_permalink('26'); ?>>">Practices</a></h3>
								<ul class="list">
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
									?>
										<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
									<?php
										endwhile;
									?>
								</ul>
								
							</div>
							
							
							
							
							
							
							
							<div style="float: right;width:30%;">
								<h3><a href="<?= get_permalink('12'); ?>>">Our Firm</a></h3>
								<ul class="list">
									<li><a href="<?= get_permalink('14'); ?>">Firm History</a></li>
									<li><a href="<?= get_permalink('16'); ?>">Community Involvement</a></li>
									<li><a href="<?= get_permalink('18'); ?>">Affilations & Memberships</a></li>
									<li><a href="<?= get_permalink('20'); ?>">Contact Information</a></li>
									<li><a href="<?= get_permalink('22'); ?>">Recruiting</a></li>
								</ul>
								
								<p></p>
							
								<h3><a href="<?= get_permalink('32'); ?>>">News & Events</a></h3>
								<ul class="list">
									<li><a href="<?= get_permalink('36'); ?>">Newsletter</a></li>
									<li><a href="<?= get_permalink('39'); ?>">Events</a></li>
									<li><a href="<?= get_permalink('41'); ?>">In the News</a></li>
									<li><a href="<?= get_permalink('43'); ?>">Email Alerts</a></li>
								</ul>
								
								<p></p>
								
								<h3><a href="<?= get_permalink('28'); ?>">Publications</a></h3>
								<!-- <h3><a href="<?= get_permalink('30'); ?>">Clients</a></h3> -->
								<h3><a href="<?= get_permalink('34'); ?>">Blog</a></h3>
								
							</div>
								
							<div style="clear:both;"></div>
								
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
		
<?php get_footer(); ?>