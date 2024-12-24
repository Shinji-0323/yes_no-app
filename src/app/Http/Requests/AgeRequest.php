<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgeRequest extends FormRequest
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
            'age' => ['required', 'integer', 'min:1', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'age.required' => '年齢を入力してください',
            'age.integer' => '年齢は数字で入力してください',
            'age.min' => '年齢は1以上を入力してください',
            'age.max' => '年齢は120以下を入力してください',
        ];
    }
}
