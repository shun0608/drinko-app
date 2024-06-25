<?php

namespace App\Http\Requests\User;

use Illuminate\contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthRequest extends FormRequest
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
      //実装時は、
      // 'email' => ['required', 'string', 'email:strict,dns,spoof', 'max:255'],
      'email' => ['required', 'string', 'email:rfc', 'max:255'],
      'password' => ['required', 'string']
    ];
  }
}
