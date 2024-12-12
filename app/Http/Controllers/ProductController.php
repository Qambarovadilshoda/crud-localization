<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with('user')->paginate(10);
        return $this->responsePagination($products, ProductResource::collection($products->load('translations')));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create([
            'user_id' => Auth::id(),
            'price' => $request->price,
        ]);
        $translations = $this->prepareTranslations($request->translations, ['name', 'description']);
        $product->fill($translations);
        $product->save();
        return $this->success(new ProductResource($product->load('translations')), __('success.product.created'));
    }

    public function show(string $id)
    {
        $product = Product::with('user')->findOrFail($id);
        return $this->success(new ProductResource($product->load('translations')));
    }
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        if(Auth::id() !== $product->user_id){
            return $this->error(__('error.product.forbidden'), 403);
        }
        $product->price = $request->price;
        $translations = $this->prepareTranslations($request->translations, ['name', 'description']);
        $product->fill($translations);
        $product->save();
        return $this->success(new ProductResource($product->load('translations')), __('success.product.updated'));
    }
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        if(Auth::id() !== $product->user_id){
            return $this->error(__('error.product.forbidden'), 403);
        }
        $product->delete();
        return $this->success([],__('success.product.deleted'), 204);
    }
}
