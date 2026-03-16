<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormulaireController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/form', [FormulaireController::class, 'index'])->name('form_index');
Route::post('/form', [FormulaireController::class, 'process'])->name('form_process');

Route::get('/form/error', [FormulaireController::class, 'error'])->name('form_error');
Route::get('/form/prev', [FormulaireController::class, 'prev'])->name('form_prev');
Route::get('/form/move/{etape}', [FormulaireController::class, 'move'])->name('form_move')->where('etape', '[1-9]');
Route::get('/form/success', [FormulaireController::class, 'success'])->name('form_success');

Route::get('/form/reset', [FormulaireController::class, 'reset']);