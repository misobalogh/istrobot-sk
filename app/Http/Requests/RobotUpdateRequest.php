<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RobotUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'author_first_name' => ['required', 'string', 'max:255'],
            'author_last_name' => ['required', 'string', 'max:255'],
            'coauthors' => ['nullable', 'string', 'max:255'],
            'processor' => ['required', 'string', 'max:255'],
            'memory_size' => ['nullable','string', 'max:255'],
            'frequency' => ['required', 'string', 'max:255'],
            'sensors' => ['nullable', 'string', 'max:255'],
            'drive' => ['nullable', 'string', 'max:255'],
            'power_supply' => ['nullable', 'string', 'max:255'],
            'programming_language' => ['required', 'string', 'max:30'],
            'interesting_facts' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'technology_id' => ['required', 'integer', 'exists:technologies,id'],
        ];
    }
}
