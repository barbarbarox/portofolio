<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\HeroCard;
use Illuminate\Http\Request;

class HeroCardController extends Controller {
    public function index() {
        $cards = HeroCard::orderBy('sort_order')->get();
        return view('admin.hero-cards.index', compact('cards'));
    }
    public function store(Request $request) {
        $validated = $request->validate([
            'title'       => 'required|string|max:100',
            'subtitle'    => 'nullable|string|max:200',
            'accent_color'=> 'required|string|max:20',
            'bg_color'    => 'nullable|string|max:20',
            'sort_order'  => 'nullable|integer',
        ]);
        $validated['is_active'] = $request->has('is_active');
        HeroCard::create($validated);
        return back()->with('success', 'Card berhasil ditambahkan!');
    }
    public function update(Request $request, HeroCard $heroCard) {
        $validated = $request->validate([
            'title'       => 'required|string|max:100',
            'subtitle'    => 'nullable|string|max:200',
            'accent_color'=> 'required|string|max:20',
            'bg_color'    => 'nullable|string|max:20',
            'sort_order'  => 'nullable|integer',
        ]);
        $validated['is_active'] = $request->has('is_active');
        $heroCard->update($validated);
        return back()->with('success', 'Card berhasil diupdate!');
    }
    public function destroy(HeroCard $heroCard) {
        $heroCard->delete();
        return back()->with('success', 'Card berhasil dihapus!');
    }
}
