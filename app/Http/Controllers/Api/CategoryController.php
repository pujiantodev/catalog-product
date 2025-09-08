<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function listOption(Request $request)
    {
        $search = $request->query('q');
        $categories = Category::query()
            ->when(filled($search), fn($query) => $query->where('name', 'ILIKE', "%{$search}%"))
            ->limit(5)
            ->get(['id', 'name']);
        return $categories;
    }
}
