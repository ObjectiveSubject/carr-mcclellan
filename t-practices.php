<?php
/**
 * Template Name: Practices
**/
	get_header();
?>

	<header class="page-header">
		<div class="span12 aligncenter">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>
	</header>

	<main id="main" class="site-main span6 aligncenter clear" role="main">

		<section id="content">
			<div class="practices">
								
				<?php
					$practices = new WP_Query(array(
						'post_type' => 'practices',
						'orderby' => 'title',
						'order' => 'ASC',
						'posts_per_page' => 100
					));
				?>

				<?php while ( $practices->have_posts() ) : $practices->the_post(); ?>
					<article class="practice <?php echo $post->post_name; ?>">
						<h3><a href="<?php the_permalink() ?>"><?php the_title();?></a></h3>
					</article>
				<?php endwhile; ?>
		</section>
		
<?php get_footer(); ?>