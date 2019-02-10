<?php

/*
|--------------------------------------------------------------------------
| Common api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->group(['middleware' => 'auth'], function ($router) {
    resource('/users', 'UserController', $router);
    resource('/employees', 'EmployeeController', $router);

    $router->get('/profile', 'ProfileController@index');
    $router->put('/profile', 'ProfileController@update');
    $router->put('/profile/change-password', 'ProfileController@changePassword');
    $router->get('/permissions', 'PermissionController@index');
    resource('/roles', 'RoleController', $router);

    resource('/cities', 'CityController', $router);
    $router->get('/districts', 'DistrictController@index');
    $router->get('/districts/cities/{id}', 'DistrictController@getByCity');
    $router->get('/wards', 'WardController@index');

    resource('/settings', 'SettingController', $router);

    resource('/branches', 'BranchController', $router);
    resource('/departments', 'DepartmentController', $router);
    resource('/positions', 'PositionController', $router);
    resource('/contracts', 'ContractController', $router);
    resource('/plans', 'PlanController', $router);
    resource('/candidates', 'CandidateController', $router);
    resource('/plan_details', 'PlanDetailController', $router);

    $router->get('/departments/branches/{id}', 'DepartmentController@getByBranch');

    $router->put('/users/change-status/{id}', 'UserController@changeStatus');
    $router->put('/employees/change-status/{id}', 'EmployeeController@changeStatus');
    $router->put('/branches/change-status/{id}', 'BranchController@changeStatus');
    $router->put('/settings/change-status/{id}', 'SettingController@changeStatus');
    $router->put('/departments/change-status/{id}', 'DepartmentController@changeStatus');
    $router->put('/positions/change-status/{id}', 'PositionController@changeStatus');

    $router->put('/plans/change-status-wait/{id}', 'PlanController@changeStatusWait');
    $router->put('/plans/change-status-approved/{id}', 'PlanController@changeStatusApproved');
    $router->put('/plans/change-status-not-approved/{id}', 'PlanController@changeStatusNotApproved');
    $router->put('/plans/change-status-done/{id}', 'PlanController@changeStatusDone');
    $router->put('/branches/change-branch-main/{id}', 'BranchController@changeBranchMain');

    $router->get('/export/candidates/{type}', 'CandidateController@export');
    $router->get('/download/candidates/{type}', 'CandidateController@download');
    $router->post('/import/candidates', 'CandidateController@import');

    $router->post('/employees/upload', 'EmployeeController@upload');
    $router->post('/branches/upload', 'BranchController@upload');
    $router->post('/branches/testupload', 'BranchController@testupload');
    $router->post('/settings/upload', 'SettingController@upload');
});


$router->post('login', 'LoginController@login');
$router->post('register', 'RegisterController@register');


/**
 * resource router helper
 * @author KingDarkness <nguyentranhoan13@gmail.com>
 * @date   2018-07-17
 * @param  string     $uri        enpoint url
 * @param  string     $controller controller name
 * @param  Laravel\Lumen\Routing\Router     $router     RouterObject
 */
function resource($uri, $controller, Laravel\Lumen\Routing\Router $router)
{
    $router->get($uri, $controller.'@index');
    $router->get($uri.'/{id}', $controller.'@show');
    $router->post($uri, $controller.'@store');
    $router->put($uri.'/{id}', $controller.'@update');
    $router->delete($uri.'/{id}', $controller.'@destroy');
}




/*
|--------------------------------------------------------------------------
| Common api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
// $router->group([
//     'middleware' => 'auth'
// ], function ($router) {
//     // resource('/users', 'UserController', $router);
//     $router->get('/users', 'UserController@index');
//     $router->get('/users/{id}', 'UserController@show');
//     $router->post('/users', 'UserController@store');
//     $router->put('/users/{id}', 'UserController@update');
//     $router->delete('/users/{id}', 'UserController@delete');

//     $router->get('/profile', 'ProfileController@index');
//     $router->put('/profile', 'ProfileController@update');
//     $router->put('/profile/change-password', 'ProfileController@changePassword');
//     $router->get('/permissions', 'PermissionController@index');
//     // resource('/roles', 'RoleController', $router);
//     $router->get('/roles', 'RoleController@index');
//     $router->get('/roles/{id}', 'RoleController@show');
//     $router->post('/roles', 'RoleController@store');
//     $router->put('/roles/{id}', 'RoleController@update');
//     $router->delete('/roles/{id}', 'RoleController@delete');

//     // resource('/positions', 'PositionController', $router);
// });
//     $router->get('/positions', 'PositionController@index');
//     $router->get('/positions/{id}', 'PositionController@show');
//     $router->post('/positions', 'PositionController@store');
//     $router->put('/positions/{id}', 'PositionController@update');
//     $router->delete('/positions/{id}', 'PositionController@destroy');

// $router->post('login', 'LoginController@login');
// $router->post('register', 'RegisterController@register');


