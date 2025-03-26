<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = [
        'message',
        'user_id',
        'ticket_id',
    ];

    public function users(){
        return $this->belongsTo();
    }
}
