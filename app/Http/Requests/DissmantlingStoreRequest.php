<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DissmantlingStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'motor_id' => ['required', 'integer', 'exists:motors,id'],
            'sernum' => ['required', 'string', 'max:40'],
            'tgl' => ['required', 'date'],
            'spk' => ['unique:dissmantlings,spk']
        ];
    }
}