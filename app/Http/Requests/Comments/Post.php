<?php

namespace App\Http\Requests\Comments;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class Post extends FormRequest
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
            'name'    => 'required',
            'content' => 'required',
        ];
    }

    protected function failedValidation(Validator $validator) {
        $res = response()->json([
            'status' => 422,
            'errors' => $validator->errors(),
        ], 422);
        throw new HttpResponseException($res);
    }
}
