<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get_recipe_for_id', [RecipeController::class, 'getRecipeForId']);
Route::post('/get-all-recipe', [RecipeController::class, 'getAllRecipes']);
Route::middleware('auth:sanctum')->post('/get-my-user-recipe', [RecipeController::class, 'getMyUserRecipes']);
Route::middleware('auth:sanctum')->post('/get-save-user-recipe', [RecipeController::class, 'getSaveUserRecipes']);
Route::middleware('auth:sanctum')->post('/add-my-recipe', [RecipeController::class, 'addMyRecipe']);
Route::middleware('auth:sanctum')->delete('/del-my-recipe', [RecipeController::class, 'delMyRecipe']);
