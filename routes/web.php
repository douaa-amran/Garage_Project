<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\SparePartController;

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/', function () {
        $user = Auth::user();

        switch ($user->role) {
            case 'Admin':
                return view('admin.dashboard');
            case 'Client':
                return view('client.dashboard');
            case 'Mechanic':
                return view('mechanic.dashboard');
            default:
                return abort(403, 'Unauthorized action.');
        }
    });

    Route::resource('clients', ClientController::class);
    Route::get('/clients-export', [ClientController::class, 'export'])->name('clients.export');
    Route::post('/clients-import', [ClientController::class, 'import'])->name('clients.import');

    Route::resource('vehicles', VehicleController::class)->except(['show']);

    Route::resource('mechanics', MechanicController::class)->except(['show']);

    Route::resource('spareparts', SparePartController::class)->except(['show']);

    Route::get('repairs/create/{clientId}', [RepairController::class, 'create'])->name('repairs.create');

    Route::resource('repairs', RepairController::class)->except(['create']);

    Route::get('/repairs/{repair}/invoices', [InvoiceController::class, 'index'])->name('repairs.invoices');
    Route::get('invoices/create/{repairId}', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/invoices/{repairId}', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('{repair}/invoices/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
    Route::put('{repair}/invoices/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
    Route::delete('invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');

    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

Route::get('generate-pdf/{id}', [PDFController::class, 'generatePDF'])->name('generate-pdf');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'authenticate']);
});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
