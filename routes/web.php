<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\ContactNoteController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
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


Route::get('/', WelcomeController::class);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class);
    Route::get('/settings/profile-information', ProfileController::class)->name('user-profile-information.edit');
    Route::get('/settings/update-password', PasswordController::class)->name('user-update-password.edit');
    Route::prefix('/admin')->name('admin.')->group(function () {
        Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
        Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
        Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
        Route::get('/contacts/{contact}', [ContactController::class, 'show'])->where('id', '[0->9]+')->name('contacts.show');
        Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
        Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
        Route::delete('/contacts/{contact}/delete', [ContactController::class, 'destroy'])->name('contacts.destroy');
        Route::delete('/contacts/{contact}/restore', [ContactController::class, 'restore'])
            ->name('contacts.restore')
            ->withTrashed();
        Route::delete('/contacts/{contact}/force-delete', [ContactController::class, 'forceDelete'])
            ->name('contacts.force-delete')
            ->withTrashed();

        Route::resource('/companies', CompanyController::class);
        Route::delete('/companies/{company}/restore', [CompanyController::class, 'restore'])
            ->name('companies.restore')
            ->withTrashed();
        Route::delete('/companies/{company}/force-delete', [CompanyController::class, 'forceDelete'])
            ->name('companies.force-delete')
            ->withTrashed();
    });

    Route::resources([
        '/tags' => TagController::class,
        '/tasks' => TaskController::class,
    ]);
    Route::resource('/contacts.notes', ContactNoteController::class);
});

Route::fallback(function () {
    return '<h1>Sorry, the page is not exist</h1>';
});
