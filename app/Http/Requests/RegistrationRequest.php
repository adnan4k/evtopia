<?php

namespace App\Http\Requests;

use App\Models\VerifyManage;
use App\Rules\EmailRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Cache;

class RegistrationRequest extends FormRequest
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
        $verifyManage = Cache::rememberForever('verify_manage', function () {
            return VerifyManage::first();
        });

        $emailRequird = 'nullable';

        if ($verifyManage?->register_otp && ($verifyManage->register_otp_type == 'email' || $verifyManage->forgot_otp_type == 'email')) {
            $emailRequird = 'required';
        }

        return [
            'name' => 'required|string|max:200',
            'phone' => 'required|unique:users,phone',
            'email' => [$emailRequird, 'email', new EmailRule, 'unique:users,email'],
            'password' => 'required|string|min:6',
            'year' => [
                'nullable',
                'integer',
                'digits:4',                      // exactly 4 digits
                'min:1901',                      // not below MySQL’s floor
                'max:'.now()->year,              // not in the future
            ],
        ];
    }

    public function messages(): array
    {
        $request = request();
        if ($request->is('api/*')) {
            $lan = 'en';
            app()->setLocale($lan);
        }

        return [
            'name.required' => __('The name field is required.'),
            'phone.required' => __('The phone field is required.'),
            'phone.unique' => __('Phone already exists.'),
            'password.required' => __('The password field is required.'),
            'password.min' => __('The password must be at least 6 characters.'),
            'email.required' => __('The email field is required.'),
            'email.email' => __('The email must be a valid email address.'),
            'email.unique' => __('The email has already been taken.'),
            'year.integer' => __('The year must be an integer.'),
            'year.digits' => __('The year must be exactly 4 digits.'),
            'year.min' => __('The year must be at least 1901.'),
            'year.max' => __('The year cannot be in the future.'),
        ];
    }
}
