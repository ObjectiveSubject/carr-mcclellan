<?php
/**
 * Template Name: Community Involvement
**/
	get_header();
?>

<body>
	<div id="wrapper">
		<div class="w1">
			<div class="w2">
				<?php include('sidebar.php'); ?>
				<div class="container">
					<header id="header" class="header-4 header-our-firm-detail">
						<div class="panel">
							<span class="addthis link-share">Share</span>
						</div>
						<h1><?=get_the_title();?></h1>
					</header>
					<div id="main">
						<section id="content" class="community-involvement">
							<div class="head-text community-head-text">
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								<?php the_content(); ?>
								<?php endwhile; ?>
								<?php endif; ?>
							</div>
							<?php the_block('Main Body'); ?>
							<div class="box-quote" style="display:none;">
								<?php the_block('Quote Box'); ?>
							</div>
							<div class="text-block">
								<?php the_block('Sub Body'); ?>
							</div>
							<?php the_block('Logo List'); ?>
						</section>
					</div>
				</div>
			</div>
		</div>
		
<?php get_footer(); ?>