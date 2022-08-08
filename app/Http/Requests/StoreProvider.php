<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProvider extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            //
            
            'name'     => 'required|min:3|regex:/(^[a-zA-Z][a-zA-Z\s]{0,20}[a-zA-Z]$)/',
            'email'    => 'required|email',
            'mobile' => 'required|min:11|numeric|unique:users,mobile',
            'image'   => 'required|image|mimes:png,jpg,gif',
            'description'     => 'required',
            'price'     => 'required|numeric',
            'category_id'     => 'required'
        ];
    }
}
