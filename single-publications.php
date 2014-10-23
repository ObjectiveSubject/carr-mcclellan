<?php
	get_header();

	$custom = get_post_custom($post->ID);
	$type = wp_get_post_terms($post->ID, 'publications');
	$type = $type[0]->name;
	//$date = get_the_date('m/d/y');
	//$date = get_the_date('M. n, Y');
	$month = strlen( get_the_date(F) );
	$date = ( $month > 3 ? get_the_date('M. j, Y') : get_the_date('M j, Y'));
	$attachments = attachments_get_attachments();
	$pdf = $attachments[0]['location'];
	$pub_attorneys = get_post_meta($post->ID, 'pub_attorneys', 'single');
	$pub_practices = get_post_meta($post->ID, 'pub_practices', 'single');
?>

	<div id="primary" class="content-area page-default">

		<header class="page-header">
			<div class="span12 aligncenter">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</div>
		</header>

		<main id="main" class="site-main span12 aligncenter" role="main">

			<section id="content">); ?>

				<div class="content-holder block-3">
					<article class="block-2">
						<header class="article-head">
							<span class="article-title"><?=$date;?> | <?=$type;?></span>
							<?php if($pdf) : ?><a href="<?=$pdf;?>" class="link pdf">PDF Version</a><?php endif; ?>
						</header>

						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; ?>
						<?php endif; ?>

						<footer class="article-footer">
							<a href="<?= get_permalink('28'); ?>">View All Publications</a>
						</footer>
					</article>
					<div class="block-1 last">
						<h2>Practice Areas</h2>
						<ul class="list list-2">
							<?php
								$loop = new WP_Query(array(
										'post_type' => 'practices',
										'orderby' => 'title',
										'order' => 'ASC',
										'posts_per_page' => 100
									));
								while ( $loop->have_posts() ) : $loop->the_post();
								if(in_array($post->ID, $pub_practices)) :
							?>
								<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
							<?php
								endif;
								endwhile;
							?>
						</ul>
						<h2>Attorneys</h2>
						<ul class="list list-2 attorney_publication">
							<?php
								$loop = new WP_Query(array(
										'post_type' => 'attorneys',
										'meta_key' => 'last_name',
										'orderby' => 'meta_value',
										'order' => 'ASC',
										'posts_per_page' => 100
									));
								while ( $loop->have_posts() ) : $loop->the_post();
								if(in_array($post->ID, $pub_attorneys)) :
							?>
								<li>
									<?php the_post_thumbnail('attorney-detail', array('class' => 'aligncenter')); ?>
									<a href="<?php the_permalink(); ?>"><?php the_title();?></a>
								</li>
							<?php
								endif;
								endwhile;
							?>
						</ul>
						<form class="sign-form sign-form-2 sign-form-3" action="#">
							<fieldset>
								<h2>Email sign up</h2>
								<p><?php echo get_option('email_signup'); ?></p>
								<div class="row">
									<input type="text" class="text" />
									<input type="submit" class="btn-submit" value="search" />
								</div>
								<a href="/overlays/rss.html" class="link-rss">Subscribe to our RSS feeds</a>
							</fieldset>
						</form>
					</div>
				</div>
			</section>
		</div>

<?php get_footer(); ?>