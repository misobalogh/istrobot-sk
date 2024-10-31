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
            'coauthors' => ['required', 'string', 'max:255'],
            'processor' => ['required', 'string', 'max:255'],
            'memory_size' => ['required', 'string', 'max:255'],
            'frequency' => ['required', 'string', 'max:255'],
            'sensors' => ['required', 'string', 'max:255'],
            'drive' => ['required', 'string', 'max:255'],
            'power_supply' => ['required', 'string', 'max:255'],
            'programming_language' => ['required', 'string', 'max:255'],
            'interesting_facts' => ['required', 'string', 'max:255'],
            'website' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'technology_id' => ['required', 'integer', 'exists:technologies,id'],
        ];
    }
}
