<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Iban extends Model
{
    protected $fillable = [
        'user_id',
        'iban',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}
