<?php
/**
 * Template Name: Publications
**/
	get_header();
?>
<body>
	<div id="wrapper">
		<div class="w1">
			<div class="w2">
				<div class="container">
					<header id="header" class="header-2 header-publications-overview">
						<div class="panel">
							<?php include('breadcrumbs.php'); ?>
							<span class="addthis link-share">Share</span>
						</div>
						<div class="holder">
							<h1>Publications</h1>
						</div>
					</header>
					<?php
						// Get Arrays of Attorneys and Practices
						// where a Publication is associated
						//
						$loop_pub = new WP_Query(array(
								'post_type' => 'publications',
								'orderby' => 'date',
								'order' => 'DESC',
								'posts_per_page' => 100
							));
						while ( $loop_pub->have_posts() ) {
							$loop_pub->the_post();
							$practices_array = get_post_meta($post->ID, 'pub_practices', true);
							$attorneys_array = get_post_meta($post->ID, 'pub_attorneys', true);
							if( !is_array($practices_array) ){
								$practices_array = array();
							}
							if( !is_array($attorneys_array) ){
								$attorneys_array = array();
							}
							foreach($practices_array as $p_array){
								$practices[] = $p_array;
							}
							foreach($attorneys_array as $a_array){
								$attorneys[] = $a_array;
							}
						}
					?>
					<div id="main">
						<section id="content">
							<form class="sort-form" action="#">
								<label>Sort By:</label>
								<select class="sort-practice">
									<option>Practice</option>
									<?php
										$loop = new WP_Query(array(
												'post_type' => 'practices',
												'orderby' => 'title',
												'order' => 'ASC',
												'posts_per_page' => 100
											));
										while ( $loop->have_posts() ) :
											$loop->the_post();
											$custom = get_post_custom($post->ID);
											$practice_id = $post->ID;
										if(in_array($practice_id, $practices)) :
									?>
										<option value="<?php echo $practice_id;?>"><?php the_title();?></option>
									<?php
										endif;
										endwhile;
									?>
								</select>
								<select class="sort-attorney">
									<option>Attorney</option>
									<?php
										$loop = new WP_Query(array(
												'post_type' => 'attorneys',
												'meta_key' => 'last_name',
												'orderby' => 'meta_value',
												'order' => 'ASC',
												'posts_per_page' => 100
											));
										while ( $loop->have_posts() ) : $loop->the_post();
											$custom = get_post_custom($post->ID);
											$name = $custom["first_name"][0].' ';
											$name .= $custom["middle_initial"][0] . ' ';
											$name .= $custom["last_name"][0];
											$attorney_id = $post->ID;
										if(in_array($attorney_id, $attorneys)) :
									?>
										<option value="<?php echo $attorney_id;?>"><?php echo $name;?></option>
									<?php
										endif;
										endwhile;
									?>
								</select>
								<input type="text" class="text pub-search-value" value="Enter Keyword" />
								<input type="submit" class="btn-submit pub-search-submit" value="search" />
							</form>
							<div class="publications-panel">
								<p class="clear-sorting">[<a href="#">Back to All Publications</a>]</p>
								<div class="holder">
									<span class="currently-viewing"><strong>Currently Viewing: </strong>All Publications</span>
									<span class="current-posts"> </span>
								</div>
								<ul class="paging-2">
								</ul>
							</div>
							<div class="publications">
								<div class="ajax-mask"></div>
								<?php
									$loop = new WP_Query(array(
											'post_type' => 'publications',
											'orderby' => 'date',
											'order' => 'DESC',
											'posts_per_page' => 100
										));
									$i = 1;
									while ( $loop->have_posts() ) : $loop->the_post();
										$custom = get_post_custom($post->ID);
										//$pub_summary = $custom["pub_summary"][0];
										$type = wp_get_post_terms($post->ID, 'publications');
										$type = $type[0]->name;
										//$date = get_the_date('m/d/y');
										$month = strlen( get_the_date(F) );
										$date = ( $month > 3 ? get_the_date('M. j, Y') : get_the_date('M j, Y'));
										$pub_practices = get_post_meta($post->ID, 'pub_practices', true);
										if( is_array($pub_practices) ){
											$pub_practices = implode(',',$pub_practices);
										}
										$pub_attorneys = get_post_meta($post->ID, 'pub_attorneys', true);
										if( is_array($pub_attorneys) ){
											$pub_attorneys = implode(',',$pub_attorneys);
										}
										//$pub_summary = strip_tags($pub_summary);
										//if(strlen($pub_summary) > 350){
										//	$pub_summary = preg_replace('/\s+?(\S+)?$/', '', substr($pub_summary, 0, 350));
										//	$pub_summary .= '…';
										//}
										$pub_summary = strip_tags(get_the_content());
										if(strlen($pub_summary) > 345){
											$pub_summary = preg_replace('/\s+?(\S+)?$/', '', substr($pub_summary, 0, 345));
											$pub_summary .= '…';
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
							<div class="publications-panel">
								<div class="holder">
									<span class="currently-viewing"><strong>Currently Viewing: </strong>All Publications</span>
									<span class="current-posts"> </span>
								</div>
								<ul class="paging-2">
								</ul>
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
<?php get_footer(); ?>