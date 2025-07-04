<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            'surname' => ['required', 'string', 'max:255'],
            'patronymic' => ['required', 'string', 'max:255'],
            'position_id' => ['required', 'integer', 'exists:positions,position_id'],
            'salary' => ['required', 'numeric', 'min:10000', 'max:2407000'],
            'hire_date' => ['required', 'date'],
            'education_id' => ['required', 'integer', 'exists:education,education_id'],
            'phone_number' => ['required', 'string', 'max:15'],
            'email' => ['required','email', 'max:255'],
        ];
    }
}
