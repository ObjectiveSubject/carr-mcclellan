<?php

get_header();

$areas_practice = get_post_meta( $post->ID, 'areas_practice', 'single' );

?>

<div id="primary" class="content-area terminal-page">

	<header class="page-header">
		<div class="span12 aligncenter">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>
	</header><!-- .entry-header -->

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

				<li class="<?php echo $post->post_name; ?>"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>

			<?php endwhile; ?>
			</ul>
		</div>
	</aside>

	<section class="span6 push-left">
		<div class="entry-content">
		<article class="block-2 industry-content">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
			<?php endif; ?>
		</article>
		</div>
	</section>

	<aside class="aside aside-right">
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

</main>
</div>

<?php get_footer();