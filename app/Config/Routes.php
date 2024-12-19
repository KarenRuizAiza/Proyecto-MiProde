<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the defaults
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('register', 'Register::index');
$routes->post('saveUser', 'Register::agregarModificarUsuario');
$routes->get('login', 'Login::index');
$routes->post('auth', 'Login::autenticar');
$routes->post('logout', 'Login::logout');

$routes->get('usuarios', 'Usuario::index');
$routes->post('agregarModificarUsuario', 'Usuario::agregarModificarUsuario');
$routes->get('/updateUsuario/(:num)', 'Usuario::usuarioSeleccionado/$1');
$routes->get('/restablecerContraseña/(:num)', 'Usuario::restablecerContraseña/$1');
$routes->get('/deleteUsuario/(:num)','Usuario::eliminarUsuario/$1');

$routes->get('participantes/torneo=(:num)', 'Participante::index/$1');
$routes->get('participantes/torneo', 'Participante::index/null');

$routes->get('predicciones/participante=(:num)', 'Prediccion::index/$1');
$routes->get('predicciones/participante', 'Prediccion::index/null');

$routes->get('torneos', 'Torneo::index');
$routes->post('agregarModificarTorneo', 'Torneo::agregarModificarTorneo');
$routes->get('/updateTorneo/(:num)', 'Torneo::torneoSeleccionado/$1');
$routes->get('/deleteTorneo/(:num)','Torneo::eliminarTorneo/$1');
$routes->get('/agregarFase/torneo=(:num)', 'Torneo::agregarFase/$1');

$routes->get('fases/torneo=(:num)', 'Fase::index/$1');
$routes->post('agregarModificarFase', 'Fase::agregarModificarFase');
$routes->get('/modificar/fase=(:num)/torneo=(:num)', 'Fase::faseSeleccionada/$1/$2');
$routes->get('/eliminar/fase=(:num)','Fase::eliminarFase/$1');
$routes->get('/agregarPartido/fase=(:num)', 'Fase::agregarPartido/$1');

$routes->get('partidos/fase=(:num)', 'Partido::index/$1');
$routes->post('agregarModificarPartido', 'Partido::agregarModificarPartido');
$routes->get( 'cargarResultado/partido=(:num)/fase=(:num)', 'Partido::cargarResultado/$1/$2');
$routes->post('agregarResultado', 'Partido::agregarResultado');
$routes->get( 'cargarPrediccion/partido=(:num)/fase=(:num)', 'Partido::cargarPrediccion/$1/$2');
$routes->post('agregarPrediccion', 'Partido::agregarPrediccion');
$routes->get('eliminarPrediccion/prediccion=(:num)', 'Partido::eliminarPrediccion/$1');
$routes->get('/modificar/partido=(:num)/fase=(:num)', 'Partido::partidoSeleccionado/$1/$2');
$routes->get('/eliminar/partido=(:num)','Partido::eliminarPartido/$1');

$routes->get('grupos', 'Grupo::index');
$routes->post('agregarModificarGrupo', 'Grupo::agregarModificarGrupo');
$routes->get('/updateGrupo/(:num)', 'Grupo::grupoSeleccionado/$1');
$routes->get('/deleteGrupo/(:num)','Grupo::eliminarGrupo/$1');
$routes->get('/agregarEquipo/(:num)', 'Grupo::agregarEquipo/$1');

$routes->get('equipos/(:num)', 'Equipo::equiposPorGrupo/$1');
$routes->get('equipos/', 'Equipo::index/$1');
$routes->post('agregarModificar', 'Equipo::agregarModificarEquipo');
$routes->get('/update/(:num)', 'Equipo::equipoSeleccionado/$1');
$routes->get('/delete/(:num)','Equipo::eliminarEquipo/$1');

//fixture
$routes->get('apuestas', 'Torneo::apuestasRealizadas');
$routes->get('fixture/(:num)', 'Fase::recuperarFixture/$1');

// desafío
$routes->get('desafios', 'DesafioController::index');
$routes->get('desafios', 'DesafioController::misDesafios');
$routes->post('agregarModificar', 'Desafio::agregarModificarDesafio');
$routes->get('/update/(:num)', 'Desafio::desafioSeleccionado/$1');
$routes->get('/delete/(:num)','Desafio::eliminarDesafio/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
