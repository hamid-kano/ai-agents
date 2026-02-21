@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-8">
    <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl shadow-2xl border border-purple-500/20 p-8">
        <h2 class="text-3xl font-bold mb-6 bg-gradient-to-r from-cyan-300 to-purple-300 bg-clip-text text-transparent">خبر تقني جديد</h2>

        <form action="{{ route('articles.store') }}" method="POST" id="articleForm">
            @csrf
            <div class="mb-6">
                <label class="block text-cyan-300 font-bold mb-2">موضوع الخبر التقني</label>
                <input type="text" name="topic" required
                    class="w-full px-4 py-3 bg-slate-900/50 border border-purple-500/30 rounded-lg focus:outline-none focus:border-cyan-500 text-gray-200"
                    placeholder="مثال: تحديثات ChatGPT الجديدة، إطلاق iPhone 16، تقنية الكم">
            </div>

            <div class="bg-gradient-to-r from-purple-900/50 to-cyan-900/50 border border-cyan-500/30 rounded-xl p-4 mb-6">
                <p class="text-sm text-cyan-300 font-semibold mb-2">ملاحظة: سيقوم الوكلاء الأذكياء بـ:</p>
                <ul class="text-sm text-gray-300 mr-4 list-disc space-y-1">
                    <li>البحث عن آخر الأخبار والتحديثات</li>
                    <li>كتابة خبر مختصر ومباشر</li>
                    <li>مراجعة الدقة والوضوح</li>
                    <li>تحسين SEO للخبر</li>
                </ul>
            </div>

            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg hover:from-blue-700 hover:to-purple-700 font-bold transition-all flex items-center justify-center gap-2">
                <span id="btnText">إنشاء خبر تقني بالذكاء الاصطناعي</span>
            </button>
        </form>
    </div>
</div>

<script>
document.getElementById('articleForm').addEventListener('submit', function(e) {
    const btn = this.querySelector('button[type="submit"]');
    btn.disabled = true;
    btn.classList.add('opacity-50', 'cursor-not-allowed');
    document.getElementById('btnText').textContent = 'جاري كتابة الخبر...';
});
</script>
@endsection
