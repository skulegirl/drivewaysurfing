<?php

/**
 * @file
 * Default theme implementation to format an HTML mail.
 *
 * Copy this file in your default theme folder to create a custom themed mail.
 * Rename it to mimemail-message--[module]--[key].tpl.php to override it for a
 * specific mail.
 *
 * Available variables:
 * - $recipient: The recipient of the message
 * - $subject: The message subject
 * - $body: The message body
 * - $css: Internal style sheets
 * - $module: The sending module
 * - $key: The message identifier
 *
 * @see template_preprocess_mimemail_message()
 */
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php if ($css): ?>
    <style type="text/css">
      <!--
      <?php print $css ?>
      -->
    </style>
    <?php endif; ?>
  </head>
  <body id="mimemail-body" <?php if ($module && $key): print 'class="'. $module .'-'. $key .'"'; endif; ?>>
    <div id="center" style="width:700px;">
      <div id="header">
        <a href="https://www.boondockerswelcome.com">
          <img src="https://www.boondockerswelcome.com/sites/boondockerswelcome.com/files/logoImages/Header-2-faded-with-text-short-700w.jpg" alt="Home" style="border:0;" />
      </a>
      </div>
      <div id="main" style="background-color: #dddddd; padding:10px; margin:1em 0; font-size:1.1em">
        <div id="subject">
          <h1 style="font-size:1.1em;line-height:1em;margin-top:0;margin-bottom:.5em;text-transform:capitalize;background-color:#F9C660;color:#d10303;padding:10px 5px;margin:0px 1em 0px 0px">
            <?php print $subject ?>
          </h1>
        </div>
        <div id="body" style="padding: 10px">
          <?php print $body ?>
        </div>
      </div>
      <div id="footer">
      </div>
    </div>
  </body>
</html>
