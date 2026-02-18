<?php

namespace App\Agents;

use App\Services\AgentService;

class TechNewsAgent
{
    public function __construct(protected AgentService $service) {}
    
    public function discoverLatestNews(): array
    {
        $result = $this->service->execute(
            'خبير أخبار تقنية',
            'اقترح 5 أخبار تقنية حديثة ومهمة (AI، برمجة، تطبيقات، أمن سيبراني). لكل خبر: عنوان قصير + وصف سطر واحد فقط'
        );
        
        return [
            'news' => $result,
            'timestamp' => now()
        ];
    }
    
    public function summarizeNews(string $newsTitle): string
    {
        return $this->service->execute(
            'محرر أخبار',
            "اكتب وصف قصير (2-3 جمل) عن: {$newsTitle}"
        );
    }
}
