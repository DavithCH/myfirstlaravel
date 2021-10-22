<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('categories.list',compact('categories'));
    }

    public function add() {
        return view('categories.add');
    }

    public function store(CategoryStoreRequest $request) {
        $params = $request->validated();
        Category::create($params);

        return back();
    }

    public function delete($id) {
        $category = Category::find($id);
        $category->delete();
        return back();
    }

    public function update(CategoryStoreRequest $request, $id) {
        $params = $request->validated();
        $category = Category::find($id);
        $category->update($params);

        return back();
    }
}
