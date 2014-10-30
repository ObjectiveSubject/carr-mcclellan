<?php
/**
 * Template Name: Our Firm
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
					<?php $firm_page = get_post( 14 ); ?>
					<h3><a href="<?php echo get_permalink('14'); ?>"><?php echo get_the_title( 14 ); ?></a></h3>
					<p><?php echo $firm_page->post_excerpt; ?></p>
				</li>
				<li class="border-block top-right-bottom square child3">
					<?php $firm_page = get_post( 16 ); ?>
					<h3><a href="<?php echo get_permalink('16'); ?>"><?php echo get_the_title( 16 ); ?></a></h3>
					<p><?php echo $firm_page->post_excerpt; ?></p>
				</li>
				<li class="border-block top-right-bottom square child4">
					<?php $firm_page = get_post( 18 ); ?>
					<h3><a href="<?php echo get_permalink('18'); ?>"><?php echo get_the_title( 18 ); ?></a></h3>
					<p><?php echo $firm_page->post_excerpt; ?></p>
				</li>
				<li class="border-block top-right-bottom square child5">
					<?php $firm_page = get_post( 22 ); ?>
					<h3><a href="<?php echo get_permalink('22'); ?>"><?php echo get_the_title( 22 ); ?></a></h3>
					<p><?php echo $firm_page->post_excerpt; ?></p>
				</li>
				<li class="solid-block square child6">
					<?php $firm_page = get_post( 2305 ); ?>
					<h3><a href="<?php echo get_permalink('2305'); ?>"><?php echo get_the_title( 2305 ); ?></a></h3>
					<p><?php echo $firm_page->post_excerpt; ?></p>
				</li>
			</ul>
		
		</article><!-- #post-## -->

	</main><!-- #main -->

	<?php endwhile; // end of the loop. ?>
	
</div><!-- #primary -->
							
		
		
		
		
<?php get_footer(); ?>