<?php
/**
 * Template Name: Our Firm
**/
global $post;
$custom = get_post_custom($post->ID);
$subtitle = $custom["page_subtitle"][0];

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
					<? echo $subtitle; ?>
				</li>
				<li class="border-block top-right-bottom square child2">
					<a href="<?= get_permalink('14'); ?>">Firm History</a>
				</li>
				<li class="border-block top-right-bottom square child3">
					<a href="<?= get_permalink('16'); ?>">Community Involvement</a>
				</li>
				<li class="border-block top-right-bottom square child4">
					<a href="<?= get_permalink('18'); ?>">Affiliations & Memberships</a>
				</li>
				<li class="border-block top-right-bottom square child5">
					<a href="<?= get_permalink('22'); ?>">Recruiting</a>
				</li>
				<li class="border-block top-right-bottom square child6">
					<a href="<?= get_permalink('20'); ?>">Contact Us</a>
				</li>
			</ul>
		
		</article><!-- #post-## -->

	</main><!-- #main -->

	<?php endwhile; // end of the loop. ?>
	
</div><!-- #primary -->
							
		
		
		
		
<?php get_footer(); ?>