<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductResource::collection(Product::paginate());
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
