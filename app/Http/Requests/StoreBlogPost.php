<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPost extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $isCreate = request()->method == 'POST';

        return [
            'slug' =>($isCreate ? 'unique:posts,slug' : '') . '|required|regex:/^[a-z0-9_-]+$/i',
            'title' => 'required|min:5|max:100',
            'description' => 'required|max:255',
            'content' => 'required',
        ];
    }
}
