<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Comment;

class Paste extends Model
{
    protected $fillable = ['title', 'content', 'file_path', 'attachment_path', 'visibility', 'user_id', 'url'];

    public function hasImageAttachment(): bool
    {
        if (!$this->attachment_path) {
            return false;
        }

        return in_array($this->attachmentExtension(), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'], true);
    }

    public function attachmentExtension(): ?string
    {
        if (!$this->attachment_path) {
            return null;
        }

        return strtolower(pathinfo($this->attachment_path, PATHINFO_EXTENSION));
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'paste_user');
    }

    //evento / url univoco /boot=solo quando classe usata in quest caso Paste   
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($paste) {
            $paste->url = Str::random(10);
        });
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
