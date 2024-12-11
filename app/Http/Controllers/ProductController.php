<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;

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
        //
    }

    public function store(StoreProductRequest $request)
{
    $product = Product::create([
        'user_id' => Auth::id(),
        'price' => $request->price
    ]);
    $translations = $this->prepareTranslations($request->translations, ['name', 'description']);
    $product->fill($translations);
    $product->save();
    return $product->load('translations');
}

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
