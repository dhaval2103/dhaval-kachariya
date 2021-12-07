<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    public function getImageAttribute($value)
    {
        return $value ? asset('images' . '/' . $value) : NULL;
    }
}
