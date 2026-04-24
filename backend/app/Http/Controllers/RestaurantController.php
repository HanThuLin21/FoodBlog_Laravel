<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        return response()->json(Restaurant::all());
    }

    public function show($id)
    {
        $restaurant = Restaurant::find($id);
        if ($restaurant) {
            return response()->json($restaurant);
        }
        return response()->json(['message' => 'Restaurant not found'], 404);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'foodtype' => 'required',
            'location' => 'required',
            'content' => 'required',
            'image' => 'nullable|string',
            'image2' => 'nullable|string',
            'image3' => 'nullable|string',
            'rate' => 'required',
            'day' => 'required',
            'opentime' => 'required',
            'closetime' => 'required',
        ]);

        $restaurant = Restaurant::create([
            'restaurant_name' => $validated['name'],
            'restaurant_phone' => $validated['phone'],
            'foodtype' => $validated['foodtype'],
            'restaurant_location' => $validated['location'],
            'restaurant_content' => $validated['content'],
            'restaurant_image' => $validated['image'] ?? '',
            'restaurant_image2' => $validated['image2'] ?? '',
            'restaurant_image3' => $validated['image3'] ?? '',
            'restaurant_rating' => $validated['rate'],
            'opening_day' => $validated['day'],
            'open_hour' => $validated['opentime'],
            'close_hour' => $validated['closetime'],
        ]);

        return response()->json(['message' => 'Restaurant created', 'restaurant' => $restaurant]);
    }

    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::find($id);
        if (!$restaurant) {
            return response()->json(['message' => 'Restaurant not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'type' => 'required', // old code used 'type'
            'location' => 'required',
            'content' => 'required',
            'image' => 'nullable|string',
            'image2' => 'nullable|string',
            'image3' => 'nullable|string',
            'rating' => 'required', // old code used 'rating'
            'day' => 'required',
            'opentime' => 'required',
            'closetime' => 'required',
        ]);

        $restaurant->update([
            'restaurant_name' => $validated['name'],
            'restaurant_phone' => $validated['phone'],
            'foodtype' => $validated['type'],
            'restaurant_location' => $validated['location'],
            'restaurant_content' => $validated['content'],
            'restaurant_image' => $validated['image'] ?? $restaurant->restaurant_image,
            'restaurant_image2' => $validated['image2'] ?? $restaurant->restaurant_image2,
            'restaurant_image3' => $validated['image3'] ?? $restaurant->restaurant_image3,
            'restaurant_rating' => $validated['rating'],
            'opening_day' => $validated['day'],
            'open_hour' => $validated['opentime'],
            'close_hour' => $validated['closetime'],
        ]);

        return response()->json(['message' => 'Restaurant updated', 'restaurant' => $restaurant]);
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::find($id);
        if ($restaurant) {
            $restaurant->delete();
            return response()->json(['message' => 'Restaurant deleted']);
        }
        return response()->json(['message' => 'Restaurant not found'], 404);
    }
}
