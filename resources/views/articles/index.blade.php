@extends('layouts.app')

@section('nav-actions')
<div class="flex gap-3">
    <form method="GET" action="{{ route('articles.index') }}" class="relative">
        <input type="text" name="search" value="{{ request('search') }}" 
            placeholder="ابحث في المقالات..." 
            class="px-4 py-2 bg-slate-900/50 border border-purple-500/30 rounded-lg focus:outline-none focus:border-cyan-500 text-gray-200 w-64">
    </form>
    <a href="{{ route('articles.create') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-2 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all flex items-center gap-2">
        <span>خبر جديد</span>
    </a>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid gap-6">
        @forelse($articles as $article)
        <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl shadow-2xl border border-purple-500/20 overflow-hidden hover:border-cyan-500/40 transition-all">
            @if($article->image_url)
            <img src="{{ $article->image_url }}" alt="صورة الخبر" class="w-full h-48 object-cover">
            @endif
            <div class="p-6">
                <div class="prose prose-invert max-w-none mb-3 prose-strong:text-cyan-300 prose-strong:font-bold prose-p:text-gray-200 prose-p:mb-0">
                    <p class="text-xl font-bold text-cyan-300">{!! nl2br(e($article->topic)) !!}</p>
                </div>
                <div class="text-gray-300 mb-4 line-clamp-3">
                    <p>{{ Str::limit(strip_tags($article->content), 200) }}</p>
                </div>
                <a href="{{ route('articles.show', $article) }}" class="inline-flex items-center gap-2 text-cyan-400 hover:text-cyan-300 transition-colors font-medium">
                    <span>قراءة المزيد</span>
                    <span>←</span>
                </a>
            </div>
        </div>
        @empty
        <div class="text-center py-12">
            <p class="text-gray-400 mb-4">لا توجد مقالات</p>
            <a href="{{ route('articles.create') }}" class="text-cyan-400 hover:text-cyan-300">أنشئ أول خبر</a>
        </div>
        @endforelse
    </div>
</div>
@endsection
