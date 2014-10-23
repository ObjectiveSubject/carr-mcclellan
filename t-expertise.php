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
			
			<ul>
				<li class="solid-block square child1">
					<?php if ( $subtitle ) { echo $subtitle; } ?>
				</li>
				<li class="border-block top-right-bottom square child2">
					<h3><a href="<?php echo esc_url( home_url( '/' ) ); ?>practices/">Practices</a></h3>
				</li>
				<li class="border-block top-right-bottom square child3">
					<h3><a href="<?php echo esc_url( home_url( '/' ) ); ?>industries/">Industries</a></h3>
				</li>
				<li class="border-block top-right-bottom square child4">
					<h3><a href="<?php echo esc_url( home_url( '/' ) ); ?>publications/">Publications</a></h3>
				</li>
			</ul>
		
		</article><!-- #post-## -->

	</main><!-- #main -->

	<?php endwhile; // end of the loop. ?>
	
</div><!-- #primary -->
							
		
		
		
		
<?php get_footer(); ?>