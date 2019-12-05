<?php

namespace App\Http\Controllers\v1;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\v1\Product;
use App\Model\v1\Category;

class ProductController extends Controller
{
    /**
       * Show all products
       * @method Get
       * @param  Request  $request
       * @param  string  $product_id
       * @return Response
       */
    public function products($no = 5)
    {
        $category = Product::latest()
        ->leftJoin('categories', 'products.category_id', '=', 'categories.category_id')
        ->select(
            'products.product_id',
            'products.category_id',
            'categories.name as category_name',
            'products.name',
            'products.slug',
            'products.available_stock',
            'products.current_stock',
            'products.description',
            'products.featured_image',
            'products.gallery',
            'products.created_at',
            'products.updated_at',
        )
        ->paginate($no);
        //->get();
        
        return $category;
        // return response()->json(\DB::table('products')
        // ->leftJoin('categories', 'products.category_id', '=', 'categories.category_id')
        // ->select(
        //     'products.product_id',
        //     'products.category_id',
        //     'categories.name as category_name',
        //     'products.name',
        //     'products.slug',
        //     'products.available_stock',
        //     'products.current_stock',
        //     'products.description',
        //     'products.featured_image',
        //     'products.gallery',
        //     'products.created_at',
        //     'products.updated_at',
        // )
        // ->get());
        //return $products->category;
        //$products = Product::find('kfg391b0BDRt')->categories;
        //return $products;
    }

    /**
     * Show single product
     * @method Get
     * @param  Request  $request
     * @param  string  $product_id
     * @return Response
     */
    public function product($product_id)
    {
        $product = Product::where('product_id', $product_id)->first();
        if ($product) {
            return $product;
        } else {
            return response()->json([
                'message' => 'Product not found',
            ]);
        }
    }

    /**
     * Add product
     * @method Post
     * @param  Request  $request
     * @param  string  $product_id
     * @return Response
     */
    public function add_product(Request $request)
    {
        try {
            $product = Category::findOrFail($request->category_id);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                        'message' => 'Category not found',
                ], 404);
        }
        $request->validate([
            'category_id' => 'required|max:36',
            'name' => 'required|max:255',
            'slug' => 'url|max:255',
            'available_stock' => 'max:255',
            'current_stock' => 'max:255',
            'description' => 'max:255'
            ]);
        try {
            $product = new Product;
            $product_id_autogen = str_random(12);
            $product->product_id = $product_id_autogen;
            $product->category_id = $request->input('category_id');
            $product->name = $request->input('name');
            $product->slug = url("/api/v1/product/{$product_id_autogen}");
            $product->available_stock = $request->input('available_stock');
            $product->current_stock = $request->input('current_stock');
            $product->description = $request->input('description');
            if ($product->save()) {
                return response()->json([
                'message' => 'Product has been successfully added',
                'product' => $product
            ]);
            }
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                        'message' => 'Not found',
                ], 404);
        }
    }
    /**
    * Update product
    * @method Post
    * @param  Request  $request
    * @param  string  $product_id
    * @return Response
    */
    public function update_product(Request $request)
    {
        $request->validate([
                'category_id' => 'required|max:36',
                'name' => 'required|max:255',
                'slug' => 'url|max:255',
                'available_stock' => 'max:255',
                'current_stock' => 'max:255',
                'description' => 'max:255'
            ]);
        try {
            $product = Product::findOrFail($request->product_id);
            //$product_id_autogen = str_random(12);
            //$product->product_id = $product_id_autogen;
            $product->category_id = $request->input('category_id');
            $product->name = $request->input('name');
            $product->slug = url("/api/v1/product/{$request->product_id}");
            $product->available_stock = $request->input('available_stock');
            $product->current_stock = $request->input('current_stock');
            $product->description = $request->input('description');
            if ($product->save()) {
                return response()->json([
                'message' => 'Product has been successfully updated',
                'product' => $product
            ]);
            }
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                        'message' => 'Not found',
                ], 404);
        }
    }

    /**
     * Delete product
     * @method Delete
     * @param  Request  $request
     * @param  string  $product_id
     */
    public function delete_product($product_id)
    {
        try {
            $product = Product::findorfail($product_id);
            $product->delete();
            return response()->json([
                            'message' => 'Product has been successfully deleted',
                            'product' => $product
                        ]);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                    'message' => 'Not found',
            ], 404);
        }
    }
}
