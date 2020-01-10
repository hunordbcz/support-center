<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'ticket_id', 'subject', 'type', 'priority', 'message', 'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTypeAttribute($value)
    {
        return ucfirst($value);
    }
}
