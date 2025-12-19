<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminAnnouncementController;

// Redirect home to login
Route::get('/', fn() => redirect('/login'));

// -------------------------
// Auth routes for guests
// -------------------------
Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// -------------------------
// Logout
// -------------------------
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// -------------------------
// Resident Routes
// -------------------------
Route::middleware(['auth', 'resident'])->prefix('resident')->name('resident.')->group(function() {

    Route::get('/dashboard', [DashboardController::class, 'resident'])->name('dashboard');

    // Resident announcements (correct loading)
    Route::get('/announcement', function () {
        $announcements = \App\Models\Announcement::orderBy('created_at', 'desc')->get();
        return view('resident.announcement', compact('announcements'));
    })->name('announcement');

    Route::get('/create-request', fn() => view('resident.create_request'))->name('create_request');
    Route::post('/create-request', [DashboardController::class, 'submitRequest'])->name('create_request.submit');

    Route::get('/my-requests', [DashboardController::class, 'myRequests'])->name('my_requests');
    Route::delete('/my-requests/{id}', [DashboardController::class, 'deleteRequest'])->name('my_requests.delete');
});

// -------------------------
// Admin Routes
// -------------------------
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function() {

    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

    // Announcements
    Route::get('/announcements', [AdminAnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/announcements/create', [AdminAnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('/announcements', [AdminAnnouncementController::class, 'store'])->name('announcements.store');
    Route::delete('/announcements/{id}', [AdminAnnouncementController::class, 'destroy'])->name('announcements.destroy');

    // Requests
    Route::get('/all-requests', [DashboardController::class, 'allRequests'])->name('all_requests');
    Route::post('/all-requests/{id}/{status}', [DashboardController::class, 'updateRequestStatus'])->name('all_requests.update_status');

    //delete approved request
    Route::delete('/all-requests/{id}', [DashboardController::class, 'adminDeleteRequest'])
    ->name('all_requests.delete');

});
