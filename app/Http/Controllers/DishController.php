<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{

    public function index(Request $request)
    {
        $searchQuery = $request->input('search');

        $query = Dish::query();

        // Apply search if a search query is provided
        if ($searchQuery) {
            $query->where('name', 'like', "%$searchQuery%")
                ->orWhere('description', 'like', "%$searchQuery%");
        }

        $limit = $request->input('limit', 2); // Default limit is set to 10

        // Paginate the results
        $dishes = $query->paginate($limit);

        return response()->json(['data' => $dishes], 200);
    }


    //Saving new dish
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|string|unique:dishes',
            'description' => 'required|max:255|string|unique:dishes',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        // Handle image upload
        $imagePath = $request->file('image')->store('public/images');
        $imageUrl = Storage::url($imagePath);

        // Create a new dish
        $dish = Dish::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image_url' => $imageUrl,
            'price' => $request->input('price'),
        ]);
        return response()->json(['message' => 'Dish created successfully', 'dish' => $dish], 201);
    }



    // Get details of a specific dish
    public function show($dishId)
    {
        $dish = Dish::find($dishId);

        if (!$dish) {
            return response()->json(['message' => 'No dish found'], 404);
        }

        return response()->json(['data' => $dish], 200);
    }




    // Update an existing dish
    public function update(Request $request, $dishId)
    {

        $validator = Validator::make($request->all(), [
            'name' => "required|max:255|string|unique:dishes,name,$dishId",
            'description' => "required|max:255|string|unique:dishes,description,$dishId",
            'image_url' => 'required|url|max:255',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $dish = Dish::find($dishId);

        if (!$dish) {
            return response()->json(['message' => 'No dish found'], 404);
        }

        $dish->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image_url' => $request->input('image_url'),
            'price' => $request->input('price'),
        ]);

        return response()->json(['message' => 'Dish updated successfully', 'dish' => $dish], 200);
    }



    //delete a dish
    public function destroy($dishId)
    {
        try {
    
                $dish = Dish::findOrFail($dishId);

                $dish->delete();

                return response()->json(['message' => 'Dish deleted successfully'], 200);
            } catch (\Exception $exception) {
            return response()->json(['error' => 'Dish not found'], 404);
            }
    }



    public function rate(Request $request, $dishId)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 401);
        }

        try {
           
                $dish = Dish::findOrFail($dishId);

                // Check if the user has already rated the dish
                if (auth()->user()->dishes->contains($dishId)) {
                    return response()->json(['error' => 'You already rated this dish'], 401);
                }

                // Attach the user to the dish with the rating
                auth()->user()->dishes()->syncWithoutDetaching([$dishId => ['rating' => $request->input('rating')]]);

                return response()->json(['message' => 'Dish rated successfully']);
            } catch (\Exception $exception) {
                return response()->json(['error' => 'Dish not found'], 404);
            }
    }



}
