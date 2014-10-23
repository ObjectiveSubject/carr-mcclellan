<?php
	get_header();
?>
<div id="primary" class="content-area page-default">
	<header class="page-header">
		<div class="span12 aligncenter">
			<h1 class="page-title">Perspectives on Law</h1>
		</div>
	</header>

	<main id="main" class="site-main span12 aligncenter" role="main">

		<section id="content">
		<?php
			$custom = get_post_custom($post->ID);
			$author = $custom["author"][0];
			$in_this_issue = get_post_meta($post->ID, 'in_this_issue', 'single');
			$in_this_issue_wysiwyg = $custom["in_this_issue_wysiwyg"][0];
			$content = get_the_content();
			$attachments = attachments_get_attachments();
			$pdf = $attachments[0]['location'];
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
										'posts_per_page' => 100
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
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
					<?php endwhile; ?>
					<?php endif; ?>
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
				//endwhile;
			?>
		</section>
	</main>
</div>

<?php get_footer(); ?>