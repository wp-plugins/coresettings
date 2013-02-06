<?php
/*
Plugin Name: TCR Setup & Settings
License: GPL
Version: 1.0.0
Plugin URI: http://thecellarroom.net
Author: The Cellar Room Limited
Author URI: http://www.thecellarroom.net
Copyright (c) 2013 The Cellar Room Limited

Description: settings, filters and options
*Removes and adds better fields to user profile
*Removes Admin bar
*Removes wp-pagenavi + google sitemap styles from head
*Removes excess from wordpress head.
*Autocorrects page/post titles
*change to default cookie timeout setting
*/
###################################################################################
defined( 'ABSPATH' ) or die();

//First use the add_action to add onto the WordPress menu.

 if(function_exists('add_action'))
add_action('admin_menu', 'tcr_add_options');

//Make our function to call the WordPress function to add to the correct menu.
function tcr_add_options() {
	add_management_page('TCR Settings', 'TCR Settings', 8, 'coresetup', 'tcr_options_page');	
}

function tcr_options_page() {
    // variables for the field and option names 
    $opt_name = array(	      

	'tcr_activ_capcon'		=> 'tcr_activ_capcon',
	'tcr_activ_junk' 		=> 'tcr_activ_junk',
	'tcr_activ_junk1' 		=> 'tcr_activ_junk1',
	'tcr_activ_junk2' 		=> 'tcr_activ_junk2',
	'tcr_activ_junk3' 		=> 'tcr_activ_junk3',
	'tcr_activ_junk4' 		=> 'tcr_activ_junk4',
	'tcr_activ_junk5' 		=> 'tcr_activ_junk5',	
	'tcr_activ_profile' 	=> 'tcr_activ_profile',
	'tcr_activ_title' 		=> 'tcr_activ_title',
	'tcr_dereg_pagenavi' 	=> 'tcr_dereg_pagenavi',
	'tcr_remember_me' 		=> 'tcr_remember_me',
	'tcr_authorfilter' 		=> 'tcr_authorfilter',
	'tcr_twittername' 		=> 'tcr_twittername',
	'tcr_twitterhash' 		=> 'tcr_twitterhash',
	'tcr_activ_allset' 		=> 'tcr_activ_allset'
	);
				  
    $hidden_field_name = 'tcr_submit_hidden';

	// Read in existing option value from database
	$opt_val = array(
  	 'tcr_activ_capcon' 	=> get_option( $opt_name['tcr_activ_capcon'] ),
  	 'tcr_activ_junk' 		=> get_option( $opt_name['tcr_activ_junk'] ),
  	 'tcr_activ_junk1' 		=> get_option( $opt_name['tcr_activ_junk1'] ),
  	 'tcr_activ_junk2' 		=> get_option( $opt_name['tcr_activ_junk2'] ),
  	 'tcr_activ_junk3' 		=> get_option( $opt_name['tcr_activ_junk3'] ),
  	 'tcr_activ_junk4' 		=> get_option( $opt_name['tcr_activ_junk4'] ),
  	 'tcr_activ_junk5' 		=> get_option( $opt_name['tcr_activ_junk5'] ),
	 'tcr_activ_profile' 	=> get_option( $opt_name['tcr_activ_profile'] ),
  	 'tcr_activ_title' 		=> get_option( $opt_name['tcr_activ_title'] ),
	 'tcr_activ_allset' 	=> get_option( $opt_name['tcr_activ_allset'] ),
  	 'tcr_dereg_pagenavi' 	=> get_option( $opt_name['tcr_dereg_pagenavi'] ),
	 'tcr_authorfilter' 	=> get_option( $opt_name['tcr_authorfilter'] ),	 
	 'tcr_twittername' 		=> get_option( $opt_name['tcr_twittername'] ),
	 'tcr_twitterhash' 		=> get_option( $opt_name['tcr_twitterhash'] ),	 
	 'tcr_remember_me' 		=> get_option( $opt_name['tcr_remember_me'] ),
	);

// See if the user has posted us some information
// If they did, this hidden field will be set to 'Y'

if(isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
    // Read their posted value
    $opt_val = array(	
    'tcr_activ_junk'		=> $_POST[ $opt_name['tcr_activ_junk'] ],
    'tcr_activ_junk1'		=> $_POST[ $opt_name['tcr_activ_junk1'] ],
	'tcr_activ_junk2'		=> $_POST[ $opt_name['tcr_activ_junk2'] ],
	'tcr_activ_junk3'		=> $_POST[ $opt_name['tcr_activ_junk3'] ],
	'tcr_activ_junk4'		=> $_POST[ $opt_name['tcr_activ_junk4'] ],
	'tcr_activ_junk5'		=> $_POST[ $opt_name['tcr_activ_junk5'] ],
    'tcr_activ_profile'		=> $_POST[ $opt_name['tcr_activ_profile'] ],				
    'tcr_activ_title'		=> $_POST[ $opt_name['tcr_activ_title'] ],
	'tcr_activ_capcon'		=> $_POST[ $opt_name['tcr_activ_capcon'] ],
	'tcr_activ_allset'		=> $_POST[ $opt_name['tcr_activ_allset'] ],
    'tcr_dereg_pagenavi'	=> $_POST[ $opt_name['tcr_dereg_pagenavi'] ],
	'tcr_authorfilter'		=> $_POST[ $opt_name['tcr_authorfilter'] ],
	'tcr_twittername'		=> $_POST[ $opt_name['tcr_twittername'] ],
	'tcr_twitterhash'		=> $_POST[ $opt_name['tcr_twitterhash'] ],
	'tcr_remember_me'		=> $_POST[ $opt_name['tcr_remember_me'] ],
	);		

    // Save the posted value in the database
	update_option( $opt_name['tcr_activ_junk']		, $opt_val['tcr_activ_junk'] );
	update_option( $opt_name['tcr_activ_junk1']		, $opt_val['tcr_activ_junk1'] );
	update_option( $opt_name['tcr_activ_junk2']		, $opt_val['tcr_activ_junk2'] );
	update_option( $opt_name['tcr_activ_junk3']		, $opt_val['tcr_activ_junk3'] );
	update_option( $opt_name['tcr_activ_junk4']		, $opt_val['tcr_activ_junk4'] );
	update_option( $opt_name['tcr_activ_junk5']		, $opt_val['tcr_activ_junk5'] );	
	update_option( $opt_name['tcr_activ_profile']	, $opt_val['tcr_activ_profile'] );
	update_option( $opt_name['tcr_activ_title']		, $opt_val['tcr_activ_title'] );
	update_option( $opt_name['tcr_activ_capcon']	, $opt_val['tcr_activ_capcon'] );
	update_option( $opt_name['tcr_activ_allset']	, $opt_val['tcr_activ_allset'] );
	update_option( $opt_name['tcr_dereg_pagenavi']	, $opt_val['tcr_dereg_pagenavi'] );
	update_option( $opt_name['tcr_authorfilter']	, $opt_val['tcr_authorfilter'] );
	update_option( $opt_name['tcr_twittername']		, $opt_val['tcr_twittername'] );
	update_option( $opt_name['tcr_twitterhash']		, $opt_val['tcr_twitterhash'] );
	update_option( $opt_name['tcr_remember_me']		, $opt_val['tcr_remember_me'] );		
    // Put an options updated message on the screen
?>
<div id="message" class="updated fade"><p><strong><?php _e('Options saved.', 'tcr_trans_domain' ); ?></strong></p></div>

<?php
	}
?>

<div class="wrap">
<div id="icon-options-general" class="icon32"><br /></div>
<h2><?php _e( 'TCR Core Setup Options', 'tcr_trans_domain' ); ?></h2>
<p>A one size fits all utility plugin that does a little bit of everything you'd want from a standard wordpress install</p>

<form name="att_img_options" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<h3>General Options</h3>

<input id="tcr_activ_junk" name="tcr_activ_junk" type="checkbox" value="1" <?php checked( '1', get_option( 'tcr_activ_junk' ) ); ?> />
<label for="tcr_activ_junk">Remove the admin bar?</label>
<br/>

<input id="tcr_activ_junk1" name="tcr_activ_junk1" type="checkbox" value="1" <?php checked( '1', get_option( 'tcr_activ_junk1' ) ); ?> />
<label for="tcr_activ_junk1">Remove the feed links from head?</label>
<br/>

<input id="tcr_activ_junk2" name="tcr_activ_junk2" type="checkbox" value="1" <?php checked( '1', get_option( 'tcr_activ_junk2' ) ); ?> />
<label for="tcr_activ_junk2">Remove the rsd link from head?</label>
<br/>

<input id="tcr_activ_junk3" name="tcr_activ_junk3" type="checkbox" value="1" <?php checked( '1', get_option( 'tcr_activ_junk3' ) ); ?> />
<label for="tcr_activ_junk3">Remove wlmanifestr link from head?</label>
<br/>

<input id="tcr_activ_junk4" name="tcr_activ_junk4" type="checkbox" value="1" <?php checked( '1', get_option( 'tcr_activ_junk4' ) ); ?> />
<label for="tcr_activ_junk4">Remove index, parent, start and adjacent link rels from head?</label>
<br/>

<input id="tcr_activ_junk5" name="tcr_activ_junk5" type="checkbox" value="1" <?php checked( '1', get_option( 'tcr_activ_junk5' ) ); ?> />
<label for="tcr_activ_junk5">Remove wp generator from head?</label>
<br/>

<input id="tcr_activ_profile" name="tcr_activ_profile" type="checkbox" value="1" <?php checked( '1', get_option( 'tcr_activ_profile' ) ); ?> />
<label for="tcr_activ_profile">Remove junk from the user page?</label>
<br/>

<input id="tcr_activ_title" name="tcr_activ_title" type="checkbox" value="1" <?php checked( '1', get_option( 'tcr_activ_title' ) ); ?> />
<label for="tcr_activ_title">Activate Title Autofix?</label>
<br/>

<input id="tcr_activ_capcon" name="tcr_activ_capcon" type="checkbox" value="1" <?php checked( '1', get_option( 'tcr_activ_capcon' ) ); ?> />
<label for="tcr_activ_capcon">Activate Content Auto capitalise after full stops?</label>
<br/>

<input id="tcr_dereg_pagenavi" name="tcr_dereg_pagenavi" type="checkbox" value="1" <?php checked( '1', get_option( 'tcr_dereg_pagenavi' ) ); ?> />
<label for="tcr_dereg_pagenavi">Using pageNavi plugin + google sitemap plugin; Remove the styles for speed improvemnt? </label>
<p>copy the CSS from these plugins into your themes css to help minimise things loading and improve site speed</p>
<br/>

<input id="tcr_remember_me" name="tcr_remember_me" type="checkbox" value="1" <?php checked( '1', get_option( 'tcr_remember_me' ) ); ?> />
<label for="tcr_remember_me">Custom login cookie?</label>
<br/>

<input id="tcr_authorfilter" name="tcr_authorfilter" type="checkbox" value="1" <?php checked( '1', get_option( 'tcr_authorfilter' ) ); ?> />
<label for="tcr_authorfilter">View admin author filter?</label>
<br/>

<input id="tcr_twittername" name="tcr_twittername" type="checkbox" value="1" <?php checked( '1', get_option( 'tcr_twittername' ) ); ?> />
<label for="tcr_twittername">Turn @usernames into twitter links?</label>
<br/>

<input id="tcr_twitterhash" name="tcr_twitterhash" type="checkbox" value="1" <?php checked( '1', get_option( 'tcr_twitterhash' ) ); ?> />
<label for="tcr_twitterhash">Turn #hashtags into twitter search links?</label>
<br/>


<input id="tcr_activ_allset" name="tcr_activ_allset" type="checkbox" value="1" <?php checked( '1', get_option( 'tcr_activ_allset' ) ); ?> />
<label for="tcr_activ_allset">Activate All-settings Page?</label>
<br/>

</tbody>
</table>

<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"  /></p>  
</form>
</div>
<?php
}
// Some filters

add_filter('wp_mail_from'		,get_option( $opt_name['tcr_email_from']));
add_filter('wp_mail_from_name'	,get_option( $opt_name['tcr_email_from_name']));

###################################################################################

if(!get_option('tcr_twittername') ) {
// no nothing here
} else {
	// Make twitter username stuff happy
	function tcr_twitusername($content) {
	$content = preg_replace("/(^|\s)*(@([a-zA-Z0-9-_]{1,15}))(\.*[\n|\r|\t|\s|\<|\&]+?)/i", "$1<a href=\"http://twitter.com/$3\">$2</a>$4", $content);
	return $content;
	}
	add_filter('the_content','tcr_twitusername');
}

###################################################################################

if(!get_option('tcr_twitterhash') ) {
// no nothing here
} else {
	// Make twitter hash stuff happy	
	function tcr_twithash($content) {
	$content = preg_replace('/([^a-zA-Z0-9-_&])#([0-9a-zA-Z_]+)/',"$1<a href=\"http://twitter.com/search?q=%23$2\" target=\"_blank\">#$2</a>",$content);
	return $content;
	}
	add_filter('the_content','tcr_twithash');
}

###################################################################################
if(!get_option('tcr_authorfilter') ) {
// no nothing here
} else {
	// add author filter to wordpress posts admin
	add_action('restrict_manage_posts', 'author_filter');
	function author_filter() {
		$args = array('name' => 'author', 'show_option_all' => 'View all authors');
			if (isset($_GET['user'])) {
					$args['selected'] = $_GET['user'];
					}
				wp_dropdown_users($args);
		}
}
###################################################################################

if(!get_option('tcr_activ_title') ) {
// no nothing here
} else {
function lowertitle($title)  {
$title = strtolower($title);
return $title;
}

function fixtitle($title) {
$smallwordsarray = array( 'of','a','the','and','an','or','nor','but','is','if','then','else','when', 'at','from','by','on','off','for','in','out','over','to','into','with' ); 
$words = explode(' ', $title); 
foreach ($words as $key => $word) {
if ($key == 0 or !in_array($word, $smallwordsarray)) $words[$key] = ucwords($word); 
} 
$newtitle = implode(' ', $words); return $newtitle; }

add_filter('title_save_pre'	, 'lowertitle');
add_filter('the_title'		, 'lowertitle');
add_filter('title_save_pre'	, 'fixtitle');
add_filter('the_title'		, 'fixtitle');

//your migrate stuff here
}
###################################################################################

if(!get_option('tcr_activ_allset') ) {
// no nothing here
} else { 

// Adds a custom view all settings option to the admin page
   function all_settings_link() {
    add_options_page(__('All Settings'), __('All Settings'), 'administrator', 'options.php');
   }
   add_action('admin_menu', 'all_settings_link');
}
   
###################################################################################

if(!get_option('tcr_activ_junk') ) {
// no nothing here
} else {
// remove plenty of wp_head actions and surplus nonsense not needed
remove_action('init'	,'wp_admin_bar_init');
}

###################################################################################

if(!get_option('tcr_activ_junk1') ) {
// no nothing here
} else {
// remove plenty of wp_head actions and surplus nonsense not needed
remove_action('wp_head'	,'feed_links',2);
remove_action('wp_head'	,'feed_links_extra',3);
}

###################################################################################

if(!get_option('tcr_activ_junk2') ) {
// no nothing here
} else {
// remove plenty of wp_head actions and surplus nonsense not needed
remove_action('wp_head'	,'rsd_link');
}

###################################################################################

if(!get_option('tcr_activ_junk3') ) {
// no nothing here
} else {
// remove plenty of wp_head actions and surplus nonsense not needed
remove_action('wp_head'	,'wlwmanifest_link');
}

###################################################################################

if(!get_option('tcr_activ_junk4') ) {
// no nothing here
} else {
// remove plenty of wp_head actions and surplus nonsense not needed
remove_action('wp_head'	,'index_rel_link');
remove_action('wp_head'	,'parent_post_rel_link',10,0);
remove_action('wp_head'	,'start_post_rel_link',10,0);
remove_action('wp_head'	,'adjacent_posts_rel_link_wp_head',10,0);
}

###################################################################################

if(!get_option('tcr_activ_junk5') ) {
// no nothing here
} else {
// remove plenty of wp_head actions and surplus nonsense not needed
remove_action('wp_head'	,'wp_generator');
}

###################################################################################

if(!get_option('tcr_activ_profile') ) {
// no nothing here
} else {
// remove plenty of wp_head actions and surplus nonsense not needed
// Remove and replace rubbish contact methods in user account
// the twitter one is key as this replaces the author.php pages
function TCR_extra_contact_info($contactmethods) {
    unset($contactmethods['aim']);
    unset($contactmethods['yim']);
    unset($contactmethods['jabber']);
    $contactmethods['twitter'] = 'Twitter';
    return $contactmethods;
}
add_filter('user_contactmethods', 'TCR_extra_contact_info');

}

###################################################################################

// Remove default styling wp-pagenavi creates as these are already in my style sheet and saves using styling plugin

if(!get_option('tcr_dereg_pagenavi') ) {
// no nothing here
} else {

function CFC_deregister_styles() { 
wp_deregister_style( 'wp-pagenavi' ); 
wp_deregister_style( 'page-list-style' );
}

add_action( 'wp_print_styles', 'CFC_deregister_styles', 100 );
}


if(!get_option('tcr_remember_me') ) {
// no nothing here
} else {

// Hook stuff in
function tcr_remember_init() {
	add_filter( 'login_footer',           'tcr_remember_js' );
	add_filter( 'auth_cookie_expiration', 'tcr_remember_cookie' );
}
add_action( 'init', 'tcr_remember_init' );

// JS that checks the checkbox
function tcr_remember_js() {
	echo <<<JS
	<script>
	document.getElementById('rememberme').checked = true;
	document.getElementById('user_login').focus();
	</script>
JS;
}

function tcr_remember_cookie() {
	return 31536000; // one year: 60 * 60 * 24 * 365
}
}
?>