<?php
/**
 * Template Name: News & Events
**/
	get_header();
?>

	<div id="primary" class="content-area">

		<header class="page-header">
			<div class="centered">
				<?php get_template_part('t-site-branding'); ?>
				<h1 class="page-title"><?php the_block('Banner Text'); ?></h1>
				<div class="page-subtitle"><?php the_content(); ?></div>
			</div>

			<?php while ( have_posts() ) : the_post(); ?>

				<main id="main" class="site-main span12 aligncenter" role="main">

					<?php get_template_part( 'content', 'page' ); ?>

				</main><!-- #main -->

			<?php endwhile; // end of the loop. ?>
		</header>


		<main id="main" class="site-main span12 aligncenter" role="main">
						<section id="content">
							<div class="head-text">
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								<?php the_content(); ?>
								<?php endwhile; ?>
								<?php endif; ?>
							</div>

							<div class="info-list">



								<article class="item">
									<h2 class="block-1"><a href="<?php echo get_page_link('36'); ?>">Newsletter</a></h2>
									<div class="block-2">
										<div class="item">
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
										?>
											<header class="info-head">
												<h3><a href="<?php echo get_page_link('36'); ?>"><?php the_title();?> Issue</a></h3>
												<!-- <span><?php the_date('m/d/y');?></span> -->
											</header>
											<?php the_excerpt() ;?>
										<?php endwhile; wp_reset_query(); ?>
										</div>
										<a href="<?php echo get_page_link('36'); ?>" class="more">View Current Issue</a>
									</div>
								</article>




								<article class="item article-events">
									<h2 class="block-1"><a href="<?php echo get_page_link('39'); ?>">Events</a></h2>
									<div class="block-2">
										<div class="item">
											<?php
												$today = date('y/m/d');
												$loop = new WP_Query(array(
														'post_type' => 'events',
														'meta_key' => 'date',
														'orderby' => 'meta_value',
														'order' => 'DESC',
														'posts_per_page' => 100
													));
												$count = 1;
												while ( $loop->have_posts() ) : $loop->the_post();
													$custom = get_post_custom($post->ID);
													$date = $custom["date"][0];
													$fix_date = explode('/', $date);
													//$fix_date = $fix_date[1] . '/' . $fix_date[2] . '/' . $fix_date[0];
													$fix_date = $fix_date[2] . '-' . $fix_date[1] . '-20' . $fix_date[0];

													// This fixes the abbreviation period when the month is May
													$is_may = date('M', strtotime($fix_date));
													if($is_may == 'May') {
														$fix_date = date('M j, Y', strtotime($fix_date));
													} else {
														$fix_date = date('M. j, Y', strtotime($fix_date));
													}
													$expired = $custom["expired"][0];

													$time = $custom["time"][0];
													$location = $custom["location"][0];
													$description = $custom["description"][0];
													$rsvp = $custom["rsvp"][0];
													$wufoo = get_post_meta($post->ID, 'wufoo', true);

												if( $count == 1  && !$expired ) :
											?>

												<header class="info-head">
													<h3><?php the_title(); ?></h3>
													<span><?php echo $fix_date;?></span>
												</header>
												<?php if (has_post_thumbnail()):?>
													<div class="thumbnail"><?php the_post_thumbnail('event-medium');?></div><br>
												<?php endif; ?>
												<?php echo $description;?>
												<?php if( !empty($wufoo) ) : ?>
													<a href="#wufoo-popup-<?php echo $post->ID; ?>" class="wufoo-reister open-popup-link">EVENT REGISTRATION</a>
													<div id="wufoo-popup-<?php echo $post->ID; ?>" class="white-popup mfp-hide">
														<?php echo do_shortcode( $wufoo ); ?>
													</div>
												<?php endif; ?>

											<?php
												$count++;
												endif;
												endwhile;
											?>
										</div>
										<a href="<?php echo get_page_link('39'); ?>" class="more">View All Events</a>
									</div>
								</article>

								<?php if($count == 1) : ?>
									<script type="text/javascript">
										$(function(){
											$('.article-events').remove();
										});
									</script>
								<?php endif; ?>





								<article class="item">
									<h2 class="block-1"><a href="<?php echo get_permalink('41'); ?>">In the News</a></h2>
									<div class="block-2">
										<div class="item">
											<?php
												$news = new WP_Query(array(
														'post_type' => 'news',
														'meta_key' => 'date',
														'orderby' => 'meta_value',
														'order' => 'DESC',
														'posts_per_page' => 2
													));
												$i = 0;
												while ( $news->have_posts() ) : $news->the_post();
													$custom = get_post_custom($post->ID);

													$date = $custom["date"][0];
													$fix_date = explode('/', $date);
													$fix_date = $fix_date[2] . '-' . $fix_date[1] . '-20' . $fix_date[0];
													$date = date('M. j, Y', strtotime($fix_date));

													$source = $custom["source"][0];
													$source_url = $custom["source_url"][0];
													$summary = $custom["summary"][0];
													//$news_attorneys = get_post_meta($post->ID, 'news_attorneys', 'single');


													$news_type_select = $custom["news_type_select"][0];
													$link_target = ($news_type_select == 'external' || $news_type_select == 'pdf') ? 'target="_blank"' : '';

													if($news_type_select == 'internal'){
														$source_url = get_permalink();
													}

													$attachments = attachments_get_attachments();
													$pdf = $attachments[0]['location'];
													if($pdf){
														$source_url = $pdf;
													}




												//if(in_array($this_post, $news_attorneys)) :
											?>

												<div style="margin-bottom:20px;">
													<?php echo $date;?> | Source: <?php echo $source;?><br />
													<a href="<?php echo $source_url;?>" <?php echo $link_target;?>><strong><?php the_title();?></strong></a>
													<?php if($news_type_select == 'external') : ?>
														<img src="<?php bloginfo('template_url');?>/images/external-icon.png" width="10" height="10" alt="External Icon">
													<?php elseif($news_type_select == 'pdf' || $pdf) :?>
														<img src="<?php bloginfo('template_url');?>/images/tiny-pdf.png" width="10" height="10" alt="External Icon">
													<?php endif; ?>
												</div>


											<?php
												$i++;
												//endif;
												endwhile;
												wp_reset_query();
												if($i == 0) :
											?>
												<script type="text/javascript">
													$(function(){
														$('.li-news').remove();
													});
												</script>
											<?php
												endif;
											?>
										</div>
										<a href="<?php echo get_permalink('41'); ?>" class="more">View All News</a>
									</div>
								</article>



								<article class="item">
									<h2 class="block-1"><a href="<?php echo get_permalink('34'); ?>">Blog</a></h2>
									<div class="block-2">
										<?php
											// For some reason, the while loop for posts
											// breaks the content block for the Media Contact.
											// Silly geese!
											$bonanza = get_the_block('Media Contact');
										?>


										<?php
											$blogs = new WP_Query(array(
													'post_type' => 'post',
													'orderby' => 'date',
													'order' => 'DESC',
													'posts_per_page' => 2
												));

											while ( $blogs->have_posts() ) :
												$blogs->the_post();
										?>

											<div style="margin-bottom:20px;">
												<?php the_date('M. j, Y');?><br />
												<a href="<?php the_permalink();?>"><strong><?php the_title();?></strong></a>
											</div>


										<?php
											endwhile;
										?>

										<a href="<?php echo get_permalink('34'); ?>" class="more">View All Blog Posts</a>
									</div>
								</article>


								<article class="item">
									<h2 class="block-1"><a href="">Media Contact</a></h2>
									<div class="block-2">
										<div class="item">
											<header class="info-head">
												<?php the_block('Media Contact'); echo $bonanza; ?>
											</header>
										</div>
									</div>
								</article>


							</div>
						</section>
					</div>

	</main>

<?php get_footer();