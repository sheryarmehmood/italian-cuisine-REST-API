<?php
// app/Models/Dish.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image_url', 'price'];


    public function users()
    {
        return $this->belongsToMany(User::class, 'dish_user')->withPivot('rating');
    }

}
