<?php

namespace App\Services;

use EchoLabs\Prism\Prism;

class AgentService
{
    public function execute(string $role, string $task, array $context = []): string
    {
        $contextStr = !empty($context) ? "\n\nالسياق:\n" . json_encode($context, JSON_UNESCAPED_UNICODE) : '';
        $prompt = "أنت {$role}. مهمتك: {$task}{$contextStr}";
        
        $response = Prism::text()
            ->using('deepseek', 'deepseek-chat')
            ->withPrompt($prompt)
            ->withMaxTokens(4000)
            ->generate();
            
        return $response->text;
    }
}
