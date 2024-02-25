<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $models = Category::orderBy('id', 'desc')->get();
        return view('index', ['models' => $models]);
    }
    
    public function store(CategoryStoreRequest $categoryStoreRequest)
    {
        Category::create($categoryStoreRequest->all());
        return back();
    }
    
    public function project()
    {
        return view('project1');
    }
}
