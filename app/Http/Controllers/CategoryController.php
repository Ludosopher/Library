<?php

namespace App\Http\Controllers;

use App\BookCategory;
use App\Helpers\CategoryHelpers;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;


class CategoryController extends Controller
{
    public function getCategories()
    {
        $categories = BookCategory::paginate(4);

        return view("category.categories")->with('categories', $categories);
    }

    public function showCategory($slug)
    {
        $category = BookCategory::where('slug', $slug)->first();
        
        return view("category.category")->with('category', $category);
    }

    public function getForm($slug = null)
    {
        $category = CategoryHelpers::getForm($slug);
        
        return view("category.form")->with('category', $category);
    }

    public function updateCategory(UpdateCategoryRequest $request)
    {
        $category = CategoryHelpers::addOrUpdateCategory($request);
                
        return redirect()->route('categories')->with('response', "Данные категории '{$category->title}' успешно обновлены.");
    }

    public function addCategory(AddCategoryRequest $request)
    {
        $category = CategoryHelpers::addOrUpdateCategory($request->validated());
        
        request()->flash();
                
        return redirect()->back()->with('response', "Данные категории '{$category->title}' успешно добавлены.");
    }

    public function deleteCategory($slug)
    {
        $deleting_category = BookCategory::where('slug', $slug)->first();

        if (count($deleting_category->books)) {
            return redirect()->route('categories')->with('response', "Данные категории '{$deleting_category->title}' не могут быть удалены. Есть книги с этой категорией.");
        }

        BookCategory::where('slug', $slug)->delete();

        return redirect()->route('categories')->with('response', "Данные книги '{$deleting_category->title}' автора {$deleting_category->author} успешно удалены.");
    }
}
