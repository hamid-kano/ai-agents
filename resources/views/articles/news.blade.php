@extends('layouts.app')

@section('nav-actions')
<a href="{{ route('articles.index') }}" class="text-cyan-400 hover:text-cyan-300 flex items-center gap-2">
    <span>→</span>
    <span>الرئيسية</span>
</a>
@endsection

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-6 bg-gradient-to-r from-cyan-300 to-purple-300 bg-clip-text text-transparent">اكتشف أحدث الأخبار التقنية</h2>
    
    <button id="discoverBtn" onclick="discoverNews()" 
        class="w-full px-8 py-4 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-lg hover:from-green-700 hover:to-emerald-700 transition-all font-bold text-lg shadow-sm flex items-center justify-center gap-2">
        <span id="btnText">اكتشف أحدث الأخبار التقنية</span>
    </button>

    <div id="newsContainer" class="mt-8 space-y-4"></div>
</div>

<script>
async function discoverNews() {
    const btn = document.getElementById('discoverBtn');
    const btnText = document.getElementById('btnText');
    btn.disabled = true;
    btnText.textContent = 'جاري البحث...';
    
    try {
        const res = await fetch('{{ route('api.news.discover') }}');
        const data = await res.json();
        const newsItems = data.news.split('\n').filter(n => n.trim());
        displayNews(newsItems);
    } catch (error) {
        alert('حدث خطأ');
    }
    
    btn.disabled = false;
    btnText.textContent = 'اكتشف أحدث الأخبار التقنية';
}

function displayNews(newsItems) {
    const container = document.getElementById('newsContainer');
    container.innerHTML = newsItems.map((item, i) => `
        <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl shadow-2xl border border-purple-500/20 p-4 hover:border-cyan-500/40 transition-all">
            <div class="text-gray-300 mb-3">
                <p class="text-gray-200">${item}</p>
            </div>
            <button onclick="createArticle('${item.replace(/'/g, "\\'")}', ${i})" 
                id="createBtn${i}"
                class="text-sm bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded hover:from-blue-700 hover:to-purple-700 transition-all flex items-center gap-2">
                <span id="createText${i}">صياغة الخبر</span>
            </button>
        </div>
    `).join('');
}

async function createArticle(newsTitle, index) {
    const btn = document.getElementById('createBtn' + index);
    const btnText = document.getElementById('createText' + index);
    btn.disabled = true;
    btnText.textContent = 'جاري الصياغة...';
    
    try {
        const res = await fetch(`{{ url('api/news') }}/${encodeURIComponent(newsTitle)}`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        });
        const article = await res.json();
        window.location.href = `{{ url('articles') }}/${article.id}`;
    } catch (error) {
        alert('حدث خطأ');
        btn.disabled = false;
        btnText.textContent = 'صياغة الخبر';
    }
}
</script>
@endsection
