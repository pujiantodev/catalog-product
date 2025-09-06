<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class BrandController extends Controller
{
    public function index(Request $request): View
    {

        $brands = Brand::query()
            ->when(filled($request->search), function ($query) use ($request) {
                $query->where('name', 'ilike', '%' . $request->search . '%');
            })
            ->latest('updated_at')->simplePaginate(5);
        return view('brand.index', [
            'brands' => $brands
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'max:100']
        ], [
            'name.required' => 'Nama brand harus di isi.',
            'name.max' => 'maksimal karakter 100.'
        ]);
        $name = $request->name;
        $newbrand = Brand::create([
            'name' => $name,
            'slug' => Str::slug($name) . '-' . random_int(1, 9999)
        ]);
        return to_route('brands.index')->with('status', "Berhasil menambahkan brand baru: {$newbrand->name}");
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
        $brand = Brand::findOrFail($id);
        $brand->update([
            'name' => $name,
            'slug' => Str::slug($name) . '-' . random_int(1, 9999)
        ]);
        return to_route('brands.index')->with('status', "Berhasil mengubah brand: {$brand->name}");
    }

    public function destroy($id): RedirectResponse
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return to_route('brands.index')->with('status', "Berhasil menghapus brand: {$brand->name}");
    }
}
