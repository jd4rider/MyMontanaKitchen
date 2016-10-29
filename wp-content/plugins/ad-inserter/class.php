<?php

require_once AD_INSERTER_PLUGIN_DIR.'constants.php';

abstract class ai_BaseCodeBlock {
  var $wp_options;

  function __construct () {

    $this->wp_options = array ();

    $this->wp_options [AI_OPTION_CODE]           = AD_EMPTY_DATA;
    $this->wp_options [AI_OPTION_PROCESS_PHP]    = AD_SETTINGS_NOT_CHECKED;
    $this->wp_options [AI_OPTION_ENABLE_MANUAL]  = AD_SETTINGS_NOT_CHECKED;
    $this->wp_options [AI_OPTION_ENABLE_404]     = AD_SETTINGS_NOT_CHECKED;
  }

  public function load_options ($block) {
    global $ai_db_options;

    if (isset ($ai_db_options [$block])) $options = $ai_db_options [$block]; else $options = '';

    // Convert old options
    if (!$options) {
      if     ($block == "h") $options = ai_get_option (str_replace ("#", "Header", AD_ADx_OPTIONS));
      elseif ($block == "f") $options = ai_get_option (str_replace ("#", "Footer", AD_ADx_OPTIONS));
      else                   $options = ai_get_option (str_replace ("#", $block, AD_ADx_OPTIONS));

      if (is_array ($options)) {

        $old_name = "ad" . $block . "_data";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_CODE] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_enable_manual";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_ENABLE_MANUAL] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_process_php";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_PROCESS_PHP] = $options [$old_name];
          unset ($options [$old_name]);
        }

        $old_name = "adH_data";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_CODE] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "adH_enable";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_ENABLE_MANUAL] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "adH_process_php";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_PROCESS_PHP] = $options [$old_name];
          unset ($options [$old_name]);
        }

        $old_name = "adF_data";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_CODE] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "adF_enable";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_ENABLE_MANUAL] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "adF_process_php";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_PROCESS_PHP] = $options [$old_name];
          unset ($options [$old_name]);
        }

        $old_name = "ad" . $block . "_name";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_NAME] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_displayType";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_DISPLAY_TYPE] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_paragraphNumber";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_PARAGRAPH_NUMBER] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_minimum_paragraphs";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_MIN_PARAGRAPHS] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_minimum_words";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_MIN_WORDS] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_excerptNumber";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_EXCERPT_NUMBER] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_directionType";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_DIRECTION_TYPE] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_floatType";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_ALIGNMENT_TYPE] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_general_tag";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_GENERAL_TAG] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_after_day";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_AFTER_DAYS] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_block_user";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_DOMAIN_LIST] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_domain_list_type";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_DOMAIN_LIST_TYPE] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_block_cat";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_CATEGORY_LIST] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_block_cat_type";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_CATEGORY_LIST_TYPE] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_block_tag";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_TAG_LIST] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_block_tag_type";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_TAG_LIST_TYPE] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_widget_settings_home";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_DISPLAY_ON_HOMEPAGE] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_widget_settings_page";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_DISPLAY_ON_PAGES] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_widget_settings_post";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_DISPLAY_ON_POSTS] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_widget_settings_category";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_DISPLAY_ON_CATEGORY_PAGES] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_widget_settings_search";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_DISPLAY_ON_SEARCH_PAGES] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_widget_settings_archive";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_DISPLAY_ON_ARCHIVE_PAGES] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_enabled_on_which_pages";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_ENABLED_ON_WHICH_PAGES] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_enabled_on_which_posts";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_ENABLED_ON_WHICH_POSTS] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_enable_php_call";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_ENABLE_PHP_CALL] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_paragraph_text";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_PARAGRAPH_TEXT] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_custom_css";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_CUSTOM_CSS] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_display_for_users";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_DISPLAY_FOR_USERS] = $options [$old_name];
          unset ($options [$old_name]);
        }
        $old_name = "ad" . $block . "_display_for_devices";
        if (isset ($options [$old_name])) {
          $options [AI_OPTION_DISPLAY_FOR_DEVICES] = $options [$old_name];
          unset ($options [$old_name]);
        }
      }
    }

    if ($options != '') $this->wp_options = array_merge ($this->wp_options, $options);
    unset ($this->wp_options ['']);
  }

  public function get_ad_data(){
    $ad_data = isset ($this->wp_options [AI_OPTION_CODE]) ? $this->wp_options [AI_OPTION_CODE] : "";
    return $ad_data;
  }

  public function get_enable_manual (){
    $enable_manual = isset ($this->wp_options [AI_OPTION_ENABLE_MANUAL]) ? $this->wp_options [AI_OPTION_ENABLE_MANUAL] : "";
    if ($enable_manual == '') $enable_manual = AD_SETTINGS_NOT_CHECKED;
    return $enable_manual;
  }

  public function get_process_php (){
    $process_php = isset ($this->wp_options [AI_OPTION_PROCESS_PHP]) ? $this->wp_options [AI_OPTION_PROCESS_PHP] : "";
    if ($process_php == '') $process_php = AD_SETTINGS_NOT_CHECKED;
    return $process_php;
  }

  public function get_enable_404 (){
    $enable_404 = isset ($this->wp_options [AI_OPTION_ENABLE_404]) ? $this->wp_options [AI_OPTION_ENABLE_404] : "";
    if ($enable_404 == '') $enable_404 = AI_OPTION_ENABLE_404;
    return $enable_404;
  }
}

abstract class ai_CodeBlock extends ai_BaseCodeBlock {

  var $number;

  function __construct () {

    $this->number = 0;

    parent::__construct();

    $this->wp_options [AI_OPTION_NAME]                       = AD_NAME;
    $this->wp_options [AI_OPTION_DISPLAY_TYPE]               = AD_SELECT_NONE;
    $this->wp_options [AI_OPTION_PARAGRAPH_NUMBER]           = AD_ONE;
    $this->wp_options [AI_OPTION_MIN_PARAGRAPHS]             = AD_ZERO;
    $this->wp_options [AI_OPTION_MIN_WORDS]                  = AD_ZERO;
    $this->wp_options [AI_OPTION_MIN_PARAGRAPH_WORDS]        = AD_ZERO;
    $this->wp_options [AI_OPTION_PARAGRAPH_TAGS]             = DEFAULT_PARAGRAPH_TAGS;
    $this->wp_options [AI_OPTION_EXCERPT_NUMBER]             = AD_ZERO;
    $this->wp_options [AI_OPTION_DIRECTION_TYPE]             = AD_DIRECTION_FROM_TOP;
    $this->wp_options [AI_OPTION_ALIGNMENT_TYPE]             = AD_ALIGNMENT_NONE;
    $this->wp_options [AI_OPTION_GENERAL_TAG]                = AD_GENERAL_TAG;
    $this->wp_options [AI_OPTION_AFTER_DAYS]                 = AD_ZERO;
    $this->wp_options [AI_OPTION_MAXIMUM_INSERTIONS]         = AD_ZERO;
    $this->wp_options [AI_OPTION_URL_LIST]                   = AD_EMPTY_DATA;
    $this->wp_options [AI_OPTION_URL_LIST_TYPE]              = AD_BLACK_LIST;
    $this->wp_options [AI_OPTION_DOMAIN_LIST]                = AD_EMPTY_DATA;
    $this->wp_options [AI_OPTION_DOMAIN_LIST_TYPE]           = AD_BLACK_LIST;
    $this->wp_options [AI_OPTION_CATEGORY_LIST]              = AD_EMPTY_DATA;
    $this->wp_options [AI_OPTION_CATEGORY_LIST_TYPE]         = AD_BLACK_LIST;
    $this->wp_options [AI_OPTION_TAG_LIST]                   = AD_EMPTY_DATA;
    $this->wp_options [AI_OPTION_TAG_LIST_TYPE]              = AD_BLACK_LIST;
    $this->wp_options [AI_OPTION_DISPLAY_ON_POSTS]           = AD_SETTINGS_CHECKED;
    $this->wp_options [AI_OPTION_DISPLAY_ON_PAGES]           = AD_SETTINGS_NOT_CHECKED;
    $this->wp_options [AI_OPTION_DISPLAY_ON_HOMEPAGE]        = AD_SETTINGS_NOT_CHECKED;
    $this->wp_options [AI_OPTION_DISPLAY_ON_CATEGORY_PAGES]  = AD_SETTINGS_NOT_CHECKED;
    $this->wp_options [AI_OPTION_DISPLAY_ON_SEARCH_PAGES]    = AD_SETTINGS_NOT_CHECKED;
    $this->wp_options [AI_OPTION_DISPLAY_ON_ARCHIVE_PAGES]   = AD_SETTINGS_NOT_CHECKED;
    $this->wp_options [AI_OPTION_ENABLED_ON_WHICH_PAGES]     = AD_ENABLED_ON_ALL;
    $this->wp_options [AI_OPTION_ENABLED_ON_WHICH_POSTS]     = AD_ENABLED_ON_ALL;
    $this->wp_options [AI_OPTION_ENABLE_PHP_CALL]            = AD_SETTINGS_NOT_CHECKED;
    $this->wp_options [AI_OPTION_ENABLE_WIDGET]              = AD_SETTINGS_CHECKED;
    $this->wp_options [AI_OPTION_PARAGRAPH_TEXT]             = AD_EMPTY_DATA;
    $this->wp_options [AI_OPTION_PARAGRAPH_TEXT_TYPE]        = AD_DO_NOT_CONTAIN;
    $this->wp_options [AI_OPTION_CUSTOM_CSS]                 = AD_EMPTY_DATA;
    $this->wp_options [AI_OPTION_DISPLAY_FOR_USERS]          = AD_DISPLAY_ALL_USERS;
    $this->wp_options [AI_OPTION_DISPLAY_FOR_DEVICES]        = AD_DISPLAY_DESKTOP_DEVICES;
    $this->wp_options [AI_OPTION_DETECT_SERVER_SIDE]         = AD_SETTINGS_NOT_CHECKED;
    $this->wp_options [AI_OPTION_DETECT_CLIENT_SIDE]         = AD_SETTINGS_NOT_CHECKED;
    for ($viewport = 1; $viewport <= AD_INSERTER_VIEWPORTS; $viewport ++) {
      $this->wp_options [AI_OPTION_DETECT_VIEWPORT . '_' . $viewport] = AD_SETTINGS_NOT_CHECKED;
    }
  }

  public function get_display_type(){
    $option = isset ($this->wp_options [AI_OPTION_DISPLAY_TYPE]) ? $this->wp_options [AI_OPTION_DISPLAY_TYPE] : "";
    if ($option == '') $option = AD_SELECT_NONE;
    elseif ($option == AD_SELECT_MANUAL) $option = AD_SELECT_NONE;
    elseif ($option == AD_SELECT_BEFORE_TITLE) $option = AD_SELECT_BEFORE_POST;
    elseif ($option == AD_SELECT_WIDGET) $option = AD_SELECT_NONE;
    return $option;
  }

   public function get_paragraph_number(){
     $option = isset ($this->wp_options [AI_OPTION_PARAGRAPH_NUMBER]) ? $this->wp_options [AI_OPTION_PARAGRAPH_NUMBER] : "";
     if ($option == '') $option = AD_ZERO;
     return $option;
    }

   public function get_paragraph_number_minimum(){
     $option = isset ($this->wp_options [AI_OPTION_MIN_PARAGRAPHS]) ? $this->wp_options [AI_OPTION_MIN_PARAGRAPHS] : "";
     if ($option == '') $option = AD_ZERO;
     return $option;
    }

   public function get_minimum_words(){
     $option = isset ($this->wp_options [AI_OPTION_MIN_WORDS]) ? $this->wp_options [AI_OPTION_MIN_WORDS] : "";
     if ($option == '') $option = AD_ZERO;
     return $option;
    }

  public function get_paragraph_tags(){
     $option = isset ($this->wp_options [AI_OPTION_PARAGRAPH_TAGS]) ? $this->wp_options [AI_OPTION_PARAGRAPH_TAGS] : DEFAULT_PARAGRAPH_TAGS;
     return $option;
  }

   public function get_minimum_paragraph_words(){
     $option = isset ($this->wp_options [AI_OPTION_MIN_PARAGRAPH_WORDS]) ? $this->wp_options [AI_OPTION_MIN_PARAGRAPH_WORDS] : "";
     if ($option == '') $option = AD_ZERO;
     return $option;
    }

   public function get_call_filter(){
     $option = isset ($this->wp_options [AI_OPTION_EXCERPT_NUMBER]) ? $this->wp_options [AI_OPTION_EXCERPT_NUMBER] : "";
     if ($option == '') $option = AD_ZERO;
     return $option;
    }

   public function get_direction_type(){
     $option = isset ($this->wp_options [AI_OPTION_DIRECTION_TYPE]) ? $this->wp_options [AI_OPTION_DIRECTION_TYPE] : "";
     if ($option == '') $option = AD_DIRECTION_FROM_TOP;
     return $option;
    }

   public function get_alignment_type(){
     // Update old field names
     $option = isset ($this->wp_options [AI_OPTION_ALIGNMENT_TYPE]) ? $this->wp_options [AI_OPTION_ALIGNMENT_TYPE] : "";
     if ($option == 'Left'){
       $option = AD_ALIGNMENT_FLOAT_LEFT;
       $this->wp_options [AI_OPTION_ALIGNMENT_TYPE] = $option;
     }
     elseif ($option == 'Right'){
       $option = AD_ALIGNMENT_FLOAT_RIGHT;
       $this->wp_options [AI_OPTION_ALIGNMENT_TYPE] = $option;
     }
     elseif ($option == '') $option = AD_ALIGNMENT_NONE;
     return $option;
    }

  public function alignmet_style ($alignment_type, $margin = DEFAULT_MARGIN){
    if ($margin < 0) $margin = 0;

    if ($alignment_type == AD_ALIGNMENT_LEFT) {
      $style = "text-align: left; margin: ".$margin."px 0px;";
    }
    elseif ($alignment_type == AD_ALIGNMENT_RIGHT) {
      $style = "text-align: right; margin: ".$margin."px 0px;";
    }
    elseif ($alignment_type == AD_ALIGNMENT_CENTER) {
      $style = "text-align: center; margin: ".$margin."px auto;";
    }
    elseif ($alignment_type == AD_ALIGNMENT_FLOAT_LEFT) {
      $style = "float: left; margin: ".$margin."px ".$margin."px ".$margin."px 0px;";
    }
    elseif ($alignment_type == AD_ALIGNMENT_FLOAT_RIGHT) {
      $style = "float: right; margin: ".$margin."px 0px ".$margin."px ".$margin."px;";
    }
    elseif ($alignment_type == AD_ALIGNMENT_CUSTOM_CSS) {
      $style = $this->get_custom_css ();
    }
    else {
      $style = "margin: ".$margin."px 0px;";
    }

    return $style;
  }

  public function get_alignmet_style ($margin = DEFAULT_MARGIN){
    return $this->alignmet_style ($this->get_alignment_type(), $margin);
  }

   public function get_display_settings_post(){
     $option = isset ($this->wp_options [AI_OPTION_DISPLAY_ON_POSTS]) ? $this->wp_options [AI_OPTION_DISPLAY_ON_POSTS] : "";
     if ($option == '') $option = AD_SETTINGS_CHECKED;
     return $option;
   }

   public function get_display_settings_page(){
     $option = isset ($this->wp_options [AI_OPTION_DISPLAY_ON_PAGES]) ? $this->wp_options [AI_OPTION_DISPLAY_ON_PAGES] : "";
     if ($option == '') $option = AD_SETTINGS_NOT_CHECKED;
     return $option;
   }

    public function get_display_settings_home(){
      global $ai_db_options;

      $option = isset ($this->wp_options [AI_OPTION_DISPLAY_ON_HOMEPAGE]) ? $this->wp_options [AI_OPTION_DISPLAY_ON_HOMEPAGE] : "";
      if ($option == '') $option = AD_SETTINGS_NOT_CHECKED;

      if ($ai_db_options ['global']['VERSION'] < '010605') {
        if (isset ($this->wp_options [AI_OPTION_DISPLAY_TYPE])) {
          $display_type = $this->wp_options [AI_OPTION_DISPLAY_TYPE];
        } else $display_type = '';

        if ($display_type == AD_SELECT_BEFORE_PARAGRAPH ||
            $display_type == AD_SELECT_AFTER_PARAGRAPH ||
            $display_type == AD_SELECT_BEFORE_CONTENT ||
            $display_type == AD_SELECT_AFTER_CONTENT)
          $option = AD_SETTINGS_NOT_CHECKED;
      }

      return $option;
    }

    public function get_display_settings_category(){
      global $ai_db_options;

      $option = isset ($this->wp_options [AI_OPTION_DISPLAY_ON_CATEGORY_PAGES]) ? $this->wp_options [AI_OPTION_DISPLAY_ON_CATEGORY_PAGES] : "";
      if ($option == '') $option = AD_SETTINGS_NOT_CHECKED;

      if ($ai_db_options ['global']['VERSION'] < '010605') {
        if (isset ($this->wp_options [AI_OPTION_DISPLAY_TYPE])) {
          $display_type = $this->wp_options [AI_OPTION_DISPLAY_TYPE];
        } else $display_type = '';

        if ($display_type == AD_SELECT_BEFORE_PARAGRAPH ||
            $display_type == AD_SELECT_AFTER_PARAGRAPH ||
            $display_type == AD_SELECT_BEFORE_CONTENT ||
            $display_type == AD_SELECT_AFTER_CONTENT)
          $option = AD_SETTINGS_NOT_CHECKED;
      }

      return $option;
    }

    public function get_display_settings_search(){
      global $ai_db_options;

      $option = isset ($this->wp_options [AI_OPTION_DISPLAY_ON_SEARCH_PAGES]) ? $this->wp_options [AI_OPTION_DISPLAY_ON_SEARCH_PAGES] : "";
      if ($option == '') $option = AD_SETTINGS_NOT_CHECKED;

      if ($ai_db_options ['global']['VERSION'] < '010605') {
        if (isset ($this->wp_options [AI_OPTION_DISPLAY_TYPE])) {
          $display_type = $this->wp_options [AI_OPTION_DISPLAY_TYPE];
        } else $display_type = '';

        if ($display_type == AD_SELECT_BEFORE_PARAGRAPH ||
            $display_type == AD_SELECT_AFTER_PARAGRAPH ||
            $display_type == AD_SELECT_BEFORE_CONTENT ||
            $display_type == AD_SELECT_AFTER_CONTENT)
          $option = AD_SETTINGS_NOT_CHECKED;
      }

      return $option;
    }

    public function get_display_settings_archive(){
      global $ai_db_options;

      $option = isset ($this->wp_options [AI_OPTION_DISPLAY_ON_ARCHIVE_PAGES]) ? $this->wp_options [AI_OPTION_DISPLAY_ON_ARCHIVE_PAGES] : "";
      if ($option == '') $option = AD_SETTINGS_NOT_CHECKED;

      if ($ai_db_options ['global']['VERSION'] < '010605') {
        if (isset ($this->wp_options [AI_OPTION_DISPLAY_TYPE])) {
          $display_type = $this->wp_options [AI_OPTION_DISPLAY_TYPE];
        } else $display_type = '';

        if ($display_type == AD_SELECT_BEFORE_PARAGRAPH ||
            $display_type == AD_SELECT_AFTER_PARAGRAPH ||
            $display_type == AD_SELECT_BEFORE_CONTENT ||
            $display_type == AD_SELECT_AFTER_CONTENT)
          $option = AD_SETTINGS_NOT_CHECKED;
      }

      return $option;
    }

   public function get_enable_manual (){
     $option = isset ($this->wp_options [AI_OPTION_ENABLE_MANUAL]) ? $this->wp_options [AI_OPTION_ENABLE_MANUAL] : "";
     if ($option == '') {
       $display_option = $this->get_display_type ();
       if ($display_option == AD_SELECT_MANUAL)
         $option = AD_SETTINGS_CHECKED; else
           $option = AD_SETTINGS_NOT_CHECKED;
     }
     return $option;
   }

    public function get_enable_widget (){
      global $ai_db_options;

      $enable_widget = isset ($this->wp_options [AI_OPTION_ENABLE_WIDGET]) ? $this->wp_options [AI_OPTION_ENABLE_WIDGET] : "";

//      if ($ai_db_options ['global']['VERSION'] < '010608') {
//        if (isset ($this->wp_options [AI_OPTION_DISPLAY_TYPE]) && $this->wp_options [AI_OPTION_DISPLAY_TYPE] == AD_SELECT_WIDGET) $enable_widget = AD_SETTINGS_CHECKED;
//          else {
//            // Check for block not set for Widgets but at least one Ad Inserter widget is used
//            $sidebar_widgets = wp_get_sidebars_widgets();
//            $widget_options = get_option ('widget_ai_widget');
//            foreach ($sidebar_widgets as $sidebar_index => $sidebar_widget) {
//              if (is_array ($sidebar_widget) && isset ($GLOBALS ['wp_registered_sidebars'][$sidebar_index]['name'])) {
//                $sidebar_name = $GLOBALS ['wp_registered_sidebars'][$sidebar_index]['name'];
//                if ($sidebar_name != "") {
//                  foreach ($sidebar_widget as $widget) {
//                    if (preg_match ("/ai_widget-([\d]+)/", $widget, $widget_id)) {
//                      if (isset ($widget_id [1]) && is_numeric ($widget_id [1])) {
//                        $widget_option = $widget_options [$widget_id [1]];
//                        $widget_block = $widget_option ['block'];
//                        if ($widget_block == $this->number) {
//                          $enable_widget = AD_SETTINGS_CHECKED;
//                          break 2;
//                        }
//                      }
//                    }
//                  }
//                }
//              }
//            }
//          }
//      }

//      if ($enable_widget == '') $enable_widget = AD_SETTINGS_NOT_CHECKED;

      if ($enable_widget == '') $enable_widget = AD_SETTINGS_CHECKED;

      return $enable_widget;
    }

   public function get_enable_php_call (){
     $option = isset ($this->wp_options [AI_OPTION_ENABLE_PHP_CALL]) ? $this->wp_options [AI_OPTION_ENABLE_PHP_CALL] : "";
     if ($option == '') $option = AD_SETTINGS_NOT_CHECKED;
     return $option;
   }

   public function get_paragraph_text (){
     $paragraph_text = isset ($this->wp_options [AI_OPTION_PARAGRAPH_TEXT]) ? $this->wp_options [AI_OPTION_PARAGRAPH_TEXT] : "";
     return $paragraph_text;
   }

   public function get_paragraph_text_type (){
     $option = isset ($this->wp_options [AI_OPTION_PARAGRAPH_TEXT_TYPE]) ? $this->wp_options [AI_OPTION_PARAGRAPH_TEXT_TYPE] : "";
     if ($option == '') $option = AD_DO_NOT_CONTAIN;
     return $option;
   }

   public function get_custom_css (){
      global $ai_db_options;

      $option = isset ($this->wp_options [AI_OPTION_CUSTOM_CSS]) ? $this->wp_options [AI_OPTION_CUSTOM_CSS] : "";

      // Fix for old bug
      if ($ai_db_options ['global']['VERSION'] < '010605' && strpos ($option, "Undefined index")) $option = "";

      return $option;
   }

   public function get_display_for_users (){
     if (isset ($this->wp_options [AI_OPTION_DISPLAY_FOR_USERS])) {
      $display_for_users = $this->wp_options [AI_OPTION_DISPLAY_FOR_USERS];
     } else $display_for_users = '';
     if ($display_for_users == '') $display_for_users = AD_DISPLAY_ALL_USERS;
     return $display_for_users;
   }

   public function get_display_for_devices (){
     if (isset ($this->wp_options [AI_OPTION_DISPLAY_FOR_DEVICES])) {
      $display_for_devices = $this->wp_options [AI_OPTION_DISPLAY_FOR_DEVICES];
     } else $display_for_devices = '';
     //                                convert old option
     if ($display_for_devices == '' || $display_for_devices == AD_DISPLAY_ALL_DEVICES) $display_for_devices = AD_DISPLAY_DESKTOP_DEVICES;
     return $display_for_devices;
   }

   public function get_detection_server_side(){
     // Check old settings for all devices
     if (isset ($this->wp_options [AI_OPTION_DISPLAY_FOR_DEVICES])) {
      $display_for_devices = $this->wp_options [AI_OPTION_DISPLAY_FOR_DEVICES];
     } else $display_for_devices = '';
     if ($display_for_devices == AD_DISPLAY_ALL_DEVICES) $option = AD_SETTINGS_NOT_CHECKED; else

       $option = isset ($this->wp_options [AI_OPTION_DETECT_SERVER_SIDE]) ? $this->wp_options [AI_OPTION_DETECT_SERVER_SIDE] : AD_SETTINGS_NOT_CHECKED;
     return $option;
   }

   public function get_detection_client_side(){
     global $ai_db_options;

     $option = isset ($this->wp_options [AI_OPTION_DETECT_CLIENT_SIDE]) ? $this->wp_options [AI_OPTION_DETECT_CLIENT_SIDE] : AD_SETTINGS_NOT_CHECKED;

      if ($ai_db_options ['global']['VERSION'] < '010605') {
        if (isset ($this->wp_options [AI_OPTION_DISPLAY_FOR_DEVICES])) {
         $display_for_devices = $this->wp_options [AI_OPTION_DISPLAY_FOR_DEVICES];
        } else $display_for_devices = '';

        if ($display_for_devices == AD_DISPLAY_ALL_DEVICES) $option = AD_SETTINGS_NOT_CHECKED;
      }

     return $option;
   }

    public function get_detection_viewport ($viewport){
      global $ai_db_options;

      $option_name = AI_OPTION_DETECT_VIEWPORT . '_' . $viewport;
      $option = isset ($this->wp_options [$option_name]) ? $this->wp_options [$option_name] : AD_SETTINGS_NOT_CHECKED;

      if ($ai_db_options ['global']['VERSION'] < '010605' && $this->get_detection_client_side()) {
        if (isset ($this->wp_options [AI_OPTION_DISPLAY_FOR_DEVICES])) {
         $display_for_devices = $this->wp_options [AI_OPTION_DISPLAY_FOR_DEVICES];
        } else $display_for_devices = '';

        if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES ||
            $display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES ||
            $display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES) {
             switch ($viewport) {
               case 1:
                 $option = AD_SETTINGS_CHECKED;
                 break;
               default:
                 $option = AD_SETTINGS_NOT_CHECKED;
             }
        }
        elseif ($display_for_devices == AD_DISPLAY_TABLET_DEVICES ||
                $display_for_devices == AD_DISPLAY_MOBILE_DEVICES ||
                $display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES) {
             switch ($viewport) {
               case 2:
                 $option = AD_SETTINGS_CHECKED;
                 break;
               default:
                 $option = AD_SETTINGS_NOT_CHECKED;
             }
        }
        elseif ($display_for_devices == AD_DISPLAY_PHONE_DEVICES ||
                $display_for_devices == AD_DISPLAY_MOBILE_DEVICES ||
                $display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES) {
             switch ($viewport) {
               case 3:
                 $option = AD_SETTINGS_CHECKED;
                 break;
               default:
                 $option = AD_SETTINGS_NOT_CHECKED;
             }
        }
        elseif ($display_for_devices == AD_DISPLAY_ALL_DEVICES) $option = AD_SETTINGS_NOT_CHECKED;
      }

      return $option;
    }

   public function get_ad_data_replaced(){

     $general_tag = isset ($this->wp_options [AI_OPTION_GENERAL_TAG]) ? $this->wp_options [AI_OPTION_GENERAL_TAG] : "";

     $general_tag = str_replace ("&amp;", " and ", $general_tag);
     $title = $general_tag;
     $short_title = $general_tag;
     $category = $general_tag;
     $short_category = $general_tag;
     $tag = $general_tag;
     $smart_tag = $general_tag;
     if (is_category ()) {
         $categories = get_the_category();
         if (!empty ($categories)) {
           $first_category = reset ($categories);
           $category = str_replace ("&amp;", "and", $first_category->name);
           if ($category == "Uncategorized") $category = $general_tag;
         } else {
             $category = $general_tag;
         }
         if (strpos ($category, ",") !== false) {
           $short_category = trim (substr ($category, 0, strpos ($category, ",")));
         } else $short_category = $category;
         if (strpos ($short_category, "and") !== false) {
           $short_category = trim (substr ($short_category, 0, strpos ($short_category, "and")));
         }

         $title = $category;
         $title = str_replace ("&amp;", "and", $title);
         $short_title = implode (" ", array_slice (explode (" ", $title), 0, 3));
         $tag = $short_title;
         $smart_tag = $short_title;
     } elseif (is_tag ()) {
         $title = single_tag_title('', false);
         $title = str_replace (array ("&amp;", "#"), array ("and", ""), $title);
         $short_title = implode (" ", array_slice (explode (" ", $title), 0, 3));
         $category = $short_title;
         if (strpos ($category, ",") !== false) {
           $short_category = trim (substr ($category, 0, strpos ($category, ",")));
         } else $short_category = $category;
         if (strpos ($short_category, "and") !== false) {
           $short_category = trim (substr ($short_category, 0, strpos ($short_category, "and")));
         }
         $tag = $short_title;
         $smart_tag = $short_title;
     } elseif (is_search ()) {
         $title = get_search_query();
         $title = str_replace ("&amp;", "and", $title);
         $short_title = implode (" ", array_slice (explode (" ", $title), 0, 3));
         $category = $short_title;
         if (strpos ($category, ",") !== false) {
           $short_category = trim (substr ($category, 0, strpos ($category, ",")));
         } else $short_category = $category;
         if (strpos ($short_category, "and") !== false) {
           $short_category = trim (substr ($short_category, 0, strpos ($short_category, "and")));
         }
         $tag = $short_title;
         $smart_tag = $short_title;
     } elseif (is_page () || is_single ()) {
         $title = get_the_title();
         $title = str_replace ("&amp;", "and", $title);

         $short_title = implode (" ", array_slice (explode (" ", $title), 0, 3));

         $categories = get_the_category();
         if (!empty ($categories)) {
           $first_category = reset ($categories);
           $category = str_replace ("&amp;", "and", $first_category->name);
           if ($category == "Uncategorized") $category = $general_tag;
         } else {
             $category = $short_title;
         }
         if (strpos ($category, ",") !== false) {
           $short_category = trim (substr ($category, 0, strpos ($category, ",")));
         } else $short_category = $category;
         if (strpos ($short_category, "and") !== false) {
           $short_category = trim (substr ($short_category, 0, strpos ($short_category, "and")));
         }

         $tags = get_the_tags();
         if (!empty ($tags)) {

           $first_tag = reset ($tags);
           $tag = str_replace (array ("&amp;", "#"), array ("and", ""), $first_tag->name);

           $tag_array = array ();
           foreach ($tags as $tag_data) {
             $tag_array [] = explode (" ", $tag_data->name);
           }

           $selected_tag = '';

           if (count ($tag_array [0]) == 2) $selected_tag = $tag_array [0];
           elseif (count ($tag_array) > 1 && count ($tag_array [1]) == 2) $selected_tag = $tag_array [1];
           elseif (count ($tag_array) > 2 && count ($tag_array [2]) == 2) $selected_tag = $tag_array [2];
           elseif (count ($tag_array) > 3 && count ($tag_array [3]) == 2) $selected_tag = $tag_array [3];
           elseif (count ($tag_array) > 4 && count ($tag_array [4]) == 2) $selected_tag = $tag_array [4];


           if ($selected_tag == '' && count ($tag_array) >= 2 && count ($tag_array [0]) == 1 && count ($tag_array [1]) == 1) {

             if (strpos ($tag_array [0][0], $tag_array [1][0]) !== false) $tag_array = array_slice ($tag_array, 1, count ($tag_array) - 1);
             if (strpos ($tag_array [1][0], $tag_array [0][0]) !== false) $tag_array = array_slice ($tag_array, 1, count ($tag_array) - 1);

             if (count ($tag_array) >= 2 && count ($tag_array [0]) == 1 && count ($tag_array [1]) == 1) {
               $selected_tag = array ($tag_array [0][0], $tag_array [1][0]);
             }
           }

           if ($selected_tag == '') {
             $first_tag = reset ($tags);
             $smart_tag = implode (" ", array_slice (explode (" ", $first_tag->name), 0, 3));
           } else $smart_tag = implode (" ", $selected_tag);

           $smart_tag = str_replace (array ("&amp;", "#"), array ("and", ""), $smart_tag);

         } else {
             $tag = $category;
             $smart_tag = $category;
         }
     }

     $title = str_replace (array ("'", '"'), array ("&#8217;", "&#8221;"), $title);
     $title = html_entity_decode ($title, ENT_QUOTES, "utf-8");

     $short_title = str_replace (array ("'", '"'), array ("&#8217;", "&#8221;"), $short_title);
     $short_title = html_entity_decode ($short_title, ENT_QUOTES, "utf-8");

     $search_query = "";
     if (isset ($_SERVER['HTTP_REFERER'])) {
       $referrer = $_SERVER['HTTP_REFERER'];
     } else $referrer = '';
     if (preg_match ("/[\.\/](google|yahoo|bing|ask)\.[a-z\.]{2,5}[\/]/i", $referrer, $search_engine)){
        $referrer_query = parse_url ($referrer);
        $referrer_query = isset ($referrer_query ["query"]) ? $referrer_query ["query"] : "";
        parse_str ($referrer_query, $value);
        $search_query = isset ($value ["q"]) ? $value ["q"] : "";
        if ($search_query == "") {
          $search_query = isset ($value ["p"]) ? $value ["p"] : "";
        }
     }
     if ($search_query == "") $search_query = $smart_tag;

     $author = get_the_author_meta ('display_name');
     $author_name = get_the_author_meta ('first_name') . " " . get_the_author_meta ('last_name');
     if ($author_name == '') $author_name = $author;

     $ad_data = preg_replace ("/{title}/i",          $title,          parent::get_ad_data());
     $ad_data = preg_replace ("/{short_title}/i",    $short_title,    $ad_data);
     $ad_data = preg_replace ("/{category}/i",       $category,       $ad_data);
     $ad_data = preg_replace ("/{short_category}/i", $short_category, $ad_data);
     $ad_data = preg_replace ("/{tag}/i",            $tag,            $ad_data);
     $ad_data = preg_replace ("/{smart_tag}/i",      $smart_tag,      $ad_data);
     $ad_data = preg_replace ("/{search_query}/i",   $search_query,   $ad_data);
     $ad_data = preg_replace ("/{author}/i",         $author,         $ad_data);
     $ad_data = preg_replace ("/{author_name}/i",    $author_name,    $ad_data);

     return $ad_data;
   }

   public function get_ad_general_tag(){
     $option = isset ($this->wp_options [AI_OPTION_GENERAL_TAG]) ? $this->wp_options [AI_OPTION_GENERAL_TAG] : "";
     if ($option == '') $option = AD_GENERAL_TAG;
     return $option;
   }

  public function get_ad_after_day(){
     $option = isset ($this->wp_options [AI_OPTION_AFTER_DAYS]) ? $this->wp_options [AI_OPTION_AFTER_DAYS] : "";
     if ($option == '') $option = AD_ZERO;
     return $option;
  }

  public function get_maximum_insertions (){
     $option = isset ($this->wp_options [AI_OPTION_MAXIMUM_INSERTIONS]) ? $this->wp_options [AI_OPTION_MAXIMUM_INSERTIONS] : "";
     if ($option == '') $option = AD_ZERO;
     return $option;
  }

  public function get_ad_url_list(){
     $option = isset ($this->wp_options [AI_OPTION_URL_LIST]) ? $this->wp_options [AI_OPTION_URL_LIST] : "";
     return $option;
  }

  public function get_ad_url_list_type (){
     $option = isset ($this->wp_options [AI_OPTION_URL_LIST_TYPE]) ? $this->wp_options [AI_OPTION_URL_LIST_TYPE] : "";
     if ($option == '') $option = AD_BLACK_LIST;
     return $option;
  }

  public function get_ad_domain_list(){
     $option = isset ($this->wp_options [AI_OPTION_DOMAIN_LIST]) ? $this->wp_options [AI_OPTION_DOMAIN_LIST] : "";
     return $option;
  }

  public function get_ad_domain_list_type (){
     $option = isset ($this->wp_options [AI_OPTION_DOMAIN_LIST_TYPE]) ? $this->wp_options [AI_OPTION_DOMAIN_LIST_TYPE] : "";
     if ($option == '') $option = AD_BLACK_LIST;
     return $option;
  }

	public function get_ad_name(){
     $option = isset ($this->wp_options [AI_OPTION_NAME]) ? $this->wp_options [AI_OPTION_NAME] : "";
     if ($option == '') $option = AD_NAME. " " . $this->number;
     return $option;
  }

  public function get_ad_block_cat(){
     $option = isset ($this->wp_options [AI_OPTION_CATEGORY_LIST]) ? $this->wp_options [AI_OPTION_CATEGORY_LIST] : "";
     return $option;
  }

  public function get_ad_block_cat_type(){
     $option = isset ($this->wp_options [AI_OPTION_CATEGORY_LIST_TYPE]) ? $this->wp_options [AI_OPTION_CATEGORY_LIST_TYPE] : "";

     // Update old data
     if ($option == ''){
       $option = AD_BLACK_LIST;
       $this->wp_options [AI_OPTION_CATEGORY_LIST_TYPE] = AD_BLACK_LIST;
     }

     if ($option == '') $option = AD_BLACK_LIST;
     return $option;
   }

  public function get_ad_block_tag(){
     $option = isset ($this->wp_options [AI_OPTION_TAG_LIST]) ? $this->wp_options [AI_OPTION_TAG_LIST] : "";
     return $option;
  }

  public function get_ad_block_tag_type(){
     $option = isset ($this->wp_options [AI_OPTION_TAG_LIST_TYPE]) ? $this->wp_options [AI_OPTION_TAG_LIST_TYPE] : "";
     if ($option == '') $option = AD_BLACK_LIST;
     return $option;
  }

  public function get_ad_enabled_on_which_pages (){
    $option = isset ($this->wp_options [AI_OPTION_ENABLED_ON_WHICH_PAGES]) ? $this->wp_options [AI_OPTION_ENABLED_ON_WHICH_PAGES] : "";
    if ($option == '') $option = AD_ENABLED_ON_ALL;
    return $option;
  }

  public function get_ad_enabled_on_which_posts (){
    $option = isset ($this->wp_options [AI_OPTION_ENABLED_ON_WHICH_POSTS]) ? $this->wp_options [AI_OPTION_ENABLED_ON_WHICH_POSTS] : "";
    if ($option == '') $option = AD_ENABLED_ON_ALL;
    return $option;
  }

  public function get_viewport_classes (){
    $viewport_classes = "";
    if ($this->get_detection_client_side ()) {
      $all_viewports = true;
      for ($viewport = 1; $viewport <= AD_INSERTER_VIEWPORTS; $viewport ++) {
        $viewport_name = get_viewport_name ($viewport);
        if ($viewport_name != '') {
          if ($this->get_detection_viewport ($viewport)) $viewport_classes .= " ai-viewport-" . $viewport; else $all_viewports = false;
        }
      }
      if ($viewport_classes == "") $viewport_classes = " ai-viewport-0";
        elseif ($all_viewports) $viewport_classes = "";
    }
    return ($viewport_classes);
  }

  public function before_paragraph ($content, &$inserted) {

    $paragraph_positions = array ();

    $paragraph_tags = trim ($this->get_paragraph_tags());
    if ($paragraph_tags == '') return $content;

    $paragraph_start_strings = explode (",", $paragraph_tags);

    if (count ($paragraph_start_strings) == 0) return $content;

    foreach ($paragraph_start_strings as $paragraph_start_string) {
      if (trim ($paragraph_start_string) == '') continue;

      $last_position = - 1;

      $paragraph_start_string = trim ($paragraph_start_string);
      if ($paragraph_start_string == "#") {
        $paragraph_start = "\r\n\r\n";
        if (!in_array (0, $paragraph_positions)) $paragraph_positions [] = 0;
      } else $paragraph_start = '<' . $paragraph_start_string;

      $paragraph_start_len = strlen ($paragraph_start);

      while (stripos ($content, $paragraph_start, $last_position + 1) !== false) {
        $last_position = stripos ($content, $paragraph_start, $last_position + 1);
        if ($paragraph_start_string == "#" || $content [$last_position + $paragraph_start_len] == ">" || $content [$last_position + $paragraph_start_len] == " ")
          $paragraph_positions [] = $last_position;
      }
    }

    // Nothing to do
    if (sizeof ($paragraph_positions) == 0) return $content;

    sort ($paragraph_positions);

    $paragraph_min_words = $this->get_minimum_paragraph_words();
    if ($paragraph_min_words != 0) {
      $filtered_paragraph_positions = array ();
      foreach ($paragraph_positions as $index => $paragraph_position) {
        $paragraph_code = $index == count ($paragraph_positions) - 1 ? substr ($content, $paragraph_position) : substr ($content, $paragraph_position, $paragraph_positions [$index + 1] - $paragraph_position);
        $number_of_words = sizeof (explode (" ", strip_tags ($paragraph_code)));
        if ($number_of_words >= $paragraph_min_words) $filtered_paragraph_positions [] = $paragraph_position;
      }
      $paragraph_positions = $filtered_paragraph_positions;
    }

    $paragraph_texts = explode (",", html_entity_decode ($this->get_paragraph_text()));
    if ($this->get_paragraph_text() != "" && count ($paragraph_texts != 0)) {

      $filtered_paragraph_positions = array ();
      $paragraph_text_type = $this->get_paragraph_text_type ();

      foreach ($paragraph_positions as $index => $paragraph_position) {
        $paragraph_code = $index == count ($paragraph_positions) - 1 ? substr ($content, $paragraph_position) : substr ($content, $paragraph_position, $paragraph_positions [$index + 1] - $paragraph_position);

        if ($paragraph_text_type == AD_CONTAIN) {
          $found = true;
          foreach ($paragraph_texts as $paragraph_text) {
            if (stripos ($paragraph_code, trim ($paragraph_text)) === false) {
              $found = false;
              break;
            }
          }
          if ($found) $filtered_paragraph_positions [] = $paragraph_position;
        } elseif ($paragraph_text_type == AD_DO_NOT_CONTAIN) {
            $found = false;
            foreach ($paragraph_texts as $paragraph_text) {
              if (stripos ($paragraph_code, trim ($paragraph_text)) !== false) {
                $found = true;
                break;
              }
            }
            if (!$found) $filtered_paragraph_positions [] = $paragraph_position;
          }
      }

      $paragraph_positions = $filtered_paragraph_positions;
    }

    // Nothing to do
    if (sizeof ($paragraph_positions) == 0) return $content;

    $position = $this->get_paragraph_number();

    if ($position > 0 && $position < 1) {
      $position = intval ($position * (sizeof ($paragraph_positions) - 1) + 0.5);
    }
    elseif ($position <= 0) {
      $position = rand (0, sizeof ($paragraph_positions) - 1);
    } else $position --;

    if ($this->get_direction_type() == AD_DIRECTION_FROM_BOTTOM) {
      $paragraph_positions = array_reverse ($paragraph_positions);
    }

    $text = str_replace ("\r", "", $content);
    $text = str_replace (array ("\n", "  "), " ", $text);
    $text = str_replace ("  ", " ", $text);
    $text = strip_tags ($text);
    $number_of_words = sizeof (explode (" ", $text));

    if (sizeof ($paragraph_positions) > $position && sizeof ($paragraph_positions) >= $this->get_paragraph_number_minimum() && $number_of_words >= $this->get_minimum_words()) {
      $content_position = $paragraph_positions [$position];

      $block_class_name = get_block_class_name ();

      $display_for_devices = $this->get_display_for_devices ();

      if ($this->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) $content = substr_replace ($content, ai_getAdCode ($this), $content_position, 0); else
        $content = substr_replace ($content, "<div class='" . $block_class_name . " " . $block_class_name . "-" . $this->number . $this->get_viewport_classes () . "' style='" . $this->get_alignmet_style() . "'>" . ai_getAdCode ($this) . "</div>", $content_position, 0);

      $inserted = true;
    }

    return $content;
  }

  public function after_paragraph ($content, &$inserted) {

    $paragraph_positions = array ();
    $last_content_position = strlen ($content) - 1;

    $paragraph_tags = trim ($this->get_paragraph_tags());
    if ($paragraph_tags == '') return $content;

    $paragraph_end_strings = explode (",", $paragraph_tags);

    if (count ($paragraph_end_strings) == 0) return $content;

    foreach ($paragraph_end_strings as $paragraph_end_string) {
      if (trim ($paragraph_end_string) == '') continue;

      $last_position = - 1;

      $paragraph_end_string = trim ($paragraph_end_string);
      if ($paragraph_end_string == "#") {
        $paragraph_end = "\r\n\r\n";
        if (!in_array ($last_content_position, $paragraph_positions)) $paragraph_positions [] = $last_content_position;
      } else $paragraph_end = '</' . $paragraph_end_string . '>';

      while (stripos ($content, $paragraph_end, $last_position + 1) !== false) {
        $last_position = stripos ($content, $paragraph_end, $last_position + 1) + strlen ($paragraph_end) - 1;
        $paragraph_positions [] = $last_position;
      }
    }

    // Nothing to do
    if (sizeof ($paragraph_positions) == 0) return $content;

    sort ($paragraph_positions);

    $paragraph_min_words = $this->get_minimum_paragraph_words();
    if ($paragraph_min_words != 0) {
      $filtered_paragraph_positions = array ();
      foreach ($paragraph_positions as $index => $paragraph_position) {
        $paragraph_code = $index == 0 ? substr ($content, 0, $paragraph_position + 1) : substr ($content, $paragraph_positions [$index - 1] + 1, $paragraph_position - $paragraph_positions [$index - 1]);
        $number_of_words = sizeof (explode (" ", strip_tags ($paragraph_code)));
        if ($number_of_words >= $paragraph_min_words) $filtered_paragraph_positions [] = $paragraph_position;
      }
      $paragraph_positions = $filtered_paragraph_positions;
    }

    $paragraph_texts = explode (",", html_entity_decode ($this->get_paragraph_text()));
    if ($this->get_paragraph_text() != "" && count ($paragraph_texts != 0)) {

      $filtered_paragraph_positions = array ();
      $paragraph_text_type = $this->get_paragraph_text_type ();

      foreach ($paragraph_positions as $index => $paragraph_position) {
        $paragraph_code = $index == 0 ? substr ($content, 0, $paragraph_position + 1) : substr ($content, $paragraph_positions [$index - 1] + 1, $paragraph_position - $paragraph_positions [$index - 1]);

        if ($paragraph_text_type == AD_CONTAIN) {
          $found = true;
          foreach ($paragraph_texts as $paragraph_text) {
            if (stripos ($paragraph_code, trim ($paragraph_text)) === false) {
              $found = false;
              break;
            }
          }
          if ($found) $filtered_paragraph_positions [] = $paragraph_position;
        } elseif ($paragraph_text_type == AD_DO_NOT_CONTAIN) {
            $found = false;
            foreach ($paragraph_texts as $paragraph_text) {
              if (stripos ($paragraph_code, trim ($paragraph_text)) !== false) {
                $found = true;
                break;
              }
            }
            if (!$found) $filtered_paragraph_positions [] = $paragraph_position;
          }
      }

      $paragraph_positions = $filtered_paragraph_positions;
    }

    // Nothing to do
    if (sizeof ($paragraph_positions) == 0) return $content;

    $position = $this->get_paragraph_number();

    if ($position > 0 && $position < 1) {
      $position = intval ($position * (sizeof ($paragraph_positions) - 1) + 0.5);
    }
    elseif ($position <= 0) {
      $position = rand (0, sizeof ($paragraph_positions) - 1);
    } else $position --;

    if ($this->get_direction_type() == AD_DIRECTION_FROM_BOTTOM) {
      $paragraph_positions = array_reverse ($paragraph_positions);
    }

    $text = str_replace ("\r", "", $content);
    $text = str_replace (array ("\n", "  "), " ", $text);
    $text = str_replace ("  ", " ", $text);
    $text = strip_tags ($text);
    $number_of_words = sizeof (explode (" ", $text));

    if (sizeof ($paragraph_positions) > $position && sizeof ($paragraph_positions) >= $this->get_paragraph_number_minimum() && $number_of_words >= $this->get_minimum_words()) {
      $content_position = $paragraph_positions [$position];

      $block_class_name = get_block_class_name ();

      $display_for_devices = $this->get_display_for_devices ();

      if ($content_position >= strlen ($content) - 1) {
        if ($this->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) $content = $content . ai_getAdCode ($this); else
          $content = $content . "<div class='" . $block_class_name . " " . $block_class_name . "-" . $this->number . $this->get_viewport_classes () . "' style='" . $this->get_alignmet_style() . "'>" . ai_getAdCode ($this) . "</div>";
      } else {
          if ($this->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) $content = substr_replace ($content, ai_getAdCode ($this), $content_position + 1, 0); else
            $content = substr_replace ($content, "<div class='" . $block_class_name . " " . $block_class_name . "-" . $this->number . $this->get_viewport_classes () . "' style='" . $this->get_alignmet_style() . "'>" . ai_getAdCode ($this) . "</div>", $content_position + 1, 0);
        }

      $inserted = true;
    }

    return $content;
  }

  public function before_content ($content) {
    $block_class_name = get_block_class_name ();

    $display_for_devices = $this->get_display_for_devices ();

    $text = str_replace (array ("\n", "  "), " ", $content);
    $text = strip_tags ($text);
    $number_of_words = sizeof (explode (" ", $text));

    if ($number_of_words < $this->get_minimum_words()) return $content;

    if ($this->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) return ai_getAdCode ($this) . $content; else
      return "<div class='" . $block_class_name . " " . $block_class_name . "-" . $this->number . $this->get_viewport_classes () . "' style='" . $this->get_alignmet_style() . "'>" . ai_getAdCode ($this) . "</div>" . $content;
  }

  public function after_content ($content) {
    $block_class_name = get_block_class_name ();

    $display_for_devices = $this->get_display_for_devices ();

    $text = str_replace (array ("\n", "  "), " ", $content);
    $text = strip_tags ($text);
    $number_of_words = sizeof (explode (" ", $text));

    if ($number_of_words < $this->get_minimum_words()) return $content;

    if ($this->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) return $content . ai_getAdCode ($this); else
      return $content . "<div class='" . $block_class_name . " " . $block_class_name . "-" . $this->number . $this->get_viewport_classes () . "' style='" . $this->get_alignmet_style() . "'>" . ai_getAdCode ($this) . "</div>";
  }

//  Deprecated
  function manual ($content){

    if (preg_match_all("/{adinserter (.+?)}/", $content, $tags)){

      $block_class_name = get_block_class_name ();

      $display_for_devices = $this->get_display_for_devices ();

      foreach ($tags [1] as $tag) {
         $ad_tag = strtolower (trim ($tag));
         $ad_name = strtolower (trim ($this->get_ad_name()));
         if ($ad_tag == $ad_name || $ad_tag == $this->number) {
          if ($this->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) $ad_code = ai_getAdCode ($this); else
            $ad_code = "<div class='" . $block_class_name . " " . $block_class_name . "-" . $this->number . $this->get_viewport_classes () . "' style='" . $this->get_alignmet_style() . "'>" . ai_getAdCode ($this) . "</div>";
          $content = preg_replace ("/{adinserter " . $tag . "}/", $ad_code, $content);
         }
      }
    }

    return $content;
  }

//  Deprecated
  function display_disabled ($content){

    $ad_name = $this->get_ad_name();

    if (preg_match ("/<!-- +Ad +Inserter +Ad +".($this->number)." +Disabled +-->/i", $content)) return true;

    if (preg_match ("/<!-- +disable +adinserter +\* +-->/i", $content)) return true;

    if (preg_match ("/<!-- +disable +adinserter +".($this->number)." +-->/i", $content)) return true;

    if (strpos ($content, "<!-- disable adinserter " . $ad_name . " -->") != false) return true;

    return false;
  }

  function check_category () {

    $categories = trim (strtolower ($this->get_ad_block_cat()));
    $cat_type = $this->get_ad_block_cat_type();

  //  echo ' listed categories: ' . $categories, "<br />\n";

    if ($cat_type == AD_BLACK_LIST) {

      if($categories == AD_EMPTY_DATA) return true;

      $cats_listed = explode (",", $categories);

      foreach (get_the_category() as $post_category) {

        //echo '<br/> post category name : ' . $post_category->cat_name;

        foreach ($cats_listed as $cat_disabled){

          $cat_disabled = trim ($cat_disabled);

          $post_category_name = strtolower ($post_category->cat_name);
          $post_category_slug = strtolower ($post_category->slug);

          //echo '<br/>Category disabled loop : ' . $cat_disabled . '<br/> category name : ' . $post_category_name;

          if ($post_category_name == $cat_disabled || $post_category_slug == $cat_disabled) {
            //echo ' match';
            return false;
          }else{
            //echo ' not match';
          }
        }
      }
      return true;

    } else {

        if ($categories == AD_EMPTY_DATA) return false;

        $cats_listed = explode (",", $categories);

        foreach (get_the_category() as $post_category) {

          //echo '<br/> post category name : ' . $post_category->cat_name;

          foreach ($cats_listed as $cat_enabled) {

            $cat_enabled = trim ($cat_enabled);

            $post_category_name = strtolower ($post_category->cat_name);
            $post_category_slug = strtolower ($post_category->slug);

  //          echo '<br/>Category enabled loop : ' . $cat_enabled . '<br/> category name : ' . $post_category_name . '<br/> category slug: ' . $post_category_slug;

            if ($post_category_name == $cat_enabled || $post_category_slug == $cat_enabled) {
  //            echo '#match';
              return true;
            }else{
  //            echo '#no match';
            }
          }
        }
        return false;
      }
  }

  function check_tag () {

    $tags = $this->get_ad_block_tag();
    $tag_type = $this->get_ad_block_tag_type();

    $tags = trim (strtolower ($tags));
    $tags_listed = explode (",", $tags);
    foreach ($tags_listed as $index => $tag_listed) {
      $tags_listed [$index] = trim ($tag_listed);
    }
    $has_any_of_the_given_tags = has_tag ($tags_listed);

  //  echo ' listed tags: ' . $tags, "\n";

    if ($tag_type == AD_BLACK_LIST) {

      if ($tags == AD_EMPTY_DATA) return true;

      if (is_tag()) {
        foreach ($tags_listed as $tag_listed) {
          if (is_tag ($tag_listed)) return false;
        }
        return true;
      }

      return !$has_any_of_the_given_tags;

    } else {

        if ($tags == AD_EMPTY_DATA) return false;

        if (is_tag()) {
          foreach ($tags_listed as $tag_listed) {
            if (is_tag ($tag_listed)) return true;
          }
          return false;
        }

        return $has_any_of_the_given_tags;
      }
  }

  function check_url () {

    $urls = $this->get_ad_url_list();
    $url_type = $this->get_ad_url_list_type();

    $page_url = $_SERVER ['REQUEST_URI'];

    $urls = trim ($urls);
    $urls_listed = explode (" ", $urls);
    foreach ($urls_listed as $index => $url_listed) {
      if ($url_listed == "") unset ($urls_listed [$index]); else
        $urls_listed [$index] = trim ($url_listed);
    }

  //  print_r ($urls_listed);
  //  echo "<br />\n";
  //  echo ' page url: ' . $page_url, "<br />\n";
  //  echo ' listed urls: ' . $urls, "\n";
  //  echo "<br />\n";

    if ($url_type == AD_BLACK_LIST) $return = false; else $return = true;

    if ($urls == AD_EMPTY_DATA) {
      return !$return;
    }

    foreach ($urls_listed as $url_listed) {
      if ($url_listed [0] == '') continue;
      if ($url_listed == '*') return $return;

      if ($url_listed [0] == '*') {
        if ($url_listed [strlen ($url_listed) - 1] == '*') {
          $url_listed = substr ($url_listed, 1, strlen ($url_listed) - 2);
          if (strpos ($page_url, $url_listed) !== false) return $return;
        } else {
            $url_listed = substr ($url_listed, 1);
            if (substr ($page_url, - strlen ($url_listed)) == $url_listed) return $return;
          }
      }
      elseif ($url_listed [strlen ($url_listed) - 1] == '*') {
        $url_listed = substr ($url_listed, 0, strlen ($url_listed) - 1);
        if (strpos ($page_url, $url_listed) === 0) return $return;
      }
      else if ($url_listed == $page_url) return $return;
    }
    return !$return;
  }

  function check_date () {

    $after_days = trim ($this->get_ad_after_day());

    // If 0 display immediately
    if($after_days == AD_ZERO || $after_days == AD_EMPTY_DATA) return true;

    return (date ('U', time ()) >= get_the_date ('U') + $after_days * 86400);
  }

  function check_referer () {

    $domain_list_type = $this->get_ad_domain_list_type ();

    if (isset ($_SERVER['HTTP_REFERER'])) {
        $http_referer = $_SERVER['HTTP_REFERER'];
    } else $http_referer = '';

    if ($domain_list_type == AD_BLACK_LIST) $return = false; else $return = true;

    $domains = trim ($this->get_ad_domain_list ());
    if ($domains == "") return !$return;
    $domains = explode (",", $domains);

    foreach ($domains as $domain) {
      $domain = trim ($domain);
      if ($domain == "") continue;

      if ($domain == "#") {
        if ($http_referer == "") return $return;
      } elseif (preg_match ("/" . $domain . "/i", $http_referer)) return $return;
    }
    return !$return;
  }

  function check_and_increment_block_counter () {
    global $ad_interter_globals;

    $global_name = 'BLOCK_' . $this->number . '_COUNTER';
    $max_insertions = $this->get_maximum_insertions ();
    if (!isset ($ad_interter_globals [$global_name])) {
      $ad_interter_globals [$global_name] = 0;
    }
    if ($max_insertions != 0 && $ad_interter_globals [$global_name] >= $max_insertions) return false;
    $ad_interter_globals [$global_name] ++;
    return true;
  }

  function check_block_counter () {
    global $ad_interter_globals;

    $global_name = 'BLOCK_' . $this->number . '_COUNTER';
    $max_insertions = $this->get_maximum_insertions ();
    if (!isset ($ad_interter_globals [$global_name])) {
      $ad_interter_globals [$global_name] = 0;
    }
    if ($max_insertions != 0 && $ad_interter_globals [$global_name] >= $max_insertions) return false;
    return true;
  }

  function increment_block_counter () {
    global $ad_interter_globals;

    $global_name = 'BLOCK_' . $this->number . '_COUNTER';
    if (!isset ($ad_interter_globals [$global_name])) {
      $ad_interter_globals [$global_name] = 0;
    }
    $ad_interter_globals [$global_name] ++;
    return;
  }

}


class ai_Block extends ai_CodeBlock {

    public function __construct ($number) {
      parent::__construct();

      $this->number = $number;
      $this->wp_options [AI_OPTION_NAME] = AD_NAME." ".$number;
    }
}

class ai_AdH extends ai_BaseCodeBlock {

  public function __construct () {
    parent::__construct();
  }
}

class ai_AdF extends ai_BaseCodeBlock {

  public function __construct () {
    parent::__construct();
  }
}
