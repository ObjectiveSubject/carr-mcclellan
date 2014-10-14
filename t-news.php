<?php
/**
 * Template Name: News
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
							<h1><?php the_title();?></h1>
						</div>
					</header>
					
					
					
					<div id="main">
						<section id="content">
							<div class="events">
								<?php
									//$today = date('y/d/m');
									$loop = new WP_Query(array(
											'post_type' => 'news', 
											'meta_key' => 'date',
											'orderby' => 'meta_value',
											'order' => 'DESC',
											'posts_per_page' => 100
										));
									while ( $loop->have_posts() ) : $loop->the_post();
										$custom = get_post_custom($post->ID);
										
										//$date = $custom["date"][0];										
										//$fix_date = explode('/', $date);
										//$fix_date = $fix_date[1] . '/' . $fix_date[2] . '/' . $fix_date[0]; 
										
										$date = $custom["date"][0];	
										$fix_date = explode('/', $date);
										$fix_date = $fix_date[2] . '-' . $fix_date[1] . '-20' . $fix_date[0]; 
										$date = date('M. j, Y', strtotime($fix_date));
										
										$news_type_select = $custom["news_type_select"][0];
										$source = $custom["source"][0];
										$source_url = $custom["source_url"][0];
										$description = $custom["description"][0];
										$summary = $custom["summary"][0];
										
										$link_target = ($news_type_select == 'external' || $news_type_select == 'pdf') ? 'target="_blank"' : '';
										
										$attachments = attachments_get_attachments();
										$pdf = $attachments[0]['location'];
										
										if($news_type_select == 'internal'){
											$source_url = get_permalink();
										}
										if($news_type_select == 'external'){
											$source_url = $source_url;
										}
										if($news_type_select == 'pdf'){
											$source_url = $pdf;
										}
										
										if($pdf){
											//$source_url = $pdf;
										}
										
									//if($today < $date) :
								?>
									
									
									<article class="item">
										<span class="article-date"><?=$date;?></span>
										<h2><a href="<?=$source_url;?>" <?=$link_target;?>>
											<?php the_title();?>
											<?php if($news_type_select == 'external') : ?>
												<img src="<?php bloginfo('template_url');?>/images/external-icon.png" width="10" height="10" alt="External Icon">
											<?php elseif($news_type_select == 'pdf' && $pdf) :?>
												<img src="<?php bloginfo('template_url');?>/images/tiny-pdf.png" width="10" height="10" alt="External Icon">
											<?php endif; ?>
										</a></h2>
										<?php if($source) : ?>
										<span>Source: <?=$source;?></span>
										<?php endif; ?>
									</article>
									
									
								<?php
									//endif;
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