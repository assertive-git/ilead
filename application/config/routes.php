<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'home';

$route['feed']['GET'] = 'home/xml_feed';
$route['news']['GET'] = 'home/news';
$route['news/p']['GET'] = 'home/news';
$route['news/p/(:num)']['GET'] = 'home/news/$1';
$route['news/(:num)']['GET'] = 'home/news_single/$1';
$route['map']['GET'] = 'home/map_get';
$route['map']['POST'] = 'home/map_post';
$route['total_jobs']['POST'] = 'home/total_jobs';
$route['job_list']['GET'] = 'home/job_list_get';
$route['job_list/(:num)']['GET'] = 'home/job_list_get/$1';
$route['job_list']['POST'] = 'home/job_list_post';
$route['jobs/(:num)']['GET'] = 'home/jobs/$1';
$route['jobs/entry']['GET'] = 'home/jobs_entry';
$route['jobs/confirm']['POST'] = 'home/jobs_confirm';
$route['jobs/complete']['GET'] = 'home/jobs_complete';
$route['get_lines']['POST'] = 'home/get_lines';
$route['get_stations']['POST'] = 'home/get_stations';
$route['get_prefs_lines_and_stations']['POST'] = 'home/get_prefs_lines_stations';
$route['get_jobs_by_ids']['POST'] = 'home/get_jobs_by_id';
$route['favorites']['GET'] = 'home/favorites';
$route['favorites/(:num)']['GET'] = 'home/favorites/$1';
$route['favorites/add']['POST'] = 'home/favorites_add';
$route['favorites/delete']['POST'] = 'home/favorites_delete';
$route['favorites/clear']['POST'] = 'home/favorites_clear';
// $route['favorites/delete']['GET'] = 'home/delete';
// $route['favorites/delete_all']['GET'] = 'home/delete_all';
$route['issue_instagram_token']['GET'] = 'home/issue_instagram_token';
$route['refresh_instagram_token']['GET'] = 'home/refresh_instagram_token';

$route['admin'] = 'admin';
$route['admin/login']['GET'] = 'admin/login_get';
$route['admin/login']['POST'] = 'admin/login_post';
$route['admin/logout']['GET'] = 'admin/logout';

/* jobs */
$route['admin/jobs']['GET'] = 'admin/jobs_admin_get';
$route['admin/jobs/p']['GET'] = 'admin/jobs_admin_get';
$route['admin/jobs/p/(:num)']['GET'] = 'admin/jobs_admin_get/$1';

$route['admin/jobs']['POST'] = 'admin/jobs_admin_post';
$route['admin/jobs/p']['POST'] = 'admin/jobs_admin_post';

$route['admin/jobs/(:num)/preview']['GET'] = 'admin/jobs_preview/$1';
$route['admin/jobs/(:num)']['GET'] = 'admin/jobs_get/$1';
$route['admin/jobs/new']['GET'] = 'admin/jobs_new';
$route['admin/jobs/update']['POST'] = 'admin/jobs_update';
$route['admin/jobs/upload']['POST'] = 'admin/jobs_upload';
$route['admin/jobs/delete_photo']['POST'] = 'admin/delete_photo';
$route['admin/jobs/stations']['POST'] = 'admin/jobs_stations';
$route['admin/jobs/stations/delete']['POST'] = 'admin/jobs_stations_delete';
$route['admin/jobs/copy_multiple']['POST'] = 'admin/jobs_copy_multiple';
$route['admin/jobs/(:num)/copy']['GET'] = 'admin/jobs_copy/$1';
$route['admin/jobs/(:num)/delete']['GET'] = 'admin/jobs_delete/$1';
$route['admin/jobs/delete_multiple']['POST'] = 'admin/jobs_delete_multiple';
$route['admin/jobs/memo/update']['POST'] = 'admin/jobs_single_col_update';
$route['admin/jobs/status/update_multiple']['POST'] = 'admin/jobs_single_col_multiple_update';
$route['admin/jobs/csv_export']['GET'] = 'admin/jobs_csv_export';
$route['admin/jobs/csv_import']['POST'] = 'admin/jobs_csv_import';

$route['admin/get_lines_stations']['POST'] = 'admin/get_lines_stations';
$route['admin/base64_to_png']['POST'] = 'admin/base64_to_png';


/* news */
$route['admin/news']['GET'] = 'admin/news_admin_get';
$route['admin/news']['POST'] = 'admin/news_admin_post';
$route['admin/news/(:num)']['GET'] = 'admin/news_get/$1';
$route['admin/news/new']['GET'] = 'admin/news_new';
$route['admin/news/update']['POST'] = 'admin/news_update';
$route['admin/news/(:num)/delete']['GET'] = 'admin/news_delete/$1';
$route['admin/api/set_coordinates'] = 'admin/set_coordinates';

// $route['(:any)'] = 'home/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
