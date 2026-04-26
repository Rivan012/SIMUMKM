<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategorilist = Kategori::all();
        $produk = Produk::all();
        $totalProduk = Produk::count();
        $produkSedikit = Produk::where('stock', '<=', 10)->count();
        // dd("".$produkSedikit);
        $produkAktif = $produk->where('is_active', true)->count();
        $produkNonAktif = $produk->where('is_active', false)->count();
        return view("produk.admin.index", [
            'kategorilist' => $kategorilist,
            'totalProduk' => $totalProduk,
            'produk' => $produk,
            'produkSedikit' => $produkSedikit,
            'produkAktif' => $produkAktif,
            'produkNonAktif' => $produkNonAktif
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
            'name' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|max:2048',
            'stock' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // 🔥 ambil extension
            $ext = $file->getClientOriginalExtension();

            // 🔥 bikin nama file dari nama produk
            $filename = Str::slug($request->name) . '-' . time() . '.' . $ext;

            // 🔥 simpan
            $imagePath = $file->storeAs('produk', $filename, 'public');
        }

        Produk::create([
            'name' => $request->name,
            'description' => $request->description,
            'kategori_id' => $request->kategori_id,
            'price' => $request->price,
            'image' => $imagePath,
            'stock' => $request->stock,
            'is_active' => $request->is_active,
        ]);

        return back()->with('success', 'Produk berhasil ditambahkan!');
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
    public function update(Request $request, string $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'stock' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($produk->image) {
                Storage::disk('public')->delete($produk->image);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = Str::slug($request->name) . '-' . time() . '.' . $ext;
            $data['image'] = $file->storeAs('produk', $filename, 'public');
        }

        $produk->update($data);

        return back()->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->image) {
            Storage::disk('public')->delete($produk->image);
        }

        $produk->delete();

        return back()->with('success', 'Produk berhasil dihapus!');
    }
}
