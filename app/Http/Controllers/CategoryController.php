<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public function index(Request $request): View
    {

        $categories = Category::query()
            ->when(filled($request->search), function ($query) use ($request) {
                $query->where('name', 'ilike', '%' . $request->search . '%');
            })
            ->latest('updated_at')->simplePaginate(5);
        return view('category.index', [
            'categories' => $categories
        ]);
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'max:100']
        ], [
            'name.required' => 'Nama kategori harus di isi.',
            'name.max' => 'Maksimal karakter 100.'
        ]);
        $name = $request->name;
        $newCategory = Category::create([
            'name' => $name,
            'slug' => Str::slug($name) . '-' . random_int(1, 9999)
        ]);
        return to_route('categories.index')->with('status', "Berhasil menambahkan kategori baru: {$newCategory->name}");
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'max:100']
        ], [
            'name.required' => 'Nama brand harus di isi.',
            'name.max' => 'maksimal karakter 100.'
        ]);
        $name = $request->name;
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $name,
            'slug' => Str::slug($name) . '-' . random_int(1, 9999)
        ]);
        return to_route('categories.index')->with('status', "Berhasil mengubah kategori: {$category->name}");
    }

    public function destroy($id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return to_route('categories.index')->with('status', "Berhasil menghapus kategori: {$category->name}");
    }
}
