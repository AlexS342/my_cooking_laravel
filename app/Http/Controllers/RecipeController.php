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
        $recipes = Recipe::query()->where('user_id',  $user['id'])->get();

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
//        $user = Auth::user();
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
            $userId = DB::table('recipes')
                ->insertGetId([
                    'user_id' => $user['id'],
                    'title' => $recipe['title'],
                    'portion' => $recipe['portion'],
                    'full_time' => $recipe['full_time'],
                    'category' => $recipe['category'],
                    'type' => $recipe['type'],
                    'created_at' => now(),
                ]);

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

    /**
     * Возвращает один рецепт по id рецепта
     * @param RecipeRequest $request
     * @return JsonResponse
     */
    public function getRecipeForId(Request $request):JsonResponse
    {
        $data = $request->all();

        try {
            $recipe = Recipe::query()->where('id', '=', $data['recipe_id'])->first();

            $products = Product::query()->where('recipe_id', $data['recipe_id'])->orderBy('id')->get();
            $recipe['products'] = $products;

            $actions = Action::query()->where('recipe_id', $data['recipe_id'])->orderBy('id')->get();
            $recipe['actions'] = $actions;
        }catch (Exception $e){
            return response()->json($e);
        }

        return response()->json($recipe);
    }

    /**
     * Вносит изменения в существующий рецепт
     * @param RecipeRequest $request
     * @return JsonResponse
     */
    public function editMyRecipe(RecipeRequest $request):JsonResponse
    {
        $user = Auth::user();
        $recipe = $request->all();

        //Проверяем, что пользователь является владельцем рецепта
        if($user['id'] != $recipe['user_id'])
        {
            return response()->json(['answer'=>false, 'message'=>'Нельзя изменять чужие рецепты']);
        }

        //Сохраняем изменения в рецепте (продукты и действия сохроняются отдельно)
        DB::table('recipes')->where('id', $recipe['id'])
            ->update([
                'user_id' => $user['id'],
                'title' => $recipe['title'],
                'portion' => $recipe['portion'],
                'full_time' => $recipe['full_time'],
                'category' => $recipe['category'],
                'type' => $recipe['type'],
                'updated_at' => now()
            ]);

        //Разделяем продукты на update и insert
        $updateProducts = [];
        $insertProducts = [];
        foreach ($recipe['products'] as $product)
        {
            if(empty($product['id']))
            {
                $insertProducts[] = $product;
            }else{
                $updateProducts[] = $product;
            }
        }

        //Разделяем действия на update и insert
        $updateActions = [];
        $insertActions = [];
        foreach ($recipe['actions'] as $action)
        {
            if(empty($action['id']))
            {
                $insertActions[] = $action;
            }else{
                $updateActions[] = $action;
            }
        }

        //Получаем ID продуктов, которые уже есть в базе данных
        $dbProducts = DB::table('products')->where('recipe_id', '=', $recipe['id'])->select('id')->get();
        //Получаем ID действий, которые уже есть в базе данных
        $dbActions = DB::table('actions')->where('recipe_id', '=', $recipe['id'])->select('id')->get();

        //Если какие-то продукты были удалены при редактировании, то находим их ID
        $f = false;
        $delProducts =[];
        foreach ($dbProducts as $item)
        {
            foreach($updateProducts as $product)
            {
                if($product['id'] == $item->id)
                {
                    $f = true;
                }
            }
            if(!$f)
            {
                $delProducts[] = $item->id;
            }
            $f = false;
        }

        //Если какие-то действия были удалены при редактировании, то находим их ID
        $f = false;
        $delActions =[];
        foreach ($dbActions as $item)
        {
            foreach($updateActions as $action)
            {
                if($action['id'] == $item->id)
                {
                    $f = true;
                }
            }
            if(!$f)
            {
                $delActions[] = $item->id;
            }
            $f = false;
        }

        //Если найдены продукты для удаления, то удаляем
        try {
            if(count($delProducts) > 0){
                foreach ($delProducts as $item)
                {
                    DB::table('products')->where('id', '=', $item)->delete();
                }
            }
        }catch (Exception $e){
            return response()->json($e);
        }

        //Если найдены действия для удаления, то удаляем
        try {
            if(count($delActions) > 0)
            {
                foreach ($delActions as $item)
                {
                    DB::table('actions')->where('id', '=', $item)->delete();
                }
            }
        }catch (Exception $e){
            return response()->json($e);
        }

        //Обновляем продукты
        if(count($updateProducts) > 0)
        {
            foreach ($updateProducts as $item)
            {
                DB::table('products')->where('id', $item['id'])
                    ->update([
                        'name' => $item['name'],
                        'quantity' => $item['quantity'],
                        'units' => $item['units'],
                    ]);
            }
        }

        //Обновляем действия
        if(count($updateActions) > 0)
        {
            foreach ($updateActions as $item)
            {
                DB::table('actions')->where('id', $item['id'])
                    ->update([
                        'name' => $item['name'],
                        'quantity' => $item['quantity'],
                        'units' => $item['units'],
                    ]);
            }
        }

        //Если есть новые продукты то добавляем в базу данных
        if(count($insertProducts) > 0)
        {
            foreach ($insertProducts as $item)
            {
                DB::table('products')->insert([
                    'recipe_id' => $recipe['id'],
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'units' => $item['units'],
                ]);
            }
        }

        //Если есть новые действия то добавляем в базу данных
        if(count($insertActions) > 0)
        {
            foreach ($insertActions as $item)
            {
                DB::table('actions')->insert([
                    'recipe_id' => $recipe['id'],
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'units' => $item['units'],
                ]);
            }
        }

        return response()->json($recipe);
    }

    public function delMyRecipe(Request $request):JsonResponse
    {
        $user = Auth::user();
        $data = $request->all();

        if($user['id'] != $data['user_id'])
        {
            return response()->json(['answer'=>false, 'message'=>'Нельзя удалять чужие рецепты']);
        }

        try {
            DB::table('actions')->where('recipe_id', '=', $data['id'])->delete();
            DB::table('products')->where('recipe_id', '=', $data['id'])->delete();
            DB::table('recipes')->where('id', '=', $data['id'])->delete();

            $answerData = [
                'answer'=>true,
                'message'=>'Рецепт ' . $data['id'] . ' успешно удален',
            ];
            return response()->json($answerData);
        }
        catch (Exception $e){
            $answerData = [
                'answer'=>false,
                'message'=>'Рецепт ' . $data['id'] . ' не удален',
                'errMessage'=>$e->getMessage(),
            ];
            return response()->json($answerData);
        }
    }
}
