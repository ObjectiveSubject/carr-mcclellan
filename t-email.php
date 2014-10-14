<?php
/**
 * Template Name: Email Alerts
**/
	get_header();
?>

<body>
	<div id="wrapper">
		<div class="w1">
			<div class="w2">
				<?php include('sidebar.php'); ?>
				<div class="container">

					<header id="header" class="header-2 header-news-search-overview">
						<div class="panel">
							<span class="addthis link-share">Share</span>
						</div>
						<div class="holder">
							<h1><?php the_title();?></h1>
						</div>
					</header>

					<div id="main">
						<section id="content">
							<div class="head-text">
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								<?php the_content(); ?>
								<?php endwhile; ?>
								<?php endif; ?>
							</div>

							<form action="http://nkinteractive.createsend.com/t/j/s/hhjhdl/" method="post" id="subForm" class="email-alerts-form">
								<div class="content-holder block-3">
									<div class="block-1">
										<h2>Name</h2>
										<input type="text" name="cm-name" id="name" class="text"/>

										<h2>Email</h2>
										<?php
											$email = $_GET['email'];
											$prefill = ($email) ? $email : '';
										?>
										<!-- <input type="email" name="email" class="text" value="<?=$prefill;?>" /> -->
										<input type="email" class="text" name="cm-hhjhdl-hhjhdl" id="hhjhdl-hhjhdl" value="<?=$prefill;?>"/>
									</div>
									<div class="block-2 last">
										<h2>Practice Areas</h2>
										<div class="clearfix">
										<ul class="block-1">
											<li>
												<input type="checkbox" name="cm-fo-tliyky" id="cm531578" value="531578" />
												<label for="cm531578">Business Commercial Litigation</label>
											</li>
											<li>
												<input type="checkbox" name="cm-fo-tliyky" id="cm531579" value="531579" />
												<label for="cm531579">Civil Litigation &amp; Dispute Resolution</label>
											</li>
											<li>
												<input type="checkbox" name="cm-fo-tliyky" id="cm531580" value="531580" />
												<label for="cm531580">Corporate &amp; Business</label>
											</li>
											<li>
												<input type="checkbox" name="cm-fo-tliyky" id="cm531581" value="531581" />
												<label for="cm531581">Creditor&rsquo;s Rights &amp; Bankruptcy Employment</label>
											</li>
											<li>
												<input type="checkbox" name="cm-fo-qktllr" id="cm2772276" value="2772276" /> 
												<label>Creditors&rsquo; Rights &amp; Bankruptcy</label>
											</li>
											<li>
												<input type="checkbox" name="cm-fo-tliyky" id="cm531582" value="531582" />
												<label for="cm531582">Employment</label>
											</li>
										</ul>
										<ul class="block-1 last">
											<li>
												<input type="checkbox" name="cm-fo-tliyky" id="cm531585" value="531585" />
												<label for="cm531585">Exempt Organizations</label>
											</li>
											<li>
												<input type="checkbox" name="cm-fo-tliyky" id="cm531586" value="531586" />
												<label for="cm531586">Health Care</label>
											</li>
											<li>
												<input type="checkbox" name="cm-fo-tliyky" id="cm531587" value="531587" />
												<label for="cm531587">Intellectual Property</label>
											</li>
											<li>
												<input type="checkbox" name="cm-fo-tliyky" id="cm531588" value="531588" />
												<label for="cm531588">Litigation</label>
											</li>
											<li>
												<input type="checkbox" name="cm-fo-tliyky" id="cm531589" value="531589" />
												<label for="cm531589">Real Estate</label>
											</li>
											<li>
												<input type="checkbox" name="cm-fo-tliyky" id="cm531590" value="531590" />
												<label for="cm531590">Taxation</label>
											</li>
											<li>
												<input type="checkbox" name="cm-fo-tliyky" id="cm531584" value="531584" />
												<label for="cm531584">Trust, Estate &amp; Fiduciary</label>
											</li>
										</ul>
										</div>
										<h2>General News and Events</h2>
										<ul>
											<li>
												<input type="checkbox" name="cm-fo-tliyuk" id="cm531591" value="531591" />
												<label for="cm531591">Newsletter</label>
											</li>
											<li>
												<input type="checkbox" name="cm-fo-tliyuk" id="cm531592" value="531592" />
												<label for="cm531592">In The News</label>
											</li>
											<li>
												<input type="checkbox" name="cm-fo-tliyuk" id="cm531593" value="531593" />
												<label for="cm531593">Events</label>
											</li>
										</ul>
										<div class="hr"></div>
										<input type="submit" value="Subscribe" />
									</div>
								</div>
							</form>

						</section>
					</div>
				</div>
			</div>
		</div>

<?php get_footer(); ?>