<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class TicketReplyRequest extends FormRequest
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
        $validations = [
            'body' => 'required',
            'ticket_id' => 'required|exists:tickets,id',
            'file' => 'mimes:jpeg,bmp,png,gif,svg,pdf'
        ];
        if (!\auth()->check()) {
            array_push($validations, ['ticket_number' => 'required|exists:tickets,ticket_number']);
        }

        return $validations;
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
