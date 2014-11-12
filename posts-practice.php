<?php
/**
 * Generate posts for a specific practice (duplicate of attorney template, could probably be reworked)
 */



$query_vars = $wp->query_vars;

$practice = $query_vars['practice'];
$practice_id = carr_get_post_id_by_slug( $practice, 'practices' );

// If related practice is found, fire a 404 (there may be a way to get all this into functions.php
if ( ! $practice_id ) {
	global $wp_query;
	$wp_query->set_404();
	status_header(404);
	nocache_headers();
	include( get_query_template( '404' ) );
	die();
}

$practice_post = get_post( $practice_id );

// This isn't working at the moment, need a way to set the title for the post's <head>
global $post;
$post = $practice_post;
setup_postdata( $post );

get_header();
?>

<div id="primary" class="content-area page-default">
	<header class="page-header">
		<div class="span12 aligncenter">
			<h1 class="page-title"><?php echo $practice_post->post_title; ?></h1>
		</div>
	</header>

	<main id="main" class="site-main span12 aligncenter" role="main">
		<aside class="aside aside-left span2 push-left">
			<?php carr_news_events_sidebar(); ?>
		</aside>

		<section class="span9 push-right">
			<?php  ?>

			<?php
			// This wonderful mess essentially grabs all posts, and loops through them to find
			// ones with this practice in a post meta field containing a serialized array of
			// practice ids (hence the inability to query directly).

			$loop = new WP_Query( array(
				'post_type'      => 'post',
				'orderby'        => 'date',
				'order'          => 'DESC',
				'posts_per_page' => 300
			) );
			$i    = 0;
			$color_class = 'odd';
			while ( $loop->have_posts() ) :
				$loop->the_post();
				$post_practices = get_post_meta( $post->ID, 'post_practices', 'single' );


				if ( is_array( $post_practices ) && in_array( $practice_id, $post_practices ) ) :
					?>
					<article class="border-block top-right-bottom square blog-post <?php echo $color_class; ?>">
						<h4 class="timestamp"><?php the_time('M. d, Y'); ?></h4>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					</article>

					<?php
					if ( 'even' == $color_class ) {
						$color_class = 'odd';
					} else {
						$color_class = 'even';
					}
					?>

					<?php
					$i ++;
				endif;
			endwhile;
			if ( $i == 0 ) :
				?>
				<article>
					<p>No posts found</p>
				</article>
			<?php endif; ?>

		</section>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
