@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl shadow-2xl border border-purple-500/20 overflow-hidden">
        @if($article->image_url)
        <img src="{{ $article->image_url }}" alt="صورة الخبر" class="w-full h-64 object-cover">
        @endif
        
        <div class="p-8">
            <div class="prose prose-invert max-w-none mb-6 prose-h1:text-4xl prose-h1:font-bold prose-h1:bg-gradient-to-r prose-h1:from-cyan-300 prose-h1:via-purple-300 prose-h1:to-pink-300 prose-h1:bg-clip-text prose-h1:text-transparent prose-strong:text-cyan-300 prose-strong:font-bold prose-p:text-gray-200 prose-p:mb-0">
                <h1 class="text-4xl font-bold bg-gradient-to-r from-cyan-300 via-purple-300 to-pink-300 bg-clip-text text-transparent">{!! nl2br(e($article->topic)) !!}</h1>
            </div>

            @if($article->seo_data)
            <div class="bg-gradient-to-r from-purple-900/50 to-cyan-900/50 border border-cyan-500/30 rounded-xl p-6 mb-8">
                <h3 class="font-bold mb-3 text-cyan-300 text-lg flex items-center gap-2">
                    <span>معلومات SEO:</span>
                </h3>
                <div class="text-sm text-gray-300 prose prose-invert prose-sm max-w-none">
                    <p>{!! nl2br(e($article->seo_data['suggestions'] ?? '')) !!}</p>
                </div>
            </div>
            @endif

            <div class="prose prose-xl prose-invert max-w-none [&>p]:mb-8 [&>p]:leading-relaxed prose-headings:font-bold prose-headings:mb-6 prose-headings:mt-10 prose-h2:text-4xl prose-h2:leading-snug prose-h2:bg-gradient-to-r prose-h2:from-cyan-300 prose-h2:to-purple-300 prose-h2:bg-clip-text prose-h2:text-transparent prose-h3:text-3xl prose-h3:leading-snug prose-h3:text-cyan-300 [&>p]:text-gray-200 [&>p]:text-lg prose-strong:text-cyan-300 prose-strong:font-bold prose-ul:text-gray-200 prose-ul:text-lg prose-ul:leading-relaxed prose-ul:space-y-3 prose-ul:my-6 prose-li:my-2 prose-a:text-cyan-400 prose-a:no-underline hover:prose-a:text-cyan-300">
                {!! nl2br(e($article->content)) !!}
            </div>

            <div class="mt-8 pt-6 border-t border-purple-500/20">
                <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 text-cyan-400 hover:text-cyan-300 transition-colors">
                    <span>→</span>
                    <span>العودة للمقالات</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
