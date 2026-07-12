<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class HeroCard extends Model {
    protected $fillable = ['title','subtitle','accent_color','bg_color','sort_order','is_active'];
    protected $casts = ['is_active'=>'boolean'];
}
