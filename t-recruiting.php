<?php
/**
 * Template Name: Recruiting
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
			<div class="head-text community-head-text">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
				<?php endif; ?>
			</div>

			<?php the_block('Main Body'); ?>

			<div class="vacancies-list">
				<article class="item">
					<h2 class="block-1 last">Directors</h2>
					<div class="holder">
						<?php the_block('Directors'); ?>
					</div>
				</article>
				<article class="item">
					<h2 class="block-1 last">Associates</h2>
					<div class="holder">
						<?php the_block('Associates'); ?>
					</div>
				</article>
				<article class="item">
					<h2 class="block-1 last">Paralegals &amp; Staff</h2>
					<div class="holder">
						<?php the_block('Paralegals Staff'); ?>
					</div>
				</article>
				<article class="item">
					<h2 class="block-1 last">Recruiting Contacts</h2>
					<div class="holder">
						<?php the_block('Recruiting Contacts'); ?>
					</div>
				</article>
			</div>

		</section>
	</main>

<?php get_footer();

