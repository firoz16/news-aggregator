<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Article;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch articles from NewsAPI and store them in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get('https://newsapi.org/v2/top-headlines', [
            'apiKey' => '36bd4905ce8b486d97d49af7ac5cd93b',
            'country' => 'us',
        ]);
        $articles = $response->json()['articles'];

        foreach ($articles as $article) {
            $formatedDate = Carbon::parse($article['publishedAt'])->toDateTimeString();
            Article::updateOrCreate(
                ['source' => $article['source']['name'], 'title' => $article['title'],'author' => $article['author']],
                ['description' => $article['description'], 'content' => $article['content'], 'published_at' =>$formatedDate ]
            );
        }
    }
}
