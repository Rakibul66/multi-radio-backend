<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radio extends Model
{
    use HasFactory;

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function country()
    {
    	return $this->belongsTo(Country::class);
    }
}