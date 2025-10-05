<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HealthTipController;
use App\Http\Controllers\PatientRecordController;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Default dashboard route with authentication middleware
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes for Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Default login and register routes (added for Laravel Breeze authentication)
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Require auth routes for login, register, etc.
require __DIR__.'/auth.php';

// Health Tips Routes (public access for viewing)
Route::get('/health-tips', [HealthTipController::class, 'index'])->name('health-tips.index');
Route::get('/health-tips/{healthTip}', [HealthTipController::class, 'show'])->name('health-tips.show');

// Protected routes for authenticated users
Route::middleware(['auth', 'verified'])->group(function () {
    
    // User health dashboard
    Route::get('/health-dashboard', [UserController::class, 'healthDashboard'])->name('users.health-dashboard');
    Route::patch('/health-dashboard', [UserController::class, 'updateHealth'])->name('users.update-health');
    
    // Health Tips Management (admin and doctor only)
    Route::middleware(['role:admin,doctor'])->group(function () {
        Route::get('/health-tips/create', [HealthTipController::class, 'create'])->name('health-tips.create');
        Route::post('/health-tips', [HealthTipController::class, 'store'])->name('health-tips.store');
        Route::get('/health-tips/{healthTip}/edit', [HealthTipController::class, 'edit'])->name('health-tips.edit');
        Route::patch('/health-tips/{healthTip}', [HealthTipController::class, 'update'])->name('health-tips.update');
        Route::delete('/health-tips/{healthTip}', [HealthTipController::class, 'destroy'])->name('health-tips.destroy');
    });
    
    // Patient Records Management (doctor and admin only)
    Route::middleware(['role:admin,doctor'])->group(function () {
        Route::resource('patient-records', PatientRecordController::class);
        Route::get('/patient-records/patient/{patientId}', [PatientRecordController::class, 'patientRecords'])->name('patient-records.patient-history');
        Route::get('/patient-records/create/{patientId?}', [PatientRecordController::class, 'create'])->name('patient-records.create');
    });
    
    // Patient view of their own records
    Route::get('/my-records', [PatientRecordController::class, 'patientView'])->name('patient-records.patient-view');
    
    // Admin only routes
    Route::middleware(['role:admin'])->group(function () {
        // User management
        Route::resource('users', UserController::class);
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
        
        // Health tip status toggle
        Route::patch('/health-tips/{healthTip}/toggle-status', [HealthTipController::class, 'toggleStatus'])->name('health-tips.toggle-status');
        
        // User statistics
        Route::get('/admin/stats', [UserController::class, 'getStats'])->name('admin.stats');
    });
    
    // API endpoints for AJAX requests
    Route::prefix('api')->name('api.')->group(function () {
        Route::get('/health-tips/category/{category}', [HealthTipController::class, 'getByCategory'])->name('health-tips.by-category');
        Route::get('/health-tips/random', [HealthTipController::class, 'getRandom'])->name('health-tips.random');
        Route::get('/users/role/{role}', [UserController::class, 'getByRole'])->name('users.by-role');
    });
});
