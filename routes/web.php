<?php

use App\Http\Controllers\ProductController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

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

// Implementare le mie route su UserController
// 1 opzione

// Route::name('users.')->prefix('users')->group(function () {
//   // rotta per recuperare lista utenti
//   Route::get('/', [UserController::class, 'index']);
//   // rotta per visualizzare il form di creazione
//   Route::get('/create', [UserController::class, 'create']);
//   // rotta per salvare un nuovo utente
//   Route::post('/', [UserController::class], 'store');
//   // rotta per visualizzare un utente
//   Route::get('/{id}', [UserController::class], 'show');
//   // rotta per visualizzare il form di mofica
//   Route::get('/{id}/edit', [UserController::class], 'edit');
//   // rotta per modificare un utente
//   Route::patch('/{id}', [UserController::class], 'update');
//   // rotta per eliminare un utente
//   Route::delete('/{id}', [UserController::class], 'destroy');
// });




// 2 opzione

// Route::resource('users', UserController::class);
Route::resource('products', ProductController::class);

// Route::name('products.')->prefix('product')->group(function() {
//   Route::get('/', function(Request $request) {
//     return view('products/create');
//   })->name('create');
// });












// esercizio 1: implementare la rotta POST per il session/flash
// esercizio 2: implementare la rotta DELETE per il session/forget
// esercizio 1: implementare la rotta PATCH per il session/preferences

Route::name('session.')->prefix('session')->group(function() {


  // pagina index del form
  Route::get('/', function(Request $request) {
    return view('form');
  })->name('index');



  // sessione flash di una variabile in sessione
  Route::post('/put', function(Request $request) {
    // valido la richiesta
    $validator = Validator::make($request->all(), [
      'username' => 'required',
      'password' => 'required'
    ]);

    // se la richiesta non e` valida, ritorna un eccezione
    if($validator->fails()) {
      throw new ValidationException($validator);
    }

    // se la richiesta e` valida, salva i dati in una sessione flash
    $request->session()->put(
      $request->input('username'),
      $request->input('password')
    );

    // invio un messaggio put a display, dopo la conferma dell invio di sessione flash
    $request->session()->put('success-message', 'Your credentials have been saved correctly!');

    // ritornare un redirect alla paggina index
    return redirect()->route('session.index');
  })->name('put');



  // sessione forget
  Route::delete('/forget', function(Request $request) {
    $request->session()->forget($request->input('key'));

    // invio un messaggio delete a display, dopo la conferma dell invio di sessione forget
    $request->session()->put('success-message', 'Your credentials have been deleted correctly!');

    return redirect()->route('session.index');
  })->name('forget');







  // session index.array, pagina index del form
  Route::get('/index_preferences', function(Request $request) {
    return view('array_form');
  })->name('index_preferences');



  // sessione preferences valido la richiesta
  Route::patch('/preferences', function(Request $request) {
    $validator = Validator::make($request->all(), [
      'key' => ['required', Rule::in(['perPage', 'orderBy', 'orderDirection'])],
      'value' => 'required'
    ])->validate();

    // valido la richiesta tramite condizioni
    if ($request->input('key') == 'perPage') {
      Validator::make($request->all() , [
        'value' => ['numeric']
      ])->validate();
    }

    if (!$request->session()->has('preferences')) {
      $request->session()->put('preferences', [
        'perPage' => 15,
        'orderBy' => 'id',
        'orderDirection' => 'DESC'
      ]);
    }

    // creazione chiave
    $key = 'preferences.'. $request->input('key');

    // update dell array
    $request->session()->put($key, $request->input('value'));

    return redirect()->route('session.index_preferences');
  })->name('preferences');


});






//
// Route::get('/test', function () {
//   // 1.VALIDO LA RICHIESTA
//
//   // 2.ELABORO IL MODELLO
//
//   // 3.RITORNO UNA VISTA
//   return "TEST";
// });


// // sessione flash di una variabile in sessione
// Route::post('/put', function(Request $request) {
//   // valido la richiesta
//   $validator = Validator::make($request->all(), [
//     'username' => 'required',
//     'password' => 'required'
//   ]);
//
//   // se la richiesta non e` valida, ritorna un eccezione
//   if($validator->fails()) {
//     throw new ValidationException($validator);
//   }
//
//   // se la richiesta e` valida, salva i dati in una sessione flash
//   $request->session()->put(
//     $request->input('username'),
//     $request->input('password')
//   );
//
//   // invio un messaggio flash a display, dopo la conferma dell invio di sessione flash
//   $request->session()->flash('success-message', 'Your credentials have been saved correctly!');
//
//   // ritornare un redirect alla paggina index
//   return redirect()->route('session.index');
// })->name('put');
