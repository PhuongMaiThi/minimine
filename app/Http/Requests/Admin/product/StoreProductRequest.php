<?php

namespace App\Http\Requests\Admin\product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name'=> 'required',
            // 'description'=> 'required',
            // 'thumbnail'=> 'required',
            // 'status'=> 'required',
            // 'quantity'=> 'required',
            // 'is_feature'=> 'required',
            'category_id'=> 'required',
        ];
    }
}
