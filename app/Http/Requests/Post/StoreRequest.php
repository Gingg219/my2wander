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
                'required' => ':attributes Ohai dion vao chu bro',
            ],
            // 'parent_id' => [
            //     'required' => ':attributes Ohai dion vao chuaaa bro',
            // ],
            'required' => ':attribute phai dien vao chu bro',
            'string' => ':attribute phai dien chuoi chu bro',
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
