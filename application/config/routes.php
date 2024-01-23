<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['login'] = 'Welcome/login';
$route['logout'] = 'Welcome/logout';
$route['test'] = 'Welcome';

$route['admin/dashboard'] = 'Admin/dashboard';
$route['admin/pdfList'] = 'Admin/pdfList';
$route['pdf/listData'] = 'Admin/pdfListData';
$route['pdf/versionList/(:any)'] = 'Admin/pdfVersionList/$1';
$route['pdf/listVersionData'] = 'Admin/pdfListVersionData';
$route['pdf/saveData'] = 'Admin/saveData';
$route['pdf/updatePdfStatus'] = 'Admin/updatePdfStatus';
$route['pdf/updatePdfFinalStatus'] = 'Admin/updatePdfFinalStatus';
$route['pdf/viewPdf/(:any)'] = 'Admin/viewPdf/$1';
$route['pdf/viewPdfVersion/(:any)'] = 'Admin/viewPdfVersion/$1';
$route['pdf/pdfData'] = 'Admin/pdfData';
$route['pdf/pdfVersionData'] = 'Admin/pdfVersionData';
$route['pdf/updateData'] = 'Admin/updateData';
$route['pdf/updateMainPdf'] = 'Admin/updateMainPdf';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;