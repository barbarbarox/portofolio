<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller {
    public function index() {
        $skills = Skill::orderBy('category')->orderBy('sort_order')->get()->groupBy('category');
        return view('admin.skills.index', compact('skills'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'category' => 'required|string|max:100',
            'category_emoji' => 'required|string|max:10',
            'name' => 'required|string|max:100',
            'level' => 'required|integer|min:0|max:100',
            'color' => 'required|in:blue,green,purple',
            'sort_order' => 'integer',
        ]);
        $data['is_active'] = true;
        Skill::create($data);
        return back()->with('success', 'Skill berhasil ditambahkan!');
    }

    public function update(Request $request, Skill $skill) {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'level' => 'required|integer|min:0|max:100',
            'color' => 'required|in:blue,green,purple',
            'sort_order' => 'integer',
        ]);
        $skill->update($data);
        return back()->with('success', 'Skill berhasil diupdate!');
    }

    public function destroy(Skill $skill) {
        $skill->delete();
        return back()->with('success', 'Skill berhasil dihapus!');
    }
}
