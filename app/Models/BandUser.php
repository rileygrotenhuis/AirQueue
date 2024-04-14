<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BandUser extends Model
{
    use HasFactory;

    protected $table = 'band_user';

    protected $fillable = [
        'band_id',
        'user_id',
        'has_accepted',
    ];

    public function casts(): array
    {
        return [
            'has_accepted' => 'boolean',
        ];
    }

    public function band(): BelongsTo
    {
        return $this->belongsTo(Band::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
