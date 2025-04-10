<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
{
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
        $data =  [
            "name" => "required|string|max:255",
            "city" => "required|string|max:255",
            "state" => "required|string|max:255"
        ];
        
        if($this->method() == "PUT") {
            $data["name"] = "nullable|string|max:255";
            $data["city"] = "nullable|string|max:255";
            $data["state"] = "nullable|string|max:255";
        };

        return $data;
    }
}
