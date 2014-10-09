<?php
	// Include WordPress 
	define('WP_USE_THEMES', false);
	require('../../../wp-load.php');
?>

<h2>RSS Feeds</h2>


<h4>General</h4>
<a href="<?=bloginfo('url');?>/?feed=rss2">Blog</a><br />
<a href="<?=bloginfo('url');?>/feed/?post_type=newsletters">Newsletters</a><br />
<a href="<?=bloginfo('url');?>/feed/?post_type=publications">Publications</a><br />

<h4>By Practice</h4>
<a href="<?=bloginfo('url');?>/feed/?feed=business_commercial_litigation">Business Commercial Litigation</a><br />
<a href="<?=bloginfo('url');?>/feed/?feed=civil_litigation_dispute_resolution">Civil Litigation & Dispute Resolution</a><br />
<a href="<?=bloginfo('url');?>/feed/?feed=corporate_business">Corporate & Business</a><br />
<a href="<?=bloginfo('url');?>/feed/?feed=creditors_rights_bankrupsy">Creditors' Rights & Bankruptcy</a><br />
<a href="<?=bloginfo('url');?>/feed/?feed=employment">Employment</a><br />
<a href="<?=bloginfo('url');?>/feed/?feed=estate_planning_trust_wealth_transfer">Estate Planning, Trusts & Wealth Transfer</a><br />
<a href="<?=bloginfo('url');?>/feed/?feed=exempt_organizations">Exempt Organizations</a><br />
<a href="<?=bloginfo('url');?>/feed/?feed=healthcare">Health Care</a><br />
<a href="<?=bloginfo('url');?>/feed/?feed=intellectual_property">Intellectual Property</a><br />
<a href="<?=bloginfo('url');?>/feed/?feed=litigation">Litigation</a><br />
<a href="<?=bloginfo('url');?>/feed/?feed=real_estate">Real Estate</a><br />
<a href="<?=bloginfo('url');?>/feed/?feed=taxation">Taxation</a><br />
<a href="<?=bloginfo('url');?>/feed/?feed=trust_estate_fiduciary">Trust, Estate & Fiduciary</a><br />

