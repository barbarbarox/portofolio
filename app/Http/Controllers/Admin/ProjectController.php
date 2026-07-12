<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller {
    public function index() {
        $projects = Project::orderBy('sort_order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create() { return view('admin.projects.form', ['project' => new Project()]); }

    public function store(Request $request) {
        $data = $request->validate([
            'emoji' => 'required|string|max:10',
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'tech_stack' => 'nullable|string|max:500',
            'tags' => 'nullable|string',
            'accent_color' => 'required|string|max:20',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
        ]);
        $data['tags'] = $request->tags ? array_map('trim', explode(',', $request->tags)) : [];
        $data['is_featured'] = $request->boolean('is_featured');
        Project::create($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil ditambahkan!');
    }

    public function edit(Project $project) { return view('admin.projects.form', compact('project')); }

    public function update(Request $request, Project $project) {
        $data = $request->validate([
            'emoji' => 'required|string|max:10',
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'tech_stack' => 'nullable|string|max:500',
            'tags' => 'nullable|string',
            'accent_color' => 'required|string|max:20',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
        ]);
        $data['tags'] = $request->tags ? array_map('trim', explode(',', $request->tags)) : [];
        $data['is_featured'] = $request->boolean('is_featured');
        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil diupdate!');
    }

    public function destroy(Project $project) {
        $project->delete();
        return back()->with('success', 'Project berhasil dihapus!');
    }
}
