<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home/dashboard';
$route['personal'] = 'home/personal';
$route['member'] = 'home/personal';
$route['enterprise'] = 'home/enterprise';
$route['admin'] = 'home/enterprise';
$route['page/(:any).html'] = 'pages/content/info/$1';
$route['posts'] = 'posts/content/index';
$route['post/(:any).html'] = 'posts/content/info/$1';
$route['catalog/(:any).html'] = 'posts/content/catalog/$1';

$route['sitemap.xml'] = 'home/dashboard/sitemap';
$route['feeds'] = 'home/dashboard/feeds';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
