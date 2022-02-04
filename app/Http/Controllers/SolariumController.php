<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Exception;
use Illuminate\Http\Request;

class SolariumController extends Controller
{
    protected $clientSolr;

    public function __construct(\Solarium\Client $clientSolr)
    {
        $this->clientSolr = $clientSolr;
    }

    public function search()
    {
        $input = request('q');

        $query = $this->clientSolr->createSelect();
        // $query->setQuery($input);
        // show all data
        $query->setQuery('*:*');
        // $query->setQuery('id:"' . $input . '"');

        // search by or 
        $query->setQuery('title:' . $input . ' OR ' . 'body:' . $input . ' OR ' . 'tags:' . $input);

        // $query->setQuery('body:"' . $input . '"');
        // $query->setQuery('tags:"' . $input . '"');

        // $query->setFields(array('id', 'title', 'body', 'tags'));
        $query->setStart(0);
        $query->setRows(100);

        $documents = $this->clientSolr->select($query);

        // convert documents to collection
        $articles = collect([]);
        foreach ($documents as $document) {
            $article = new Article();
            $article->title = $document->title[0];
            $article->body = $document->body[0];
            $article->id = $document->id;
            $article->tags = $document->tags;
            $articles->push($article);
        }

        return view('solr', compact('articles'));
    }


    public function ping()
    {
        // create a ping query
        $ping = $this->clientSolr->createPing();

        // execute the ping query
        try {
            $this->clientSolr->ping($ping);
            return response()->json('OK');
        } catch (Exception $e) {
            return response()->json('ERROR', 500);
        }
    }
}
