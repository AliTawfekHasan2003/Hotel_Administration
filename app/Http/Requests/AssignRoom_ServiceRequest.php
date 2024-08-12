<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;


class AssignRoom_ServiceRequest extends FormRequest
{
    use ResponseTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'Room_Type_id' => 'required|exists:Room_types,id',
            'services' => 'array|required',
            'services.*' => [
                'required',
                'exists:services,id',
                Rule::unique('room_services', 'Service_id')->where(function ($query) {
                    return $query->where('Room_Type_id', $this->Room_Type_id);
                })
            ],
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $respons = $this->ReturnError($validator->errors(), 422);
        throw new HttpResponseException($respons);
    }
}
