<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['pre_system'][] = array(
  'class'    => 'WhoopsHook',
  'function' => 'bootWhoops',
  'filename' => 'WhoopsHook.php',
  'filepath' => 'hooks',
  'params'   => array()
);


$hook['pre_system'][] = array(
  'class'    => 'MonologHook',
  'function' => 'monolog',
  'filename' => 'MonologHook.php',
  'filepath' => 'hooks',
  'params'   => array()
);

// 是否开启模板引擎
// $hook['display_override'] = function()
// {
//     return true;
// };



$hook['post_controller_constructor'][] = [
    'class'    => 'EloquentHook',
    'function' => 'bootEloquent',
    'filename' => 'EloquentHook.php',
    'filepath' => 'hooks'
];