<?php
/**
 * Template Name: Publications
**/
	get_header();
?>

	<div id="primary" class="content-area">

		<header class="page-header">
			<div class="centered">
				<h1 class="page-title">Publications</h1>
				<div class="page-subtitle"><?php the_content(); ?></div>
			</div>
		</header>

		<main id="main" class="site-main span12 aligncenter" role="main">

			<section id="content">

							<div class="publications">

								<?php
									$loop = new WP_Query(array(
											'post_type' => 'publications',
											'orderby' => 'date',
											'order' => 'DESC',
											'posts_per_page' => 100
										));
									$i = 1;
									while ( $loop->have_posts() ) : $loop->the_post();
										$custom = get_post_custom( $post->ID );

										$type = wp_get_post_terms( $post->ID, 'publications' );
										if ( $type ) { $type = $type[0]->name; }
										else { $type = ''; }

										$month = strlen( get_the_date( 'F' ) );

										$date = ( $month > 3 ? get_the_date('M. j, Y') : get_the_date('M j, Y'));
										$pub_practices = get_post_meta($post->ID, 'pub_practices', true);

										if( is_array( $pub_practices ) ){
											$pub_practices = implode( ',', $pub_practices );
										}

										$pub_attorneys = get_post_meta($post->ID, 'pub_attorneys', true);
										if( is_array( $pub_attorneys ) ){
											$pub_attorneys = implode( ',', $pub_attorneys );
										}

										$pub_summary = strip_tags( get_the_content() );
										if(strlen( $pub_summary ) > 345 ){
											$pub_summary = preg_replace('/\s+?(\S+)?$/', '', substr($pub_summary, 0, 345));
											$pub_summary .= '&hellip;';
										}
								?>
								<article class="item" id="<?php echo $i;?>">
									<input type="hidden" class="id" value="<?php echo $post->ID;?>" />
									<input type="hidden" class="attorneys" value="<?php echo $pub_practices;?>" />
									<input type="hidden" class="practices" value="<?php echo $pub_attorneys;?>" />
									<span><?php echo $date;?>  |  <?php echo $type;?></span>
									<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
									<p><?php echo $pub_summary;?></p>
								</article>
								<?php
									$i++;
									endwhile;
								?>
							</div>
						</section>
		</main>
	</div>
<?php get_footer(); ?>