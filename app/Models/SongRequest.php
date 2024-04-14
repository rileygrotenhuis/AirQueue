<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SongRequest extends Model
{
    use HasFactory;

    protected $table = 'song_requests';

    protected $fillable = [
        'requester_id',
        'user_id',
        'live_session_id',
        'song_name',
        'song_artist',
        'spotify_image_url',
        'spotify_track_id',
        'spotify_track_uri',
    ];

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function liveSession(): BelongsTo
    {
        return $this->belongsTo(LiveSession::class, 'live_session_id');
    }
}
