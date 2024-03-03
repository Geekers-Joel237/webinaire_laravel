<?php

namespace App\Shared;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;

class HttpDataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors()),
            200
        );
    }

}
