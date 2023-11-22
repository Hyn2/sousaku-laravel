<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'title',
        'content',
        'gender',
        'user_id',
        'contact',
    ];
    public function region() {
        return $this->belongsTo(Region::class);
    }

    public function positions() {
        return $this->belongsToMany(Position::class);
    }

    public function genres() {
        return $this->belongsToMany(Genre::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
