<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Product;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function getAllRecipes():JsonResponse
    {
        $user = Auth::user();
        $recipes = Recipe::query()->where('user_id',  $user->id)->get();

        foreach ($recipes as $recipe)
        {
            $product = Product::query()->where('recipe_id', $recipe->id)->get();
            $action = Action::query()->where('recipe_id', $recipe->id)->get();
            $recipe->products = $product;
            $recipe->action = $action;
        }

        return response()->json($recipes);
    }
}
