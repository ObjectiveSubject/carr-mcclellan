<?php
/**
 * Template Name: Practices
**/
	get_header();
?>

<body>
	<div id="wrapper">
		<div class="w1">
			<div class="w2">
				<?php include('sidebar.php'); ?>
				<div class="container">					
					<header id="header" class="header-2 header-practices-overview">
						<div class="panel">
							<?php include('breadcrumbs.php'); ?>
							<span class="addthis link-share">Share</span>
						</div>
						<div class="holder">
							<h1><?php the_block('Banner'); ?></h1>
						</div>
					</header>
					
					<div id="main">
						<section id="content">
							<div class="head-text community-head-text practice-head-text practice-head-fix">
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								<?php the_content(); ?>
								<?php endwhile; ?>
								<?php endif; ?>
							</div>
							
							<div class="block-practices">
								<h2>Our Practices</h2>
								<div class="practices">
								
								<?php
									$loop = new WP_Query(array(
											'post_type' => 'practices', 
											//'meta_key' => 'milestone_date',
											'orderby' => 'title',
											'order' => 'ASC',
											'posts_per_page' => 100
										));
									while ( $loop->have_posts() ) : $loop->the_post();
										$custom = get_post_custom($post->ID);
						
								?>
									<article class="item">
										<h3><a href="<?php the_permalink() ?>"><?php the_title();?></a></h3>
										<div class="holder">
											<?php 
												$abbr_content = strip_tags(get_the_content());		
												if(strlen($abbr_content) > 240){								
													$abbr_content = preg_replace('/\s+?(\S+)?$/', '', substr($abbr_content, 0, 240));
													$abbr_content .= '…';
												}
												echo '<p>' . $abbr_content . '</p>';
											?>	
										</div>
									</article>
								<?php
									endwhile;
								?>
								
								</div>
							</div>
						</section>
					</div>
					
					<?php include('pre-footer.php'); ?>
					
				</div>
			</div>
		</div>
		
<?php get_footer(); ?>