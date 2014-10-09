<aside class="aside aside-left span2 push-left">

	<div class="border-block top contact-info">
		<h3 class="block-label phone">Phone</h3>
		<ul>
			 <li><? echo $phone; ?></li>
		</ul>
		<h3 class="block-label fax">Fax</h3>
		<ul>
			 <li><? echo $fax; ?></li>
		</ul>
		<h3 class="block-label email">Email</h3>
		<ul>
			 <li><a href="mailto:<? echo $email; ?>" target="_blank" class="link-gray3"><? echo $email; ?></a></li>
		</ul>
		<h3 class="block-label vcard"><a href="<? echo $v_card; ?>" class="link-gray3"><span class="small icon-download"></span>&nbsp;&nbsp;Download vCard</a></h3>
		<h3 class="block-label print"><a href="#" class="link-gray3"><span class="icon-print"></span>&nbsp;&nbsp;Print Profile</a></h3>
	</div>

</aside>