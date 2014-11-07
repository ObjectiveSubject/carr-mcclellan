<?php
/**
 * Generate posts for a specific attorney
 */



$query_vars = $wp->query_vars;

$attorney = $query_vars['attorney'];
$attorney_id = carr_get_post_id_by_slug( $attorney, 'attorneys' );

// If related attorney is found, fire a 404 (there may be a way to get all this into functions.php
if ( ! $attorney_id ) {
	global $wp_query;
	$wp_query->set_404();
	status_header(404);
	nocache_headers();
	include( get_query_template( '404' ) );
	die();
}

$attorney_post = get_post( $attorney_id );

// This isn't working at the moment, need a way to set the title for the post's <head>
global $post;
$post = $attorney_post;
setup_postdata( $post );

get_header();
?>

<div id="primary" class="content-area page-default">
	<header class="page-header">
		<div class="span12 aligncenter">
			<h1 class="page-title"><?php echo $attorney_post->post_title; ?></h1>
		</div>
	</header>

	<main id="main" class="site-main span12 aligncenter" role="main">
		<aside class="aside aside-left span2 push-left">
			<div class="border-block top">
				<h3 class="block-label">Categories</h3>

				<ul class="categories">
					<?php wp_list_categories( '&title_li=&depth=1' ); ?>
				</ul>

			</div>
		</aside>

		<section class="span9 push-right">
			<?php  ?>

			<?php
			// This wonderful mess essentially grabs all posts, and loops through them to find
			// ones with this attorney in a post meta field containing a serialized array of
			// attorney ids (hence the inability to query directly).

			$loop = new WP_Query( array(
				'post_type'      => 'post',
				'orderby'        => 'date',
				'order'          => 'DESC',
				'posts_per_page' => 200
			) );
			$i    = 0;
			$color_class = 'odd';
			while ( $loop->have_posts() ) :
				$loop->the_post();
				$post_attorneys = get_post_meta( $post->ID, 'post_attorneys', 'single' );


				if ( is_array( $post_attorneys ) && in_array( $attorney_id, $post_attorneys ) ) :
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
