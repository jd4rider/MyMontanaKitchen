var shSettings = {
  "tab_size":"4",
  "use_soft_tabs":"1",
  "word_wrap":"1",
  "highlight_curr_line":"0",
  "key_bindings":"default",
  "full_line_selection":"1",
  "show_line_numbers":"0"};

function SyntaxHighlight (id, block, settings) {
  var textarea, editor, form, session, editDiv;

  this.textarea = textarea = jQuery(id);
  this.settings = settings || {};

  if (textarea.length === 0 ) { // Element does not exist
    this.valid = false;
    return;
  }

  this.valid = true;
  editDiv = jQuery('<div>', {
    position: 'absolute',
//    width: textarea.width(),
    width: 719,
//    height: textarea.height(),
    height: 384,
    'class': textarea.attr('class'),
    'id':  'editor-' + block
  }).insertBefore (textarea);

  textarea.css('display', 'none');
  this.editor = editor = ace.edit(editDiv[0]);
  this.form = form = textarea.closest('form');
  this.session = session = editor.getSession();
  session.setValue(textarea.val());

  // copy back to textarea on form submit...
  form.submit (function () {
    var block = textarea.attr ("id").replace ("block-","");
    var editor_disabled = jQuery("#simple-editor-" + block).is(":checked");
    if (!editor_disabled) {
      textarea.val (session.getValue());
    }
  });

  session.setMode ("ace/mode/html");

  this.applySettings();
}

SyntaxHighlight.prototype.applySettings = function () {
  var editor = this.editor,
    session = this.session,
    settings = this.settings;

  editor.renderer.setShowGutter(settings['show_line_numbers'] == 1);
  editor.setHighlightActiveLine(settings['highlight_curr_line'] == 1);
  editor.setSelectionStyle(settings['full_line_selection'] == 1 ? "line" : "text");
  editor.setTheme("ace/theme/" + settings['theme']);
  session.setUseWrapMode(settings['word_wrap'] == 1);
  session.setTabSize(settings['tab_size']);
  session.setUseSoftTabs(settings['use_soft_tabs'] == 1);
};

jQuery(document).ready(function($) {

  var header = $('#ai-settings-' + 'header').length != 0;
  var header_id = 'name';

  function configure_editor_language (block) {

    var editor = ace.edit ("editor-" + block);

    if ($("input#process-php-"+block).is(":checked")) {
      editor.getSession ().setMode ("ace/mode/php");
    } else editor.getSession ().setMode ("ace/mode/html");
  }

  function process_display_elements (block) {

    $("#paragraph-settings-"+block).hide();

    var display_type = '';
    $("select#display-type-"+block+" option:selected").each(function() {
      display_type += $(this).text();
    });

    if (display_type == "Before Paragraph" || display_type == "After Paragraph") {
      $("#paragraph-settings-"+block).show();
    }

    $("#css-label-"+block).css('display', 'inline-block');
    $("#edit-css-button-"+block).css('display', 'inline-block');

    $("#css-none-"+block).hide();
    $("#custom-css-"+block).hide();
    $("#css-left-"+block).hide();
    $("#css-right-"+block).hide();
    $("#css-center-"+block).hide();
    $("#css-float-left-"+block).hide();
    $("#css-float-right-"+block).hide();
    $("#css-no-wrapping-"+block).hide();

    $("#no-wrapping-warning-"+block).hide();

    var alignment = '';
    $("select#block-alignment-"+block+" option:selected").each(function() {
      alignment += $(this).text();
    });
    if (alignment == "No Wrapping") {
      $("#css-no-wrapping-"+block).css('display', 'inline-block');
      $("#css-label-"+block).hide();
      $("#edit-css-button-"+block).hide();
      if ($("#client-side-detection-"+block).is(":checked")) {
        $("#no-wrapping-warning-"+block).show();
      }
    } else
    if (alignment == "None") {
      $("#css-none-"+block).css('display', 'inline-block');
    } else
    if (alignment == "Custom CSS") {
      $("#css-code-" + block).show();
      $("#custom-css-"+block).show();
    } else
    if (alignment == "Align Left") {
      $("#css-left-"+block).css('display', 'inline-block');
    } else
    if (alignment == "Align Right") {
      $("#css-right-"+block).css('display', 'inline-block');
    } else
    if (alignment == "Center") {
      $("#css-center-"+block).css('display', 'inline-block');
    } else
    if (alignment == "Float Left") {
      $("#css-float-left-"+block).css('display', 'inline-block');
    } else
    if (alignment == "Float Right") {
      $("#css-float-right-"+block).css('display', 'inline-block');
    }

    configure_editor_language (block);
  }

  function configure_editor (block) {
    syntax_highlighter = new SyntaxHighlight ('#block-' + block, block, shSettings);
    syntax_highlighter.editor.setPrintMarginColumn (1000);

    if (!header && (block - 1) >> 4) {
      $('#block'   + '-' + block).removeAttr(header_id);
      $('#display' + '-type-' + block).removeAttr(header_id);
    }

    if (!header && block >> 2) {
      $('#option' + '-name-' + block).removeAttr(header_id);
      $('#option' + '-length-' + block).removeAttr(header_id);
    }

    $('input#simple-editor-' + block).change (function () {

      block = $(this).attr ("id").replace ("simple-editor-","");
      var editor_disabled = $(this).is(":checked");
      var editor = ace.edit ("editor-" + block);
      var textarea = $("#block-" + block);
      var ace_editor = $("#editor-" + block);

      if (editor_disabled) {
        textarea.val (editor.session.getValue());
        textarea.css ('display', 'block');
        ace_editor.css ('display', 'none');
      } else {
          editor.session.setValue (textarea.val ())
          editor.renderer.updateFull();
          ace_editor.css ('display', 'block');
          textarea.css ('display', 'none');
        }
    });
  }

  var start = parseInt ($('#ai-form').attr('start'));
  var end   = parseInt ($('#ai-form').attr('end'));

  for (block = start; block <= end; block ++) {
    configure_editor (block);
  }

  configure_editor ('h');
  configure_editor ('f');

  $('#ai-tab-container').tabs();

  $('#ai-tab-container a').css ("width", "14px").css ("text-align", "center");
  $('#ai-tabs').css ("padding", ".2em 0 0 .6em");

  var active_tab = parseInt ($("#ai-active-tab").attr ("value"));
  var tab_index = $('#ai-tab-container a[href="#tab-'+active_tab+'"]').parent().index();
  $("#ai-tab-container").tabs("option", "active", tab_index);

  $('.ai-tab').click (function () {
    tab_block = $(this).attr ("id");
    tab_block = tab_block.replace ("ai-tab","");
    $("#ai-active-tab").attr ("value", tab_block);

    if (tab_block != 0) {
      var editor = ace.edit ("editor-" + tab_block);
      editor.getSession ().highlightLines (10000000);
    }
  });

  //hover states on the static widgets
  $('#dialog_link, ul#icons li').hover(
    function() {$(this).addClass ('ui-state-hover');},
    function() {$(this).removeClass ('ui-state-hover');}
  );

  $('#ai-settings').tooltip();

  $('#dummy-ranges').hide();
  $('#ai-ranges').show();

  $('#dummy-tabs').hide();
  $('#ai-tabs').show();

  $('#ai-settings input[type=submit], #ai-settings button').button().show ();

  for (ad_block = start; ad_block <= end; ad_block++) {
    $("select#display-type-"+ad_block).change (function() {
      block = $(this).attr('id').replace ("display-type-", "");
      process_display_elements (block);
    });
    $("select#block-alignment-"+ad_block).change (function() {
      block = $(this).attr('id').replace ("block-alignment-", "");
      process_display_elements (block);
    });
    $("input#process-php-"+ad_block).change (function() {
      block = $(this).attr('id').replace ("process-php-", "");
      process_display_elements (block);
    });
    $("#enable-shortcode-"+ad_block).change (function() {
      block = $(this).attr('id').replace ("enable-shortcode-", "");
      process_display_elements (block);
    });
    $("#enable-php-call-"+ad_block).change (function() {
      block = $(this).attr('id').replace ("enable-php-call-", "");
      process_display_elements (block);
    });
    $("select#display-for-devices-"+ad_block).change (function() {
      block = $(this).attr('id').replace ("display-for-devices-", "");
      process_display_elements (block);
    });

    $("#display-homepage-"+ad_block).change (function() {
      block = $(this).attr('id').replace ("display-homepage-", "");
      process_display_elements (block);
    });
    $("#display-category-"+ad_block).change (function() {
      block = $(this).attr('id').replace ("display-category-", "");
      process_display_elements (block);
    });
    $("#display-search-"+ad_block).change (function() {
      block = $(this).attr('id').replace ("display-search-", "");
      process_display_elements (block);
    });
    $("#display-archive-"+ad_block).change (function() {
      block = $(this).attr('id').replace ("display-archive-", "");
      process_display_elements (block);
    });

    $("#client-side-detection-"+ad_block).change (function() {
      block = $(this).attr('id').replace ("client-side-detection-", "");
      process_display_elements (block);
    });

    process_display_elements (ad_block);

    $("#widgets-button-"+ad_block).button ({
    }).click (function () {
      window.location.href = "widgets.php";
    });

    $("#show-css-button-"+ad_block).button ({
    }).show ().click (function () {
      block = $(this).attr ("id");
      block = block.replace ("show-css-button-","");
      $("#css-code-" + block).toggle ();
    });

    $("#edit-css-button-"+ad_block).button ({
    }).click (function () {
      block = $(this).attr('id').replace ("edit-css-button-", "");

      $("#css-left-"+block).hide();
      $("#css-right-"+block).hide();
      $("#css-center-"+block).hide();
      $("#css-float-left-"+block).hide();
      $("#css-float-right-"+block).hide();

      var alignment = '';
      $("select#block-alignment-"+block+" option:selected").each(function() {
        alignment += $(this).text();
      });
      if (alignment == "None") {
        $("#css-none-"+block).hide();
        $("#custom-css-"+block).show().val ($("#css-none-"+block).text ());
        $("select#block-alignment-"+block+"").val ("Custom CSS").change();
      } else
      if (alignment == "Align Left") {
        $("#css-left-"+block).hide();
        $("#custom-css-"+block).show().val ($("#css-left-"+block).text ());
        $("select#block-alignment-"+block+"").val ("Custom CSS").change();
      } else
      if (alignment == "Align Right") {
        $("#css-right-"+block).hide();
        $("#custom-css-"+block).show().val ($("#css-right-"+block).text ());
        $("select#block-alignment-"+block+"").val ("Custom CSS").change();
      } else
      if (alignment == "Center") {
        $("#css-center-"+block).hide();
        $("#custom-css-"+block).show().val ($("#css-center-"+block).text ());
        $("select#block-alignment-"+block+"").val ("Custom CSS").change();
      } else
      if (alignment == "Float Left") {
        $("#css-float-left-"+block).hide();
        $("#custom-css-"+block).show().val ($("#css-float-left-"+block).text ());
        $("select#block-alignment-"+block+"").val ("Custom CSS").change();
      } else
      if (alignment == "Float Right") {
        $("#css-float-right-"+block).hide();
        $("#custom-css-"+block).show().val ($("#css-float-right-"+block).text ());
        $("select#block-alignment-"+block+"").val ("Custom CSS").change();
      }
    });

    $("#export-switch-"+ad_block).button ({
      icons: {
        primary: "ui-icon-gear",
        secondary: "ui-icon-triangle-1-s"
      },
      text: false
    }).show ().click (function () {
      block = $(this).attr ("id");
      block = block.replace ("export-switch-","");
      $("#export-container-" + block).toggle ();
    });

    $("#device-detection-button-"+ad_block).button ({
    }).show ().click (function () {
      block = $(this).attr ("id");
      block = block.replace ("device-detection-button-","");
      $("#device-detection-settings-" + block).toggle ();
    });

    $("#lists-button-"+ad_block).button ({
    }).show ().click (function () {
      block = $(this).attr ("id");
      block = block.replace ("lists-button-","");
      $("#list-settings-" + block).toggle ();
    });

    $("#manual-button-"+ad_block).button ({
    }).show ().click (function () {
      block = $(this).attr ("id");
      block = block.replace ("manual-button-","");
      $("#manual-settings-" + block).toggle ();
    });

    $("#misc-button-"+ad_block).button ({
    }).show ().click (function () {
      block = $(this).attr ("id");
      block = block.replace ("misc-button-","");
      $("#misc-settings-" + block).toggle ();
    });

    $("#preview-button-"+ad_block).button ({
    }).show ().click (function () {
      block = $(this).attr ("id");
      block = block.replace ("preview-button-","");

      var window_width = 820;
      var window_height = 820;
      var nonce = $(this).attr ('nonce');
      var page = "/wp-admin/admin-ajax.php?action=ai_preview&ai_code=" + block + "&ai_check=" + nonce;
      var window_left  = (screen.width / 3) - (820 / 2);
      var window_top   = (screen.height / 2) - (820 / 2);
      var preview_window = window.open (page, 'toswindow','width='+window_width+',height='+window_height+',top='+window_top+',left='+window_left+',resizable=yes,scrollbars=yes,toolbar=no,location=no,directories=no,status=no,menubar=no');
    });
  }

  $("#export-switch-0").button ({
    icons: {
      primary: "ui-icon-gear",
      secondary: "ui-icon-triangle-1-s"
    },
    text: false
  }).show ().click (function () {
    $("#export-container-0").toggle ();
  });

  $("input#process-php-h").change (function() {
    configure_editor_language ('h')
  });

  $("input#process-php-f").change (function() {
    configure_editor_language ('f')
  });

});
