<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['topic', 'research', 'content', 'seo_data', 'status'];
    protected $casts = ['seo_data' => 'array'];
}
