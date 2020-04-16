<?php

namespace App\Http\Requests\Comments;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class Put extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'    => 'string',
            'content' => 'string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $res = response()->json([
            'status' => 422,
            'errors' => $validator->errors(),
        ], 422);
        throw new HttpResponseException($res);
    }
}
