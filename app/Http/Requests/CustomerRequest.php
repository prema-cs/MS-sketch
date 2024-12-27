<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        $customerId = $this->route('customer');
        $rules = [
            'name' => 'required|max:255',
            'phone_number' => 'required|min:10|regex:/^\+?[1-9]\d{1,14}$/',
            'address' => 'required|max:255',
            'email' => 'required|email|unique:customers,email'
        ];        
        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules['email'] = 'required|email|unique:users,email,' . $this->route('user'); // User ID for update
        }
        return $rules;
    }
}
