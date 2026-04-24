<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function index()
    {
        return response()->json(Recipe::all());
    }

    public function show($id)
    {
        $recipe = Recipe::find($id);
        if ($recipe) {
            return response()->json($recipe);
        }
        return response()->json(['message' => 'Recipe not found'], 404);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'foodtype' => 'required',
            'image1' => 'nullable|string',
            'image2' => 'nullable|string',
            'image3' => 'nullable|string',
            'content' => 'required',
            'preptime' => 'required',
            'cooktime' => 'required',
            'servings' => 'required',
            'instructions' => 'required',
        ]);

        $recipe = Recipe::create([
            'recipe_name' => $validated['name'],
            'recipe_category' => $validated['category'],
            'foodtype' => $validated['foodtype'],
            'image1' => $validated['image1'] ?? '',
            'image2' => $validated['image2'] ?? '',
            'image3' => $validated['image3'] ?? '',
            'recipe_content' => $validated['content'],
            'prep_time' => $validated['preptime'],
            'cook_time' => $validated['cooktime'],
            'servings' => $validated['servings'],
            'instructions' => $validated['instructions'],
        ]);

        return response()->json(['message' => 'Recipe created', 'recipe' => $recipe]);
    }

    public function update(Request $request, $id)
    {
        $recipe = Recipe::find($id);
        if (!$recipe) {
            return response()->json(['message' => 'Recipe not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'foodtype' => 'required',
            'image1' => 'nullable|string',
            'image2' => 'nullable|string',
            'image3' => 'nullable|string',
            'content' => 'required',
            'preptime' => 'required',
            'cooktime' => 'required',
            'servings' => 'required',
            'instructions' => 'required',
        ]);

        $recipe->update([
            'recipe_name' => $validated['name'],
            'recipe_category' => $validated['category'],
            'foodtype' => $validated['foodtype'],
            'image1' => $validated['image1'] ?? $recipe->image1,
            'image2' => $validated['image2'] ?? $recipe->image2,
            'image3' => $validated['image3'] ?? $recipe->image3,
            'recipe_content' => $validated['content'],
            'prep_time' => $validated['preptime'],
            'cook_time' => $validated['cooktime'],
            'servings' => $validated['servings'],
            'instructions' => $validated['instructions'],
        ]);

        return response()->json(['message' => 'Recipe updated', 'recipe' => $recipe]);
    }

    public function destroy($id)
    {
        $recipe = Recipe::find($id);
        if ($recipe) {
            $recipe->delete();
            return response()->json(['message' => 'Recipe deleted']);
        }
        return response()->json(['message' => 'Recipe not found'], 404);
    }
}
