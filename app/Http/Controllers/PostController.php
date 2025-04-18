<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function index()
    {

        return view('posts.index', [
            'posts' => Post::latest()->filter(
                request(['search', 'category', 'author'])
            )->paginate(6)->withQueryString() // Haalt alle posts op, gesorteerd van nieuwste naar oudste
        ]);
    }
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }
    public function make()
    {
        $categories = Category::all(); // Fetch all categories for the dropdown
        $posts = Post::all(); // Fetch all posts to display below the form

        return view('posts.make', compact('categories', 'posts'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:posts,slug',
            'body' => 'required|string',
            'prijs' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Create the post and associate the user_id
        $post = Post::create([
            'user_id' => auth()->id(), // Get the authenticated user's ID
            'title' => $validatedData['title'],
            'slug' => $validatedData['slug'],
            'body' => $validatedData['body'],
            'prijs' => $validatedData['prijs'],
            'category_id' => $validatedData['category_id'],
        ]);


        return redirect()->route('home')->with('success', 'Post created successfully!');
    }
    public function edit(Post $post)
    {
        // Haal de categorieën op om in de dropdown te tonen
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

// Voeg de update-methode toe
    public function update(Request $request, Post $post)
    {

        // Valideer de request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:posts,slug,' . $post->id,
            'body' => 'required|string',
            'prijs' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Update de post
        $post->update([
            'title' => $validatedData['title'],
            'slug' => $validatedData['slug'],
            'body' => $validatedData['body'],
            'prijs' => $validatedData['prijs'],
            'category_id' => $validatedData['category_id'],
        ]);

        return redirect()->route('posts.edit', $post)->with('success', 'Post updated successfully!');
    }
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->back()->with('success', 'Post verwijderd!');
    }







    //index, show, create, store, edit, update, destroy
}
