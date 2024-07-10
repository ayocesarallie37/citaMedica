<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Aquí puedo retornar la página principal y ponerle la página web. Le ponemos la dirección de la view de la página.
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->group(function () {
    //Rutas especialidades
    Route::get('/especialidades', [App\Http\Controllers\admin\SpecialtyController::class, 'index']);
    Route::get('/especialidades/create', [App\Http\Controllers\admin\SpecialtyController::class, 'create']);
    Route::get('/especialidades/{specialty}/edit', [App\Http\Controllers\admin\SpecialtyController::class, 'edit']);
    Route::post('/especialidades', [App\Http\Controllers\admin\SpecialtyController::class, 'sendData']);
    Route::put('/especialidades/{specialty}', [App\Http\Controllers\admin\SpecialtyController::class, 'update']);
    Route::delete('/especialidades/{specialty}', [App\Http\Controllers\admin\SpecialtyController::class, 'destroy']);

    //Ruta medicos
    Route::resource('medicos', 'App\Http\Controllers\admin\DoctorController');

    //Ruta pacientes
    Route::resource('pacientes', 'App\Http\Controllers\admin\PatientController');

    //Ruta reportes
    Route::get('/reportes/citas/line', [App\Http\Controllers\admin\ChartController::class, 'appointments']);
    Route::get('/reportes/doctors/column', [App\Http\Controllers\admin\ChartController::class, 'doctors']);

    Route::get('/reportes/doctors/column/data', [App\Http\Controllers\admin\ChartController::class, 'doctorsJson']);
});

Route::middleware(['auth', 'doctor'])->group(function () {
    Route::get('/horario', [App\Http\Controllers\doctor\HorarioController::class, 'edit']);
    Route::post('/horario', [App\Http\Controllers\doctor\HorarioController::class, 'store']);
});

Route::middleware('auth')->group(function() {
    Route::get('/reservarcitas/create', [App\Http\Controllers\AppointmentController::class, 'create']);
    Route::post('/reservarcitas', [App\Http\Controllers\AppointmentController::class, 'store']);
    Route::get('/miscitas', [App\Http\Controllers\AppointmentController::class, 'index']);
    Route::get('/miscitas/{appointment}', [App\Http\Controllers\AppointmentController::class, 'show']);
    Route::post('/miscitas/{appointment}/cancel', [App\Http\Controllers\AppointmentController::class, 'cancel']);
    Route::post('/miscitas/{appointment}/confirm', [App\Http\Controllers\AppointmentController::class, 'confirm']);
    Route::get('/miscitas/{appointment}/cancel', [App\Http\Controllers\AppointmentController::class, 'formCancel']);
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'edit']);
    Route::post('/profile', [App\Http\Controllers\UserController::class, 'update']);

    // JSON
    Route::get('/especialidades/{specialty}/medicos', [App\Http\Controllers\Api\SpecialtyController::class, 'doctors']);
    Route::get('/horario/horas', [App\Http\Controllers\Api\HorarioController::class, 'hours']);
});