<?php
/**
 * Template Name: Newsletter
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
						
						
					
						
						
						<?php
							$latest = new WP_Query(array(
									'post_type' => 'newsletters', 
									'orderby' => 'date',
									'order' => 'DESC',
									'posts_per_page' => 1
								));
							while ( $latest->have_posts() ) :
								$latest->the_post();
								$custom = get_post_custom($post->ID);
								$author = $custom["author"][0];	
								$in_this_issue_wysiwyg = $custom["in_this_issue_wysiwyg"][0];	
								
								
								$attachments = attachments_get_attachments();
								$pdf = $attachments[0]['location'];
								
								$in_this_issue = get_post_meta($post->ID, 'in_this_issue', 'single');
								$content = get_the_content();
						?>
						
						
						
						
							<div class="block-newsletter">
								<form class="select-form">
									<fieldset>
										<strong>Currently Viewing:</strong>
										<span><?php the_title();?> Issue</span>
										<select class="select-newsletter" id="select-newsletter">
											<option>Browse Newsletters</option>
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
											?>
												<option value="<?php the_permalink();?>"><?php the_title();?></option>
											<?php endwhile; ?>
										</select>
									</fieldset>
								</form>
								
								
								<?php if($in_this_issue[0]) : ?>
								
								<h2>In This Issue:</h2>
								<?php //echo $in_this_issue_wysiwyg;?>
								
								
								<ul class="news-list">
									<?php
										foreach($in_this_issue as $issue) {
											if($issue != '') {
											
												$get_issue = new WP_Query(array(
													'post_type' => array('publications','post'), 
													'page_id' => $issue
												));
												while ( $get_issue->have_posts() ) {
													$get_issue->the_post();
													
													$summary = strip_tags(get_the_content());
													if(strlen($summary) > 220){								
														$summary = preg_replace('/\s+?(\S+)?$/', '', substr($summary, 0, 220));
														$summary .= '…';
													}
									?>
									
										<li>
											<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
											<span><?=$summary;?></span>
										</li>
									
									<?php
												}
											}
										}
									?>
									
								</ul>
								
								<?php endif; ?>
								
								
								<div class="newsletter-header">
									<h2>President's Message</h2>
									<?php if($pdf) : ?><a href="<?=$pdf;?>" class="link pdf">PDF Version</a><?php endif; ?>
								</div>
								
								<div class="newsletter-body">
									<?= $content;?>		
								</div>
								
								
								<footer class="post-footer">
									<div class="block-author">
										
										<?php
											// Get Attorney by Id
											$get_author = get_post_meta($author);
											
											$author_name = $get_author['first_name'][0] . ' ';
											$author_name .= $get_author['middle_initial'][0] . ' ';
											$author_name .= $get_author['last_name'][0];
											$author_title = $get_author['title'][0];
											$author_sec_title = $get_author['secondary_title'][0];
											$thumb_id = $get_author['attorneys_secondary-image_thumbnail_id'][0];
											
											// Get Attorney URL
											$get_author_url = get_post($author);
											$author_url = $get_author_url->guid;
										?>
									
									
									
										<?php //echo wp_get_attachment_image( $thumb_id, 'practice-chair'); ?>
										<?php echo get_the_post_thumbnail( $author, 'practice-chair', array('class' => 'png-bg')); ?>
										<div class="holder">
											<strong><a href="<?= get_permalink($author); ?>"><?=$author_name;?></a></strong>
											<span><?=$author_title;?><?php echo ($author_sec_title) ? ', ' . $author_sec_title : '';?></span>
										</div>
									</div>
								</footer>
							</div>
							
							
							
							<?php
								endwhile;
							?>
							
							
						</section>
					</div>
					
					
					
					
					<?php include('pre-footer.php'); ?>
					
				</div>
			</div>
		</div>

<?php get_footer(); ?>