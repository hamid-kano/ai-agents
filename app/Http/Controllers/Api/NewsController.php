<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Agents\TechNewsAgent;
use App\Models\Article;

class NewsController extends Controller
{
    public function __construct(protected TechNewsAgent $agent) {}
    
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
        
        $article = Article::create([
            'topic' => $newsTitle,
            'research' => 'خبر تقني حديث',
            'content' => $summary,
            'seo_data' => ['type' => 'news'],
        ]);
        
        return response()->json($article, 201);
    }
}
