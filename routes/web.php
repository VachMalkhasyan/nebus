<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\CompanyController;
use App\Http\Middleware\CheckApiKey;
use Illuminate\Support\Facades\Route;

Route::middleware([CheckApiKey::class])->group(function () {
    Route::get('companies/building/{buildingId}', [CompanyController::class, 'getCompaniesByBuilding']);
    Route::get('companies/category/{categoryId}', [CompanyController::class, 'getCompaniesByCategory']);
    Route::get('companies/location', [CompanyController::class, 'getCompaniesByLocation']);
    Route::get('companies/{id}', [CompanyController::class, 'getCompanyById']);
    Route::get('companies/search/activity', [CompanyController::class, 'searchCompaniesByActivity']);
    Route::get('companies/search/name', [CompanyController::class, 'searchCompaniesByName']);
    Route::get('/api/documentation', [ApiController::class, 'showSwaggerUI']);
});


