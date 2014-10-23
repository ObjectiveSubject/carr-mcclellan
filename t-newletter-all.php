<?php
/**
 * Template Name: Newsletter All
**/
	get_header();
?>

	<div id="primary" class="content-area">

		<header class="page-header">
			<div class="centered">
				<h1 class="page-title">Current event</h1>
				<div class="page-subtitle"><?php the_content(); ?></div>
			</div>
		</header>

		<main id="main" class="site-main span12 aligncenter" role="main">

			<section id="content">

				<h2>All Newsletters</h2>
				<?php
					$get_newsletters = new WP_Query(array(
							'post_type' => 'newsletters',
							'orderby' => 'date',
							'order' => 'DESC',
							'posts_per_page' => 100,
							'offset' => 1
						));

					while ( $get_newsletters->have_posts() ) :
						$get_newsletters->the_post();
						$custom = get_post_custom( $post->ID );

						$abbr_content = strip_tags( get_the_content() );
						if( strlen( $abbr_content ) > 300){
							$abbr_content = preg_replace('/\s+?(\S+)?$/', '', substr( $abbr_content, 0, 300 ) );
							$abbr_content .= '&ellips;';
						}
				?>
					<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
					<p><?php echo $abbr_content ?> <a href="<?php the_permalink();?>">Read More &raquo;</a></p>

				<?php endwhile; ?>

			</section>

	</div>


<?php get_footer(); ?>