<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SocialLink;

class DashboardController extends Controller {
    public function index() {
        $stats = [
            'messages'  => Contact::count(),
            'unread'    => Contact::where('is_read', false)->count(),
            'projects'  => Project::count(),
            'skills'    => Skill::count(),
            'socials'   => SocialLink::count(),
        ];
        $recentMessages = Contact::latest()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'recentMessages'));
    }
}
