<?php
/**
 * Template Name: Newsletter
**/
	get_header();
?>

	<div id="primary" class="content-area">

		<header class="page-header">
			<div class="centered">
				<h1 class="page-title">Current event</h1>
				<div class="page-subtitle"><?php the_content(); ?></div>
			</div>
		</header>

		<main id="main" class="site-main span12 aligncenter" role="main">

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
								<strong>Currently Viewing:</strong>
								<span><?php the_title();?> Issue</span>
								
								<?php if( $in_this_issue[0] ) : ?>
								
								<h2>In This Issue:</h2>
								
								<ul class="news-list">
									<?php
										foreach( $in_this_issue as $issue ) :
											if( $issue != '') :
											
												$get_issue = new WP_Query( array(
													'post_type' => array( 'publications', 'post' ),
													'page_id' => $issue
												));

												while ( $get_issue->have_posts() ) :
													$get_issue->the_post();
													
													$summary = strip_tags( get_the_content() );

													if( strlen( $summary ) > 220 ){
														$summary = preg_replace( '/\s+?(\S+)?$/', '', substr( $summary, 0, 220 ) );
														$summary .= '&hellip;';
													}
									?>
									
										<li>
											<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
											<span><?php echo $summary; ?></span>
										</li>
									
									<?php
												endwhile;
											endif;
										endforeach;
									?>
									
								</ul>
								
								<?php endif; ?>
								
								
								<div class="newsletter-header">
									<h2>President's Message</h2>
									<?php if( $pdf ) : ?><a href="<?php echo $pdf;?>" class="link pdf">PDF Version</a><?php endif; ?>
								</div>
								
								<div class="newsletter-body">
									<?php echo $content;?>
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
											$get_author_url = get_post( $author );
											$author_url = $get_author_url->guid;
										?>
									
									
									
										<?php //echo wp_get_attachment_image( $thumb_id, 'practice-chair'); ?>
										<?php echo get_the_post_thumbnail( $author, 'practice-chair', array('class' => 'png-bg')); ?>
										<div class="holder">
											<strong><a href="<?php echo get_permalink( $author ); ?>"><?php echo $author_name; ?></a></strong>
											<span><?php echo $author_title; ?><?php echo ($author_sec_title) ? ', ' . $author_sec_title : '';?></span>
										</div>
									</div>
								</footer>
							</div>
							
							
							
							<?php endwhile; ?>
							
			</section>
		</main>
	</div>

<?php get_footer(); ?>