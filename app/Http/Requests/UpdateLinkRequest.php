<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $link = $this->route('link');
        return $link && ($this->user()?->id === $link->user_id || $this->user()?->is_admin);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $link = $this->route('link');
        $userId = $this->user()?->id;

        return [
            'destination_url' => ['sometimes', 'required', 'url', 'max:2048'],
            'slug' => [
                'sometimes',
                'nullable',
                'string',
                'min:3',
                'max:50',
                'regex:/^[a-zA-Z0-9-_]+$/',
                Rule::unique('links', 'slug')->ignore($link?->id)->where(function ($query) use ($userId) {
                    return $query->where('user_id', $userId);
                }),
            ],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'password' => ['nullable', 'string', 'min:4', 'max:100'],
            'expires_at' => ['nullable', 'date', 'after:now'],
            'max_clicks' => ['nullable', 'integer', 'min:1', 'max:1000000'],
            'status' => ['sometimes', 'in:active,paused,expired'],
        ];
    }
}
