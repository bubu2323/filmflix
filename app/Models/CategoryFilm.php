<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryFilm extends Model
{
    protected $fillable=['film_id','category_id'];
    use HasFactory;
    protected $table = 'category_film';
}  
