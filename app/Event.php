<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'date', 'location', 'details', 'organizer_id', 'max_capacity', 'current_capacity'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
