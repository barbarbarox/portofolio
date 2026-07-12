<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    use HasFactory;
    protected $fillable = ['emoji','title','description','tech_stack','tags','accent_color','github_url','live_url','is_featured','sort_order'];
    protected $casts = ['tags' => 'array', 'is_featured' => 'boolean'];
}
