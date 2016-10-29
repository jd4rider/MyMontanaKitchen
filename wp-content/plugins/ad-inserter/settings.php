<?php

require_once AD_INSERTER_PLUGIN_DIR.'constants.php';

function generate_settings_form (){
  global $ai_db_options, $block_object;

  $save_url = $_SERVER ['REQUEST_URI'];
  if (isset ($_GET ['tab'])) {
    $save_url = preg_replace ("/&tab=\d+/", "", $save_url);
  }

  $subpage = 'main';
  $start =  1;
  $end   = 16;
  if (function_exists ('ai_settings_parameters')) ai_settings_parameters ($subpage, $start, $end);

  if (isset ($_GET ['tab'])) $active_tab = $_GET ['tab']; else
    $active_tab = isset ($_POST ['ai-active-tab']) ? $_POST ['ai-active-tab'] : 1;
  if (!is_numeric ($active_tab)) $active_tab = 1;
  if ($active_tab != 0)
    if ($active_tab < $start || $active_tab > $end) $active_tab = $start;

  $adH  = new ai_AdH();
  $adF  = new ai_AdF();

  $adH->load_options (AI_HEADER_OPTION_NAME);
  $adF->load_options (AI_FOOTER_OPTION_NAME);

  $syntax_highlighter_theme = get_syntax_highlighter_theme ();
  $block_class_name         = get_block_class_name ();
  $tag_debugging            = get_tag_debugging ();

?>
<style>
.nav-tab {
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
}
.nav-tab-active, .nav-tab-active:hover {
  background: #fff;
}
.exceptions a {
  text-decoration: none;
}
.exceptions th.page {
  text-align: left;
}
.exceptions td.page {
  padding-right: 20px;
}
.exceptions td.id {
  padding-right: 10px;
  text-align: right;
}
.exceptions th.block, .exceptions td.block {
  text-align: center;
  width: 20px;
}

.small-button .ui-button-text-only .ui-button-text {
   padding: 0;
}
.responsive-table td {
  white-space: nowrap;
}
</style>

<div id="ai-settings" style="margin-right: 16px; float: left; ">

  <div style="width: 735px; padding: 2px 8px 2px 8px; margin: 8px 0 8px 0; border: 1px solid rgb(221, 221, 221); border-radius: 5px;">
<?php
  if (function_exists ('ai_settings_header')) ai_settings_header (); else { ?>
    <div style="float: right; text-align: right; margin: 8px 18px 0px 0;">
        <a style="text-decoration: none;" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LHGZEMRTR7WB4" target="_blank">Donate</a> to support free Ad Inserter development
        or <a style="text-decoration: none;" href="http://tinymonitor.com/ad-inserter-pro" target="_blank"><span style="font-weight: bold; color: #80f;">Go Pro</span></a> to get more than 16 blocks.
    </div>
    <div style="float: right; text-align: right; margin: 0px 18px 0px 0;">
        <a style="text-decoration: none;" href="http://tinymonitor.com/ad-inserter" target="_blank">Documentation</a> :: If you like Ad Inserter please write a nice review on the <a style="text-decoration: none;" href="https://wordpress.org/support/view/plugin-reviews/ad-inserter" target="_blank">Reviews</a> page.
    </div>
    <h2><?php echo AD_INSERTER_TITLE . ' ' . AD_INSERTER_VERSION ?></h2>
<?php
  }
?>
  </div>

<?php
  if ($subpage == 'exceptions') {
?>
<form action="<?php echo $save_url; ?>" method="post" id="ai-form" name="ai_form" style="float: left;" blocks="<?php echo AD_INSERTER_BLOCKS; ?>">
<div id="ai-exceptions" style="padding: 8px 8px 8px 8px; border: 1px solid rgb(221, 221, 221); border-radius: 5px;">

  <table class="exceptions">
    <tbody>
    <?php

      $pages = get_pages ();
      $posts_pages = array ('pages' => $pages);

      $args = array( 'posts_per_page' => -1);
      $posts_pages ['posts'] = get_posts ($args);

      $table_header = '<tr><th class="id">ID</th><th class="page">Page / Post</th>';
      for ($block = 1; $block <= AD_INSERTER_BLOCKS; $block ++) {
        $table_header .= '<th class="block">' . $block . '</th>';
      }
      $table_header .= '</tr>';

      $header_written = false;
      foreach ($posts_pages as $type => $post_page) {
        foreach ($post_page as $page) {
          $post_meta = get_post_meta ($page->ID, '_adinserter_block_exceptions', true);
          if ($post_meta == '') continue;
          $selected_blocks = explode (",", $post_meta);

          if (!$header_written) {
            echo $table_header;
            $header_written = true;
          }
          echo '<tr><td class="id"><a href="', get_edit_post_link ($page->ID), '" target="_blank" title="Edit">', $page->ID, '</a></td>
               <td class="page"><a href="', get_permalink ($page->ID), '" target="_blank" title="View">', $page->post_title, '</a></td>';

          for ($block = 1; $block <= AD_INSERTER_BLOCKS; $block ++) {

            $obj = $block_object [$block];
            if ($type == 'posts') {
              $enabled_on_text  = $obj->get_ad_enabled_on_which_posts ();
              $general_enabled  = $obj->get_display_settings_post();
            } else {
                $enabled_on_text = $obj->get_ad_enabled_on_which_pages ();
                $general_enabled = $obj->get_display_settings_page();
              }

            $individual_option_enabled  = $general_enabled && ($enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED || $enabled_on_text == AD_ENABLED_ONLY_ON_SELECTED);
            $individual_text_enabled    = $enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED;

            echo '<td class="block">', /*$individual_option_enabled && */in_array ($block, $selected_blocks) ? ($individual_text_enabled? '&cross;' : '&check;') : '', '</td>';
          }

          echo '<tr>';
        }
      }
    ?>
    </tbody>
  </table>

</div>
<?php wp_nonce_field ('save_adinserter_settings'); ?>
</form>
<?php
  } else {
      if (function_exists ('ai_settings_ranges')) ai_settings_ranges ($active_tab);
?>
<form action="<?php echo $save_url; ?>" method="post" id="ai-form" name="ai_form" style="float: left;" start="<?php echo $start; ?>" end="<?php echo $end; ?>">
<div id="ai-tab-container" style="width: 735px; padding: 8px 8px 8px 8px; border: 1px solid rgb(221, 221, 221); border-radius: 5px;">
  <div id="dummy-tabs" style="height: <?php echo 29; ?>px; padding: .2em .2em 0;"></div>
  <ul id="ai-tabs" style="display: none;">
<?php

  $sidebar_widgets = wp_get_sidebars_widgets();
  $widget_options = get_option ('widget_ai_widget');

  $sidebars_with_widgets = array ();
  for ($ad_number = $start; $ad_number <= $end; $ad_number ++){
    $sidebars_with_widget [$ad_number]= array ();
  }
  foreach ($sidebar_widgets as $sidebar_index => $sidebar_widget) {
    if (is_array ($sidebar_widget) && isset ($GLOBALS ['wp_registered_sidebars'][$sidebar_index]['name'])) {
      $sidebar_name = $GLOBALS ['wp_registered_sidebars'][$sidebar_index]['name'];
      if ($sidebar_name != "") {
        foreach ($sidebar_widget as $widget) {
          if (preg_match ("/ai_widget-([\d]+)/", $widget, $widget_id)) {
            if (isset ($widget_id [1]) && is_numeric ($widget_id [1])) {
              $widget_option = $widget_options [$widget_id [1]];
              $widget_block = $widget_option ['block'];
              if ($widget_block >= $start && $widget_block <= $end && !in_array ($sidebar_name, $sidebars_with_widget [$widget_block])) {
                $sidebars_with_widget [$widget_block] []= $sidebar_name;
              }
            }
          }
        }
      }
    }
  }

  $manual_widget        = array ();
  $manual_shortcode     = array ();
  $manual_php_function  = array ();
  $manual               = array ();
  $sidebars             = array ();

  for ($ad_number = $start; $ad_number <= $end; $ad_number ++){
    $obj = $block_object [$ad_number];

    $manual_widget        [$ad_number] = $obj->get_enable_widget()    == AD_SETTINGS_CHECKED;
    $manual_shortcode     [$ad_number] = $obj->get_enable_manual()    == AD_SETTINGS_CHECKED;
    $manual_php_function  [$ad_number] = $obj->get_enable_php_call()  == AD_SETTINGS_CHECKED;
    $manual               [$ad_number] = ($manual_widget [$ad_number] && !empty ($sidebars_with_widget [$ad_number])) || $manual_shortcode [$ad_number] || $manual_php_function [$ad_number];

    $ad_name = $obj->get_ad_name();
    $automatic = $obj->get_display_type() != AD_SELECT_NONE;

    $ad_name_functions = false;
    if ($automatic) {
      $ad_name .= ": ".$obj->get_display_type();
      $ad_name_functions = true;
    }

    $style = "";

    if ($automatic && $manual [$ad_number]) $style = "font-weight: bold; color: #c4f;";
    elseif ($automatic) $style = "font-weight: bold; color: #e44;";
    elseif ($manual [$ad_number]) $style = "font-weight: bold; color: #66f;";

    if (!empty ($sidebars_with_widget [$ad_number])) $sidebars [$ad_number] = implode (", ", $sidebars_with_widget [$ad_number]); else $sidebars [$ad_number] = "";
    if ($manual_widget [$ad_number]) {
      if ($sidebars [$ad_number] != "") {
        $ad_name .= $ad_name_functions ? ", " : ": ";
        $ad_name .= "Widget used in: [".$sidebars [$ad_number]."]";
        $ad_name_functions = true;
      }
    } else {
        if (!empty ($sidebars_with_widget [$ad_number])) {
          $ad_name .= $ad_name_functions ? ", " : ": ";
          $ad_name .= "Widget DISABLED but used in: [".$sidebars [$ad_number]."]";
          $ad_name_functions = true;
        }
      }

    if ($manual_shortcode     [$ad_number]) {
      $ad_name .= $ad_name_functions ? ", " : ": ";
      $ad_name .= "Shortcode";
      $ad_name_functions = true;
    }
    if ($manual_php_function  [$ad_number]) {
      $ad_name .= $ad_name_functions ? ", " : ": ";
      $ad_name .= "PHP function";
      $ad_name_functions = true;
    }

    echo "
      <li id=\"ai-tab$ad_number\" class=\"ai-tab\" title=\"$ad_name\"><a href=\"#tab-$ad_number\"><span style=\"", $style, "\">$ad_number</span></a></li>";

  }

  $title_hf = "";
  if ($adH->get_enable_manual () && $adH->get_ad_data() != "") $title_hf .= ", Header code";
  if ($adF->get_enable_manual () && $adF->get_ad_data() != "") $title_hf .= ", Footer code";

  if (($adH->get_enable_manual () && $adH->get_ad_data() != "") ||
      ($adF->get_enable_manual () && $adF->get_ad_data() != ""))
    $style_hf = "font-weight: bold; color: #e44;"; else $style_hf = "";
?>
      <li id="ai-tab0" class="ai-tab" title="Ad Inserter Settings<?php echo $title_hf ?>"><a href="#tab-0"><span style="<?php echo $style_hf ?>">#</span></a></li>
  </ul>

<?php
  for ($ad_number = $start; $ad_number <= $end; $ad_number ++){
    $obj = $block_object [$ad_number];

    $show_devices = $obj->get_detection_client_side () == AD_SETTINGS_CHECKED || $obj->get_detection_server_side () == AD_SETTINGS_CHECKED;
    if ($show_devices) $devices_style = "font-weight: bold; color: #66f;"; else $devices_style = "";

    $cat_list = $obj->get_ad_block_cat();
    $tag_list = $obj->get_ad_block_tag();
    $url_list = $obj->get_ad_url_list();
    $domain_list = $obj->get_ad_domain_list();
    $show_lists = $cat_list != '' || $tag_list != '' || $url_list != '' || $domain_list != '';
    if ($show_lists) $lists_style = "font-weight: bold; color: #66f;"; else $lists_style = "";

    $show_manual = $manual [$ad_number];
    if ($show_manual) $manual_style = "font-weight: bold; color: " . ($manual_widget [$ad_number] || empty ($sidebars_with_widget [$ad_number]) ? "#66f;" : "#e44;"); else $manual_style = "";

    $show_misc = $obj->get_maximum_insertions () != 0 || $obj->get_call_filter() != 0 || $obj->get_display_for_users() != AD_DISPLAY_ALL_USERS;
    if ($show_misc) $misc_style = "font-weight: bold; color: #66f;"; else $misc_style = "";

    $save_button_text = "Save All Settings";
?>

<div id="tab-<?php echo $ad_number; ?>" style="padding: 0;">
  <div style="padding: 10px 0 0 4px;">
    <h3><?php echo $ad_number, ".  ", $obj->get_ad_name(); ?></h3>
  </div>

  <div style="float: right; padding: 1px 5px;">
<?php if (function_exists ('ai_settings_buttons')) ai_settings_buttons ($ad_number, $save_button_text, $start, $end); ?>
      <input style="display: none; border-radius: 5px; font-weight: bold;" name="<?php echo AI_FORM_SAVE; ?>" value="<?php echo $save_button_text; ?>" type="submit" />
  </div>

  <div style="padding:0px 8px 16px 16px;">
     Block Name:  <input style="border-radius: 5px;" type="text" name="<?php echo AI_OPTION_NAME, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="<?php echo $obj->get_ad_name() ?>" size="56" maxlength="100" />
  </div>

<?php if (function_exists ('ai_settings_container')) ai_settings_container ($ad_number, $obj); ?>

  <div style="display: inline-block; padding: 1px 10px; float: right;">
   <input type="hidden"   style="border-radius: 5px;" name="<?php echo AI_OPTION_PROCESS_PHP, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="0" />
   <input type="checkbox" style="border-radius: 5px;" name="<?php echo AI_OPTION_PROCESS_PHP, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="1" id="process-php-<?php echo $ad_number; ?>" <?php if ($obj->get_process_php () == AD_SETTINGS_CHECKED) echo 'checked '; ?> />
   <label for="process-php-<?php echo $ad_number; ?>" title="Process PHP code in block">Process PHP</label>
  </div>

  <div style="display: inline-block; padding: 1px 10px; float: right;">
    <input type="checkbox" style="border-radius: 5px;" value="0" id="simple-editor-<?php echo $ad_number; ?>" />
    <label for="simple-editor-<?php echo $ad_number; ?>" title="Toggle Syntax Highlighting / Simple editor for mobile devices">Simple editor</label>
  </div>

  <div style="padding-left:16px;">
      HTML / Javascript / PHP code (separate rotating versions with |rotate| )
  </div>

  <div style="padding:8px;">
      <textarea id="block-<?php echo $ad_number; ?>" name="<?php echo AI_OPTION_CODE, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" style="background-color:#F9F9F9; font-family: Courier, 'Courier New', monospace; font-weight: bold; width: 719px; height: 384px;"><?php echo esc_textarea ($obj->get_ad_data()); ?></textarea>
  </div>

  <div style="padding:8px 8px 8px 8px;">
<!--    <div style="float: left;">-->
<!--      <button id="preview-button-<?php echo $ad_number; ?>" type="button" style="display: none; margin-right: 0px;" title="Preview saved code above" nonce="<?php echo wp_create_nonce ("adinserter_preview"); ?>">Preview</button>-->
<!--    </div>-->
    <div style="float: right;">
      <button id="misc-button-<?php echo $ad_number; ?>" type="button" style="display: none; margin-right: 0px;" title="Limit / filter insertions, general tag, check for logged-in users"><span style="<?php echo $misc_style; ?>">Misc</span></button>
      <button id="device-detection-button-<?php echo $ad_number; ?>" type="button" style="display: none; margin-right: 0px;" title="Client/Server-side Device Detection (Desktop, Tablet, Phone,...)"><span style="<?php echo $devices_style; ?>">Devices</span></button>
      <button id="lists-button-<?php echo $ad_number; ?>" type="button" style="display: none; margin-right: 0px;" title="White/Black-list Category, Tag, Url or Referer (domain)"><span style="<?php echo $lists_style; ?>">Lists</span></button>
      <button id="manual-button-<?php echo $ad_number; ?>" type="button" style="display: none; margin-right: 0px;" title="Widget, Shortcode and PHP function call"><span style="<?php echo $manual_style; ?>">Manual Display</span></button>
    </div>
    <div style="clear: both;"></div>
  </div>

  <div style="padding:8px 8px 8px 8px;">
    <div style="float: left;">
      Automatic Display:
      <select style="border-radius: 5px; margin-bottom: 3px;" id="display-type-<?php echo $ad_number; ?>" name="<?php echo AI_OPTION_DISPLAY_TYPE, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" style="width:200px">
         <option value="<?php echo AD_SELECT_NONE; ?>" <?php echo ($obj->get_display_type()==AD_SELECT_NONE) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_SELECT_NONE; ?></option>
         <option value="<?php echo AD_SELECT_BEFORE_POST; ?>" <?php echo ($obj->get_display_type()==AD_SELECT_BEFORE_POST) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_SELECT_BEFORE_POST; ?></option>
         <option value="<?php echo AD_SELECT_BEFORE_CONTENT; ?>" <?php echo ($obj->get_display_type()==AD_SELECT_BEFORE_CONTENT) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_SELECT_BEFORE_CONTENT; ?></option>
         <option value="<?php echo AD_SELECT_BEFORE_PARAGRAPH; ?>" <?php echo ($obj->get_display_type()==AD_SELECT_BEFORE_PARAGRAPH) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_SELECT_BEFORE_PARAGRAPH; ?></option>
         <option value="<?php echo AD_SELECT_AFTER_PARAGRAPH; ?>" <?php echo ($obj->get_display_type()==AD_SELECT_AFTER_PARAGRAPH) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_SELECT_AFTER_PARAGRAPH; ?></option>
         <option value="<?php echo AD_SELECT_AFTER_CONTENT; ?>" <?php echo ($obj->get_display_type()==AD_SELECT_AFTER_CONTENT) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_SELECT_AFTER_CONTENT; ?></option>
         <option value="<?php echo AD_SELECT_AFTER_POST; ?>" <?php echo ($obj->get_display_type()==AD_SELECT_AFTER_POST) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_SELECT_AFTER_POST; ?></option>
         <option value="<?php echo AD_SELECT_BEFORE_EXCERPT; ?>" <?php echo ($obj->get_display_type()==AD_SELECT_BEFORE_EXCERPT) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_SELECT_BEFORE_EXCERPT; ?></option>
         <option value="<?php echo AD_SELECT_AFTER_EXCERPT; ?>" <?php echo ($obj->get_display_type()==AD_SELECT_AFTER_EXCERPT) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_SELECT_AFTER_EXCERPT; ?></option>
      </select>
    </div>

    <div style="float: right;">
      Block Alignment and Style:&nbsp;&nbsp;&nbsp;
      <select style="border-radius: 5px;" id="block-alignment-<?php echo $ad_number; ?>" name="<?php echo AI_OPTION_ALIGNMENT_TYPE, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" style="width:120px">
         <option value="<?php echo AD_ALIGNMENT_NO_WRAPPING; ?>" <?php echo ($obj->get_alignment_type()==AD_ALIGNMENT_NO_WRAPPING) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_ALIGNMENT_NO_WRAPPING; ?></option>
         <option value="<?php echo AD_ALIGNMENT_CUSTOM_CSS; ?>" <?php echo ($obj->get_alignment_type()==AD_ALIGNMENT_CUSTOM_CSS) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_ALIGNMENT_CUSTOM_CSS; ?></option>
         <option value="<?php echo AD_ALIGNMENT_NONE; ?>" <?php echo ($obj->get_alignment_type()==AD_ALIGNMENT_NONE) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_ALIGNMENT_NONE; ?></option>
         <option value="<?php echo AD_ALIGNMENT_LEFT; ?>" <?php echo ($obj->get_alignment_type()==AD_ALIGNMENT_LEFT) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_ALIGNMENT_LEFT; ?></option>
         <option value="<?php echo AD_ALIGNMENT_RIGHT; ?>" <?php echo ($obj->get_alignment_type()==AD_ALIGNMENT_RIGHT) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_ALIGNMENT_RIGHT; ?></option>
         <option value="<?php echo AD_ALIGNMENT_CENTER; ?>" <?php echo ($obj->get_alignment_type()==AD_ALIGNMENT_CENTER) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_ALIGNMENT_CENTER; ?></option>
         <option value="<?php echo AD_ALIGNMENT_FLOAT_LEFT; ?>" <?php echo ($obj->get_alignment_type()==AD_ALIGNMENT_FLOAT_LEFT) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_ALIGNMENT_FLOAT_LEFT; ?></option>
         <option value="<?php echo AD_ALIGNMENT_FLOAT_RIGHT; ?>" <?php echo ($obj->get_alignment_type()==AD_ALIGNMENT_FLOAT_RIGHT) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_ALIGNMENT_FLOAT_RIGHT; ?></option>
      </select>
      &nbsp;
      <button id="show-css-button-<?php echo $ad_number; ?>" type="button" style="display: none; margin-right: 0px;" title="Show CSS code">Show CSS</button>
    </div>
    <div style="clear: both;"></div>
  </div>

  <div class="responsive-table" id="css-code-<?php echo $ad_number; ?>" style="min-height: 31px; padding:8px 8px 8px 8px; margin: 8px 0 0 5px; height: 24px; display: none;">
    <table>
      <tr>
        <td style="vertical-align: middle;">
          <span id="css-label-<?php echo $ad_number; ?>" style="height: 22px; vertical-align: middle; margin: 4px 0 0 0;">CSS &nbsp;</span>
        </td>
        <td style="width: 100%;">
          <input id="custom-css-<?php echo $ad_number; ?>" style="width: 100%; vertical-align: middle; border-radius: 4px; display: none; font-family: Courier, 'Courier New', monospace; font-weight: bold;" type="text" name="<?php echo AI_OPTION_CUSTOM_CSS, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="<?php echo $obj->get_custom_css(); ?>" size="70" maxlength="160" title="Custom CSS code for wrapping div" />
          <span style="width: 100%; vertical-align: middle; margin: 3px 0 0 7px; font-family: Courier, 'Courier New', monospace; font-size: 12px; font-weight: bold;">
            <span id="css-no-wrapping-<?php echo $ad_number; ?>" style="height: 18px; vertical-align: middle; display: none;"></span>
            <span id="css-none-<?php echo $ad_number; ?>" style="height: 18px; vertical-align: middle; display: none;" title="CSS code for wrapping div"><?php echo $obj->alignmet_style (AD_ALIGNMENT_NONE); ?></span>
            <span id="css-left-<?php echo $ad_number; ?>" style="height: 18px; vertical-align: middle;display: none;" title="CSS code for wrapping div"><?php echo $obj->alignmet_style (AD_ALIGNMENT_LEFT); ?></span>
            <span id="css-right-<?php echo $ad_number; ?>" style="height: 18px; vertical-align: middle;display: none;" title="CSS code for wrapping div"><?php echo $obj->alignmet_style (AD_ALIGNMENT_RIGHT); ?></span>
            <span id="css-center-<?php echo $ad_number; ?>" style="height: 18px; vertical-align: middle;display: none;" title="CSS code for wrapping div"><?php echo $obj->alignmet_style (AD_ALIGNMENT_CENTER); ?></span>
            <span id="css-float-left-<?php echo $ad_number; ?>" style="height: 18px; vertical-align: middle;display: none;" title="CSS code for wrapping div"><?php echo $obj->alignmet_style (AD_ALIGNMENT_FLOAT_LEFT); ?></span>
            <span id="css-float-right-<?php echo $ad_number; ?>" style="height: 18px; vertical-align: middle;display: none;" title="CSS code for wrapping div"><?php echo $obj->alignmet_style (AD_ALIGNMENT_FLOAT_RIGHT); ?></span>
          </span>
        </td>
        <td>
          <button id="edit-css-button-<?php echo $ad_number; ?>" type="button" style="float: right; margin-left: 7px;" title="Edit CSS code">Edit</button>
        </td>
      </tr>
    </table>
  </div>

  <div class="responsive-table" style="padding:8px 8px 8px 8px; margin: 8px 0 0 5px; border: 1px solid #ddd; border-radius: 5px;">
    <table>
      <tr>
        <td style="width: 70%">
          <input style="border-radius: 5px;" type="hidden" name="<?php echo AI_OPTION_DISPLAY_ON_POSTS, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="0" />
          <input style="border-radius: 5px;" type="checkbox" name="<?php echo AI_OPTION_DISPLAY_ON_POSTS, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="1" id="display-posts-<?php echo $ad_number; ?>" title="Enable or disable display on posts" <?php if ($obj->get_display_settings_post()==AD_SETTINGS_CHECKED) echo 'checked '; ?> />

          <select style="border-radius: 5px; margin: 0 0 3px 10px;" title="Default display for posts - exceptions can be configured on individual post editor pages" id="enabled-on-which-posts-<?php echo $ad_number; ?>" name="<?php echo AI_OPTION_ENABLED_ON_WHICH_POSTS, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" style="width:160px">
             <option value="<?php echo AD_ENABLED_ON_ALL; ?>" <?php echo ($obj->get_ad_enabled_on_which_posts()==AD_ENABLED_ON_ALL) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_ENABLED_ON_ALL; ?></option>
             <option value="<?php echo AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED; ?>" <?php echo ($obj->get_ad_enabled_on_which_posts()==AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED; ?></option>
             <option value="<?php echo AD_ENABLED_ONLY_ON_SELECTED; ?>" <?php echo ($obj->get_ad_enabled_on_which_posts()==AD_ENABLED_ONLY_ON_SELECTED) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_ENABLED_ONLY_ON_SELECTED; ?></option>
          </select>
          &nbsp;
          <label for="display-posts-<?php echo $ad_number; ?>">Posts</label>
        </td>
        <td style="padding-left: 8px;">
        </td>
        <td style="padding-left: 8px;">
          <input style="border-radius: 5px;" type="hidden" name="<?php echo AI_OPTION_DISPLAY_ON_HOMEPAGE, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="0" />
          <input id= "display-homepage-<?php echo $ad_number; ?>" style="border-radius: 5px; margin-left: 10px;" type="checkbox" name="<?php echo AI_OPTION_DISPLAY_ON_HOMEPAGE, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="1" <?php if ($obj->get_display_settings_home()==AD_SETTINGS_CHECKED) echo 'checked '; ?> />
          <label for="display-homepage-<?php echo $ad_number; ?>" title="Enable or disable display on homepage: latest posts (including sub-pages), static page or theme homepage">Homepage</label>
        </td>
        <td style="padding-left: 8px;">
          <input style="border-radius: 5px;" type="hidden" name="<?php echo AI_OPTION_DISPLAY_ON_CATEGORY_PAGES, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="0" />
          <input id= "display-category-<?php echo $ad_number; ?>" style="border-radius: 5px; margin-left: 10px;" type="checkbox" name="<?php echo AI_OPTION_DISPLAY_ON_CATEGORY_PAGES, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="1" <?php if ($obj->get_display_settings_category()==AD_SETTINGS_CHECKED) echo 'checked '; ?> />
          <label for="display-category-<?php echo $ad_number; ?>" title="Enable or disable display on category blog pages (including sub-pages)">Category pages</label>
        </td>
      </tr>

      <tr>
        <td style="width: 70%">
          <input style="border-radius: 5px;" type="hidden" name="<?php echo AI_OPTION_DISPLAY_ON_PAGES, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="0" />
          <input style="border-radius: 5px;" type="checkbox" name="<?php echo AI_OPTION_DISPLAY_ON_PAGES, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="1" id="display-pages-<?php echo $ad_number; ?>" title="Enable or disable display on static pages" <?php if ($obj->get_display_settings_page()==AD_SETTINGS_CHECKED) echo 'checked '; ?> />

          <select style="border-radius: 5px; margin: 0 0 3px 10px;" title="Default display for pages - exceptions can be configured on individual page editor pages" id="enabled-on-which-pages-<?php echo $ad_number; ?>" name="<?php echo AI_OPTION_ENABLED_ON_WHICH_PAGES, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" style="width:160px">
             <option value="<?php echo AD_ENABLED_ON_ALL; ?>" <?php echo ($obj->get_ad_enabled_on_which_pages()==AD_ENABLED_ON_ALL) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_ENABLED_ON_ALL; ?></option>
             <option value="<?php echo AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED; ?>" <?php echo ($obj->get_ad_enabled_on_which_pages()==AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED; ?></option>
             <option value="<?php echo AD_ENABLED_ONLY_ON_SELECTED; ?>" <?php echo ($obj->get_ad_enabled_on_which_pages()==AD_ENABLED_ONLY_ON_SELECTED) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_ENABLED_ONLY_ON_SELECTED; ?></option>
          </select>
          &nbsp;
          <label for="display-pages-<?php echo $ad_number; ?>">Static pages</label>
        </td>
        <td style="padding-left: 8px;">
          <input style="border-radius: 5px;" type="hidden" name="<?php echo AI_OPTION_ENABLE_404, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="0" />
          <input style="border-radius: 5px;" id="enable-404-<?php echo $ad_number; ?>" type="checkbox" name="<?php echo AI_OPTION_ENABLE_404, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="1" <?php if ($obj->get_enable_404 () == AD_SETTINGS_CHECKED) echo 'checked '; ?> />
          <label for="enable-404-<?php echo $ad_number; ?>" title="Enable or disable display on page for Error 404: Page not found">404 page</label>
        </td>
        <td style="padding-left: 8px;">
          <input style="border-radius: 5px;;" type="hidden" name="<?php echo AI_OPTION_DISPLAY_ON_SEARCH_PAGES, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="0" />
          <input id= "display-search-<?php echo $ad_number; ?>" style="border-radius: 5px; margin-left: 10px;" type="checkbox" name="<?php echo AI_OPTION_DISPLAY_ON_SEARCH_PAGES, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="1" <?php if ($obj->get_display_settings_search()==AD_SETTINGS_CHECKED) echo 'checked '; ?> />
          <label for="display-search-<?php echo $ad_number; ?>" title="Enable or disable display on search blog pages">Search pages</label>
        </td>
        <td style="padding-left: 8px;">
          <input style="border-radius: 5px;" type="hidden" name="<?php echo AI_OPTION_DISPLAY_ON_ARCHIVE_PAGES, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="0" />
          <input id= "display-archive-<?php echo $ad_number; ?>" style="border-radius: 5px; margin-left: 10px;" type="checkbox" name="<?php echo AI_OPTION_DISPLAY_ON_ARCHIVE_PAGES, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="1" <?php if ($obj->get_display_settings_archive()==AD_SETTINGS_CHECKED) echo 'checked '; ?> />
          <label for="display-archive-<?php echo $ad_number; ?>" title="Enable or disable display on tag or archive blog pages">Tag / Archive pages</label>
        </td>
      </tr>
    </table>
  </div>

  <div id="paragraph-settings-<?php echo $ad_number; ?>" style="padding:8px 8px 0 8px; margin: 8px 0 8px 5px; border: 1px solid #ddd; border-radius: 5px;">
    <div style="margin: 4px 0 8px 0;">
      Paragraph number <input style="border-radius: 5px;" type="text" name="<?php echo AI_OPTION_PARAGRAPH_NUMBER, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="<?php echo $obj->get_paragraph_number() ?>" size="2" maxlength="4" /> &nbsp; 0 means random paragraph, <span title="0.2 means paragraph at 20% of page height, 0.5 means paragraph halfway down the page, 0.9 means paragraph at 90% of page height, etc.">value between 0 and 1 means relative position on page.</span>
    </div>
    <div style="margin: 4px 0 8px 0; ">
      Count
      <select style="border-radius: 5px;" name="<?php echo AI_OPTION_DIRECTION_TYPE, WP_FORM_FIELD_POSTFIX, $ad_number; ?>">
        <option value="<?php echo AD_DIRECTION_FROM_TOP; ?>" <?php echo ($obj->get_direction_type()==AD_DIRECTION_FROM_TOP) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_DIRECTION_FROM_TOP; ?></option>
        <option value="<?php echo AD_DIRECTION_FROM_BOTTOM; ?>" <?php echo ($obj->get_direction_type()==AD_DIRECTION_FROM_BOTTOM) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_DIRECTION_FROM_BOTTOM; ?></option>
      </select>
      paragraphs with tags
      <input style="border-radius: 5px;" title="Comma separated HTML tags, usually only 'p' tags are used" type="text" name="<?php echo AI_OPTION_PARAGRAPH_TAGS, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="<?php echo $obj->get_paragraph_tags(); ?>" size="14" maxlength="50"/>&nbsp;&nbsp;&nbsp;
      Minimum number of paragraphs <input style="border-radius: 5px;" type="text" name="<?php echo AI_OPTION_MIN_PARAGRAPHS, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="<?php echo $obj->get_paragraph_number_minimum() ?>" size="2" maxlength="3" />&nbsp;&nbsp;&nbsp;
    </div>
    <div style="margin: 4px 0 8px 0; ">
      Count only paragraphs that
      <select style="border-radius: 5px; margin-bottom: 3px;" name="<?php echo AI_OPTION_PARAGRAPH_TEXT_TYPE, WP_FORM_FIELD_POSTFIX, $ad_number; ?>">
        <option value="<?php echo AD_CONTAIN; ?>" <?php echo ($obj->get_paragraph_text_type() == AD_CONTAIN) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_CONTAIN; ?></option>
        <option value="<?php echo AD_DO_NOT_CONTAIN; ?>" <?php echo ($obj->get_paragraph_text_type() == AD_DO_NOT_CONTAIN) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_DO_NOT_CONTAIN; ?></option>
      </select>
      <input style="border-radius: 5px;" title="Comma separated text" type="text" name="<?php echo AI_OPTION_PARAGRAPH_TEXT, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="<?php echo $obj->get_paragraph_text() ?>" size="26" maxlength="200" />
      with at least <input style="border-radius: 5px;" type="text" name="<?php echo AI_OPTION_MIN_PARAGRAPH_WORDS, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="<?php echo $obj->get_minimum_paragraph_words() ?>" size="4" maxlength="5" /> words
    </div>
    <div id="post-settings-<?php echo $ad_number; ?>" style="margin: 4px 0 8px 0;">
      Minimum page/post words <input style="border-radius: 5px;" type="text" name="<?php echo AI_OPTION_MIN_WORDS, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="<?php echo $obj->get_minimum_words() ?>" size="4" maxlength="6" /> &nbsp;&nbsp;&nbsp;
      Display <input style="border-radius: 5px;" type="text" name="<?php echo AI_OPTION_AFTER_DAYS, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="<?php echo $obj->get_ad_after_day() ?>" size="2" maxlength="3" title="0 means publish immediately" /> days after post is published &nbsp;&nbsp;&nbsp;
    </div>
  </div>

  <div class="responsive-table" id="list-settings-<?php echo $ad_number; ?>" style="padding:8px 8px 8px 8px; margin: 8px 0 8px 5px; border: 1px solid #ddd; border-radius: 5px; <?php if (!$show_lists) echo 'display: none;'; ?>">
    <table style="padding:8px 8px 10px 8px;">
      <tbody>
        <tr>
          <td style="padding-right: 7px;">
            Categories
          </td>
          <td style="padding-right: 7px; width: 70%;">
            <input style="border-radius: 5px; width: 100%;" title="Comma separated category names - if category name contains commas use category slug instead" type="text" name="<?php echo AI_OPTION_CATEGORY_LIST, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="<?php echo $cat_list; ?>" size="54" maxlength="500" />
          </td>
          <td style="padding-right: 7px;">
            <input style="border-radius: 5px;" type="radio" name="<?php echo AI_OPTION_CATEGORY_LIST_TYPE, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" id="category-blacklist-<?php echo $ad_number; ?>" value="<?php echo AD_BLACK_LIST; ?>" <?php if ($obj->get_ad_block_cat_type() == AD_BLACK_LIST) echo 'checked '; ?> />
            <label for="category-blacklist-<?php echo $ad_number; ?>" title="Blacklist categories"><?php echo AD_BLACK_LIST; ?></label>
          </td>
          <td>
            <input style="border-radius: 5px;" type="radio" name="<?php echo AI_OPTION_CATEGORY_LIST_TYPE, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" id="category-whitelist-<?php echo $ad_number; ?>" value="<?php echo AD_WHITE_LIST; ?>" <?php if ($obj->get_ad_block_cat_type() == AD_WHITE_LIST) echo 'checked '; ?> />
            <label for="category-whitelist-<?php echo $ad_number; ?>" title="Whitelist categories"><?php echo AD_WHITE_LIST; ?></label>
          </td>
        </tr>
        <tr>
          <td style="padding-right: 7px;">
            Tags
          </td>
          <td style="padding-right: 7px; width: 70%;">
            <input style="border-radius: 5px; width: 100%;" title="Comma separated tags" type="text" name="<?php echo AI_OPTION_TAG_LIST, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="<?php echo $tag_list; ?>" size="54" maxlength="500"/>
          </td>
          <td style="padding-right: 7px;">
            <input style="border-radius: 5px;" type="radio" name="<?php echo AI_OPTION_TAG_LIST_TYPE, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" id="tag-blacklist-<?php echo $ad_number; ?>" value="<?php echo AD_BLACK_LIST; ?>" <?php if ($obj->get_ad_block_tag_type() == AD_BLACK_LIST) echo 'checked '; ?> />
            <label for="tag-blacklist-<?php echo $ad_number; ?>" title="Blacklist tags"><?php echo AD_BLACK_LIST; ?></label>
          </td>
          <td>
            <input style="border-radius: 5px;" type="radio" name="<?php echo AI_OPTION_TAG_LIST_TYPE, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" id="tag-whitelist-<?php echo $ad_number; ?>" value="<?php echo AD_WHITE_LIST; ?>" <?php if ($obj->get_ad_block_tag_type() == AD_WHITE_LIST) echo 'checked '; ?> />
            <label for="tag-whitelist-<?php echo $ad_number; ?>" title="Whitelist tags"><?php echo AD_WHITE_LIST; ?></label>
          </td>
        </tr>
        <tr>
          <td style="padding-right: 7px;">
            Urls
          </td>
          <td style="padding-right: 7px;" width: 70%;>
            <input style="border-radius: 5px; width: 100%;" title="SPACE separated urls (page addresses) starting with / after domain name (e.g. /permalink-url, use only when you need to taget a specific url not accessible by other means). You can also use partial urls with * (/url-start*. *url-pattern*, *url-end)" type="text" name="<?php echo AI_OPTION_URL_LIST, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="<?php echo $url_list; ?>" size="54" maxlength="500"/>
          </td>
          <td style="padding-right: 7px;">
            <input style="border-radius: 5px;" type="radio" name="<?php echo AI_OPTION_URL_LIST_TYPE, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" id="url-blacklist-<?php echo $ad_number; ?>" value="<?php echo AD_BLACK_LIST; ?>" <?php if ($obj->get_ad_url_list_type() == AD_BLACK_LIST) echo 'checked '; ?> />
            <label for="url-blacklist-<?php echo $ad_number; ?>" title="Blacklist urls"><?php echo AD_BLACK_LIST; ?></label>
          </td>
          <td>
            <input style="border-radius: 5px;" type="radio" name="<?php echo AI_OPTION_URL_LIST_TYPE, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" id="url-whitelist-<?php echo $ad_number; ?>" value="<?php echo AD_WHITE_LIST; ?>" <?php if ($obj->get_ad_url_list_type() == AD_WHITE_LIST) echo 'checked '; ?> />
            <label for="url-whitelist-<?php echo $ad_number; ?>" title="Whitelist urls"><?php echo AD_WHITE_LIST; ?></label>
          </td>
        </tr>
        <tr>
          <td style="padding-right: 7px;">
            Referers
          </td>
          <td style="padding-right: 7px;" width: 70%;>
            <input style="border-radius: 5px; width: 100%;" title="Comma separated domains, use # for no referer" type="text" name="<?php echo AI_OPTION_DOMAIN_LIST, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="<?php echo $domain_list; ?>" size="54" maxlength="500"/>
          </td>
          <td style="padding-right: 7px;">
            <input style="border-radius: 5px;" type="radio" name="<?php echo AI_OPTION_DOMAIN_LIST_TYPE, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" id="referer-blacklist-<?php echo $ad_number; ?>" value="<?php echo AD_BLACK_LIST; ?>" <?php if ($obj->get_ad_domain_list_type() == AD_BLACK_LIST) echo 'checked '; ?> />
            <label for="referer-blacklist-<?php echo $ad_number; ?>" title="Blacklist referers"><?php echo AD_BLACK_LIST; ?></label>
          </td>
          <td>
            <input style="border-radius: 5px;" type="radio" name="<?php echo AI_OPTION_DOMAIN_LIST_TYPE, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" id="referer-whitelist-<?php echo $ad_number; ?>" value="<?php echo AD_WHITE_LIST; ?>" <?php if ($obj->get_ad_domain_list_type() == AD_WHITE_LIST) echo 'checked '; ?> />
            <label for="referer-whitelist-<?php echo $ad_number; ?>" title="Whitelist referers"><?php echo AD_WHITE_LIST; ?></label>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="manual-settings-<?php echo $ad_number; ?>" class="small-button" style="padding:7px; margin: 8px 0 8px 5px; text-align: left; border: 1px solid #ddd; border-radius: 5px; <?php if (!$show_manual) echo 'display: none;'; ?>">
    <table>
      <tr>
        <td style="padding: 4px 10px 4px 0;">
          <input style="border-radius: 5px;" type="hidden" name="<?php echo AI_OPTION_ENABLE_WIDGET, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="0" />
          <input style="border-radius: 5px;" id="enable-widget-<?php echo $ad_number; ?>" type="checkbox" name="<?php echo AI_OPTION_ENABLE_WIDGET, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="1" <?php if ($obj->get_enable_widget () == AD_SETTINGS_CHECKED) echo 'checked '; ?> />
          <label for="enable-widget-<?php echo $ad_number; ?>" title="Enable or disable widget for this code block">
            Widget
          </label>
        </td>
        <td>
          <pre style= "margin: 0; display: inline; color: blue;" title="Sidebars (or widget positions) where this widged is used"><?php echo $sidebars [$ad_number], !empty ($sidebars [$ad_number]) ? " &nbsp;" : ""; ?></pre>
          <button id="widgets-button-<?php echo $ad_number; ?>" type="button" style="display: none; width: 15px; height: 15px;" title="Manage Widgets"></button>
        </td>
      </tr>
      <tr>
        <td style="padding: 4px 10px 4px 0;">
          <input style="border-radius: 5px;" type="hidden"   name="<?php echo AI_OPTION_ENABLE_MANUAL, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="0" />
          <input style="border-radius: 5px;" type="checkbox" id="enable-shortcode-<?php echo $ad_number; ?>" name="<?php echo AI_OPTION_ENABLE_MANUAL, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="1" <?php if ($obj->get_enable_manual () == AD_SETTINGS_CHECKED) echo 'checked '; ?> />
          <label for="enable-shortcode-<?php echo $ad_number; ?>" title="Enable or disable shortcode for manual insertion of this code block in posts and pages">
            Shortcode
          </label>
        </td>
        <td>
          <pre style= "margin: 0; display: inline; color: blue; font-size: 11px;">[adinserter block="<?php echo $ad_number; ?>"]</pre>
          or <pre style= "margin: 0; display: inline; color: blue;">[adinserter name="<?php echo $obj->get_ad_name(); ?>"]</pre>
        </td>
      </tr>
      <tr>
        <td style="padding: 4px 10px 4px 0;">
          <input style="border-radius: 5px;" type="hidden"   name="<?php echo AI_OPTION_ENABLE_PHP_CALL, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="0" />
          <input style="border-radius: 5px;" id="enable-php-call-<?php echo $ad_number; ?>" type="checkbox" name="<?php echo AI_OPTION_ENABLE_PHP_CALL, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="1" <?php if ($obj->get_enable_php_call () == AD_SETTINGS_CHECKED) echo 'checked '; ?> />
          <label for="enable-php-call-<?php echo $ad_number; ?>" title="Enable or disable PHP function call to insert this code block at any position in template file. If function is disabled for block it will return empty string.">
            PHP function
          </label>
        </td>
        <td>
          <pre style= "margin: 0; display: inline; color: blue; font-size: 11px;">&lt;?php if (function_exists ('adinserter')) echo adinserter (<?php echo $ad_number; ?>); ?&gt;</pre>
        </td>
      </tr>
    </table>
  </div>

  <div id="misc-settings-<?php echo $ad_number; ?>" style="margin: 8px 0 8px 5px; padding:8px; border: 1px solid #ddd; border-radius: 5px; <?php if (!$show_misc) echo 'display: none;'; ?>">
    Max <input style="border-radius: 5px;" type="text" name="<?php echo AI_OPTION_MAXIMUM_INSERTIONS, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="<?php echo $obj->get_maximum_insertions () ?>" size="2" maxlength="3" title="0 means no limit" /> insertions &nbsp;&nbsp;
    Filter <input style="border-radius: 5px;" type="text" name="<?php echo AI_OPTION_EXCERPT_NUMBER, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="<?php echo $obj->get_call_filter() ?>" title= "Filter insertions by specifying wanted calls for this block - single number or comma separated numbers, 0 means all / no limits" size="6" maxlength="20" /> &nbsp;&nbsp;
    General tag <input style="border-radius: 5px;" type="text" name="<?php echo AI_OPTION_GENERAL_TAG, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="<?php echo $obj->get_ad_general_tag() ?>" size="10" maxlength="40" title="Used for {tags} when no page data is found" /> &nbsp;&nbsp;

    <div style="float: right;">
      Display for
      <select style="border-radius: 5px; margin-bottom: 3px;" id="display-for-users-<?php echo $ad_number; ?>" name="<?php echo AI_OPTION_DISPLAY_FOR_USERS, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" style="width:160px">
         <option value="<?php echo AD_DISPLAY_ALL_USERS; ?>" <?php echo ($obj->get_display_for_users()==AD_DISPLAY_ALL_USERS) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_DISPLAY_ALL_USERS; ?></option>
         <option value="<?php echo AD_DISPLAY_LOGGED_IN_USERS; ?>" <?php echo ($obj->get_display_for_users()==AD_DISPLAY_LOGGED_IN_USERS) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_DISPLAY_LOGGED_IN_USERS; ?></option>
         <option value="<?php echo AD_DISPLAY_NOT_LOGGED_IN_USERS; ?>" <?php echo ($obj->get_display_for_users()==AD_DISPLAY_NOT_LOGGED_IN_USERS) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_DISPLAY_NOT_LOGGED_IN_USERS; ?></option>
      </select>
      users
    </div>

    <div style="clear: both;"></div>
  </div>

  <div id="device-detection-settings-<?php echo $ad_number; ?>" style="padding:8px 8px 8px 8px; margin: 8px 0 8px 5px; border: 1px solid #ddd; border-radius: 5px; <?php if (!$show_devices) echo 'display: none;'; ?>">
    <table>
      <tr>
        <td>
          <div style="margin-bottom: 5px;">
            <input style="border-radius: 5px;" type="hidden" name="<?php echo AI_OPTION_DETECT_CLIENT_SIDE, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="0" />
            <input id="client-side-detection-<?php echo $ad_number; ?>" style="border-radius: 5px;" type="checkbox" name="<?php echo AI_OPTION_DETECT_CLIENT_SIDE, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="1" <?php if ($obj->get_detection_client_side ()==AD_SETTINGS_CHECKED) echo 'checked '; ?> />
            <label for="client-side-detection-<?php echo $ad_number; ?>">Use client-side detection to display only on:</label>
          </div>

          <div style="margin: 5px 0 0 40px;">

      <?php
        for ($viewport = 1; $viewport <= AD_INSERTER_VIEWPORTS; $viewport ++) {
          $viewport_name = get_viewport_name ($viewport);
          if ($viewport_name != '') {
      ?>
            <div style="margin: 8px 0;">
              <input style="border-radius: 5px;" type="hidden" name="<?php echo AI_OPTION_DETECT_VIEWPORT, '_', $viewport, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="0" />
              <input style="border-radius: 5px;" type="checkbox" name="<?php echo AI_OPTION_DETECT_VIEWPORT, '_', $viewport, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" id="viewport-<?php echo $viewport, "-", $ad_number; ?>" value="1" <?php if ($obj->get_detection_viewport ($viewport)==AD_SETTINGS_CHECKED) echo 'checked '; ?> />
              <label for="viewport-<?php echo $viewport, "-", $ad_number; ?>" title="Device min width <?php echo get_viewport_width ($viewport); ?> px"><?php echo $viewport_name; ?></label>
            </div>
      <?php
          }
        }
      ?>
          </div>
        </td><td style="padding-left: 40px; vertical-align: top;">
          <input style="border-radius: 5px;" type="hidden" name="<?php echo AI_OPTION_DETECT_SERVER_SIDE, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" value="0" />
          <input style="border-radius: 5px;" type="checkbox" name="<?php echo AI_OPTION_DETECT_SERVER_SIDE, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" id="server-side-detection-<?php echo $viewport_name; ?>" value="1" <?php if ($obj->get_detection_server_side ()==AD_SETTINGS_CHECKED) echo 'checked '; ?> />
          <label for="server-side-detection-<?php echo $viewport_name; ?>">Use server-side detection to display only on </label>

          <div style="margin: 0 0 10px 40px;">
            <select style="border-radius: 5px; margin-bottom: 3px;" id="display-for-devices-<?php echo $ad_number; ?>" name="<?php echo AI_OPTION_DISPLAY_FOR_DEVICES, WP_FORM_FIELD_POSTFIX, $ad_number; ?>" style="width:160px">
              <option value="<?php echo AD_DISPLAY_DESKTOP_DEVICES; ?>" <?php echo ($obj->get_display_for_devices() == AD_DISPLAY_DESKTOP_DEVICES) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_DISPLAY_DESKTOP_DEVICES; ?></option>
              <option value="<?php echo AD_DISPLAY_MOBILE_DEVICES; ?>" <?php echo ($obj->get_display_for_devices() == AD_DISPLAY_MOBILE_DEVICES) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_DISPLAY_MOBILE_DEVICES; ?></option>
              <option value="<?php echo AD_DISPLAY_TABLET_DEVICES; ?>" <?php echo ($obj->get_display_for_devices() == AD_DISPLAY_TABLET_DEVICES) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_DISPLAY_TABLET_DEVICES; ?></option>
              <option value="<?php echo AD_DISPLAY_PHONE_DEVICES; ?>" <?php echo ($obj->get_display_for_devices() == AD_DISPLAY_PHONE_DEVICES) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_DISPLAY_PHONE_DEVICES; ?></option>
              <option value="<?php echo AD_DISPLAY_DESKTOP_TABLET_DEVICES; ?>" <?php echo ($obj->get_display_for_devices() == AD_DISPLAY_DESKTOP_TABLET_DEVICES) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_DISPLAY_DESKTOP_TABLET_DEVICES; ?></option>
              <option value="<?php echo AD_DISPLAY_DESKTOP_PHONE_DEVICES; ?>" <?php echo ($obj->get_display_for_devices() == AD_DISPLAY_DESKTOP_PHONE_DEVICES) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>><?php echo AD_DISPLAY_DESKTOP_PHONE_DEVICES; ?></option>
            </select>
            devices
          </div>
        </td>
      </tr>
    </table>
  </div>

  <div id="no-wrapping-warning-<?php echo $ad_number; ?>" style="padding:8px; margin: 8px 0 8px 5px; border: 1px solid #ddd; border-radius: 5px; display: none;">
     <span id="" style="margin-top: 5px;"><strong><span style="color: red;">WARNING:</span> No Wrapping</strong> style has no HTML code for client-side device detection!</span>
  </div>

</div>

<?php
  }
?>

<div id="tab-0" style="padding: 0 0 30px 0;">
  <div style="padding: 10px 0 0 4px;">
    <h3>Ad Inserter Settings <?php echo (int) ($ai_db_options ['global']['VERSION'][0].$ai_db_options ['global']['VERSION'][1]), '.',
                                        (int) ($ai_db_options ['global']['VERSION'][2].$ai_db_options ['global']['VERSION'][3]), '.',
                                        (int) ($ai_db_options ['global']['VERSION'][4].$ai_db_options ['global']['VERSION'][5]);
                                   echo isset ($ai_db_options ['global']['TIMESTAMP']) ? " saved on ".date ("Y-m-d H:i:s", $ai_db_options ['global']['TIMESTAMP'] + get_option ('gmt_offset') * 3600) : ""; ?></h3>
  </div>

  <div style="float: right; padding: 1px 5px;">
<?php if (function_exists ('ai_settings_global_buttons')) ai_settings_global_buttons (); ?>
    <input style="display: none; border-radius: 5px; font-weight: bold;" name="<?php echo AI_FORM_SAVE; ?>" value="Save Settings" type="submit" style="width:120px; font-weight: bold;" />
  </div>

  <div style="clear: both;"></div>

<?php if (function_exists ('ai_global_settings')) ai_global_settings (); ?>

  <div style="padding:0px 0px 8px 16px;">
     Syntax Highlighter Theme:&nbsp;&nbsp;&nbsp;

      <select
          style="border-radius: 5px; width:220px"
          id="syntax-highlighter-theme"
          name="syntax-highlighter-theme"
          value="Value">
          <optgroup label="Light">
              <option value="disabled" <?php echo ($syntax_highlighter_theme == 'disabled') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>No Syntax Highlighting</option>
              <option value="chrome" <?php echo ($syntax_highlighter_theme == 'chrome') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Chrome</option>
              <option value="clouds" <?php echo ($syntax_highlighter_theme == 'clouds') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Clouds</option>
              <option value="crimson_editor" <?php echo ($syntax_highlighter_theme == 'crimson_editor') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Crimson Editor</option>
              <option value="dawn" <?php echo ($syntax_highlighter_theme == 'dawn') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Dawn</option>
              <option value="dreamweaver" <?php echo ($syntax_highlighter_theme == 'dreamweaver') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Dreamweaver</option>
              <option value="eclipse" <?php echo ($syntax_highlighter_theme == 'eclipse') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Eclipse</option>
              <option value="github" <?php echo ($syntax_highlighter_theme == 'github') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>GitHub</option>
              <option value="katzenmilch" <?php echo ($syntax_highlighter_theme == 'katzenmilch') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Katzenmilch</option>
              <option value="kuroir" <?php echo ($syntax_highlighter_theme == 'kuroir') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Kuroir</option>
              <option value="solarized_light" <?php echo ($syntax_highlighter_theme == 'solarized_light') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Solarized Light</option>
              <option value="textmate" <?php echo ($syntax_highlighter_theme == 'textmate') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Textmate</option>
              <option value="tomorrow" <?php echo ($syntax_highlighter_theme == 'tomorrow') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Tomorrow</option>
              <option value="xcode" <?php echo ($syntax_highlighter_theme == 'xcode') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>XCode</option>
          </optgroup>
          <optgroup label="Dark">
              <option value="ad_inserter" <?php echo ($syntax_highlighter_theme == 'ad_inserter') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Ad Inserter</option>
              <option value="chaos" <?php echo ($syntax_highlighter_theme == 'chaos') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Chaos</option>
              <option value="clouds_midnight" <?php echo ($syntax_highlighter_theme == 'clouds_midnight') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Clouds Midnight</option>
              <option value="cobalt" <?php echo ($syntax_highlighter_theme == 'cobalt') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Cobalt</option>
              <option value="idle_fingers" <?php echo ($syntax_highlighter_theme == 'idle_fingers') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Idle Fingers</option>
              <option value="kr_theme" <?php echo ($syntax_highlighter_theme == 'kr_theme') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>krTheme</option>
              <option value="merbivore" <?php echo ($syntax_highlighter_theme == 'merbivore') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Merbivore</option>
              <option value="merbivore_soft" <?php echo ($syntax_highlighter_theme == 'merbivore_soft') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Merbivore Soft</option>
              <option value="mono_industrial" <?php echo ($syntax_highlighter_theme == 'mono_industrial') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Mono Industrial</option>
              <option value="monokai" <?php echo ($syntax_highlighter_theme == 'monokai') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Monokai</option>
              <option value="pastel_on_dark" <?php echo ($syntax_highlighter_theme == 'pastel_on_dark') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Pastel on Dark</option>
              <option value="solarized_dark" <?php echo ($syntax_highlighter_theme == 'solarized_dark') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Solarized Dark</option>
              <option value="terminal" <?php echo ($syntax_highlighter_theme == 'terminal') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Terminal</option>
              <option value="tomorrow_night" <?php echo ($syntax_highlighter_theme == 'tomorrow_night') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Tomorrow Night</option>
              <option value="tomorrow_night_blue" <?php echo ($syntax_highlighter_theme == 'tomorrow_night_blue') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Tomorrow Night Blue</option>
              <option value="tomorrow_night_bright" <?php echo ($syntax_highlighter_theme == 'tomorrow_night_bright') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Tomorrow Night Bright</option>
              <option value="tomorrow_night_eighties" <?php echo ($syntax_highlighter_theme == 'tomorrow_night_eighties') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Tomorrow Night 80s</option>
              <option value="twilight" <?php echo ($syntax_highlighter_theme == 'twilight') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Twilight</option>
              <option value="vibrant_ink" <?php echo ($syntax_highlighter_theme == 'vibrant_ink') ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Vibrant Ink</option>
          </optgroup>
      </select>
  </div>

  <div style="clear: both;"></div>

  <div style="padding:0px 0px 8px 16px;">
    Block Class Name:&nbsp;&nbsp;&nbsp;
      <input style="border-radius: 5px; margin-left: 0px;" title="CSS Class Name" type="text" id="block-class-name" name="block-class-name" value="<?php echo $block_class_name; ?>" size="15" maxlength="40" /> <span style= "margin: 3px 10px 0 0; display: inline; float: right;">Example: &nbsp;&nbsp; <pre style= "display: inline; color: blue;">&lt;div class="<?php echo $block_class_name; ?> <?php echo $block_class_name; ?>-n"&gt;<span style= "color: black;">BlockCode</span>&lt;/div&gt;</pre></span>
  </div>

  <div style="clear: both;"></div>

  <div style="padding:0px 0px 8px 16px;">
    Minimum User Role for Page/Post Ad Inserter Exceptions Editing
      <select style="border-radius: 5px; margin-bottom: 3px;" id="minimum-user-role" name="minimum-user-role" style="width:300px">
        <?php wp_dropdown_roles (get_minimum_user_role ()); ?>
      </select>
  </div>

  <div style="clear: both;"></div>

  <div style="padding:0px 0px 8px 16px;">
    Plugin priority <input style="border-radius: 5px;" type="text" name="plugin_priority" value="<?php echo get_plugin_priority (); ?>" size="6" maxlength="6" />
  </div>

  <div style="clear: both;"></div>

  <div style="padding:0px 0px 8px 16px;">
    Paragraph Tag Debugging:&nbsp;&nbsp;&nbsp;

    <select
        style="border-radius: 5px; width:150px"
        title="When enabled, individual post paragraphs will be surrounded with a border for easier identification and ad placement."
        id="tag_debugging"
        name="tag_debugging"
        value="Value">
            <option value="disabled" <?php echo ($tag_debugging == AI_OPTION_DISABLED) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Disabled</option>
            <option value="before_processing" <?php echo ($tag_debugging == AI_OPTION_BEFORE_PROCESSING) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>Before Processing</option>
            <option value="after_processing" <?php echo ($tag_debugging == AI_OPTION_AFTER_PROCESSING) ? AD_SELECT_SELECTED : AD_EMPTY_VALUE; ?>>After Processing</option>
    </select>
  </div>

  <hr />

  <div style="padding:0px 0px 8px 16px;">
    Viewport Settings used for client-side device detection
  </div>

<?php
  for ($viewport = 1; $viewport <= AD_INSERTER_VIEWPORTS; $viewport ++) {
?>

  <div style="padding:0px 0px 8px 16px;">
    Viewport <?php echo $viewport; ?> name:&nbsp;&nbsp;&nbsp;
      <input style="border-radius: 5px; margin-left: 0px;" type="text" id="option-name-<?php echo $viewport; ?>" name="viewport-name-<?php echo $viewport; ?>" value="<?php echo get_viewport_name ($viewport); ?>" size="15" maxlength="40" />
      <?php if ($viewport == AD_INSERTER_VIEWPORTS) echo '<span style="display: none;">' ?>
       &nbsp;&nbsp; min width
      <input style="border-radius: 5px;" type="text" id="option-length-<?php echo $viewport; ?>" name="viewport-width-<?php echo $viewport; ?>" value="<?php echo get_viewport_width ($viewport); ?>" size="4" maxlength="4" /> px
      <?php if ($viewport == AD_INSERTER_VIEWPORTS) echo '</span>' ?>
  </div>

<?php
  }
?>

  <hr />

  <div style="padding: 0;">
    <div style="float: right; padding-top: 5px; margin-right: 15px;">
      <input style="border-radius: 5px;" type="hidden"   name="<?php echo AI_OPTION_ENABLE_MANUAL, '_block_h'; ?>" value="0" />
      <input style="border-radius: 5px;" type="checkbox" name="<?php echo AI_OPTION_ENABLE_MANUAL, '_block_h'; ?>" id="enable-header" value="1" <?php if ($adH->get_enable_manual () == AD_SETTINGS_CHECKED) echo 'checked '; ?> />
      <label for="enable-header" title="Enable or disable insertion of this code into HTML page header">Enable</label> &nbsp;&nbsp;

      <input style="border-radius: 5px;" type="hidden" name="<?php echo AI_OPTION_ENABLE_404, '_block_h'; ?>" value="0" />
      <input style="border-radius: 5px;" type="checkbox" name="<?php echo AI_OPTION_ENABLE_404, '_block_h'; ?>" id="enable-header-404" value="1" <?php if ($adH->get_enable_404 () == AD_SETTINGS_CHECKED) echo 'checked '; ?> />
      <label for="enable-header-404" title="Enable or disable insertion of this code into HTML page header on page for Error 404: Page not found">Error 404 Page</label>
    </div>

    <div style="padding-left:4px;">
      <h3>HTML Page Header Code</h3>
    </div>

    <div style="padding:0px 8px 22px 16px;">
      Code will be placed within the <pre style="display: inline; color: blue;">&lt;head&gt;&lt;/head&gt;</pre> section of the theme (theme-dependent)
    </div>

    <div style="display: inline-block; padding: 1px 10px; float: right;">
     <input style="border-radius: 5px;" type="hidden"   name="<?php echo AI_OPTION_PROCESS_PHP, '_block_h'; ?>" value="0" />
     <input style="border-radius: 5px;" type="checkbox" name="<?php echo AI_OPTION_PROCESS_PHP, '_block_h'; ?>" value="1" id="process-php-h" <?php if ($adH->get_process_php () == AD_SETTINGS_CHECKED) echo 'checked '; ?> />
     <label for="process-php-h" title="Process PHP code">Process PHP</label>
    </div>

    <div style="display: inline-block; padding: 1px 10px; float: right;">
      <input type="checkbox" style="border-radius: 5px;" value="0" id="simple-editor-h" />
      <label for="simple-editor-h" title="Simple editor">Simple editor</label>
    </div>

    <div style="padding-left:16px;">
        HTML / Javascript / CSS / PHP code
    </div>
    <div style="padding: 8px;">
        <textarea id="block-h" name="<?php echo AI_OPTION_CODE, '_block_h'; ?>" rows="36" cols="98" style="background-color:#F9F9F9; font-family: Courier, 'Courier New', monospace; font-weight: bold; width: 719px; height: 384px;"><?php echo esc_textarea ($adH->get_ad_data()); ?></textarea>
    </div>
  </div>

  <hr />

  <div style="padding: 0;">
    <div style="float: right; padding-top: 5px; margin-right: 15px;">
      <input style="border-radius: 5px;" type="hidden"   name="<?php echo AI_OPTION_ENABLE_MANUAL, '_block_f'; ?>" value="0" />
      <input style="border-radius: 5px;" type="checkbox" name="<?php echo AI_OPTION_ENABLE_MANUAL, '_block_f'; ?>" id="enable-footer" value="1" <?php if ($adF->get_enable_manual () == AD_SETTINGS_CHECKED) echo 'checked '; ?> />
      <label for="enable-footer" title="Enable or disable insertion of this code into HTML page footer">Enable</label> &nbsp;&nbsp;

      <input style="border-radius: 5px;" type="hidden" name="<?php echo AI_OPTION_ENABLE_404, '_block_f'; ?>" value="0" />
      <input style="border-radius: 5px;" type="checkbox" name="<?php echo AI_OPTION_ENABLE_404, '_block_f'; ?>" id="enable-footer-404" value="1" <?php if ($adF->get_enable_404 () == AD_SETTINGS_CHECKED) echo 'checked '; ?> />
      <label for="enable-footer-404" title="Enable or disable insertion of this code into HTML page footer on page for Error 404: Page not found">Error 404 Page</label>
    </div>

    <div style="padding-left:4px;">
      <h3>HTML Page Footer Code</h3>
    </div>

    <div style="padding:0px 8px 22px 16px;">
      Code will be placed near the <pre style="display: inline; color: blue;">&lt;/body&gt;</pre> tag of the theme (theme-dependent)
    </div>

    <div style="display: inline-block; padding: 1px 10px; float: right;">
     <input style="border-radius: 5px;" type="hidden"   name="<?php echo AI_OPTION_PROCESS_PHP, '_block_f'; ?>" value="0" />
     <input style="border-radius: 5px;" type="checkbox" name="<?php echo AI_OPTION_PROCESS_PHP, '_block_f'; ?>" value="1" id="process-php-f" <?php if ($adF->get_process_php () == AD_SETTINGS_CHECKED) echo 'checked '; ?> />
     <label for="process-php-f" title="Process PHP code">Process PHP</label>
    </div>

    <div style="display: inline-block; padding: 1px 10px; float: right;">
      <input type="checkbox" style="border-radius: 5px;" value="0" id="simple-editor-f" />
      <label for="simple-editor-f" title="Simple editor">Simple editor</label>
    </div>

    <div style="padding-left:16px;">
        HTML / Javascript / PHP code
    </div>
    <div style="padding:8px;">
        <textarea id="block-f" name="<?php echo AI_OPTION_CODE, '_block_f'; ?>" rows="36" cols="98" style="background-color:#F9F9F9; font-family: Courier, 'Courier New', monospace; font-weight: bold; width: 719px; height: 384px;"><?php echo esc_textarea ($adF->get_ad_data()); ?></textarea>
    </div>
  </div>

</div>


</div>

<div style="height: 30px; margin: 8px 0 0 0;">
  <div style="float: left; padding: 1px 1px; color: red;">
        <input onclick="if (confirm('Are you sure you want to reset all settings?')) return true; return false" name="<?php echo AI_FORM_CLEAR; ?>" value="Reset All Settings" type="submit" style="display: none; width:120px; font-weight: bold; color: #e44;" />
  </div>
  <div style="float: right; padding: 1px 1px;">
        <input name="<?php echo AI_FORM_SAVE; ?>" value="<?php echo $save_button_text; ?>" type="submit" style="display: none; border-radius: 5px; font-weight: bold;" />
  </div>
</div>

<input id="ai-active-tab" type="hidden" name="ai-active-tab" value="<?php echo $active_tab; ?>" />

<?php wp_nonce_field ('save_adinserter_settings'); ?>

</form>

<?php
    }  // Main subpage
?>

</div>

<?php
  if ($subpage == 'main') {
    if (function_exists ('ai_settings_side')) ai_settings_side (); else { ?>
    <div style="float: left;">
      <div style="width: 735px; padding: 2px 8px 6px 8px; margin: 8px 0 8px 0; border: 1px solid rgb(221, 221, 221); border-radius: 5px; background: #fff;">
        <h2>Monitor Google AdSense and Amazon Associates earnings with <a href="http://tinymonitor.com/" target="_blank">Tiny Monitor</a></h2>
        <a href="http://tinymonitor.com/" target="_blank"><img src="<?php echo AD_INSERTER_PLUGIN_IMAGES_URL; ?>tinymonitor-logo.png" alt="Tiny Monitor" /></a>
        <a href="http://tinymonitor.com/" target="_blank"><img src="<?php echo AD_INSERTER_PLUGIN_IMAGES_URL; ?>tiny-monitor.png" alt="Amazon Associates" /></a>
        <p style="text-align: justify;">TinyMonitor is a PHP application that can monitor your Google AdSense earnings, Amazon Associates earnings and PayPal transactions.
           The purpose of TinyMonitor is to download data from original sources and present them in a compact way on a single web page.
           With TinyMonitor you have all the data at one place so you dont have to log in to various pages just to check earnings.
           TinyMonitor displays some data also in the page title and favicon so you still have simple access to current monitor status while you work with other applications.</p>
      </div>
    </div>
<?php
    }
  }
?>

<script type="text/javascript">
  shSettings ['theme'] = '<?php echo $syntax_highlighter_theme; ?>';
</script>

<?php
  }
