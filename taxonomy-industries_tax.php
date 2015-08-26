<?php
/**
 * Template Name: Articles
 **/
get_header();
$query_object = get_queried_object();
?>

	<div id="primary" class="content-area content-articles">

		<header class="page-header">
			<div class="centered">
				<h1 class="page-title"><?php echo $query_object->name; ?></h1>
			</div>
		</header>

		<main id="main" class="site-main span12 aligncenter" role="main">

			<section class="articles_wrap">
				<div class="articles">

					<?php
					$color_class = 'odd';
					$place = 1;

					while ( have_posts() ) : the_post(); ?>

						<article class="border-block top-right-bottom square blog-post <?php echo $color_class.' place'.$place; ?>">
							<h4 class="timestamp"><span class="month"><?php the_time('M. '); ?></span><span class="day-year"><?php the_time('d, Y'); ?></span></h4>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						</article>

						<?php
							if ( 'even' == $color_class ) {
								$color_class = 'odd';
							} else {
								$color_class = 'even';
							}
							
							if ( $place == 4 ) {
								$place = 1;
							} else {
								$place++;
							}
						?>
					<?php endwhile; ?>

				</div>
			</section>
		</main><!-- #main -->

	</div>
<?php get_footer(); ?>