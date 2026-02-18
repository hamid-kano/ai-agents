<?php

namespace App\Agents;

use App\Services\AgentService;

class EditorAgent
{
    public function __construct(protected AgentService $service) {}
    
    public function edit(string $content): string
    {
        return $this->service->execute(
            'محرر تقني',
            'راجع المقال وحسّن الصياغة والأسلوب والدقة اللغوية. حافظ على المحتوى التقني',
            ['content' => $content]
        );
    }
}
