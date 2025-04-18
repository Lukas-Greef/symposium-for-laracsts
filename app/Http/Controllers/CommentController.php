<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    // In CommentController.php
    public function index()
    {
        // Haal alle comments op inclusief de auteur (gebruikers) van de comment
        $comments = Comment::with('author')->latest()->get();
        return view('dashboard', compact('comments'));

    }

    public function create()
    {
        return view('comment-make');
    }

    // In CommentController.php
    public function store(Request $request)
    {
        // Valideer de invoer
        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        // Maak een nieuw comment en koppel het aan de ingelogde gebruiker
        $comment = new Comment();
        $comment->body = $validated['body'];
        $comment->user_id = auth()->id(); // Koppel de ingelogde gebruiker aan het comment
        $comment->save();

        // Redirect of terugsturen naar een andere pagina, bijvoorbeeld:
        return redirect()->route('dashboard')->with('success', 'Comment geplaatst!');
    }




}
