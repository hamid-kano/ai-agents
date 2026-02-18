<?php

namespace App\Services;

use App\Agents\{ResearcherAgent, WriterAgent, EditorAgent, SEOAgent};

class BlogOrchestrator
{
    public function __construct(
        protected ResearcherAgent $researcher,
        protected WriterAgent $writer,
        protected EditorAgent $editor,
        protected SEOAgent $seo
    ) {}
    
    public function createArticle(string $topic): array
    {
        $research = $this->researcher->research($topic);
        $draft = $this->writer->write($topic, $research);
        $edited = $this->editor->edit($draft);
        $seoData = $this->seo->optimize($edited, $topic);
        
        return [
            'topic' => $topic,
            'research' => $research,
            'content' => $edited,
            'seo' => $seoData
        ];
    }
}
