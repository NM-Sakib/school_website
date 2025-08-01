<?php

namespace App\Http\Traits;

use App\Models\Common\CommonProduct;
use App\Models\Product;
use App\Models\ProductCategory;


trait ProductList
{
    public function productList($moduleName, $pageName, $sectionName)
    {
        $commonProductsQuery = CommonProduct::where([
            ['module_name', $moduleName],
            ['page_name', $pageName],
            ['section_name',  $sectionName],
        ])->orderBy('sort')->where('status', '1');

        $categoryIds = (clone $commonProductsQuery)->pluck('category_id');
        $productCategory = ProductCategory::whereIn('id', $categoryIds)->where('status', '1')->get()->sortBy(function ($category) use ($categoryIds) {
            return $categoryIds->search($category->id);
        })->values();
        $tabData = [];
        foreach ($productCategory as $index => $category) {
            $productIds = (clone $commonProductsQuery)->where('category_id', $category->id)->value('product_ids');
            $products = Product::where('status', '1')->whereIn('id', $productIds)->get([
                'id',
                'slug',
                'product_source',
                'title_bangla',
                'title_english',
                'sub_title_bangla',
                'sub_title_english',
                'button_one_english',
                'button_one_bangla',
                'button_one_url',
                'button_two_english',
                'button_two_bangla',
                'button_two_url',
                'file_url_web',
                'file_url_mobile',
                'product_type'
            ]);

            $tabData[$index] = [
                'tab' => $category,
                'products' => $products
            ];
        }

        return  $tabData;
    }
}
