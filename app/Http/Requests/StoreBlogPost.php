<?php

namespace App\Http\Requests;

use App\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBlogPost extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $uniqueRule = Rule::unique(Post::class, 'slug');
        if ($this->route()->hasParameter('post')) {
            $uniqueRule->ignore($this->route()->post);
        }

        return [
            'slug' => 'required|regex:/^[a-z0-9_-]+$/i|' . $uniqueRule,
            'title' => 'required|min:5|max:100',
            'description' => 'required|max:255',
            'content' => 'required',
        ];
    }
}

