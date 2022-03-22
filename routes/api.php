<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::apiResource('medicaments', App\Http\Controllers\Api\MedicamentController::class);
Route::apiResource('prescriptions', App\Http\Controllers\Api\PrescriptionController::class);
Route::apiResource('recommandations', App\Http\Controllers\Api\RecommandationController::class);
Route::apiResource('geolocalisation', App\Http\Controllers\Api\GeolocalisationController::class);

Route::get('prescription/patient/{id}', [App\Http\Controllers\Api\PrescriptionController::class, 'prescriptionByPatient']);
Route::get('prescription/medecin/{id}', [App\Http\Controllers\Api\PrescriptionController::class, 'prescriptionByMedecin']);
Route::get('prescription/pharmacien/{id}', [App\Http\Controllers\Api\PrescriptionController::class, 'prescriptionByPharmacien']);
