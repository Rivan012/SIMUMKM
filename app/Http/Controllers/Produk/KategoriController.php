<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoriTerbanyak = Kategori::withCount('produk')
            ->orderByDesc('produk_count')
            ->first();
        $kategori = Kategori::all();
        $totalKosong = Kategori::doesntHave('produk')->count();
        $totalKategori = Kategori::count();

        return view('kategori.index', [
            'kategori' => $kategori,
            'totalKosong' => $totalKosong,
            'kategoriTerbanyak' => $kategoriTerbanyak,
            'totalKategori' => $totalKategori
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:kategoris|max:255',
        ]);

        $slug = Str::slug($request->name);

        // 🔥 bikin unique slug
        $originalSlug = $slug;
        $count = 1;

        while (Kategori::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        Kategori::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // hanya generate ulang kalau name berubah
        if ($kategori->name !== $request->name) {
            $slug = Str::slug($request->name);

            $originalSlug = $slug;
            $count = 1;

            while (
                Kategori::where('slug', $slug)
                    ->where('id', '!=', $kategori->id)
                    ->exists()
            ) {
                $slug = $originalSlug . '-' . $count++;
            }
        } else {
            $slug = $kategori->slug;
        }

        $kategori->update([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return back()->with('success', 'Kategori berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->delete();

            return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus kategori!');
        }
    }
}
