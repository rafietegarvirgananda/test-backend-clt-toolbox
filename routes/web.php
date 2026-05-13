<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CltLayupController;
use App\Http\Controllers\CltLayerController;
use App\Http\Controllers\SupplierImportExportController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

   
    Route::resource(
        'suppliers',
        SupplierController::class
    );

    Route::resource(
        'suppliers.layups',
        CltLayupController::class
    );

    Route::resource(
        'suppliers.layups.layers',
        CltLayerController::class
    );

    Route::get(
        '/suppliers/{supplier}/export',
        [SupplierImportExportController::class, 'export']
    )->name('suppliers.export');

    Route::post(
        '/suppliers/{supplier}/import',
        [SupplierImportExportController::class, 'import']
    )->name('suppliers.import');


    Route::get(
        '/suppliers/{supplier}/conflicts',
        function (\App\Models\Supplier $supplier) {

            $conflicts = session('import_conflicts', []);

            return view(
                'suppliers.conflicts',
                compact('supplier', 'conflicts')
            );
        }
    )->name('suppliers.conflicts');

    Route::post(
        '/suppliers/{supplier}/conflicts/resolve',
        [SupplierImportExportController::class, 'resolveConflicts']
    )->name('suppliers.conflicts.resolve');

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');
});


require __DIR__.'/auth.php';