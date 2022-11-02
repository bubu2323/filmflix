<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Film extends Model
{
    protected $fillable = ['title', 'year', 'plot', 'director', 'rating','image','created_at'];
    use HasFactory;
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
    
}
