<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLiveSessionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'session_key' => ['required', 'string', 'max:255'],
            'session_passcode' => ['nullable', 'string', 'max:255']
        ];
    }
}
