<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
        'category' => [
            'required',
            'string'
        ],
        'name' => [
            'required',
            'string'
        ],
        'slug' => [
            'required',
            'string',
        ],
        'description' => [
            'required',
        ],
        'small description' => [
            'required',
        ],
        'original price' => [
            'required',
            'numeric',
        ],
        'seling price' => [
            'required',
            'numeric',
        ],
        'quantity' => [
            'required',
            'numeric',
        ],
        'meta_title' => [
            'required',
            'string',
        ],
        'meta_keyword' => [
            'required',
            'string',
        ],
        'meta_description' => [
            'required',
            'string',
        ],
        'image' => [
            'nullable',
            'mimes:jpg,jpeg,png'
        ]
    ];
  }
 
}