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

		<section id="content">
			<?php while ( $industries->have_posts() ) : $industries->the_post(); ?>

				<article class="border-block square industry <?php echo esc_attr( $post->post_name ); ?>">
					<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
				</article>

			<?php endwhile; // end of the loop. ?>
		</section>

	</main><!-- #main -->

<?php get_footer(); ?>