<?php

namespace App\Services;

use EchoLabs\Prism\Prism;

class AgentService
{
    protected string $model = 'deepseek-chat';
    
    public function execute(string $role, string $task, array $context = []): string
    {
        $prompt = $this->buildPrompt($role, $task, $context);
        
        $response = Prism::text()
            ->using('deepseek', $this->model)
            ->withPrompt($prompt)
            ->withMaxTokens(4000)
            ->generate();
            
        return $response->text;
    }
    
    protected function buildPrompt(string $role, string $task, array $context): string
    {
        $contextStr = !empty($context) ? "\n\nالسياق:\n" . json_encode($context, JSON_UNESCAPED_UNICODE) : '';
        return "أنت {$role}. مهمتك: {$task}{$contextStr}";
    }
}
