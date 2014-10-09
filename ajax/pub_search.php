<?php
	header('Access-Control-Allow-Origin: *');
	// Include WordPress 
	define('WP_USE_THEMES', false);
	/**
		* Temporary Fix to include wp-load.php
		* @todo find a smarter way to don't depped on wp-load
	*/

	$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
	require_once( $parse_uri[0] . 'wp-load.php' );

	$search = strtolower($_POST['search']);

	$loop = new WP_Query(array(
			'post_type' => 'publications', 
			'orderby' => 'date',
			'order' => 'DESC',
			'posts_per_page' => 100
		));
	$i = 1;
	while ( $loop->have_posts() ) : 
		$loop->the_post();
		$custom = get_post_custom($post->ID);
		$pub_summary = $custom["pub_summary"][0];		
		$type = wp_get_post_terms($post->ID, 'publications');
		$type = $type[0]->name;
		//$date = get_the_date('m/d/y');
		$date = get_the_date('M. j, Y');
		
		
		$pub_summary = strip_tags(get_the_content());
		//$pub_summary = strip_tags($pub_summary);
		if(strlen($pub_summary) > 350){								
			$pub_summary = preg_replace('/\s+?(\S+)?$/', '', substr($pub_summary, 0, 350));
			$pub_summary .= '…';
		}
		
		$title = strtolower(get_the_title());
		$content = strtolower(get_the_content());
		$search_title = strpos($title,$search);
		$search_content = strpos($content,$search);

		
		if($search_title == true || $search_content == true) :

?>

	<article class="item" id="<?=$i;?>">
		<span><?=$date;?> | <?=$type;?></span>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
		<p><?=$pub_summary;?></p>
	</article>

<?php 
	$i++;
	endif;
	endwhile; 
	
	
	// No Results
	if($i == 1){
		echo '<div class="no-results" style="text-align:center">';
		echo '<h3>No search results found for "' . $search . '".<br />Please try your search again.</h3>';
		echo '</div>';
	}
?>