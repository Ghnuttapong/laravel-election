<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voter extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'number',
        'score',
        'policy',
        'disabled',
        'user_id',
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
