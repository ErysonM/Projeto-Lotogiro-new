<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']				= "Welcome";
$route['404_override']						= 'Errors/error_404';
$route['translate_uri_dashes']				= FALSE;

/* Custom routes */
# Backoffice / Admin
$route['backoffice']						= 'backoffice/home';
$route['admin']								= 'admin/home';

# Comunicados
$route['backoffice/announcements/(:num)']	= 'backoffice/announcements/index/$1';

# Página de login
$route['backoffice/login']					= 'backoffice/auth/login';
$route['admin/login']						= 'admin/auth/login';

# Página de logout
$route['backoffice/logout']					= 'backoffice/auth/logout';
$route['admin/logout']						= 'admin/auth/logout';

# Página de recuperação
$route['backoffice/forgot']					= 'backoffice/auth/forgot';
$route['backoffice/forgot/(:any)']			= 'backoffice/auth/forgot/$1';
$route['admin/forgot']						= 'admin/auth/forgot';
$route['admin/forgot/(:any)']				= 'admin/auth/forgot/$1';

# Página de ativação
$route['backoffice/activate']				= 'backoffice/auth/activate';
$route['backoffice/activate/(:any)']		= 'backoffice/auth/activate/$1';

# Página de cadastro
$route['sponsor']							= 'backoffice/auth/sponsor';
$route['sponsor/(:any)']					= 'backoffice/auth/sponsor/$1';
$route['register']							= 'backoffice/auth/register';

# Página do Perfil
$route['backoffice/profile/(:any)']			= 'backoffice/profile/view/$1';
