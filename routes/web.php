<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SwaidaController;
use App\Http\Controllers\MarketingMonthlyEarningsController;
use App\Http\Controllers\MarketingMonthlyContractsController;

//Swaida
Route::get('/swaidaPage', [SwaidaController::class, 'index']);
Route::match(['get', 'post'], '/swaidaFilter', [SwaidaController::class, 'filter']);
Route::get('/swaidaAdd', [SwaidaController::class, 'showAddForm']);
Route::post('/swaidaAdd', [SwaidaController::class, 'addItem']);
Route::get('/swaidaDelete/{id}', [SwaidaController::class, 'deleteItem']);
Route::get('/swaidaEdit/{id}', [SwaidaController::class, 'showEditForm']);
Route::post('/swaidaEdit/{id}', [SwaidaController::class, 'editItem']);
Route::post('/swaidaBulkDelete', [SwaidaController::class, 'bulkDelete']);
Route::get('/swaida/downloadcsv', [SwaidaController::class, 'downloadCsv'])->name('swaida.downloadCsv');

// Marketing Monthly Earnings
Route::get('/marketingEarnings', [MarketingMonthlyEarningsController::class, 'index']);
Route::match(['get', 'post'], '/marketingEarningsFilter', [MarketingMonthlyEarningsController::class, 'filter']);
Route::get('/marketingEarningsAdd', [MarketingMonthlyEarningsController::class, 'showAddForm']);
Route::post('/marketingEarningsAdd', [MarketingMonthlyEarningsController::class, 'addItem']);
Route::get('/marketingEarningsDelete/{id}', [MarketingMonthlyEarningsController::class, 'deleteItem']);
Route::get('/marketingEarningsEdit/{id}', [MarketingMonthlyEarningsController::class, 'showEditForm']);
Route::post('/marketingEarningsEdit/{id}', [MarketingMonthlyEarningsController::class, 'editItem']);
Route::post('/marketingEarningsBulkDelete', [MarketingMonthlyEarningsController::class, 'bulkDelete']);
Route::get('/marketingEarnings/downloadcsv', [MarketingMonthlyEarningsController::class, 'downloadCsv'])->name('marketingEarnings.downloadCsv');

// Marketing Monthly Contracts
Route::get('/marketingMonthlyContractsPage', [MarketingMonthlyContractsController::class, 'index']);
Route::match(['get', 'post'], '/marketingMonthlyContractsFilter', [MarketingMonthlyContractsController::class, 'filter']);
Route::get('/marketingMonthlyContractsAdd', [MarketingMonthlyContractsController::class, 'showAddForm']);
Route::post('/marketingMonthlyContractsAdd', [MarketingMonthlyContractsController::class, 'addItem']);
Route::get('/marketingMonthlyContractsDelete/{id}', [MarketingMonthlyContractsController::class, 'deleteItem']);
Route::get('/marketingMonthlyContractsEdit/{id}', [MarketingMonthlyContractsController::class, 'showEditForm']);
Route::post('/marketingMonthlyContractsEdit/{id}', [MarketingMonthlyContractsController::class, 'editItem']);
Route::post('/marketingMonthlyContractsBulkDelete', [MarketingMonthlyContractsController::class, 'bulkDelete']);
Route::get('/marketingMonthlyContracts/downloadcsv', [MarketingMonthlyContractsController::class, 'downloadCsv'])->name('marketingMonthlyContracts.downloadCsv');