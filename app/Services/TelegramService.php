<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramService
{
    protected string $botToken;
    protected string $channelId;

    public function __construct()
    {
        $this->botToken = '7741717552:AAH4BEXtsPOE8btOgsI7i0FRIfwTElj796c';
        $this->channelId = '-1003618595757';
    }

    public function sendArticle(string $title, string $content, string $imageUrl, int $articleId): bool
    {
        try {
            $cleanTitle = html_entity_decode(strip_tags($title), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $cleanContent = html_entity_decode(strip_tags($content), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            
            $cleanContent = preg_replace('/\. /', ".\n\n", $cleanContent);
            
            if (mb_strlen($cleanContent) > 200) {
                $cleanContent = mb_substr($cleanContent, 0, 200) . '...';
            }
            
            $readMoreUrl = "https://lightslategrey-gorilla-734246.hostingersite.com/article/{$articleId}";
            $message = "📰 {$cleanTitle}\n\n{$cleanContent}\n\n🔗 اقرأ المزيد: {$readMoreUrl}";
            
            $response = Http::timeout(30)->post("https://api.telegram.org/bot{$this->botToken}/sendPhoto", [
                'chat_id' => $this->channelId,
                'photo' => $imageUrl,
                'caption' => $message
            ]);
            
            \Log::info('Telegram Response:', $response->json());
            
            return $response->successful();
        } catch (\Exception $e) {
            \Log::error('Telegram Error: ' . $e->getMessage());
            return false;
        }
    
}
