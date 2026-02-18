<?php

namespace App\Agents;

use App\Services\AgentService;

class TechNewsAgent
{
    public function __construct(protected AgentService $service) {}
    
    public function discoverLatestNews(array $excludeTopics = []): array
    {
        $currentDate = now()->locale('ar')->isoFormat('D MMMM YYYY');
        $excludeText = empty($excludeTopics) ? '' : "\n\nتجنب هذه المواضيع المنشورة سابقاً:\n" . implode("\n", $excludeTopics);
        
        $result = $this->service->execute(
            'خبير أخبار تقنية',
            "اليوم هو {$currentDate}. اقترح 5 أخبار تقنية حديثة ومهمة من عام 2025-2026 (AI، برمجة، تطبيقات، أمن سيبراني). لكل خبر: عنوان قصير + وصف سطر واحد فقط{$excludeText}"
        );
        
        return [
            'news' => $result,
            'timestamp' => now()
        ];
    }
    
    public function summarizeNews(string $newsTitle): string
    {
        $currentDate = now()->locale('ar')->isoFormat('D MMMM YYYY');
        
        return $this->service->execute(
            'محرر أخبار',
            "اليوم هو {$currentDate}. اكتب خبر تقني مفصل عن: {$newsTitle}\n\nيجب أن يتضمن:\n- تاريخ حديث من 2025-2026\n- التفاصيل الدقيقة (أسماء، أرقام، تواريخ)\n- المصدر أو الشركة المعنية\n- 3-4 فقرات\n- معلومات واقعية ومحددة\n- استخدم إيموجي بسيط ومناسب في بداية كل فقرة (📱💡🚀⚡🔧💻🌐)"
        );
    }
}
