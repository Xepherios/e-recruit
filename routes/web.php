<?php

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

$router->get('/', 'HomeController@index'); 
$router->get('/register', 'HomeController@register');
$router->get('/login', 'HomeController@login');
$router->get('/logout', 'HomeController@logout');
$router->get('/profile', 'HomeController@profile'); 
$router->get('/candidate', 'UserController@read');
$router->get('/candidate-experiences', 'UserController@getCandidateWorkExperiences');
$router->get('/candidate-educations', 'UserController@getCandidateEducations');
$router->get('/applications', 'ApplicationController@list'); 
$router->get('/jobs', 'JobController@list');
$router->get('/job/{id}', 'HomeController@job');
$router->get('/verify/{id}', 'UserController@verify');

$router->post('/register', 'UserController@add'); 
$router->post('/auth', 'AuthController@authenticate');
$router->post('/application', 'ApplicationController@add');
$router->patch('/password', 'AuthController@changePassword');
$router->put('/profile', 'UserController@update');   
$router->post('/candidate-educations', 'UserController@updateCandidateEducations'); 
$router->post('/candidate-experiences', 'UserController@updateCandidateWorkExperiences');
 

$router->group(['prefix' => 'admin'], function () use ($router) {
    $router->get('/login', "Admin\\AdminController@login");
    $router->post('/login', "Admin\\AdminController@auth");
 
    $router->group(['middleware' => 'admin-auth'], function () use ($router) {
        $router->get('/', "Admin\\AdminController@index"); 
        $router->get('/logout', "Admin\\AdminController@logout"); 
        $router->get('/applications', 'AdminController@applications'); 
        $router->get('/positions', 'AdminController@positions'); 
        $router->group(['prefix' => 'users'], function () use ($router) {
            $router->get('/', "Admin\\UserController@index"); 
            $router->get('/add', "Admin\\UserController@add"); 
            $router->post('/add', "Admin\\UserController@create"); 
            $router->get('/edit/{id}', "Admin\\UserController@edit"); 
            $router->post('/edit/{id}', "Admin\\UserController@update"); 
            $router->get('/delete/{id}', "Admin\\UserController@delete"); 
        });
        $router->group(['prefix' => 'positions'], function () use ($router) {
            $router->get('/', "Admin\\PositionController@index"); 
            $router->get('/add', "Admin\\PositionController@add"); 
            $router->post('/add', "Admin\\PositionController@create"); 
            $router->get('/edit/{id}', "Admin\\PositionController@edit"); 
            $router->post('/edit/{id}', "Admin\\PositionController@update"); 
            $router->get('/delete/{id}', "Admin\\PositionController@delete"); 
        });
        $router->group(['prefix' => 'departments'], function () use ($router) {
            $router->get('/', "Admin\\DepartmentController@index"); 
            $router->get('/add', "Admin\\DepartmentController@add"); 
            $router->post('/add', "Admin\\DepartmentController@create"); 
            $router->get('/edit/{id}', "Admin\\DepartmentController@edit"); 
            $router->post('/edit/{id}', "Admin\\DepartmentController@update"); 
            $router->get('/delete/{id}', "Admin\\DepartmentController@delete"); 
        });
        $router->group(['prefix' => 'applications'], function () use ($router) {
            $router->get('/', "Admin\\ApplicationController@index");  
            $router->get('/view/{id}', "Admin\\ApplicationController@view"); 
            $router->post('/update/{id}', "Admin\\ApplicationController@update");  
        });
    });
    
});
