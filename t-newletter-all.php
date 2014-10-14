<?php
/**
 * Template Name: Newsletter All
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
							<h1>Perspectives on Law</h1>
						</div>
					</header>
					
		
					
					
					
					<div id="main">
						<section id="content">	
						
							<h2 style="font-size:18px;text-transform:none;margin:20px 0px;">All Newsletters</h2>
							<?php
								$get_newsletters = new WP_Query(array(
										'post_type' => 'newsletters', 
										'orderby' => 'date',
										'order' => 'DESC',
										'posts_per_page' => 100,
										'offset' => 1
									));
								while ( $get_newsletters->have_posts() ) :
									$get_newsletters->the_post();
									$custom = get_post_custom($post->ID);
									
									$abbr_content = strip_tags(get_the_content());
									if(strlen($abbr_content) > 300){								
										$abbr_content = preg_replace('/\s+?(\S+)?$/', '', substr($abbr_content, 0, 300));
										$abbr_content .= '…';
									}
							?>
								<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
								<p style="border-bottom: 1px solid #e5e5e5;padding-bottom:20px;margin-bottom:20px;"><?=$abbr_content ?> <a href="<?php the_permalink();?>">Read More &raquo;</a></p>
							
							<?php endwhile; ?>
									
							<p></p>	
							<p></p>									
							
						</section>
					</div>
				</div>
			</div>
		</div>

<?php get_footer(); ?>