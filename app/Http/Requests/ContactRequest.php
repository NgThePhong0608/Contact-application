<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:30|string',
            'last_name' => 'required|max:30|string',
            'email' => 'required|max:30|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'company_id' => 'required|exists:companies,id',
        ];
    }

    public function attributes()
    {
        return [
            'company_id' => 'company',
            'email' => 'email address',
            'first_name' => 'first name',
            'last_name' => 'last name',
        ];
    }

    public function messages()
    {
        return[
            'email.email' => 'The email that you entered is not valid',
            '*.required' => 'The :attribute can not be empty'
        ];
    }
}
