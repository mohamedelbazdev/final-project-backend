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
            // 'user_id'     => 'required',
            'name'     => 'required|min:3',
            'email'    => 'required|email',
            'mobile' => 'required|min:11|numeric',
            'image'   => 'required|image|mimes:png,jpg,gif',
            'description'     => 'required',
            'price'     => 'required',
            'category_id'     => 'required'
        ];
    }
}
