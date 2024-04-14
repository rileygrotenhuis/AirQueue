<?php

namespace App\Http\Requests;

use App\Models\LiveSession;
use Illuminate\Foundation\Http\FormRequest;

class JoinLiveSessionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'session_key' => ['required', 'string', 'max:255', 'exists:list_sessions,session_key'],
            'session_passcode' => [
                'nullable',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    $liveSession = LiveSession::query()->where('session_key', $this->input('session_key'))->first();

                    if ($liveSession->session_passcode !== $value) {
                        $fail('The session passcode is incorrect.');
                    }
                },
            ],
        ];
    }
}
