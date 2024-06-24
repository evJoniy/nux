<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'token',
        'user_id',
        'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime:Y-m-d',
    ];

    protected $dates = [
        'expires_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function getToken()
    {
        return $this->token;
    }

    public function getExpiresAt()
    {
        return $this->expires_at;
    }

    public function getDeletedAt()
    {
        return $this->deleted_at;
    }

    public function belongsToUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
