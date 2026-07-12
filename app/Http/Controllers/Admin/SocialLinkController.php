<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller {
    public function index() {
        $links = SocialLink::orderBy('sort_order')->get();
        return view('admin.social-links.index', compact('links'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'platform' => 'required|string|max:50',
            'emoji' => 'required|string|max:10',
            'label' => 'required|string|max:100',
            'url' => 'required|string|max:500',
            'accent_color' => 'required|string|max:20',
            'sort_order' => 'integer',
        ]);
        $data['is_active'] = true;
        SocialLink::create($data);
        return back()->with('success', 'Link berhasil ditambahkan!');
    }

    public function update(Request $request, SocialLink $socialLink) {
        $data = $request->validate([
            'platform' => 'required|string|max:50',
            'emoji' => 'required|string|max:10',
            'label' => 'required|string|max:100',
            'url' => 'required|string|max:500',
            'accent_color' => 'required|string|max:20',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $socialLink->update($data);
        return back()->with('success', 'Link berhasil diupdate!');
    }

    public function destroy(SocialLink $socialLink) {
        $socialLink->delete();
        return back()->with('success', 'Link berhasil dihapus!');
    }
}
