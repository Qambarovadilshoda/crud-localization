<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function success($data = [], string $message = null, int $status = 200)
    {
        $message = $message ?: __('success.operation');
        return response()->json([
            'status' => __('success.status'),
            'message' => $message,
            'data' => $data,
        ], $status);
    }
    protected function responsePagination($paginator, $data = [], string $message = null, int $status = 200)
    {
        if ($paginator instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            $pagination = [
                'current_page' => $paginator->currentPage(),
                'total_pages' => $paginator->lastPage(),
                'total' => $paginator->total(),
                'per_page' => $paginator->perPage(),
                'links' => [
                    'first' => $paginator->url(1),
                    'last' => $paginator->url($paginator->lastPage()),
                    'prev' => $paginator->previousPageUrl(),
                    'next' => $paginator->nextPageUrl(),
                ],
            ];
        } else {
            $pagination = null;
        }
        $message = $message ?: __('success.operation');
        return response()->json([
            'status' => __('success.status'),
            'message' => $message,
            'data' => $data,
            'pagination' => $pagination,
        ], $status);
    }
    protected function error(string $message = null, int $status = 400)
    {
        $message = $message ?: __('error.operation');

        return response()->json([
            'status' => __('error.status'),
            'message' => $message,
        ], $status);
    }

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
}
