<?php

namespace App\Services;

class ImageService
{
    public function getImageForTopic(string $topic): string
    {
        $seed = md5($topic);
        return "https://picsum.photos/seed/{$seed}/1200/630";
    }
}
