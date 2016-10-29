<?php
/*
Plugin Name: Ad Inserter
Version: 1.7.0
Description: Insert any ad code into Wordpress. Perfect for AdSense or Amazon ads. Simply enter any HTML, Javascript or PHP code and select where and how you want to display it.
Author: Igor Funa
Author URI: http://igorfuna.com/
Plugin URI: http://tinymonitor.com/ad-inserter
*/

/*
Change Log

Ad Inserter 1.7.0 - 16 August 2016
- Bug fix: Shortcodes did not ignore post/static page exceptions
- Slightly redesigned user interface
- Excerpt/Post number(s) renamed to Filter as it now works on all display positions
- Widget setting removed from Automatic display to Manual display section
- Added support to disable widgets (standalone checkbox in Manual display)
- Added call counter/filter for widgets
- Added support to edit CSS for predefined styles
- Few other minor bug fixes, code improvements and cosmetic changes

Ad Inserter 1.6.7 - 9 August 2016
- Bug fix: Block code textarea was not escaped
- Added checks for page types for shortcodes
- Added support for Before/After Post position call counter/filter
- Few minor cosmetic changes

Ad Inserter 1.6.6 - 5 August 2016
- Bug fix: Display on Homepage and other blog pages might get disabled - important if you were using PHP function call or shortcode (import of settings from 1.6.4)
- Few minor cosmetic changes
- Requirements changed to WordPress 4.0 or newer
- Added initial support for Pro version

Ad Inserter 1.6.5 - 1 August 2016
- Fixed bug: Wrong counting of max insertions
- Change: display position Before Title was renamed to Before Post
- Added support for display position After Post
- Added support for posts with no <p> tags (paragraphs separated with \r\n\r\n characters)
- Added support for paragraph processing on homepage, category, archive and search pages
- Added support for custom viewports
- Added support for PHP function call counter
- Added support to disable code block on error 404 pages
- Added support to debug paragraph tags

Ad Inserter 1.6.4 - 15 May 2016
- Fixed bug: For shortcodes in posts the url was not checked
- Optimizations for device detection

Ad Inserter 1.6.3 - 6 April 2016
- Removed deprecated code (fixes PHP 7 deprecated warnings)
- Added support for paragraphs with div and other HTML tags (h1, h2, h3,...)

Ad Inserter 1.6.2 - 2 April 2016
- Removed deprecated code (fixes PHP Fatal error Call to a member function get_display_type)
- Added support to change plugin processing priority

Ad Inserter 1.6.1 - 28 February 2016
- Fixed bug: For shortcodes in posts the date was not checked
- Fixed error with some templates "Call to undefined method is_main_query()"
- Added support for minumum number of page/post words for Before/After content display option
- Added support for {author} and {author_name} tags

Ad Inserter 1.6.0 - 9 January 2016
- Added support for client-side device detection
- Many code improvements
- Improved plugin processing speed
- Removed support for deprecated tags for manual insertion {adinserter n}
- Few minor bug fixes

Ad Inserter 1.5.8 - 20 December 2015
- Fixed notice "Undefined index: adinserter_selected_block_" when saving page or post

Ad Inserter 1.5.7 - 20 December 2015
- Fixed notice "has_cap was called with an argument that is deprecated since version 2.0!"
- Few minor bug fixes and code improvements
- Added support to blacklist or whitelist url patterns: /url-start*. *url-pattern*, *url-end
- Added support to define minimum number of words in paragraphs
- Added support to define minimum user role for page/post Ad Inserter exceptions editing
- Added support to limit insertions of individual code blocks
- Added support to filter direct visits (no referer)

Ad Inserter 1.5.6 - 14 August 2015
- Fixed Security Vulnerability: Plugin was vulnerable to Cross-Site Scripting (XSS)
- Few bug fixes and code improvements

Ad Inserter 1.5.5 - 6 June 2015
- Few bug fixes and code improvements
- Added support to export and import all Ad Inserter settings

Ad Inserter 1.5.4 - 31 May 2015
- Many code optimizations and cosmetic changes
- Header and Footer code blocks moved to settings tab (#)
- Added support to process shortcodes of other plugins used in Ad Inserter code blocks
- Added support to white-list or black-list individual urls
- Added support to export and import settings for code blocks
- Added support to specify excerpts for block insertion
- Added support to specify text that must be present when counting paragraphs

Ad Inserter 1.5.3 - 2 May 2015
- Fixed Security Vulnerability: Plugin was vulnerable to a combination of CSRF/XSS attacks (credits to Kaustubh Padwad)
- Fixed bug: In some cases deprecated widgets warning reported errors
- Added support to white-list or black-list tags
- Added support for category slugs in category list
- Added support for relative paragraph positions
- Added support for individual code block exceptions on post/page editor page
- Added support for minimum number of words
- Added support to disable syntax highlighting editor (to allow using copy/paste on mobile devices)

Ad Inserter 1.5.2 - 15 March 2015
- Fixed bug: Widget titles might be displayed at wrong sidebar positions
- Change: Default code block CSS class name was changed from ad-inserter to code-block to prevent Ad Blockers from blocking Ad Inserter divs
- Added warning message if deprecated widgets are used
- Added support to display blocks on desktop + tablet and desktop + phone devices

Ad Inserter 1.5.1 - 3 March 2015
- Few fixes to solve plugin incompatibility issues
- Added support to disable all ads on specific page

Ad Inserter 1.5.0 - 2 March 2015
- Added support to display blocks on all, desktop or mobile devices
- Added support for new widgets API - one widget for all code blocks with multiple instances
- Added support to change wrapping code CSS class name
- Fixed bug: Display block N days after post is published was not working properly
- Fixed bug: Display block after paragraph in some cases was not working propery

Ad Inserter 1.4.1 - 29 December 2014
- Fixed bug: Code blocks configured as widgets were not displayed properly on widgets admin page

Ad Inserter 1.4.0 - 21 December 2014
- Added support to skip paragraphs with specified text
- Added position After paragraph
- Added support for header and footer scripts
- Added support for custom CSS styles
- Added support to display blocks to all, logged in or not logged in users
- Added support for syntax highlighting
- Added support for shortcodes
- Added classes to block wrapping divs
- Few bugs fixed

Ad Inserter 1.3.5 - 18 March 2014
- Fixed bug: missing echo for PHP function call example

Ad Inserter 1.3.4 - 15 March 2014
- Added option for no code wrapping with div
- Added option to insert block codes from PHP code
- Changed HTML codes to disable display on specific pages
- Selected code block position is preserved after settings are saved
- Manual insertion can be enabled or disabled regardless of primary display setting
- Fixed bug: in some cases Before Title display setting inserted code into RSS feed

Ad Inserter 1.3.3 - 8 January 2014
- Added option to insert ads also before or after the excerpt
- Fixed bug: in some cases many errors reported after activating the plugin
- Few minor bugs fixed
- Few minor cosmetic changes

Ad Inserter 1.3.2 - 4 December 2013
- Fixed blank settings page caused by incompatibility with some themes or plugins

Ad Inserter 1.3.1 - 3 December 2013
- Added option to insert ads also on pages
- Added option to process PHP code
- Few bugs fixed

Ad Inserter 1.3.0 - 27 November 2013
- Number of ad slots increased to 16
- New tabbed admin interface
- Ads can be manually inserted also with {adinserter AD_NUMBER} tag
- Fixed bug: only the last ad block set to Before Title was displayed
- Few other minor bugs fixed
- Few cosmetic changes

Ad Inserter 1.2.1 - 19 November 2013
- Fixed problem: || in ad code (e.g. asynchronous code for AdSense) causes only part of the code to be inserted (|| to rotate ads is replaced with |rotate|)

Ad Inserter 1.2.0 - 15/05/2012
- Fixed bug: manual tags in posts lists were not removed
- Added position Before title
- Added support for minimum number of paragraphs
- Added support for page display options for Widget and Before title positions
- Alignment now works for all display positions

Ad Inserter 1.1.3 - 07/04/2012
- Fixed bug for {search_query}: When the tag is empty {smart_tag} is used in all cases
- Few changes in the settings page

Ad Inserter 1.1.2 - 16/07/2011
- Fixed error with multisite/network installations

Ad Inserter 1.1.1 - 16/07/2011
- Fixed bug in Float Right setting display

Ad Inserter 1.1.0 - 05/06/2011
- Added option to manually display individual ads
- Added new ad alignments: left, center, right
- Added {search_query} tag
- Added support for category black list and white list

Ad Inserter 1.0.4 - 19/12/2010
- HTML entities for {title} and {short_title} are now decoded
- Added {tag} to display the first tag

Ad Inserter 1.0.3 - 05/12/2010
- Fixed bug for rotating ads

Ad Inserter 1.0.2 - 04/12/2010
- Added support for rotating ads

Ad Inserter 1.0.1 - 17/11/2010
- Added support for different sidebar implementations

Ad Inserter 1.0.0 - 14/11/2010
- Initial release

*/


//ini_set('display_errors',1);
//error_reporting (E_ALL);

if (!defined ('AD_INSERTER_PLUGIN_DIR'))
  define ('AD_INSERTER_PLUGIN_DIR', plugin_dir_path (__FILE__));

/* Version check */
global $wp_version, $version_string;
$exit_msg = 'Ad Inserter requires WordPress 4.0 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a>';

if (version_compare ($wp_version, "4.0", "<")) {
  exit ($exit_msg);
}

//include required files
require_once AD_INSERTER_PLUGIN_DIR.'class.php';
require_once AD_INSERTER_PLUGIN_DIR.'constants.php';
require_once AD_INSERTER_PLUGIN_DIR.'settings.php';
require_once AD_INSERTER_PLUGIN_DIR.'preview.php';

$ad_interter_globals = array ();

// Load options
ai_load_options ();

$version_array = explode (".", AD_INSERTER_VERSION);
$version_string = "";
foreach ($version_array as $number) {
  $version_string .= sprintf ("%02d", $number);
}

$server_side_detection = false;
$client_side_detection = false;

$block_object = array ();
for ($counter = 1; $counter <= AD_INSERTER_BLOCKS; $counter ++) {
  $obj = new ai_Block ($counter);
  $obj->load_options ($counter);
  $block_object [$counter] = $obj;

  if ($obj->get_detection_server_side())  $server_side_detection = true;
  if ($obj->get_detection_client_side ()) $client_side_detection = true;
}

if ($server_side_detection) {
  require_once AD_INSERTER_PLUGIN_DIR.'includes/Mobile_Detect.php';

  $detect = new ai_Mobile_Detect;

  define ('AI_MOBILE',   $detect->isMobile ());
  define ('AI_TABLET',   $detect->isTablet ());
  define ('AI_PHONE',    AI_MOBILE && !AI_TABLET);
  define ('AI_DESKTOP',  !AI_MOBILE);
} else {
    define ('AI_MOBILE',   true);
    define ('AI_TABLET',   true);
    define ('AI_PHONE',    true);
    define ('AI_DESKTOP',  true);
  }

$plugin_priority = get_plugin_priority ();

// Set hooks
add_action ('admin_menu',         'ai_admin_menu_hook');
add_filter ('the_content',        'ai_content_hook', $plugin_priority);
add_filter ('the_excerpt',        'ai_excerpt_hook', $plugin_priority);
add_action ('loop_start',         'ai_loop_start_hook');
add_action ('loop_end',           'ai_loop_end_hook');
add_action ('init',               'ai_init_hook');
//add_action ('admin_notices',      'ai_admin_notice_hook');
add_action ('wp_head',            'ai_wp_head_hook');
add_action ('wp_footer',          'ai_wp_footer_hook');
add_action ('widgets_init',       'ai_widgets_init_hook');
add_action ('add_meta_boxes',     'ai_add_meta_box_hook');
add_action ('save_post',          'ai_save_meta_box_data_hook');

if (function_exists ('ai_hooks')) ai_hooks ();

if ($client_side_detection) {
  add_action ('wp_enqueue_scripts', 'ai_enqueue_scripts_hook');
}

add_filter ('plugin_action_links_'.plugin_basename (__FILE__), 'ai_plugin_action_links');
add_filter ('plugin_row_meta',            'ai_set_plugin_meta', 10, 2);
add_action ('wp_ajax_ai_preview',         'ai_preview');
add_action ('wp_ajax_nopriv_ai_preview',  'ai_preview');

function ai_init_hook() {
  global $block_object;

  add_shortcode ('adinserter', 'process_shortcodes');
}

function ai_admin_menu_hook () {
  global $ai_settings_page;

  $ai_settings_page = add_submenu_page ('options-general.php', AD_INSERTER_TITLE.' Options', AD_INSERTER_TITLE, 'manage_options', basename(__FILE__), 'ai_settings');
  add_action ('admin_enqueue_scripts', 'ai_admin_enqueue_scripts');
}


function ai_admin_enqueue_scripts ($hook_suffix) {
  global $ai_settings_page;

  if ($hook_suffix == $ai_settings_page) {
    wp_enqueue_script ('ad-inserter-js',        plugins_url ('js/ad-inserter.js', __FILE__), array ('jquery', 'jquery-ui-tabs', 'jquery-ui-button', 'jquery-ui-tooltip', 'jquery-ui-dialog'), AD_INSERTER_VERSION);
    wp_enqueue_style  ('ad-inserter-jquery-ui', plugins_url ('css/jquery-ui-1.10.3.custom.min.css', __FILE__), false, null);
    wp_enqueue_style  ('ad-inserter',           plugins_url ('css/ad-inserter.css', __FILE__), false, AD_INSERTER_VERSION);

    wp_enqueue_script ('ad-ace',                plugins_url ('includes/ace/src-min-noconflict/ace.js', __FILE__ ), array (), AD_INSERTER_VERSION);
    wp_enqueue_script ('ad-ace-ext-modelist',   plugins_url ('includes/ace/src-min-noconflict/ext-modelist.js', __FILE__ ), array (), AD_INSERTER_VERSION);
  }
}

function ai_enqueue_scripts_hook () {
//  wp_enqueue_style ('ad-inserter-devices', plugins_url ( 'css/devices.css', __FILE__), false, AD_INSERTER_VERSION);
  wp_enqueue_style ('ad-inserter-viewports', plugins_url ( 'css/viewports.css', __FILE__), false, filemtime (plugin_dir_path (__FILE__ ).'css/viewports.css'));
}

function ai_admin_notice_hook () {
  global $current_screen, $ai_db_options;

//  $sidebar_widgets = wp_get_sidebars_widgets();
//  $sidebars_with_deprecated_widgets = array ();

//  foreach ($sidebar_widgets as $sidebar_widget_index => $sidebar_widget) {
//    if (is_array ($sidebar_widget))
//      foreach ($sidebar_widget as $widget) {
//        if (preg_match ("/ai_widget([\d]+)/", $widget, $widget_number)) {
//          if (isset ($widget_number [1]) && is_numeric ($widget_number [1])) {
//            $is_widget = $ai_db_options [$widget_number [1]][AI_OPTION_DISPLAY_TYPE] == AD_SELECT_WIDGET;
//          } else $is_widget = false;
//          $sidebar_name = $GLOBALS ['wp_registered_sidebars'][$sidebar_widget_index]['name'];
//          if ($is_widget && $sidebar_name != "")
//            $sidebars_with_deprecated_widgets [$sidebar_widget_index] = $sidebar_name;
//        }
//      }
//  }

//  if (!empty ($sidebars_with_deprecated_widgets)) {
//    echo "<div class='error' style='padding: 11px 15px; font-size: 14px;'><strong>Warning</strong>: You are using deprecated Ad Inserter widgets in the following sidebars: ",
//    implode (", ", $sidebars_with_deprecated_widgets),
//    ". Please replace them with the new 'Ad Inserter' code block widget. See <a href='https://wordpress.org/plugins/ad-inserter/faq/' target='_blank'>FAQ</a> for details.</div>";
//  }
}

function ai_plugin_action_links ($links) {
  $settings_link = '<a href="'.admin_url ('options-general.php?page=ad-inserter.php').'">Settings</a>';
  array_unshift ($links, $settings_link);
  return $links;
}

function ai_set_plugin_meta ($links, $file) {
  if ($file == plugin_basename (__FILE__)) {
    if (is_multisite() && !is_main_site ()) {
      foreach ($links as $index => $link) {
        if (stripos ($link, "update") !== false) unset ($links [$index]);
      }
    }
//    if (stripos (AD_INSERTER_TITLE, "pro") === false) {
//      $new_links = array ('donate' => '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LHGZEMRTR7WB4" target="_blank">Donate</a>');
//      $links = array_merge ($links, $new_links);
//    }
  }
  return $links;
}

function ai_current_user_role_ok () {
  $role_values = array ("super-admin" => 6, "administrator" => 5, "editor" => 4, "author" => 3, "contributor" => 2, "subscriber" => 1);
  global $wp_roles;

  $minimum_user_role = isset ($role_values [get_minimum_user_role ()]) ? $role_values [get_minimum_user_role ()] : 0;

  $user_role = 0;
  $current_user = wp_get_current_user();
  $roles = $current_user->roles;

  // Fix for empty roles
  if (isset ($current_user->caps) && count ($current_user->caps) != 0) {
    $caps = $current_user->caps;
    if (isset ($caps ["super-admin"]) && $caps ["super-admin"]) $roles []= "super-admin";
    if (isset ($caps ["administrator"]) && $caps ["administrator"]) $roles []= "administrator";
    if (isset ($caps ["editor"]) && $caps ["editor"]) $roles []= "editor";
    if (isset ($caps ["author"]) && $caps ["author"]) $roles []= "author";
    if (isset ($caps ["contributor"]) && $caps ["contributor"]) $roles []= "contributor";
    if (isset ($caps ["subscriber"]) && $caps ["subscriber"]) $roles []= "subscriber";
  }

  foreach ($roles as $role) {
    $current_user_role = isset ($role_values [$role]) ? $role_values [$role] : 0;
    if ($current_user_role > $user_role) $user_role = $current_user_role;
  }

  return $user_role >= $minimum_user_role;
}


function ai_add_meta_box_hook() {

  if (!ai_current_user_role_ok ()) return;

  $screens = array ('post', 'page');

  foreach ($screens as $screen) {
    add_meta_box (
      'adinserter_sectionid',
      AD_INSERTER_TITLE.' Exceptions',
      'ai_meta_box_callback',
      $screen
    );
  }
}

function ai_meta_box_callback ($post) {
  global $block_object;

  // Add an nonce field so we can check for it later.
  wp_nonce_field ('adinserter_meta_box', 'adinserter_meta_box_nonce');

  $post_type = get_post_type ($post);

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  $post_meta = get_post_meta ($post->ID, '_adinserter_block_exceptions', true);
  $selected_blocks = explode (",", $post_meta);

  echo '<table>';
  echo '<thead style="font-weight: bold;">';
    echo '  <td>Block</td>';
    echo '  <td style="padding: 0 10px 0 10px;">Name</td>';
    echo '  <td style="padding: 0 10px 0 10px;">Automatic Display Type</td>';
    echo '  <td style="padding: 0 5px 0 5px;">Posts</td>';
    echo '  <td style="padding: 0 5px 0 5px;">Pages</td>';
    echo '  <td style="padding: 0 5px 0 5px;">Manual</td>';
    echo '  <td style="padding: 0 5px 0 5px;">PHP</td>';
    echo '  <td style="padding: 0 10px 0 10px;">Default</td>';
    echo '  <td style="padding: 0 10px 0 10px;">For this ', $post_type, '</td>';
  echo '</thead>';
  echo '<tbody>';
  $rows = 0;
  for ($block = 1; $block <= AD_INSERTER_BLOCKS; $block ++) {
    $obj = $block_object [$block];

    if ($post_type == 'post') {
      $enabled_on_text  = $obj->get_ad_enabled_on_which_posts ();
      $general_enabled  = $obj->get_display_settings_post();
    } else {
        $enabled_on_text = $obj->get_ad_enabled_on_which_pages ();
        $general_enabled = $obj->get_display_settings_page();
      }

    $individual_option_enabled  = $general_enabled && ($enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED || $enabled_on_text == AD_ENABLED_ONLY_ON_SELECTED);
    $individual_text_enabled    = $enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED;

    $display_type = $obj->get_display_type();
    if ($rows % 2 != 0) $background = "#F0F0F0"; else $background = "#FFF";
    echo '<tr style="background: ', $background, ';">';
    echo '  <td style="text-align: right;">', $obj->number, '</td>';
    echo '  <td style="padding: 0 10px 0 10px;">', $obj->get_ad_name(), '</td>';
    echo '  <td style="padding: 0 10px 0 10px;">', $display_type, '</td>';

    echo '  <td style="padding: 0 10px 0 10px; text-align: center;">';
    if ($obj->get_display_settings_post ()) echo '&check;';
    echo '  </td>';
    echo '  <td style="padding: 0 10px 0 10px; text-align: center;">';
    if ($obj->get_display_settings_page ()) echo '&check;';
    echo '  </td>';
    echo '  <td style="padding: 0 10px 0 10px; text-align: center;">';
    if ($obj->get_enable_manual ()) echo '&check;';
    echo '  </td>';
    echo '  <td style="padding: 0 10px 0 10px; text-align: center;">';
    if ($obj->get_enable_php_call ()) echo '&check;';
    echo '  </td>';

    echo '  <td style="padding: 0 10px 0 10px; text-align: left;">';

    if ($individual_option_enabled) {
      if ($individual_text_enabled) echo 'Enabled'; else echo 'Disabled';
    } else {
        if ($general_enabled) echo 'Enabled on all ', $post_type, 's'; else
          echo 'Disabled on all ', $post_type, 's';
      }
    echo '  </td>';

    echo '  <td style="padding: 0 10px 0 10px; text-align: left;">';
    if ($individual_option_enabled)
      echo '<input type="checkbox" style="border-radius: 5px;" name="adinserter_selected_block_', $block, '" id="ai-selected-block-', $block, '" value="1"', in_array ($block, $selected_blocks) ? ' checked': '', ' />';

    echo '<label for="ai-selected-block-', $block, '">';
    if ($individual_option_enabled) {
      if (!$individual_text_enabled) echo 'Enabled'; else echo 'Disabled';
    }
    echo '</label>';
    echo '  </td>';

    echo '</tr>';
    $rows ++;
  }

  echo '</tbody>';
  echo '</table>';

  echo '<p>Default behavior for all code blocks for ', $post_type, 's (enabled or disabled) can be configured on <a href="/wp-admin/options-general.php?page=ad-inserter.php" target="_blank">', AD_INSERTER_TITLE, ' Settings page</a>. Here you can configure exceptions for this ', $post_type, '.</p>';
}

function ai_save_meta_box_data_hook ($post_id) {
  // Check if our nonce is set.
  if (!isset ($_POST ['adinserter_meta_box_nonce'])) return;

  // Verify that the nonce is valid.
  if (!wp_verify_nonce ($_POST ['adinserter_meta_box_nonce'], 'adinserter_meta_box')) return;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if (defined ('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

  // Check the user's permissions.

  if (isset ($_POST ['post_type'])) {
    if ($_POST ['post_type'] == 'page') {
      if (!current_user_can ('edit_page', $post_id)) return;
    } else {
      if (!current_user_can ('edit_post', $post_id)) return;
    }
  }

  /* OK, it's safe for us to save the data now. */

  $selected = array ();
  for ($block = 1; $block <= AD_INSERTER_BLOCKS; $block ++) {
    $option_name = 'adinserter_selected_block_' . $block;
    if (isset ($_POST [$option_name]) && $_POST [$option_name]) $selected []= $block;
  }

  // Update the meta field in the database.
  update_post_meta ($post_id, '_adinserter_block_exceptions', implode (",", $selected));
}

function ai_widgets_init_hook () {
  register_widget ('ai_widget');
}

function ai_wp_head_hook () {
  $obj = new ai_AdH();
  $obj->load_options ("h");

  if ($obj->get_enable_manual ()) {
    echo ai_getCode ($obj);
  }
}

function ai_wp_footer_hook () {
  $obj = new ai_AdF();
  $obj->load_options ("f");

  if ($obj->get_enable_manual ()) {
    echo ai_getCode ($obj);
  }
}

function ai_check_plugin_options ($plugin_options = array ()) {

  $version_array = explode (".", AD_INSERTER_VERSION);
  $version_string = "";
  foreach ($version_array as $number) {
    $version_string .= sprintf ("%02d", $number);
  }

  $plugin_options ['VERSION'] = $version_string;

  if (!isset ($plugin_options ['SYNTAX_HIGHLIGHTER_THEME']))  $plugin_options ['SYNTAX_HIGHLIGHTER_THEME']  = DEFAULT_SYNTAX_HIGHLIGHTER_THEME;

  if (!isset ($plugin_options ['BLOCK_CLASS_NAME']) ||
      $plugin_options ['BLOCK_CLASS_NAME'] == '')             $plugin_options ['BLOCK_CLASS_NAME']          = DEFAULT_BLOCK_CLASS_NAME;

  if (!isset ($plugin_options ['MINIMUM_USER_ROLE']))         $plugin_options ['MINIMUM_USER_ROLE']         = DEFAULT_MINIMUM_USER_ROLE;

  if (!isset ($plugin_options ['PLUGIN_PRIORITY']))           $plugin_options ['PLUGIN_PRIORITY']           = DEFAULT_PLUGIN_PRIORITY;
  $plugin_priority = $plugin_options ['PLUGIN_PRIORITY'];
  if (!is_numeric ($plugin_priority)) {
    $plugin_priority = DEFAULT_PLUGIN_PRIORITY;
  }
  $plugin_priority = intval ($plugin_priority);
  if ($plugin_priority < 0) {
    $plugin_priority = 0;
  }
  if ($plugin_priority > 999999) {
    $plugin_priority = 999999;
  }
  $plugin_options ['PLUGIN_PRIORITY'] = $plugin_priority;

  if (!isset ($plugin_options ['TAG_DEBUGGING']))             $plugin_options ['TAG_DEBUGGING']             = DEFAULT_TAG_DEBUGGING;

  for ($viewport = 1; $viewport <= AD_INSERTER_VIEWPORTS; $viewport ++) {
    $viewport_name_option_name   = 'VIEWPORT_NAME_'  . $viewport;
    $viewport_width_option_name  = 'VIEWPORT_WIDTH_' . $viewport;

    if (!isset ($plugin_options [$viewport_name_option_name]))     $plugin_options [$viewport_name_option_name] =
      defined ("DEFAULT_VIEWPORT_NAME_" . $viewport) ? constant ("DEFAULT_VIEWPORT_NAME_" . $viewport) : "";

    if ($viewport == 1 && $plugin_options [$viewport_name_option_name] == '')
      $plugin_options [$viewport_name_option_name] = constant ("DEFAULT_VIEWPORT_NAME_1");

    if ($plugin_options [$viewport_name_option_name] != '') {
      if (!isset ($plugin_options [$viewport_width_option_name]))  $plugin_options [$viewport_width_option_name] =
        defined ("DEFAULT_VIEWPORT_WIDTH_" . $viewport) ? constant ("DEFAULT_VIEWPORT_WIDTH_" . $viewport) : 0;

      $viewport_width = $plugin_options [$viewport_width_option_name];

      if ($viewport > 1) {
        $previous_viewport_option_width = $plugin_options ['VIEWPORT_WIDTH_' . ($viewport - 1)];
      }

      if (!is_numeric ($viewport_width)) {
        if ($viewport == 1)
          $viewport_width = constant ("DEFAULT_VIEWPORT_WIDTH_1"); else
            $viewport_width = $previous_viewport_option_width - 1;

      }
      if ($viewport_width > 9999) {
        $viewport_width = 9999;
      }

      if ($viewport > 1) {
        if ($viewport_width >= $previous_viewport_option_width)
          $viewport_width = $previous_viewport_option_width - 1;
      }

      $viewport_width = intval ($viewport_width);
      if ($viewport_width < 0) {
        $viewport_width = 0;
      }

      $plugin_options [$viewport_width_option_name] = $viewport_width;
    } else $plugin_options [$viewport_width_option_name] = '';
  }

  return ($plugin_options);
}

function ai_get_option ($option_name) {
  $options = get_option ($option_name);

  if (is_array ($options)) {
    foreach ($options as $key => $option) {
      $options [$key] = stripslashes ($option);
    }
  } else if (is_string ($options)) $options = stripslashes ($options);

  return ($options);
}

function ai_load_options () {
  global $ai_db_options;

  $ai_db_options = get_option (WP_OPTION_NAME);

  if (is_array ($ai_db_options)) {
    foreach ($ai_db_options as $block_number => $block_options) {
      if (is_array ($block_options)) {
        foreach ($block_options as $key => $option) {
          $ai_db_options [$block_number][$key] = stripslashes ($option);
        }
      } else if (is_string ($block_options)) $ai_db_options [$block_number] = stripslashes ($block_options);
    }
  }
}

function get_syntax_highlighter_theme () {
  global $ai_db_options;

  if (isset ($ai_db_options [AI_GLOBAL_OPTION_NAME])) $plugin_db_options = $ai_db_options [AI_GLOBAL_OPTION_NAME]; else $plugin_db_options = '';
  if (!$plugin_db_options) $plugin_db_options = get_option (AD_OPTIONS);

  if (!isset ($plugin_db_options ['SYNTAX_HIGHLIGHTER_THEME']) || $plugin_db_options ['SYNTAX_HIGHLIGHTER_THEME'] == '') {
    $plugin_db_options ['SYNTAX_HIGHLIGHTER_THEME'] = DEFAULT_SYNTAX_HIGHLIGHTER_THEME;
  }

  return ($plugin_db_options ['SYNTAX_HIGHLIGHTER_THEME']);
}

function get_block_class_name () {
  global $ai_db_options;

  if (isset ($ai_db_options [AI_GLOBAL_OPTION_NAME])) $plugin_db_options = $ai_db_options [AI_GLOBAL_OPTION_NAME]; else $plugin_db_options = '';
  if (!$plugin_db_options) $plugin_db_options = get_option (AD_OPTIONS);

  if (!isset ($plugin_db_options ['BLOCK_CLASS_NAME']) || $plugin_db_options ['BLOCK_CLASS_NAME'] == '') {
    $plugin_db_options ['BLOCK_CLASS_NAME'] = DEFAULT_BLOCK_CLASS_NAME;
  }

  return ($plugin_db_options ['BLOCK_CLASS_NAME']);
}

function get_minimum_user_role () {
  global $ai_db_options;

  if (isset ($ai_db_options [AI_GLOBAL_OPTION_NAME])) $plugin_db_options = $ai_db_options [AI_GLOBAL_OPTION_NAME]; else $plugin_db_options = '';
  if (!$plugin_db_options) $plugin_db_options = get_option (AD_OPTIONS);

  if (!isset ($plugin_db_options ['MINIMUM_USER_ROLE']) || $plugin_db_options ['MINIMUM_USER_ROLE'] == '') {
    $plugin_db_options ['MINIMUM_USER_ROLE'] = DEFAULT_MINIMUM_USER_ROLE;
  }

  return ($plugin_db_options ['MINIMUM_USER_ROLE']);
}

function get_plugin_priority () {
  global $ai_db_options;

  if (isset ($ai_db_options [AI_GLOBAL_OPTION_NAME])) $plugin_db_options = $ai_db_options [AI_GLOBAL_OPTION_NAME]; else $plugin_db_options = '';
  if (!$plugin_db_options) $plugin_db_options = get_option (AD_OPTIONS);

  if (!isset ($plugin_db_options ['PLUGIN_PRIORITY']) || $plugin_db_options ['PLUGIN_PRIORITY'] == '') {
    $plugin_db_options ['PLUGIN_PRIORITY'] = DEFAULT_PLUGIN_PRIORITY;
  }

  return ($plugin_db_options ['PLUGIN_PRIORITY']);
}

function get_tag_debugging () {
  global $ai_db_options;

  if (isset ($ai_db_options [AI_GLOBAL_OPTION_NAME])) $plugin_db_options = $ai_db_options [AI_GLOBAL_OPTION_NAME]; else $plugin_db_options = '';
  if (!$plugin_db_options) $plugin_db_options = get_option (AD_OPTIONS);

  if (!isset ($plugin_db_options ['TAG_DEBUGGING']) || $plugin_db_options ['TAG_DEBUGGING'] == '') {
    $plugin_db_options ['TAG_DEBUGGING'] = DEFAULT_TAG_DEBUGGING;
  }

  return ($plugin_db_options ['TAG_DEBUGGING']);
}

function get_viewport_name ($viewport_number) {
  global $ai_db_options;

  if (isset ($ai_db_options [AI_GLOBAL_OPTION_NAME])) $plugin_db_options = $ai_db_options [AI_GLOBAL_OPTION_NAME]; else $plugin_db_options = '';
  if (!$plugin_db_options) $plugin_db_options = get_option (AD_OPTIONS);

  $viewport_settins_name = 'VIEWPORT_NAME_' . $viewport_number;

  if (!isset ($plugin_db_options [$viewport_settins_name])) {
    $plugin_db_options [$viewport_settins_name] = defined ("DEFAULT_VIEWPORT_NAME_" . $viewport_number) ? constant ("DEFAULT_VIEWPORT_NAME_" . $viewport_number) : "";
  }

  return ($plugin_db_options [$viewport_settins_name]);
}

function get_viewport_width ($viewport_number) {
  global $ai_db_options;

  if (isset ($ai_db_options [AI_GLOBAL_OPTION_NAME])) $plugin_db_options = $ai_db_options [AI_GLOBAL_OPTION_NAME]; else $plugin_db_options = '';
  if (!$plugin_db_options) $plugin_db_options = get_option (AD_OPTIONS);

  $viewport_settins_name = 'VIEWPORT_WIDTH_' . $viewport_number;

  if (!isset ($plugin_db_options [$viewport_settins_name])) {
    $plugin_db_options [$viewport_settins_name] = defined ("DEFAULT_VIEWPORT_WIDTH_" . $viewport_number) ? constant ("DEFAULT_VIEWPORT_WIDTH_" . $viewport_number) : 0;
  }

  return ($plugin_db_options [$viewport_settins_name]);
}

function filter_html_class ($str){

  $str = str_replace (array ("\\\""), array ("\""), $str);
  $str = sanitize_html_class ($str);

  return $str;
}

function filter_string ($str){

  $str = str_replace (array ("\\\""), array ("\""), $str);
  $str = str_replace (array ("\"", "<", ">"), "", $str);
  $str = trim (esc_html ($str));

  return $str;
}

function filter_option ($option, $value, $delete_escaped_backslashes = true){
  if ($delete_escaped_backslashes)
    $value = str_replace (array ("\\\""), array ("\""), $value);

  if ($option == AI_OPTION_DOMAIN_LIST) {
    $value = str_replace (array ("\\", "/", "?", "\"", "<", ">", "[", "]"), "", $value);
    $value = esc_html ($value);
  }
  elseif ($option == AI_OPTION_PARAGRAPH_TEXT) {
    $value = esc_html ($value);
  }
  elseif ($option == AI_OPTION_NAME ||
          $option == AI_OPTION_GENERAL_TAG ||
          $option == AI_OPTION_DOMAIN_LIST ||
          $option == AI_OPTION_CATEGORY_LIST ||
          $option == AI_OPTION_TAG_LIST ||
          $option == AI_OPTION_URL_LIST ||
          $option == AI_OPTION_PARAGRAPH_TEXT_TYPE ||
          $option == AI_OPTION_PARAGRAPH_NUMBER ||
          $option == AI_OPTION_MIN_PARAGRAPHS ||
          $option == AI_OPTION_MIN_WORDS ||
          $option == AI_OPTION_MIN_PARAGRAPH_WORDS ||
          $option == AI_OPTION_MAXIMUM_INSERTIONS ||
          $option == AI_OPTION_AFTER_DAYS ||
          $option == AI_OPTION_EXCERPT_NUMBER ||
          $option == AI_OPTION_CUSTOM_CSS) {
            $value = str_replace (array ("\"", "<", ">", "[", "]"), "", $value);
            $value = esc_html ($value);
          }

  return $value;
}

function filter_option_hf ($option, $value){
  $value = str_replace (array ("\\\""), array ("\""), $value);

        if ($option == AI_OPTION_CODE ) {
  } elseif ($option == AI_OPTION_ENABLE_MANUAL) {
  } elseif ($option == AI_OPTION_PROCESS_PHP) {
  } elseif ($option == AI_OPTION_ENABLE_404) {
  }

  return $value;
}

function ai_preview () {

  check_admin_referer ("adinserter_preview", "ai_check");

  if (isset ($_GET ["ai_code"])) {
    $block = $_GET ["ai_code"];
    if (is_numeric ($block) && $block >= 1 && $block <= AD_INSERTER_BLOCKS) {
      generate_code_preview ($block);
    }
  }

  die ();
}

function ai_settings () {
  global $ai_db_options, $block_object;

  if (isset ($_POST [AI_FORM_SAVE])) {

    check_admin_referer ('save_adinserter_settings');

    $import_switch_name = AI_OPTION_IMPORT . WP_FORM_FIELD_POSTFIX . '0';
    if (isset ($_POST [$import_switch_name]) && $_POST [$import_switch_name] == "1") {
      // Import Ad Inserter settings
      $saved_settings = $ai_db_options;
      $ai_options = @unserialize (base64_decode (str_replace (array ("\\\""), array ("\""), $_POST ["export_settings_0"])));
      if ($ai_options === false) {
        $ai_options = $saved_settings;
        $invalid_blocks []= 0;
      }
    } else {
        // Try to import individual settings
        $ai_options = array ();

        $invalid_blocks = array ();
        for ($block = 1; $block <= AD_INSERTER_BLOCKS; $block ++) {
          $ad = new ai_Block ($block);

          if (isset ($ai_db_options [$block])) $saved_settings = $ai_db_options [$block]; else
            $saved_settings = $ad->wp_options;

          $import_switch_name = AI_OPTION_IMPORT . WP_FORM_FIELD_POSTFIX . $block;
          if (isset ($_POST [$import_switch_name]) && $_POST [$import_switch_name] == "1") {

            $exported_settings = @unserialize (base64_decode (str_replace (array ("\\\""), array ("\""), $_POST ["export_settings_" . $block])));
            if ($exported_settings !== false) {
              foreach (array_keys ($ad->wp_options) as $key){
                if ($key == AI_OPTION_NAME) {
                  $form_field_name = $key . WP_FORM_FIELD_POSTFIX . $block;
                  if (isset ($_POST [$form_field_name])){
                    $ad->wp_options [$key] = filter_option ($key, $_POST [$form_field_name]);
                  }
                } else {
                    if (isset ($exported_settings [$key])) {
                      $ad->wp_options [$key] = filter_option ($key, $exported_settings [$key], false);
                    }
                  }
              }
            } else {
                $ad->wp_options = $saved_settings;
                $invalid_blocks []= $block;
              }
          } else {
              foreach (array_keys ($ad->wp_options) as $key){
                $form_field_name = $key . WP_FORM_FIELD_POSTFIX . $block;
                if (isset ($_POST [$form_field_name])){
                  $ad->wp_options [$key] = filter_option ($key, $_POST [$form_field_name]);
                }
              }
            }

          if (isset ($_POST [AI_OPTION_NAME . WP_FORM_FIELD_POSTFIX . $block]))
            $ai_options [$block] = $ad->wp_options; else
              $ai_options [$block] = $saved_settings;

          delete_option (str_replace ("#", $block, AD_ADx_OPTIONS));
        }

        $adH  = new ai_AdH();
        $adF  = new ai_AdF();

        foreach(array_keys ($adH->wp_options) as $key){
          $form_field_name = $key . WP_FORM_FIELD_POSTFIX . AI_HEADER_OPTION_NAME;
          if(isset ($_POST [$form_field_name])){
              $adH->wp_options [$key] = filter_option_hf ($key, $_POST [$form_field_name]);
          }
        }

        foreach(array_keys($adF->wp_options) as $key){
          $form_field_name = $key . WP_FORM_FIELD_POSTFIX . AI_FOOTER_OPTION_NAME;
          if(isset ($_POST [$form_field_name])){
              $adF->wp_options [$key] = filter_option_hf ($key, $_POST [$form_field_name]);
          }
        }

        $ai_options [AI_HEADER_OPTION_NAME] = $adH->wp_options;
        $ai_options [AI_FOOTER_OPTION_NAME] = $adF->wp_options;

        $options = array ();

        if (function_exists ('ai_filter_global_settings')) ai_filter_global_settings ($options);

        $options ['SYNTAX_HIGHLIGHTER_THEME']  = filter_string ($_POST ['syntax-highlighter-theme']);
        $options ['BLOCK_CLASS_NAME']          = filter_html_class ($_POST ['block-class-name']);
        $options ['MINIMUM_USER_ROLE']         = filter_string ($_POST ['minimum-user-role']);
        $options ['PLUGIN_PRIORITY']           = filter_option ('plugin_priority', $_POST ['plugin_priority']);
        $options ['TAG_DEBUGGING']             = filter_string ($_POST ['tag_debugging']);

        for ($viewport = 1; $viewport <= AD_INSERTER_VIEWPORTS; $viewport ++) {
          if (isset ($_POST ['viewport-name-'.$viewport]))
            $options ['VIEWPORT_NAME_'.$viewport]   = filter_string ($_POST ['viewport-name-'.$viewport]);
          if (isset ($_POST ['viewport-width-'.$viewport]))
            $options ['VIEWPORT_WIDTH_'.$viewport]  = filter_option ('viewport_width', $_POST ['viewport-width-'.$viewport]);
        }

        $ai_options [AI_GLOBAL_OPTION_NAME] = ai_check_plugin_options ($options);
      }

    if (!empty ($invalid_blocks)) {
      if ($invalid_blocks [0] == 0) {
             echo "<div class='error' style='margin: 5px 15px 2px 0px; padding: 10px;'>Error importing ", AD_INSERTER_TITLE, " settings.</div>";
      } else echo "<div class='error' style='margin: 5px 15px 2px 0px; padding: 10px;'>Error importing settings for block", count ($invalid_blocks) == 1 ? "" : "s:", " ", implode (", ", $invalid_blocks), ".</div>";
    }

    $ai_options [AI_GLOBAL_OPTION_NAME]['TIMESTAMP'] = time ();

    update_option (WP_OPTION_NAME, $ai_options);

    // Reload options
    ai_load_options ();

    // Generate viewports.css file
    $viewports = array ();
    for ($viewport = 1; $viewport <= AD_INSERTER_VIEWPORTS; $viewport ++) {
      $viewport_name  = get_viewport_name ($viewport);
      $viewport_width = get_viewport_width ($viewport);
      if ($viewport_name != '') {
        $viewports []= array ('index' => $viewport, 'name' => $viewport_name, 'width' => $viewport_width);
      }
    }

    $style = '';
    if (count ($viewports) != 0) {
      $style .= "/* " . AD_INSERTER_TITLE . " version " . AD_INSERTER_VERSION ." - viewport classes */\n\n";
      $style .= "/* DO NOT MODIFY - This file is automatically generated when you save ".AD_INSERTER_TITLE." settings */\n";
      foreach ($viewports as $index => $viewport) {
        $style .= "\n/* " . $viewport ['name'] . " */\n\n";
        if ($viewport ['index'] == 1) {
          foreach (array_reverse ($viewports) as $index2 => $viewport2) {
            if ($viewport2 ['index'] != 1) {
              $style .= ".ai-viewport-" . $viewport2 ['index'] . "                { display: none !important;}\n";
            }
          }
          $style .= ".ai-viewport-1                { display: inherit !important;}\n";
          $style .= ".ai-viewport-0                { display: none !important;}\n";
        } else {
            $style .= "@media ";
            if ($index != count ($viewports) - 1)
              $style .= "(min-width: " . $viewport ['width'] . "px) and ";
            $style .= "(max-width: " . ($viewports [$index - 1]['width'] - 1) . "px) {\n";
            foreach ($viewports as $index2 => $viewport2) {
              if ($viewport2 ['index'] == 1)
                $style .= ".ai-viewport-" . $viewport2 ['index'] . "                { display: none !important;}\n";
              elseif ($viewport ['index'] == $viewport2 ['index'])
                $style .= ".ai-viewport-" . $viewport2 ['index'] . "                { display: inherit !important;}\n";

            }
            $style .= "}\n";
          }
      }
    }
    file_put_contents (plugin_dir_path (__FILE__ ).'css/viewports.css', $style);

    for ($counter = 1; $counter <= AD_INSERTER_BLOCKS; $counter ++) {
      $obj = new ai_Block ($counter);
      $obj->load_options ($counter);
      $block_object [$counter] = $obj;
    }

    delete_option (str_replace ("#", "Header", AD_ADx_OPTIONS));
    delete_option (str_replace ("#", "Footer", AD_ADx_OPTIONS));
    delete_option (AD_OPTIONS);

    echo "<div class='updated' style='margin: 5px 15px 2px 0px; padding: 10px;'><strong>Settings saved.</strong></div>";

  } elseif (isset ($_POST [AI_FORM_CLEAR])) {

      check_admin_referer ('save_adinserter_settings');

      $ai_options = array ();

      for ($block = 1; $block <= AD_INSERTER_BLOCKS; $block ++) {
        $ad = new ai_Block ($block);
        $ai_options [$block] = $ad->wp_options;

        delete_option (str_replace ("#", $block, AD_ADx_OPTIONS));
      }

      $adH  = new ai_AdH();
      $adF  = new ai_AdF();

      $ai_options [AI_HEADER_OPTION_NAME] = $adH->wp_options;
      $ai_options [AI_FOOTER_OPTION_NAME] = $adF->wp_options;
      $ai_options [AI_GLOBAL_OPTION_NAME] = ai_check_plugin_options ();
      update_option (WP_OPTION_NAME, $ai_options);

      // Reload options
      ai_load_options ();

      for ($counter = 1; $counter <= AD_INSERTER_BLOCKS; $counter ++) {
        $obj = new ai_Block ($counter);
        $obj->load_options ($counter);
        $block_object [$counter] = $obj;
      }

      delete_option (str_replace ("#", "Header", AD_ADx_OPTIONS));
      delete_option (str_replace ("#", "Footer", AD_ADx_OPTIONS));
      delete_option (AD_OPTIONS);

      echo "<div class='error' style='margin: 5px 15px 2px 0px; padding: 10px;'>Settings cleared.</div>";
  }

  generate_settings_form ();
}


function adinserter ($ad_number = ""){
  global $block_object, $ad_interter_globals;

  if ($ad_number == "") return "";

  if (!is_numeric ($ad_number)) return "";

  $ad_number = (int) $ad_number;

  if ($ad_number < 1 || $ad_number > AD_INSERTER_BLOCKS) return "";

  // Load options from db
  $obj = $block_object [$ad_number];

  $globals_name = 'FUNCTION_CALL_COUNTER' . $ad_number;

  if (!isset ($ad_interter_globals [$globals_name])) {
    $ad_interter_globals [$globals_name] = 1;
  } else $ad_interter_globals [$globals_name] ++;

  $display_for_users = $obj->get_display_for_users ();

  if ($display_for_users == AD_DISPLAY_LOGGED_IN_USERS && !is_user_logged_in ()) return "";
  if ($display_for_users == AD_DISPLAY_NOT_LOGGED_IN_USERS && is_user_logged_in ()) return "";

  if ($obj->get_detection_server_side ()) {
    $display_for_devices = $obj->get_display_for_devices ();

    if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES && !AI_DESKTOP) return "";
    if ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES && !AI_MOBILE) return "";
    if ($display_for_devices == AD_DISPLAY_TABLET_DEVICES && !AI_TABLET) return "";
    if ($display_for_devices == AD_DISPLAY_PHONE_DEVICES && !AI_PHONE) return "";
    if ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES && !(AI_DESKTOP || AI_TABLET)) return "";
    if ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES && !(AI_DESKTOP || AI_PHONE)) return "";
  }

  if (!$obj->get_enable_php_call ()) return "";

  if (is_front_page ()){
    if (!$obj->get_display_settings_home()) return "";
  } else  if (is_single ()) {
    if (!$obj->get_display_settings_post ()) return "";

    $meta_value = get_post_meta (get_the_ID (), '_adinserter_block_exceptions', true);
    $selected_blocks = explode (",", $meta_value);

    $enabled_on_text = $obj->get_ad_enabled_on_which_posts ();
    if ($enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED) {
      if (in_array ($obj->number, $selected_blocks)) return "";
    }
    elseif ($enabled_on_text == AD_ENABLED_ONLY_ON_SELECTED) {
      if (!in_array ($obj->number, $selected_blocks)) return "";
    }
  } elseif (is_page ()) {
    if (!$obj->get_display_settings_page ()) return "";

    $meta_value = get_post_meta (get_the_ID (), '_adinserter_block_exceptions', true);
    $selected_blocks = explode (",", $meta_value);

    $enabled_on_text = $obj->get_ad_enabled_on_which_pages ();
    if ($enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED) {
      if (in_array ($obj->number, $selected_blocks)) return "";
    }
    elseif ($enabled_on_text == AD_ENABLED_ONLY_ON_SELECTED) {
      if (!in_array ($obj->number, $selected_blocks)) return "";
    }
  } elseif (is_category()){
    if (!$obj->get_display_settings_category()) return "";
  } elseif (is_search()){
    if (!$obj->get_display_settings_search()) return "";
  } elseif (is_archive()){
    if (!$obj->get_display_settings_archive()) return "";
  } elseif (is_404()){
    if (!$obj->get_enable_404()) return "";
  }

  if ($obj->get_ad_data() == AD_EMPTY_DATA) return "";

  if (!$obj->check_category ()) return "";

  if (!$obj->check_tag ()) return "";

  if (!$obj->check_url ()) return "";

  if (!$obj->check_date ()) return "";

  if (!$obj->check_referer ()) return "";

  $counter_settings = $obj->get_call_filter();
  $numbers = array ();
  if (strpos ($counter_settings, ",") !== false) {
    $numbers = explode (",", $counter_settings);
  } else $numbers []= $counter_settings;
  if ($counter_settings != 0 && !in_array ($ad_interter_globals [$globals_name], $numbers)) return "";

  if (!$obj->check_and_increment_block_counter ()) return "";

  $block_class_name = get_block_class_name ();

  if ($obj->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) $ad_code = ai_getAdCode ($obj); else
    $ad_code = "<div class='" . $block_class_name . " " . $block_class_name . "-" . $ad_number. $obj->get_viewport_classes () . "' style='" . $obj->get_alignmet_style() . "'>" . ai_getAdCode ($obj) . "</div>";

  return $ad_code;
}


function ai_content_hook ($content = ''){
  global $block_object, $ad_interter_globals;

  if (!isset ($ad_interter_globals ['CONTENT_COUNTER'])) {
    $ad_interter_globals ['CONTENT_COUNTER'] = 1;
  } else $ad_interter_globals ['CONTENT_COUNTER'] ++;

  $tag_debugging = get_tag_debugging ();

  if ($tag_debugging != AI_OPTION_BEFORE_PROCESSING || !is_user_logged_in ())
  for ($counter = 1; $counter <= AD_INSERTER_BLOCKS; $counter ++) {
    $obj = $block_object [$counter];

    $display_type = $obj->get_display_type();

    if ($display_type != AD_SELECT_BEFORE_PARAGRAPH &&
        $display_type != AD_SELECT_AFTER_PARAGRAPH &&
        $display_type != AD_SELECT_BEFORE_CONTENT &&
        $display_type != AD_SELECT_AFTER_CONTENT) continue;

    $display_for_users = $obj->get_display_for_users ();

    if ($display_for_users == AD_DISPLAY_LOGGED_IN_USERS && !is_user_logged_in ()) continue;
    if ($display_for_users == AD_DISPLAY_NOT_LOGGED_IN_USERS && is_user_logged_in ()) continue;

    if ($obj->get_detection_server_side ()) {
      $display_for_devices = $obj->get_display_for_devices ();

      if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES && !AI_DESKTOP) continue;
      if ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES && !AI_MOBILE) continue;
      if ($display_for_devices == AD_DISPLAY_TABLET_DEVICES && !AI_TABLET) continue;
      if ($display_for_devices == AD_DISPLAY_PHONE_DEVICES && !AI_PHONE) continue;
      if ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES && !(AI_DESKTOP || AI_TABLET)) continue;
      if ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES && !(AI_DESKTOP || AI_PHONE)) continue;
    }

    //if empty data, continue with next block
    if ($obj->get_ad_data() == AD_EMPTY_DATA) {
      continue;
    }

    $blog_page = false;

    if (is_single ()) {
      if (!$obj->get_display_settings_post ()) continue;

      $meta_value = get_post_meta (get_the_ID (), '_adinserter_block_exceptions', true);
      $selected_blocks = explode (",", $meta_value);

      $enabled_on_text = $obj->get_ad_enabled_on_which_posts ();
      if ($enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED) {
        if (in_array ($obj->number, $selected_blocks)) continue;
      }
      elseif ($enabled_on_text == AD_ENABLED_ONLY_ON_SELECTED) {
        if (!in_array ($obj->number, $selected_blocks)) continue;
      }
    } elseif (is_page ()) {
      if (!$obj->get_display_settings_page ()) continue;

      $meta_value = get_post_meta (get_the_ID (), '_adinserter_block_exceptions', true);
      $selected_blocks = explode (",", $meta_value);

      $enabled_on_text = $obj->get_ad_enabled_on_which_pages ();
      if ($enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED) {
        if (in_array ($obj->number, $selected_blocks)) continue;
      }
      elseif ($enabled_on_text == AD_ENABLED_ONLY_ON_SELECTED) {
        if (!in_array ($obj->number, $selected_blocks)) continue;
      }
    }
    elseif (is_front_page ()){
      if (!$obj->get_display_settings_home()) continue;
      $blog_page = true;
    }
    elseif (is_category()){
      if (!$obj->get_display_settings_category()) continue;
      $blog_page = true;
    }
    elseif (is_search()){
      if (!$obj->get_display_settings_search()) continue;
      $blog_page = true;
    }
    elseif (is_archive()){
      if (!$obj->get_display_settings_archive()) continue;
      $blog_page = true;
    }
    elseif (is_404()){
      if (!$obj->get_enable_404()) continue;
    }

    if ($blog_page) {
      $counter_settings = $obj->get_call_filter();
      $numbers = array ();
      if (strpos ($counter_settings, ",") !== false) {
        $numbers = explode (",", $counter_settings);
      } else $numbers []= $counter_settings;
      if ($counter_settings != 0 && !in_array ($ad_interter_globals ['CONTENT_COUNTER'], $numbers)) continue;
    }

//    Deprecated
    if ($obj->display_disabled ($content)) continue;

    if (!$obj->check_category ()) continue;

    if (!$obj->check_tag ()) continue;

    if (!$obj->check_url ()) continue;

    if (!$obj->check_date ()) continue;

    if (!$obj->check_referer ()) continue;

    if (!$obj->check_block_counter ()) continue;

    $inserted = false;

    if ($display_type == AD_SELECT_BEFORE_PARAGRAPH) {
      $content = $obj->before_paragraph ($content, $inserted);
      if ($inserted) $obj->increment_block_counter ();
    }
    elseif ($display_type == AD_SELECT_AFTER_PARAGRAPH) {
      $content = $obj->after_paragraph ($content, $inserted);
      if ($inserted) $obj->increment_block_counter ();
    }
    elseif ($display_type == AD_SELECT_BEFORE_CONTENT) {
      $content = $obj->before_content ($content);
      $obj->increment_block_counter ();
    }
    elseif ($display_type == AD_SELECT_AFTER_CONTENT) {
      $content = $obj->after_content ($content);
      $obj->increment_block_counter ();
    }
  }

  if ($tag_debugging != AI_OPTION_DISABLED && is_user_logged_in ()) {
    $content = preg_replace ("/\r\n\r\n/", "\r\n\r\n<h6 style='display: block; font-family: Courier, \"Courier New\", monospace; font-weight: bold; font-size: 12px; border: 1px solid #000; padding: 2px; margin: 12px 0;'>\\r\\n\\r\\n</h6>", $content);

    $content = preg_replace ("/<p([^>]*?)>/i", "<h6 style='display: block; font-family: Courier, \"Courier New\", monospace; font-weight: bold; font-size: 12px; border: 1px solid blue; padding: 2px; margin: 12px 0;'>&lt;p$1&gt;</h6><p$1>", $content);
    $content = preg_replace ("/<div([^>]*?)>/i", "<h6 style='display: block; font-family: Courier, \"Courier New\", monospace; font-weight: bold; font-size: 12px; border: 1px solid #0a0; padding: 2px; margin: 12px 0;'>&lt;div$1&gt;</h6><div$1>", $content);
    $content = preg_replace ("/<(?!h6|a|br|strong|p|div)([a-z0-9]+)([^>]*?)>/i", "<h6 style='display: block; font-family: Courier, \"Courier New\", monospace; font-weight: bold; font-size: 12px; border: 1px solid red; padding: 2px; margin: 12px 0;'>&lt;$1$2&gt;</h6><$1$2>", $content);

    $content = preg_replace ("/<\/p>/i", "</p><h6 style='display: block; font-family: Courier, \"Courier New\", monospace; font-weight: bold; font-size: 12px; border: 1px solid blue; padding: 2px; margin: 12px 0;'>&lt;/p&gt;</h6>", $content);
    $content = preg_replace ("/<\/div>/i", "</div><h6 style='display: block; font-family: Courier, \"Courier New\", monospace; font-weight: bold; font-size: 12px; border: 1px solid #0a0; padding: 2px; margin: 12px 0;'>&lt;/div&gt;</h6>", $content);
    $content = preg_replace ("/<\/(?!h6|a|br|strong|p|div)([a-z0-9]+)>/i", "</$1><h6 style='display: block; font-family: Courier, \"Courier New\", monospace; font-weight: bold; font-size: 12px; border: 1px solid red; padding: 2px; margin: 12px 0;'>&lt;/$1&gt;</h6>", $content);
  }

  return $content;
}

// Process Before/After Excerpt postion
function ai_excerpt_hook ($content = ''){
  global $ad_interter_globals, $block_object;

  if (strpos ($_SERVER ['REQUEST_URI'], '/wp-admin/') === 0) return;

  if (!isset ($ad_interter_globals ['EXCERPT'])) {
    $ad_interter_globals ['EXCERPT'] = 1;
  } else $ad_interter_globals ['EXCERPT'] ++;
  $excerpt_counter = $ad_interter_globals ['EXCERPT'];

  for ($block_index = 1; $block_index <= AD_INSERTER_BLOCKS; $block_index ++) {
    $obj = $block_object [$block_index];

    $display_type = $obj->get_display_type ();

    if ($display_type != AD_SELECT_BEFORE_EXCERPT && $display_type != AD_SELECT_AFTER_EXCERPT) continue;

    $display_for_users = $obj->get_display_for_users ();

    if ($display_for_users == AD_DISPLAY_LOGGED_IN_USERS && !is_user_logged_in ()) continue;
    if ($display_for_users == AD_DISPLAY_NOT_LOGGED_IN_USERS && is_user_logged_in ()) continue;

    if ($obj->get_detection_server_side ()) {
      $display_for_devices = $obj->get_display_for_devices ();

      if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES && !AI_DESKTOP) continue;
      if ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES && !AI_MOBILE) continue;
      if ($display_for_devices == AD_DISPLAY_TABLET_DEVICES && !AI_TABLET) continue;
      if ($display_for_devices == AD_DISPLAY_PHONE_DEVICES && !AI_PHONE) continue;
      if ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES && !(AI_DESKTOP || AI_TABLET)) continue;
      if ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES && !(AI_DESKTOP || AI_PHONE)) continue;
    }

    $counter_settings = $obj->get_call_filter();
    $numbers = array ();
    if (strpos ($counter_settings, ",") !== false) {
      $numbers = explode (",", $counter_settings);
    } else $numbers []= $counter_settings;

    if ($counter_settings != 0 && !in_array ($excerpt_counter, $numbers)) continue;

    if (is_front_page ()){
      if (!$obj->get_display_settings_home()) continue;
    }
    elseif (is_category()){
      if (!$obj->get_display_settings_category()) continue;
    }
    elseif (is_search()){
      if (!$obj->get_display_settings_search()) continue;
    }
    elseif (is_archive()){
      if (!$obj->get_display_settings_archive()) continue;
    }
    elseif (is_404()){
      if (!$obj->get_enable_404()) continue;
    }

    //if empty data, continue with next
    if ($obj->get_ad_data() == AD_EMPTY_DATA){
      continue;
    }

    // Deprecated
    if ($obj->display_disabled ($content)) continue;

    if (!$obj->check_category ()) continue;

    if (!$obj->check_tag ()) continue;

    if (!$obj->check_url ()) continue;

    if (!$obj->check_referer ()) continue;

    if (!$obj->check_and_increment_block_counter ()) continue;

    $block_class_name = get_block_class_name ();

    if ($obj->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) $ad_code = ai_getAdCode ($obj); else
      $ad_code = "<div class='" . $block_class_name . " " . $block_class_name . "-" . $block_index . $obj->get_viewport_classes () . "' style='" . $obj->get_alignmet_style() . "'>" . ai_getAdCode ($obj) . "</div>";

    if ($display_type == AD_SELECT_BEFORE_EXCERPT)
        $content = $ad_code . $content; else
          $content = $content . $ad_code;
  }

  return $content;
}

// Process Before / After Post postion

function ai_before_after_post ($query, $display_type){
  global $block_object, $ad_interter_globals;

  if (!method_exists ($query, 'is_main_query')) return;
  if (!$query->is_main_query()) return;
  if (is_feed()) return;
  if (strpos ($_SERVER ['REQUEST_URI'], '/wp-admin/') === 0) return;

  $globals_name = 'LOOP_COUNTER_'.str_replace (" ", "", $display_type);

  if (!isset ($ad_interter_globals [$globals_name])) {
    $ad_interter_globals [$globals_name] = 1;
  } else $ad_interter_globals [$globals_name] ++;

  $meta_value = get_post_meta (get_the_ID (), '_adinserter_block_exceptions', true);
  $selected_blocks = explode (",", $meta_value);

  $ad_code = "";

  for ($block_index = 1; $block_index <= AD_INSERTER_BLOCKS; $block_index ++) {
    $obj = $block_object [$block_index];

    if ($obj->get_display_type () != $display_type) continue;

    $display_for_users = $obj->get_display_for_users ();

    if ($display_for_users == AD_DISPLAY_LOGGED_IN_USERS && !is_user_logged_in ()) continue;
    if ($display_for_users == AD_DISPLAY_NOT_LOGGED_IN_USERS && is_user_logged_in ()) continue;

    if ($obj->get_detection_server_side ()) {
      $display_for_devices = $obj->get_display_for_devices ();

      if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES && !AI_DESKTOP) continue;
      if ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES && !AI_MOBILE) continue;
      if ($display_for_devices == AD_DISPLAY_TABLET_DEVICES && !AI_TABLET) continue;
      if ($display_for_devices == AD_DISPLAY_PHONE_DEVICES && !AI_PHONE) continue;
      if ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES && !(AI_DESKTOP || AI_TABLET)) continue;
      if ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES && !(AI_DESKTOP || AI_PHONE)) continue;
    }

    if (is_front_page ()){
      if (!$obj->get_display_settings_home()) continue;
    }
    elseif (is_page()){
      if (!$obj->get_display_settings_page()) continue;

      $enabled_on_text = $obj->get_ad_enabled_on_which_pages ();
      if ($enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED) {
        if (in_array ($obj->number, $selected_blocks)) continue;
      }
      elseif ($enabled_on_text == AD_ENABLED_ONLY_ON_SELECTED) {
        if (!in_array ($obj->number, $selected_blocks)) continue;
      }
    }
    elseif (is_single()){
      if (!$obj->get_display_settings_post()) continue;

      $enabled_on_text = $obj->get_ad_enabled_on_which_posts ();
      if ($enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED) {
        if (in_array ($obj->number, $selected_blocks)) continue;
      }
      elseif ($enabled_on_text == AD_ENABLED_ONLY_ON_SELECTED) {
        if (!in_array ($obj->number, $selected_blocks)) continue;
      }
    }
    elseif (is_category()){
      if (!$obj->get_display_settings_category()) continue;
    }
    elseif (is_search()){
      if (!$obj->get_display_settings_search()) continue;
    }
    elseif (is_archive()){
      if (!$obj->get_display_settings_archive()) continue;
    }
    elseif (is_404()){
      if (!$obj->get_enable_404()) continue;
    }

    //if empty data, continue with next
    if ($obj->get_ad_data() == AD_EMPTY_DATA) continue;

    if (!$obj->check_category ()) continue;

    if (!$obj->check_tag ()) continue;

    if (!$obj->check_url ()) continue;

    if (!$obj->check_date ()) continue;

    if (!$obj->check_referer ()) continue;

    $counter_settings = $obj->get_call_filter();
    $numbers = array ();
    if (strpos ($counter_settings, ",") !== false) {
      $numbers = explode (",", $counter_settings);
    } else $numbers []= $counter_settings;
    if ($counter_settings != 0 && !in_array ($ad_interter_globals [$globals_name], $numbers)) continue;

    if (!$obj->check_and_increment_block_counter ()) continue;

    $block_class_name = get_block_class_name ();

    if ($obj->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) $ad_code .= ai_getAdCode ($obj); else
      $ad_code .= "<div class='" . $block_class_name . " " . $block_class_name . "-" . $block_index . $obj->get_viewport_classes () . "' style='" . $obj->get_alignmet_style() . "'>" . ai_getAdCode ($obj) . "</div>";
  }

  echo $ad_code;
}

// Process Before Post postion
function ai_loop_start_hook ($query){
  ai_before_after_post ($query, AD_SELECT_BEFORE_POST);
}


// Process After Post postion
function ai_loop_end_hook ($query){
  ai_before_after_post ($query, AD_SELECT_AFTER_POST);
}


function ai_getCode ($obj){
  $code = $obj->get_ad_data();

  if ($obj->get_process_php ()) {
    ob_start ();
    eval ("?>". $code . "<?php ");
    $code = ob_get_clean ();
  }

  return $code;
}


function ai_getAdCode ($obj){

  $ad_code = $obj->get_ad_data_replaced();

  if ($obj->get_process_php ()) {
    ob_start ();
    eval ("?>". $ad_code . "<?php ");
    $ad_code = ob_get_clean ();
  }

  if (strpos ($ad_code, AD_SEPARATOR) !== false) {
    $ads = explode (AD_SEPARATOR, $ad_code);
    $ad_code = $ads [rand (0, sizeof ($ads) - 1)];
  }

  return do_shortcode ($ad_code);
}


function process_shortcodes ($atts) {
  global $block_object;

  $parameters = shortcode_atts (array (
    "block" => "",
    "name" => "",
    "ignore" => "",
  ), $atts);
  if (is_numeric ($parameters ['block'])) $block = intval ($parameters ['block']); else $block = 0;
  if ($block < 1 && $block > AD_INSERTER_BLOCKS) {
    $block = 0;
  } elseif ($parameters ['name'] != '') {
      $shortcode_name = strtolower ($parameters ['name']);
      for ($counter = 1; $counter <= AD_INSERTER_BLOCKS; $counter ++) {
        $obj = $block_object [$counter];
        $ad_name = strtolower (trim ($obj->get_ad_name()));
        if ($shortcode_name == $ad_name) {
          $block = $counter;
          break;
        }
      }
    }

  if ($block == 0) return "";

//  IGNORE SETTINGS
//  page_type
//  *block_counter

  $ignore_array = array ();
  if (trim ($parameters ['ignore']) != '') {
    $ignore_array = explode (",", str_replace (" ", "", $parameters ['ignore']));
  }

  $obj = $block_object [$block];

  if (!$obj->get_enable_manual ()) return "";

  $display_for_users = $obj->get_display_for_users ();

  if ($display_for_users == AD_DISPLAY_LOGGED_IN_USERS && !is_user_logged_in ()) return "";
  if ($display_for_users == AD_DISPLAY_NOT_LOGGED_IN_USERS && is_user_logged_in ()) return "";

  if ($obj->get_detection_server_side ()) {
    $display_for_devices = $obj->get_display_for_devices ();

    if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES && !AI_DESKTOP) return "";
    if ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES && !AI_MOBILE) return "";
    if ($display_for_devices == AD_DISPLAY_TABLET_DEVICES && !AI_TABLET) return "";
    if ($display_for_devices == AD_DISPLAY_PHONE_DEVICES && !AI_PHONE) return "";
    if ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES && !(AI_DESKTOP || AI_TABLET)) return "";
    if ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES && !(AI_DESKTOP || AI_PHONE)) return "";
  }

  if (is_front_page ()){
    if (!$obj->get_display_settings_home() && !in_array ("page_type", $ignore_array)) return "";
  } else  if (is_single ()) {
    if (!$obj->get_display_settings_post () && !in_array ("page_type", $ignore_array)) return "";
    if (!$obj->check_date ()) return "";

    //// Exceptions are only for automatic insertion
//        $meta_value = get_post_meta (get_the_ID (), '_adinserter_block_exceptions', true);
//        $selected_blocks = explode (",", $meta_value);

//        $enabled_on_text = $obj->get_ad_enabled_on_which_posts ();
//        if ($enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED) {
//          if (in_array ($obj->number, $selected_blocks)) return "";
//        }
//        elseif ($enabled_on_text == AD_ENABLED_ONLY_ON_SELECTED) {
//          if (!in_array ($obj->number, $selected_blocks)) return "";
//        }
    ////

  } elseif (is_page ()) {
    if (!$obj->get_display_settings_page () && !in_array ("page_type", $ignore_array)) return "";
    if (!$obj->check_date ()) return "";

    //// Exceptions are only for automatic insertion
//        $meta_value = get_post_meta (get_the_ID (), '_adinserter_block_exceptions', true);
//        $selected_blocks = explode (",", $meta_value);

//        $enabled_on_text = $obj->get_ad_enabled_on_which_pages ();
//        if ($enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED) {
//          if (in_array ($obj->number, $selected_blocks)) return "";
//        }
//        elseif ($enabled_on_text == AD_ENABLED_ONLY_ON_SELECTED) {
//          if (!in_array ($obj->number, $selected_blocks)) return "";
//        }
    ////

  } elseif (is_category()){
    if (!$obj->get_display_settings_category() && !in_array ("page_type", $ignore_array)) return "";
  } elseif (is_search()){
    if (!$obj->get_display_settings_search() && !in_array ("page_type", $ignore_array)) return "";
  } elseif (is_archive()){
    if (!$obj->get_display_settings_archive() && !in_array ("page_type", $ignore_array)) return "";
  } elseif (is_404()){
    if (!$obj->get_enable_404() && !in_array ("page_type", $ignore_array)) return "";
  }

  if (!$obj->check_url ()) return "";

  if (!$obj->check_referer ()) return "";

  if (!$obj->check_category ()) return "";

  if (!$obj->check_tag ()) return "";

  if (!$obj->check_and_increment_block_counter ()) return "";

  $block_class_name = get_block_class_name ();

  if ($obj->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) $ad_code = ai_getAdCode ($obj); else
    $ad_code = "<div class='" . $block_class_name . " " . $block_class_name . "-" . $block . $obj->get_viewport_classes () . "' style='" . $obj->get_alignmet_style() . "'>" . ai_getAdCode ($obj) . "</div>";
  return ($ad_code);
}


class ai_widget extends WP_Widget {

  function __construct () {
    parent::__construct (
      false,                                  // Base ID
      AD_INSERTER_TITLE,                      // Name
      array (                                 // Args
        'classname'   => 'ai_widget',
        'description' => AD_INSERTER_TITLE.' code block widget.')
    );
  }

  function widget ($args, $instance) {
    global $block_object;

    // Widget output

    $title = !empty ($instance ['widget-title']) ? $instance ['widget-title'] : '';
    $block = !empty ($instance ['block']) ? $instance ['block'] : 1;

    $ad = $block_object [$block];
    ai_widget_draw ($block, $ad, $args, $title);
  }

  function form ($instance) {
    global $block_object;

    // Output admin widget options form

    $widget_title = !empty ($instance ['widget-title']) ? $instance ['widget-title'] : '';
    $block = !empty ($instance ['block']) ? $instance ['block'] : 1;

    $obj = $block_object [$block];

    $title = '[' . $block . '] ' . $obj->get_ad_name();
    if (!empty ($widget_title)) $title .= ' - ' . $widget_title;

    if (!$obj->get_enable_widget ()) $title .= ' - DISABLED'

    ?>
    <input id="<?php echo $this->get_field_id ('title'); ?>" name="<?php echo $this->get_field_name ('title'); ?>" type="hidden" value="<?php echo esc_attr ($title); ?>">

    <p>
      <label for="<?php echo $this->get_field_id ('widget-title'); ?>">Title:</label>
      <input id="<?php echo $this->get_field_id ('widget-title'); ?>" name="<?php echo $this->get_field_name ('widget-title'); ?>" type="text" value="<?php echo esc_attr ($widget_title); ?>" style="width: 90%;">
    </p>

    <p>
      <label for="<?php echo $this->get_field_id ('block'); ?>">Block:</label>
      <select id="<?php echo $this->get_field_id ('block'); ?>" name="<?php echo $this->get_field_name('block'); ?>" style="width: 88%;">
        <?php
          for ($block_index = 1; $block_index <= AD_INSERTER_BLOCKS; $block_index ++) {
            $obj = $block_object [$block_index];
        ?>
        <option value='<?php echo $block_index; ?>' <?php if ($block_index == $block) echo 'selected="selected"'; ?>><?php echo $obj->get_ad_name(), !$obj->get_enable_widget ()? ' - DISABLED' : ''; ?></option>
        <?php } ?>
      </select>
    </p>

    <?php
    $url_parameters = "";
    if (function_exists ('ai_settings_url_parameters')) $url_parameters = ai_settings_url_parameters ($block);

    echo "<p><a href='", admin_url ('options-general.php?page=ad-inserter.php'), $url_parameters, "&tab=", $block, "'>Settings</a></p>";
  }

  function update ($new_instance, $old_instance) {
    // Save widget options
    $instance = $old_instance;

    $instance ['widget-title'] = (!empty ($new_instance ['widget-title'])) ? strip_tags ($new_instance ['widget-title']) : '';
    $instance ['title'] = (!empty ($new_instance ['title'])) ? strip_tags ($new_instance ['title']) : '';
    $instance ['block'] = (!empty ($new_instance ['block'])) ? $new_instance ['block'] : 1;

    return $instance;
  }
}


function ai_widget_draw ($block, $obj, $args, $title = '') {
  global $ad_interter_globals;

  if (!isset ($ad_interter_globals ['WIDGET_COUNTER_'.$block])) {
    $ad_interter_globals ['WIDGET_COUNTER_'.$block] = 1;
  } else $ad_interter_globals ['WIDGET_COUNTER_'.$block] ++;

  if (!$obj->get_enable_widget ()) return;

  $display_for_users = $obj->get_display_for_users ();

  if ($display_for_users == AD_DISPLAY_LOGGED_IN_USERS && !is_user_logged_in ()) return;
  if ($display_for_users == AD_DISPLAY_NOT_LOGGED_IN_USERS && is_user_logged_in ()) return;

  if ($obj->get_detection_server_side ()) {
    $display_for_devices = $obj->get_display_for_devices ();

    if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES && !AI_DESKTOP) return;
    if ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES && !AI_MOBILE) return;;
    if ($display_for_devices == AD_DISPLAY_TABLET_DEVICES && !AI_TABLET) return;
    if ($display_for_devices == AD_DISPLAY_PHONE_DEVICES && !AI_PHONE) return;
    if ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES && !(AI_DESKTOP || AI_TABLET)) return;
    if ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES && !(AI_DESKTOP || AI_PHONE)) return;
  }

  //if empty data, continue next
  if($obj->get_ad_data()==AD_EMPTY_DATA){
     return;
  }

  if(is_front_page ()){
     if (!$obj->get_display_settings_home()) return;
  }
  elseif(is_page()){
     if (!$obj->get_display_settings_page()) return;

     $meta_value = get_post_meta (get_the_ID (), '_adinserter_block_exceptions', true);
     $selected_blocks = explode (",", $meta_value);

     $enabled_on_text = $obj->get_ad_enabled_on_which_pages ();
     if ($enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED) {
       if (in_array ($obj->number, $selected_blocks)) return;
     }
     elseif ($enabled_on_text == AD_ENABLED_ONLY_ON_SELECTED) {
       if (!in_array ($obj->number, $selected_blocks)) return;
     }
  }
  elseif(is_single()){
     if (!$obj->get_display_settings_post()) return;

     $meta_value = get_post_meta (get_the_ID (), '_adinserter_block_exceptions', true);
     $selected_blocks = explode (",", $meta_value);

     $enabled_on_text = $obj->get_ad_enabled_on_which_posts ();
     if ($enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED) {
       if (in_array ($obj->number, $selected_blocks)) return;
     }
     elseif ($enabled_on_text == AD_ENABLED_ONLY_ON_SELECTED) {
       if (!in_array ($obj->number, $selected_blocks)) return;
     }
  }
  elseif(is_category()){
     if (!$obj->get_display_settings_category()) return;
  }
  elseif(is_search()){
     if (!$obj->get_display_settings_search()) return;
  }
  elseif(is_archive()){
     if (!$obj->get_display_settings_archive()) return;
  }
  elseif (is_404()){
    if (!$obj->get_enable_404()) return;
  }

  if (!$obj->check_category ()) return;

  if (!$obj->check_tag ()) return;

  if (!$obj->check_url ()) return;

  if (!$obj->check_referer ()) return;

  $counter_settings = $obj->get_call_filter();
  $numbers = array ();
  if (strpos ($counter_settings, ",") !== false) {
    $numbers = explode (",", $counter_settings);
  } else $numbers []= $counter_settings;
  if ($counter_settings != 0 && !in_array ($ad_interter_globals ['WIDGET_COUNTER_'.$block], $numbers)) return;

  if (!$obj->check_and_increment_block_counter ()) return;

  $block_class_name = get_block_class_name ();

  $viewport_classes = $obj->get_viewport_classes ();
  if ($viewport_classes != "") echo "<div class='" . $viewport_classes . "'>";
  echo $args ['before_widget'];

  if (!empty ($title)) {
    echo $args ['before_title'], apply_filters ('widget_title', $title), $args ['after_title'];
  }

  if ($obj->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) echo ai_getAdCode ($obj); else
    echo "<div class='" . $block_class_name . " " . $block_class_name . "-" . $block . "' style='" . $obj->get_alignmet_style (0) . "'>" . ai_getAdCode ($obj) . "</div>";

  echo $args ['after_widget'];
  if ($viewport_classes != "") echo "</div>";
}
