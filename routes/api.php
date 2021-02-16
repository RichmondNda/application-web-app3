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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/connection', 'App\Http\Controllers\GestionnaireController@login');

## LES NAISSANCES 

Route::post('/enr-nouveau-nee', 'App\Http\Controllers\NouveauNeeController@EnregistrerNouveauNee');
Route::post('/enr-nouveau-dece', 'App\Http\Controllers\NouveauNeeController@EnNouveauDeces');
Route::post('/codeVerify', 'App\Http\Controllers\GestionnaireController@Mairie_SeeInfoChidDec');
Route::post('/EnregistrementExtrait', 'App\Http\Controllers\GestionnaireController@Mairie_EnregisteExtrait');

Route::get('/pdf-Naissanceget/{num_acte}', 'App\Http\Controllers\GestionnaireController@laodViewPDF');

## LES DÉCÈS 
Route::get('/liste-RegitresNaissance', 'App\Http\Controllers\GestionnaireController@Mairie_RegistresNaissance');


Route::post('/enr-nouveau-dece', 'App\Http\Controllers\DécèController@EnNouveauDeces');


## MARIAGE 

Route::post('/mariage', 'App\Http\Controllers\MariageController@mariage' );

## STATISQTIQUES
Route::get('/statistiques', 'App\Http\Controllers\StatController@statistiques');

// Route::group(['middleware' => ['auth:sanctum', 'verified']], function(){
    
// });
