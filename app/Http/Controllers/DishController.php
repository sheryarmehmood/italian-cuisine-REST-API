<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;
use Validator;

class DishController extends Controller
{

    //to fetch all dishes
    // public function index()
    // {
    //     // indexing paginated feedback 
    //     $dishes = Dish::paginate(2); // You can adjust the number of items per page as needed

    //     return response()->json(['data' => $dishes], 200);
    // }


    public function index(Request $request)
    {
    // Get search query from the request parameters
    $searchQuery = $request->input('search');

    // Define the base query to fetch dishes
    $query = Dish::query();

    // Apply search if a search query is provided
    if ($searchQuery) {
        $query->where('name', 'like', "%$searchQuery%")
              ->orWhere('description', 'like', "%$searchQuery%");
    }

    // Paginate the results
    $dishes = $query->paginate(2);

    return response()->json(['data' => $dishes], 200);
    }



    //to save new dish
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), 
        [ 
            'name' => 'required|max:255|string|unique:dishes',
            'description' => 'required||max:255|string',
            'image_url' => 'required|url|max:255',
            'price' => 'required|numeric',
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



    // Get details of a specific dish
    public function show($dishId)
    {
        // Find the dish by ID
        $dish = Dish::find($dishId);

        // Check if the dish is found
        if (!$dish) {
            return response()->json(['message' => 'No dish found'], 404);
        }

        // Return the details of the dish
        return response()->json(['data' => $dish], 200);
    }




    // Update an existing dish
    public function update(Request $request, $dishId)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => "required|max:255|string|unique:dishes,name,$dishId",
            'description' => 'required|max:255|string',
            'image_url' => 'required|url|max:255',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        // Find the dish by ID
        $dish = Dish::find($dishId);

        // Check if the dish is found
        if (!$dish) {
            return response()->json(['message' => 'No dish found'], 404);
        }

        // Update the dish with the new data
        $dish->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image_url' => $request->input('image_url'),
            'price' => $request->input('price'),
        ]);

        // Optionally, you can return the updated dish as a response
        return response()->json(['message' => 'Dish updated successfully', 'dish' => $dish], 200);
    }



    //delete a dish
    public function destroy($dishId)
    {
        try {
            // Find the dish by ID
            $dish = Dish::findOrFail($dishId);

            // Delete the dish
            $dish->delete();

            // Return success response
            return response()->json(['message' => 'Dish deleted successfully'], 200);
        } catch (\Exception $exception) {
            // Dish not found
            return response()->json(['error' => 'Dish not found'], 404);
        }
    }



    public function rate(Request $request, $dishId)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 401);
        }

        try {
            // Find the dish by ID
            $dish = Dish::findOrFail($dishId);

            // Check if the user has already rated the dish
            if (auth()->user()->dishes->contains($dishId)) {
                return response()->json(['error' => 'You already rated this dish'], 401);
            }

            // Attach the user to the dish with the rating
            auth()->user()->dishes()->syncWithoutDetaching([$dishId => ['rating' => $request->input('rating')]]);

            return response()->json(['message' => 'Dish rated successfully']);
        } catch (\Exception $exception) {
            // Dish not found
            return response()->json(['error' => 'Dish not found'], 404);
        }
    }



    
}
