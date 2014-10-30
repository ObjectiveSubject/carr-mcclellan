<?php

	get_header();

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

			<?php
			$industries = new WP_Query(array(
				'post_type' => 'industries',
				'orderby' => 'title',
				'order' => 'ASC',
				'posts_per_page' => 100
			));

			while ( $industries->have_posts() ) : $industries->the_post();
				?>
				<ul>
					<li class="<?php echo $post->post_name; ?>"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
				</ul>

			<?php endwhile; ?>
		</div>
	</aside>

	<section class="span6 push-left">

		<article class="block-2 practice-content">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
			<?php endif; ?>
		</article>
	</section>

	<aside class="aside aside-right">
		<div class="border-block top">
		</div>
	</aside>

</main>
</div>

<?php get_footer();