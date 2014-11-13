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

	<main id="main" class="site-main span12 aligncenter clear" role="main">

		<section id="content" class="practices_wrap">
			<a href="<?php echo get_bloginfo( 'url' ); ?>/expertise/" class="see-all"><span class="icon-arrow-left"></span> Back to Expertise</a>
			<?php cmc_get_practices(); ?>
		</section>

	</main>
		
<?php get_footer(); ?>