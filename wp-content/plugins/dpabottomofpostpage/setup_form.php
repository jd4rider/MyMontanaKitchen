<style type="text/css">
table.spmybpz_X { border:1px solid silver; border-radius: 5px;  border-collapse: collapse;  box-shadow: 0px 0px 3px 1px rgba(0, 0, 0, 0.8); color:darkred; font-family: Times Roman; font-size:16px}  
table.spmybpz_X td { padding: 1px; border: 2px solid gray; border-collapse: collapse;  background: white; color:darkblue; font-family: Times Roman; font-size:16px} 
table.spmybpz_X  th { padding: 1px; border: 2px solid gray; border-collapse: collapse; background: silver; color:darkblue; font-family: Times Roman; font-size:16px} 
table.spmybpz_myoptions { border:1px solid #901C1C; border-collapse: collapse; box-shadow: 0px 0px 3px 1px rgba(0, 0, 0, 0.8); border-radius: 5px; color:darkblue; font-family: Times Roman; font-size:14px}  
table.spmybpz_myoptions td, th {
    padding: 5px; 
}
 
div.spmybpz_mydisplay { &nbsp;
 color: #901C1C;  /*#000000; */
 font-family: Times Roman, Verdana, Arial, Helvetica, sans-serif; 
 font-size: 12px; 
 margin: 0px; 
 overflow: scroll; 
 padding: 1px; 
  border:1px solid #901C1C; 
  border-collapse: collapse; 
  border-radius: 5px; 
  box-shadow: 0px 0px 3px 1px rgba(0, 0, 0, 0.8); 
  color:darkblue; 
  font-family: Times Roman; 
  font-size:14px
 scrollbar-face-color: #cacaca; 
 scrollbar-highlight-color: #cacaca; 
 scrollbar-3dlight-color: #cacaca; 
 scrollbar-darkshadow-color: #cacaca; 
 scrollbar-shadow-color: #cacaca; 
 scrollbar-arrow-color: #000000; 
 scrollbar-track-color: #cacaca; 
 width: 820px; 
 height: 550px; 
}
</style>
<?php
defined('ABSPATH') or die("No script kiddies please!");
global $id, $authordata, $currentday, $currentmonth, $page, $pages, $multipage, $more, $numpages, $post, $_SERVER;

//define the filename of setup file;
$spmybpz_plugins_dir = dirname(__FILE__); //not url anymore
$spmybpz_plugins_namearray = explode( '/', $spmybpz_plugins_dir );
$spmybpz_plugins_namearraysz = count( $spmybpz_plugins_namearray );
$spmybpz_plugins_name = $spmybpz_plugins_namearray[ $spmybpz_plugins_namearraysz -1 ];

//get old data dir name to transfer all files to /wp-content/uploads/... dir
$spmybpz_plugins_namearray[ $spmybpz_plugins_namearraysz -1 ] = '';
$spmybpz_plugins_oldname = implode( '/', $spmybpz_plugins_namearray ) .'dpabottomofpostpagedata';
$spmybpz_plugins_datadir = str_replace( '/wp-content/plugins', '/wp-content/uploads', dirname(__FILE__));

//get url's
$spmybpz_plugins_urldata = str_replace( '/wp-content/plugins', '/wp-content/uploads', plugins_url()).'/'.$spmybpz_plugins_name;
$spmybpz_plugins_url = plugins_url().'/'.$spmybpz_plugins_name;

$spmybpz_htaccess_data = 'Options -Indexes
DirectoryIndex index.php index.html

#block hackers from these type of files #
# multiple file types
<FilesMatch ".(htaccess|htpasswd|txt|xyz|log|zip|sh)$">
 Order Allow,Deny
 Deny from all
</FilesMatch>
';


//$spmybpz_ranking = 100;

$spmybpz_samplemsg[0] = '<br><br><table><tr><td style="vertical-align: center;"><a style="text-decoration: none;" rel="author" href="https://plus.google.com/XXXXXXXXXXXXXXXXXXXX?rel=author"><img style="border: 0; width: 16px; height: 16px;" src="https://ssl.gstatic.com/images/icons/gplus-16.png" alt="" /></a></td><td><span style="color: #000080;font-size:10px;">Copyright (c) 2013 - 2014 MY COMPANY - All Rights Reserved<br>
No. 1, Main Street, MyArea, MyTown, MyState, MYCountry<br></span></td></tr></table>';

$spmybpz_samplemsg[1] = '<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=368223343225209";
  fjs.parentNode.insertBefore(js, fjs);
}(document, '."'script'".', '."'facebook-jssdk'".'));</script>

<table>
<tr><td style="vertical-align:top;">
<a name="TellAFriend"><span style="color:green;font-size:18px;">Please Tell A Friend:</span> </td></tr>
<tr><td style="vertical-align:top;">
<div class="fb-like" data-href="" data-width="300" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
<!-- Place this tag where you want the +1 button to render. -->
<div class="g-plusone" data-annotation="inline" data-width="250"></div>

<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('."'script'".'); po.type = '."'text/javascript'".'; po.async = true;
    po.src = '."'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<!-- Twitter tag button  -->".'	
    <a href="https://twitter.com/share" class="twitter-share-button" data-via="twitterapi" data-lang="en">Tweet</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

</td></tr>
</table>';

$spmybpz_samplemsg[2] = '<table>
<tr><td style="color:green;font-size:10px;">Google Ads</td><tr>
<tr><td>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- BottomOfPage -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-XXXXXXXXXXXXXXXX"
     data-ad-slot="XXXXXXXXXX"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</td></tr>
</table>';


$spmybpz_samplemsg[3] = '<table>
<tr><td style="color:green;font-size:10px;">Other Advertisements</td><tr>
<tr><td>
<img alt="Insert Ads Here" src="'.$spmybpz_plugins_url.'/advertspace.png'.'" width="728" height="90">
</td></tr>
</table>';

//set the plugin data directory is in uploads directory
$spmybpz_datadiralt = $spmybpz_plugins_datadir;

//copy old data files from '/wp-content/plugins/dpabottomofpostpagedata' directory to '/wp-content/uploads/dpabottomofpostpagedata' to follow WordPress standards
$spmybpz_setup_file_org = $spmybpz_plugins_oldname ."/setup.txt";
$spmybpz_published_posts_file_org = $spmybpz_plugins_oldname ."/publishedposts.txt";
$spmybpz_published_pages_file_org = $spmybpz_plugins_oldname ."/publishedpages.txt";
$spmybpz_setup_seopost_file_org = $spmybpz_plugins_oldname ."/seopost.txt";
$spmybpz_setup_seopage_file_org = $spmybpz_plugins_oldname ."/seopage.txt";
$spmybpz_post_scroll_data_file_org = $spmybpz_plugins_oldname ."/scrollposts.txt";
$spmybpz_page_scroll_data_file_org = $spmybpz_plugins_oldname ."/scrollpages.txt";

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

$spmybpz_htaccess_file = $spmybpz_datadiralt .'/.htaccess';
$spmybpz_plugin_htaccess_file = dirname(__FILE__) .'/.htaccess';


if( !file_exists( $spmybpz_datadiralt ) ){
//echo '<br>'.$spmybpz_datadiralt.' does not exist';
//
if( file_exists( $spmybpz_plugins_oldname ) ){
	rename( $spmybpz_plugins_oldname , $spmybpz_datadiralt );
	} else {
	mkdir( $spmybpz_datadiralt );
	}

}
//if( !file_exists( $spmybpz_htaccess_file ) ){
//	spmybpz_zbopp_write_file( $spmybpz_htaccess_file, $spmybpz_htaccess_data );
//	}
if( !file_exists( $spmybpz_plugin_htaccess_file ) ){
	spmybpz_zbopp_write_file( $spmybpz_plugin_htaccess_file, $spmybpz_htaccess_data );
	copy ($spmybpz_plugin_htaccess_file , $spmybpz_htaccess_file );
	}
$spmybpz_tmpstr = '';
$spmybpz_counter = 0;
$spmybpz_page_counter = 0;
$spmybpz_msg = '';
unset( $spmybpz_msg );
$spmybpz_filename = '';
unset( $spmybpz_filename );
$spmybpz_filename_html = '';
unset( $spmybpz_filename_html );
$spmybpz_page_msg = '';
unset( $spmybpz_page_msg );
$spmybpz_page_filename = '';
unset( $spmybpz_page_filename );
$spmybpz_page_filename = '';
unset( $spmybpz_page_filename_html );
$spmybpz_bottom_post_nos['publish'] = 0;
$spmybpz_pplist = '';
$spmybpz_ppplist = '';
$spmybpz_pageslist = '';
$spmybpz_post_offset = 0;
$spmybpz_post_SEO = '';

$spmybpz_msg_array = '';
$spmybpz_tmpstr_html_array = '';
$spmybpz_page_msg_array = '';
$spmybpz_tmpstr_page_html_array = '';

$spmybpz_postslist_sz = 0;
$spmybpz_pageslist_sz = 0;
//if the setup file exists go read the contents
//clearstatcache();
if( file_exists( $spmybpz_setup_file ) ) {
$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_setup_file );
	if( strlen( $spmybpz_tmpstr ) > 3 ){
	$spmybpz_data_str = unserialize( $spmybpz_tmpstr);
	$spmybpz_counter = $spmybpz_data_str[0];
	$spmybpz_page_counter = $spmybpz_data_str[1];
	$spmybpz_posts = $spmybpz_data_str[2];
	$spmybpz_pages = $spmybpz_data_str[3];
	if( isset( $spmybpz_data_str[4] ) ){
	$spmybpz_bottom = $spmybpz_data_str[4];
	} else {
	$spmybpz_bottom = 'Bottom';
	}
	if( isset( $spmybpz_data_str[5] ) ){
	$spmybpz_ranking = $spmybpz_data_str[5];
	} else {
	$spmybpz_ranking = 100;
	}
	if( isset( $spmybpz_data_str[6] ) ){
	$spmybpz_java = $spmybpz_data_str[6];
	} else {
	$spmybpz_java = 'Allow';
	}
	}
} else {
	$spmybpz_counter = 0; 
	$spmybpz_data_str[0] = $spmybpz_counter ; 
	$spmybpz_page_counter = 0;
	$spmybpz_data_str[1] = $spmybpz_page_counter;
	$spmybpz_posts = 'DONT';
	$spmybpz_data_str[2] = $spmybpz_posts;
	$spmybpz_pages = 'DONT';
	$spmybpz_data_str[3] = $spmybpz_pages;
	$spmybpz_bottom = 'Bottom' ;
	$spmybpz_data_str[4] = 'Bottom' ;
	$spmybpz_ranking = 100 ;
	$spmybpz_data_str[5] = 100;
	$spmybpz_java = 'Allow' ;
	$spmybpz_data_str[6] = 'Allow';
	
	$spmybpz_tmpstr = serialize( $spmybpz_data_str );	
	spmybpz_zbopp_write_file( $spmybpz_setup_file, $spmybpz_tmpstr );
}

//echo '<br>counter: '.$spmybpz_counter.'  ';

//read in which post message affects SEO and should be in iframe
if( file_exists( $spmybpz_setup_seopost_file )) {
$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_setup_seopost_file );

if( strlen( $spmybpz_tmpstr ) > 2 ){
	$spmybpz_post_SEO = unserialize( $spmybpz_tmpstr);
		$spmybpz_post_SEO_count = count( $spmybpz_post_SEO );
	for(  $spmybpz_i=0; $spmybpz_i<$spmybpz_post_SEO_count; $spmybpz_i++ ){
		$spmybpz_filename[ $spmybpz_i ] = $spmybpz_datadiralt .'/mybotmsg'.$spmybpz_i.'.txt';
		$spmybpz_filename_html[ $spmybpz_i ] = $spmybpz_datadiralt .'/seopostmsg'.$spmybpz_i.'.html';
		}
	} else {
	
for( $spmybpz_i=0; $spmybpz_i<4; $spmybpz_i++){
$spmybpz_msg[ $spmybpz_i ] = '';
$spmybpz_filename[ $spmybpz_i ] = $spmybpz_datadiralt .'/mybotmsg'.$spmybpz_i.'.txt';
$spmybpz_filename_html[ $spmybpz_i ] = $spmybpz_datadiralt .'/seopostmsg'.$spmybpz_i.'.html';
$spmybpz_post_SEO[$spmybpz_i][0] = 'NOT SEO';
$spmybpz_post_SEO[$spmybpz_i][1] = 790; //width of message
$spmybpz_post_SEO[$spmybpz_i][2] = 140; //height message
$spmybpz_post_SEO[$spmybpz_i][3] = ''; //used base encode 64 of iframe code 
$spmybpz_post_SEO[$spmybpz_i][4] = ''; //Home summany page
$spmybpz_post_SEO[$spmybpz_i][5] = ''; //Category summary page
$spmybpz_post_SEO[$spmybpz_i][6] = ''; //Archive summary page
$spmybpz_post_SEO[$spmybpz_i][7] = ''; //Title of Message - so that you will remember what it is about months later
$spmybpz_post_SEO[$spmybpz_i][8] = ''; //ShortCode setting
}
}
	
} else {
for( $spmybpz_i=0; $spmybpz_i<4; $spmybpz_i++){
$spmybpz_msg[ $spmybpz_i ] = '';
$spmybpz_filename[ $spmybpz_i ] = $spmybpz_datadiralt .'/mybotmsg'.$spmybpz_i.'.txt';
$spmybpz_filename_html[ $spmybpz_i ] = $spmybpz_datadiralt .'/seopostmsg'.$spmybpz_i.'.html';
$spmybpz_post_SEO[$spmybpz_i][0] = 'NOT SEO';
$spmybpz_post_SEO[$spmybpz_i][1] = 790; //width of message
$spmybpz_post_SEO[$spmybpz_i][2] = 140; //height message
$spmybpz_post_SEO[$spmybpz_i][3] = ''; //used base encode 64 of iframe code 
$spmybpz_post_SEO[$spmybpz_i][4] = ''; //Home summany page
$spmybpz_post_SEO[$spmybpz_i][5] = ''; //Category summary page
$spmybpz_post_SEO[$spmybpz_i][6] = ''; //Archive summary page
$spmybpz_post_SEO[$spmybpz_i][7] = ''; //Title of Message - so that you will remember what it is about months later
$spmybpz_post_SEO[$spmybpz_i][8] = ''; //ShortCode setting
}
}

//read in which page message affects SEO and should be in iframe
if( file_exists( $spmybpz_setup_seopage_file )){
$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_setup_seopage_file );
if( strlen( $spmybpz_tmpstr ) > 2 ){
	$spmybpz_page_SEO = unserialize( $spmybpz_tmpstr);
	$spmybpz_page_SEO_count = count( $spmybpz_page_SEO );
	for( $spmybpz_i=0; $spmybpz_i<$spmybpz_page_SEO_count; $spmybpz_i++){
		$spmybpz_page_filename[ $spmybpz_i ] = $spmybpz_datadiralt .'/mybotpagemsg'.$spmybpz_i.'.txt';
		$spmybpz_page_filename_html[ $spmybpz_i ] = $spmybpz_datadiralt .'/seopagemsg'.$spmybpz_i.'.html';
		}
	} else {
	for( $spmybpz_i=0; $spmybpz_i<4; $spmybpz_i++){
$spmybpz_page_msg[ $spmybpz_i ] = '';
$spmybpz_page_filename[ $spmybpz_i ] = $spmybpz_datadiralt .'/mybotpagemsg'.$spmybpz_i.'.txt';
$spmybpz_page_filename_html[ $spmybpz_i ] = $spmybpz_datadiralt .'/seopagemsg'.$spmybpz_i.'.html';
$spmybpz_page_SEO[$spmybpz_i][0] = 'NOT SEO';
$spmybpz_page_SEO[$spmybpz_i][1] = 790; //width of message
$spmybpz_page_SEO[$spmybpz_i][2] = 140; //height of message
$spmybpz_page_SEO[$spmybpz_i][3] = ''; //used base encode 64 of <iframe code >
$spmybpz_page_SEO[$spmybpz_i][4] = ''; //Home summany page
$spmybpz_page_SEO[$spmybpz_i][5] = ''; //Category summary page
$spmybpz_page_SEO[$spmybpz_i][6] = ''; //Archive summary page
$spmybpz_page_SEO[$spmybpz_i][7] = ''; //Title of Message - so that you will remember what it is months later
$spmybpz_page_SEO[$spmybpz_i][8] = ''; //ShortCode setting
}
	}
}  else {
for( $spmybpz_i=0; $spmybpz_i<4; $spmybpz_i++){
$spmybpz_page_msg[ $spmybpz_i ] = '';
$spmybpz_page_filename[ $spmybpz_i ] = $spmybpz_datadiralt .'/mybotpagemsg'.$spmybpz_i.'.txt';
$spmybpz_page_filename_html[ $spmybpz_i ] = $spmybpz_datadiralt .'/seopagemsg'.$spmybpz_i.'.html';
$spmybpz_page_SEO[$spmybpz_i][0] = 'NOT SEO';
$spmybpz_page_SEO[$spmybpz_i][1] = 790; //width of message
$spmybpz_page_SEO[$spmybpz_i][2] = 140; //height of message
$spmybpz_page_SEO[$spmybpz_i][3] = ''; //used base encode 64 of <iframe code >
$spmybpz_page_SEO[$spmybpz_i][4] = ''; //Home summany page
$spmybpz_page_SEO[$spmybpz_i][5] = ''; //Category summary page
$spmybpz_page_SEO[$spmybpz_i][6] = ''; //Archive summary page
$spmybpz_page_SEO[$spmybpz_i][7] = ''; //Title of Message - so that you will remember what it is months later
$spmybpz_post_SEO[$spmybpz_i][8] = ''; //ShortCode setting
}
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


//posts settings
$spmybpz_pplistflag = 'NoFile';
if( file_exists( $spmybpz_published_posts_file ) && filesize( $spmybpz_published_posts_file ) > 6 ){
$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_published_posts_file );
$spmybpz_pplist = unserialize( $spmybpz_tmpstr );
$spmybpz_pplistflag = 'FileExist';
}

$args = array(  'post_status' => 'publish', 'posts_per_page' => $spmybpz_bottom_post_nos['publish'] );
$spmybpz_postslist = get_posts( $args );
$spmybpz_postslist_sz = count( $spmybpz_postslist );

$spmybpz_i =0;
$spmybpz_imax = 0 ;


foreach( $spmybpz_postslist as $key => $post ) { //get the permalink and strip '/'
       setup_postdata($post); 
	   $spmybpz_file_list[ $spmybpz_i ] = get_permalink();
	   $spmybpz_pos = strrpos( $spmybpz_file_list[ $spmybpz_i ], '/' );
	   $spmybpz_myfilename = substr($spmybpz_file_list[ $spmybpz_i ], 0, $spmybpz_pos );
	   $spmybpz_pos = strrpos( $spmybpz_myfilename, '/' );
	   $spmybpz_myfilename = substr($spmybpz_myfilename, ($spmybpz_pos+1) );
	   $spmybpz_file_list[ $spmybpz_i ] = $spmybpz_myfilename ;
	   $spmybpz_i++;
	  }
	$spmybpz_imax = $spmybpz_i;
	$spmybpz_file_listX = NULL;
	unset( $spmybpz_file_listX );	
	$spmybpz_file_listX = $spmybpz_pplist; 
	$spmybpz_pplist = NULL;
	unset( $spmybpz_pplist );
	
	for( $spmybpz_i=0; $spmybpz_i<$spmybpz_imax; $spmybpz_i++){
	if( !isset( $spmybpz_file_listX[ $spmybpz_file_list[ $spmybpz_i ] ] ) ) { 
		$spmybpz_pplist[ $spmybpz_file_list[ $spmybpz_i ] ] = 'Checked';
		} else {
		$spmybpz_pplist[ $spmybpz_file_list[ $spmybpz_i ] ]= $spmybpz_file_listX[ $spmybpz_file_list[ $spmybpz_i ] ];
			}
	}
wp_reset_postdata();
//save table
$spmybpz_tmpstr = serialize( $spmybpz_pplist ) ;
spmybpz_zbopp_write_file( $spmybpz_published_posts_file, $spmybpz_tmpstr );



//pages settings
$spmybpz_ppplistflag = 'NoFile';
if( file_exists( $spmybpz_published_pages_file ) && filesize( $spmybpz_published_pages_file ) > 6 ){
$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_published_pages_file );
$spmybpz_ppplist = '';
$spmybpz_ppplist = unserialize( $spmybpz_tmpstr );
$spmybpz_ppplistflag = 'FileExist';
}
$args = array(  'post_type' => 'page' );
$spmybpz_pageslist = get_pages( $args );
$spmybpz_pageslist_sz = count( $spmybpz_pageslist );

$spmybpz_i =0;
$spmybpz_imax = 0 ;

$spmybpz_file_listPP ='';
unset( $spmybpz_file_listPP );
foreach( $spmybpz_pageslist as $key => $post ) { //get the permalink and strip '/'
       setup_postdata($post); 
	   $spmybpz_file_listPP[ $spmybpz_i ] = get_permalink();
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

/*********************************All $_POST******************************************************/

if( isset( $_POST['spmy_Save_Settings'] )  ){
if( $_POST['spmy_Save_Settings'] == 'Save All Settings' ) {

//if( isset( $_POST['spmy_diapla_all'] )  &&  $_POST['spmy_diapla_all'] == 'Display On All Posts' ){
	$spmybpz_maxi = count( $spmybpz_pplist );
	foreach( $spmybpz_pplist as $key => &$value ){
		$spmybpz_pplist[$key] = 'Checked';
	}
	$spmybpz_tmpstr = serialize( $spmybpz_pplist );	
	spmybpz_zbopp_write_file( $spmybpz_published_posts_file, $spmybpz_tmpstr );
//}


//if( isset( $_POST['spmy_check_posts'] )  &&  $_POST['spmy_check_posts'] == 'Change Post Display' ){
	$spmybpz_maxi = count( $spmybpz_pplist );
	foreach( $spmybpz_pplist as $key => &$value ){
		if( isset($_POST['spmy_input_pplist'][$key]) && $_POST['spmy_input_pplist'][$key] != '' ){
		$spmybpz_pplist[$key] = $_POST['spmy_input_pplist'][$key] ;
		} else {
		$spmybpz_pplist[$key] = 'NotChecked';
		}
	}
	$spmybpz_tmpstr = serialize( $spmybpz_pplist );	
	spmybpz_zbopp_write_file( $spmybpz_published_posts_file, $spmybpz_tmpstr );
//} 


//if( isset( $_POST['spmy_diaplay_all'] )  &&  $_POST['spmy_diaplay_all'] == 'Display On All Pages' ){
	$spmybpz_maxi = count( $spmybpz_ppplist );
	foreach( $spmybpz_ppplist as $key => &$value ){
		$spmybpz_ppplist[$key] = 'Checked';
	}
	$spmybpz_tmpstr = serialize( $spmybpz_ppplist );	
	spmybpz_zbopp_write_file( $spmybpz_published_pages_file, $spmybpz_tmpstr );
//}

//if( isset( $_POST['spmy_check_pages'] )  &&  $_POST['spmy_check_pages'] == 'Change Page Display' ){
	$spmybpz_maxi = count( $spmybpz_ppplist );
	foreach( $spmybpz_ppplist as $key => &$value ){
		if( isset($_POST['spmy_input_ppplist'][$key]) && $_POST['spmy_input_ppplist'][$key] != '' ){
		$spmybpz_ppplist[$key] = $_POST['spmy_input_ppplist'][$key] ;
		} else {
		$spmybpz_ppplist[$key] = 'NotChecked';
		}
	}
	$spmybpz_tmpstr = serialize( $spmybpz_ppplist );	
	spmybpz_zbopp_write_file( $spmybpz_published_pages_file, $spmybpz_tmpstr );
//} 





//if( isset( $_POST['spmy_type_of_display'] ) ){
//if( $_POST['spmy_type_of_display'] == 'Set Display' ){
	if( isset( $_POST['spmy_display_posts'] ) ) {
	$spmybpz_data_str[2] = $_POST['spmy_display_posts'];
	$spmybpz_posts = $spmybpz_data_str[2] ;
	}
	if( isset( $_POST['spmy_display_pages'] ) ) {
	$spmybpz_data_str[3] = $_POST['spmy_display_pages'] ;
	$spmybpz_pages = $spmybpz_data_str[3] ;
	}
	$spmybpz_tmpstr = serialize( $spmybpz_data_str );	
	spmybpz_zbopp_write_file( $spmybpz_setup_file, $spmybpz_tmpstr );
//} 
//} 

 
//if( isset( $_POST['spmy_type_of_bottom'] ) ){
//if( $_POST['spmy_type_of_bottom'] == 'Submit' ){
	if( isset( $_POST['spmy_display_bottom'] ) ) {
	$spmybpz_data_str[4] = $_POST['spmy_display_bottom'];
	$spmybpz_bottom = $spmybpz_data_str[4] ;
	}
	if( isset( $_POST['spmy_display_java'] ) ) {
	$spmybpz_data_str[6] = $_POST['spmy_display_java'];
	$spmybpz_java = $spmybpz_data_str[6] ;
	}	
	if( isset( $_POST['spmy_display_ranking'] ) ) {
//	echo '<br> $_POST ranking is set';
	if( $_POST['spmy_display_ranking'] >= 0 && $_POST['spmy_display_ranking'] < 1000 ){
		$spmybpz_data_str[5] = 1*$_POST['spmy_display_ranking'];
		$spmybpz_ranking = $spmybpz_data_str[5] ;
		} else {
		$spmybpz_data_str[5] = 100;
		$spmybpz_ranking = 100 ;		
		}
	}	
	$spmybpz_tmpstr = serialize( $spmybpz_data_str );	
	spmybpz_zbopp_write_file( $spmybpz_setup_file, $spmybpz_tmpstr );
//} 
//} 


//if( isset( $_POST['spmy_total_messages'] )) {
//if( $_POST['spmy_total_messages'] == 'Submit' ){
	//echo '<br>Yes Submit detected';
	$spmybpz_counter_old = $spmybpz_counter;
	if( isset( $_POST['spmy_message_counter'] ) ) {
	$spmybpz_counter = trim( $_POST['spmy_message_counter'] )*1;
	$spmybpz_data_str[0] = $spmybpz_counter;
	//check if more
	if( $spmybpz_counter > $spmybpz_counter_old ){
		for( $spmybpz_k=$spmybpz_counter_old; $spmybpz_k<$spmybpz_counter; $spmybpz_k++) {
			$spmybpz_post_SEO[$spmybpz_k][0] = 'NOT SEO';
			$spmybpz_post_SEO[$spmybpz_k][1] = 790; //width of message
			$spmybpz_post_SEO[$spmybpz_k][2] = 140; //height message
			$spmybpz_post_SEO[$spmybpz_k][3] = ''; //used base encode 64 of iframe code 
			$spmybpz_post_SEO[$spmybpz_k][4] = ''; //Home summany page
			$spmybpz_post_SEO[$spmybpz_k][5] = ''; //Category summary page
			$spmybpz_post_SEO[$spmybpz_k][6] = ''; //Archive summary page
			$spmybpz_post_SEO[$spmybpz_k][7] = ''; //Title of Message - so that you will remember what it is about months later
			$spmybpz_post_SEO[$spmybpz_i][8] = ''; //ShortCode setting
			}
		}
	}
	if( isset( $_POST['spmy_message_page_counter'] ) ) {
	$spmybpz_page_counter = trim( $_POST['spmy_message_page_counter'] )*1;
	$spmybpz_data_str[1] = $spmybpz_page_counter;
	}
	$spmybpz_tmpstr = serialize( $spmybpz_data_str );	
	spmybpz_zbopp_write_file( $spmybpz_setup_file, $spmybpz_tmpstr );
//} 
//}		


//if( isset( $_POST['spmy_bottom_messages'] )){
//if( $_POST['spmy_bottom_messages'] == 'Save Post Messages' ){
	for( $spmybpz_i=0; $spmybpz_i<$spmybpz_counter; $spmybpz_i++) {
		$spmybpz_tmpstr = '';
		$spmybpz_tmpstr_html = '';
		if( isset( $_POST['spmy_txtarea'][$spmybpz_i] ) && trim( $_POST['spmy_txtarea'][$spmybpz_i] ) != '' ) {
			$spmybpz_tmpstr =  stripslashes( trim( $_POST['spmy_txtarea'][$spmybpz_i] ) );
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
			$spmybpz_msg[ $spmybpz_i ] = $spmybpz_tmpstr;
			if( isset($spmybpz_filename[ $spmybpz_i ]) && isset($spmybpz_msg[ $spmybpz_i ]) ){
			spmybpz_zbopp_write_file( $spmybpz_filename[ $spmybpz_i ], $spmybpz_msg[ $spmybpz_i ] );
			}
			$spmybpz_tmpstr_html = '<html><head></head><body>'."\n".$spmybpz_tmpstr."\n".'</body></html>';
			if( isset($spmybpz_filename_html[ $spmybpz_i ]) && isset($spmybpz_tmpstr_html) ){
			spmybpz_zbopp_write_file( $spmybpz_filename_html[ $spmybpz_i ], $spmybpz_tmpstr_html );
			}
			} else {
			$spmybpz_tmpstr = '';
			$spmybpz_tmpstr_html = '';
			}
			$spmybpz_msg_array[ $spmybpz_i ] = base64_encode( $spmybpz_tmpstr );
			$spmybpz_tmpstr_html_array[$spmybpz_i] = base64_encode( $spmybpz_tmpstr_html );	
	}
	
//}
//echo '<br>Var Dump SEO <br>';
//var_dump( $_POST['spmy_ppost_SEO'] );
//echo '<br><br>';
//echo '<br>Var Dump HOME<br>';
//var_dump( $_POST['spmy_ppost_HOME'] );
//echo '<br><br>';
//echo '<br>Var Dump ARC<br>';
//var_dump( $_POST['spmy_ppost_ARC'] );
//echo '<br><br>';
	for( $spmybpz_i=0; $spmybpz_i<$spmybpz_counter; $spmybpz_i++) { 
		if( isset( $_POST['spmy_ppost_SEO'][$spmybpz_i] ) ) {
			$spmybpz_post_SEO[$spmybpz_i][0] =  $_POST['spmy_ppost_SEO'][$spmybpz_i] ;
			} 
		if( isset( $_POST['spmy_ppost_width'][$spmybpz_i] ) ) {
			$spmybpz_post_SEO[$spmybpz_i][1] =  1*$_POST['spmy_ppost_width'][$spmybpz_i] ; //sanitized
			} 
		if( isset( $_POST['spmy_ppost_height'][$spmybpz_i] ) ) {
			$spmybpz_post_SEO[$spmybpz_i][2] =  1*$_POST['spmy_ppost_height'][$spmybpz_i] ; //sanitized
			} 
			
		if( isset( $_POST['spmy_ppost_HOME'][$spmybpz_i] ) ) {
			$spmybpz_post_SEO[$spmybpz_i][4] =  $_POST['spmy_ppost_HOME'][$spmybpz_i] ;
			} else {
			$spmybpz_post_SEO[$spmybpz_i][4] = '';
			}
		if( isset( $_POST['spmy_ppost_CAT'][$spmybpz_i] ) ) {	
			$spmybpz_post_SEO[$spmybpz_i][5] =  $_POST['spmy_ppost_CAT'][$spmybpz_i] ;
			} else {
			$spmybpz_post_SEO[$spmybpz_i][5] =  '';
			}
		if( isset( $_POST['spmy_ppost_ARC'][$spmybpz_i] ) ) {	
			$spmybpz_post_SEO[$spmybpz_i][6] =  $_POST['spmy_ppost_ARC'][$spmybpz_i] ;
			} else {
			$spmybpz_post_SEO[$spmybpz_i][6] =  '';
			}			
		if( isset( $_POST['spmy_ppost_TITLE'][$spmybpz_i] ) ) {
		$spmybpz_post_SEO[$spmybpz_i][7] =  sanitize_text_field($_POST['spmy_ppost_TITLE'][$spmybpz_i]) ;	//version 1.02 add title
		}
		if( isset( $_POST['spmy_ppost_ShortCode'][$spmybpz_i] ) ) {	
			$spmybpz_post_SEO[$spmybpz_i][8] =  $_POST['spmy_ppost_ShortCode'][$spmybpz_i] ;
			} else {
			$spmybpz_post_SEO[$spmybpz_i][8] =  '';
			}			
	if( $spmybpz_post_SEO[$spmybpz_i][0] == 'SEO' ){ //if sensitive to SEO save info and display as iframe
	
		$spmybpz_tempstr = base64_encode ( '<iframe src="'.$spmybpz_plugins_urldata.'/seopostmsg'.$spmybpz_i.'.html"  width="'.$spmybpz_post_SEO[$spmybpz_i][1].'" height="'.$spmybpz_post_SEO[$spmybpz_i][2].'"></iframe>' ) ; 
		$spmybpz_tempstrY = $spmybpz_plugins_urldata.'/seopostmsg'.$spmybpz_i.'.html' ;
		
		$spmybpz_post_SEO[$spmybpz_i][3] = $spmybpz_tempstr;
		}
	}	
//save post messages as an array so that easier to delete or add	
spmybpz_zbopp_write_file( $spmybpz_msg_array_file, serialize( $spmybpz_msg_array) );
spmybpz_zbopp_write_file( $spmybpz_tmpstr_html_array_file, serialize( $spmybpz_tmpstr_html_array) );	
spmybpz_zbopp_write_file( $spmybpz_setup_seopost_file, serialize( $spmybpz_post_SEO ) );
//} 


//if( isset( $_POST['spmy_bottom_page_messages'] ) ){
//if( $_POST['spmy_bottom_page_messages'] == 'Save Page Messages' ){
	for( $spmybpz_i=0; $spmybpz_i<$spmybpz_page_counter; $spmybpz_i++) {
		$spmybpz_tmpstr = '';
		$spmybpz_tmpstr_html = '';	
	
	if( isset( $_POST['spmy_page_txtarea'][$spmybpz_i] )  && trim( $_POST['spmy_page_txtarea'][$spmybpz_i] ) != '' ) {
		$spmybpz_tmpstr =  stripslashes( trim( $_POST['spmy_page_txtarea'][$spmybpz_i] ) );
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
		$spmybpz_page_msg[ $spmybpz_i ] = $spmybpz_tmpstr;
		spmybpz_zbopp_write_file( $spmybpz_page_filename[ $spmybpz_i ], $spmybpz_page_msg[ $spmybpz_i ] );
		$spmybpz_tmpstr_html = '<html><head></head><body>'."\n".$spmybpz_tmpstr."\n".'</body></html>';
		spmybpz_zbopp_write_file( $spmybpz_page_filename_html[ $spmybpz_i ], $spmybpz_tmpstr_html );

		}  else {
			$spmybpz_tmpstr = '';
			$spmybpz_tmpstr_html = '';
			}
		$spmybpz_page_msg_array[ $spmybpz_i ] = base64_encode( $spmybpz_tmpstr );
		$spmybpz_tmpstr_page_html_array[$spmybpz_i] = base64_encode( $spmybpz_tmpstr_html );	
	}

	
	for( $spmybpz_i=0; $spmybpz_i<$spmybpz_page_counter; $spmybpz_i++) {
		if( $_POST['spmy_ppage_SEO'][$spmybpz_i] == 'SEO' ) {
			$spmybpz_page_SEO[$spmybpz_i][0] =  $_POST['spmy_ppage_SEO'][$spmybpz_i] ;
			} else {
			$spmybpz_page_SEO[$spmybpz_i][0] =  'NOT SEO';
			}
		if( isset( $_POST['spmy_ppage_width'][$spmybpz_i] ) ) {
			$spmybpz_page_SEO[$spmybpz_i][1] =  1*$_POST['spmy_ppage_width'][$spmybpz_i] ; //sanitized
			}
		if( isset( $_POST['spmy_ppage_height'][$spmybpz_i] ) ) {
			$spmybpz_page_SEO[$spmybpz_i][2] =  1*$_POST['spmy_ppage_height'][$spmybpz_i] ; //sanitized
			}	
		if( isset( $_POST['spmy_ppage_TITLE'][$spmybpz_i] ) ) {	
		$spmybpz_page_SEO[$spmybpz_i][7] =  sanitize_text_field($_POST['spmy_ppage_TITLE'][$spmybpz_i]) ;
		}
		if( isset( $_POST['spmy_ppage_ShortCode'][$spmybpz_i] ) ) {	
		$spmybpz_page_SEO[$spmybpz_i][8] =  $_POST['spmy_ppage_ShortCode'][$spmybpz_i] ;
		} else {
			$spmybpz_page_SEO[$spmybpz_i][8] = '';
			}
	if( $spmybpz_page_SEO[$spmybpz_i][0] == 'SEO' ){ //if sensitive to SEO save info and display as iframe
	
		$spmybpz_tempstr = base64_encode ( '<div width="'.$spmybpz_page_SEO[$spmybpz_i][1].'" height="'.$spmybpz_page_SEO[$spmybpz_i][2].'"><iframe src="'.$spmybpz_plugins_urldata.'/seopagemsg'.$spmybpz_i.'.html' .'" width="'.$spmybpz_page_SEO[$spmybpz_i][1].'" height="'.$spmybpz_page_SEO[$spmybpz_i][2].'">   scrolling="auto" </iframe></div>' ) ; 
		$spmybpz_tempstrX =  $spmybpz_plugins_urldata.'/seopagemsg'.$spmybpz_i.'.html';
		
		$spmybpz_page_SEO[$spmybpz_i][3] = $spmybpz_tempstr;
		}
	}
//save page messages as an array so that easier to delete or add	
spmybpz_zbopp_write_file( $spmybpz_page_msg_array_file, serialize( $spmybpz_page_msg_array) );
spmybpz_zbopp_write_file( $spmybpz_tmpstr_page_html_array_file, serialize( $spmybpz_tmpstr_page_html_array) );		
spmybpz_zbopp_write_file( $spmybpz_setup_seopage_file, serialize( $spmybpz_page_SEO ) );
	
//} 
//}


//delete post messages that were checked 'Delete'
$spmybpz_counter_old = $spmybpz_counter;
unset( $spmybpz_msg_array_new ) ;
unset( $spmybpz_tmpstr_html_array_new ) ;
unset( $spmybpz_post_SEO_new ) ;
$spmybpz_j = 0 ;
for( $spmybpz_i=0; $spmybpz_i<$spmybpz_counter; $spmybpz_i++ ) {
	if( isset( $_POST['spmy_ppost_DEL'][$spmybpz_i] ) ){
		if( $_POST['spmy_ppost_DEL'][$spmybpz_i] != 'Delete' ){
			$spmybpz_msg_array_new[ $spmybpz_j ] = $spmybpz_msg_array[ $spmybpz_i ] ;
			$spmybpz_tmpstr_html_array_new[ $spmybpz_j ] = $spmybpz_tmpstr_html_array[ $spmybpz_i ] ;
			$spmybpz_post_SEO_new[ $spmybpz_j ] = $spmybpz_post_SEO[ $spmybpz_i ] ;
			$spmybpz_j++;
			} else { 
			$spmybpz_counter_old--;
			}
		}
}

if( $spmybpz_counter_old < $spmybpz_counter ){
unset( $spmybpz_msg_array ) ;
unset( $spmybpz_tmpstr_html_array ) ;
unset( $spmybpz_post_SEO ) ;
if( isset( $spmybpz_msg_array_new ) ){
$spmybpz_msg_array = $spmybpz_msg_array_new ;
}
if( isset( $spmybpz_tmpstr_html_array_new ) ){
$spmybpz_tmpstr_html_array = $spmybpz_tmpstr_html_array_new ;
}
if( isset( $spmybpz_post_SEO_new ) ){
$spmybpz_post_SEO = $spmybpz_post_SEO_new ;
}
}

$spmybpz_tmpstr = unserialize( spmybpz_zbopp_read_file( $spmybpz_setup_file ) );
$spmybpz_tmpstr[0] = $spmybpz_counter_old ;
$spmybpz_counter =  $spmybpz_counter_old ; //update this value too
spmybpz_zbopp_write_file( $spmybpz_setup_file, serialize( $spmybpz_tmpstr ) );

//save post messages as an array so that easier to delete or add	
if( isset($spmybpz_msg_array) ){
spmybpz_zbopp_write_file( $spmybpz_msg_array_file, serialize( $spmybpz_msg_array) );
}
if( isset($spmybpz_tmpstr_html_array) ){
spmybpz_zbopp_write_file( $spmybpz_tmpstr_html_array_file, serialize( $spmybpz_tmpstr_html_array) );
}
if( isset($spmybpz_post_SEO) ){
spmybpz_zbopp_write_file( $spmybpz_setup_seopost_file, serialize( $spmybpz_post_SEO ) );
}


//delete page messages that were checked 'Delete'
$spmybpz_page_counter_old = $spmybpz_page_counter;
unset( $spmybpz_page_msg_array_new ) ;
unset( $spmybpz_tmpstr_page_html_array_new ) ;
unset( $spmybpz_page_SEO_new ) ;
$spmybpz_j = 0 ;

for( $spmybpz_i=0; $spmybpz_i<$spmybpz_page_counter; $spmybpz_i++) {
	if( isset( $_POST['spmy_ppage_DEL'][$spmybpz_i] ) ){
		if( $_POST['spmy_ppage_DEL'][$spmybpz_i] != 'Delete' ){
			//unset( $spmybpz_page_msg_array[ $spmybpz_i ] ) ;
			//unset(	$spmybpz_tmpstr_page_html_array[$spmybpz_i] );
			//unset( $spmybpz_page_SEO[$spmybpz_i] );
			$spmybpz_page_msg_array_new[ $spmybpz_j ] = $spmybpz_page_msg_array[ $spmybpz_i ] ;
			$spmybpz_tmpstr_page_html_array_new[ $spmybpz_j ] = $spmybpz_tmpstr_page_html_array[ $spmybpz_i ] ;
			$spmybpz_page_SEO_new[ $spmybpz_j ] = $spmybpz_page_SEO[ $spmybpz_i ] ;
			$spmybpz_j++;
			} else { 
			$spmybpz_page_counter_old--;
			}
			}
		}

if( $spmybpz_page_counter_old < $spmybpz_page_counter ){
unset( $spmybpz_page_msg_array ) ;
unset( $spmybpz_tmpstr_page_html_array ) ;
unset( $spmybpz_page_SEO ) ;
if( isset( $spmybpz_page_msg_array_new ) ){
$spmybpz_page_msg_array = $spmybpz_page_msg_array_new ;
}
if( isset( $spmybpz_tmpstr_page_html_array_new ) ){
$spmybpz_tmpstr_page_html_array = $spmybpz_tmpstr_page_html_array_new ;
}
if( isset( $spmybpz_page_SEO_new ) ){
$spmybpz_page_SEO = $spmybpz_page_SEO_new ;
}
}

$spmybpz_tmpstr = unserialize( spmybpz_zbopp_read_file( $spmybpz_setup_file ) );
$spmybpz_tmpstr[1] = $spmybpz_page_counter_old ;
$spmybpz_page_counter =  $spmybpz_page_counter_old ; //update this value too
spmybpz_zbopp_write_file( $spmybpz_setup_file, serialize( $spmybpz_tmpstr ) );

//save page messages as an array so that easier to delete or add	
spmybpz_zbopp_write_file( $spmybpz_page_msg_array_file, serialize( $spmybpz_page_msg_array) );
spmybpz_zbopp_write_file( $spmybpz_tmpstr_page_html_array_file, serialize( $spmybpz_tmpstr_page_html_array) );	
spmybpz_zbopp_write_file( $spmybpz_setup_seopage_file, serialize( $spmybpz_page_SEO ) );



}
}
/*************************End of $_POST******************************/


//initialise variables

if( $spmybpz_posts == 'DISPLAY' ){
$spmybpz_post_button = 'checked="checked"' ;
$spmybpz_post_button1 = '' ;
} else {
$spmybpz_post_button = '' ;
$spmybpz_post_button1 = 'checked="checked"' ;
}

if( $spmybpz_pages == 'DISPLAY' ){
$spmybpz_page_button = 'checked="checked"' ;
$spmybpz_page_button1 = '' ;
} else {
$spmybpz_page_button = '' ;
$spmybpz_page_button1 = 'checked="checked"' ;
}		

if( $spmybpz_bottom != 'End' ){
$spmybpz_post_bottom = 'checked="checked"' ;
$spmybpz_post_bottom1 = '' ;
} else {
$spmybpz_post_bottom = '' ;
$spmybpz_post_bottom1 = 'checked="checked"' ;
}
if( $spmybpz_java != 'Allow' ){
$spmybpz_post_java = 'checked="checked"' ;
$spmybpz_post_java1 = '' ;
} else {
$spmybpz_post_java = '' ;
$spmybpz_post_java1 = 'checked="checked"' ;
}
//read the latest data from seopost file
if( file_exists( $spmybpz_setup_seopost_file )) {
	$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_setup_seopost_file );
	$spmybpz_post_SEO = unserialize( $spmybpz_tmpstr);
	$spmybpz_post_SEO_count = count( $spmybpz_post_SEO );
	unset( $spmybpz_filename ) ;
	unset( $spmybpz_filename_html ) ;
	for(  $spmybpz_i=0; $spmybpz_i<$spmybpz_post_SEO_count; $spmybpz_i++ ){
		$spmybpz_filename[ $spmybpz_i ] = $spmybpz_datadiralt .'/mybotmsg'.$spmybpz_i.'.txt';
		$spmybpz_filename_html[ $spmybpz_i ] = $spmybpz_datadiralt .'/seopostmsg'.$spmybpz_i.'.html';
		}
}

//read the latest data from seopage file
if( file_exists( $spmybpz_setup_seopage_file )) {
	$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_setup_seopage_file );
	$spmybpz_page_SEO = unserialize( $spmybpz_tmpstr);
	$spmybpz_page_SEO_count = count( $spmybpz_page_SEO );
	unset( $spmybpz_filename ) ;
	unset( $spmybpz_filename_html ) ;
	for(  $spmybpz_i=0; $spmybpz_i<$spmybpz_page_SEO_count; $spmybpz_i++ ){
		$spmybpz_filename[ $spmybpz_i ] = $spmybpz_datadiralt .'/mybotpagemsg'.$spmybpz_i.'.txt';
		$spmybpz_filename_html[ $spmybpz_i ] = $spmybpz_datadiralt .'/seopagemsg'.$spmybpz_i.'.html';
		}
}

//get old data files for posts
if( !file_exists( $spmybpz_msg_array_file ) ){

for( $spmybpz_i=0; $spmybpz_i<$spmybpz_counter; $spmybpz_i++){
$spmybpz_msg[ $spmybpz_i ] = '';
$spmybpz_filename[ $spmybpz_i ] = $spmybpz_datadiralt .'/mybotmsg'.$spmybpz_i.'.txt';
$spmybpz_filename_html[ $spmybpz_i ] = $spmybpz_datadiralt .'/seopostmsg'.$spmybpz_i.'.html';
}

$spmybpz_tmpstr = '';
for( $spmybpz_i=0; $spmybpz_i<$spmybpz_counter; $spmybpz_i++){	
if( file_exists( $spmybpz_filename[ $spmybpz_i] )){ 
	//if file exist
	if( filesize( $spmybpz_filename[ $spmybpz_i ] ) > 0 ){
		$spmybpz_msg[ $spmybpz_i ] = spmybpz_zbopp_read_file( $spmybpz_filename[ $spmybpz_i] );
		$spmybpz_msg_array[ $spmybpz_i ] = base64_encode( $spmybpz_msg[ $spmybpz_i ] );
		//echo '<br>'.$spmybpz_i.' msg: '.$spmybpz_msg_array[ $spmybpz_i ].'  ';
		$spmybpz_tmpstr_html = '<html><head></head><body>'."\n".$spmybpz_msg[ $spmybpz_i ]."\n".'</body></html>';
		$spmybpz_tmpstr_html_array[$spmybpz_i] = base64_encode( $spmybpz_tmpstr_html );
		}
	} 
} 	

//save post messages as an array so that easier to delete or add	
spmybpz_zbopp_write_file( $spmybpz_msg_array_file, serialize( $spmybpz_msg_array) );
spmybpz_zbopp_write_file( $spmybpz_tmpstr_html_array_file, serialize( $spmybpz_tmpstr_html_array) );
//spmybpz_zbopp_write_file( $spmybpz_setup_seopost_file, serialize( $spmybpz_post_SEO ) );
} else {

//read new post message array
if( file_exists( $spmybpz_msg_array_file ) ){
$spmybpz_msg_array = unserialize( spmybpz_zbopp_read_file( $spmybpz_msg_array_file ));
}
//read new post message array
if( file_exists( $spmybpz_tmpstr_html_array_file ) ){
$spmybpz_tmpstr_html_array = unserialize( spmybpz_zbopp_read_file( $spmybpz_tmpstr_html_array_file ));
}
}




//get old data files for pages
if( !file_exists( $spmybpz_page_msg_array_file ) ){

for( $spmybpz_i=0; $spmybpz_i<$spmybpz_page_counter; $spmybpz_i++){
$spmybpz_page_msg[ $spmybpz_i ] = '';
$spmybpz_page_filename[ $spmybpz_i ] = $spmybpz_datadiralt .'/mybotpagemsg'.$spmybpz_i.'.txt';
$spmybpz_page_filename_html[ $spmybpz_i ] = $spmybpz_datadiralt .'/seopagemsg'.$spmybpz_i.'.html';
}

$spmybpz_tmpstr = '';
for( $spmybpz_i=0; $spmybpz_i<$spmybpz_page_counter; $spmybpz_i++){	
if( file_exists( $spmybpz_page_filename[ $spmybpz_i] )){ 
	//if file exist
	if( filesize( $spmybpz_page_filename[ $spmybpz_i ] ) > 0 ){
		$spmybpz_page_msg[ $spmybpz_i ] = spmybpz_zbopp_read_file( $spmybpz_page_filename[ $spmybpz_i] );
		}
	} 
} 	
//save page messages as an array so that easier to delete or add	
spmybpz_zbopp_write_file( $spmybpz_page_msg_array_file, serialize( $spmybpz_page_msg_array) );
spmybpz_zbopp_write_file( $spmybpz_tmpstr_page_html_array_file, serialize( $spmybpz_tmpstr_page_html_array) );	
} else {
//read new page message array
if( file_exists( $spmybpz_page_msg_array_file ) ){
$spmybpz_page_msg_array = unserialize( spmybpz_zbopp_read_file( $spmybpz_page_msg_array_file ));
}
//read new page message array
if( file_exists( $spmybpz_tmpstr_page_html_array_file ) ){
$spmybpz_tmpstr_page_html_array = unserialize( spmybpz_zbopp_read_file( $spmybpz_tmpstr_page_html_array_file ));
}


}


echo '<br><span style="color:red;font-size:32px;font-style:normal;">Welcome to dpabottomofpostpage Setup, Version 1.19 [20150827]</span>';

echo '<p><span style="color:blue;font-size:14px;font-style:normal;">This plugin sets up the data files that hold the messages you want to display at the bottom of every post or page.</p></span>
<h3>Uses</h3>
<p><span style="color:blue;font-size:14px;font-style:normal;">Use the message areas to place text, advertisements, Sign Up forms, Affliate program ads HTML code, ... etc. If you need it displayed, just try it out. It is amazing what you can display in these message areas.</span></p>
<h3>How to use</h3>
<p><span style="color:blue;font-size:14px;font-style:normal;">Firstly, decide whether you need the messages displayed at the bottom of your content or at the end of the document. At the "bottom of your content" is at the bottom of what you have just wriiten in your post or page. At the "end of the document" means that it will be almost at the end of the webpage barring other plugins putting messages there too. Try both options and choose which one you prefer. You  can shift the position of the messages by setting the Priority value. It adjusts for both "Bottom of Content" and for "End of Document" options. The smaller the value the higher up the message. The larger the value the lower the message position is on the webpage. </p>
<p>If there is a cache plugin active, turn off the cache and clear the cache before testing.</span></p>
<p><span style="color:blue;font-size:14px;font-style:normal;">Secondly, enter how many messages you want to display at the bottom of every post and at the bottom of every page then hit the "Submit" button. If you do not want anything displayed enter 0.</span></p>
<p><span style="color:blue;font-size:14px;font-style:normal;">After that, click on radio buttons to indicate whether you would like to display the Post messages and the Page messages and click on "Set Display" button to save.</span></p>
<p><span style="color:blue;font-size:14px;font-style:normal;">Then fill up the Message Areas with the required html code and hit Save Post Messages button or Save Page Messages button. If you need to delete a message, just delete / cut the contents of that message area and hit the Save Messages button. If you have selected the "Affects SEO" option, you will need to specify the dimensions of the messages - width and height. The "DOES NOT AFFECT SEO" option does not use and does not require any dimensions to be specified. Do note that some Themes may limit the dimension of your messages and when this happens, scroll bars will appear in the display. If you see scroll bars on your messages, adjust your message dimensions or reduce the size of images in your messages.</span></p>
<p><span style="color:blue;font-size:14px;font-style:normal;">Further down you will see the options to choose which posts or pages you would like to disable from displaying messages.</span></p>
';

?>

<br>

<h3>Set up dpabottomofpostpage</h3>
<h2><span style="color:blue;font-size:16px;font-style:normal;">Choose whether messages will be displayed at bottom of your content or at the end of the document.</span></h2>
<form action="<? echo htmlspecialchars( $_SERVER['REQUEST_URI'] ) ; ?>"  method="post">

<table>
<tr><td>Display message at : </td><td><input type="radio" <?php echo $spmybpz_post_bottom; ?> name="spmy_display_bottom" value="Bottom">Bottom of your Content</td><td> OR </td><td><input type="radio" <?php echo $spmybpz_post_bottom1; ?> name="spmy_display_bottom" value="End">End of Document</td><td> and the Priority is: </td><td><input type="text" name="spmy_display_ranking" value="<?php echo $spmybpz_ranking; ?>" ></td></tr>
<tr><td>Block Javascript code : </td><td><input type="radio" <?php echo $spmybpz_post_java; ?> name="spmy_display_java" value="Block">Block Javascript Code</td><td> OR </td><td><input type="radio" <?php echo $spmybpz_post_java1; ?> name="spmy_display_java" value="Allow">Allow Javascript Code</td><td>  </td><td> </td></tr>
</table>
<!--<input type="submit" name='spmy_type_of_bottom' value="Submit" >-->
<!--</form>-->
<br>

<h2><span style="color:blue;font-size:16px;font-style:normal;">Set up number of messages to be placed at the bottom of every post and page.</span></h2>
<!--<form action="<? echo htmlspecialchars( $_SERVER['REQUEST_URI'] ) ; ?>"  method="post">-->
<table>
<tr><td>Number of messages at bottom of a post : </td><td><input type="text" size="10" name="spmy_message_counter" value="<?php echo $spmybpz_counter; ?>"  maxlength="5" ></td></tr>
<tr><td>Number of messages at bottom of a page : </td><td><input type="text" size="10" name="spmy_message_page_counter" value="<?php echo $spmybpz_page_counter; ?>"  maxlength="5"></td></tr>
</table>
<!--<input type="submit" name='spmy_total_messages' value="Submit" >-->
<!--</form>-->
<br>
<h2><span style="color:blue;font-size:16px;font-style:normal;">Choose if messages will be displayed on posts and or pages</span></h2>

<!--<form action="<? echo htmlspecialchars( $_SERVER['REQUEST_URI'] ) ; ?>"  method="post">-->
<table>
<tr><td>Display at Bottom of Posts: </td><td><input type="radio" <?php echo $spmybpz_post_button; ?> name="spmy_display_posts" value="DISPLAY">Display</td><td><input type="radio" <?php echo $spmybpz_post_button1; ?> name="spmy_display_posts" value="DONT">Don't Display</td></tr>
<tr><td>Display at Bottom of Pages: </td><td><input type="radio" <?php echo $spmybpz_page_button; ?> name="spmy_display_pages" value="DISPLAY">Display</td><td><input type="radio" <?php echo $spmybpz_page_button1; ?> name="spmy_display_pages" value="DONT">Don't Display</td></tr>
</table>
<!--<input type="submit" name='spmy_type_of_display' value="Set Display" >-->
<!-- </form>-->

<input type="submit" name='spmy_Save_Settings' value="Save All Settings" >

<br><br>
Note: if you want your messages centered on the webpage do enclose your HTML code with div statements:- <textarea cols="80" rows="5"><div align="center">
.
. your HTML code here
.
</div>
</textarea>
<br><br>
<h1>POST MESSAGE SECTION</h1>
<h2><span style="color:blue;font-size:16px;font-style:normal;">Set up the messages at the bottom of your WordPress Posts</span></h2>
<!--<form action="<? echo htmlspecialchars( $_SERVER['REQUEST_URI'] ) ; ?>"  method="post">-->
<table>
<?php 
$spmybpz_defcnt = count( $spmybpz_samplemsg );
if( $spmybpz_counter < $spmybpz_defcnt ){
$spmybpz_loop_counter = $spmybpz_defcnt;
} else {
$spmybpz_loop_counter = $spmybpz_counter;
}
for( $spmybpz_i=0; $spmybpz_i<$spmybpz_loop_counter; $spmybpz_i++) {
$spmybpz_j= $spmybpz_i + 1;
if( $spmybpz_i < $spmybpz_defcnt ){
if( $spmybpz_i == 1 ){
$spmybpz_samplestr = '<textarea rows="10" cols="45">'.$spmybpz_samplemsg[ $spmybpz_i].'</textarea>';
$spmybpz_samplestr1 = 'Example of Message '.$spmybpz_j.': Facebook, Google+ & Twitter Like & Share Buttons. You can copy and paste without modification into Your Message Area';
} else if( $spmybpz_i == 0 ){
$spmybpz_samplestr = '<textarea rows="10" cols="45">'.$spmybpz_samplemsg[ $spmybpz_i].'</textarea>';
$spmybpz_samplestr1 = 'Example of Message '.$spmybpz_j.': An example Copyright Message with Google Authorship. You can replace any XXX...XXX with your own values or get your own authorship code from Goolge at <a target="_blank"  href="https://plus.google.com/authorship">https://plus.google.com/authorship</a>.'; 
} if( $spmybpz_i == 2 ){
$spmybpz_samplestr = '<textarea rows="10" cols="45">'.$spmybpz_samplemsg[ $spmybpz_i].'</textarea>';
$spmybpz_samplestr1 = 'Example of Message '.$spmybpz_j.': An example of Google Ads. You can replace any XXX...XXX with your own values or get your own Google code from Google AdSense.';
}if( $spmybpz_i == 3 ){
$spmybpz_samplestr = '<textarea rows="10" cols="45">'.$spmybpz_samplemsg[ $spmybpz_i].'</textarea>';
$spmybpz_samplestr1 = 'Example of Message '.$spmybpz_j.': A blank advert that shows your visitors that they can place their advertisements in this message area. Just copy and past it into your message area.';
}
} else {
$spmybpz_samplestr = '';
$spmybpz_samplestr1 = ''; 
}
?>
<tr><td valign="bottom">
<?php 
if( $spmybpz_i < $spmybpz_counter ){
$checkflag1 = '';
$checkflag2 = '';
if( !isset( $spmybpz_post_SEO[$spmybpz_i][0] ) ){
	$spmybpz_post_SEO[$spmybpz_i][0] = 'NOT SEO' ;
	}
if( $spmybpz_post_SEO[$spmybpz_i][0] == 'SEO' ){
	$checkflag1 = 'checked';
	$checkflag2 = '';
	} else if( $spmybpz_post_SEO[$spmybpz_i][0] == 'NOT SEO') {
	$checkflag1 = '';
	$checkflag2 = 'checked';
	} 
if( !isset( $spmybpz_post_SEO[$spmybpz_i][1] ) ){
	$spmybpz_post_SEO[$spmybpz_i][1] = 790 ;
	}	
if( !isset( $spmybpz_post_SEO[$spmybpz_i][2] ) ){
	$spmybpz_post_SEO[$spmybpz_i][2] = 140 ;
	}	
if( !isset( $spmybpz_post_SEO[$spmybpz_i][4] ) ){
	$spmybpz_post_SEO[$spmybpz_i][4] = '' ;
	}
if( $spmybpz_post_SEO[$spmybpz_i][4] == 'HOME' ){
$checkHOME = 'checked';
} else {
$checkHOME = '';
}
if( !isset( $spmybpz_post_SEO[$spmybpz_i][5] ) ){
	$spmybpz_post_SEO[$spmybpz_i][5] = '' ;
	}
if( $spmybpz_post_SEO[$spmybpz_i][5] == 'CAT' ){
$checkCAT = 'checked';
} else {
$checkCAT = '';
}
if( !isset( $spmybpz_post_SEO[$spmybpz_i][6] ) ){
	$spmybpz_post_SEO[$spmybpz_i][6] = '' ;
	}
if( $spmybpz_post_SEO[$spmybpz_i][6] == 'ARC' ){
$checkARC = 'checked';
} else {
$checkARC = '';
}
if( !isset( $spmybpz_post_SEO[$spmybpz_i][7] ) ){
	$spmybpz_post_SEO[$spmybpz_i][7] = '' ;
	}
if( !isset( $spmybpz_post_SEO[$spmybpz_i][8] ) ){
	$spmybpz_post_SEO[$spmybpz_i][8] = '' ;
	}
if( $spmybpz_post_SEO[$spmybpz_i][8] == 'ShortCode' ){
$checkShortCode = 'checked';
} else {
$checkShortCode = '';
}

?>
<span style="color:blue">Your Message Area <?php echo $spmybpz_j; ?> [ AFFECTS SEO<input type="radio" name="spmy_ppost_SEO[<?php echo $spmybpz_i;?>]" value="SEO"  <?php echo $checkflag1; ?> > DOES NOT AFFECT SEO<input type="radio"  name="spmy_ppost_SEO[<?php echo $spmybpz_i;?>]" value="NOT SEO" <?php echo $checkflag2; ?>  >][ Width:<input type="text" size="6" name="spmy_ppost_width[<?php echo $spmybpz_i;?>]" value="<?php echo $spmybpz_post_SEO[$spmybpz_i][1];?>"  maxlength="5"> Height: <input type="text"  size="6" name="spmy_ppost_height[<?php echo $spmybpz_i;?>]" value="<?php echo $spmybpz_post_SEO[$spmybpz_i][2];?>"  maxlength="5" >]

<br>Show in Summary of: Home Page
<input type="checkbox" name="spmy_ppost_HOME[<?php echo $spmybpz_i;?>]" value="HOME"  <?php echo $checkHOME; ?> > Category Page
<input type="checkbox" name="spmy_ppost_CAT[<?php echo $spmybpz_i;?>]" value="CAT"  <?php echo $checkCAT; ?> >Archive Page
<input type="checkbox" name="spmy_ppost_ARC[<?php echo $spmybpz_i;?>]" value="ARC"  <?php echo $checkARC; ?> ></span>
<br>Title of Message: <br><input type="text" name="spmy_ppost_TITLE[<?php echo $spmybpz_i;?>]" value="<?php echo $spmybpz_post_SEO[$spmybpz_i][7];?>"  size="80" >
<br><span style="color:blue">Is Message a shortcode: <input type="checkbox" name="spmy_ppost_ShortCode[<?php echo $spmybpz_i;?>]" value="ShortCode"  <?php echo $checkShortCode; ?> ></span>The Message: <br>
<?php
}
?>
</td><td><span style="color:red"><?php echo $spmybpz_samplestr1; ?></span>
</td></tr>
<tr><td>
<?php 
if( $spmybpz_i < $spmybpz_counter ){
//display messages from the new array rather than from the files.
?>
<textarea name="<?php echo 'spmy_txtarea['.$spmybpz_i.']'; ?>" rows="10" cols="80"><?php echo base64_decode( $spmybpz_msg_array[ $spmybpz_i ] ) ; ?></textarea></td>
<?php
} else {
?>
</td>
<?php
}
?>
<td><?php echo $spmybpz_samplestr ; ?></td></tr>
<tr><td>Delete This Message : <input type="checkbox" name="spmy_ppost_DEL[<?php echo $spmybpz_i;?>]" value="Delete"></td><td></td></tr>
<tr><td><br></td><td></td></tr>
<?php 
}
?>
</table>
<?php
if( $spmybpz_counter > 0){
?>
<!--<input type="submit" name="spmy_bottom_messages" value="Save Post Messages" >-->
<?php
}
?>
<input type="submit" name='spmy_Save_Settings' value="Save All Settings" >
<!--</form>-->



<br><br>
<h1>PAGE MESSAGE SECTION</h1>
<h2><span style="color:blue;font-size:16px;font-style:normal;">Set up the messages at the bottom of your WordPress Pages</span></h2>
<!--<form action="<? echo htmlspecialchars( $_SERVER['REQUEST_URI'] ) ; ?>"  method="post">-->
<table>
<?php 

for( $spmybpz_i=0; $spmybpz_i<$spmybpz_page_counter; $spmybpz_i++) {
$spmybpz_j= $spmybpz_i + 1;

?>
<tr><td valign="bottom">
<?php 
if( $spmybpz_i < $spmybpz_page_counter ){
$checkflag1 = '';
$checkflag2 = '';
if( !isset( $spmybpz_page_SEO[$spmybpz_i][0] ) ){
	$spmybpz_page_SEO[$spmybpz_i][0] = 'NOT SEO' ;
	}
if( $spmybpz_page_SEO[$spmybpz_i][0] == 'SEO' ){
	$checkflag1 = 'checked';
	$checkflag2 = '';
	} else if( $spmybpz_page_SEO[$spmybpz_i][0] == 'NOT SEO') {
	$checkflag1 = '';
	$checkflag2 = 'checked';
	}
if( !isset( $spmybpz_page_SEO[$spmybpz_i][1] ) ){
	$spmybpz_page_SEO[$spmybpz_i][1] = 790 ;
	}
	if( !isset( $spmybpz_page_SEO[$spmybpz_i][2] ) ){
	$spmybpz_page_SEO[$spmybpz_i][2] = 140 ;
	}	
if( !isset( $spmybpz_page_SEO[$spmybpz_i][8] ) ){
	$spmybpz_page_SEO[$spmybpz_i][8] = '' ;
	}
if( $spmybpz_page_SEO[$spmybpz_i][8] == 'ShortCode' ){
$checkShortCode = 'checked';
} else {
$checkShortCode = '';
}	
?>
<span style="color:blue">Your Message Area <?php echo $spmybpz_j; ?> [ AFFECTS SEO<input type="radio"  name="spmy_ppage_SEO[<?php echo $spmybpz_i;?>]" value="SEO"  <?php echo $checkflag1; ?> > DOES NOT AFFECT SEO<input type="radio" name="spmy_ppage_SEO[<?php echo $spmybpz_i;?>]" value="NOT SEO" <?php echo $checkflag2; ?>  >][ Width:<input type="text" size="6" name="spmy_ppage_width[<?php echo $spmybpz_i;?>]" value="<?php echo $spmybpz_page_SEO[$spmybpz_i][1];?>"  maxlength="5"> Height: <input type="text"  size="6" name="spmy_ppage_height[<?php echo $spmybpz_i;?>]" value="<?php echo $spmybpz_page_SEO[$spmybpz_i][2];?>"  maxlength="5" >]</span>
<br>Title of Message: <br><input type="text" name="spmy_ppage_TITLE[<?php echo $spmybpz_i;?>]" value="<?php echo $spmybpz_page_SEO[$spmybpz_i][7];?>"  size="80" >
<br><span style="color:blue">Is Message a shortcode: <input type="checkbox" name="spmy_ppage_ShortCode[<?php echo $spmybpz_i;?>]" value="ShortCode"  <?php echo $checkShortCode; ?> ></span>The Message:<br>
<?php
}
?>
</td><td></td></tr>
<tr><td>
<?php 
if( $spmybpz_i < $spmybpz_page_counter ){
?>
<textarea name="<?php echo 'spmy_page_txtarea['.$spmybpz_i.']'; ?>" rows="10" cols="80"><?php echo base64_decode( $spmybpz_page_msg_array[ $spmybpz_i ] ) ; ?></textarea>
<?php
}
?>
</td>
<td></td></tr>
<tr><td>Delete This Message : <input type="checkbox" name="spmy_ppage_DEL[<?php echo $spmybpz_i;?>]" value="Delete"></td><td></td></tr>
<tr><td><br></td><td></td></tr>
<?php 
}
?>
</table>
<?php
if( $spmybpz_page_counter > 0){
?>
<!--<input type="submit" name="spmy_bottom_page_messages" value="Save Page Messages" >-->
<?php
}
?>
<input type="submit" name='spmy_Save_Settings' value="Save All Settings" >
<!--</form>-->
<!-- </div>-->

<br><br>

<h1>Select posts that are to show messages</h1>
<h2><span style="color:blue;font-size:16px;font-style:normal;">You can select which posts are to show messages.</span></h2>
<!-- <form action="<? echo htmlspecialchars( $_SERVER['REQUEST_URI'] ) ; ?>"  method="post">
-->
<table class="spmybpz_myoptions">
<tr><td>All post to show messages </td><td><!--<input type="submit" name='spmy_diapla_all' value="Display On All Posts" >--></td></tr>
</table>
<!--</form>-->
<h1>OR</h1>

<h2><span style="color:blue;font-size:16px;font-style:normal;">The table below shows the list of <?php echo $spmybpz_postslist_sz; ?> posts. Check posts that will display messages and uncheck posts that are not to show messages</span></h2>

<!--<form action="<? echo htmlspecialchars( $_SERVER['REQUEST_URI'] ) ; ?>"  method="post">-->
<!--<input type="submit" name='spmy_check_posts' value="Change Post Display" >-->
<div class="spmybpz_mydisplay">
<table class="spmybpz_X">
<?php
$spmybpz_i=0;
$spmybpz_pplist = NULL;
unset( $spmybpz_pplist );
$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_published_posts_file );
$spmybpz_pplist = unserialize( $spmybpz_tmpstr );
echo '<tr><th>Item </th><th>Post </th><th>Display</th></tr>';
foreach( $spmybpz_pplist as $key => $value ){
echo '<tr><td>'.($spmybpz_i+1).'</td><td>'.$key.'</td><td><input type="checkbox"  name="spmy_input_pplist['.$key.']" value="Checked" '.$value.'></td></tr>';
$spmybpz_i++;
}
?>
</table>
</div>
<!-- 
<form action="<? echo htmlspecialchars( $PHP_SELF ) ; ?>"  method="post">
<input type="submit" name='spmy_post_first_page' value="First Page" >
<input type="submit" name='spmy_post_last_page' value="Last Page" >
<input type="submit" name='spmy_post_prev_page' value="Previous Page" >
<input type="submit" name='spmy_post_next_page' value="Next Page" >
</form>
-->
<!--<input type="submit" name='spmy_check_posts' value="Change Post Display" >-->
<!--</form>-->



<br><br>
<h1>Select pages that are to show messages</h1>
<h2><span style="color:blue;font-size:16px;font-style:normal;">You can select which pages are to show messages.</span></h2>
<!--<form action="<? echo htmlspecialchars( $_SERVER['REQUEST_URI'] ) ; ?>"  method="post">-->
<table class="spmybpz_myoptions">
<tr><td>All pages to show messages </td><td><!--<input type="submit" name='spmy_diaplay_all' value="Display On All Pages" >--></td></tr>
</table>
<!--</form>-->
<h1>OR</h1>
<h2><span style="color:blue;font-size:16px;font-style:normal;">The table below shows the list of <?php echo $spmybpz_pageslist_sz; ?> pages. Check pages that will display messages and uncheck pages that are not to show messages</span></h2>
<!--<form action="<? echo htmlspecialchars( $_SERVER['REQUEST_URI'] ) ; ?>"  method="post">-->
<!--<input type="submit" name='spmy_check_pages' value="Change Page Display" >-->
<div class="spmybpz_mydisplay">
<table class="spmybpz_X">
<?php
$spmybpz_i=0;
$spmybpz_ppplist = NULL;
unset( $spmybpz_ppplist );
$spmybpz_tmpstr = '';
$spmybpz_ppplist ='';
$spmybpz_tmpstr = spmybpz_zbopp_read_file( $spmybpz_published_pages_file );
$spmybpz_ppplist = unserialize( $spmybpz_tmpstr );
echo '<tr><th>Item </th><th>Post </th><th>Display</th></tr>';
foreach( $spmybpz_ppplist as $key => $value ){
echo '<tr><td>'.($spmybpz_i+1).'</td><td>'.$key.'</td><td><input type="checkbox"  name="spmy_input_ppplist['.$key.']" value="Checked" '.$value.'></td></tr>';
$spmybpz_i++;
}
?>
</table>
</div>

<!--<input type="submit" name='spmy_check_pages' value="Change Page Display" >-->
<!--</form>-->
<br><br>
<input type="submit" name='spmy_Save_Settings' value="Save All Settings" >
</form>

<br><br><br>
<?php
$spmybpz_plugins_url = plugins_url().'/'.$spmybpz_plugins_name;

?>
<h3>Other Products by Software Propulsion</h3>
<table width="800">
<tr><td style="color:darkblue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">The Bad Bot Exterminator</span> - Very effective anti hacking software that blocks hackers, stop brute force login attemtps and defends against ddos attacks to protect your WordPress website</td><td style="vertical-align:top;"><a target="_blank" href="https://www.dpabadbot.com"><img src="<?php echo $spmybpz_plugins_url.'/bbbh30.png'; ?>" width="402" height="30"></a></td></tr>
<tr><td style="color:darkblue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">SuperFast Cache</span> - A very fast cache for WordPress. SuperFast Cache is in 2 modules. The 1st is the Cache Controller, in SuperFast Cache - a WordPress Plugin & the 2nd is built into dpaBadBot, The Bad Bot Exterminator & Firewall Shield.</td><td style="vertical-align:top;"><a target="_blank" href="https://www.dpabadbot.com/amazingly-super-fast-wordpress-plugin-cache-controller-and-php-accelerator.php"><img src="<?php echo $spmybpz_plugins_url.'/sfc30.png'; ?>" width="402" height="30"></a></td></tr>

<tr><td style="color:blue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">XFC a fast cache combined with an anti hacking firewall for php developers</span> - Not for WordPress, Joomla or other blogs but for other php websites. PHP Caching & Firewall Shield</td><td style="vertical-align:top;"><a target="_blank" href="http://www.xfcphpcache.com"><img src="<?php echo $spmybpz_plugins_url.'/xfch30.png'; ?>" width="402" height="30"></a></td></tr>
<tr><td style="color:blue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">Web Hosting Services</span> - from budget hosting to high performance sites.</td><td style="vertical-align:top;"><a target="_blank" href="http://www.peterpublishing.com"><img src="<?php echo $spmybpz_plugins_url.'/webhostingservicesh30.png'; ?>" width="405" height="30"></a></td></tr>
<tr><td style="color:blue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">dpaContactUs</span> - Contact Form that makes life difficult for spammers. Multiple websites can share one email address.</td><td style="vertical-align:top;"><a target="_blank" href="http://www.dpacontactus.com"><img src="<?php echo $spmybpz_plugins_url.'/cufh30.png'; ?>" width="402" height="30"></a></td></tr>
</table>

<?php

$spmybpz_msg = NULL;
unset( $spmybpz_msg );
$spmybpz_filename = NULL;
unset( $spmybpz_filename );
$spmybpz_filename_html = NULL;
unset( $spmybpz_filename_html );
$spmybpz_page_msg = NULL;
unset( $spmybpz_page_msg );
$spmybpz_page_filename = NULL;
unset( $spmybpz_page_filename );
$spmybpz_page_filename_html = NULL;
unset( $spmybpz_page_filename_html );
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

?>