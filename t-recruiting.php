<?php
/**
 * Template Name: Recruiting
**/
	get_header();
?>

<body>
	<div id="wrapper">
		<div class="w1">
			<div class="w2">
				<div class="container">
					<header id="header" class="header-4 header-our-firm-detail">
						<div class="panel">
							<span class="addthis link-share">Share</span>
						</div>
						<h1><?=get_the_title();?></h1>
					</header>
					
					<div id="main">
						<section id="content">
							<div class="head-text">
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								<?php the_content(); ?>
								<?php endwhile; ?>
								<?php endif; ?>
							</div>
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
					</div>					
				</div>
			</div>
		</div>
		
<?php get_footer(); ?>