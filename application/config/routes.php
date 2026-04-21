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

//custom routes reservation
$route['reservation'] = 'reservation/reservation_room';
$route['data_reservation'] = 'reservation/reservation_room/get_data_reservation';
$route['insert_reservation'] = 'reservation/reservation_room/insert_data_reservation';
$route['form_reservation'] = 'reservation/reservation_room/form_reservation';
$route['get_data_ruangan'] = 'reservation/reservation_room/data_ruangan';
$route['update_reservation'] = 'reservation/reservation_room/edit_data_reservation';

//custom routes ticketing service item
$route['service'] = 'ticketing/ticketing_service';
$route['data_service'] = 'ticketing/ticketing_service/get_data_service';
$route['insert_service'] = 'ticketing/ticketing_service/insert_data_service';
$route['get_data_kategori'] = 'ticketing/ticketing_service/get_data_kategori';

//approval service
$route['approval_service'] = 'ticketing/approval_service';
$route['data_approval_service'] = 'ticketing/approval_service/get_data_approval_service';
// history pengerjaan
$route['history_repair'] = 'ticketing/history_repair';
$route['data_history_repair'] = 'ticketing/history_repair/get_data_history_repair';


//custom routes guest
$route['guest'] = 'guest/index';

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8
