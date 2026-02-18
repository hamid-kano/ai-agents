<?php

namespace App\Agents;

use App\Services\AgentService;

class WriterAgent
{
    public function __construct(protected AgentService $service) {}
    
    public function write(string $topic, array $research): string
    {
        return $this->service->execute(
            'كاتب تقني محترف',
            "اكتب مقال تقني عن: {$topic}. استخدم البحث المرفق لكتابة مقال شامل (800-1200 كلمة) بأسلوب احترافي",
            ['research' => $research]
        );
    }
}
