<?php

namespace App\Http\Requests;

use App\Models\Ticket;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class TicketUpdateRequest extends FormRequest
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
            'user_id' => 'sometimes|exists:users,id',
            'name' => 'sometimes|required',
            'email' => 'sometimes|required',
            'subject' => 'sometimes|required',
            'body' => 'sometimes|required',
            'status' => ['sometimes|required' , Rule::in(Ticket::STATUSES)],
            'priority_id' => 'nullable|exists:priorities,id'
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
