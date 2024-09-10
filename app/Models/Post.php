<?php

namespace App\Models;

use Illuminate\Support\Facades\File; // Corrigeer 'Illumintate' naar 'Illuminate'
use Illuminate\Database\Eloquent\ModelNotFoundException; // Corrigeer 'Illumintate' naar 'Illuminate'

class Post
{
    public static function all(){
        $files = File::files(resource_path("posts/"));

        return array_map(fn($file) => $file ->getContents(), $files);
    }

    public static function find($slug){
        // Controleer of het bestand bestaat
        if (!file_exists($path = resource_path("posts/{$slug}.html"))){
            // Gooi een ModelNotFoundException als het bestand niet gevonden wordt
            throw new ModelNotFoundException();
        }

        // Gebruik caching om de inhoud van het bestand op te slaan
        return cache()->remember("posts.{$slug}", 1200, function() use ($path) {
            return file_get_contents($path); // Sluit de callback-functie hier correct af
        }); // Sluit de cache()->remember() methode correct af
    }
}

