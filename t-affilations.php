<?php
/**
 * Template Name: Affiliations & Memberships
**/
	get_header();
?>

<div id="primary" class="content-area page-default">
	<header class="page-header">
		<div class="span12 aligncenter">
			<h1 class="page-title"><?php the_title(); ?></h1>
			<h2 class="page-subtitle"><?php the_content(); ?></h2>
		</div>
	</header>

	<main id="main" class="site-main span6 aligncenter clear" role="main">

		<section id="content">
			<div class="head-text community-head-text">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
				<?php endwhile; ?>
				<?php endif; ?>
			</div>

			<div class="affilations-extra">
				<?php the_block('Main Body'); ?>
			</div>

		</section>
	</main>
		
<?php get_footer(); ?>