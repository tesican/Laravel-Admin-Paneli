<?php

define("DASHBOARD", "admin");
Route::get('/', array("as" => "home", 'before' => 'admin.login', "uses" => "admin\HomeController@index"));

Route::group(array('prefix' => DASHBOARD, 'before' => 'admin.login'), function() {
    Route::get('/', array('as' => 'admin.home','uses' => 'admin\HomeController@index'));
    Route::controller('pages', 'admin\PagesController');
    Route::controller('users', 'admin\UsersController');
    Route::controller('settings', 'admin\SettingsController');
    Route::controller('galeries', 'admin\GaleriesController');
});

// Oturum kontrolü için gerekli yönlendirmeler
Route::get(DASHBOARD.'/login', 
        array("as" => "admin.login", "uses" => "admin\AuthController@index")
);
Route::post(DASHBOARD.'/login', 
        array("as" => "admin.doLogin", 'before' => 'csrf', "uses" => "admin\AuthController@doLogin")
);
Route::get(DASHBOARD.'/logout', 
        array("as" => "admin.logout", "uses" => "admin\AuthController@logout")
);