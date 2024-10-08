<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ServiceRequest extends FormRequest
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
          'name' => 'required|string|max:255',
          'desc' => 'required|string|max:255',
          'hourly_price' => 'required|numeric|min:0.01',
          'daily_price' => 'required|numeric|min:0.01',  
          'is_limited'  => 'required|boolean',
          'total_units' => 'required_if:is_limited,true|integer|min:1',
        ];
    }
       protected function failedValidation(Validator $validator)
    {
        $respons = $this->ReturnError($validator->errors(),422);
        throw new HttpResponseException($respons);
    }
}


