<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sistem\WebConfig;

class SettingController extends Controller
{
    public function index()
    {
        // $dataweb =
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'judul' => 'required',
            'description' => 'nullable',
            'phone' => 'nullable',
            'address' => 'nullable',
            'logo' => 'nullable|image',
            'hero_image' => 'nullable|image',
            'social_media' => 'nullable',
        ]);

        // handle file
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logo', 'public');
        }

        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('hero', 'public');
        }

        WebConfig::updateOrCreate(['id' => 1], $data);
        cache()->forget('web_config');
        return back()->with('success', 'Berhasil disimpan');

    }
}
