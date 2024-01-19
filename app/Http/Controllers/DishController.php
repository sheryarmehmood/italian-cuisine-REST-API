<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;
use Validator;

class DishController extends Controller
{

    //to fetch all dishes
    public function index()
    {
        // indexing paginated feedback 
        $dishes = Dish::paginate(1); // You can adjust the number of items per page as needed

        return response()->json(['data' => $dishes], 200);
    }


    //to save new dish
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), 
        [ 
            'name' => ['required', 'string', 'max:255', Rule::unique('dishes')],
            'description' => 'required|string',
            'image_url' => 'required|url',
            'price' => 'required|numeric|unsigned',
       ]);  

        if ($validator->fails()) {  

        return response()->json(['error'=>$validator->errors()], 401); 

        }  

        // Create a new dish
        $dish = Dish::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image_url' => $request->input('image_url'),
            'price' => $request->input('price'),
        ]);

        // Optionally, you can return the created dish as a response
        return response()->json(['message' => 'Dish created successfully', 'dish' => $dish], 201);
    }


    public function rateDish(Request $request, $dishId)
    {
        // Validate the request data
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        // Find the dish by ID
        $dish = Dish::findOrFail($dishId);

        // Update the dish rating
        $dish->update(['rating' => $request->input('rating')]);

        return response()->json(['message' => 'Dish rated successfully']);
    }
}
