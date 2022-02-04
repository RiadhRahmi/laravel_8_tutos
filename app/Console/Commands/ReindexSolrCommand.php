<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;


class ReindexSolrCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:solr';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';



    private $clientSolr;

    public function __construct(\Solarium\Client $clientSolr)
    {
        parent::__construct();
        $this->clientSolr = $clientSolr;
    }


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Indexing all articles. This might take a while...');

        //generate an updated object 
        $update = $this->clientSolr->createUpdate();

        //collectively registered 
        foreach (Article::cursor() as $article) {

            $doc = $update->createDocument();

            $doc->id = $article->id;
            $doc->title = $article->title;
            $doc->body = $article->body;
            $doc->tags = $article->tags;
            $doc->created_at = $article->created_at;
            $doc->updated_at = $article->updated_at;

            $update->addDocument($doc);
        }


        //commit the update to Solr 
        $update->addCommit();
        $result = $this->clientSolr->update($update);


        if ($result->getStatus() != 0) {
            Log::error('Solr update failed.');
        }

        $this->info("\nDone!");
    }
}
