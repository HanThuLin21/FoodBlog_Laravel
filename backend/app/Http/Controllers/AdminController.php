<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function getStats()
    {
        $userCount = DB::table('user')->count();
        $blogCount = DB::table('blogpost')->count();
        $recipeCount = DB::table('recipe')->count();
        $restaurantCount = DB::table('restaurant')->count();

        return response()->json([
            'userCount' => $userCount,
            'blogCount' => $blogCount,
            'recipeCount' => $recipeCount,
            'restaurantCount' => $restaurantCount
        ]);
    }
}
