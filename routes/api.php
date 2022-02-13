<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::match(["GET", "POST"], '/products', [MainController::class, "products"]);
Route::match(["GET", "POST"], '/filter/{value}', [MainController::class, "filter"]);
Route::match(["GET", "POST"], '/categories', [MainController::class, "categories"]);
Route::match(["GET", "POST"], '/brands', [MainController::class, "brands"]);
Route::match(["GET", "POST"], '/featured_products', [MainController::class, "featured_products"]);
Route::match(["GET", "POST"], '/trending_products', [MainController::class, "featured_products"]);
Route::match(["GET", "POST"], '/single_product/{id}', [MainController::class, "single_product"]);
Route::match(["GET", "POST"], '/faqs', [MainController::class, "faqs"]);
Route::match(["GET", "POST"], '/blogs', [MainController::class, "blogs"]);
Route::match(["GET", "POST"], '/single_blog/{id}', [MainController::class, "single_blog"]);
Route::match(["GET", "POST"], '/add_question', [MainController::class, "add_question"]);
Route::match(["GET", "POST"], '/add_transaction', [MainController::class, "transaction"]);
Route::match(["GET", "POST"], '/update_status/{ref}', [MainController::class, "update_status"]);
Route::match(["GET", "POST"], '/add_contact', [MainController::class, "add_contact"]);
Route::match(["GET", "POST"], '/update_contact', [MainController::class, "update_contact"]);
Route::match(["GET", "POST"], '/get_contact/{user_id}', [MainController::class, "get_contact"]);
Route::match(["GET", "POST"], '/products_per_page/{num}', [MainController::class, "products_per_page"]);
Route::match(["GET", "POST"], '/login', [AuthController::class, "login"]);
Route::match(["GET", "POST"], '/register', [AuthController::class, "register"]);
