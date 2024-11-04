<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name_EN' => 'required|string|max:255',
            'name_SK' => 'required|string|max:255',
            'type_of_evaluation' => 'required|in:score,time',
        ];
    }
}
