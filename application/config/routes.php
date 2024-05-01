<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'home';

$route['news']['GET'] = 'home/news';
$route['news/(:num)']['GET'] = 'home/news_single/$1';
$route['map']['GET'] = 'home/map_get';
$route['map']['POST'] = 'home/map_post';
$route['job_list']['GET'] = 'home/job_list_get';
$route['job_list']['POST'] = 'home/job_list_post';
$route['jobs/(:num)']['GET'] = 'home/jobs/$1';
$route['mypage']['GET'] = 'home/mypage';

$route['admin'] = 'admin';
$route['admin/login']['GET'] = 'admin/login_get';
$route['admin/login']['POST'] = 'admin/login_post';
$route['admin/logout']['GET'] = 'admin/logout';

/* jobs */
$route['admin/jobs']['GET'] = 'admin/jobs';
$route['admin/jobs/(:num)']['GET'] = 'admin/jobs_get/$1';
$route['admin/jobs/new']['GET'] = 'admin/jobs_new';
$route['admin/jobs/update']['POST'] = 'admin/jobs_update';
$route['admin/jobs/upload']['POST'] = 'admin/jobs_upload';
$route['admin/jobs/delete_photo']['POST'] = 'admin/delete_photo';
$route['admin/jobs/stations']['POST'] = 'admin/jobs_stations';
$route['admin/jobs/stations/delete']['POST'] = 'admin/jobs_stations_delete';
$route['admin/jobs/(:num)/delete']['GET'] = 'admin/jobs_delete/$1';

/* news */
$route['admin/news']['GET'] = 'admin/news';
$route['admin/news/(:num)']['GET'] = 'admin/news_get/$1';
$route['admin/news/new']['GET'] = 'admin/news_new';
$route['admin/news/update']['POST'] = 'admin/news_update';
$route['admin/news/(:num)/delete']['GET'] = 'admin/news_delete/$1';



// API
$route['get_lines_and_stations']['POST'] = 'home/get_lines_and_stations';
$route['get_jobs']['POST'] = 'jobs/get_all';

$route['(:any)'] = 'home/index/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
