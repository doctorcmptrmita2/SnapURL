<?php

namespace App\Http\Requests;

use App\Rules\SafeUrl;
use App\Support\Turnstile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreLinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow both authenticated and guest users
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->user()?->id;

        return [
            'destination_url' => ['required', 'url', 'max:2048', new SafeUrl()],
            'slug' => [
                'nullable',
                'string',
                'min:3',
                'max:50',
                'regex:/^[a-zA-Z0-9-_]+$/',
                Rule::unique('links', 'slug')->where(function ($query) use ($userId) {
                    return $query->where('user_id', $userId);
                }),
            ],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'password' => ['nullable', 'string', 'min:4', 'max:100'],
            'expires_at' => ['nullable', 'date', 'after:now'],
            'max_clicks' => ['nullable', 'integer', 'min:1', 'max:1000000'],
        ];
    }

    /**
     * Require a valid captcha for guest (anonymous) submissions when Turnstile
     * is configured. Authenticated users and API token requests are exempt.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            if ($this->user()) {
                return; // logged-in users skip captcha
            }

            $turnstile = app(Turnstile::class);
            if (! $turnstile->enabled()) {
                return; // captcha not configured
            }

            $token = $this->input('cf-turnstile-response');
            if (! $turnstile->verify($token, $this->ip())) {
                \App\Models\AbuseLog::record('captcha', $this->input('destination_url'), $this);
                $validator->errors()->add('captcha', 'Captcha verification failed. Please try again.');
            }
        });
    }
}
