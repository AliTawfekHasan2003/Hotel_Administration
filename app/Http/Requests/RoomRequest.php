<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RoomRequest extends FormRequest
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
        'num' => 'required|integer|min:1',
        'desc' => 'required|string|max:255',
        'Room_Type_id' => 'required|integer|exists:room_types,id',
        ];
    }
       protected function failedValidation(Validator $validator)
    {
        $respons = $this->ReturnError($validator->errors(),422);
        throw new HttpResponseException($respons);
    }
}


