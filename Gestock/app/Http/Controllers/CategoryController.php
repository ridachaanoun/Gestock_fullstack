<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function index()
    {
        if (! Gate::allows('viewAny', Category::class)) {
            abort(403);
        }
        return Category::paginate(15);
    }

    public function store(Request $request)
    {
        if (! Gate::allows('create', Category::class)) {
            abort(403);
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        return Category::create($validated);
    }

    public function show(Category $category)
    {
        if (! Gate::allows('view', $category)) {
            abort(403);
        }
        return $category;
    }

    public function update(Request $request, Category $category)
    {
        if (! Gate::allows('update', $category)) {
            abort(403);
        }
        
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);
        return $category;
    }       

    public function destroy(Category $category)
    {
        if (! Gate::allows('delete', $category)) {
            abort(403);
        }
        $category->delete();
        return response()->noContent();
    }
}