<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceCartRequest extends FormRequest
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
        return [
            'service_id' => 'required|exists:services,id',
            'quantity' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        $request = request();
        if ($request->is('api/*')) {
            $lan = $request->header('accept-language') ?? 'en';
            app()->setLocale($lan);
        }

        return [
            'service_id.required' => __('The service id is required.'),
            'service_id.exists' => __('The selected service id is invalid.'),
            'quantity.integer' => __('The quantity must be an integer.'),
        ];
    }
}
