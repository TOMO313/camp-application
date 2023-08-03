<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'post.camp'=>'required|string|max:50',
            'post.body'=>'required|string|max:5000',
        ];
    }
    
    public function messages()
    {
        return[
            'post.camp' => 'キャンプ場名は必ず記入してください。',
            'post.body' => '概要は必ず記入してください。'
            ];
    }
}
