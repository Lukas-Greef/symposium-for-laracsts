<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = ['title', 'slug', 'body', 'category_id', 'prijs'];

    protected $with = ['category', 'author'];

    public function scopeFilter($query, $filters)
    {
        $query->when($filters['search'] ?? false, fn ($query, $search)=>
            $query->where(fn($query) =>
                $query->where('title', 'like', '%' .  $search. '%')
                ->orWhere('body', 'like', '%' .  $search . '%')
            )
        );

        $query->when($filters['category'] ?? false, fn ($query, $category)=>
            $query->whereHas('category', fn ($query) =>
                $query ->where('slug', $category)
            )
        );
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relatie tussen Post en Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

