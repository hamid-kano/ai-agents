<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AgentService
{
    public function execute(string $role, string $task, array $context = []): string
    {
        set_time_limit(300);
        
        $contextStr = !empty($context) ? "\n\nالسياق:\n" . json_encode($context, JSON_UNESCAPED_UNICODE) : '';
        $prompt = "أنت {$role}. مهمتك: {$task}{$contextStr}";
        
        $response = Http::timeout(120)
            ->withHeaders([
                'Authorization' => 'Bearer ' . env('DEEPSEEK_API_KEY'),
                'Content-Type' => 'application/json',
            ])
            ->post('https://api.deepseek.com/v1/chat/completions', [
                'model' => 'deepseek-chat',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt]
                ],
                'max_tokens' => 2000,
            ]);
            
        return $response->json('choices.0.message.content', '');
    }
}
