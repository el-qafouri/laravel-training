<?php

namespace App\Http\Requests\API\V1\Auth;

use App\Rules\MobileAndPhoneValid;
use Illuminate\Foundation\Http\FormRequest;

class VerifyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mobile' => ['required', 'string', new MobileAndPhoneValid()],
            'code' => ['required', 'string'],
        ];
    }
}
