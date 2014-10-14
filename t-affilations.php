<?php
/**
 * Template Name: Affiliations & Memberships
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
							<div class="head-text community-head-text">
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								<?php the_content(); ?>
								<?php endwhile; ?>
								<?php endif; ?>
							</div>
							<div class="affilations-extra">
								<?php the_block('Main Body'); ?>
							</div>
							
							<div class="memberships">
							
							<?php
								$loop = new WP_Query(array(
										'post_type' => 'memberships', 
										//'meta_key' => 'milestone_date',
										//'orderby' => 'meta_value',
										//'order' => 'ASC',
										'posts_per_page' => 100
									));
								while ( $loop->have_posts() ) : $loop->the_post();
									$custom = get_post_custom($post->ID);
									$membership_url = $custom["membership_url"][0];
							?>
							
								
								<article class="item">
									<div class="block-2">
										<h2><a href="<?=$membership_url;?>" target="_blank"><?php the_title(); ?></a></h2>
										<?php the_content();?>
									</div>
									<?php the_post_thumbnail('membership_thumb');?>
								</article>
								
								
							<?php
								endwhile;
							?>
							
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
		
<?php get_footer(); ?>