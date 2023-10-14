<?php

namespace Fintech\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateConfigurationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'package' => ['string', 'required', Rule::in(array_keys(config('fintech.core.packages', ['core' => 'Core'])))],
            'user_id' => ['integer', 'nullable'],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->input('user_id') == null) {
            $this->offsetUnset('user_id');
        }
    }
}
