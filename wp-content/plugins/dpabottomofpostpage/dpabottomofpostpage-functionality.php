<?php
/*
Plugin Name: dpabottomofpostpage
Plugin URI: https://www.dpabadbot.com/customise-wordpress-plugin-to-add-messages-ads-bottom-of-post.php
Description: Please Deactivate and Delete previous version before installing this version. This plugin can add several messages or adverts to the bottom of every post and page content or at the end of the document or webpage. Very useful if you have several messages like copyright notice, Google Ads, other affliate advertisements, ads and Facebook, Google+ & Twitter Like and Share Buttons... There is no limit as to how many messages you have at the bottom of your posts or pages. You can have different messages for posts and for pages. Now understands that you can fine tune your webpage for SEO and the messages can affect your SEO. Your messages can be saved elsewhere so that they do not affect your page SEO. Just click on "Affects SEO" radio button and set the width and height of message.You can show post messages in Home, Category & Archives summary pages. Now can stop displaying messages in some posts and some pages. Can process and display short codes.
Version: 1.19 [20150827]   
Author: Dr. Peter Achutha
Author URI: http://facebook/peter.achutha
License: GPL2
*/

/*
	avoid a name collision, make sure this function is not
	already defined */
defined('ABSPATH') or die("No script kiddies please!");
global $id, $authordata, $currentday, $currentmonth, $page, $pages, $multipage, $more, $numpages, $post;

//$spmybpz_datadir = dirname(__FILE__) ;
//$spmybpz_string_position = strpos( $spmybpz_datadir , 'zbottomofpostpage');
//$spmybpz_datadiralt = substr_replace( $spmybpz_datadir , 'zbottomofpostpagedata' , $spmybpz_string_position  );

$spmybpz_plugins_url = dirname(__FILE__);
$spmybpz_plugins_namearray = explode( '/', $spmybpz_plugins_url );
$spmybpz_plugins_namearraysz = count( $spmybpz_plugins_namearray );
$spmybpz_plugins_name = $spmybpz_plugins_namearray[ $spmybpz_plugins_namearraysz -1 ];
$spmybpz_plugins_url = plugins_url().'/'.$spmybpz_plugins_name;

$spmybpz_plugins_urldata = str_replace( '/wp-content/plugins', '/wp-content/uploads', plugins_url()).'/'.$spmybpz_plugins_name;
$spmybpz_plugins_datadir = str_replace( '/wp-content/plugins', '/wp-content/uploads', dirname(__FILE__));

$spmybpz_datadiralt = $spmybpz_plugins_datadir;
$spmybpz_setup_file = $spmybpz_datadiralt ."/setup.txt";
$spmybpz_published_posts_file = $spmybpz_datadiralt ."/publishedposts.txt";
$spmybpz_published_pages_file = $spmybpz_datadiralt ."/publishedpages.txt";
$spmybpz_setup_seopost_file = $spmybpz_datadiralt ."/seopost.txt";
$spmybpz_setup_seopage_file = $spmybpz_datadiralt ."/seopage.txt";
$spmybpz_post_scroll_data_file = $spmybpz_datadiralt ."/scrollposts.txt";
$spmybpz_page_scroll_data_file = $spmybpz_datadiralt ."/scrollpages.txt";
$spmybpz_msg_array_file = $spmybpz_datadiralt ."/postmgsarray.txt";
$spmybpz_tmpstr_html_array_file = $spmybpz_datadiralt ."/postmgshtmlarray.txt";
$spmybpz_page_msg_array_file = $spmybpz_datadiralt ."/pagemgsarray.txt";
$spmybpz_tmpstr_page_html_array_file = $spmybpz_datadiralt ."/pagemgshtmlarray.txt";

function spmybpz_zbopp_addform(){
include('setup_form.php');
}


function spmybpz_zbopp_actions() {
add_options_page("dpabottomofpostpage", "dpabottomofpostpageMenu", 'administrator', "dpabottomofpostpage_Menu", "spmybpz_zbopp_addform"); 
}

 
function spmybpz_zbopp_read_file( $f ){
$tmpstr = '';
if( file_exists( $f ) ){
	$fh = fopen( $f, 'r');
	$tmpstr = fread( $fh, filesize( $f ) );
	fclose( $fh );
	}
return( $tmpstr );
}

function spmybpz_zbopp_write_file( $f, $d ){
$fh = fopen( $f, 'w' );
fwrite( $fh, $d, strlen( $d ) );
fflush( $fh );
fclose( $fh );
}

function spmybpz_bottom_trash_posts( $post_id ){
global $id, $authordata, $currentday, $currentmonth, $page, $pages, $multipage, $more, $numpages, $post;
echo '<br>Deleting post in bottom of post data';
//$spmybpz_datadir = dirname(__FILE__) ;
//$spmybpz_string_position = strpos( $spmybpz_datadir , 'zbottomofpostpage');
//$spmybpz_datadiralt = substr_replace( $spmybpz_datadir , 'zbottomofpostpagedata' , $spmybpz_string_position  );
//$spmybpz_setup_file = $spmybpz_datadiralt ."/setup.txt";
//$spmybpz_published_posts_file = $spmybpz_datadiralt ."/publishedposts.txt";
//$spmybpz_published_pages_file = $spmybpz_datadiralt ."/publishedpages.txt";

$spmybpz_plugins_url = dirname(__FILE__);
$spmybpz_plugins_namearray = explode( '/', $spmybpz_plugins_url );
$spmybpz_plugins_namearraysz = count( $spmybpz_plugins_namearray );
$spmybpz_plugins_name = $spmybpz_plugins_namearray[ $spmybpz_plugins_namearraysz -1 ];
$spmybpz_plugins_url = plugins_url().'/'.$spmybpz_plugins_name;

$spmybpz_plugins_urldata = str_replace( '/wp-content/plugins', '/wp-content/uploads', plugins_url()).'/'.$spmybpz_plugins_name;
$spmybpz_plugins_datadir = str_replace( '/wp-content/plugins', '/wp-content/uploads', dirname(__FILE__));

$spmybpz_datadiralt = $spmybpz_plugins_datadir;
$spmybpz_setup_file = $spmybpz_datadiralt ."/setup.txt";
$spmybpz_published_posts_file = $spmybpz_datadiralt ."/publishedposts.txt";
$spmybpz_published_pages_file = $spmybpz_datadiralt ."/publishedpages.txt";
$spmybpz_setup_seopost_file = $spmybpz_datadiralt ."/seopost.txt";
$spmybpz_setup_seopage_file = $spmybpz_datadiralt ."/seopage.txt";
$spmybpz_post_scroll_data_file = $spmybpz_datadiralt ."/scrollposts.txt";
$spmybpz_page_scroll_data_file = $spmybpz_datadiralt ."/scrollpages.txt";
$spmybpz_msg_array_file = $spmybpz_datadiralt ."/postmgsarray.txt";
$spmybpz_tmpstr_html_array_file = $spmybpz_datadiralt ."/postmgshtmlarray.txt";
$spmybpz_page_msg_array_file = $spmybpz_datadiralt ."/pagemgsarray.txt";
$spmybpz_tmpstr_page_html_array_file = $spmybpz_datadiralt ."/pagemgshtmlarray.txt";

//posts settings

if( !file_exists( $spmybpz_datadiralt ) ) {
echo '<br>dpabottomofpostpage data directory not set up. Go to WordPress control panel / Dashboard then to Settings > dpabottomofpostpageMenu menu and adjust settings and save.';
return;
}


//check number of posts
$spmybpz_bottom_post_count = wp_count_posts();
$iz = 0 ;
foreach ($spmybpz_bottom_post_count as $key => $value) {
	$spmybpz_bottom_post_nos[$key] = $value ;
	$iz++;
}	

$spmybpz_bottom_post_count = NULL;
unset( $spmybpz_bottom_post_count ); //clear memory

$args = array(  'post_status' => 'publish', 'posts_per_page' => $spmybpz_bottom_post_nos['publish'] );
$spmybpz_postslist = get_posts( $args );
$spmybpz_postslist_sz = count( $spmybpz_postslist );
foreach( $spmybpz_postslist as $post ) {
       setup_postdata($post); 
	   $spmybpz_file_listPM = get_permalink();
	   $spmybpz_pos = strrpos( $spmybpz_file_listPM, '/' );
	   $spmybpz_myfilename = substr($spmybpz_file_listPM, 0, $spmybpz_pos );
	   $spmybpz_pos = strrpos( $spmybpz_myfilename, '/' );
	   $spmybpz_myfilename = substr($spmybpz_myfilename, ($spmybpz_pos+1) );
	   $spmybpz_file_listPM = $spmybpz_myfilename ;
		$spmybpz_pplist[$spmybpz_file_listPM] = 'Checked';
	}
wp_reset_postdata();	
//save table
$spmybpz_tmpstr = serialize( $spmybpz_pplist ) ;
spmybpz_zbopp_write_file( $spmybpz_published_posts_file, $spmybpz_tmpstr );
//}

}

function spmybpz_bottom_saved_posts( $post_id ){
global $id, $authordata, $currentday, $currentmonth, $page, $pages, $multipage, $more, $numpages, $post;

$spmybpz_plugins_url = dirname(__FILE__);
$spmybpz_plugins_namearray = explode( '/', $spmybpz_plugins_url );
$spmybpz_plugins_namearraysz = count( $spmybpz_plugins_namearray );
$spmybpz_plugins_name = $spmybpz_plugins_namearray[ $spmybpz_plugins_namearraysz -1 ];
$spmybpz_plugins_url = plugins_url().'/'.$spmybpz_plugins_name;

$spmybpz_plugins_urldata = str_replace( '/wp-content/plugins', '/wp-content/uploads', plugins_url()).'/'.$spmybpz_plugins_name;
$spmybpz_plugins_datadir = str_replace( '/wp-content/plugins', '/wp-content/uploads', dirname(__FILE__));

$spmybpz_datadiralt = $spmybpz_plugins_datadir;
$spmybpz_setup_file = $spmybpz_datadiralt ."/setup.txt";
$spmybpz_published_posts_file = $spmybpz_datadiralt ."/publishedposts.txt";
$spmybpz_published_pages_file = $spmybpz_datadiralt ."/publishedpages.txt";
$spmybpz_setup_seopost_file = $spmybpz_datadiralt ."/seopost.txt";
$spmybpz_setup_seopage_file = $spmybpz_datadiralt ."/seopage.txt";
$spmybpz_post_scroll_data_file = $spmybpz_datadiralt ."/scrollposts.txt";
$spmybpz_page_scroll_data_file = $spmybpz_datadiralt ."/scrollpages.txt";
$spmybpz_msg_array_file = $spmybpz_datadiralt ."/postmgsarray.txt";
$spmybpz_tmpstr_html_array_file = $spmybpz_datadiralt ."/postmgshtmlarray.txt";
$spmybpz_page_msg_array_file = $spmybpz_datadiralt ."/pagemgsarray.txt";
$spmybpz_tmpstr_page_html_array_file = $spmybpz_datadiralt ."/pagemgshtmlarray.txt";

//posts settings


if( !file_exists( $spmybpz_datadiralt ) ) {
echo '<br>dpabottomofpostpage data directory not set up. Go to WordPress control panel / Dashboard then to Settings > dpabottomofpostpageMenu menu and adjust settings and save.';
return;
}

if( file_exists( $spmybpz_published_posts_file ) && filesize( $spmybpz_published_posts_file ) > 6 ){
$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_published_posts_file );
$spmybpz_pplist = unserialize( $spmybpz_tmpstr );
}

//check number of posts
$spmybpz_bottom_post_count = wp_count_posts();
$iz = 0 ;
foreach ($spmybpz_bottom_post_count as $key => $value) {
	$spmybpz_bottom_post_nos[$key] = $value ;
	$iz++;
}	

$spmybpz_bottom_post_count = NULL;
unset( $spmybpz_bottom_post_count ); //clear memory

$args = array(  'post_status' => 'publish', 'posts_per_page' => $spmybpz_bottom_post_nos['publish'] );
$spmybpz_postslist = get_posts( $args );
$spmybpz_postslist_sz = count( $spmybpz_postslist );
foreach( $spmybpz_postslist as $post ) {
       setup_postdata($post); 
	   $spmybpz_file_listPM = get_permalink();
	   $spmybpz_pos = strrpos( $spmybpz_file_listPM, '/' );
	   $spmybpz_myfilename = substr($spmybpz_file_listPM, 0, $spmybpz_pos );
	   $spmybpz_pos = strrpos( $spmybpz_myfilename, '/' );
	   $spmybpz_myfilename = substr($spmybpz_myfilename, ($spmybpz_pos+1) );
	   $spmybpz_file_listPM = $spmybpz_myfilename ;
		$spmybpz_pplist[$spmybpz_file_listPM] = 'Checked';
	}
wp_reset_postdata();	
//save table
$spmybpz_tmpstr = serialize( $spmybpz_pplist ) ;
spmybpz_zbopp_write_file( $spmybpz_published_posts_file, $spmybpz_tmpstr );
//}


//pages settings
if( file_exists( $spmybpz_published_pages_file ) && filesize( $spmybpz_published_pages_file ) > 6 ){
$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_published_pages_file );
$spmybpz_ppplist = '';
$spmybpz_ppplist = unserialize( $spmybpz_tmpstr );
}
$args = array(  'post_type' => 'page' );
$spmybpz_pageslist = get_pages( $args );
$spmybpz_pageslist_sz = count( $spmybpz_pageslist );

$spmybpz_i =0;
$spmybpz_imax = 0 ;
if( count($spmybpz_ppplist) != $spmybpz_pageslist_sz ){
$spmybpz_file_listPP ='';
unset( $spmybpz_file_listPP );
foreach( $spmybpz_pageslist as $key => $post ) { //get the permalink and strip '/'
       setup_postdata($post); 
	   $spmybpz_file_listPP[ $spmybpz_i ] = get_permalink();
//	   echo '<br>Y. count : '.$spmybpz_i.'  : '.$spmybpz_file_list[ $spmybpz_i ].'  ';
	   $spmybpz_pos = strrpos( $spmybpz_file_listPP[ $spmybpz_i ], '/' );
	   $spmybpz_myfilename = substr($spmybpz_file_listPP[ $spmybpz_i ], 0, $spmybpz_pos );
	   $spmybpz_pos = strrpos( $spmybpz_myfilename, '/' );
	   $spmybpz_myfilename = substr($spmybpz_myfilename, ($spmybpz_pos+1) );
	   $spmybpz_file_listPP[ $spmybpz_i ] = $spmybpz_myfilename ;
	   $spmybpz_i++;
	  }
	$spmybpz_imax = $spmybpz_i;
	$spmybpz_file_listX = NULL;
	unset( $spmybpz_file_listX );	
	$spmybpz_file_listX = $spmybpz_ppplist; 
	$spmybpz_ppplist = NULL;
	unset( $spmybpz_ppplist );
	
	for( $spmybpz_i=0; $spmybpz_i<$spmybpz_imax; $spmybpz_i++){
	if( !isset( $spmybpz_file_listX[ $spmybpz_file_listPP[ $spmybpz_i ] ] ) ) { 
		$spmybpz_ppplist[ $spmybpz_file_listPP[ $spmybpz_i ] ] = 'Checked';
		} else {
		$spmybpz_ppplist[ $spmybpz_file_listPP[ $spmybpz_i ] ]= $spmybpz_file_listX[ $spmybpz_file_listPP[ $spmybpz_i ] ];
			}
	}
wp_reset_postdata();
//save table
$spmybpz_tmpstr = serialize( $spmybpz_ppplist ) ;
spmybpz_zbopp_write_file( $spmybpz_published_pages_file, $spmybpz_tmpstr );
}

$spmybpz_file_listX = NULL;
unset( $spmybpz_file_listX );	
$spmybpz_ppplist = NULL;
unset( $spmybpz_ppplist );
$spmybpz_pplist =NULL;
unset( $spmybpz_pplist );
$spmybpz_file_listPP = NULL;
unset( $spmybpz_file_listPP );
$spmybpz_file_list = NULL;
unset( $spmybpz_file_list );
$spmybpz_postslist = NULL;
unset( $spmybpz_postslist );
$spmybpz_pageslist = NULL;
unset( $spmybpz_pageslist );
}



//declare the function
if( !function_exists( 'dpabottomofpostpageEnd' )){
	function dpabottomofpostpageEnd($content){
global $id, $authordata, $currentday, $currentmonth, $page, $pages, $multipage, $more, $numpages, $post;	


$spmybpz_plugins_url = dirname(__FILE__);
$spmybpz_plugins_namearray = explode( '/', $spmybpz_plugins_url );
$spmybpz_plugins_namearraysz = count( $spmybpz_plugins_namearray );
$spmybpz_plugins_name = $spmybpz_plugins_namearray[ $spmybpz_plugins_namearraysz -1 ];
$spmybpz_plugins_url = plugins_url().'/'.$spmybpz_plugins_name;

$spmybpz_plugins_urldata = str_replace( '/wp-content/plugins', '/wp-content/uploads', plugins_url()).'/'.$spmybpz_plugins_name;
$spmybpz_plugins_datadir = str_replace( '/wp-content/plugins', '/wp-content/uploads', dirname(__FILE__));

$spmybpz_datadiralt = $spmybpz_plugins_datadir;
$spmybpz_setup_file = $spmybpz_datadiralt ."/setup.txt";
$spmybpz_published_posts_file = $spmybpz_datadiralt ."/publishedposts.txt";
$spmybpz_published_pages_file = $spmybpz_datadiralt ."/publishedpages.txt";
$spmybpz_setup_seopost_file = $spmybpz_datadiralt ."/seopost.txt";
$spmybpz_setup_seopage_file = $spmybpz_datadiralt ."/seopage.txt";
$spmybpz_post_scroll_data_file = $spmybpz_datadiralt ."/scrollposts.txt";
$spmybpz_page_scroll_data_file = $spmybpz_datadiralt ."/scrollpages.txt";
$spmybpz_msg_array_file = $spmybpz_datadiralt ."/postmgsarray.txt";
$spmybpz_tmpstr_html_array_file = $spmybpz_datadiralt ."/postmgshtmlarray.txt";
$spmybpz_page_msg_array_file = $spmybpz_datadiralt ."/pagemgsarray.txt";
$spmybpz_tmpstr_page_html_array_file = $spmybpz_datadiralt ."/pagemgshtmlarray.txt";

if( !file_exists( $spmybpz_datadiralt ) ) {
echo '<br>dpabottomofpostpage data directory not set up. Go to WordPress control panel / Dashboard then to Settings > dpabottomofpostpageMenu menu and adjust settings and save.';
return;
}

$spmybpz_tmpstr = '';
$spmybpz_counter = 0;
$spmybpz_page_counter = 0;
$spmybpz_msg  = '';
unset( $spmybpz_msg );
$spmybpz_filename = '';
unset( $spmybpz_filename );
$spmybpz_page_msg = '';
unset( $spmybpz_page_msg );
$spmybpz_page_filename = '';
unset( $spmybpz_page_filename );

clearstatcache();

//if the setup file exists go read the contents
if( file_exists( $spmybpz_setup_file ) ) {
$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_setup_file );
}

if( strlen( $spmybpz_tmpstr ) > 2 ){
$spmybpz_data_str = unserialize( $spmybpz_tmpstr);
$spmybpz_counter = $spmybpz_data_str[0];
$spmybpz_page_counter = $spmybpz_data_str[1];
$spmybpz_posts = $spmybpz_data_str[2] ;
$spmybpz_pages = $spmybpz_data_str[3] ;
$spmybpz_bottom = $spmybpz_data_str[4] ;
$spmybpz_ranking = $spmybpz_data_str[5] ;
$spmybpz_java = $spmybpz_data_str[6] ;
}

if( $spmybpz_bottom == 'End' ) { //message to be placed at end if not dont execute to save CPU usage

$spmybpz_pplistflag = 'NoFile';
if( file_exists( $spmybpz_published_posts_file ) && filesize( $spmybpz_published_posts_file ) > 6 ){
$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_published_posts_file );
$spmybpz_pplist = unserialize( $spmybpz_tmpstr );

$spmybpz_pplistflag = 'FileExist';
}
//pages settings
$spmybpz_ppplistflag = 'NoFile';
if( file_exists( $spmybpz_published_pages_file ) && filesize( $spmybpz_published_pages_file ) > 6 ){
$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_published_pages_file );
$spmybpz_ppplist = '';
$spmybpz_ppplist = unserialize( $spmybpz_tmpstr );
$spmybpz_ppplistflag = 'FileExist';
}

for( $spmybpz_i=0; $spmybpz_i<$spmybpz_page_counter; $spmybpz_i++){
$spmybpz_page_msg[ $spmybpz_i ] = '';
$spmybpz_page_filename[ $spmybpz_i ] = $spmybpz_datadiralt .'/mybotpagemsg'.$spmybpz_i.'.txt';
$spmybpz_page_filename_html[ $spmybpz_i ] = $spmybpz_datadiralt .'/seopagemsg'.$spmybpz_i.'.html';
//echo '<br>A. cnt: '.$spmybpz_i.'  filename: '.$spmybpz_page_filename_html[ $spmybpz_i ].'  ';
}


//$spmybpz_permalink = get_permalink();
//echo '<br>permalink : '.$spmybpz_permalink.' ';
//$spmybpz_tmpstrx = '';
//echo '<br>is_single(): '.is_single().' is_archive(): '.is_archive().' is_category(): '.is_category().' is_home(): '.is_home().' $spmybpz_posts: '.$spmybpz_posts.' $spmybpz_counter: '.$spmybpz_counter.' ';
$spmybpz_tmpstrx = '';
wp_reset_query();

	if( (is_single() || is_archive()  || is_category() || is_home()) && $spmybpz_posts == 'DISPLAY' && $spmybpz_counter > 0)  {
		$spmybpz_permalink = get_permalink();
//		echo '<br>1. permalink: '.$spmybpz_permalink.' ';
		$spmybpz_pos = strrpos( $spmybpz_permalink, '/' );
	   $spmybpz_myfilename = substr($spmybpz_permalink, 0, $spmybpz_pos );
	   $spmybpz_pos = strrpos( $spmybpz_myfilename, '/' );
	   $spmybpz_permalinkfilename = substr($spmybpz_myfilename, ($spmybpz_pos+1) );

	   if( isset($spmybpz_pplist[$spmybpz_permalinkfilename]) && $spmybpz_pplist[$spmybpz_permalinkfilename] == 'Checked' ) {	   
		//if something to be displayed the get files and display
		//initialise variables

		//check if message Affects SEO
		if( file_exists( $spmybpz_setup_seopost_file ) ) {
		//initialise variables
			$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_setup_seopost_file );
			$spmybpz_post_SEO = unserialize( $spmybpz_tmpstr);
			}
		//for( $spmybpz_i=0; $spmybpz_i<$spmybpz_counter; $spmybpz_i++){
		//	$spmybpz_msg[ $spmybpz_i ] = '';

		//	$spmybpz_filename[ $spmybpz_i ] = $spmybpz_datadiralt .'/mybotmsg'.$spmybpz_i.'.txt';
		//	$spmybpz_filename_html[ $spmybpz_i ] = $spmybpz_datadiralt .'/seopostmsg'.$spmybpz_i.'.html';			
		//	}
		
		//new version 2015/08/17 uses array and not files as in above
		//read new post message array
		if( file_exists( $spmybpz_msg_array_file ) ){
			$spmybpz_msg_array = unserialize( spmybpz_zbopp_read_file( $spmybpz_msg_array_file ));
			}
		//read new post message array
		if( file_exists( $spmybpz_tmpstr_html_array_file ) ){
			$spmybpz_tmpstr_html_array = unserialize( spmybpz_zbopp_read_file( $spmybpz_tmpstr_html_array_file ));
			}
	
		
		for( $spmybpz_i=0; $spmybpz_i<$spmybpz_counter; $spmybpz_i++){ //don't overload CPU, run this code here
		if( $spmybpz_post_SEO[$spmybpz_i][0] == 'SEO' ){
		//if( file_exists( $spmybpz_filename_html[ $spmybpz_i ] ) && filesize( $spmybpz_filename_html[ $spmybpz_i ] ) > 0 ){
		//		$spmybpz_msg[ $spmybpz_i ] = base64_decode( $spmybpz_post_SEO[$spmybpz_i][3] ) ;
		//	}
		$spmybpz_msg[ $spmybpz_i ] = base64_decode( $spmybpz_tmpstr_html_array[$spmybpz_i] ) ;
		
		} else {
		//if( file_exists( $spmybpz_filename[ $spmybpz_i ] ) && filesize( $spmybpz_filename[ $spmybpz_i ] ) > 0 ){
		//		$spmybpz_msg[ $spmybpz_i ] = spmybpz_zbopp_read_file( $spmybpz_filename[ $spmybpz_i] );
		//	}
		$spmybpz_msg[ $spmybpz_i ] = base64_decode( $spmybpz_msg_array[$spmybpz_i] ) ;
		}
		//ensure not infected code
		if( isset( $spmybpz_msg[ $spmybpz_i ] ) ){
			$spmybpz_tmpstr =  stripslashes( trim( $spmybpz_msg[ $spmybpz_i ] ) );
			if( $spmybpz_java != 'Allow' ){ //added 2015/08/25 to allow javascript for certain themes
			$spmybpz_pos = strpos( $spmybpz_tmpstr , '<?' );
			if( $spmybpz_pos !== false ){
				$spmybpz_tmpstr = str_replace( '<?', '',  $spmybpz_tmpstr );
				}
			$spmybpz_pos = strpos( strtolower($spmybpz_tmpstr) , 'javascript:' );
			if( $spmybpz_pos !== false ){
				$spmybpz_tmpstr = str_replace( 'javascript:', '', strtolower( $spmybpz_tmpstr ) );
			}
			}
			if( $spmybpz_post_SEO[$spmybpz_i][8] == 'ShortCode') { //20150827 if the message is a shortcode
				$spmybpz_tmpstr = do_shortcode($spmybpz_tmpstr);
			}
			$spmybpz_msg[ $spmybpz_i ] = $spmybpz_tmpstr;
			}	
		}
 		$spmybpz_tmpstrx = '';  //display
		for( $spmybpz_i=0; $spmybpz_i<$spmybpz_counter; $spmybpz_i++){	
			//is_single() || is_archive()  || is_category() || is_home()
			if( is_single() ) {
				$spmybpz_tmpstrx = $spmybpz_tmpstrx.$spmybpz_msg[ $spmybpz_i ];	
			} else if( is_home() && $spmybpz_post_SEO[$spmybpz_i][4] == 'HOME'  ) {
				$spmybpz_tmpstrx = $spmybpz_tmpstrx.$spmybpz_msg[ $spmybpz_i ];	
			} 
			else if( (is_category() ) && $spmybpz_post_SEO[$spmybpz_i][5] == 'CAT'  ) {
				$spmybpz_tmpstrx = $spmybpz_tmpstrx.$spmybpz_msg[ $spmybpz_i ];	
			} else if( (is_archive() && !is_category() ) && $spmybpz_post_SEO[$spmybpz_i][6] == 'ARC'  ) {
				$spmybpz_tmpstrx = $spmybpz_tmpstrx.$spmybpz_msg[ $spmybpz_i ];		
			}
		}
			
		} 	
	} 



	if( (is_page()  && $spmybpz_pages == 'DISPLAY' && $spmybpz_page_counter > 0) ) { 
		//if something to be displayed the get files and display
		//initialise variables
		$spmybpz_permalink = get_permalink();
		$spmybpz_pos = strrpos( $spmybpz_permalink, '/' );
	   $spmybpz_myfilename = substr($spmybpz_permalink, 0, $spmybpz_pos );
	   $spmybpz_pos = strrpos( $spmybpz_myfilename, '/' );
	   $spmybpz_permalinkfilename = substr($spmybpz_myfilename, ($spmybpz_pos+1) );
		if( $spmybpz_ppplist[$spmybpz_permalinkfilename] == 'Checked' ) {
		//check is message Affects SEO
		if( file_exists( $spmybpz_setup_seopage_file ) ) {
			$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_setup_seopage_file );
			$spmybpz_page_SEO = unserialize( $spmybpz_tmpstr);
			}		
		//for( $spmybpz_i=0; $spmybpz_i<$spmybpz_page_counter; $spmybpz_i++){
		//	$spmybpz_page_msg[ $spmybpz_i ] = '';
		//	$spmybpz_page_filename[ $spmybpz_i ] = $spmybpz_datadiralt .'/mybotpagemsg'.$spmybpz_i.'.txt';
		//	$spmybpz_page_filename_html[ $spmybpz_i ] = $spmybpz_datadiralt .'/seopagemsg'.$spmybpz_i.'.html';			
		//	}
		
		//new version 2015/08/17 uses array and not files as in above		
		//read new page message array
		if( file_exists( $spmybpz_page_msg_array_file ) ){
			$spmybpz_page_msg_array = unserialize( spmybpz_zbopp_read_file( $spmybpz_page_msg_array_file ));
			}	
		//read new page message array
		if( file_exists( $spmybpz_tmpstr_page_html_array_file ) ){
		$spmybpz_tmpstr_page_html_array = unserialize( spmybpz_zbopp_read_file( $spmybpz_tmpstr_page_html_array_file ));
			}		
		for( $spmybpz_i=0; $spmybpz_i<$spmybpz_page_counter; $spmybpz_i++){ //don't overload CPU, run this code here

		if( $spmybpz_page_SEO[$spmybpz_i][0] == 'NOT SEO' ){
		//if( file_exists( $spmybpz_page_filename[ $spmybpz_i ] ) && filesize( $spmybpz_page_filename[ $spmybpz_i ] ) > 0 ){
		//	$spmybpz_page_msg[ $spmybpz_i ] = spmybpz_zbopp_read_file( $spmybpz_page_filename[ $spmybpz_i] );
		//	}
		$spmybpz_page_msg[ $spmybpz_i ] = base64_decode( $spmybpz_page_msg_array[$spmybpz_i] ) ;
		}	else if( $spmybpz_page_SEO[$spmybpz_i][0] == 'SEO' ){
				//if( file_exists( $spmybpz_page_filename_html[ $spmybpz_i ] ) && filesize( $spmybpz_page_filename_html[ $spmybpz_i ] ) > 0 ){
				//	$spmybpz_page_msg[ $spmybpz_i ] = base64_decode( $spmybpz_page_SEO[$spmybpz_i][3] ) ;
				//	}
			$spmybpz_page_msg[ $spmybpz_i ] = base64_decode( $spmybpz_tmpstr_page_html_array[$spmybpz_i] ) ;	
			}
		//ensure not infected code
		if( isset( $spmybpz_page_msg[ $spmybpz_i ] ) ) {
			$spmybpz_tmpstr =  stripslashes( trim( $spmybpz_page_msg[ $spmybpz_i ] ) );
			if( $spmybpz_java != 'Allow' ){ //added 2015/08/25 to allow javascript for certain themes
			$spmybpz_pos = strpos( $spmybpz_tmpstr , '<?' );
			if( $spmybpz_pos !== false ){
				$spmybpz_tmpstr = str_replace( '<?', '',  $spmybpz_tmpstr );
				}
			$spmybpz_pos = strpos( strtolower($spmybpz_tmpstr) , 'javascript:' );
			if( $spmybpz_pos !== false ){
				$spmybpz_tmpstr = str_replace( 'javascript:', '', strtolower( $spmybpz_tmpstr ) );
			}
			}
			if( $spmybpz_page_SEO[$spmybpz_i][8] == 'ShortCode') { //20150827 if the message is a shortcode
				$spmybpz_tmpstr = do_shortcode($spmybpz_tmpstr);
			}			
			$spmybpz_page_msg[ $spmybpz_i ] = $spmybpz_tmpstr;
			}			
		}
		$spmybpz_tmpstrx = ''; //display
		for( $spmybpz_i=0; $spmybpz_i<$spmybpz_page_counter; $spmybpz_i++){	
			$spmybpz_tmpstrx = $spmybpz_tmpstrx.$spmybpz_page_msg[ $spmybpz_i ];			
			} 
		}
	} 	
if( $spmybpz_bottom == 'End' ) {
	echo stripslashes($spmybpz_tmpstrx); 
	}
	} //end of message at end
}
}



//declare the function
if( !function_exists( 'dpabottomofpostpage' )){
	function dpabottomofpostpage($content){
global $id, $authordata, $currentday, $currentmonth, $page, $pages, $multipage, $more, $numpages, $post;	

//set up paths and filenames
$spmybpz_plugins_url = dirname(__FILE__);
$spmybpz_plugins_namearray = explode( '/', $spmybpz_plugins_url );
$spmybpz_plugins_namearraysz = count( $spmybpz_plugins_namearray );
$spmybpz_plugins_name = $spmybpz_plugins_namearray[ $spmybpz_plugins_namearraysz -1 ];
$spmybpz_plugins_url = plugins_url().'/'.$spmybpz_plugins_name;

$spmybpz_plugins_urldata = str_replace( '/wp-content/plugins', '/wp-content/uploads', plugins_url()).'/'.$spmybpz_plugins_name;
$spmybpz_plugins_datadir = str_replace( '/wp-content/plugins', '/wp-content/uploads', dirname(__FILE__));

$spmybpz_datadiralt = $spmybpz_plugins_datadir;
$spmybpz_setup_file = $spmybpz_datadiralt ."/setup.txt";
$spmybpz_published_posts_file = $spmybpz_datadiralt ."/publishedposts.txt";
$spmybpz_published_pages_file = $spmybpz_datadiralt ."/publishedpages.txt";
$spmybpz_setup_seopost_file = $spmybpz_datadiralt ."/seopost.txt";
$spmybpz_setup_seopage_file = $spmybpz_datadiralt ."/seopage.txt";
$spmybpz_post_scroll_data_file = $spmybpz_datadiralt ."/scrollposts.txt";
$spmybpz_page_scroll_data_file = $spmybpz_datadiralt ."/scrollpages.txt";
$spmybpz_msg_array_file = $spmybpz_datadiralt ."/postmgsarray.txt";
$spmybpz_tmpstr_html_array_file = $spmybpz_datadiralt ."/postmgshtmlarray.txt";
$spmybpz_page_msg_array_file = $spmybpz_datadiralt ."/pagemgsarray.txt";
$spmybpz_tmpstr_page_html_array_file = $spmybpz_datadiralt ."/pagemgshtmlarray.txt";


if( !file_exists( $spmybpz_datadiralt ) ) {
echo '<br>dpabottomofpostpage data directory not set up. Go to WordPress control panel / Dashboard then to Settings > dpabottomofpostpageMenu menu and adjust settings and save.';
return;
}

$spmybpz_tmpstr = '';
$spmybpz_counter = 0;
$spmybpz_page_counter = 0;
$spmybpz_msg  = '';
unset( $spmybpz_msg );
$spmybpz_filename = '';
unset( $spmybpz_filename );
$spmybpz_page_msg = '';
unset( $spmybpz_page_msg );
$spmybpz_page_filename = '';
unset( $spmybpz_page_filename );

clearstatcache();

//if the setup file exists go read the contents
if( file_exists( $spmybpz_setup_file ) ) {
$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_setup_file );
}

if( strlen( $spmybpz_tmpstr ) > 2 ){
$spmybpz_data_str = unserialize( $spmybpz_tmpstr);
$spmybpz_counter = $spmybpz_data_str[0];
$spmybpz_page_counter = $spmybpz_data_str[1];
$spmybpz_posts = $spmybpz_data_str[2] ;
$spmybpz_pages = $spmybpz_data_str[3] ;
$spmybpz_bottom = $spmybpz_data_str[4] ;
$spmybpz_ranking = $spmybpz_data_str[5] ;
$spmybpz_java = $spmybpz_data_str[6] ;
}

if( $spmybpz_bottom == 'Bottom' ) { //if message is to be displayed at bottom if not don't execute to save CPU usage

$spmybpz_pplistflag = 'NoFile';
if( file_exists( $spmybpz_published_posts_file ) && filesize( $spmybpz_published_posts_file ) > 6 ){
$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_published_posts_file );
$spmybpz_pplist = unserialize( $spmybpz_tmpstr );

$spmybpz_pplistflag = 'FileExist';
}
//pages settings
$spmybpz_ppplistflag = 'NoFile';
if( file_exists( $spmybpz_published_pages_file ) && filesize( $spmybpz_published_pages_file ) > 6 ){
$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_published_pages_file );
$spmybpz_ppplist = '';
$spmybpz_ppplist = unserialize( $spmybpz_tmpstr );
$spmybpz_ppplistflag = 'FileExist';
}

for( $spmybpz_i=0; $spmybpz_i<$spmybpz_page_counter; $spmybpz_i++){
$spmybpz_page_msg[ $spmybpz_i ] = '';
//$spmybpz_page_filename[ $spmybpz_i ] = dirname(__FILE__) .'/mybotpagemsg'.$spmybpz_i.'.txt';
//$spmybpz_page_filename_html[ $spmybpz_i ] = dirname(__FILE__) .'/seopagemsg'.$spmybpz_i.'.html';
$spmybpz_page_filename[ $spmybpz_i ] = $spmybpz_datadiralt .'/mybotpagemsg'.$spmybpz_i.'.txt';
$spmybpz_page_filename_html[ $spmybpz_i ] = $spmybpz_datadiralt .'/seopagemsg'.$spmybpz_i.'.html';
//echo '<br>A. cnt: '.$spmybpz_i.'  filename: '.$spmybpz_page_filename_html[ $spmybpz_i ].'  ';
}


//$spmybpz_permalink = get_permalink();
//echo '<br>permalink : '.$spmybpz_permalink.' ';
//$spmybpz_tmpstrx = '';
//echo '<br>is_single(): '.is_single().' is_archive(): '.is_archive().' is_category(): '.is_category().' is_home(): '.is_home().' $spmybpz_posts: '.$spmybpz_posts.' $spmybpz_counter: '.$spmybpz_counter.' ';
$spmybpz_tmpstrx = '';
wp_reset_query();

	if( (is_single() || is_archive()  || is_category() || is_home()) && $spmybpz_posts == 'DISPLAY' && $spmybpz_counter > 0)  {
		$spmybpz_permalink = get_permalink();
//		echo '<br>1. permalink: '.$spmybpz_permalink.' ';
		$spmybpz_pos = strrpos( $spmybpz_permalink, '/' );
	   $spmybpz_myfilename = substr($spmybpz_permalink, 0, $spmybpz_pos );
	   $spmybpz_pos = strrpos( $spmybpz_myfilename, '/' );
	   $spmybpz_permalinkfilename = substr($spmybpz_myfilename, ($spmybpz_pos+1) );

	   if( isset($spmybpz_pplist[$spmybpz_permalinkfilename]) && $spmybpz_pplist[$spmybpz_permalinkfilename] == 'Checked' ) {	   
		//if something to be displayed the get files and display
		//initialise variables

		//check if message Affects SEO
		if( file_exists( $spmybpz_setup_seopost_file ) ) {
		//initialise variables
			$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_setup_seopost_file );
			$spmybpz_post_SEO = unserialize( $spmybpz_tmpstr);
			}
		//for( $spmybpz_i=0; $spmybpz_i<$spmybpz_counter; $spmybpz_i++){
		//	$spmybpz_msg[ $spmybpz_i ] = '';
		//	$spmybpz_filename[ $spmybpz_i ] = $spmybpz_datadiralt .'/mybotmsg'.$spmybpz_i.'.txt';
		//	$spmybpz_filename_html[ $spmybpz_i ] = $spmybpz_datadiralt .'/seopostmsg'.$spmybpz_i.'.html';			
		//	}
		
		//new version 2015/08/17 uses array and not files as in above
		//read new post message array
		if( file_exists( $spmybpz_msg_array_file ) ){
			$spmybpz_msg_array = unserialize( spmybpz_zbopp_read_file( $spmybpz_msg_array_file ));
			}
		//read new post message array
		if( file_exists( $spmybpz_tmpstr_html_array_file ) ){
			$spmybpz_tmpstr_html_array = unserialize( spmybpz_zbopp_read_file( $spmybpz_tmpstr_html_array_file ));
			}
	
		for( $spmybpz_i=0; $spmybpz_i<$spmybpz_counter; $spmybpz_i++){ //don't overload CPU, run this code here
		if( $spmybpz_post_SEO[$spmybpz_i][0] == 'SEO' ){
		//if( file_exists( $spmybpz_filename_html[ $spmybpz_i ] ) && filesize( $spmybpz_filename_html[ $spmybpz_i ] ) > 0 ){
		//		$spmybpz_msg[ $spmybpz_i ] = base64_decode( $spmybpz_post_SEO[$spmybpz_i][3] ) ;
		//	}
		$spmybpz_msg[ $spmybpz_i ] = base64_decode( $spmybpz_tmpstr_html_array[$spmybpz_i] ) ;
		} else {
		//if( file_exists( $spmybpz_filename[ $spmybpz_i ] ) && filesize( $spmybpz_filename[ $spmybpz_i ] ) > 0 ){
		//		$spmybpz_msg[ $spmybpz_i ] = spmybpz_zbopp_read_file( $spmybpz_filename[ $spmybpz_i] );
		//	}
		$spmybpz_msg[ $spmybpz_i ] = base64_decode( $spmybpz_msg_array[$spmybpz_i] ) ;
		}
		//ensure not infected code
		if( isset( $spmybpz_msg[ $spmybpz_i ] ) ) {
			$spmybpz_tmpstr =  stripslashes( trim( $spmybpz_msg[ $spmybpz_i ] ) );
			if( $spmybpz_java != 'Allow' ){ //added 2015/08/25 to allow javascript for certain themes
			$spmybpz_pos = strpos( $spmybpz_tmpstr , '<?' );
			if( $spmybpz_pos !== false ){
				$spmybpz_tmpstr = str_replace( '<?', '',  $spmybpz_tmpstr );
				}
			$spmybpz_pos = strpos( strtolower($spmybpz_tmpstr) , 'javascript:' );
			if( $spmybpz_pos !== false ){
				$spmybpz_tmpstr = str_replace( 'javascript:', '', strtolower( $spmybpz_tmpstr ) );
			}
			}
			if( $spmybpz_post_SEO[$spmybpz_i][8] == 'ShortCode') { //20150827 if the message is a shortcode
				$spmybpz_tmpstr = do_shortcode($spmybpz_tmpstr);
			}			
			$spmybpz_msg[ $spmybpz_i ] = $spmybpz_tmpstr;
			}			
		}
 		$spmybpz_tmpstrx = '';  //display
		for( $spmybpz_i=0; $spmybpz_i<$spmybpz_counter; $spmybpz_i++){	
			//is_single() || is_archive()  || is_category() || is_home()
			if( is_single() ) {
				$spmybpz_tmpstrx = $spmybpz_tmpstrx.$spmybpz_msg[ $spmybpz_i ];	
			} else if( is_home() && $spmybpz_post_SEO[$spmybpz_i][4] == 'HOME'  ) {
				$spmybpz_tmpstrx = $spmybpz_tmpstrx.$spmybpz_msg[ $spmybpz_i ];	
			} 
			else if( (is_category() ) && $spmybpz_post_SEO[$spmybpz_i][5] == 'CAT'  ) {
				$spmybpz_tmpstrx = $spmybpz_tmpstrx.$spmybpz_msg[ $spmybpz_i ];	
			} else if( (is_archive() && !is_category() ) && $spmybpz_post_SEO[$spmybpz_i][6] == 'ARC'  ) {
				$spmybpz_tmpstrx = $spmybpz_tmpstrx.$spmybpz_msg[ $spmybpz_i ];		
			}
		}
			
		} 	
	} 



	if( (is_page()  && $spmybpz_pages == 'DISPLAY' && $spmybpz_page_counter > 0) ) { 
		//if something to be displayed the get files and display
		//initialise variables
		$spmybpz_permalink = get_permalink();
		$spmybpz_pos = strrpos( $spmybpz_permalink, '/' );
	   $spmybpz_myfilename = substr($spmybpz_permalink, 0, $spmybpz_pos );
	   $spmybpz_pos = strrpos( $spmybpz_myfilename, '/' );
	   $spmybpz_permalinkfilename = substr($spmybpz_myfilename, ($spmybpz_pos+1) );
		if( $spmybpz_ppplist[$spmybpz_permalinkfilename] == 'Checked' ) {
		//check is message Affects SEO
		if( file_exists( $spmybpz_setup_seopage_file ) ) {
			$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_setup_seopage_file );
			$spmybpz_page_SEO = unserialize( $spmybpz_tmpstr);
			}		
		//for( $spmybpz_i=0; $spmybpz_i<$spmybpz_page_counter; $spmybpz_i++){
		//	$spmybpz_page_msg[ $spmybpz_i ] = '';
		//	$spmybpz_page_filename[ $spmybpz_i ] = $spmybpz_datadiralt .'/mybotpagemsg'.$spmybpz_i.'.txt';
		//	$spmybpz_page_filename_html[ $spmybpz_i ] = $spmybpz_datadiralt .'/seopagemsg'.$spmybpz_i.'.html';			
		//	}
		
		//new version 2015/08/17 uses array and not files as in above		
		//read new page message array
		if( file_exists( $spmybpz_page_msg_array_file ) ){
			$spmybpz_page_msg_array = unserialize( spmybpz_zbopp_read_file( $spmybpz_page_msg_array_file ));
			}	
		//read new page message array
		if( file_exists( $spmybpz_tmpstr_page_html_array_file ) ){
		$spmybpz_tmpstr_page_html_array = unserialize( spmybpz_zbopp_read_file( $spmybpz_tmpstr_page_html_array_file ));
			}		
		
		for( $spmybpz_i=0; $spmybpz_i<$spmybpz_page_counter; $spmybpz_i++){ //don't overload CPU, run this code here

		if( $spmybpz_page_SEO[$spmybpz_i][0] == 'NOT SEO' ){
		//if( file_exists( $spmybpz_page_filename[ $spmybpz_i ] ) && filesize( $spmybpz_page_filename[ $spmybpz_i ] ) > 0 ){
		//	$spmybpz_page_msg[ $spmybpz_i ] = spmybpz_zbopp_read_file( $spmybpz_page_filename[ $spmybpz_i] );
		//	}
		$spmybpz_page_msg[ $spmybpz_i ] = base64_decode( $spmybpz_page_msg_array[$spmybpz_i] ) ;
		}	else if( $spmybpz_page_SEO[$spmybpz_i][0] == 'SEO' ){
		//		if( file_exists( $spmybpz_page_filename_html[ $spmybpz_i ] ) && filesize( $spmybpz_page_filename_html[ $spmybpz_i ] ) > 0 ){
		//			$spmybpz_page_msg[ $spmybpz_i ] = base64_decode( $spmybpz_page_SEO[$spmybpz_i][3] ) ;
		//			}
		$spmybpz_page_msg[ $spmybpz_i ] = base64_decode( $spmybpz_tmpstr_page_html_array[$spmybpz_i] ) ;
			}
		//ensure not infected code
		if( isset( $spmybpz_page_msg[ $spmybpz_i ] ) ) {
			$spmybpz_tmpstr =  stripslashes( trim( $spmybpz_page_msg[ $spmybpz_i ] ) );
			if( $spmybpz_java != 'Allow' ){ //added 2015/08/25 to allow javascript for certain themes
			$spmybpz_pos = strpos( $spmybpz_tmpstr , '<?' );
			if( $spmybpz_pos !== false ){
				$spmybpz_tmpstr = str_replace( '<?', '',  $spmybpz_tmpstr );
				}
			$spmybpz_pos = strpos( strtolower($spmybpz_tmpstr) , 'javascript:' );
			if( $spmybpz_pos !== false ){
				$spmybpz_tmpstr = str_replace( 'javascript:', '', strtolower( $spmybpz_tmpstr ) );
			}
			}
			if( $spmybpz_page_SEO[$spmybpz_i][8] == 'ShortCode') { //20150827 if the message is a shortcode
				$spmybpz_tmpstr = do_shortcode($spmybpz_tmpstr);
			}			
			$spmybpz_page_msg[ $spmybpz_i ] = $spmybpz_tmpstr;
			}			
		}
		$spmybpz_tmpstrx = ''; //display
		for( $spmybpz_i=0; $spmybpz_i<$spmybpz_page_counter; $spmybpz_i++){	
			$spmybpz_tmpstrx = $spmybpz_tmpstrx.$spmybpz_page_msg[ $spmybpz_i ];			
			} 
		}
	} 	
if( $spmybpz_bottom == 'Bottom' ) {
	return $content.stripslashes($spmybpz_tmpstrx);
	} else {
	//$spmypc_ppmy_xfc_str= ob_get_contents() ;
	//echo stripslashes($spmybpz_tmpstrx); 
	return $content;
	}
	} else {//end if is bottom
	return $content;
	}
}


//get settings so that add_filter can use ranking / priority
//$spmybpz_datadir = dirname(__FILE__) ;
//$spmybpz_string_position = strpos( $spmybpz_datadir , 'zbottomofpostpage');
//$spmybpz_datadiralt = substr_replace( $spmybpz_datadir , 'zbottomofpostpagedata' , $spmybpz_string_position  );
//$spmybpz_setup_file = $spmybpz_datadiralt ."/setup.txt";
//$spmybpz_published_posts_file = $spmybpz_datadiralt ."/publishedposts.txt";
//$spmybpz_published_pages_file = $spmybpz_datadiralt ."/publishedpages.txt";


$spmybpz_plugins_url = dirname(__FILE__);
$spmybpz_plugins_namearray = explode( '/', $spmybpz_plugins_url );
$spmybpz_plugins_namearraysz = count( $spmybpz_plugins_namearray );
$spmybpz_plugins_name = $spmybpz_plugins_namearray[ $spmybpz_plugins_namearraysz -1 ];
$spmybpz_plugins_url = plugins_url().'/'.$spmybpz_plugins_name;

$spmybpz_plugins_urldata = str_replace( '/wp-content/plugins', '/wp-content/uploads', plugins_url()).'/'.$spmybpz_plugins_name;
$spmybpz_plugins_datadir = str_replace( '/wp-content/plugins', '/wp-content/uploads', dirname(__FILE__));

$spmybpz_datadiralt = $spmybpz_plugins_datadir;
$spmybpz_setup_file = $spmybpz_datadiralt ."/setup.txt";
$spmybpz_published_posts_file = $spmybpz_datadiralt ."/publishedposts.txt";
$spmybpz_published_pages_file = $spmybpz_datadiralt ."/publishedpages.txt";
$spmybpz_setup_seopost_file = $spmybpz_datadiralt ."/seopost.txt";
$spmybpz_setup_seopage_file = $spmybpz_datadiralt ."/seopage.txt";
$spmybpz_post_scroll_data_file = $spmybpz_datadiralt ."/scrollposts.txt";
$spmybpz_page_scroll_data_file = $spmybpz_datadiralt ."/scrollpages.txt";





//if the setup file exists go read the contents
if( file_exists( $spmybpz_setup_file ) ) {
$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_setup_file );
if( strlen( $spmybpz_tmpstr ) > 2 ){
	$spmybpz_data_str = unserialize( $spmybpz_tmpstr);
	$spmybpz_counter = $spmybpz_data_str[0];
	$spmybpz_page_counter = $spmybpz_data_str[1];
	$spmybpz_posts = $spmybpz_data_str[2] ;
	$spmybpz_pages = $spmybpz_data_str[3] ;
	if( !isset( $spmybpz_bottom ) ){
	$spmybpz_bottom = 'Bottom' ;
	$spmybpz_data_str[4] = 'Bottom' ;
	}
	$spmybpz_bottom = $spmybpz_data_str[4] ;
	if( !isset( $spmybpz_ranking ) ){
	$spmybpz_ranking = 100 ;
	$spmybpz_data_str[5] = 100 ;
	}	
	$spmybpz_ranking = $spmybpz_data_str[5] ;
	if( !isset( $spmybpz_java ) ){
	$spmybpz_java = 'Allow' ;
	$spmybpz_data_str[6]  = 'Allow' ;
	}	
	$spmybpz_java = $spmybpz_data_str[6] ;
	}
}




if ( is_admin() ){	
	add_action( 'save_post', 'spmybpz_bottom_saved_posts' );	//update & preview = /../../autosave
	add_action( 'post_updated', 'spmybpz_bottom_saved_posts' ); //preview changes	& update posts	
	add_action( 'edit_post', 'spmybpz_bottom_saved_posts' );	//preview changes
	add_action( 'publish_post', 'spmybpz_bottom_saved_posts' );	//update post
	add_action( 'pre_post_update', 'spmybpz_bottom_saved_posts' );	//check through pre update
	add_action( 'trash_post', 'spmybpz_bottom_trash_posts' );
	if( function_exists( 'spmybpz_zbopp_actions')) {
		add_action('admin_menu', 'spmybpz_zbopp_actions');
		}
	}
	/*	add our filter function to the hook */
	
	if( isset( $spmybpz_ranking ) ){
		add_filter('the_content', 'dpabottomofpostpage', $spmybpz_ranking);	
		add_action( 'wp_footer', 'dpabottomofpostpageEnd', $spmybpz_ranking);
		} else {
		add_filter('the_content', 'dpabottomofpostpage', 200);	
		add_action( 'wp_footer', 'dpabottomofpostpageEnd', 200);
		
		}
}

?>