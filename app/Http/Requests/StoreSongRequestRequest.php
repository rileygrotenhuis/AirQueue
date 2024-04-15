<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSongRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        foreach ($this->input('session_ids') as $sessionId) {
            if (! $this->user()->liveSessions->contains($sessionId)) {
                return false;
            }
        }

        return true;
    }

    public function rules(): array
    {
        return [
            'session_ids' => ['required', 'array'],
            'session_ids.*' => ['required', 'exists:live_sessions,id'],
            'song_name' => ['required', 'string', 'max:255'],
            'song_artist' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'session_ids.required' => 'Please select at least one session.',
        ];
    }
}
