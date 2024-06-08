<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Workspace;
use App\Models\User;

class ApiToken extends Model
{
    protected $table = 'api_tokens';
    protected $guarded = [];

    public function workspace() {
        return $this->belongsTo(Workspace::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
