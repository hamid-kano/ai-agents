<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['topic', 'image_url', 'research', 'content', 'seo_data', 'status'];
    protected $casts = ['seo_data' => 'array'];
}
