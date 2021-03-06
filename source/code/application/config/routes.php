<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

// $route['default_controller'] = "do_survey/home/c5b615f7-ca39-45b3-9de2-0d4777a75727"; //"admin/";
// $route['default_controller'] = "do_survey/home/d803426a-0d76-49c8-88b7-6ee452ac748b";
$route['default_controller'] = "do_survey/home/412cb43b-9efd-4557-9c22-07a935d12c09";
$route['test'] = "/do_survey/home/53a08655-153d-4425-a113-a1a60f40e051";
$route['404_override'] = 'errors/error_404';

/* End of file routes.php */
/* Location: ./application/config/routes.php */