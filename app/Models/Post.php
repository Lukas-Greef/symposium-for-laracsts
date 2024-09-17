<?php

namespace App\Models;

use Illuminate\Support\Facades\File; // Corrigeer 'Illuminate' naar 'Illuminate'
use Illuminate\Database\Eloquent\ModelNotFoundException; // Corrigeer 'Illuminate' naar 'Illuminate'
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public $title;

    public $excerpt;

    public $date;

    public $body;

    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug){
        {
            $this->title = $title;
            $this->excerpt = $excerpt;
            $this->date = $date;
            $this->body = $body;
            $this->slug = $slug;
        }
    }

    public static function all()
    {
        return cache()->rememberForever('posts.all', function(){

        return collect(File::files(resource_path("posts")))
             ->map(fn($file) => YamlFrontMatter::parseFile($file))
             ->map(fn($document) => new Post(
                    $document->title,     // Toegang tot de titel
                    $document->excerpt,   // Toegang tot de samenvatting
                    $document->date,      // Toegang tot de datum
                    $document->body(),       // Toegang tot de inhoud/body
                    $document->slug
             ))
             ->sortByDesc('date');
    });
    }

    public static function find($slug) {
        return static::all()->firstWhere('slug', $slug);
    }
}

