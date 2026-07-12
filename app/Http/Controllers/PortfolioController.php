<?php
namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SocialLink;
use App\Models\SiteSetting;
use App\Models\HeroCard;

class PortfolioController extends Controller {
    public function index() {
        $projects   = Project::where('is_featured', true)->orderBy('sort_order')->get();
        $skills     = Skill::where('is_active', true)->orderBy('sort_order')->get()->groupBy('category');
        $socials    = SocialLink::where('is_active', true)->orderBy('sort_order')->get();
        $settings   = SiteSetting::all()->pluck('value', 'key');
        $heroCards  = HeroCard::where('is_active', true)->orderBy('sort_order')->get();
        return view('portfolio', compact('projects', 'skills', 'socials', 'settings', 'heroCards'));
    }
}
