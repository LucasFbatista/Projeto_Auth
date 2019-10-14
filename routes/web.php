<?php


//ROUTE BOAS VINDAS
Route::get('/', function () {
    return view('welcome');
});


/*
*
*     ROTA DE AUTENTICAÇÃO DE USERS
* ============================================================================================================================================
*/

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

/*
*
*     ROTA DE AUTENTICAÇÃO DE ADMINS
* ============================================================================================================================================
*/
Route::prefix('/admin')->name('admin.')->namespace('Admins')->group(function(){

    Route::namespace('Auth')->group(function(){

        //ROTAS DE LOGIN
        Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login');
        Route::post('/logout','LoginController@logout')->name('logout');
        //ROTA ESQUECI MINHA SENHA
        Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        //ROTA RESET SENHA
        Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');
    });

    //ROTA HOME ADMINS
    Route::get('/home','HomeController@index')->name('home')->middleware('auth:admin');


});
/* ============================================================================================================================================*/

/*
*
*     ROTA DE AUTENTICAÇÃO DE MANAGERS
* ============================================================================================================================================
*/
Route::prefix('/login')->name('manager.')->namespace('Managers')->group(function(){

    Route::namespace('Auth')->group(function(){

        //ROTAS DE LOGIN
        Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login');
        Route::post('/logout','LoginController@logout')->name('logout');
        //ROTA ESQUECI MINHA SENHA
        Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        //ROTA RESET SENHA
        Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');
    });


    //ROTA HOME MANAGER
    Route::get('/home','HomeController@index')->name('home')->middleware('auth:manager');

});
/* ============================================================================================================================================*/
