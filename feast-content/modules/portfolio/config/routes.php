<?php

/* Dashboard routes */
$route['admin/portfolio'] = 'portfolio/admin/portfolio';
$route['admin/portfolio/add'] = 'portfolio/admin/portfolio/edit';
$route['admin/portfolio/edit/(:num)'] = 'portfolio/admin/portfolio/edit/$1';
$route['admin/portfolio/(.+)'] = 'portfolio/admin/portfolio/$1';
$route['portfolio/(:num)'] = 'portfolio/index';