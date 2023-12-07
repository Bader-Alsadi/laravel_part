<?php

use App\Http\Controllers\AuthorController;

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get("books/{id}", [BookController::class, "show"]);
Route::middleware(["Loacalzation"])->group(function () {
    Route::get("/categories/{id}/books", [CategoryController::class, "indexBooks"]);
    Route::get("/authors/{id}/profile", [AuthorController::class, "indexProfile"]);
    Route::post("/authors/{id}/books/{ids}", [AuthorController::class, "addBooks"]);
    Route::delete("/authors/{id}/books/{ids}", [AuthorController::class, "deleteBooks"]);
    Route::put("/authors/{id}/books/{ids}", [AuthorController::class, "updateBooks"]);
    Route::post("/books/{id}/authors/{ids}", [BookController::class, "addAuthors"]);
    Route::put("/books/{id}/authors/{ids}", [BookController::class, "updateAuthors"]);
    Route::delete("/books/{id}/authors/{ids}", [BookController::class, "deleteAuthors"]);
    Route::get("/books/{id}/category", [BookController::class, "indexCategory"]);
    Route::post("/books/{id}/profile", [BookController::class, "storeProfile"]);

    Route::apiResources([

        'books' => BookController::class,
        'authors' => AuthorController::class,
        'categories' => CategoryController::class,
        'profiles' => ProfileController::class,


    ]);
});
