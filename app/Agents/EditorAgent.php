<?php

namespace App\Agents;

use App\Services\AgentService;

class EditorAgent
{
    public function __construct(protected AgentService $service) {}
    
    public function edit(string $content): string
    {
        return $this->service->execute(
            'محرر أخبار',
            'راجع الخبر وتأكد من الدقة والوضوح. احتفظ بالأسلوب المختصر والمباشر',
            ['content' => $content]
        );
    }
}
