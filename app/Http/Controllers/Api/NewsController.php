<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Agents\TechNewsAgent;
use App\Models\Article;
use App\Services\{ImageService, TelegramService};

class NewsController extends Controller
{
    public function __construct(
        protected TechNewsAgent $agent,
        protected ImageService $imageService,
        protected TelegramService $telegram
    ) {}
    
    public function discover()
    {
        $publishedTopics = Article::latest()
            ->take(20)
            ->pluck('topic')
            ->toArray();
        
        $news = $this->agent->discoverLatestNews($publishedTopics);
        return response()->json($news);
    }
    
    public function createFromNews(string $newsTitle)
    {
        $summary = $this->agent->summarizeNews($newsTitle);
        $imageUrl = $this->imageService->getImageForTopic($newsTitle);
        
        $article = Article::create([
            'topic' => $newsTitle,
            'image_url' => $imageUrl,
            'research' => 'خبر تقني حديث',
            'content' => $summary,
            'seo_data' => ['type' => 'news'],
        ]);
        
        $this->telegram->sendArticle(
            $newsTitle,
            $summary,
            $imageUrl,
            $article->id
        );
        
        return response()->json($article, 201);
    }
}
