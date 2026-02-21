<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\BlogOrchestrator;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct(protected BlogOrchestrator $orchestrator) {}
    
    public function index(Request $request)
    {
        $query = Article::latest();
        
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('topic', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
        
        $articles = $query->get();
        return view('articles.index', compact('articles'));
    }
    
    public function create()
    {
        return view('articles.create');
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
        
        return redirect()->route('articles.show', $article);
    }
    
    public function news()
    {
        return view('articles.news');
    }
    
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }
}
