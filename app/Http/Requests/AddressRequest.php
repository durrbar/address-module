<?php

namespace Modules\Address\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // You can customize this based on your application's needs
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'address_type' => 'required|string|in:Home,Office', // Only allow specific types
            'primary' => 'boolean',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'city.required' => 'The city field is required.',
            'state.required' => 'The state field is required.',
            'country.required' => 'The country field is required.',
            'address.required' => 'The address field is required.',
            'zip_code.required' => 'The zip code field is required.',
            'address_type.in' => 'The address type must be either "home" or "office".',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge($this->convertKeysToSnakeCase($this->all()));
    }

    /**
     * Convert camelCase keys to snake_case.
     */
    private function convertKeysToSnakeCase(array $data): array
    {
        $converted = [];

        foreach ($data as $key => $value) {
            $converted[Str::snake($key)] = $value;
        }

        return $converted;
    }
}
