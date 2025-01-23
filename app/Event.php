<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'date', 'location', 'details', 'organizer_id', 'max_capacity', 'current_capacity',
    ];

    // 主催者とのリレーション
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }
}