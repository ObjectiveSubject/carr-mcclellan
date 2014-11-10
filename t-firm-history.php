<?php
/**
 * Template Name: Firm History
**/
	get_header();
?>

	<div id="primary" class="content-area page-default">

		<header class="page-header">
			<div class="span12 aligncenter">
				<h1 class="page-title"><?php the_title(); ?></h1>

				<div class="page-subtitle">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</header>

		<main id="main" class="site-main span12 aligncenter" role="main">

			<section id="content" class="span7 aligncenter">

				<div class="history">

				<?php
					$milestones = new WP_Query(array(
							'post_type' => 'milestones',
							'orderby' => 'menu_order',
							'order' => 'asc',
							'posts_per_page' => 100
						));

					$count = 1;
				?>
				<ul class="milestones">
					<?php while ( $milestones->have_posts() ) : $milestones->the_post(); ?>
						<li class="<?php echo $post->post_name; ?> year <?php if ( $count == 1 ) { echo "active"; } ?>">
							<?php the_title(); ?>
						</li>
					<?php $count++; endwhile; ?>
				</ul>

				<?php rewind_posts(); $count = 1; ?>

				<?php while ( $milestones->have_posts() ) : $milestones->the_post(); ?>
					<article class="item milestone <?php echo $post->post_name; ?> <?php if ( $count == 1 ) { echo "active"; } ?>">
						<h2><?php the_title(); ?></h2>
						<?php the_content();?>
					</article>
				<?php $count++; endwhile; ?>

				</div>
			</section>
		
<?php get_footer(); ?>