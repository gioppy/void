<?php

/**
 * implement hook_css_alter().
 */
function void_css_alter(&$css){
  unset($css[drupal_get_path('module', 'system') . '/system.base.css']);
  unset($css[drupal_get_path('module', 'system') . '/system.menus.css']);
  unset($css[drupal_get_path('module', 'system') . '/system.messages.css']);
  unset($css[drupal_get_path('module', 'system') . '/system.theme.css']);
  unset($css[drupal_get_path('module', 'field') . '/theme/field.css']);
  unset($css[drupal_get_path('module', 'node') . '/node.css']);
  unset($css[drupal_get_path('module', 'user') . '/user.css']);

  //Uncomment if search module is enabled
  //unset($css[drupal_get_path('module', 'search') . '/search.css']);

  unset($css[drupal_get_path('module', 'ctools') . '/css/ctools.css']);
  unset($css[drupal_get_path('module', 'views') . '/css/views.css']);

  unset($css[drupal_get_path('module', 'ckeditor') . '/css/ckeditor.css']);

  //Uncomment if webform module is enabled
  //unset($css[drupal_get_path('module', 'webform') . '/css/webform.css']);

  //Uncomment if date module is enabled
  //unset($css[drupal_get_path('module', 'date_api') . '/date.css']);
  //unset($css[drupal_get_path('module', 'date_popup') . '/themes/datepicker.1.7.css']);
}

/**
 * implement hook_html_head_alter().
 */
function void_html_head_alter(&$head_elements){
  //Misc meta-tags
  $head_elements['format-detection'] = _add_meta('format-detection', 'telephone=no');

  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8'
  );
}

/**
 * Override or insert variables into the maintenance page template.
 */
function void_preprocess_maintenance_page(&$vars){
  void_preprocess_html($vars);
}

/**
 * Override or insert variables into the html template.
 */
function void_preprocess_html(&$vars){}

/**
 * Override or insert variables into the page template.
 */
function void_preprocess_page(&$vars){
  //Uncomment for add html5shiv js on head. Remember to change the path in the src
  /*$html5 = array(
    '#tag' => 'script',
    '#prefix' => '<!--[if lt IE 9]>',
    '#suffix' => '<![endif]-->',
    '#value_prefix' => '',
    '#value'=>'',
    '#value_suffix' => '',
    '#attributes' => array(
      'type' => 'text/javascript',
      'src' => drupal_get_path('theme', 'void') .'/js/html5shiv.min.js',
    ),
  );
  drupal_add_html_head($html5, 'html5');*/

  //Uncomment for add AddThis js on head
  /*$addthis = array(
    '#tag' => 'script',
    '#value_prefix' => '',
    '#value'=>'',
    '#value_suffix' => '',
    '#attributes' => array(
      'type' => 'text/javascript',
      'src' => '//s7.addthis.com/js/300/addthis_widget.js#pubid=YOUR_PUBID',
      'async' => 'async'
    ),
  );
  drupal_add_html_head($addthis, 'addthis');*/

  //Insert css/js if is front page
  if(drupal_is_front_page()){}

  //Insert css/js on specific node
  if(isset($vars['node'])){
    $node = $vars['node'];
  }
}

/**
 * helper function for add a new meta
 */
function _add_meta($name, $content){
  return array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array('name' => $name, 'content' => $content),
  );
}

/**
 * Helper function: debug string/array/object.
 */
function _void_debug($debug, $watchdog = FALSE){
  if($watchdog){
    watchdog("Void", '<pre>'.print_r($debug, true).'</pre>');
  }else{
    drupal_set_message('<pre>'.print_r($debug, true).'</pre>');
  }
}
