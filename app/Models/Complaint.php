<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','category_id','title','description','image','location','urgency','status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function response()
    {
        return $this->hasOne(Response::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function upvotes()
    {
        return $this->votes()->where('type', 'upvote');
    }

    public function downvotes()
    {
        return $this->votes()->where('type', 'downvote');
    }
}
