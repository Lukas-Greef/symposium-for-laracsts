<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Post;
use Spatie\YamlFrontMatter\YamlFrontMatter; // Zorg dat dit hier staat voor het verwerken van YAML front matter in markdown-bestanden
use App\Models\Category;
use App\Models\User;



Route::post('newsletter', function  (){
    request()->validate(['email' => 'required|email']);

    $mailchimp = new \MailchimpMarketing\ApiClient();

    $mailchimp->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => 'us12'
    ]);
    try {
        $response = $mailchimp->lists->addListMember('aebc1a781e', [
            'email_address' => request('email'),
            'status' => 'subscribed'
        ]);
    }catch(\Exception $e){
        throw \Illuminate\Validation\ValidationException::withMessages([
            'email' => 'This email could not be added'
        ]);

    }
    return redirect('/');

});
Route::get('/', [PostController::class, 'index'])
    ->name('home');

// In web.php
Route::middleware('auth')->group(function () {
    Route::get('/comment/create', [CommentController::class, 'create'])
        ->name('comment.create');
    Route::post('/comment', [CommentController::class, 'store'])
        ->name('comment.store');
});

Route::get('/dashboard', [CommentController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('posts/{post:slug}', [PostController::class, 'show'])
    ->name('post');

Route::get('register', [RegisteredUserController::class, 'create']);

// Route to display the form
Route::get('admin/posts/make', [PostController::class, 'make'])
    ->name('posts.create');

// Route to handle form submission
Route::post('admin/posts', [PostController::class, 'store'])
    ->middleware('auth')
    ->name('posts.store');

// Route to display the edit form for a post
// routes/web.php

Route::middleware('auth')->group(function () {
    Route::get('admin/posts/{post}/edit', [PostController::class, 'edit'])
        ->name('posts.edit');
    Route::patch('admin/posts/{post}', [PostController::class, 'update'])
        ->name('posts.update');
});

// Route to handle the deletion of a post
Route::delete('admin/posts/{post}', [PostController::class, 'destroy'])
    ->middleware('auth')
    ->name('posts.destroy');

// Routes die alleen toegankelijk zijn voor ingelogde gebruikers (auth middleware)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit'); // Route voor het bewerken van het profiel
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update'); // Route voor het updaten van het profiel
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy'); // Route voor het verwijderen van het profiel
});

// Inclusie van de routes voor authenticatie (login, registratie, etc.)
require __DIR__.'/auth.php'; // Laadt de authenticatie routes zoals login, register, password reset
