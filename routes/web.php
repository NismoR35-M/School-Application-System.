<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route; //used to define routes
// use App\Http\Controllers\AuthController; //not yet
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SchoolController;



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
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

Route::middleware(['admin'])->group(function () {
    //Admin Routes
    Route::get('/admin/register', [AdminController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.register.submit');
    Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::put('/admin/update/{id}', [AdminController::class, 'adminUpdate'])->name('admin.profile.update');
    Route::post('/admin/upload-image', [AdminController::class, 'uploadImage'])->name('admin.uploadImage');
    //admin dash
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
   
    //Admin profile
    Route::get('/admin/profileAdmin/{id}', [AdminController::class, 'profileAdmin'])->name('admin.profileAdmin');
    //profile admin
    Route::get('/admin/profile', [AdminController::class, 'adminProf'])->name('admin.admin_profile');
    //retrieve list of admins
    Route::get('/admin/admins', [CardsController::class, 'admins'])->name('admin.admins');
    //all schools selections
    Route::get('/admin/schoolSelection', [CardsController::class, 'schoolSelection'])->name('admin.schoolSelection');
    //retrieve list of students
    Route::get('/admin/students', [CardsController::class, 'students'])->name('admin.students');
     //Create student
     Route::post('/admin/students', [CardsController::class, 'createStudent'])->name('admin.users.create');
     Route::put('/admin/students', [CardsController::class, 'updateStudent'])->name('admin.users.update');
     Route::delete('/admin/students', [CardsController::class, 'deleteStudent'])->name('admin.users.delete');
 
    //retrieve list of schools
    Route::get('/admin/schools', [CardsController::class, 'schools'])->name('admin.schools');
    Route::get('/admin/schools/create', [CardsController::class, 'showCreateSchoolForm'])->name('admin.schools.create');
    Route::post('/admin/schools', [CardsController::class, 'createSchool'])->name('admin.schools.store');
    Route::put('/admin/schools', [CardsController::class, 'updateSchool'])->name('admin.schools.update');
    Route::delete('/admin/schools', [CardsController::class, 'deleteSchool'])->name('admin.schools.delete');
    


});

//Handles 'POST' request when when routing data to saveSelection()method
Route::post('/save-selection', [DashboardController::class, 'saveSelection'])->name('saveSelection');

//handle the logic 'GET' to retrieve and display the selected schools
Route::get('/selected-schools', [DashboardController::class, 'selectedSchools'])
    ->name('selectedSchools');


// School Routes
Route::get('/schools',[SchoolController::class, 'index'])->name('schools.index');
Route::get('/schools/{type}',[SchoolController::class,'getSchoolsByType'])->name('schools.type');
Route::get('/schools/{type}/{category}',[SchoolController::class,'getSchoolsByCategory'])->name('schools.category');
Route::get('/schools/{type}/{category}/{schoolId}',[SchoolController::class,'show'])->name('schools.show');
//Search schools
Route::get('searchschools',[SchoolController::class, 'search']) -> name('admin.search.schools');
//search student
Route::get('searchstudents',[StudentController::class, 'search'])-> name('admin.search.students');




require __DIR__.'/auth.php';
