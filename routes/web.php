<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\HeroCardController;

// Public portfolio
Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/projects', [App\Http\Controllers\ProjectsPageController::class, 'index'])->name('projects.public');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/cv', [CvController::class, 'show'])->name('cv');

// Admin auth
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Google OAuth
    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
    // Protected admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Projects
        Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
        Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

        // Skills
        Route::get('/skills', [SkillController::class, 'index'])->name('skills.index');
        Route::post('/skills', [SkillController::class, 'store'])->name('skills.store');
        Route::put('/skills/{skill}', [SkillController::class, 'update'])->name('skills.update');
        Route::delete('/skills/{skill}', [SkillController::class, 'destroy'])->name('skills.destroy');

        // Social Links
        Route::get('/social-links', [SocialLinkController::class, 'index'])->name('social-links.index');
        Route::post('/social-links', [SocialLinkController::class, 'store'])->name('social-links.store');
        Route::put('/social-links/{socialLink}', [SocialLinkController::class, 'update'])->name('social-links.update');
        Route::delete('/social-links/{socialLink}', [SocialLinkController::class, 'destroy'])->name('social-links.destroy');

        // Settings
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

        // Messages
        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{contact}', [MessageController::class, 'show'])->name('messages.show');
        Route::delete('/messages/{contact}', [MessageController::class, 'destroy'])->name('messages.destroy');

        // Hero Cards
        Route::get('/hero-cards', [HeroCardController::class, 'index'])->name('hero-cards.index');
        Route::post('/hero-cards', [HeroCardController::class, 'store'])->name('hero-cards.store');
        Route::put('/hero-cards/{heroCard}', [HeroCardController::class, 'update'])->name('hero-cards.update');
        Route::delete('/hero-cards/{heroCard}', [HeroCardController::class, 'destroy'])->name('hero-cards.destroy');
    });
});
