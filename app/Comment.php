<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Comment extends Model
{
    protected $fillable = [
        'ticket_id', 'user_id', 'comment', 'read_at'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getReadAtAttribute($value)
    {
        if ($value == null) {
            return null;
        }
        return Carbon::parse($value);
    }

    public function markAsRead()
    {
        $this->read_at = now();
        $this->save();
    }
}
