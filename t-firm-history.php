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

				<div class="head-text span7 aligncenter">
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

					while ( $milestones->have_posts() ) : $milestones->the_post();
				?>

					<article class="item">
						<h2><?php the_title(); ?></h2>
						<?php the_content();?>
					</article>

				<?php endwhile; ?>

				</div>
			</section>
		
<?php get_footer(); ?>