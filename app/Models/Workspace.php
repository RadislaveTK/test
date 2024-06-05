<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ApiToken;

class Workspace extends Model
{
    protected $guarded = [];
    protected $attributes = [
        'title' => 'Test',
        'desc' => " ",
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }  
    
    public function apiTokens()
    {
        return $this->hasMany(ApiToken::class);
    }

}
