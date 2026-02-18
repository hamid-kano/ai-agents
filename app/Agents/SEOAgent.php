<?php

namespace App\Agents;

use App\Services\AgentService;

class SEOAgent
{
    public function __construct(protected AgentService $service) {}
    
    public function optimize(string $content, string $topic): array
    {
        $result = $this->service->execute(
            'خبير SEO',
            "حلل المقال واقترح: 1) عنوان SEO 2) وصف ميتا 3) كلمات مفتاحية",
            ['content' => $content, 'topic' => $topic]
        );
        
        return ['suggestions' => $result, 'analyzed_at' => now()];
    }
}
