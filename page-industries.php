<?php

get_header();

$industries = new WP_Query( array(
	'post_type' => 'industries',
	'orderby' => 'title',
	'order' => 'ASC',
	'posts_per_page' => 100
));


?>

	<header class="page-header">
		<div class="span12 aligncenter">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>
	</header>

	<main id="main" class="site-main span12 aligncenter clear" role="main">

		<aside class="aside aside-left span2 push-left">
			<div class="border-block top">
				<h3 class="block-label">Industries</h3>

				<ul>
					<?php
					$industries = new WP_Query(array(
						'post_type' => 'industries',
						'orderby' => 'title',
						'order' => 'ASC',
						'posts_per_page' => 100
					));

					while ( $industries->have_posts() ) : $industries->the_post(); ?>

						<li class="<?php echo $post->post_name; ?>"><a href="#<?php echo $post->post_name; ?>"><?php the_title();?></a></li>

					<?php endwhile; ?>
				</ul>
			</div>
		</aside>

		<section class="span9 push-left">
			<?php while ( $industries->have_posts() ) : $industries->the_post(); ?>
				<?php $areas_practice = get_post_meta( $post->ID, 'areas_practice', 'single' ); ?>
				<div class="industry-row">
					<div class="entry-content span7 push-left">
						<article id="<?php echo esc_attr( $post->post_name ); ?>" class="industry-content">
							<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
							<?php the_content(); ?>
						</article>
					</div>

					<aside class="aside span3 push-right">
						<?php if ( $areas_practice ) : ?>
							<div class="border-block top practice-areas">
								<h3 class="block-label">Practice Areas</h3>
								<ul>
									<?php foreach ( $areas_practice as $practice ) : ?>
										<li>
											<a href="<?php echo get_the_permalink( $practice ); ?>"><?php echo get_the_title( $practice ); ?></a>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php endif; ?>

					</aside>
				</div>
			<?php endwhile; // end of the loop. ?>
		</section>

	</main><!-- #main -->

<?php get_footer(); ?>