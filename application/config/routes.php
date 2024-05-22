<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'home';

$route['news']['GET'] = 'home/news';
$route['news/(:num)']['GET'] = 'home/news_single/$1';
$route['map']['GET'] = 'home/map_get';
$route['map']['POST'] = 'home/map_post';
$route['total_jobs']['POST'] = 'home/total_jobs';
$route['job_list']['GET'] = 'home/job_list_get';
$route['job_list']['POST'] = 'home/job_list_post';
$route['jobs/(:num)']['GET'] = 'home/jobs/$1';
$route['jobs/(:num)/entry']['GET'] = 'home/jobs_entry/$1';
$route['jobs/(:num)/confirm']['POST'] = 'home/jobs_confirm/$1';
$route['jobs/(:num)/complete']['GET'] = 'home/jobs_complete/$1';
$route['get_lines_and_stations']['POST'] = 'home/get_lines_and_stations';
$route['get_jobs_by_ids']['POST'] = 'home/get_jobs_by_id';
$route['favorites']['GET'] = 'home/favorites';
$route['favorites/add']['POST'] = 'home/favorites_add';
$route['favorites/delete']['POST'] = 'home/favorites_delete';
$route['favorites/clear']['POST'] = 'home/favorites_clear';
// $route['favorites/delete']['GET'] = 'home/delete';
// $route['favorites/delete_all']['GET'] = 'home/delete_all';

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
$route['admin/jobs/copy_multiple']['POST'] = 'admin/jobs_copy_multiple';
$route['admin/jobs/(:num)/delete']['GET'] = 'admin/jobs_delete/$1';
$route['admin/jobs/delete_multiple']['POST'] = 'admin/jobs_delete_multiple';
$route['admin/jobs/memo/update']['POST'] = 'admin/jobs_single_col_update';
$route['admin/jobs/status/update_multiple']['POST'] = 'admin/jobs_single_col_multiple_update';
$route['admin/jobs/csv_export']['GET'] = 'admin/jobs_csv_export';
$route['admin/jobs/csv_import']['POST'] = 'admin/jobs_csv_import';
$route['admin/jobs/base64_to_png']['POST'] = 'admin/base64_to_png';


/* news */
$route['admin/news']['GET'] = 'admin/news';
$route['admin/news/(:num)']['GET'] = 'admin/news_get/$1';
$route['admin/news/new']['GET'] = 'admin/news_new';
$route['admin/news/update']['POST'] = 'admin/news_update';
$route['admin/news/(:num)/delete']['GET'] = 'admin/news_delete/$1';

$route['(:any)'] = 'home/index/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
