<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
}
