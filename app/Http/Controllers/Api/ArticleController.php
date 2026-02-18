<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\BlogOrchestrator;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct(protected BlogOrchestrator $orchestrator) {}
    
    public function index()
    {
        return Article::latest()->paginate(10);
    }
    
    public function store(Request $request)
    {
        $request->validate(['topic' => 'required|string|max:255']);
        
        $result = $this->orchestrator->createArticle($request->topic);
        
        $article = Article::create([
            'topic' => $result['topic'],
            'research' => $result['research']['findings'],
            'content' => $result['content'],
            'seo_data' => $result['seo'],
        ]);
        
        return response()->json($article, 201);
    }
    
    public function show(Article $article)
    {
        return $article;
    }
}
