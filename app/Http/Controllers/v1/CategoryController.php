<?php

namespace App\Http\Controllers\v1;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\v1\Category;

class CategoryController extends Controller
{

    /**
      * Show all categories
      * @method Get
      * @param  Request  $request
      * @param  string  $category_id
      * @return Response
      */
    public function categories($no = 5)
    {
        $category = Category::select('category_id', 'name')->oldest()->get();
        return $category;
    }

    /**
    * Add category
    * @method Post
    * @param  Request  $request
    * @param  string  $category_id
    * @return Response
    */
    public function add_category(Request $request)
    {
        $request->validate([
                'name' => 'required|max:255|string|unique:categories,name',
            ]);
        try {
            $category = new Category;
            $category_id_autogen = str_random(12);
            $category->category_id = $category_id_autogen;
            $category->name = $request->input('name');
            if ($category->save()) {
                return response()->json([
                'message' => 'Category has been successfully added',
                'category' => $category
            ]);
            }
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                        'message' => 'Not found',
                ], 404);
        }
    }

    /**
    * Update category
    * @method Post
    * @param  Request  $request
    * @param  string  $category_id
    * @return Response
    */
    public function update_category(Request $request)
    {
        $request->validate([
                'category_id' => 'max:36',
                'name' => 'required|max:255|string',
            ]);
        try {
            $category = Category::findOrFail($request->category_id);
            $category->name = $request->input('name');
            if ($category->save()) {
                return response()->json([
                'message' => 'Category has been successfully updated',
                'category' => $category
            ]);
            }
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                        'message' => 'Not found',
                ], 404);
        }
    }

    /**
     * Delete category
     * @method Delete
     * @param  Request  $request
     * @param  string  $category_id
     */
    public function delete_category($category_id)
    {
        try {
            $category = Category::findorfail($category_id);
            $category->delete();
            return response()->json([
                            'message' => 'Category has been successfully deleted',
                            'category' => $category
                        ]);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                    'message' => 'Not found',
            ], 404);
        }
    }
}