<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function listOption(Request $request)
    {
        $search = $request->query('q');
        $categories = Brand::query()
            ->when(filled($search), fn($query) => $query->where('name', 'ILIKE', "%{$search}%"))
            ->limit(10)
            ->get(['id', 'name']);
        return $categories;
    }
}
