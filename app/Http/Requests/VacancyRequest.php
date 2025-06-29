<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacancyRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'department_id' => 'required|exists:departments,department_id',
            'location_id' => 'required|exists:locations,location_id',
            'working_hours_id' => 'required|exists:working_hours,working_hours_id',
            'salary' => 'required|numeric|min:0',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string',
        ];
    }
}
