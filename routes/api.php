<?php

use App\Http\Controllers\RecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get_recipe_for_id', [RecipeController::class, 'getRecipeForId']);
Route::post('/get-all-recipe', [RecipeController::class, 'getAllRecipes']);

Route::middleware('auth:sanctum')->post('/get-my-user-recipe', [RecipeController::class, 'getMyUserRecipes']);
Route::middleware('auth:sanctum')->post('/get-bookmark-recipe', [RecipeController::class, 'getBookmarkRecipe']);
Route::middleware('auth:sanctum')->get('/set-bookmark-recipe', [RecipeController::class, 'setBookmarkRecipe']);
Route::middleware('auth:sanctum')->post('/add-my-recipe', [RecipeController::class, 'addMyRecipe']);
Route::middleware('auth:sanctum')->post('/edit-my-recipe', [RecipeController::class, 'editMyRecipe']);
Route::middleware('auth:sanctum')->delete('/del-my-recipe', [RecipeController::class, 'delMyRecipe']);
