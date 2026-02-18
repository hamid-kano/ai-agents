<?php

namespace App\Agents;

use App\Services\AgentService;

class WriterAgent
{
    public function __construct(protected AgentService $service) {}
    
    public function write(string $topic, array $research): string
    {
        return $this->service->execute(
            'كاتب أخبار تقنية',
            "اكتب خبر تقني مختصر عن: {$topic}. يجب أن يكون الخبر قصير (150-250 كلمة فقط)، يركز على آخر التحديثات والأخبار الحديثة، بأسلوب صحفي سريع ومباشر",
            ['research' => $research]
        );
    }
}
