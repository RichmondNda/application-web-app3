<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


# Niassance

Route::get('/DeclarationNaissance', 'App\Http\Controllers\NouveauNeeController@SeeDeclaration')->name('see-decl-naiss');
Route::post('/declaration-new-nee-code', 'App\Http\Controllers\NouveauNeeController@SendCodeChildDec')->name('sendCode-childDec');
Route::get('/SendInfoDecChild/{code}', 'App\Http\Controllers\NouveauNeeController@SeeInfoDeclaration')->name('Show.sendInfochildDec');
ROute::post('/SendInfoDecChild', 'App\Http\Controllers\NouveauNeeController@EnregistrementInfochildDec')->name('Post.sendInfochildDec');
Route::get('/mes-demandes', 'App\Http\Controllers\UserController@mesdemandes');
Route::get('/nouvelle-extrait', 'App\Http\Controllers\UserController@demander_nouvelleExtrait')->name('show.newEwtrait');

## Naissance PDF 

Route::get('/pdf-download/{num_acte}-{code}', 'App\Http\Controllers\UserController@laodPDF');

Route::post('/demanderSonExtrait', 'App\Http\Controllers\UserController@demanderSonExtrait');
Route::get('/demanderSonExtrait', 'App\Http\Controllers\UserController@SeePayment')->name('See.payment');



# Décès 

Route::get('/DeclarationDeces', 'App\Http\Controllers\DécèController@SeeDeclaration')->name('see-decl-deces');
Route::post('/declaration-new-deces-code', 'App\Http\Controllers\DécèController@SendCodeDecesDec')->name('sendCode-decesDec');



# ADMINISTRATIONS UTILISANT NOS SERVICES 

Route::post('Admin-login','App\Http\Controllers\AdministrationPublicController@login');
Route::get('AdministrationPublic', 'App\Http\Controllers\AdministrationPublicController@index');
Route::get('Admin-decodeur', 'App\Http\Controllers\AdministrationPublicController@decodeindex')->name('admin.decodeur');
Route::post('decodeur-extrait', 'App\Http\Controllers\AdministrationPublicController@decodeQrcode');
ROute::get('AdminPdf/{code}/{numacte}/{date}', 'App\Http\Controllers\AdministrationPublicController@laodUserPdf');

//  Signature 

Route::get('Signature', 'App\Http\Controllers\SignatureController@signature');
Route::post('ok-signature', 'App\Http\Controllers\SignatureController@ok_signature');


//  STATISTIQUES

