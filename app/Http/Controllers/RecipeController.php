<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Models\Action;
use App\Models\Product;
use App\Models\Recipe;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Object_;

class RecipeController extends Controller
{
    /**
     * Возвращает все рецепты всех пользователей (авторизация не требуется)
     * @return JsonResponse
     */
    public function getAllRecipes():JsonResponse
    {
        $recipes = Recipe::all();

        foreach ($recipes as $recipe)
        {
            $product = Product::query()->where('recipe_id', $recipe->id)->get();
            $action = Action::query()->where('recipe_id', $recipe->id)->get();
            $recipe->products = $product;
            $recipe->action = $action;
        }

        return response()->json($recipes);
    }

    /**
     * Возвращает все рецепты авторизированного пользователя
     * @return JsonResponse
     */
    public function getMyUserRecipes():JsonResponse
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

    /**
     * В будущем будет возвращать все чужие рецепты, на которые авторизированные пользователь сделал закладки
     * @return JsonResponse
     */
    public function getSaveUserRecipes():JsonResponse
    {
        //Временное решение, пока нет таблицы с сохраненными рецептами
        $user = Auth::user();
        $recipes = Recipe::query()->where('user_id',  '=', 0)->get();

        foreach ($recipes as $recipe)
        {
            $product = Product::query()->where('recipe_id', $recipe->id)->get();
            $action = Action::query()->where('recipe_id', $recipe->id)->get();
            $recipe->products = $product;
            $recipe->action = $action;
        }

        return response()->json($recipes);
    }

    /**
     * Сохраняет новый рецепт в базу данных
     * @param RecipeRequest $request
     * @return JsonResponse
     */
    public function addMyRecipe(RecipeRequest $request):JsonResponse
    {
        $user = Auth::user();

        $recipe = $request->all();

        try {
        $userId = DB::table('recipes')->insertGetId(['user_id' => $user->id, 'title' => $recipe['title']]);

        $arrProducts=[];
        foreach ($recipe['products'] as $product)
        {
            $arrProducts[] = [...$product, 'recipe_id' => $userId];
        }

        $arrActions=[];
        foreach ($recipe['actions'] as $action)
        {
            $arrActions[] = [...$action, 'recipe_id' => $userId];
        }


            DB::table('products')->insert([...$arrProducts]);
            DB::table('actions')->insert([...$arrActions]);
        }catch (Exception $e){
            return response()->json($e);
        }

        return response()->json($userId);

//        DB::transaction(function () {
//            DB::insert('insert into recipes (user_id, title) values ($user->id, $title)');
//
//            DB::insert('insert into products (recipe_id, name, quantity, units) values ($products)');
//
//            DB::insert('insert into actions (recipe_id, name, quantity, units) values ($actions)');
//        });

    }

    public function getRecipeForId(Request $request):JsonResponse
    {
        $data = $request->all();

        try {
            $recipe = Recipe::find($data['recipe_id']);
            $recipe->products = Recipe::find($data['recipe_id'])->products;
            $recipe->actions = Recipe::find($data['recipe_id'])->actions;
        }catch (Exception $e){
            return response()->json($e);
        }

        return response()->json($recipe);
    }
}
