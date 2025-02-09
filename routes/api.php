<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
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

    // Crm Status
    Route::apiResource('crm-statuses', 'CrmStatusApiController');

    // Crm Customer
    Route::apiResource('crm-customers', 'CrmCustomerApiController');

    // Crm Note
    Route::apiResource('crm-notes', 'CrmNoteApiController');

    // Crm Document
    Route::post('crm-documents/media', 'CrmDocumentApiController@storeMedia')->name('crm-documents.storeMedia');
    Route::apiResource('crm-documents', 'CrmDocumentApiController');

    // Faq Category
    Route::apiResource('faq-categories', 'FaqCategoryApiController');

    // Faq Question
    Route::post('faq-questions/media', 'FaqQuestionApiController@storeMedia')->name('faq-questions.storeMedia');
    Route::apiResource('faq-questions', 'FaqQuestionApiController');

    // Task Status
    Route::apiResource('task-statuses', 'TaskStatusApiController');

    // Task Tag
    Route::apiResource('task-tags', 'TaskTagApiController');

    // Task
    Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TaskApiController');

    // Settings
    Route::apiResource('settings', 'SettingsApiController', ['except' => ['store', 'show', 'destroy']]);

    // Content Category
    Route::apiResource('content-categories', 'ContentCategoryApiController');

    // Content Tag
    Route::apiResource('content-tags', 'ContentTagApiController');

    // Content Page
    Route::post('content-pages/media', 'ContentPageApiController@storeMedia')->name('content-pages.storeMedia');
    Route::apiResource('content-pages', 'ContentPageApiController');

    // Team
    Route::apiResource('teams', 'TeamApiController');

    // Buildings
    Route::apiResource('buildings', 'BuildingsApiController');

    // Units
    Route::apiResource('units', 'UnitsApiController');

    // Contracts
    Route::post('contracts/media', 'ContractsApiController@storeMedia')->name('contracts.storeMedia');
    Route::apiResource('contracts', 'ContractsApiController');

    // Maintenance Requests
    Route::apiResource('maintenance-requests', 'MaintenanceRequestsApiController');

    // Amenities
    Route::apiResource('amenities', 'AmenitiesApiController');

    // Amenity Reservations
    Route::apiResource('amenity-reservations', 'AmenityReservationsApiController');
});
