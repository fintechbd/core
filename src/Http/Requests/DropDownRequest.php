<?php

namespace Fintech\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DropDownRequest extends FormRequest
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
            'label' => ['string', 'nullable'],
            'attribute' => ['nullable', 'string'],
            'paginate' => ['boolean', 'nullable']
        ];
    }

    protected function prepareForValidation(): void
    {
        $options['paginate'] = false;

        $paginateInput = $this->input('paginate', '');

        if ($paginateInput != null && strlen($paginateInput) != 0) {
            $options['paginate'] = $this->boolean('paginate');
        }

        $this->merge($options);
    }
}
