<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Agents\TechNewsAgent;
use App\Models\Article;
use App\Services\{ImageService, TelegramService};

class AutoPublishNews extends Command
{
    protected $signature = 'news:auto-publish';
    protected $description = 'Auto-publish tech news to Telegram';

    public function handle(
        TechNewsAgent $agent,
        ImageService $imageService,
        TelegramService $telegram
    )
    {
        $this->info('🔍 Discovering latest news...');
        
        $publishedTopics = Article::latest()->take(20)->pluck('topic')->toArray();
        $newsData = $agent->discoverLatestNews($publishedTopics);
        
        $newsItems = array_filter(explode("\n", $newsData['news']), fn($n) => trim($n));
        
        if (empty($newsItems)) {
            $this->error('❌ No news found');
            return 1;
        }
        
        $randomNews = $newsItems[array_rand($newsItems)];
        $this->info("✅ Selected: {$randomNews}");
        
        $this->info('✍️ Writing article...');
        $summary = $agent->summarizeNews($randomNews);
        $imageUrl = $imageService->getImageForTopic($randomNews);
        
        $article = Article::create([
            'topic' => $randomNews,
            'image_url' => $imageUrl,
            'research' => 'خبر تقني تلقائي',
            'content' => $summary,
            'seo_data' => ['type' => 'auto', 'published_at' => now()],
        ]);
        
        $this->info('📤 Sending to Telegram...');
        $sent = $telegram->sendArticle($randomNews, $summary, $imageUrl, $article->id);
        
        if ($sent) {
            $this->info("✅ Published successfully! ID: {$article->id}");
            return 0;
        }
        
        $this->error('❌ Failed to send to Telegram');
        return 1;
    }
}
