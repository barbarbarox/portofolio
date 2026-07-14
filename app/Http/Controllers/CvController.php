<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use App\Models\SocialLink;
use App\Models\SiteSetting;

class CvController extends Controller
{
    public function show()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        $skills   = Skill::where('is_active', true)->orderBy('sort_order')->get()->groupBy('category');
        $projects = Project::where('is_featured', true)->orderBy('sort_order')->get();
        $socials  = SocialLink::where('is_active', true)->orderBy('sort_order')->get();

        return view('cv', compact('settings', 'skills', 'projects', 'socials'));
    }
}
