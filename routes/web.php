<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\Master\CategoriesController;
use App\Http\Controllers\Master\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::prefix('market')->group(function () {
    Route::get("/", [MarketController::class, 'index'])->name('market.index');
    Route::get("/{id}", [MarketController::class, 'detailProdcut'])->name('market.detail');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost']);
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost']);
});

// auth path
Route::middleware(['auth'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::post("cart/{id}", [CartController::class, "saveToCart"])->name("cart.save");
    Route::get("cart/{id}/delete", [CartController::class, "deleteProductCart"])->name("cart.delete");

    Route::prefix("order")->group(function () {
        Route::get("/", [OrderController::class, "create"])->name("order.create");
        Route::post("/", [OrderController::class, "createOrderPost"]);
        Route::get("/{id}", [OrderController::class, "detail"])->name("order.detail");
    });

    Route::middleware('role:SUPER')->prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('profile')->group(function () {
            Route::get('/', [UserProfileController::class, 'index'])->name('profile.index');
            Route::post('/', [UserProfileController::class, 'update']);
        });

        Route::prefix("master")->group(function () {
            Route::prefix("product")->group(function () {
                Route::get("/", [ProductController::class, "index"])->name("master.product.index");

                Route::get("/create", [ProductController::class, "create"])->name("master.product.create");
                Route::post("/create", [ProductController::class, "createPost"]);

                Route::get("/edit/{id}", [ProductController::class, "edit"])->name("master.product.edit");
                Route::post("/edit/{id}", [ProductController::class, "editPost"]);
                Route::get("/edit/{id}/delete-image/{image_id}", [ProductController::class, "deleteImagePost"])->name("master.product.delete-image");

                Route::get("/{id}", [ProductController::class, "detail"])->name("master.product.detail");
                Route::post("/{id}", [ProductController::class, "detailPost"]);

                Route::get("/delete/{id}", [ProductController::class, "delete"])->name("master.product.delete");
            });

            Route::prefix("categories")->group(function () {
                Route::get("/", [CategoriesController::class, "index"])->name("master.categorie.index");
                Route::post("/", [CategoriesController::class, "createPost"]);

                Route::get("/edit/{id}", [CategoriesController::class, "edit"])->name("master.categorie.edit");
                Route::post("/edit/{id}", [CategoriesController::class, "editPost"]);

                Route::get("/delete/{id}", [CategoriesController::class, "delete"])->name("master.categorie.delete");
            });
        });
    });

    // upload files route && only adamin
    Route::prefix("files")->group(function () {
        Route::post("upload", function (\Illuminate\Http\Request $request, \App\Services\Interfaces\FileTempService $fileTempService) {
            return $fileTempService->uploadTemp($request);
        })->name("files.upload");

        Route::delete("revert", function (\Illuminate\Http\Request $request, \App\Services\Interfaces\FileTempService $fileTempService) {
            return $fileTempService->revertTemp($request);
        })->name("files.revert");
    });
});