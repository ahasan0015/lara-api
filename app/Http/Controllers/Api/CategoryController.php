<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\Mime\Message;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Category::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return response()->json([
            'message' => 'category Created successfully',
            'category' => $category,

        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if($category){
            return response()->json([
                'success'=>true,
                'category' => $category,
            ]);
        }else{
        return response()->json([
            'error'=>true,
            "message"=> 'Category Not found',
        ],404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {$category = Category::find($id);
        // $category = Category::find($id)->update($request->all());

        // return response()->json([
        //     'message' => 'Category Updated Successfully',
        //     'category' => $category,
        // ]);

        if (! $category) {
            return response()->json([
                'error' => true,
                'message' => 'Category not found',

            ], 404);

        } else {
            $category->update($request->all());

            return response()->json([
                'message' => 'Category Updated Successfully',
                'category' => $category,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if(!$category){
            return response()->json([
                'message'=> true,
                'category'=>'No data found',
            ]);
        }else{
            $category->delete();
            return response()->json([
                'message'=>true,
                'category'=> 'category Deleted Successfully',
            ]);
        }
    }
}
