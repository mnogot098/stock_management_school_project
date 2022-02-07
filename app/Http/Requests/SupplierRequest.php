<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //handled with middleware
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'email' => 'required|email',
            'address' => 'required',
            'phone_number' => 'required'
        ];
    }

    /**
     * Overriding the default messages 
    */
    public function messages()
    {
        return [
            'email.unique' => 'Supplier already exists.'
        ];
    }
}
