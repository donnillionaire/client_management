<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/clients', 'ClientController@index');
$router->post('/clients', 'ClientController@store');
$router->get('/clients/{client}', 'ClientController@show');
$router->put('/clients/{client}', 'ClientController@update');
$router->patch('/clients/{client}', 'ClientController@update');
$router->delete('/clients/{client}', 'ClientController@destroy');

$router->get('/departments', 'DepartmentController@index');
$router->post('/departments', 'DepartmentController@store');
$router->get('/departments/{dept}', 'DepartmentController@show');
$router->put('/departments/{dept}', 'DepartmentController@update');
$router->patch('/departments/{dept}', 'DepartmentController@update');
$router->delete('/departments/{dept}', 'DepartmentController@destroy');

$router->get('/client-category', 'ClientCategoryController@index');
$router->post('/client-category', 'ClientCategoryController@store');
$router->get('/client-category/{category}', 'ClientCategoryController@show');
$router->put('/client-category/{category}', 'ClientCategoryController@update');
$router->patch('/client-category/{category}', 'ClientCategoryController@update');
$router->delete('/client-category/{category}', 'ClientCategoryController@destroy');

$router->get('/contacts', 'ContactController@index');
$router->post('/contacts', 'ContactController@store');
$router->get('/contacts/{contact}', 'ContactController@show');
$router->put('/contacts/{contact}', 'ContactController@update');
$router->patch('/contacts/{contact}', 'ContactController@update');
$router->delete('/contacts/{contact}', 'ContactController@destroy');

$router->get('/departments-groupings', 'DepartmentsGroupingController@index');
$router->post('/departments-groupings', 'DepartmentsGroupingController@store');
$router->get('/departments-groupings/{group}', 'DepartmentsGroupingController@show');
$router->put('/departments-groupings/{group}', 'DepartmentsGroupingController@update');
$router->patch('/departments-groupings/{group}', 'DepartmentsGroupingController@update');
$router->delete('/departments-groupings/{group}', 'DepartmentsGroupingController@destroy');

$router->get('/modules', 'ModuleController@index');
$router->post('/modules', 'ModuleController@store');
$router->get('/modules/{module}', 'ModuleController@show');
$router->put('/modules/{module}', 'ModuleController@update');
$router->patch('/modules/{module}', 'ModuleController@update');
$router->delete('/modules/{module}', 'ModuleController@destroy');

$router->get('/sub-departments', 'SubDepartmentController@index');
$router->post('/sub-departments', 'SubDepartmentController@store');
$router->get('/sub-departments/{sub_dept}', 'SubDepartmentController@show');
$router->put('/sub-departments/{sub_dept}', 'SubDepartmentController@update');
$router->patch('/sub-departments/{sub_dept}', 'SubDepartmentController@update');
$router->delete('/sub-departments/{sub_dept}', 'SubDepartmentController@destroy');

$router->get('/subsidiaries', 'SubsidiaryController@index');
$router->post('/subsidiaries', 'SubsidiaryController@store');
$router->get('/subsidiaries/{subsidiary}', 'SubsidiaryController@show');
$router->put('/subsidiaries/{subsidiary}', 'SubsidiaryController@update');
$router->patch('/subsidiaries/{subsidiary}', 'SubsidiaryController@update');
$router->delete('/subsidiaries/{subsidiary}', 'SubsidiaryController@destroy');