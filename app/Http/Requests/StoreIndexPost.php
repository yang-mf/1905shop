<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIndexPost extends FormRequest
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
        return ['goods_name'=>[
            'required',
        ],
            'goods_price'=>  'required',
            'goods_desc'=>  'required',
            'goods_num'=>  'required',
        ];
    }

    public function messages()
    {
        return [
            'goods_name.required'=>'分类名称必填',
            'goods_price.required'=>'分类名称必填',
            'goods_desc.required'=>'分类名称必填',
            'goods_num.required'=>'分类名称必填',
        ];

    }
}
