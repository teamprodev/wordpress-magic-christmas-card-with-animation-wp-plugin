<?php
/*
Plugin Name: Magic Christmas Card
Description: This plugin will allow you to create an outstanding card for your clients
Version: 1.1
Author: Lambert Group
Author URI: https://1.envato.market/OZ5Zr
*/

ini_set('display_errors', 0);
$christmas_card_1_path = trailingslashit(dirname(__FILE__));  //empty

//all the messages
$christmas_card_1_messages = array(
		'version' => '<div class="error">Christmas Card plugin requires WordPress 3.0 or newer. <a href="https://codex.wordpress.org/Upgrading_WordPress">Please update!</a></div>',
		'data_saved' => 'Data Saved!',
		'empty_name' => 'Name - required',
		'empty_stream' => 'Stream - required',
		'empty_mp3' => 'MP3 - required',
		'empty_ogg' => 'OGG - required',
		'invalid_request' => 'Invalid Request!',
		'generate_for_this_card' => 'You can start customizing this card.',
		'duplicate_complete' => 'Duplication process is complete!'
	);


global $wp_version;

if ( !version_compare($wp_version,"3.0",">=")) {
	die ($christmas_card_1_messages['version']);
}




function christmas_card_1_activate() {
	//db creation, create admin options etc.
	global $wpdb;


	$christmas_card_1_collate = ' COLLATE utf8_general_ci';

	$sql0 = "CREATE TABLE `" . $wpdb->prefix . "christmas_card_1_cards` (
			`id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
			`name` VARCHAR( 255 ) NOT NULL ,
			PRIMARY KEY ( `id` )
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sql1 = "CREATE TABLE `" . $wpdb->prefix . "christmas_card_1_settings` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `h1` varchar(255) NOT NULL DEFAULT 'Company Name',
  `h2` varchar(255) NOT NULL DEFAULT 'Wishes You Happy Holidays',
  `h3` varchar(255) NOT NULL DEFAULT 'Merry Christmas',
  `h4` varchar(255) NOT NULL DEFAULT 'December 23rd',
	`h5` varchar(255) NOT NULL DEFAULT 'Please join us for our annual holiday party with cocktail and caroling.',
	`h6` varchar(255) NOT NULL DEFAULT 'Santa will be there, with his sleigh full of gifts.',
  `mp3` text,
  `ogg` text,
  `facebook_link` varchar(255) NOT NULL DEFAULT '#',
  `twitter_link` varchar(255) NOT NULL DEFAULT '#',
	`instagram_link` varchar(255) NOT NULL DEFAULT '#',
	`youtube_link` varchar(255) NOT NULL DEFAULT '#',
	`pinterest_link` varchar(255) NOT NULL DEFAULT '#',
	`linkedin_link` varchar(255) NOT NULL DEFAULT '#',
	`googleplus_link` varchar(255) NOT NULL DEFAULT '#',
  `popup` varchar(8) NOT NULL DEFAULT 'false',
	`delay` smallint(5) unsigned NOT NULL DEFAULT '1',
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";



	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql0.$christmas_card_1_collate);
	dbDelta($sql1.$christmas_card_1_collate);


	//initialize the cards table with the first card type
	$rows_count = $wpdb->get_var( "SELECT COUNT(*) FROM ". $wpdb->prefix ."christmas_card_1_cards;" );
	if (!$rows_count) {
		$wpdb->insert(
			$wpdb->prefix . "christmas_card_1_cards",
			array(
				'name' => 'Default Card'
			),
			array(
				'%s'
			)
		);
	}

	// initialize the settings
	$rows_count = $wpdb->get_var( "SELECT COUNT(*) FROM ". $wpdb->prefix ."christmas_card_1_settings;" );
	if (!$rows_count) {
		christmas_card_1_insert_settings_record(1);
	}




}


function christmas_card_1_uninstall() {
	global $wpdb;

	$sql = "DROP TABLE IF EXISTS `" . $wpdb->prefix . "christmas_card_1_settings`";
	$wpdb->query($sql);

	$sql = "DROP TABLE IF EXISTS `" . $wpdb->prefix . "christmas_card_1_cards`";
	$wpdb->query($sql);
}

function christmas_card_1_insert_settings_record($card_id) {
	global $wpdb;
	$currentY=date("Y");
	$wpdb->insert(
			$wpdb->prefix . "christmas_card_1_settings",
			array(
				'h1' => 'Company Name',
				'h4' => 'December 23rd, '.$currentY.' at 7:30 PM<br>Grace Club - 802 Broadway, New York, NY 10003. <br>Phone: (917)494-4476'
			),
			array(
				'%s',
				'%s'
			)
		);
}


function christmas_card_1_init_sessions() {
	global $wpdb;
	if (is_admin()) {
		if (!session_id()) {
			session_start();

			//initialize the session
			if (!isset($_SESSION['xid'])) {
				$safe_sql="SELECT * FROM (".$wpdb->prefix ."christmas_card_1_cards) LIMIT 0, 1";
				$row = $wpdb->get_row($safe_sql,ARRAY_A);
				//$row=christmas_card_1_unstrip_array($row);
				$_SESSION['xid'] = $row['id'];
				$_SESSION['xname'] = $row['name'];
			}
		}
	}
}


function christmas_card_1_load_styles() {
	if(strpos($_SERVER['PHP_SELF'], 'wp-admin') !== false) { //loads css in admin
		$page = (isset($_GET['page'])) ? $_GET['page'] : '';
		if(preg_match('/CHRISTMAS_CARD_1/i', $page)) {
			/*wp_enqueue_style('lbg-audio6-html5-shoutcast_jquery-custom_css', plugins_url('css/custom-theme/jquery-ui-1.8.10.custom.css', __FILE__));*/
			wp_enqueue_style('lbg-jquery-ui-custom_css', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/pepper-grinder/jquery-ui.min.css');
			wp_enqueue_style('christmas_card_1_css', plugins_url('css/styles.css', __FILE__));
			/////wp_enqueue_style('card1_colorpicker_css', plugins_url('css/colorpicker/colorpicker.css', __FILE__));
			wp_enqueue_style('thickbox');
		}
	} else if (!is_admin()) { //loads css in front-end
			wp_enqueue_style('styles_christmas_css', plugins_url('the_card/css/styles_christmas.css', __FILE__));
			wp_enqueue_style('media_queries_css', plugins_url('the_card/css/media-queries.css', __FILE__));
			wp_enqueue_style('styles_fireworks_css', plugins_url('the_card/css/styles_fireworks.css', __FILE__));
			wp_enqueue_style('limelight_css', plugins_url('the_card/css/limelight.css', __FILE__));
			wp_enqueue_style('tangerine_css', plugins_url('the_card/css/tangerine.css', __FILE__));
			wp_enqueue_style('yesevaone_css', plugins_url('the_card/css/yesevaone.css', __FILE__));
			wp_enqueue_style('card_audio1_html5_css', plugins_url('the_card/audioPlayer/audio1_html5.css', __FILE__));
			wp_enqueue_style('lbg_gallery_prettyPhoto_css', plugins_url('the_card/css/prettyPhoto.css', __FILE__));
	}
}

function christmas_card_1_load_scripts() {
	$page = (isset($_GET['page'])) ? $_GET['page'] : '';
	if(preg_match('/CHRISTMAS_CARD_1/i', $page)) {
		//loads scripts in admin
		//if (is_admin()) {
			/*wp_deregister_script('jquery-ui-core');
			wp_deregister_script('jquery-ui-widget');
			wp_deregister_script('jquery-ui-mouse');
			wp_deregister_script('jquery-ui-accordion');
			wp_deregister_script('jquery-ui-autocomplete');
			wp_deregister_script('jquery-ui-slider');
			wp_deregister_script('jquery-ui-tabs');
			wp_deregister_script('jquery-ui-sortable');
			wp_deregister_script('jquery-ui-draggable');
			wp_deregister_script('jquery-ui-droppable');
			wp_deregister_script('jquery-ui-selectable');
			wp_deregister_script('jquery-ui-position');
			wp_deregister_script('jquery-ui-datepicker');
			wp_deregister_script('jquery-ui-resizable');
			wp_deregister_script('jquery-ui-dialog');
			wp_deregister_script('jquery-ui-button');	*/

			wp_enqueue_script('jquery');
			/*wp_register_script('lbg-admin-jquery', plugins_url('js/jquery-1.5.1.js', __FILE__));
			wp_enqueue_script('lbg-admin-jquery');*/

			//wp_register_script('lbg-admin-jquery-ui-min', plugins_url('js/jquery-ui-1.8.10.custom.min.js', __FILE__));
			//wp_register_script('lbg-admin-jquery-ui-min', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js');
			/*wp_register_script('lbg-admin-jquery-ui-min', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');
			wp_enqueue_script('lbg-admin-jquery-ui-min');*/
			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('jquery-ui-widget');
			wp_enqueue_script('jquery-ui-mouse');
			wp_enqueue_script('jquery-ui-accordion');
			wp_enqueue_script('jquery-ui-autocomplete');
			wp_enqueue_script('jquery-ui-slider');
			wp_enqueue_script('jquery-ui-tabs');
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('jquery-ui-draggable');
			wp_enqueue_script('jquery-ui-droppable');
			wp_enqueue_script('jquery-ui-selectable');
			wp_enqueue_script('jquery-ui-position');
			wp_enqueue_script('jquery-ui-datepicker');
			wp_enqueue_script('jquery-ui-resizable');
			wp_enqueue_script('jquery-ui-dialog');
			wp_enqueue_script('jquery-ui-button');/***************************/

			wp_enqueue_script('jquery-form');
			wp_enqueue_script('jquery-color');
			wp_enqueue_script('jquery-masonry');
			wp_enqueue_script('jquery-ui-progressbar');
			wp_enqueue_script('jquery-ui-tooltip');

			wp_enqueue_script('jquery-effects-core');
			wp_enqueue_script('jquery-effects-blind');
			wp_enqueue_script('jquery-effects-bounce');
			wp_enqueue_script('jquery-effects-clip');
			wp_enqueue_script('jquery-effects-drop');
			wp_enqueue_script('jquery-effects-explode');
			wp_enqueue_script('jquery-effects-fade');
			wp_enqueue_script('jquery-effects-fold');
			wp_enqueue_script('jquery-effects-highlight');
			wp_enqueue_script('jquery-effects-pulsate');
			wp_enqueue_script('jquery-effects-scale');
			wp_enqueue_script('jquery-effects-shake');
			wp_enqueue_script('jquery-effects-slide');
			wp_enqueue_script('jquery-effects-transfer');

			wp_register_script('lbg-admin-colorpicker', plugins_url('js/colorpicker/colorpicker.js', __FILE__));
			wp_enqueue_script('lbg-admin-colorpicker');

			wp_register_script('lbg-admin-editinplace', plugins_url('js/jquery.editinplace.js', __FILE__));
			wp_enqueue_script('lbg-admin-editinplace');

			wp_register_script('lbg-admin-toggle', plugins_url('js/myToggle.js', __FILE__));
			wp_enqueue_script('lbg-admin-toggle');

			wp_enqueue_script('media-upload'); // before w.p 3.5
			wp_enqueue_media();// from w.p 3.5
			wp_enqueue_script('thickbox');



		//}

		//wp_enqueue_script('jquery');
		//wp_enqueue_script('jquery-ui-core');
		//wp_enqueue_script('jquery-ui-sortable');
		//wp_enqueue_script('thickbox');
		//wp_enqueue_script('media-upload');
		//wp_enqueue_script('farbtastic');
	} else if (!is_admin()) { //loads scripts in front-end
			/*wp_deregister_script('jquery-ui-core');
			wp_deregister_script('jquery-ui-widget');
			wp_deregister_script('jquery-ui-mouse');
			wp_deregister_script('jquery-ui-accordion');
			wp_deregister_script('jquery-ui-autocomplete');
			wp_deregister_script('jquery-ui-slider');
			wp_deregister_script('jquery-ui-tabs');
			wp_deregister_script('jquery-ui-sortable');
			wp_deregister_script('jquery-ui-draggable');
			wp_deregister_script('jquery-ui-droppable');
			wp_deregister_script('jquery-ui-selectable');
			wp_deregister_script('jquery-ui-position');
			wp_deregister_script('jquery-ui-datepicker');
			wp_deregister_script('jquery-ui-resizable');
			wp_deregister_script('jquery-ui-dialog');
			wp_deregister_script('jquery-ui-button');*/

		wp_enqueue_script('jquery');

		//wp_enqueue_script('jquery-ui-core');

		//wp_register_script('lbg-jquery-ui-min', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js');
		/*wp_register_script('lbg-jquery-ui-min', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');
		wp_enqueue_script('lbg-jquery-ui-min');*/

			wp_enqueue_script('jquery-ui-core');
			/*wp_enqueue_script('jquery-ui-widget');
			wp_enqueue_script('jquery-ui-mouse');
			wp_enqueue_script('jquery-ui-accordion');
			wp_enqueue_script('jquery-ui-autocomplete');*/
			wp_enqueue_script('jquery-ui-slider');
			/*wp_enqueue_script('jquery-ui-tabs');
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('jquery-ui-draggable');
			wp_enqueue_script('jquery-ui-droppable');
			wp_enqueue_script('jquery-ui-selectable');
			wp_enqueue_script('jquery-ui-position');
			wp_enqueue_script('jquery-ui-datepicker');
			wp_enqueue_script('jquery-ui-resizable');
			wp_enqueue_script('jquery-ui-dialog');
			wp_enqueue_script('jquery-ui-button');

			wp_enqueue_script('jquery-form');
			wp_enqueue_script('jquery-color');
			wp_enqueue_script('jquery-masonry');*/
			wp_enqueue_script('jquery-ui-progressbar');
			/*wp_enqueue_script('jquery-ui-tooltip');*/

			wp_enqueue_script('jquery-effects-core');
			/*wp_enqueue_script('jquery-effects-blind');
			wp_enqueue_script('jquery-effects-bounce');
			wp_enqueue_script('jquery-effects-clip');
			wp_enqueue_script('jquery-effects-drop');
			wp_enqueue_script('jquery-effects-explode');
			wp_enqueue_script('jquery-effects-fade');
			wp_enqueue_script('jquery-effects-fold');
			wp_enqueue_script('jquery-effects-highlight');
			wp_enqueue_script('jquery-effects-pulsate');
			wp_enqueue_script('jquery-effects-scale');
			wp_enqueue_script('jquery-effects-shake');
			wp_enqueue_script('jquery-effects-slide');
			wp_enqueue_script('jquery-effects-transfer');*/

		wp_register_script('lbg-mousewheel', plugins_url('the_card/audioPlayer/js/jquery.mousewheel.min.js', __FILE__));
		wp_enqueue_script('lbg-mousewheel');

		wp_register_script('lbg-touchSwipe', plugins_url('the_card/audioPlayer/js/jquery.touchSwipe.min.js', __FILE__));
		wp_enqueue_script('lbg-touchSwipe');

		wp_register_script('lbg-audio1_html5', plugins_url('the_card/audioPlayer/js/audio1_html5.js', __FILE__));
		wp_enqueue_script('lbg-audio1_html5');

		wp_register_script('lbg-resize_card', plugins_url('the_card/js/resize_card.js', __FILE__));
		wp_enqueue_script('lbg-resize_card');

		wp_register_script('lbg-gallery-prettyPhoto', plugins_url('the_card/js/jquery.prettyPhoto.js', __FILE__));
		wp_enqueue_script('lbg-gallery-prettyPhoto');

	}

}



// adds the menu pages
function christmas_card_1_plugin_menu() {
	add_menu_page('CHRISTMAS CARD 1 Admin Interface', 'CHRISTMAS CARD1', 'edit_posts', 'CHRISTMAS_CARD_1', 'christmas_card_1_overview_page',
	plugins_url('images/christmas_card_1.png', __FILE__));
	add_submenu_page( 'CHRISTMAS_CARD_1', 'CHRISTMAS CARD 1 Overview', 'Overview', 'edit_posts', 'CHRISTMAS_CARD_1', 'christmas_card_1_overview_page');
	add_submenu_page( 'CHRISTMAS_CARD_1', 'CHRISTMAS CARD 1 Manage Cards', 'Manage Cards', 'edit_posts', 'CHRISTMAS_CARD_1_Manage_Cards', 'christmas_card_1_card_manage_cards_page');
	add_submenu_page( 'CHRISTMAS_CARD_1', 'CHRISTMAS CARD 1 Manage Cards Add New', 'Add New', 'edit_posts', 'CHRISTMAS_CARD_1_Add_New', 'christmas_card_1_card_manage_cards_add_new_page');
	add_submenu_page( 'CHRISTMAS CARD 1 Manage Cards', 'CHRISTMAS CARD 1 Card Settings', 'Card Settings', 'edit_posts', 'CHRISTMAS_CARD_1_Settings', 'christmas_card_1_card_settings_page');
	add_submenu_page( 'CHRISTMAS_CARD_1_Settings', 'CHRISTMAS CARD 1 Card Settings', 'Duplicate Card', 'edit_posts', 'CHRISTMAS_CARD_1_Duplicate_Card', 'christmas_card_1_duplicate_card_page');
	add_submenu_page( 'CHRISTMAS_CARD_1', 'CHRISTMAS CARD 1 Help', 'Help', 'edit_posts', 'CHRISTMAS_CARD_1_Help', 'christmas_card_1_card_help_page');
}


//HTML content for overview page
function christmas_card_1_overview_page()
{
	global $christmas_card_1_path;
	include_once($christmas_card_1_path . 'tpl/overview.php');
}

//HTML content for Manage Cards
function christmas_card_1_card_manage_cards_page()
{
	global $wpdb;
	global $christmas_card_1_messages;
	global $christmas_card_1_path;

	//delete card
	if (isset($_GET['id'])) {
		//delete from wp_christmas_card_1_cards
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."christmas_card_1_cards WHERE id = %d",$_GET['id']));

		//delete from wp_christmas_card_1_settings
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."christmas_card_1_settings WHERE id = %d",$_GET['id']));


		//initialize the session
		$safe_sql="SELECT * FROM (".$wpdb->prefix ."christmas_card_1_cards) ORDER BY id";
		$row = $wpdb->get_row($safe_sql,ARRAY_A);
		$row=christmas_card_1_unstrip_array($row);
		if ($row['id']) {
			$_SESSION['xid']=$row['id'];
			$_SESSION['xname']=$row['name'];
		}
	}


	$safe_sql="SELECT * FROM (".$wpdb->prefix ."christmas_card_1_cards) ORDER BY id";
	$result = $wpdb->get_results($safe_sql,ARRAY_A);
	//echo $wpdb->last_query;
	include_once($christmas_card_1_path . 'tpl/cards.php');

}



//HTML content for Manage Cards - Add New
function christmas_card_1_card_manage_cards_add_new_page()
{
	global $wpdb;
	global $christmas_card_1_messages;
	global $christmas_card_1_path;

	//if($_POST['Submit'] == 'Add New') {
	if(array_key_exists('Submit', $_POST) && $_POST['Submit'] == 'Add New') {
		$errors_arr=array();
		if (empty($_POST['name']))
			$errors_arr[]=$christmas_card_1_messages['empty_name'];

		if (count($errors_arr)) {
				include_once($christmas_card_1_path . 'tpl/add_card.php'); ?>
				<div id="error" class="error"><p><?php echo implode("<br>", $errors_arr);?></p></div>
		  	<?php } else { // no errors
					$wpdb->insert(
						$wpdb->prefix . "christmas_card_1_cards",
						array(
							'name' => $_POST['name']
						),
						array(
							'%s'
						)
					);
					//insert default card settings for this new card
					christmas_card_1_insert_settings_record($wpdb->insert_id);
					?>
						<div class="wrap">
							<div id="lbg_logo">
								<h2>Manage Cards - Add New Card</h2>
				 			</div>
							<div id="message" class="updated"><p><?php echo $christmas_card_1_messages['data_saved'];?></p><p><?php echo $christmas_card_1_messages['generate_for_this_card'];?></p></div>
							<div>
								<p>&raquo; <a href="?page=CHRISTMAS_CARD_1_Add_New">Add New (card)</a></p>
								<p>&raquo; <a href="?page=CHRISTMAS_CARD_1_Manage_Cards">Back to Manage Cards</a></p>
							</div>
						</div>
		  	<?php }
	} else {
		include_once($christmas_card_1_path . 'tpl/add_card.php');
	}

}





//HTML content for cardsettings
function christmas_card_1_card_settings_page()
{
	global $wpdb;
	global $christmas_card_1_messages;
	global $christmas_card_1_path;

	if (isset($_GET['id']) && isset($_GET['name'])) {
		$_SESSION['xid']=$_GET['id'];
		$_SESSION['xname']=$_GET['name'];
	}

	//$wpdb->show_errors();
	/*if (check_admin_referer('christmas_card_1_settings_update')) {
		echo "update";
	}*/


	///if($_POST['Submit'] == 'Update Card Settings') {
	if(array_key_exists('Submit', $_POST) && $_POST['Submit'] == 'Update Card Settings') {
		//maintenance mode
		if ($_POST['popup']=='true') {
			$wpdb->query("UPDATE ".$wpdb->prefix ."christmas_card_1_settings SET popup='false' WHERE 1 = 1");
		}


		$_GET['xmlf']='';
		$except_arr=array('Submit','name','page_scroll_to_id_instances','pll_ajax_backend','page_scroll_to_id_instances');
			$wpdb->update(
				$wpdb->prefix .'christmas_card_1_cards',
				array(
				'name' => $_POST['name']
				),
				array( 'id' => $_SESSION['xid'] )
			);
			$_SESSION['xname']=stripslashes($_POST['name']);


			foreach ($_POST as $key=>$val){
				if (in_array($key,$except_arr)) {
					unset($_POST[$key]);
				}
			}

			$wpdb->update(
				$wpdb->prefix .'christmas_card_1_settings',
				$_POST,
				array( 'id' => $_SESSION['xid'] )
			);

			?>
			<div id="message" class="updated"><p><?php echo $christmas_card_1_messages['data_saved'];?></p></div>
	<?php
	}


	//echo "WP_PLUGIN_URL: ".WP_PLUGIN_URL;
	$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."christmas_card_1_settings) WHERE id = %d",$_SESSION['xid'] );
	$row = $wpdb->get_row($safe_sql,ARRAY_A);
	$row=christmas_card_1_unstrip_array($row);
	$_POST = $row;
	$_POST=christmas_card_1_unstrip_array($_POST);
	if ($_POST['popup']=='true') {
			writePreviewAndPopupFile($_SESSION['xid'],'tpl/popup.html',$_POST['popup']);
	}


	include_once($christmas_card_1_path . 'tpl/settings_form.php');

}




//HTML duplicate card
function christmas_card_1_duplicate_card_page()
{
	global $wpdb;
	global $christmas_card_1_messages;
	global $christmas_card_1_path;

	if (isset($_GET['id']) && isset($_GET['name'])) {
		$_SESSION['xid']=$_GET['id'];
		$_SESSION['xname']=$_GET['name'];
	}

	//$wpdb->show_errors();


	//echo "WP_PLUGIN_URL: ".WP_PLUGIN_URL;
	//$safe_sql=$wpdb->prepare( "INSERT INTO ".$wpdb->prefix ."christmas_card_1_settings SELECT * FROM (".$wpdb->prefix ."christmas_card_1_settings) WHERE id = %d",$_SESSION['xid'] );
	//insert card
	$wpdb->insert(
			$wpdb->prefix . "christmas_card_1_cards",
			array(
				'name' => 'Duplicate of Card '.$_SESSION['xid']
			),
			array(
				'%s'
			)
		);

	//duplicate settings
	$safe_sql=$wpdb->prepare( "INSERT INTO ".$wpdb->prefix ."christmas_card_1_settings (`h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `mp3`, `ogg`, `facebook_link`, `twitter_link`, `instagram_link`, `youtube_link`, `pinterest_link`, `linkedin_link`, `googleplus_link`, `popup`, `delay`) SELECT `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `mp3`, `ogg`, `facebook_link`, `twitter_link`, `instagram_link`, `youtube_link`, `pinterest_link`, `linkedin_link`, `googleplus_link`, `popup`, `delay` FROM (".$wpdb->prefix ."christmas_card_1_settings) WHERE id = %d",$_SESSION['xid'] );
	$wpdb->query($safe_sql);
	?>
	<div id="message" class="updated"><p><?php echo $christmas_card_1_messages['duplicate_complete'];?></p></div>
	<?php

	//echo $wpdb->last_query;


	//popup
	$safe_sql=$wpdb->prepare( "SELECT popup FROM (".$wpdb->prefix ."christmas_card_1_settings) WHERE id = %d",$_SESSION['xid'] );
	$row = $wpdb->get_row($safe_sql,ARRAY_A);
	$row=christmas_card_1_unstrip_array($row);
	if ($row['popup']=='true') {
		$wpdb->update(
			$wpdb->prefix .'christmas_card_1_settings',
			array( 'popup' => 'false' ),
			array( 'id' => $_SESSION['xid'] ),
			array( '%s' ),
			array( '%d' )
		);
	}


	$safe_sql="SELECT * FROM (".$wpdb->prefix ."christmas_card_1_cards) ORDER BY id";
	$result = $wpdb->get_results($safe_sql,ARRAY_A);
	include_once($christmas_card_1_path . 'tpl/cards.php');


}


function christmas_card_1_card_help_page()
{
	//include_once(plugins_url('tpl/help.php', __FILE__));
	global $christmas_card_1_path;
	include_once($christmas_card_1_path . 'tpl/help.php');
}

function christmas_card_1_card_color_parameter($the_param)
{
	$to_return="#";
	if ($the_param=="transparent") {
		$to_return="";
	}
	return $to_return;
}


function christmas_card_1_generate_preview_code($sliderID) {
	global $wpdb;

	$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."christmas_card_1_settings) WHERE id = %d",$sliderID );
	$row = $wpdb->get_row($safe_sql,ARRAY_A);
	$row=christmas_card_1_unstrip_array($row);

	$content='';
	$audio_player_code='';
	if ($row['mp3']!='')
	$audio_player_code='<!--AUDIO PLAYER-->
	<script>
	jQuery(function() {
		jQuery("#audio1_html5_white").audio1_html5({
			skin: "whiteControllers",
			playerPadding:0,
			autoPlay:true,
			showRewindBut:false,
			showPreviousBut:false,
			showNextBut:false,
			showPlaylistBut:false,
			showVolumeBut:false,
			showVolumeSliderBut:false,
			showTimer:false,
			showSeekBar:false,
			showAuthor:false,
			showTitle:false,
			showPlaylist:false,
			playerBg: "transparent"
		});
	});
	</script>
	<div class="audio1_html5">
	            <audio id="audio1_html5_white" preload="metadata">
	                  <div class="xaudioplaylist">
	                       <ul>
	                          <li class="xtitle">Jingle</li>
	                          <li class="xauthor">Jingle</li>
	                          <li class="xsources_mp3">'.$row['mp3'].'</li>
	                          <li class="xsources_ogg">'.$row['ogg'].'</li>
	                      </ul>

	                  </div>
	              No HTML5 audio playback capabilities for this browser. Use <a href="https://www.google.com/intl/en/chrome/browser/">Chrome Browser!</a>
	            </audio>
	</div>
	<!--END AUDIO PLAYER-->';

	$social_channels_code='<div class="christmasSocialBox">
	<ul>
	';
	if ($row['facebook_link']!='') {
			$social_channels_code.='
			<li class="christmasSocial"><a href="'.$row['facebook_link'].'" target="_blank" title="Facebook"><img src="'.plugins_url('the_card/images/christmas_social/Facebook.svg', __FILE__).'"></a></li>';
	}
	if ($row['twitter_link']!='') {
			$social_channels_code.='
			<li class="christmasSocial"><a href="'.$row['twitter_link'].'" target="_blank" title="Twitter"><img src="'.plugins_url('the_card/images/christmas_social/Twitter.svg', __FILE__).'"></a></li>';
	}
	if ($row['pinterest_link']!='') {
			$social_channels_code.='
			<li class="christmasSocial"><a href="'.$row['pinterest_link'].'" target="_blank" title="Pinterest"><img src="'.plugins_url('the_card/images/christmas_social/pinterest.svg', __FILE__).'"></a></li>';
	}
	if ($row['youtube_link']!='') {
			$social_channels_code.='
			<li class="christmasSocial"><a href="'.$row['youtube_link'].'" target="_blank" title="Youtube"><img src="'.plugins_url('the_card/images/christmas_social/Youtube.svg', __FILE__).'"></a></li>';
	}
	if ($row['instagram_link']!='') {
			$social_channels_code.='
			<li class="christmasSocial"><a href="'.$row['instagram_link'].'" target="_blank" title="Instagram"><img src="'.plugins_url('the_card/images/christmas_social/instagram.svg', __FILE__).'"></a></li>';
	}
	if ($row['googleplus_link']!='') {
			$social_channels_code.='
			<li class="christmasSocial"><a href="'.$row['googleplus_link'].'" target="_blank" title="Google Plus"><img src="'.plugins_url('the_card/images/christmas_social/googleplus.svg', __FILE__).'"></a></li>';
	}
	if ($row['linkedin_link']!='') {
			$social_channels_code.='
			<li class="christmasSocial"><a href="'.$row['linkedin_link'].'" target="_blank" title="LinkedIn"><img src="'.plugins_url('the_card/images/christmas_social/linkedin.svg', __FILE__).'"></a></li>';
	}
	$social_channels_code.='
	</ul></div>';

	$content.=$audio_player_code;
	$content.='<div class="MerryChristmasBox">
					<div class="MerryChristmas">
							<h1>'.$row['h1'].'</h1>
							<h2>'.$row['h2'].'</h2>
							<h3>'.$row['h3'].'</h3>
					</div>
			<div class="MerryChristmasBg"></div>
	</div>


	<div class="christmasCharacters" >

			<div class="christmasCarriageBox fadeInAnimation2">
					<div class="christmasCarriage"></div>
			</div>

			<div class="christmasHorseBox fadeInAnimation2">
					<div class="christmasHorse"></div>
			</div>

			<div class="christmasWheelsBox fadeInAnimation2">
					<div class="christmasWheel1"></div>
			</div>

			<div class="foreground1"></div>
			<div class="foreground2"></div>

	</div>

<div class="sidewalk"></div>

<!--<div class="pinkdiv"></div>-->

<div class="christmasStreetBox">
			<div class="christmasStreet2"></div>
			<div class="christmasStreet1"></div>
	</div>';
	$content.=$social_channels_code;

	$content.='<div class="christmasAdressBox">

		<div class="landscape">
					<h4 style="padding-bottom:10px;">'.$row['h4'].'</h4>
					<h5>'.$row['h5'].'</h5>
					<h6>'.$row['h6'].'</h6>
			</div>
			<div class="portrait">
					<h4 style="padding-bottom:10px;">'.$row['h4'].'</h4>
					<h5>'.$row['h5'].'</h5>
					<h6>'.$row['h6'].'</h6>
			</div>
	</div>

	<div class="fadeInAnimation lbg1_ImageOnly">
			<div class="snow3 lbg1_ImageOnly"></div>
		<div class="snow2 lbg1_ImageOnly"></div>
		<div class="snow1 lbg1_ImageOnly"></div>
	</div>

	<div class="christmasTheMoon"></div>

	<div class="christmasWhiteBox">
		<div class="christmasWhiteMiddle1"></div>
	</div>

	<div class="christmasWhiteBox2">
		<div class="christmasWhiteMiddle2"></div>
	</div>

	<div class="frontBlueBox">
		<div class="frontBlue"></div>
	</div>

	<!-- FIREWORKS-->
	<div style="position:absolute; top:0%; left:5%; z-index:0;">
	<div class="pyro"></div>
	</div>';

	$content='<div class="the_card_1_wrapper">'.$content.'</div>';

	//return str_replace("\r\n", '', $content);
	return $content;
}

function christmas_card_1_shortcode($atts, $content=null) {
	global $wpdb;

	shortcode_atts( array('settings_id'=>''), $atts);
	if ($atts['settings_id']=='')
		$atts['settings_id']=1;


	return christmas_card_1_generate_preview_code($atts['settings_id']);
}



register_activation_hook(__FILE__,"christmas_card_1_activate"); //activate plugin and create the database
register_uninstall_hook(__FILE__, 'christmas_card_1_uninstall'); // on unistall delete all databases
add_action('init', 'christmas_card_1_init_sessions');	// initialize sessions
add_action('init', 'christmas_card_1_load_styles');	// loads required styles
add_action('init', 'christmas_card_1_load_scripts');			// loads required scripts
add_action('admin_menu', 'christmas_card_1_plugin_menu'); // create menus
add_shortcode('christmas_card_1', 'christmas_card_1_shortcode');				// CHRISTMAS CARD 1 shortcode









/** OTHER FUNCTIONS **/

//stripslashes for an entire array
function christmas_card_1_unstrip_array($array){
	if (is_array($array)) {
		foreach($array as &$val){
			if(is_array($val)){
				$val = unstrip_array($val);
			} else {
				$val = stripslashes($val);

			}
		}
	}
	return $array;
}



function christmas_card_1_footer_function() {
	global $wpdb;
	//$safe_sql=$wpdb->prepare( "SELECT `id`,`popup` FROM (".$wpdb->prefix ."christmas_card_1_settings)",1);
	$safe_sql="SELECT id,popup FROM ".$wpdb->prefix."christmas_card_1_settings";
	$result = $wpdb->get_results($safe_sql,ARRAY_A);


	$shortcode_id=0;
	foreach ( $result as $row ) {
		$row=christmas_card_1_unstrip_array($row);
		if ($row['popup']==='true') {
			//$shortcode_id=$row['id'];
			echo '<style>div.famous_pp_default .famous_pp_content_container .famous_pp_details {margin-top: 0px !important;}
			div.famous_pp_default .famous_pp_close {top: -20px !important;}</style>

			<a href="/wp-content/plugins/christmas_card_1/tpl/popup.html?iframe=true&width=80%&height=100%" rel="christmas_card_1" id="christmas_card_1_popup" title=""></a>

			<script>
			jQuery(document).ready(function() {
					function setCookie(c_name,value,maxAgeSeconds) {
							//here 1.2.3 start
							if (maxAgeSeconds==null) {
								maxAgeSeconds=24*60*60;
							}
							var maxAge = "; max-age=" + maxAgeSeconds;
							document.cookie = encodeURI(c_name) + "=" + encodeURI(value) + maxAge;
					}

					function getCookie(c_name)
					{
							var i,x,y,ARRcookies=document.cookie.split(";");
							for (i=0;i<ARRcookies.length;i++)
							{
							x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
							y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
							x=x.replace(/^\s+|\s+$/g,"");
							if (x==c_name)
								{
								return unescape(y);
								}
							}
					}

					var current_christmas_card_1_cookie_popupWin = getCookie("christmas_card_1_cookie_popupWin");
					jQuery("a[id=\'christmas_card_1_popup\']").prettyPhotoFamous({
						show_title: false,
						deeplinking: false,
						gallery_markup: "",
						social_tools:"",
						callback: function() { /*alert(current_christmas_card_1_cookie_popupWin);*/ setCookie("christmas_card_1_cookie_popupWin", true,1201); }
					});
					if (current_christmas_card_1_cookie_popupWin!="true") {
							setTimeout(function(){ jQuery("a[id=\'christmas_card_1_popup\']").click(); }, 700);
					}
					jQuery( window ).resize(function() {
					  	jQuery.prettyPhotoFamous.close();
					});

			});
			</script>
			';
		}
	}
	/*if ($shortcode_id>0)
    	echo do_shortcode("[christmas_card_1 settings_id='".$shortcode_id."']");*/
}
add_action( 'wp_footer', 'christmas_card_1_footer_function', 100 );





/* ajax update playlist record */

add_action('admin_head', 'christmas_card_1_update_playlist_record_javascript');

function christmas_card_1_update_playlist_record_javascript() {
	global $wpdb;
	//Set Your Nonce
	$christmas_card_1_update_playlist_record_ajax_nonce = wp_create_nonce("christmas_card_1_update_playlist_record-special-string");
	$christmas_card_1_preview_record_ajax_nonce = wp_create_nonce("christmas_card_1_preview_record-special-string");

	if(strpos($_SERVER['PHP_SELF'], 'wp-admin') !== false) {
			$page = (isset($_GET['page'])) ? $_GET['page'] : '';
			if(preg_match('/CHRISTMAS_CARD_1/i', $page)) {
?>



<script type="text/javascript" >

function showDialogPreview(theSliderID) {  //load content and open dialog
	var data ="action=christmas_card_1_preview_record&security=<?php echo $christmas_card_1_preview_record_ajax_nonce; ?>&theSliderID="+theSliderID;

	// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
	jQuery.post(ajaxurl, data, function(response) {
		//jQuery("#previewDialog").html(response);
		jQuery('#previewDialogIframe').attr('src','<?php echo plugins_url("tpl/preview.html?d=".time(), __FILE__)?>');
		jQuery("#previewDialog").dialog("open");
	});
}


jQuery(document).ready(function($) {
	/*PREVIEW DIALOG BOX*/
	jQuery( "#previewDialog" ).dialog({
	  minWidth:1200,
	  minHeight:500,
	  title:"Plugin Preview",
	  modal: true,
	  autoOpen:false,
	  hide: "fade",
	  resizable: false,
	  open: function() {
		//jQuery( this ).html();
	  },
	  close: function() {
		//jQuery("#previewDialog").html('');
		jQuery('#previewDialogIframe').attr('src','');
	  }
	});

});
</script>
<?php
		}
	}
}



function writePreviewAndPopupFile($theSliderID,$theFileName,$thePopup) {
	global $wpdb;


	$aux_val='<!DOCTYPE html>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
						<link href="'.plugins_url('the_card/css/styles_christmas.css', __FILE__).'" rel="stylesheet" type="text/css">
						<link href="'.plugins_url('the_card/css/media-queries.css', __FILE__).'" rel="stylesheet" type="text/css">
						<link href="'.plugins_url('the_card/css/styles_fireworks.css', __FILE__).'" rel="stylesheet" type="text/css">
						<link href="'.plugins_url('the_card/css/limelight.css', __FILE__).'" rel="stylesheet" type="text/css">
						<link href="'.plugins_url('the_card/css/tangerine.css', __FILE__).'" rel="stylesheet" type="text/css">
						<link href="'.plugins_url('the_card/css/yesevaone.css', __FILE__).'" rel="stylesheet" type="text/css">
						<link href="'.plugins_url('the_card/audioPlayer/audio1_html5.css', __FILE__).'" rel="stylesheet" type="text/css">

						<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
						<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
						<script src="'.plugins_url('the_card/js/resize_card.js', __FILE__).'" type="text/javascript"></script>
						<!-- audio player -->
						<script src="'.plugins_url('the_card/audioPlayer/js/jquery.mousewheel.min.js', __FILE__).'" type="text/javascript"></script>
						<script src="'.plugins_url('the_card/audioPlayer/js/jquery.touchSwipe.min.js', __FILE__).'" type="text/javascript"></script>
						<script src="'.plugins_url('the_card/audioPlayer/js/audio1_html5.js', __FILE__).'" type="text/javascript"></script>

					</head>
					<body style="padding:0px;margin:0px;">';

	$aux_val.=christmas_card_1_generate_preview_code($theSliderID);
	$aux_val.="</body>
				</html>";


	$filename=plugin_dir_path(__FILE__) . $theFileName;
	if ($theFileName=='tpl/preview.html') {
		$fp = fopen($filename, 'w+');
		$fwrite = fwrite($fp, $aux_val);
	} else {
		if ($thePopup=='true') {
			$fp = fopen($filename, 'w+');
			$fwrite = fwrite($fp, $aux_val);
		}
	}



	//echo $fwrite;

}




add_action('wp_ajax_christmas_card_1_preview_record', 'christmas_card_1_preview_record_callback');

function christmas_card_1_preview_record_callback() {
	check_ajax_referer( 'christmas_card_1_preview_record-special-string', 'security' );

	writePreviewAndPopupFile($_POST['theSliderID'],'tpl/preview.html','false');
	//echo christmas_card_1_generate_preview_code($_POST['theSliderID']);

	die(); // this is required to return a proper result
}



?>
