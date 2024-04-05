<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';

$route['admin'] = 'admin';
$route['admin/login']['GET'] = 'admin/login_get';
$route['admin/login']['POST'] = 'admin/login_post';
$route['admin/logout']['GET'] = 'admin/logout';

$route['(:any)'] = 'home/index/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
