<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable =['category_name','description'];
    use HasFactory;

    public function films()
    {
        // return $this->belongsToMany('App\Models\Film','category_film','film_id');
        return $this->belongsToMany(Film::class)->withPivot('category_film');
       
    }
}
