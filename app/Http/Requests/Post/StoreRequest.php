<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => [
                'required',
                'string',
            ],
            'content' => [
                'required',
            ],
            'meta_title' => [
                'required',
                'string',
            ],
            'categories' => [
                'required',
            ],
            'tags' => [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'title' => [
                'required' => ':attributes must be fill',
            ],
            'required' => ':attribute must be fill',
            'string' => ':attribute must be a character',
        ];
    }
    public function attributes()
    {
        return [
            'title'=> 'Title',
            'parent_id'=> 'Parent_id'
        ];
    }
}
