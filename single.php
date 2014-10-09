<?php
/**
 * The template for displaying all single posts.
 *
 * @package Carr McClellan
 */

get_header(); ?>

	<div id="primary" class="content-area terminal-page">

		<?php while ( have_posts() ) : the_post(); ?>

		<header class="page-header ">
			<div class="span12 aligncenter">
				<h1 class="page-title"><?php the_title(); ?></h1>	
				<div class="entry-meta">
					<strong class="meta-date font-heading caps"><?php echo get_the_date('M. j, Y'); ?></strong>
				</div><!-- .entry-meta -->
			</div>
		</header><!-- .entry-header -->

		<main id="main" class="site-main span12 aligncenter clear" role="main">
			
				<?php get_template_part( 'aside', 'author-share' ); ?>
	
				<?php get_template_part( 'content', 'single' ); ?>
				
				<?php get_template_part( 'aside', 'categories' ); ?>
	
		</main><!-- #main -->
		
		<?php cmc_post_nav(); ?>

		<?php endwhile; // end of the loop. ?>

	</div><!-- #primary -->

<?php get_footer(); ?>