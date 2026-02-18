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
            $cleanContent = strip_tags($content);
            
            $message = "📰 *{$title}*\n\n{$cleanContent}\n\n🔗 [اقرأ المزيد](http://localhost:3000/article/{$articleId})";
            
            Http::post("https://api.telegram.org/bot{$this->botToken}/sendPhoto", [
                'chat_id' => $this->channelId,
                'photo' => $imageUrl,
                'caption' => $message,
                'parse_mode' => 'Markdown'
            ]);
            
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
