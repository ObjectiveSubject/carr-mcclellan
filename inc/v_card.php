<?php
/*
* Filename.......: vcard_example.php
* Author.........: Troy Wolf [troy@troywolf.com]
* Last Modified..: 2005/07/14 13:30:00
* Description....: An example of using Troy Wolf's class_vcard.
*/

// http://dev.carr.ai-dev.net/wp-content/themes/carr_mcclellan/functions/v_card.php
// ?f_name=&l_name=&m_name=&company=&title=&address=&city=&state=&postal=&phone=&fax=&email=&url


require_once( 'v_card_class.php' );

$vc = new vcard();

$vc->data['first_name'] = $_GET['f_name'];
$vc->data['last_name'] = $_GET['l_name'];
$vc->data['additional_name'] = $_GET['m_name'];

$vc->data['company'] = $_GET['company'];
$vc->data['title'] = $_GET['title'];

$vc->data['work_address'] = $_GET['address'];
$vc->data['work_city'] = $_GET['city'];
$vc->data['work_state'] = $_GET['state'];
$vc->data['work_postal_code'] = $_GET['postal'];

$vc->data['office_tel'] = $_GET['phone'];
$vc->data['fax_tel'] = $_GET['fax'];

$vc->data['email1'] = $_GET['email'];

$vc->data['url'] = $_GET['url'];

$vc->download();


?>


