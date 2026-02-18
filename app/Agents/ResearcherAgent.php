<?php

namespace App\Agents;

use App\Services\AgentService;

class ResearcherAgent
{
    public function __construct(protected AgentService $service) {}
    
    public function research(string $topic): array
    {
        $result = $this->service->execute(
            'محلل أخبار تقنية',
            "ابحث عن آخر الأخبار والتحديثات حول: {$topic}. اذكر 3 نقاط رئيسية فقط بشكل مختصر"
        );
        
        return [
            'topic' => $topic,
            'findings' => $result,
            'timestamp' => now()
        ];
    }
}
