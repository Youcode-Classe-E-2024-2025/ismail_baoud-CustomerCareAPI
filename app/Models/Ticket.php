<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'title',
        'description',
        'content_vusial',
        'status',
        'client_id',
        'agent_id',
    ];

    public function users(){
        return $this->belongsTo();
    }
}
