<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\SiteSetting;

class ProjectsPageController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        $settings = SiteSetting::all()->pluck('value', 'key');

        return view('projects', compact('projects', 'settings'));
    }
}
