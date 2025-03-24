<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = [
        'description',
        'content_vusial',
        'user_id',
    ];

    public function users(){
        return $this->belongsTo();
    }
}
