<?php
/**
 * Template Name: News
**/
	get_header();
?>

	<div id="primary" class="content-area page-default">

		<header class="page-header">
			<div class="span12 aligncenter">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</div>
		</header>

		<main id="main" class="site-main span12 aligncenter" role="main">

			<section id="content" class="span6 aligncenter">
				<div class="events">
					<?php
						$loop = new WP_Query(array(
								'post_type' => 'news',
								'meta_key' => 'date',
								'orderby' => 'meta_value',
								'order' => 'DESC',
								'posts_per_page' => 100
							));

						while ( $loop->have_posts() ) : $loop->the_post();
							$date = get_post_meta( $post->ID, 'date', true );
							$fix_date = explode('/', $date);
							$fix_date = $fix_date[2] . '-' . $fix_date[1] . '-20' . $fix_date[0];
							$date = date('M. j, Y', strtotime($fix_date));

							$news_type_select = get_post_meta( $post->ID, 'news_type_select', true );
							$source = get_post_meta( $post->ID, 'source', true );
							$source_url = get_post_meta( $post->ID, 'source_url', true );
							$description = get_post_meta( $post->ID, 'description', true );
							$summary = get_post_meta( $post->ID, 'summary', true );

							$link_target = ( $news_type_select == 'external' || $news_type_select == 'pdf') ? 'target="_blank"' : '';

							$attachments = attachments_get_attachments();
							if ( $attachments ) {
								$pdf = $attachments[0]['location'];
							} else { $pdf = ''; }

							if( $news_type_select == 'internal' ){
								$source_url = get_permalink();
							}
							if( $news_type_select == 'external' ){
								$source_url = $source_url;
							}
							if( $news_type_select == 'pdf' ){
								$source_url = $pdf;
							}

							if( $pdf ){
								//$source_url = $pdf;
							}

						//if($today < $date) :
					?>


						<article class="item">
							<span class="article-date"><?php echo $date; ?></span>
							<h2><a href="<?php echo $source_url; ?>" <?php echo $link_target; ?>>
								<?php the_title();?>
								<?php if( $news_type_select == 'external' ) : ?>
									<img src="<?php bloginfo( 'template_url' );?>/images/external-icon.png" width="10" height="10" alt="External Icon">
								<?php elseif( $news_type_select == 'pdf' && $pdf ) :?>
									<img src="<?php bloginfo( 'template_url' );?>/images/tiny-pdf.png" width="10" height="10" alt="External Icon">
								<?php endif; ?>
							</a></h2>
							<?php if( $source ) : ?>
							<span>Source: <?php echo $source; ?></span>
							<?php endif; ?>
						</article>


					<?php
						//endif;
						endwhile;
					?>
				</div>
			</section>

		</main>
	</div>

<?php get_footer(); ?>