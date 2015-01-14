<?php
/**
 * Template Name: Expertise
**/

$subtitle = get_post_meta( $post->ID, 'post_subtitle', true );

get_header(); ?>

<div id="primary" class="content-area page-default">

	<?php while ( have_posts() ) : the_post(); ?>
	
	<header class="page-header">
		<div class="span12 aligncenter">
			<h1 class="page-title"><?php the_title(); ?></h1>
			<h2 class="page-subtitle"><?php the_content(); ?></h2>
		</div>
	</header>
	
	<main id="main" class="site-main span12 aligncenter" role="main">

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<ul class="our-firm">
				<li class="solid-block square child1">
					<?php the_excerpt(); ?>
				</li>

				<li class="border-block top-right-bottom square child2">
					<?php $expertise_page = get_post( 28 ); ?>
					<h3><a href="<?php echo get_permalink('28'); ?>"><?php echo $expertise_page->post_title; ?></a></h3>
					<p><?php echo $expertise_page->post_excerpt; ?></p>
				</li>
				<li class="border-block top-right-bottom square child3">
					<?php $expertise_page = get_post( 2312 ); ?>
					<h3><a href="<?php echo get_permalink('2312'); ?>"><?php echo $expertise_page->post_title; ?></a></h3>
					<p><?php echo $expertise_page->post_excerpt; ?></p>
				</li>
				<li class="border-block top-right-bottom square child4">
					<?php $expertise_page = get_post( 26 ); ?>
					<h3><a href="<?php echo get_permalink('26'); ?>"><?php echo $expertise_page->post_title; ?></a></h3>
					<p><?php echo $expertise_page->post_excerpt; ?></p>
				</li>
			</ul>
		
		</article><!-- #post-## -->

	</main><!-- #main -->

	<?php endwhile; // end of the loop. ?>
	
</div><!-- #primary -->
							
		
		
		
		
<?php get_footer(); ?>