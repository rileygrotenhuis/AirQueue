<?php

namespace App\Models;

use App\SpotifyUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SpotifyUser;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'initials',
        'has_spotify_token',
        'is_spotify_connected',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getInitialsAttribute(): string
    {
        return $this->first_name[0].$this->last_name[0];
    }

    public function getHasSpotifyTokenAttribute(): bool
    {
        return $this->spotifyTokens()->exists();
    }

    public function getIsSpotifyConnectedAttribute(): bool
    {
        $tokenIsValid = $this->spotifyTokens()->exists() && now() < $this->spotifyTokens()->first()->expires_at;

        if (! $tokenIsValid) {
            $this->refreshAccessToken();
        }

        return true;
    }

    public function spotifyTokens(): HasMany
    {
        return $this->hasMany(SpotifyToken::class);
    }

    public function ownedBands(): HasMany
    {
        return $this->hasMany(Band::class, 'owner_id');
    }

    public function bands(): BelongsToMany
    {
        return $this->belongsToMany(
            Band::class,
            'band_user',
            'user_id',
            'band_id'
        )->withPivot('id', 'has_accepted');
    }

    public function hostedLiveSessions(): HasMany
    {
        return $this->hasMany(LiveSession::class, 'host_id');
    }

    public function liveSessions(): BelongsToMany
    {
        return $this->belongsToMany(
            LiveSession::class,
            'live_session_user',
            'user_id',
            'live_session_id'
        );
    }

    public function songRequests(): HasMany
    {
        return $this->hasMany(SongRequest::class, 'user_id');
    }
}
