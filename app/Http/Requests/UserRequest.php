<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
            'first_name' => 'required|max:255',
            'last_name' => 'max:255',
            'email' => 'required|email|unique:users,email,' . request()->segment(3),
            'role' => ['required', Rule::in(User::ROLES)],
            'file' => 'mimes:jpg,jpeg,png,bmp,tiff',
            'password' => 'min:4',
            // 'password' => 'min:4|required_with:password_confirmation|same:password_confirmation',
            // 'password_confirmation' => 'min:4'
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'There is error validating your requests',
            'code' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
            'data' => $errors
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
