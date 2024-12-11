<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected function prepareTranslations(array $translations, array $columns): array
    {
        $preparedTranslations = [];

        foreach ($translations as $translation) {
            foreach ($translation as $lang => $value) {
                if (!isset($preparedTranslations[$lang])) {
                    $preparedTranslations[$lang] = [];
                }

                foreach ($columns as $column) {
                    if (isset($value[$column])) {
                        $preparedTranslations[$lang][$column] = $value[$column];
                    } else {
                        info("{$column} not set for language: $lang");
                    }
                }
            }
        }

        return $preparedTranslations;
    }
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
        return $this->success(new ProductResource($product->load('translations')), __('success.created'));
    }

    public function show(string $id)
    {
        $product = Product::with('user')->find($id);
        if (!$product) {
            return $this->error(__('error.no'), 404);
        }
        return $this->success(new ProductResource($product->load('translations')));
    }
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->error(__('error.no'), 404);
        }
        $product->price = $request->price;
        $translations = $this->prepareTranslations($request->translations, ['name', 'description']);
        $product->fill($translations);
        $product->save();
        return $this->success(new ProductResource($product->load('translations')), __('success.updated'));
    }
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->error(__('error.no'), 404);
        }
        $product->deleteTranslations();
        $product->delete();
        return $this->success([],__('success.deleted'), 204);
    }
}
