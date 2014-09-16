<?php
/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can add new regions for block content, modify
 *   or override Drupal's theme functions, intercept or make additional
 *   variables available to your theme, and create custom PHP logic. For more
 *   information, please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/theme-guide
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   The Drupal theme system uses special theme functions to generate HTML
 *   output automatically. Often we wish to customize this HTML output. To do
 *   this, we have to override the theme function. You have to first find the
 *   theme function that generates the output, and then "catch" it and modify it
 *   here. The easiest way to do it is to copy the original function in its
 *   entirety and paste it here, changing the prefix from theme_ to drivewaysurfing_.
 *   For example:
 *
 *     original: theme_breadcrumb()
 *     theme override: drivewaysurfing_breadcrumb()
 *
 *   where drivewaysurfing is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_breadcrumb() function.
 *
 *   If you would like to override any of the theme functions used in Zen core,
 *   you should first look at how Zen core implements those functions:
 *     theme_breadcrumbs()      in zen/template.php
 *     theme_menu_item_link()   in zen/template.php
 *     theme_menu_local_tasks() in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called template suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node-forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and template suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440
 *   and http://drupal.org/node/190815#template-suggestions
 */

/* 
 * Add javascript files needed for this sub-theme.
 */

drupal_add_js(libraries_get_path('jquery.cookie') . '/jquery.cookie.js', 'core');
drupal_add_js(drupal_get_path('theme', 'drivewaysurfing') . '/js/gmap_remember_zoom.js','core');

/**
 * Implementation of HOOK_theme().
 */
function drivewaysurfing_theme($existing, $type, $theme, $path) {
  $hooks = zen_theme($existing, $type, $theme, $path);
  // Add your theme hooks like this:
  /*
  $hooks['hook_name_here'] = array( // Details go here );
  */
  // @TODO: Needs detailed comments. Patches welcome!
  $hooks['user_login'] = array(
    'render element' => 'form',
    'path' => drupal_get_path('theme', 'drivewaysurfing') . '/templates',
    'template' => 'user-login',
    'preprocess functions' => array(
      'drivewaysurfing_preprocess_user_login'
    ),
  );
  $hooks['user_pass'] = array(
    'render element' => 'form',
    'path' => drupal_get_path('theme', 'drivewaysurfing') . '/templates',
    'template' => 'user-pass',
    'preprocess functions' => array(
      'drivewaysurfing_preprocess_user_pass'
    ),
  );
  return $hooks;
}

/**
 * Override or insert variables into all templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered (name of the .tpl.php file.)
 */
 /*
function drivewaysurfing_preprocess(&$vars, $hook) {
} */

/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function drivewaysurfing_preprocess_page(&$vars, $hook) {
    $context = page_manager_get_current_page();
    if ($context)
    {
         if (strcmp($context['name'],'user_view') != 0)
         {
           $vars['title'] = '';
         }
    }
}

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function drivewaysurfing_preprocess_node(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // drivewaysurfing_preprocess_node_page() or drivewaysurfing_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $vars['node']->type;
  if (function_exists($function)) {
    $function($vars, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function drivewaysurfing_preprocess_comment(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function drivewaysurfing_preprocess_block(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/** 
 * Override or insert variables into the user login template.
 */
function drivewaysurfing_preprocess_user_login(&$variables) {
   $variables['intro_text'] = t('Login to your BoondockersWelcome account');
   //$variables['rendered'] = drupal_render($variables['form']);
}

function drivewaysurfing_preprocess_user_pass(&$variables) {
   $variables['intro_text'] = t('Forgotten your password? No problem. Enter your uesrname or email address below, and we\'ll send a one-time login link to the email addres you have listed in your account. From there you can reset your password to whatever you wish.');
   //$variables['rendered'] = drupal_render($variables['form']);
}

/**
* Implementation of theme_filter_tips_more_info().
* Used here to hide the "More information about formatting options" link.
*/
function drivewaysurfing_filter_tips_more_info() { return ''; }


/**
* Implementation of theme_filter_tips().
* Used here to hide the filter tips.
*/
function drivewaysurfing_filter_tips($tips, $long = false, $extra = '') {
        return '';
}

function drivewaysurfing_preprocess_views_view__advanced_forum_topic_list(&$variables) {
  $menu_item = menu_get_item();

  if (!empty($menu_item) && $menu_item['access']) {
    if (($menu_item['map'][0] == 'forum') && (!empty($menu_item['map'][1]))) {
      $forum = $menu_item['map'][1];
      $variables['forum_name'] = $forum->name;
    }
  }
}

/**
 * Process variables for author-pane-user-picture.tpl.php.
 *
 * The $variables array contains the following arguments:
 * - $variables['account']: User account object.
 * - $variables['caller']: (optional) String identifying who called the theme
 *   function. Usually the name of the module but doesn't have to be.
 * - $variables['picture_preset']: (optional) Imagecache preset to use to format
 *   the user picture.
 *
 * @see author-pane-user-picture.tpl.php
 */
function drivewaysurfing_preprocess_author_pane_user_picture(&$variables) {
  $variables['picture'] = '';

  $account = $variables['account'];
  $variables['picture_preset'] = 'thumbnail';
  $filepath = db_query("SELECT fm.uri 
      FROM file_managed as fm
      JOIN field_data_field_user_photo as f ON fm.fid = f.field_user_photo_fid 
      JOIN profile as p ON p.pid = f.entity_id 
      WHERE p.uid = :uid AND p.type = 'profile'",
    array(':uid' => $account->uid))->fetchField();

  if (isset($filepath) && !empty($filepath)) {
    $alt = t("@user's picture", array('@user' => format_username($account)));

    // If the image does not have a valid Drupal scheme (for eg. HTTP),
    // don't load image styles.
    if (module_exists('image') && file_valid_uri($filepath) && $style = ((!empty($variables['picture_preset'])) ? $variables['picture_preset'] : '')) {
      $variables['picture'] = theme('image_style', array('style_name' => $style, 'path' => $filepath, 'alt' => $alt, 'title' => $alt));
      $variables['imagecache_used'] = TRUE;
    }
    else {
      $variables['picture'] = theme('image', array('path' => $filepath, 'alt' => $alt, 'title' => $alt));
      $variables['imagecache_used'] = FALSE;
    }

    if (!empty($account->uid) && user_access('access user profiles')) {
      $options = array(
        'attributes' => array('title' => t('View user profile.')),
        'html' => TRUE,
      );
      $variables['picture_link_profile'] = l($variables['picture'], "user/$account->uid", $options);
    }
    else {
      $variables['picture_link_profile'] = FALSE;
    }
  }
}
