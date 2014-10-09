<?php
/**
 * Template Name: Clients
**/
	get_header();
?>

<body>
	<div id="wrapper">
		<div class="w1">
			<div class="w2">
				<?php include('sidebar.php'); ?>
				<div class="container">
					
					<header id="header" class="header-2 header-7">
						<div class="panel">
							<?php include('breadcrumbs.php'); ?>
							<span class="addthis link-share">Share</span>
						</div>
						<div class="holder">
							<h1><?php the_block('Banner'); ?></h1>
						</div>
					</header>
					
					<div id="main">
						<section id="content">
							<div class="head-text">
								<?php the_block('Header'); ?>
							</div>
							
							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php the_content(); ?>
							<?php endwhile; ?>
							<?php endif; ?>
							
						</section>
					</div>					
					
					<?php include('pre-footer.php'); ?>
				</div>
			</div>
		</div>
		
<?php get_footer(); ?>