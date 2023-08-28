<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = 10;

        if($request->has('per_page')){
            $perPage = $request->per_page;
        }

        if($request->has('category')){
            return ProductResource::collection(Product::where('category_id',$request->category)->paginate($perPage));    
        }        

        return ProductResource::collection(Product::paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $requestValidated = $request->validated();
        $path = $requestValidated['image']->store('products','public');
         
        $product = Product::create([
            'name'=>$requestValidated['name'],
            'price'=>$requestValidated['price'],
            'category_id'=>$requestValidated['category_id'],
            'description'=>$requestValidated['description'],
            'image'=>$path
        ]);

        return response()->json(new ProductResource($product),201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json(new ProductResource($product));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $requestValidated = $request->validated();
        $path = $requestValidated['image']->store('products','public');
         
        $product->name = $requestValidated['name'];
        $product->price = $requestValidated['price'];
        $product->category_id = $requestValidated['category_id'];
        $product->description = $requestValidated['description'];
        $product->image = $path;
        
        $product->save();

        return response()->json(new ProductResource($product));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }
}
