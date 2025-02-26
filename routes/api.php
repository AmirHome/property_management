<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'middleware' => ['api']], function () {
    Route::post('login', 'Api\V1\Auth\AuthController@login')->name('login');
    Route::post('register', 'Api\V1\Auth\AuthController@register')->name('register');
    
    
    // Admin routes (protected by sanctum)
    Route::group(['namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
        // Roles
        Route::apiResource('roles', 'RolesApiController');

        // Users
        Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
        Route::apiResource('users', 'UsersApiController');

        // Countries
        Route::apiResource('countries', 'CountriesApiController');

        // Province
        Route::apiResource('provinces', 'ProvinceApiController');

        // User Alerts
        Route::apiResource('user-alerts', 'UserAlertsApiController', ['except' => ['update']]);

        // CRM
        Route::apiResource('crm-statuses', 'CrmStatusApiController');
        Route::apiResource('crm-customers', 'CrmCustomerApiController');
        Route::apiResource('crm-notes', 'CrmNoteApiController');
        Route::post('crm-documents/media', 'CrmDocumentApiController@storeMedia')->name('crm-documents.storeMedia');
        Route::apiResource('crm-documents', 'CrmDocumentApiController');

        // FAQ
        Route::apiResource('faq-categories', 'FaqCategoryApiController');
        Route::post('faq-questions/media', 'FaqQuestionApiController@storeMedia')->name('faq-questions.storeMedia');
        Route::apiResource('faq-questions', 'FaqQuestionApiController');

        // Tasks
        Route::apiResource('task-statuses', 'TaskStatusApiController');
        Route::apiResource('task-tags', 'TaskTagApiController');
        Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
        Route::apiResource('tasks', 'TaskApiController');

        // Settings
        Route::apiResource('settings', 'SettingsApiController', ['except' => ['store', 'show', 'destroy']]);

        // Content Management
        Route::apiResource('content-categories', 'ContentCategoryApiController');
        Route::apiResource('content-tags', 'ContentTagApiController');
        Route::post('content-pages/media', 'ContentPageApiController@storeMedia')->name('content-pages.storeMedia');
        Route::apiResource('content-pages', 'ContentPageApiController');

        // Teams
        Route::apiResource('teams', 'TeamApiController');

        // Property Management
        Route::apiResource('buildings', 'BuildingsApiController');
        Route::apiResource('units', 'UnitsApiController');
        Route::post('contracts/media', 'ContractsApiController@storeMedia')->name('contracts.storeMedia');
        Route::apiResource('contracts', 'ContractsApiController');
        Route::apiResource('maintenance-requests', 'MaintenanceRequestsApiController');
        Route::apiResource('amenities', 'AmenitiesApiController');
        Route::apiResource('amenity-reservations', 'AmenityReservationsApiController');
    });
});
