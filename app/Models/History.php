<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';

    protected $fillable = [
        'user_id',
        'number',
        'result',
        'win_amount',
    ];

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getResult(): string
    {
        return $this->result;
    }

    public function getWinAmount(): string
    {
        return $this->win_amount;
    }

    public function belongsToUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
