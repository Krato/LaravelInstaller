<?php

Route::group(['prefix' => 'install', 'as' => 'LaravelInstaller::', 'namespace' => 'RachidLaasri\LaravelInstaller\Controllers'], function()
{
    Route::group(['middleware' => 'canInstall'], function()
    {
        Route::get('/', [
            'as' => 'welcome',
            'uses' => 'WelcomeController@welcome'
        ]);

        Route::get('environment', [
            'as' => 'environment',
            'uses' => 'EnvironmentController@environment'
        ]);

        Route::post('environment/save', [
            'as' => 'environmentSave',
            'uses' => 'EnvironmentController@save'
        ]);

        Route::get('requirements', [
            'as' => 'requirements',
            'uses' => 'RequirementsController@requirements'
        ]);
        
        Route::get('permissions', [
            'as' => 'permissions',
            'uses' => 'PermissionsController@permissions'
        ]);

        Route::get('database', [
            'as' => 'database',
            'uses' => 'DatabaseController@database'
        ]);

        Route::get('migrations', [
            'as' => 'migrations',
            'uses' => 'DatabaseController@getMigrations'
        ]);

        Route::get('admin', [
            'as' => 'admin',
            'uses' => 'UserAdminController@createAdmin'
        ]);

        Route::post('admin/save', [
            'as' => 'userAdminSave',
            'uses' => 'UserAdminController@storeAdmin'
        ]);


        Route::get('final', [
            'as' => 'final',
            'uses' => 'FinalController@finish'
        ]);
    });
});