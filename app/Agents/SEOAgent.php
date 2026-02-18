<?php

namespace App\Agents;

use App\Services\AgentService;

class SEOAgent
{
    public function __construct(protected AgentService $service) {}
    
    public function optimize(string $content, string $topic): array
    {
        $result = $this->service->execute(
            'خبير SEO للأخبار',
            "اقترح: 1) عنوان جذاب للخبر 2) وصف ميتا قصير 3) 3 كلمات مفتاحية",
            ['content' => $content, 'topic' => $topic]
        );
        
        return ['suggestions' => $result, 'analyzed_at' => now()];
    }
}
