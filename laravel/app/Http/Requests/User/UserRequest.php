<?php

namespace App\Http\Requests\User;

use Illuminate\contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
      'name' => ['required', 'max:255'],
      'email' => ['required', 'string', 'email:strict,dns,spoof', 'max:255', 'unique:users,email,NULL,id,deleted_at,NULL'],
      'password' => ['required', 'string', Password::min(8)]
    ];
  }
}
