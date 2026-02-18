<?php

namespace App\Agents;

use App\Services\AgentService;

class ResearcherAgent
{
    public function __construct(protected AgentService $service) {}
    
    public function research(string $topic): array
    {
        $result = $this->service->execute(
            'باحث تقني متخصص',
            "ابحث عن الموضوع: {$topic}. قدم 5 نقاط رئيسية مع مصادر موثوقة"
        );
        
        return [
            'topic' => $topic,
            'findings' => $result,
            'timestamp' => now()
        ];
    }
}
