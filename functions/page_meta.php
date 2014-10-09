<?php
	
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_page-meta',
		'title' => 'Page Meta',
		'fields' => array (
			array (
				'key' => 'field_542d1a06a0dea',
				'label' => 'Page Subtitle',
				'name' => 'page_subtitle',
				'type' => 'wysiwyg',
				'instructions' => 'optional',
				'default_value' => '',
				'toolbar' => 'basic',
				'media_upload' => 'no',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
	
	
?>