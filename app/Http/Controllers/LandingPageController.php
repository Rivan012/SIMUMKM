<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $produk = Produk::with('kategori')->where('is_active', true)->paginate(6);
        return view(
            "landing",
            [
                'daftar_produk' => $produk
            ]
        );
    }
}
