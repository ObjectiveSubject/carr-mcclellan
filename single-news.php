<?php
	get_header();
	$custom = get_post_custom($post->ID);
	$summary = $custom["summary"][0];
	$date = $custom["date"][0];
	$source = $custom["source"][0];
	$source_url = $custom["source_url"][0];
	$attachments = attachments_get_attachments();
	$pdf = $attachments[0]['location'];
?>
	<div id="primary" class="content-area page-default">
		<header class="page-header">
			<div class="span12 aligncenter">
				<h1 class="page-title">In the News</h1>
			</div>
		</header>

		<main id="main" class="site-main span12 aligncenter" role="main">

			<section id="content">
				<header class="article-head">
					<div class="article-title">
						<?php
							$fix_date = explode('/', $date);
							$fix_date = $fix_date[2] . '-' . $fix_date[1] . '-20' . $fix_date[0];
							$fix_date = date('M. j, Y', strtotime($fix_date));
							echo ($fix_date) ? $fix_date : '';
							if($date && $source){
								echo ' | ';
								if($source_url){
									echo 'Source: <a href="' . $source_url . '">' . $source . '</a>';
								} else {
									echo 'Source: ' . $source;
								}
							}
						?>
					</div>

					<div>
						<?php if($pdf) : ?><a href="<?=$pdf;?>" class="link pdf">PDF Version</a><?php endif; ?>
					</div>

				</header>
				<div class="content-holder block-3">
				<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail('news-medium', array('class' => 'alignright news-image'));
					}
				?>
				<h3><?php the_title();?></h3>
				<?php echo $summary; ?>
				</div>
			</section>
		</main>

<?php get_footer(); ?>