<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
| https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
| $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
| $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|   my-controller/my-method -> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

//indexing route reservation
$route['reservation'] = 'reservation/index';
$route['show_meeting/(:any)'] = 'reservation/show_meeting/index/$1';
$route['get_meeting_api/(:any)'] = 'reservation/show_meeting/get_meeting_api/$1';

$route['form_reservation'] = 'reservation/index/form_reservation';

//route process data reservation
$route['data_reservation'] = 'reservation/reservation_room/get_data_reservation';
$route['insert_reservation'] = 'reservation/reservation_room/insert_data_reservation';
$route['get_data_ruangan'] = 'reservation/reservation_room/data_ruangan';
$route['edit_reservation'] = 'reservation/reservation_room/edit_reservation';
$route['cancle_booking/(:any)'] = 'reservation/reservation_room/cancle_booking/$1';

//indexing route ticketing
$route['service'] = 'ticketing/index';
$route['form_service'] = 'ticketing/index/form_data_service';
//routes data ticketing service item
$route['get_data_karyawan'] = 'ticketing/ticketing_service/get_data_karyawan';
$route['data_service'] = 'ticketing/ticketing_service/get_data_service';
$route['insert_service'] = 'ticketing/ticketing_service/insert_data_service';
$route['get_data_kategori'] = 'ticketing/ticketing_service/get_data_kategori';
$route['selesai_user_service/(:any)'] = 'ticketing/ticketing_service/selesai_user_service/$1';
//approval service
$route['approval_service'] = 'ticketing/approval_service';
$route['approve_service/(:any)'] = 'ticketing/approval_service/approve_service/$1';
$route['data_approval_service'] = 'ticketing/approval_service/get_data_approval_service';
$route['asign_service'] = 'ticketing/approval_service/asign_service';
$route['finish_service'] = 'ticketing/approval_service/finish_service';
// routes history pengerjaan
$route['history_repair'] = 'ticketing/history_repair';
$route['data_history_repair'] = 'ticketing/history_repair/get_data_history_repair';

//indexing routes guest
$route['guest'] = 'guest/index';

//route process data guest
$route['get_data_guest'] = 'guest/guest/get_data_guest';
$route['input_guest'] = 'guest/input_guest/index';

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8
