<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'sender_id',
        'sender_type',
        'receiver_id',
        'receiver_type',
        'message',
        'is_read',
    ];

    // Polymorphic sender relation
    public function sender()
    {
        return $this->morphTo(null, 'sender_type', 'sender_id');
    }

    // Polymorphic receiver relation
    public function receiver()
    {
        return $this->morphTo(null, 'receiver_type', 'receiver_id');
    }
}
