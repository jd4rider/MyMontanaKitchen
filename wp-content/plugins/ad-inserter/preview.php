<?php

function generate_code_preview ($block) {

  global $block_object;

  function margin_css ($style) {
    $style .= ";";
    $clean_style = "border-width: 0; ";
    if (preg_match_all ("/(margin|float)([^;]+)/", strtolower ($style).";", $css)) {
      $clean_style .= implode ("; ", $css [0]) .";";
    }
    $clean_style = str_replace (array ("margin", "auto"), array ("border-width", "0"), $clean_style);
    $clean_style = str_replace (array ("border-width-top", "border-width-right", "border-width-bottom", "border-width-left"),
                                array ("border-top-width", "border-right-width", "border-bottom-width", "border-left-width"), $clean_style);
    return trim ($clean_style);
  }

  function no_margin_css ($style) {
    $clean_style = preg_replace ("/margin([^;]+;?)/", "", $style);
    return trim ($clean_style);
  }



//  $style = "padding-top: 15px; margin-bottom: 25px; margin-top: 10px;";
//  echo $style, "\n";
//  echo no_margin_css ($style), "\n";

  $obj = $block_object [$block];

?><html>
<head>
<title><?php echo AD_INSERTER_TITLE; ?> Code Preview</title>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js'></script>
<link rel='stylesheet' href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css'>
<script>
  window.onkeydown = function( event ) {
    if (event.keyCode === 27 ) {
      window.close();
    }
  }

  jQuery(document).ready(function($) {

    $("#highlight-button").button ({
    }).click (function () {

//      $('#margin').toggleClass ("highlighted");
//      $('#code-overlay-background').toggleClass ("highlighted");
//      $('#code-overlay').toggleClass ("highlighted");
//      $('#demo-box').toggle ();

      $('body').toggleClass ("highlighted");
      $('#demo-box').toggle ();

      if (!$('body').hasClass ("highlighted")) return;

      console.log ("highlighting");


      var code_overlay_left    = 100000;
      var code_overlay_top     = 100000;
      var code_overlay_right   = 0;
      var code_overlay_bottom  = 0;

      var code_overlay_width   = 0;
      var code_overlay_height  = 0;

//      var wrapper = $("#wrapper");
//      var wrapper_offset = {top: 0, left: 0};
//      var wrapper_margin_top  = 0;
//      var wrapper_margin_left = 0;
//      var wrapper_border_top  = 0;
//      var wrapper_border_left = 0;
//      if (wrapper.length) {
//        wrapper_offset = wrapper.offset ();
//        wrapper_margin_top  = parseInt (wrapper.css ('marginTop'));
//        wrapper_margin_left = parseInt (wrapper.css ('marginLeft'));
//        wrapper_border_top  = parseInt (wrapper.css ('borderTop'));
//        wrapper_border_left = parseInt (wrapper.css ('borderLeft'));
//      }

      var code_offset  = $('#code').offset ();

      var code_left   = code_offset.left;
      var code_top    = code_offset.top;
      var code_width  = $('#code').outerWidth (true);
      var code_height = $('#code').outerHeight (true);


//      console.log ("wrapper_offset: top: " + wrapper_offset.top + ", left: " + wrapper_offset.left);
      console.log ("code_left: " + code_left);
      console.log ("code_top: " + code_top);
      console.log ("code_width: " + code_width);
      console.log ("code_height: " + code_height);

      $('#code').children ().each (function () {

        var element_tag = $(this).prop("tagName").toLowerCase();

        if (element_tag != 'script') {

          var element_offset = $(this).offset ();

          console.log ("");
          console.log ("tag: " + $(this).prop("tagName"));
          console.log ("top: " + element_offset.top);
          console.log ("marginTop: " + $(this).css ('marginTop'));
          console.log ("left: " + element_offset.left);
          console.log ("marginLeft: " + $(this).css ('marginLeft'));
          console.log ("outerWidth: " + $(this).outerWidth (true));
          console.log ("outerHeight: " + $(this).outerHeight (true));

          var element_left  = element_offset.left - parseInt ($(this).css ('marginLeft'));
          var element_width = $(this).outerWidth (true);
          var element_right = element_left + element_width;

          if (element_left < code_overlay_left) {
            code_overlay_left = element_left;
          }

          if (element_right > code_overlay_right) {
            code_overlay_right = element_right;
          }

          var element_top     = element_offset.top - parseInt ($(this).css ('marginTop'));
          var element_height  = $(this).outerHeight (true);
          var element_bottom  = element_top + element_height;

          if (element_top < code_overlay_top) {
            code_overlay_top = element_top;
          }

          if (element_bottom > code_overlay_bottom) {
            code_overlay_bottom = element_bottom;
          }

          console.log ("==============");
          console.log ("code_overlay_top: " + code_overlay_top);
          console.log ("code_overlay_left: " + code_overlay_left);
          console.log ("code_overlay_right: " + code_overlay_right);
          console.log ("code_overlay_bottom: " + code_overlay_bottom);
        }
      });

      if (code_overlay_left < code_left) code_overlay_left = code_left;
      if (code_overlay_top  < code_top)  code_overlay_top  = code_top;

      code_overlay_width   = code_overlay_right - code_overlay_left;
      code_overlay_height  = code_overlay_bottom - code_overlay_top;

      if (code_overlay_width > code_width)   code_overlay_width = code_width;
      if (code_overlay_height > code_height) code_overlay_height  = code_height;

      $('#code-overlay').offset ({top: code_overlay_top, left: code_overlay_left});
      $('#code-overlay').css ('width', code_overlay_width);
      $('#code-overlay').css ('height', code_overlay_height);

      console.log ("");
      console.log ("==============");
      console.log ('code-overlay: top: ' + $('#code-overlay').offset ().top + ", left: " + $('#code-overlay').offset ().left);
      console.log ("code_overlay_width: " + code_overlay_width);
      console.log ("code_overlay_height: " + code_overlay_height);

//      $('#code-overlay-background').offset ({top: code_overlay_top - wrapper_offset.top - wrapper_border_top - wrapper_margin_top, left: code_overlay_left - wrapper_offset.left - wrapper_border_left - wrapper_margin_left});
      $('#code-overlay-background').offset ({top: code_overlay_top, left: code_overlay_left});
      $('#code-overlay-background').css ('width', code_overlay_width);
      $('#code-overlay-background').css ('height', code_overlay_height);

      console.log ("");
      console.log ("--------------");
      console.log ("code-overlay-background: top: " + $('#code-overlay-background').offset ().top + ", left: " + $('#code-overlay-background').offset ().left);
      console.log ("code-overlay-background width: " + code_overlay_width);
      console.log ("code-overlay-background height: " + code_overlay_height);
    });

  });

  $(window).resize(function() {
    if ($('body').hasClass ("highlighted"))
      $("#highlight-button").click ();
  });
</script>
<style>
.small-button .ui-button-text-only .ui-button-text {
   padding: 0;
}
#margin {
  z-index: 1;
  position: relative;
  border-style: solid;
  border-color: transparent;
}
.highlighted #margin {
  border-color: rgba(255, 145, 0, 0.5);
}
#wrapper {
  z-index: 1;
  position: relative;
}
.highlighted #wrapper {
  background: rgba(50, 220, 140, 0.5);
}
#code-overlay-background {
  z-index: 2;
  position: absolute;
  background: #fff;
  display: none;
}
.highlighted #code-overlay-background {
  display: inline-block;
}
#code {
  z-index: 3;
  display: inline-block;
  width: 100%;
  position: relative;
}
#code-overlay {
  z-index: 999999;
  display: inline-block;
  position: absolute;
}
.highlighted #code-overlay {
/*  background: rgba(255, 0, 0, 0.5);*/
  background: rgba(50, 140, 220, 0.5);
}
table#demo-box {
  width: 180px;
  display: none;
}
#demo-box td {
  font-size: 10px;
}
td.demo-wrapper-margin {
  width: 100%;
  height: 12px;
  text-align: center;
  background: rgba(255, 145, 0, 0.5);
}
td.demo-code {
  width: 60%;
  height: 70px;
  text-align: center;
  background: rgba(50, 140, 220, 0.5);
}
td.demo-wrapper-background {
  text-align: center;
  background: rgba(50, 220, 140, 0.5);
}
</style>
<?php echo ai_wp_head_hook (); ?>
</head>
<body style='font-family: arial; text-align: justify;'>
  <div style="float: right;">
    <button id="highlight-button" type="button" style="margin-left: 20px; font-size: 12px;" title="Highlight inserted code" >Highlight</button>
  </div>
  <div style="float: right;">
    <table id="demo-box" cellspacing=0 cellspacing="0">
      <tr>
        <td class="demo-wrapper-margin" colspan="2">wrapper margin</td>
      </tr>
        <td class="demo-code">Code block</td>
        <td class="demo-wrapper-background">wrapper background</td>
      <tr>
      </tr>
        <td class="demo-wrapper-margin" colspan="2">wrapper margin</td>
      <tr>
      </tr>
    </table>
  </div>
  <h1><?php echo AD_INSERTER_TITLE; ?> Code Preview</h1>
  <h2>Block <?php echo $block; ?></h2>
  <h3><?php echo $obj->get_ad_name(); ?></h3>
  <p>Need to install ads or widgets on Wordpress website? Ad Inserter is a simple yet powerful solution to insert any code into Wordpress.
You can install it from Wordpress (Plugins / Add New / search for Ad Inserter). <strong>Perfect for AdSense or contextual Amazon ads</strong>.
Simply enter any HTML/Javascript/PHP code and select where and how you want to display it.
Ad Inserter supports up to 16 code blocks. Code block is any code (for example AdSense ad) that has to be inserted (displayed) at some position.
Each code block can be configured to insert code at almost any position supported by Wordpress. It Features 16 code blocks; Syntax highlighting editor;
Automatic positions: before/after post, content, paragraph or excerpt; Manual positions: widgets, shortcodes, PHP function call; Block alignment and style:
left, center, right, float left, float right, custom CSS, no wrapping; PHP code processing: Server-side and client-side device detection (3 custom viewports);
Black/White-list categories, tags, urls, referers.</p>
<?php if ($obj->get_alignment_type() != AD_ALIGNMENT_NO_WRAPPING) : ?>
    <div id='margin' style='<?php echo margin_css ($obj->get_alignmet_style ()); ?>'>
      <div id='wrapper' style='<?php echo no_margin_css ($obj->get_alignmet_style (0)); ?>'>
      <div id='code-overlay-background'></div>
<?php endif; ?>
        <span id='code'>
          <?php echo $obj->get_ad_data(); ?>
        </span>
<?php if ($obj->get_alignment_type() != AD_ALIGNMENT_NO_WRAPPING) : ?>
      </div>
<?php endif; ?>
    </div>
    <div id='code-overlay'></div>
    <p>Few very important things you need to know in order to insert code and display some ad:
Enable and use at least one display option (Automatic Display, Widget, Shortcode, PHP function call)
Enable display on at least one Wordpress page type (Posts, Static pages, Homepage, Category pages, Search Pages, Archive pages)
For Posts and static pages select default value On all Posts / On all Static pages unless you really know what are you doing
Each code block has 4 independent display options: Automatic Display, Widget, Shortcode and PHP function call.
To display code block (ad) at some position you need to enable and use at least one display option.
For single posts or static pages display position Before Post usually means position above the post/page title, for blog pages Before Post position means position above all the posts on the blog page.
For single posts or static pages display position After Post means position below the post/page after all the content, for blog pages After Post position means position below all the posts on the blog page.
<a href='http://tinymonitor.com/ad-inserter-pro' style='text-decoration: none;' target='_blank'><strong>Ad Inserter Pro</strong></a> is an upgraded version of the freely available Ad Inserter.
In addition to all the features in the free version it offers 64 code blocks, 6 custom viewports, export and import of settings and support via email.
For a complete description of features, screenshots and FAQ please check Ad Inserter page.
If you are using free Ad Inserter simply uninstall it. The Pro version will automatically import existing settings from the free version.
After you receive the email with download link for the Ad Inserter Pro plugin, download it, go to Wordpress Plugins, Add New, Upload Plugin,
Choose file, click on Install Now, activate it and then click 'Enter License Key' and enter license key you got in the email.</p>
<?php echo ai_wp_footer_hook (); ?>
</body>
</html>
<?php

}


