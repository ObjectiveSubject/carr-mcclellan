<?php
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
							<?php include('breadcrumbs.php'); ?>
							<span class="addthis link-share">Share</span>
						</div>
						<h1>Firm History</h1>
					</header>
					<div id="main">
						<section id="content">
							<div class="head-text">
								
								<?php
									$my_id = 14;
									$post_id_14 = get_post($my_id);
									$content = $post_id_14->post_content;
									$content = apply_filters('the_content', $content);
									$content = str_replace(']]>', ']]>', $content);
									echo $content;
								?>
							</div>
							<div class="history">
							
							<?php
								$loop = new WP_Query(array(
										'post_type' => 'milestones', 
										//'meta_key' => 'milestone_date',
										'orderby' => 'menu_order',
										'order' => 'asc',
										'posts_per_page' => 100
									));
								while ( $loop->have_posts() ) : $loop->the_post();
									$custom = get_post_custom($post->ID);
									$milestone_date = "";
									if( $custom["milestone_date"][0] ){
										$milestone_date = date('F Y', $custom["milestone_date"][0]);
									}
							?>
								
								<article class="item">
									<div class="block-2">
										<h2><?php the_title(); ?></h2>
										<span class="date"><?=$milestone_date;?></span>
										<?php the_content();?>
									</div>
									<div class="block-1 last">
										<?php the_post_thumbnail('milestone_thumb');?>
									</div>
								</article>
								
								
							<?php
								endwhile;
							?>
							
							
							</div>
						</section>
					</div>
					
					<?php include('pre-footer.php'); ?>
					
				</div>
			</div>
		</div>
		
<?php get_footer(); ?>