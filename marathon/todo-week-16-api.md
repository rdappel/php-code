
ARC-- advanced rest client
arc-setup.exe

# New API Controller
Name: Api
Namespace App\Controllers

class Api extends BaseController

public function get_races($key), get_runners($key, $raceID), add_runner, update_, delete_


# Routes:
$routes->get('/api/get_races/(:any), Api::get_races/$1);
$routes->get('/api/get_runners/(:any)/(:any), 'Api::get_runners/$1/$2);

$routes->post('/api/runner', 'Api::add_runner');
$routes->put ('/api/runner', 'Api::update_runner');
$routes->delete('/api/runner', 'Api::delete_runner');

