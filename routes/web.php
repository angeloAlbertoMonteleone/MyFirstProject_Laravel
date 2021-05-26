<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

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


// esercizio 1: implementare la rotta POST per il session/flash
// esercizio 2: implementare la rotta DELETE per il session/forget

// esercizio 1: implementare la rotta PATCH per il session/preferences

// pagina home del form
Route::get('/', function () {
  return view('form');
});


Route::name('session.')->prefix('session')->group(function() {
  // sessione flash di una variabile in sessione
  Route::post('/flash', function(Request $request) {
    $validator = Validator::make($request->all(), [
      'username' => 'required',
      'password' => 'required'
    ]);

    if($validator->fails()) {
      throw new ValidationException($validator);
    }

    $request->session()->put(
      $request->input('username'),
      $request->input('password')
    );

    return redirect()->route('form');

  })->name('flash');

  // sessione forget d
  Route::delete('/forget', function(Request $request) {
  })->name('forget');

  Route::patch('/preferences', function(Request $request) {
  })->name('preferences');


}
);



//
// Route::get('/test', function () {
//   // 1.VALIDO LA RICHIESTA
//
//   // 2.ELABORO IL MODELLO
//
//   // 3.RITORNO UNA VISTA
//   return "TEST";
// });
