<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LiveSession extends Model
{
    use HasFactory;

    protected $table = 'live_sessions';

    protected $fillable = [
        'host_id',
        'band_id',
        'title',
        'session_key',
        'session_passcode',
    ];

    public function host(): BelongsTo
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'live_session_user',
            'live_session_id',
            'user_id'
        );
    }

    public function band(): BelongsTo
    {
        return $this->belongsTo(Band::class, 'band_id');
    }
}
