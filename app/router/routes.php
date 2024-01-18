<?php

$routes = [
  '/' => 'HomeController@index',
  '/page/{id}' => 'HomeController@index',
  '/login' => 'HomeController@login',
  '/verify' => 'HomeController@verifyCredentials',
  '/logout' => 'HomeController@logout',
  '/profile/{id}' => 'HomeController@profile',
  '/dump' => 'HomeController@dump',
  '/update-profile' => 'HomeController@updateProfile',

  '/add' => 'NoticiasController@index',
  '/create-noticias' => 'NoticiasController@create',
  '/edit/{id}' => 'NoticiasController@edit',
  '/delete' => 'NoticiasController@delete',
  '/update-noticias' => 'NoticiasController@updateNoticias',

  '/dashboard' =>  'DashboardController@index'
];