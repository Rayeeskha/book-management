<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PasswordController;

Route::middleware(['auth', 'verified'])->group(function () {
	Route::get('dashboard', DashboardController::class)->name('dashboard');

    // Backend
    Route::resources([
        'books' => \App\Http\Controllers\Backend\BookController::class,
        'roles' => \App\Http\Controllers\Backend\RoleController::class,
        'users' => \App\Http\Controllers\Backend\UserController::class,
        'purchase-history' => \App\Http\Controllers\Backend\PurchaseHistoryController::class,
        'revenue-tracking' => \App\Http\Controllers\Backend\RevenueTrackingController::class,
    ]);
    

    Route::match(['POST','GET'],'get-author', [\App\Http\Controllers\Backend\BookController::class, 'getAuthor']);

    Route::match(['POST','GET'],'get-roles', [\App\Http\Controllers\Backend\RoleController::class, 'getRole']);

    // purchase
    Route::match(['POST','GET'],'book-purchase', [\App\Http\Controllers\Backend\BookController::class, 'purchaseBook'])->name('books.purchase');
    

    Route::match(['POST','GET'],'/status-change', [\App\Http\Controllers\CommonController::class, 'changeDataTableStatus']);

    Route::match(['POST','GET'],'/delete-datatable-row', [\App\Http\Controllers\CommonController::class, 'deleteDataTableRow']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    // Profile 
     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/update-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/delete-profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('password', [PasswordController::class, 'update'])->name('password.update'); 

});



?>