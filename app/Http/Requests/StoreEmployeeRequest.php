<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreEmployeeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email|unique:users,email',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'department' => 'nullable|string|in:hr,sales,marketing,it,finance,operations,research',
            'gender' => 'required|in:male,female',
        ];
    }

}
