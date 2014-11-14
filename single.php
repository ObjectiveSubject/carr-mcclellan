<?php
/**
 * The template for displaying all single posts.
 *
 * @package Carr McClellan
 */

get_header(); ?>

	<div id="primary" class="content-area terminal-page">

		<?php while ( have_posts() ) : the_post(); ?>

		<header class="page-header ">
			<div class="span12 aligncenter">
				<h1 class="page-title"><?php the_title(); ?></h1>	
				<div class="entry-meta">
					<strong class="meta-date font-heading caps"><?php echo get_the_date('M. j, Y'); ?></strong>
				</div><!-- .entry-meta -->
			</div>
		</header><!-- .entry-header -->

		<main id="main" class="site-main span12 aligncenter clear" role="main">

				<aside class="aside aside-left aside-author-share">
					<?php if ( is_singular( 'post' ) ) : ?>
						<div class="view-all">
							<a class="button point-left" href="<?php echo esc_url( home_url( '/' ) ) . 'news-events/'; ?>">
								Back to <br> News &amp; Events
								<span class="icon-arrow-left"></span>
							</a>
						</div>
					<?php endif; ?>

					<?php $related_attorneys = get_post_meta( $post->ID, 'post_attorneys', 'single' ); ?>
					
					<?php if ( $related_attorneys ) : ?>
						<div class="border-block top author">
							<h3 class="block-label">Author</h3>
							<ul>
								<?php $related_attorneys = get_post_meta( $post->ID, 'post_attorneys', 'single' ); ?>
								<?php foreach ( $related_attorneys as $related_attorney ) { ?>
									<li><a href="<?php echo get_permalink( $related_attorney ); ?>" class="link-gray3"><?php echo get_the_title( $related_attorney ); ?></a></li>
								<?php } ?>
							</ul>
						</div>
					<?php endif; ?>

					<?php cmc_share_links(); ?>
				</aside>

				<article id="post-<?php the_ID(); ?>" <?php post_class('span9 push-left'); ?>>

					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->

					<?php cmc_post_nav(); ?>

				</article><!-- #post-## -->

				<aside class="aside aside-right aside-categories">

					<div class="border-block top categories">
						<h3 class="block-label">Categories</h3>
						<ul>
							<?php $cats = get_the_category(); ?>
							<?php foreach ( $cats as $cat ) { ?>
								<li><a href="<?php echo get_category_link( $cat->term_id ); ?>" class="link-gray3"><?php echo $cat->name; ?></a></li>
							<?php } ?>
						</ul>
					</div>

				</aside>
	
		</main><!-- #main -->


		<?php endwhile; // end of the loop. ?>

	</div><!-- #primary -->

<?php get_footer(); ?>