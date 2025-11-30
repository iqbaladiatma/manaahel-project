<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // User can only update their own profile
        return $this->user()->id === $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'batch_year' => ['nullable', 'integer', 'min:1900', 'max:' . (date('Y') + 10)],
            'avatar' => ['nullable', 'image', 'max:2048'], // 2MB max
            'latitude' => ['nullable', 'numeric', 'min:-90', 'max:90'],
            'longitude' => ['nullable', 'numeric', 'min:-180', 'max:180'],
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'latitude.numeric' => 'The latitude must be a valid decimal number.',
            'latitude.min' => 'The latitude must be between -90 and 90 degrees.',
            'latitude.max' => 'The latitude must be between -90 and 90 degrees.',
            'longitude.numeric' => 'The longitude must be a valid decimal number.',
            'longitude.min' => 'The longitude must be between -180 and 180 degrees.',
            'longitude.max' => 'The longitude must be between -180 and 180 degrees.',
        ];
    }
}
